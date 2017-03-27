<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function update($id){
     $comment = Comment::find($id);
     $comment->likes++;   
     $comment->save();
    }
}
