<?php

namespace App\Models;

//use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, HasFactory, SoftDeletes ,HasRoles;

    public $table = 'users';

    public $fillable = [
        'id',
        'first_name',
        'last_name',
        'profile_picture',
        'username',
        'email',
        'phone_code',
        'phone_number',
        'role',
        'status'
    ];
    // protected $hidden = ['password'];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function business_users()
    {
        return $this->hasOne('App\Models\BusinessUsers','id','user_id');
    }

    public function followers()
    {
        return $this->hasOne('App\Models\UserFollowers','id','user_id');
    }

    public function subcribe_users(){
        return $this->belongsTo(User::class);
    }
}
