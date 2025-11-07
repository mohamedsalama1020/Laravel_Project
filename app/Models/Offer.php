<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'price',
        'details_en',
        'details_ar',
        'image',
        'status'
        
    ];
            //local scope 
    /*public function scopeActive($query){ 
        return $query->where(['status'=>1,'name_en'=>'offer1']);

    }*/
        // glbal scope
     /*protected static function booted(): void
    {
        static::addGlobalScope(new OfferScope);
    }*/

    //  accessors 
    public function getStatusAttribute($value){
       return $value == 0 ? 'inactive' : 'active';


    }

    // mutators
    public function setNameENAttribute($value){
       $this -> attributes['name_en']= strtoupper($value);


    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
