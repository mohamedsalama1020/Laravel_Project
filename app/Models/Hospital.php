<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
     protected $fillable = [
        'name',
        'address',
        'country_id'

        
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function doctors(){

        return $this->hasMany(Doctor::class);
    }
}
