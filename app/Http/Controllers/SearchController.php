<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;
use App\User;
use App\Type;
use App\Group;

class SearchController extends Controller{

    public function show(){
        $array = array();
        $f = array();
        $filters = [
            "Cancion" => "Cancion",
            "Usuario" => "Usuario",
            "Album" => "Album",
            "Grupo" => "Grupo",
        ];
        return view('searcher',array('busqueda'=>$array,'filtro'=>"cancion",'followers'=>$f,'filters'=>$filters));
    }

    public function search(Request $request){
        $result=array();
        $follow = array();
        $users = array();
        $type = array();

        $filters = [
            "Cancion" => "Cancion",
            "Usuario" => "Usuario",
            "Album" => "Album",
            "Grupo" => "Grupo",
        ];

        if($request->busqueda != ""){
            if($request->filtro=="Grupo"){
                $result = Group::searcher($request);
                $i=0;
                foreach($result as $r){
                    $type[$i] = Type::getType($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Cancion"){
                $result = Song::searcher($request);
                $i=0;
                foreach($result as $r){
                    $users[$i] = User::search($r->user_id);
                    $type[$i] = Type::getType($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Album"){
                $result = Song::searcherAlbum($request);
                $i=0;
                foreach($result as $r){
                    $users[$i] = User::search($r->user_id);
                    $type[$i] = Type::getType($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Usuario"){
                $result = User::searcher($request);
                for($i=0;$i<sizeof($result);$i++){
                    $bool = $this->followers($result[$i]->id);
                    if($bool==true){
                        $follow[$i] = 1;
                    }else{
                        $follow[$i] = 0;
                    }
                }
            }
        }

        session()->put([
            'filtroBusqueda'=> $request->filtro,
        ]);

        return view('searcher',array('busqueda'=>$result,'filtro'=>$request->filtro,'followers'=>$follow,'users'=>$users,'type'=>$type,'filters'=>$filters));
    }

    public function followers($user){
        return User::searchFollowers($user);
    }
}
