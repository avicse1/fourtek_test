<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Attendance;

class User extends Authenticatable
{
    public function attendance() {
        return $this->hasMany(Attendance::class);
    }
}
