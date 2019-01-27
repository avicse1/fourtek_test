<?php

namespace App\Library;

use App\User;

class Helper
{
    public static function isUserLoggedIn() {
        $session_token = session()->get('session_token', null);

        if(!$session_token) {
            return false;
        }

        $user = User::where('session_token', $session_token)->first();
        
        if(!$user || !$user->session_token) {
            return false;
        }
        
        return true;
    }

    public static function getCurrentUser() {
        $token = session()->get('session_token');
        return User::where('session_token', $token)->first();
    }
}

