<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    public function userAdmin(){
        return $this->belongsTo('App\Admin');
    }

    public function userNormal(){
        return $this->belongsTo('App\Normal');
    }

    public function song(){
        return $this->belongsTo('App\Song');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }
}
