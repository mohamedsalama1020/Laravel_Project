<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
     protected $fillable = [
        'name',
        'title',
        'hospital_id',
        'gender',
        'medical_profile_id'
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
        ,'pivot'
    ];
    public function hospital(){

        return $this->belongsTo(Hospital::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'doctors_services');
}
}