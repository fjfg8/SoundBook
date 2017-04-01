<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function userAdmin() {
        return $this->belongsToMany('App\Admin');
    }

    public function userNormal() {
        return $this->belongsToMany('App\Normal');
    }

    public function song() {
        return $this->belongsToMany('App\Song');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }
}
