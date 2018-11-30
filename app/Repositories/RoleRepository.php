<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class RoleRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Role';
    }

    function getAllRole() {
        $roles = $this->model->where('id', '<>', 1)->get();
        return $roles;
    }

    protected $table='role';
    
    protected $fillable = [
        'id', 'name', 'route'
    ];
    const ROLE_QTV = [2,3,4,5];
    const ROLE_CUSTOMER = 6;

    public function route() {
        return explode(',', $this->route);
    }

}
