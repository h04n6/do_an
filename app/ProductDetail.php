<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_detail';
    protected $fillable = [
        'id','id_product', 'id_store', 'id_color','id_size','quantity'
    ];

    public function size() {
        return $this->belongsTo('App\Size', 'id_size', 'id');
    }
}
