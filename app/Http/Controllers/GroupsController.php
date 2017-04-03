<?php

namespace App\Http\Controllers;
use App\Group;

class GroupsController extends Controller {

public function show($id){
        $group = Group::findorFail($id);
        return view('group');
    }


public function showlista($id) {
        
        $groups = members::where('song_id','=',$id)->orderby('created_at','desc')->paginate(3);
        return view('group');
    }
}