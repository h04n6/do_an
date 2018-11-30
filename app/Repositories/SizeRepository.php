<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class SizeRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Size';
    }

    function getAllProducts() {
        $type = $this->model->get();
        return $type;
    }
     public function validateCreate() {
        return $rules = [
            'name' => 'required'        

        ];
    }

}