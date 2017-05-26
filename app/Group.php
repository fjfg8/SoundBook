<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    //
    
    public function publications(){
        return $this->hasMany('App\Publication');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function user_admin() {
        return $this->belongsTo('App\User');
    }

    public static function search($id) {
        return Group::find($id);
    }

    public function getMembers() {
        return $this->users()->count();
    }

    public function getPublications() {
        return $this->publications()->orderby('created_at','desc')->paginate(3);
    }

    public static function getFiltrados() {
        return Group::where('type_id','=',session()->get('filtroGrupos'))->orderby('name')->paginate(3);
    }

    public static function getOrdenados() {
        return Group::orderby('name')->paginate(3);
    }

    public function create($request, $user) {
        $this->name = $request->name;
        $type = Type::getTypeStyle($request->musicStyle);
        $this->type()->associate($type);
        $this->user_admin()->associate($user);
        $this->description = $request->description;
        $this->save();
        $this->users()->attach($user->id);
    }

    public function edit($request) {
        if($request->has('name')){
            $this->name = $request->name;
        }

        if($request->has('musicStyle')){
            $this->type_id = $request->musicStyle;            
        }

        if($request->has('description')){
            $this->description = $request->description;
        }

        $this->save(); 
    }

    public static function getSuscription($user, $group) {
        return DB::table('group_user')->where('user_id','=',$user->id)->where('group_id','=',$group);
    }

    public static function borrar($request) {
        $group = Group::search($request->group);
        $group->delete();
    }
    
}
