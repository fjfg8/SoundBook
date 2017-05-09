<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    
    public function publications(){
        return $this->hasMany('App\Publication');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    
}
