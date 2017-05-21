<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Publication;
use App\Group;

class PublicationController extends Controller
{
    public function create(Request $request){
        $this->validate($request,[
            'titulo'=>'required',
            'publicacion'=>'required',
        ]);

        $group = Group::find($request->group);
        //$user = User::find(Auth::user()->id);
        $p = new Publication();
        $p->title = $request->titulo;
        $p->publication = $request->publicacion;
        $p->group()->associate($group);
        //$p->song()->associate($song);

        $p->save();

        return redirect()->action('GroupsController@show',$request->group);
    }
}