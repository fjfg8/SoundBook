<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function create(Request $request, $id){
     $this->validate($request,[
         'comment'=>'required'
     ]);
    
     
    }
}
