<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function userAdmin(){
        return $this->belongsToMany('App\Admin');
    }

    public function userNormal() {
        return $this->belongsToMany('App\Normal');
    }
    
    public function comment(){
        return $this->hasMany('App\Comment');
    }

     public function group() {
    return $this->belongsToMany('App\Group');
    }
}
