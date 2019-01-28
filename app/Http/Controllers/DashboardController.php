<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Helper;
use App\Day;
use Session;
use App\DayPivot;
class DashboardController extends Controller
{
    public function dashboard() {
        $logged_user = Helper::getCurrentUser();
        $attendances = $logged_user->attendance;
        return view('user.dashboard', compact('attendances'));
    }

    public function markAttendance(Request $request) {
        $logged_user = Helper::getCurrentUser();
        $request->validate([
            'date' => 'required',
            'time' => 'required',
        ]);

        $day = Day::where('date', $request->date)->first();

        if(!$day) {
            $day = new Day;
            $day->date = $request->date;
            $day->save();
        }        
        
        $attendance = DayPivot::where('user_id', $logged_user->id)->where('day_id', $day->id)->first();

        if(!$attendance) {
            $attendance = new DayPivot;
            $attendance->user_id = $logged_user->id;
            $attendance->day_id = $day->id;                       
        }

        $attendance->in_time = $request->time; 
        $attendance->save();
        

        Session::flash('success', 'Attendance has marked successfully');
        return redirect()->back();


    }
}
