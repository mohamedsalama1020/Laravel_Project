<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $fillable = [
        'id',
        'name',
       
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'doctors_services');
    }
}
