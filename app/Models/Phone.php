<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'code',
        'number',
       
    ];
    protected $hidden = [
        'user_id',
       
    ];

    public function user(){
       return $this->belongsTo(\App\Models\User::class);
    }
}
