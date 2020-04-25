<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'email',
        'password',
        'remember_token',
        'name',
        'phone',
        'address',
        'city',
        'gender',
        'username'
    ];
}
