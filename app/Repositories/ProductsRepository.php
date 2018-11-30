<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ProductsRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Products';
    }

   public function getAllProductsInStore($request) {

        $product =  $this->model->join('product_store','products.id_product','=','product_store.id_product')->get();

         if(empty($request->get('id_store')))
         {
            $product =   $product ->where('id_store',1);
         }
         else {
            $product =   $product ->where('id_store','=',$request->get('id_store'));

         }

        return $product;
    }
    public function getAll()
    {
        return $this->model->orderBy('id', 'ASC')->get();
    }
     public function editProduct($id_product,$id_store) {
        //->select('products.*', 'product_store.number')
        $product =  $this->model->join('product_store','products.id_product','=','product_store.id_product')->get();
              
         $product =   $product->where('id_store',$id_store)->where('id_product',$id_product)->first();
    
        return $product;
    }

     
      public function validateCreate() {
        return $rules = [
            'name' => 'required',            
            'id_color'=>'required',
            'description'=>'required',
            'import_price'=>'required',
            'price'=>'required'
        
        ];
    }


     public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
            'description'=>'required',
            'price'=>'required'
        ];
    }
    
      public function changeStatus($id, $field) {

        $model = $this->model->where('id_product',$id)->first();
        $this->model->where('id_product', '=', $id)->update([$field => (string)(1 - ($model->$field))]);
        return true;
    }
     function deleteGroup($group) {
        if (in_array(0, $group)) {

            $eng = $this->model->whereNotIn('id', $group);
            $english_detail = $this->model->all();
            $eng->delete();
        } else {
            $check = true;

            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }

            if ($check == false) {
                $eng = $this->model->whereNotIn('id', $group);
            } else {
                $eng = $this->model->whereIn('id', $group);
                foreach ($group as $key => $value) {
                    $eng = $this->model->find($value);
                    $eng->delete();
                }
            }
        }
    }
    public function GetID()
    {
        $product= $this->model->orderBy('id', 'desc')->first();
        $product_id='SP'. ($product->id +1);
        return $product_id;
    }

    public function search($search)
    {  
         $query=$this->model->select('products.*','products.id as product_stt','products.id_product as product_id','manufacturer.id as manufacturer_id','products.name as product_name' ,'manufacturer.name as manufacturer_name')
        //  ->join('manufacturer', function ($join ) use ($search)
        //  {
            
        //     $join->on('products.id_manufacturer', '=', 'manufacturer.id')
        //          ->where('manufacturer.name', 'LIKE', "%" . $search['txtsearch']. "%")
        //          ->orWhere('products.name', 'LIKE', "%" . $search['txtsearch'] . "%");
        // })->get();
         ->join('manufacturer','products.id_manufacturer','=','manufacturer.id');
        if($search['search_param']=='all')
        {
        $query=$query->where('products.name', 'LIKE', "%" . $search['txtsearch'] . "%")
                    ->orWhere('manufacturer.name', 'LIKE', "%" . $search['txtsearch'] . "%");
        }
        else{
            $query=$query->where('id_type', $search['search_param'])
                ->where(function ($qr) use($search) {
                    $qr->where('products.name', 'LIKE', "%" . $search['txtsearch'] . "%")
                    ->orWhere('manufacturer.name', 'LIKE', "%" . $search['txtsearch'] . "%");
            });
            
        }
        return $query->paginate(6);


    }
    public function search_price($min,$max,$arr_type,$arr_manufacturer)
    {
        $query=$this->model;
        if(empty($max))
        {
            $query=$query->whereIn('id_type',$arr_type)                        
                        ->whereIn('id_type',$arr_manufacturer)->get();
        }
        else{
             $query=$query->whereBetween('price', [$min, $max])
                        ->whereIn('id_type',$arr_type)
                        ->whereIn('id_type',$arr_manufacturer)->get();
        }

            return $query;


    }

    

}