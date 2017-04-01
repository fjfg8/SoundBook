<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Normal extends Account
{
    //
    public function group() {
        return $this->belongsToMany('App\Group');
    }

    public function song() {
        return $this->belongsToMany('App\Song');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }
}
