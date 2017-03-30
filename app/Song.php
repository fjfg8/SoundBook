<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function comment(){
        return $this->hasMany('App\Comment');
    }

     public function group() {
    return $this->belongsToMany('App\Group');
    }
}
