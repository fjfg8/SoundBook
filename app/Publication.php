<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    public function groups(){
        return $this->belongsTo('App\Group');
    }

    public function songs(){
        return $this->belongsTo('App\Song');
    }
}
