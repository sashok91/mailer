<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_ROLE_ADMIN = 'admin';
    const USER_ROLE_SUBSCRIBER = 'subscriber';

    protected $table = 'user';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function isAdmin(){
        return $this->role === self::USER_ROLE_ADMIN;
    }

    public function isSubscriber(){
        return $this->role === self::USER_ROLE_SUBSCRIBER;
    }
}
