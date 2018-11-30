<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
     protected $table = 'cart_detail';
    protected $fillable = [
       'id_cart', 'id_product',	'price','quantity', 'total'
    ];

      public function cart() {
        return $this->belongsTo('App\Bill' ,'id_cart', 'id');
    }
        public function product() {
        return $this->belongsTo('App\Products', 'id_product', 'id_product');
    }
}
