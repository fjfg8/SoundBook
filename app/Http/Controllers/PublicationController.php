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
        $p->title = $request->titulo;
        $p->description = $request->publicacion;
        $p->group()->associate($group);
        $p->user()->associate($user);

        $p->save();

        return redirect()->action('GroupsController@show',$request->group);
    }

    public function edit(Request $request){
        $this->validate($request,[
            'titulo'=>'required',
            'publicacion'=>'required',
        ]);

        $p = Publication::find($request->publication_id);
        $p->title = $request->titulo;
        $p->description = $request->publicacion;
        $p->save();

        return redirect()->action('GroupsController@show',$request->group);
    }

    public function delete(Request $request){
        $publication = Publication::find($request->publication_id);
        $publication->delete();

        return redirect()->back();
    }
}