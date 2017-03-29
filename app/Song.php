<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /*private $id;
    private $title;
    private $artist;
    private $duration;
    private $gender;
    private $date;*/

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comment(){
        return $this->hasMany('App\Comment');
    }


}
