<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'my_product';
  protected $fillable = [
        'id','id_product','id_user','id_size','id_color','image'
    ];

     public function product() {
        return $this->belongsTo('App\Products','id_product','id_product');
    }
    public function color() {
        return $this->belongsTo('App\Color','id_color','id');
    }
    public function size() {
        return $this->belongsTo('App\Size','id_size','id');
    }
}
