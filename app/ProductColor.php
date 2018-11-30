<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'color';
 protected $fillable = ['id','id_store','id_product','id_color','number'
    ];
     public function color() {
        return $this->belongsTo('App\Color', 'id_color', 'id');
    }
}
