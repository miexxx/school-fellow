<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tanmo\Search\Traits\Search;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable,Search;
    private $sex=[
        '1'=>'男',
        '2'=>'女'
    ];

    public function getGenderAttribute($value)
    {
        return $this->sex[$value];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    public function openId(){
        return $this->hasOne(UserAuthWechat::class);
    }

    public function userSchool(){
        return $this->hasOne(UserSchool::class);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
}
