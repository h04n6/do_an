<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
       	'id_bill','id_user','id_code','ship_cost','total_bill','recive_address','reciver','phone','id_shipper','status_order','date_order','date_finish','payment_method','coupon'
    ];
     public function billDetail() {
        return $this->belongsTo('App\BillDetail' ,'id_bill', 'id_bill');
    }
        public function user() {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function shipper() {
        return $this->belongsTo('App\Shippers', 'id_shipper', 'id');
    }
      public function created_at() {
        return date( "d/m/Y H:m", strtotime($this->created_at));
    }
      public function get_time() {
      	 date_default_timezone_set('Asia/Ho_Chi_Minh');
        return date( "H:m", strtotime($this->created_at));
    }
      public function status() {
        return $this->belongsTo('App\Status_order', 'status_order', 'id');
    }
}
