<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
 
    public function songs(){
        return $this->belongsTo('App\Song');
    }

     public function users(){
        return $this->belongsTo('App\User');
    }

}
