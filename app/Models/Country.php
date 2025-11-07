<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     protected $fillable = [
        'name',
  
    ];

    public function doctors(){
        return $this->hasManyThrough(Doctor::class,Hospital::class);
    }
}
