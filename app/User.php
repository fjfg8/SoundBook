<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    private $id;
    private $email;
    private $password;
    private $gender;
    private $status;
    private $preferences;
    private $admin;

    public function song(){
        return $this->hasMany('App\Song');
    }
    
    public function comment(){
        return $this->hasOne('App\Comment');
    }
  
}
