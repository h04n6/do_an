<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartSave extends Model
{
	 protected $table = 'cart';
     protected $fillable = [
       	'id',	'id_user',	'id_code',	'total_cart'
    ];

      public function cartDetail() {
        return $this->hasMany('App\CartDetail' ,'id_cart', 'id');
    }
        public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
