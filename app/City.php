<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'id', 'name'
    ];
     public function customer() {
        return $this->hasMany('App\Customer' ,'id_city', 'id');
    }
        public function county() {
        return $this->hasMany('App\County', 'id_county', 'id');
    }
}
