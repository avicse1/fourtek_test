<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\User;
use Hash;
use Session;
use Mail;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function do_login(Request $request, MessageBag $message_bag) {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check valid user
        $user = User::where('email', $request->email)->first();

        if(!$user){
            $message_bag->add('email', 'No such email found in our database.');
            return redirect()->route('login')->withErrors($message_bag);
        }

        if($user->is_email_verified == 'no') {
            Session::flash('error', 'This email has not verified');
            return redirect()->back();   
        }

        
        if(!Hash::check($request->password, $user->password)) {
            $message_bag->add('password', 'Incorrect password');
            return redirect()->route('login')->withErrors($message_bag);
        }
        
        if($user->role == 'admin') {
            Session::flash('error', 'This email has admin account.');
            return redirect()->back();   
        }
       
        
        $user->session_token = str_random(40);
        $user->save();
        
        session()->put('session_token', $user->session_token);

        return redirect()->route('dashboard');
    }

    public function register() {
        return view('register');
    }

    public function do_register(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $confirmation_code = str_random(30);
        $data = array('email' => $request->email, 'confirmation_code' =>  $confirmation_code, 'name' => $request->first_name. ' '. $request->last_name);
        
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_confirmation_code = $confirmation_code;

        $user->save();


        // Verification mail
        Mail::send('mails.verify_email', $data,  function($message) use ($data){
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));           
            $message->to($data['email']);
            $message->subject('Thanks for registering as a user.');
        });

        Session::flash('success', 'A verification email sent to registered email. Please verify to login');

        return redirect()->back();

    }

    public function verify_email() {
        return view('verify_email');
    }

    public function do_verify(Request $request) {

        if(!$request->email){
            Session::flash('error', '');
            return redirect()->route('email_verify');
        }

        $user = User::where('email', $request->email)->first();

        if($user->is_email_verified == 'yes') {
            Session::flash('success', 'This email is already verified');
            return redirect()->route('email_verify');
        }

        if(!$request->code){
            Session::flash('error', 'Email verification faild');
            return redirect()->route('email_verify');
        }  

        $user = User::where('email', $request->email)->where('email_confirmation_code', $request->code)->first();

        if (!$user) {
            Session::flash('error', '');
            return redirect()->route('email_verify');
        }

        $user->is_email_verified = 'yes';
        $user->email_confirmation_code = null;
        $user->save();

        Session::flash('success', 'Email has verified successfully!');
        return redirect()->route('email_verify');
    }


    public function logout() {
        $session_token = session()->get('session_token', null);
        $user = User::where('session_token', $session_token)->first();
                
        if($user) {
            $user->session_token = null;
            $user->save();
        }
        return redirect()->route('login');
    }
}
