<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'id','id_product', 'id_color', 'image'
    ];
    public function color() {
        return $this->belongsTo('App\Color', 'id_color', 'id');
    }

}
