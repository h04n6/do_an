<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'size';

 protected $fillable = ['id','id_store','id_product','id_size','number'
    ];
     public function size() {
        return $this->belongsTo('App\Size', 'id_size', 'id');
    }
}
