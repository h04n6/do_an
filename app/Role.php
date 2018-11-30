<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    
    protected $table='role';
    
    protected $fillable = [
        'id', 'name', 'route'
    ];
    const ROLE_QTV = [2,3,4];
    const ROLE_CUSTOMER = 5;

    public function route() {
        return explode(',', $this->route);
    }
}
