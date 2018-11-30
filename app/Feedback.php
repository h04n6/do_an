<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
      protected $table = 'feedback';
       protected $fillable = [
       'id','id_user','virtual_name','id_product','content','star','date'
    ];
    public function product() {
        return $this->belongsTo('App\Products', 'id_product', 'id_product');
    }
}
