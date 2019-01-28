<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayPivot extends Model
{
    protected $table = 'day_user';

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
