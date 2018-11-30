<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ProductColorRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ProductColor';
    }

    function getAll() {
        $value = $this->model->get();
        return $value;
    }
     public function getStore($store){
        return $this->model->where('id_store',$store)

                           ->get();
    }
    public function whereById($id,$store){
        return $this->model->where('id_product',$id)
                           ->where('id_store',$store)

                           ->get();
    }
    public function findID($id_product,$store,$id_color){
        return $this->model->where('id_product',$id_product)
                           ->where('id_store',$store)
                           ->where('id_color',$id_color)
                           ->first();
    }
}