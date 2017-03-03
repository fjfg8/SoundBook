<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    private $id;
    private $comment;
    private $date;
    private $likes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function song(){
        return $this->belongsTo('App\Song');
    }
}
