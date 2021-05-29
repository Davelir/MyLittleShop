<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const MIN_LOGIN_LENGTH = 3;
    const MAX_LOGIN_LENGTH = 16;
    const MIN_PASSWORD_LENGTH = 8;

    const LEVEL_CLIENT = 0;
    const LEVEL_ADMIN = 1;

    const ADMIN_LEVELS = [
        0 => "Klient",
        1 => "Administrator",
    ];

    public function isAdmin(){
        return $this->admin_level == self::LEVEL_ADMIN;
    }

    public function getAdminLevelText(){
        return self::ADMIN_LEVELS[$this->admin_level];
    }

}
