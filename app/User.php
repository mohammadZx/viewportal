<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use \App\Meta\MetaHandler,\App\Options\DateStructure;


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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments(){
        return $this->hasMany('App/Comment', 'user_id');
    }

    public function transactions(){
        return $this->hasMany('App/Transaction', 'user_id');
    }

    public function hasRole($accesses){
        $status = false;
        foreach($accesses as $val){
            if($val == $this->attributes['role']){
                $status = true;
            }
        }
        return $status;
    }
}
