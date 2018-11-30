<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $table = 'customer';
       protected $fillable = [
        'id', 'name' ,'email', 'provider', 'provider_id' 
    ];


      public function city() {
        return $this->belongsTo('App\City', 'id_city', 'id');
    }
      public function county() {
        return $this->belongsTo('App\County' , 'id_county', 'id');
    }
      public function ward() {
        return $this->belongsTo('App\Ward', 'id_ward', 'id');
    }

      public function created_at() {
        return date( "d/m/Y H:i", strtotime($this->created_at));
    }
     public function phone() {
        return '0'.$this->phone;
    }
}
