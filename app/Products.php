<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id','id_product', 'name', 'id_type','description','gender','import_price', 'price', 'promotion_price','image','new','hot','id_manufacturer'
    ];
     public function type() {
        return $this->belongsTo('App\TypeProducts', 'id_type', 'id');
    }

     public function ProductStore() {
        return $this->belongsTo('App\ProductStore', 'id_product', 'id');
    }
    public function productDetail() {
        return $this->hasMany('App\ProductStore', 'id_product', 'id');
    }
    public function productImages() {
        return $this->hasMany('App\ProductStore', 'id_product', 'id_product');
    }
     public function ProductSize() {
        return $this->belongsTo('App\ProductSize', 'id_product', 'id');
    }
      public function ProductColor() {
        return $this->belongsTo('App\ProductColor', 'id_product', 'id');
    }
    public function manufacturer() {
        return $this->belongsTo('App\Manufacture', 'id_manufacturer', 'id');
    }
}
