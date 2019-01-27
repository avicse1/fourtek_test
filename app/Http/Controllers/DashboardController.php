<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Library\Helper;
use Session;

class DashboardController extends Controller
{
    public function dashboard() {
        $logged_user_id = Helper::getCurrentUser()->id;
        $attendances = Attendance::where('user_id', $logged_user_id)->get();
        return view('user.dashboard', compact('attendances'));
    }

    public function markAttendance(Request $request) {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
        ]);
        
        $logged_user = Helper::getCurrentUser();
        $attendance = new Attendance;
        $attendance->date = $request->date;
        $attendance->time = $request->time;
        $attendance->user_id = $logged_user->id;
        
        $attendance->save();

        Session::flash('success', 'Attendance has marked successfully');
        return redirect()->back();


    }
}
