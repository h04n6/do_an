<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
  protected $table = 'ward';
  protected $fillable = [
        'id', 'name'
    ];
   public function customer() {
        return $this->hasMany('App\Customer' ,'id_ward', 'id');
    }
}
