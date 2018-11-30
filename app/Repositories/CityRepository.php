<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class CityRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\City';
    }

    function getAll() {
        $custom = $this->model->get();
        return $custom;
    }

    public function whereName($name)
    {
        return $this->model->where('name',$name)->first();
    }
    

}