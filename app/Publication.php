<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    public function group(){
        return $this->belongsTo('App\Group');
    }
}
