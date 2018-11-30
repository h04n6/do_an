<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProducts extends Model
{
     protected $table = 'type_product';
      protected $fillable = [
        'id', 'name'
    ];
}
