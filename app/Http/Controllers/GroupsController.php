<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Type;
use App\Publication;

class GroupsController extends Controller {

public function show($id){
        $group = Group::search($id);
        $type = Type::getType($group->type_id);
        $members = $group->getMembers();
        $publication = $group->getPublications();
        $users = User::getAll();
        $groups = User::getGroups(Auth::user());
        return view('group', array('group'=>$group, 'type'=>$type, 'members'=>$members, 'publications'=>$publication, 'users'=>$users, 'groups'=>$groups));
    }


public function showlista() {

        $user = User::search(Auth::user()->id);
        $groups = User::getGroups($user);
        $type = Type::getTypes();
        return view('listagrupos',array('lista'=>$groups, 'types'=>$type, 'user'=>$user));
    }

public function showAll() {

        $user = User::search(Auth::user()->id);
        if(session()->has('filtroGrupos')){
            if(session()->get('filtroGrupos') == "-1"){
                $all = Group::getOrdenados();
            }else{
                $all = Group::getFiltrados();
            }
        }else{
            $all = Group::getOrdenados();
        }
        $groups = User::getGroups($user);
        $type = Type::getTypes();
        return view('allGroups', array('all'=>$all, 'types'=>$type, 'groups'=>$groups, 'user'=>$user));
}


public function create(Request $request) {

    $this->validate($request,[
        'name'=>'required',
        'musicStyle'=>'required',
        'description'=>'required',
    ]);

    $group = new Group();
    $user = User::search(Auth::user()->id);
    $group->create($request, $user);

    //$group->save();

    return redirect()->action('GroupsController@showlista');
}

public function edit(Request $request){
        $group = Group::search($request->id);

        $group->edit($request);     
        
        return redirect()->back();
}


public function subscribe(Request $request) {

        $user = User::search(Auth::user()->id);
        $user->groups()->attach($request->group);

        return redirect()->back();
    }

public function cancelSubscribe(Request $request){
        $user = Auth::user();
        $group = $request->group;

        $result = Group::getSuscription($user, $group);

        $result->delete();

        return redirect()->back();
    }

public function members($id) {

        $group = Group::search($id);
        $users = $group->users()->paginate(3);

        return view('members', array('users'=>$users, 'group'=>$group));
    }

public function deleteGroup(Request $request){

        Group::borrar($request);

        return redirect()->back();
    }

    public function search(Request $request){
        $request->session()->put([
            'filtroGrupos'=>$request->filtro
        ]);

        return redirect()->action('GroupsController@showAll');
    }

}