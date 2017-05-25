<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Publication;
use App\Group;
use App\User;

class PublicationController extends Controller
{
    public function create(Request $request){
        $this->validate($request,[
            'titulo'=>'required',
            'publicacion'=>'required',
        ]);

        $group = Group::search($request->group);
        $user = User::search(Auth::user()->id);
        $p = new Publication();
        $p->create($request, $group, $user);

        return redirect()->action('GroupsController@show',$request->group);
    }

    public function edit(Request $request){
        $this->validate($request,[
            'titulo'=>'required',
            'publicacion'=>'required',
        ]);

        Publication::edit($request);

        return redirect()->action('GroupsController@show',$request->group);
    }

    public function delete(Request $request){
        Publication::borrar($request);
        
        return redirect()->back();
    }
}