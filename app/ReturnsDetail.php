<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnsDetail extends Model
{
    protected $table='returns_detail';
    public $timestamps = false;
   protected $fillable = [
       'id','id_returns','id_product'
    ];


}