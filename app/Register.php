<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
   protected $table='register';
    
    protected $fillable = [
        'email'
    ];
}
