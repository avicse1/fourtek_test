<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\User;
use Hash;

class AdminAuthController extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function do_login(Request $request, MessageBag $message_bag) {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check valid user
        $user = User::where('email', $request->email)->first();

        if(!$user){
            $message_bag->add('email', 'Email not found in our database');
            return redirect()->route('admin_login')->withErrors($message_bag);
        }
        
        if(!Hash::check($request->password, $user->password)) {
            $message_bag->add('password', 'Incorrect password');
            return redirect()->route('admin_login')->withErrors($message_bag);
        }
        
        if($user->role == 'admin') {
            $user->session_token = str_random(40);
            $user->save();
            
            session()->put('session_token', $user->session_token);

            return redirect()->route('admin_dashboard');
        }else {
            $message_bag->add('email', 'Unauthorized email.');
            return redirect()->route('admin_login')->withErrors($message_bag);
        }
        
    }

    public function logout() {
        $session_token = session()->get('session_token', null);
        $user = User::where('session_token', $session_token)->first();
                
        if($user) {
            $user->session_token = null;
            $user->save();
        }
        return redirect()->route('admin_login');
    }
}
