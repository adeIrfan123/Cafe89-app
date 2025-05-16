<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'date_of_birth',
        'gender',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
