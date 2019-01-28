<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;
use App\User;

class AdminDashboardController extends Controller
{
    public function dashboard() {
        $all_dates = Day::all();
        $users = User::where('role', 'user')->get();
        return view('admin.dashboard', compact('all_dates', 'users'));
    }

    public function filterAttendance(Request $request) {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $all_dates = Day::where('date', '>=', $request->start_date)->where('date', '<=', $request->end_date)->get();
        $users = User::where('role', 'user')->get();
        return view('admin.dashboard', compact('all_dates', 'users'));       
    }
}
