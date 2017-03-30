<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    public function user(){
        return $this->hasOne('App\User');
    }
}

class Normal extends Account {


}

class Admin extends Account {


    
}




