<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ProductStoreRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ProductStore';
    }

    function getAll() {
        $value = $this->model->get();
        return $value;
    }

     public function whereById($id,$store){
        return $this->model->where('id_product',$id)->where('id_store',$store)->first();
    }
    public function validateCreateInStore() {
        return $rules = [
           
            'quantity'=>'required'
        
        ];
    }
     public function validateCreateUni($store, $id_product) {
        $subj = $this->model->where('id_store', '=', $store)->where('id_product', '=', $id_product)->first();
        if (!is_null($subj)) {
            return false;
        } else {
            return true;
        }
    }
    

}