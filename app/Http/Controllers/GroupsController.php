<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Type;

class GroupsController extends Controller {

public function show($id){
        $group = Group::findorFail($id);
        return view('group', array('group'=>$group));
    }


public function showlista() {

        $user = User::find(Auth::user()->id);
        $groups = $user->groups()->paginate(3);
        $type = Type::all();
        return view('listagrupos',array('lista'=>$groups, 'types'=>$type, 'user'=>$user));
    }

public function showAll() {

        $user = User::find(Auth::user()->id);
        $groups = DB::table('groups')->paginate(3);
        $type = Type::all();
        return view('allGroups', array('all'=>$groups, 'types'=>$type, 'user'=>$user));
}


public function create(Request $request) {

        $this->validate($request,[
            'name'=>'required',
            'musicStyle'=>'required',
            'description'=>'required',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $type = Type::where('type','=',$request->musicStyle)->first();
        $group->type()->associate($type);
        $group->description = $request->description;
        $group->save();
        $user = User::find(Auth::user()->id);
        $group->users()->attach($user->id);

        //$group->save();

        return redirect()->action('GroupsController@showlista');
    }
}