<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class CountyRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\County';
    }

    function getAll() {
        $value = $this->model->get();
        return $value;
    }
    

}