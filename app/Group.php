<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    
    public function publication(){
        return $this->hasMany('App\Publication');
    }

    public function user(){
        return $this->belongsToMany('App\User');
    }

    
}
