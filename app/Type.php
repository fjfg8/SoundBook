<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function songs(){
        return $this->hasMany('App\Song');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public static function getTypes(){
        return Type::all();
    }

    public static function getType($id) {
        return Type::where('id','=',$id)->first();
    }

    public static function getTypeStyle($style) {
        return Type::where('type','=',$style)->first();
    }
}
