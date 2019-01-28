<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function users() {
        return $this->belongsToMany(User::class)->withPivot('in_time');
    }
}
