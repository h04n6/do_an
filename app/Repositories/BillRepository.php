<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class BillRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Bill';
    }

    function getAll() {
        $value = $this->model->get();
        return $value;
    }

    public function validateCreate() {
        return $rules = [
            'name' => 'required',
            'address' => 'required',
            'address_detail' =>'required',
            'phone' => 'required'
        ];
    }
     public function GetID()
    {
        $bill= $this->model->orderBy('id', 'desc')->first();
        if(is_null($bill))
        {
             $bill_id='DH1001';
        }
        else{
            $bill_id='DH'. ($bill->id +1);
        }
        
        return $bill_id;
    }
    public function whereMonth()
    {
        return $this->model->whereMonth('created_at', date('m'))->get();
    }
    public function whereDay()
    {
        return $this->model->whereDay('created_at', date('d'))->get();
    }
    public function whereYear()
    {
        return $this->model->whereYear('created_at', date('Y'))->get();
    }
    public function whereSearch($search)
    {
        //dd($search);
        $query = $this->model;
        if($search != NULL)
        {
           $start_date= $search['start_date'];
            if(!empty($search['start_date']))
            {
                $query = $query->whereDate('date_order', '>=',date('Y-m-d',strtotime($start_date)));
    
            }
            else {
                $query = $query->whereDate('date_order', date('Y-m-d'));
            }
            $end_date= $search['end_date'];
             if(!empty($end_date))
            {
                $query = $query->whereDate('date_order', '<=' ,date('Y-m-d',strtotime($end_date)));
            }
       
        }
        else {
            $query = $query->whereDate('date_order', date('Y-m-d'));
        }
        
        // dd($search->get('start_date'));
       $bill= $query->orderBy('created_at', 'DESC');
        return $bill;
    }
    

}