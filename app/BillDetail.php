<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';
    protected $fillable = [
       'id_bill', 'id_product',	'price','quantity', 'total','product_info','id_store'
    ];
     public function bill() {
        return $this->belongsTo('App\Bill' ,'id_bill', 'id');
    }
    public function product() {
        return $this->belongsTo('App\Products', 'id_product', 'id_product');
    }
}
