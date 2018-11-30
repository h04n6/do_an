<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class StoreRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Store';
    }

         public function validateCreate() {
        return $rules = [
            'name' => 'required',            
            'address'=>'required'
        
        ];
    }
     public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',            
            'address'=>'required'
        ];
    }

    public function GetID()
    {
        $store= $this->model->orderBy('id', 'desc')->first();
        $store_id=($store->id +1);
        return  $store_id;
    }

    public function whereById($id,$store){
        return $this->model->where('id_product',$id)
                           ->where('id_store',$store)

                           ->get();
    }

}