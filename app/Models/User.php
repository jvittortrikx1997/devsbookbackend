<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $hidden = ['password', 'token'];

    public function getJWTIdentifer(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
}
