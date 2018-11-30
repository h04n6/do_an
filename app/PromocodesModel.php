<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromocodesModel extends Model
{
     protected $table='promocodes';
     public $timestamps = false;
    protected $fillable = [
	'code',
	'cash',
	'percent',
  	'is_used',
  	'created_at',
  	'expiration_date'
	];
   public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}