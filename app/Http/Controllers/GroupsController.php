<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\User;

class GroupsController extends Controller {

public function show($id){
        $group = Group::findorFail($id);
        return view('group');
    }


public function showlista() {

        $user = User::find(Auth::user()->id);
        $groups = $user->groups()->paginate(3);
        return view('listagrupos',array('lista'=>$groups));
    }
}