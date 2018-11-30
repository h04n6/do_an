<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = 'county';
    protected $fillable = [
        'id', 'name'
    ];
    public function customer() {
        return $this->hasMany('App\Customer' ,'id_county', 'id');
    }
    public function city() {
        return $this->belongsTo('App\City', 'id_city', 'id');
    }
}
