<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipCost extends Model
{
   protected $table = 'ship_cost';

    public function type_ship_cost() {
        return $this->belongsTo('App\TypeShipCost', 'cost', 'id');
    }
}
