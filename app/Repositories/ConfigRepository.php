<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ConfigRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Config';
    }
    public function detail(){
        return $this->model->get();
    }
    public function validateUpdate() {
        return $rules = [
            'title' => 'required'
        ];
    }

    public function first() {
        return $this->model->first();
    }
    

}
