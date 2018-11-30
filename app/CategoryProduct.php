<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';
     public function type() {
        return $this->belongsTo('App\TypeProducts', 'id_type', 'id');
    }
}
