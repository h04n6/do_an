<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bill;
use App\BillDetail;
use App\Products;
use App\Store;
use App\ProductStore;

class BackendController  extends Controller
{
  
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bill=Bill::whereDate('date_finish',date('Y-m-d'))->get();
    	$id_bill = array();
    	foreach ($bill as $key => $value) {
    		$id_bill[]=$value->id_bill;
    	}
    	$products=Products::all();
    	$prd_st=ProductStore::all();
    	$total_prd_st=0;
    	foreach ($prd_st as $key => $value) {
    		$total_prd_st+=$value->number;
    	}
    	$total_bill=0;
    	foreach ($bill as $key => $value) {
    		$total_bill +=$value->total_bill;
    	}
    	$prd_sale=BillDetail::whereIn('id_product',$id_bill)->get();
    	$qty_saled_pd=0;
    	foreach ($prd_sale as $key => $value) {
    		$qty_saled_pd+=$value->quntity;
    	}
    	$out_off_stock=count(ProductStore::where('number',0)->get());
    	$out_off_stock2=count(ProductStore::where('number',15)->get());



        return view('backend/index',compact('bill','products','total_bill','total_prd_st','out_off_stock','out_off_stock2','qty_saled_pd'));
    }


}