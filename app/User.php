<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use App\Account;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick', 'name', 'email', 'password', 'isAdmin', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


   /* private $id;
    private $email;
    private $password;
    private $gender;
    private $status;
    private $preferences;
    private $admin;*/

   public function songs(){
        return $this->hasMany('App\Song');
    }
   public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function groups(){
        return $this->belongsToMany('App\Group');
    }

    public function users(){
        return $this->belongsToMany('App\User','user_user','user_id1','user_id2');
    }

    public function songs_likes(){
        return $this->belongsToMany('App\Song','song_user','song_id','user_id');
    }

    public function comments_likes(){
        return $this->belongsToMany('App\Comment','comment_user','comment_id','user_id');
    }

    public function admin_groups(){
        return $this->hasMany('App\Group');
    }   

    public function publications() {
        return $this->hasMany('App\Publication');
    }

    public static function getAll(){
        return User::select('*')->paginate(4);
    }

    public static function getSongs($user){
        return $user->songs()->paginate(4);
    }
    public static function getFollow($user){
        return $user->users;
    }
    public static function getFollowers($user){
        return DB::table('user_user')->where('user_id2',$user->id)->get();
    }

    public static function makeAdmin($id){
        $user = User::search($id);
        $user->isAdmin = true;
        $user->save();
    }

    public static function removeAdmin($id){
        $user = User::search($id);
        $user->isAdmin = false;
        $user->save();
    }
    public static function search($id){
        return User::find($id);
    }
    public static function followProfile($id){
        $res = DB::table('user_user')->where('user_id1','=',Auth::user()->id)->where('user_id2','=',$id)->count(); 
        if($res==1){
            return true;
        }else{
            return false;
        }
    }

    public static function follow($id){
        $res = DB::table('user_user')->where('user_id1','=',$id)->count();
        return $res;
    }
    public static function followers($id){
        $res = DB::table('user_user')->where('user_id2','=',$id)->count();
        return $res;
    }

    public static function changePass($user,$pass){
        $user->password = bcrypt($pass);
        $user->save();
    }
    public static function edit($request){
        $user = User::search($request->id);          
    

        if($request->has('nick')){
            $user->nick = $request->nick;
        }

        if($request->has('name')){
            $user->name = $request->name;            
        }

        if($request->has('email')){
            $user->email = $request->email;
        }

        if($request->has('gender')){
            $user->gender = $request->gender;
        }

        if($request->has('status')){
            $user->status = $request->status;
        }

        if($request->has('preferences')){
            $user->preferences = $request->preferences;
        }

        $user->save();
    }
    public static function borrar($id){
        $s = User::search($id);
        $s->delete();

    }

    public static function makeFollow($id){
        $user1 = Auth::user();
        $user2 = User::search($id);

        $user1->users()->attach($user2->id);
    }

    public static function makeUnfollow($id){
        $user1 = Auth::user();
        $user2 = User::find($id);

        $result = DB::table('user_user')->where('user_id1','=',$user1->id)->where('user_id2','=',$user2->id);

        $result->delete();
    }

    public static function changeImage($image){
        $user = User::find(Auth::user()->id);
        $user->image = $image;
        $user->save();

    }

    public static function publicaciones(){
        $user = User::search(Auth::user()->id);

        $others = $user->users; 
        $songs = $user->songs;
        
        foreach($others as $o){
            $aux = $o->songs;
            $songs = $songs->merge($aux);
        }
        $aux2 = $songs->sortByDesc('created_at');

        return $aux2;
    }

    public static function getGroups($user) {
        return $user->groups()->paginate(3);
    }
}
