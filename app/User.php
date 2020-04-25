<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['email', 'permission'];

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
    }
}
