<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    protected $table = 'product_store';
    protected $fillable = [
        'id_product', 'id_store', 'number','number_tranf','status','number_error'
    ];

      public function ProductStore() {
        return $this->hasMany('App\Products', 'id_product', 'id');
    }
}
