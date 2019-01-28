<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Day;

class User extends Authenticatable
{

    public function attendance() {
        return $this->belongsToMany(Day::class)->withPivot('in_time');
    }

    public function getFullName() {
        return $this->first_name.' '.$this->last_name;
    }
}
