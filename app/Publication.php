<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function create($request, $group, $user) {
        $this->title = $request->titulo;
        $this->description = $request->publicacion;
        $this->group()->associate($group);
        $this->user()->associate($user);

        $this->save();
    }

    public static function edit($request) {
        $p = Publication::find($request->publication_id);
        $p->title = $request->titulo;
        $p->description = $request->publicacion;
        $p->save();
    }

    public static function borrar($request) {
        $publication = Publication::find($request->publication_id);
        $publication->delete();
    }
}
