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

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function user_admin() {
        return $this->belongsTo('App\User');
    }

    
}
