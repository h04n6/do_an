<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ProductDetailRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ProductDetail';
    }

    public function getall()
    {
    	return $this->model->orderBy('id','ASC');
    }
    public function getSize($id_color,$id_product)
    {
    	return $this->model->where('id_product',$id_product)
                           ->where('id_color',$id_color)
                           ->orderBy('id_size','ASC')->get();
    }
}