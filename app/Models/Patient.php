<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'id',
        'name',
        'age'
        
    ];

    public function doctor(){
        return $this->hasOneThrough(Doctor::class,Medical_profile::class); 
    }
}
