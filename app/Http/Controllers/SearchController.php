<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;
use App\User;
use App\Type;

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
                $result = DB::table('groups')->where('name','like','%'.$request->busqueda.'%')->paginate(3);
                $i=0;
                foreach($result as $r){
                    $type[$i] = Type::find($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Cancion"){
                $result = DB::table('songs')->where('title','like','%'.$request->busqueda.'%')->paginate(3);
                $i=0;
                foreach($result as $r){
                    $users[$i] = User::find($r->user_id);
                    $type[$i] = Type::find($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Album"){
                $result = DB::table('songs')->where('album','like','%'.$request->busqueda.'%')->paginate(3);
                $i=0;
                foreach($result as $r){
                    $users[$i] = User::find($r->user_id);
                    $type[$i] = Type::find($r->type_id);
                    $i++;
                }
            }
            if($request->filtro == "Usuario"){
                $result = DB::table('users')->where('nick','like','%'.$request->busqueda.'%')->paginate(3);
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
        $res = DB::table('user_user')->where('user_id1','=',Auth::user()->id)->where('user_id2','=',$user)->count();
        if($res!=0){
            return true;
        }else{
            return false;
        }
    }
}
