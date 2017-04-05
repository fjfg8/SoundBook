<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Group;

class GroupsController extends Controller {

public function show($id){
        $group = Group::findorFail($id);
        return view('group');
    }


public function showlista() {

        $id = session()->get('id');
        //$groups = members::where('song_id','=',$id)->orderby('created_at','desc')->paginate(3);
        $groups = DB::table('group_user')
        ->join('groups','group_user.group_id','=','groups.id')
        ->join('users','group_user.user_id','=',$id)
        ->select('groups.*')->paginate(3);
        return view('listagrupos',array('lista'=>$groups));
    }
}