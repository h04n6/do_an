<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ManufacturerRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Manufacture';
    }
    public function validateCreate() {
        return $rules = [
            'name' => 'required|unique:manufacturer'            
        
        ];
    }
     public function validateUpdate($id) {
        return $rules = [
             'name' => 'required'            
        ];
    }

}