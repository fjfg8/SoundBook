<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    private $id;
    private $comment;
    private $date;
    private $likes;
}
