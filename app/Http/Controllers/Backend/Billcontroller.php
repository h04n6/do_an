<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\BillRepository;
use Repositories\BillDetailRepository;
use Repositories\CustomerRepository;
use PDF;
use Session;
use App\Staff;
use App\Staff_type;
use App\ShipCost;
use App\Package_order;
use App\ProductStore;
use App\BillDetail;
use App\Bill;
use App\ProductDetail;
use App\Size;
use App\City;
class Billcontroller extends Controller
{

	  public function __construct(BillDetailRepository $BillDetailRepo, BillRepository $BillRepo,CustomerRepository $CustomerRepo)
	{
		  $this->BillDetailRepo = $BillDetailRepo;
          $this->BillRepo = $BillRepo;
          $this->CustomerRepo = $CustomerRepo;
	}
 	public function index(Request $request) {
       
        $bill = $this->BillRepo->all();
        $count=$bill->where('status_order','=','1')->count();
        return view('backend/bill/index', compact('bill','count'));
    }
    public function index1(Request $request) {
       
        $bills = $this->BillRepo->all();
        $bill=$bills->where('status_order','=','1');
        $count=$bill->count();
        
        return view('backend/bill/index', compact('bill','count'));
    }
    public function index2(Request $request) {
       
        $bills = $this->BillRepo->all();
        $count=$bills->where('status_order','=','1')->count();
        $bill=$bills->where('status_order','=','2');
        return view('backend/bill/index', compact('bill','count'));
    }
    public function index3(Request $request) {
       
        $bills = $this->BillRepo->all();
        $count=$bills->where('status_order','=','1')->count();
        $bill=$bills->where('status_order','=','3');
        return view('backend/bill/index', compact('bill','count'));
    }
    public function index4(Request $request) {
       
         $bills = $this->BillRepo->all();
          $count=$bills->where('status_order','=','1')->count();
        $bill=$bills->where('status_order','=','4');
        return view('backend/bill/index', compact('bill','count'));
    }
    public function index5(Request $request) {
       
        $count=Bill::where('status_order','=','1')->count();
        $bill=Bill::where('status_order','=','6')
                ->orWhere('status_order','=','7')->get();
        return view('backend/bill/index', compact('bill','count'));
    }

    public function detail(Request $request, $id)
    {
    	$bills = $this->BillRepo->all()->where('id_bill',$id)->first();

    	$billdt=$this->BillDetailRepo->all()->where('id_bill','=',$id);
        $package_staff=Staff::where('staff_type',1)->get();
        $export_staff=Staff::where('staff_type',2)->get();
        $shipper=Staff::where('staff_type',3)->get();

        date_default_timezone_set('Asia/Ho_Chi_Minh');
    // $startTime = date("Y-m-d H:i:s");//khởi tạo
    // $cenvertedTime = date('Y-m-d H:i:s',strtotime('+2 day',strtotime($startTime)));
    // dd($cenvertedTime);
    	return view('backend/bill/detail', compact('bills','billdt','package_staff','export_staff','shipper'));
    }
    public function accept_bill($id)
    {
        $bills = $this->BillRepo->all()->where('id_bill',$id)->first();
        $stt['status_order']= $bills->status_order + 1;
        $this->BillRepo->update($stt,$bills->id);
        $billdt=$this->BillDetailRepo->all()->where('id_bill','=',$id);
        foreach ($billdt as $key => $value) {
            $update_number=ProductStore::where('id_store',$value->id_store)->where('id_product',$value->id_product)->first();
            $get_num_tranf=$update_number->number_tranf;
            ProductStore::where('id_store',$value->id_store)->where('id_product',$value->id_product)
                        ->update(['number_tranf'=> $get_num_tranf + $value->quantity]);
        }
         
        Session::flash('success','Duyệt đơn hàng thành công!');
        return redirect()->back();
    }
    public function cancel_bill($id)
    { 
        $bills = $this->BillRepo->all()->where('id_bill',$id)->first();
        $stt['status_order']=7;
        $this->BillRepo->update($stt,$bills->id);
        return redirect()->back()->with('success', 'Đã hủy đơn hàng!');
    }
    public function package_order(Request $request,$id)
    {
        $input=$request->all();
        
        $bills = $this->BillRepo->all()->where('id_bill',$id)->first();
        $stt['status_order']= 3;
        $this->BillRepo->update($stt,$bills->id);
        $input['id_bill']= $id;
        $input['payment_method']= $bills->payment_method;
        $input['date_package']= date('Y/m/d');
        Package_order::create($input);
        return redirect()->back();
    }
     public function finish_order($id)
    {
        $bills = $this->BillRepo->all()->where('id_bill',$id)->first();

        $product=BillDetail::where('id_bill',$id)->get();
        foreach ($product as $key => $value) {
            $size=trim(substr($value->product_info, -2));
            
            $get_id_size=Size::where('size_name',$size)->first();

            $prd_detail=ProductDetail::where('id_product',$value->id_product)
                                ->where('id_store',$value->id_store)
                                ->where('id_size',$get_id_size->id)->first();
            ProductDetail::where('id_product',$value->id_product)
                                ->where('id_store',$value->id_store)
                                ->where('id_size',$get_id_size->id)
                                ->update(['quantity'=>$prd_detail->quantity - $value->quantity]);                    
           $store= ProductStore::where('id_product',$value->id_product)
                                ->where('id_store',$value->id_store)->first();
            ProductStore::where('id_product',$value->id_product)
                                ->where('id_store',$value->id_store)
                                ->update(['number'=>$store->number - $value->quantity,'number_tranf'=> $store->number_tranf-$value->quantity]);

        }

        
        $stt['status_order']=4;
        $this->BillRepo->update($stt,$bills->id);
        Package_order::where('id_bill',$id)->update(['date_finish' => date('Y/m/d')]);
        Bill::where('id_bill',$id)->update(['date_finish' => date('Y/m/d')]);
        Session::flash('success','Đã hoàn thành!');
        return redirect()->back();
    }
    public function print($id)
    {
        $bills = $this->BillRepo->all()->where('id_bill',$id)->first();
        $billdt=$this->BillDetailRepo->all()->where('id_bill','=',$id);
        //dd($bills);
        return view('backend/bill/printBill',compact('bills','billdt'));
    }

    public function printPFDF($id)
    {

        // $pdf =\App::make('dompdf.wrapper');
        // $pdf->loadHTML($this->exportPDF($id));

        // return $pdf->stream();
        return view('backend/report/createPDF');
    }


    public function cancel_order(Request $request)
    {
        $id_bill= $request->get('id_bill');
        $bills = $this->BillRepo->all()->where('id_bill',$id_bill)->first();
        $stt['status_order']=6;
        $stt['date_cancel']=date('Y-m-d');
        $this->BillRepo->update($stt,$bills->id);
        return "Deleted";

    }



   }

