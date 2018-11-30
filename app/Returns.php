<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
   protected $table='returns';
    
    protected $fillable = [
       'id','id_user','reason','date_returns','status_returns'
    ];
}
