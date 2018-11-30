<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
      protected $table = 'manufacturer';
       protected $fillable = [
        'id', 'name'
    ];
}
