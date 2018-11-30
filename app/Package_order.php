<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package_order extends Model
{
    protected $table = 'package_order';
    protected $fillable = [
       'id','id_bill',	'package_staff','export_staff','shipper',	'payment_method',	'date_package',	'date_finish',	'date_cancel'
    ];

     public function bill() {
        return $this->hasOne('App\Bill', 'id_bill', 'id_bill');
    }
    public function package() {
        return $this->belongsTo('App\Staff','package_staff','id');
    }
    public function export() {
        return $this->belongsTo('App\Staff','export_staff','id');
    }
    public function ship() {
        return $this->belongsTo('App\Staff','shipper','id');
    }

}
