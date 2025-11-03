<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
        
    ];

    protected $hidden = [
        'password',
    ];
}
