<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\User;
use App\Bill;
use Illuminate\Support\Facades\DB;
use App\Charts\SampleChart;
use Repositories\BillRepository;
use Repositories\BillDetailRepository;
use Repositories\CustomerRepository;
use App\Package_order;
class ReportController extends Controller
{
      public function __construct(BillDetailRepository $BillDetailRepo, BillRepository $BillRepo,CustomerRepository $CustomerRepo)
    {
          $this->BillDetailRepo = $BillDetailRepo;
          $this->BillRepo = $BillRepo;
          $this->CustomerRepo = $CustomerRepo;
    }
    public function indexSales()
    {
      return view('backend.report.sales.index');
    }
    public function salesChart()
    {

         $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $chart = new SampleChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
       $chart->dataset('Lợi nhuận', 'bar', [10, 160, 130])->backgroundColor('#0000FF');
       $chart->dataset('doanh thu', 'bar', [10, 40, 100])->backgroundColor('#FFFF00');
       $chart->dataset('Giá vốn', 'bar', [12, 11, 60])->backgroundColor('#00FF00');
//         $users = User::whereMonth('created_at', date('m'))->get();
        return view('backend.report.report_in_date', compact('chart'));
    }

    public function reportInDate(Request $request)
    {
        $search= $request->all();
        $getbill=$this->BillRepo->whereSearch($search);
        $bills =  $getbill->get();

        $orderd=$bills->where('status_order',1); 
        $sub_orderd=0;
        foreach ($orderd as $key => $value) {
             $sub_orderd+=$value->total_bill;
           }   
        $accept=$getbill->whereBetween('status_order', array(2, 3))->get();
         $sub_accept=0;
        foreach ($accept as $key => $value) {
             $sub_accept+=$value->total_bill;
           }  
        $finish=$bills->where('status_order',4);
         $sub_finish=0;
        foreach ($finish as $key => $value) {
             $sub_finish+=$value->total_bill;
           } 
        $cancel=$getbill->whereBetween('status_order', array(6, 7))->get();
        $sub_cancel=0;
        foreach ($cancel as $key => $value) {
             $sub_cancel+=$value->total_bill;
           } 
        $count= $bills->count();
        $total=0;
        foreach ($bills as $key => $value) {
            $total += $value->total_bill;
        }
     
        $chart = new SampleChart;
        $chart->labels(['Đã đặt hàng', 'Đang xử lý', 'Đã hoàn thành','Đã hủy','Đã trả hàng']);
       $chart->dataset('Thông tin đơn hàng', 'bar', [count($orderd), count($accept),count($finish),count($cancel),0 ])->backgroundColor('#0000FF');
       $chart->title('Biểu đồ đơn hàng trong ngày');
       $chart->height(400);
       if ($request->get('start_date')!=NULL) {
         $start_date=$request->get('start_date');
       }
       else{
         $start_date=date('m/d/Y');
       }
      if ($request->get('end_date')!=NULL) {
         $end_date=$request->get('end_date');
       }
       else{
        $end_date=date('m/d/Y');
       }

        return view('backend.report.sales.reportSales',compact('bills','billdt','total','count','chart','start_date','end_date','sub_orderd','sub_accept','sub_finish','sub_cancel','orderd','accept','finish','cancel'));
    }
     public function reportInDatePDF()
    {

  		// $pdf =\App::make('dompdf.wrapper');
  		// $pdf->loadHTML($this->exportPDF());
    //     $pdf->setPaper('A4', 'landscape');

  		// return $pdf->stream();
        return view('backend.report.createPDF');
    }
    public function exportPDF()
    {
    	$user = User::where('role_id', '=', \App\User::ROLE_CUSTOMER)->get();
    	$html ='<table class="table datatable-basic">
                <thead>
                    <tr>
                      
                      
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đăng ký</th>
                        <th>SĐT</th>
                        <th>Emaill</th>
                        
                    </tr>
                </thead>

                <tbody>'; 
                
            foreach($user as $key=>$customer)
            {
            	$html.='<tr>
                        
                     
                        <td>'.$customer->id.'</td>
                        <td><a href="">'.$customer->name.'</a></td>
                        <td>'.$customer->address.'</td>
                        <td>'.$customer->created_at().'</td>
                        <td>'.$customer->phone.'</td>
                        <td>'.$customer->email.'</td>
                        
                    </tr>';
            }
            $html.='</tbody>
            </table>';
            $htmll=view('backend.report.createPDF');
            return $htmll;

                    
              
    }

    public function chart()
    {
        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

        $chart = new SampleChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('My dataset', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);
        return view('backend.report.report_in_date', compact('chart'));

    }

    public function view_detail(Request $request)
    {

        $billdt=$this->BillDetailRepo->all()->where('id_bill','=',$request->get('id'));
        $html='';
        foreach ($billdt as $key => $value) {
            $html .='<tr class="cont"><th>'.$value->id_product.'</th>
                    <th>'.$value->product_info.'</th>
                    <th>'.$value->quantity.'</th>
                    <th>'.number_format($value->price,0,',','.').'</th>
                    <th>'.number_format($value->total,0,',','.').'</th>
                    </tr>';
        }
        return $html;
    }
    public function get_ordered(Request $request)
    {

        $bills= Bill::whereDate('date_order', '>=' ,date('Y-m-d',strtotime($request->get('start_date'))))
                    ->whereDate('date_order', '<=' ,date('Y-m-d',strtotime($request->get('end_date'))));

        if($request->get('id_status')==0)
        {

            $bills =$bills->where('status_order' , 1)
                   
                    ->get();
          
        }
        elseif ($request->get('id_status')==1) {
            $bills =$bills->whereBetween('status_order' ,array(2, 3))
                    ->get();
                      
        }
        elseif ($request->get('id_status')==2) {
            $bills = $bills->where('status_order' , 4)
                    ->get();                          
        }
        else  {
            $bills =$bills->whereBetween('status_order' , array(6, 7))
                    // ->orWhere('status_order', 7)
                    ->get();
        }

         $i=1;
         $html='<div class="content-table" style="width: 90%;margin: 15px auto;">
                <div class="col-md-2 head-table text-center">Danh sách đơn hàng</div>
                <a href="#" class="head-table">Xuất file</a>
                <div class="table">
                <table class="table " id="example"  >
                    <thead>
                        <tr style="background:#B0E0E6; font-size: 14px;">
                            <td>STT</td>
                            <td>Mã chứng từ</td>
                            
                            <td>Thời gian</td>
                            <td>Phí vận chuyển</td>
                            <td>Tiền sản phẩm</td>
                            <td>Doanh thu</td>
                        </tr>
                    </thead>
                    <tbody>';
                     foreach ($bills as $key => $value)
                     {
                         $html .=' <tr>
                           <td>'.$i.'</td>
                          <td><a data-toggle="modal" class="view-detail" data-target="#modal_backdrop">'.$value->id_bill.'</a></td> 
                          <td>'.$value->created_at().'</td>
                          <td>'.number_format($value->ship_cost,0,',','.').'</td>
                          <td>'.number_format(($value->total_bill-$value->ship_cost),0,',','.').'</td>
                          <td>'.number_format($value->total_bill,0,',','.').'</td>
                           
                       </tr>';
                       $i++;

                     }
                      
                        
                    $html .='</tbody>
                </table>
                </div>
                </div>';
                return $html;
    }
    public function tranfer(Request $request)
    {
      $search =$request->all();
      $report_TF =Package_order::all();
     
      return view('backend.report.sales.reportTranfer',compact('report_TF')); 
    }


    public function indexStore()
    {
      return view('backend.report.store.index');
    }

    public function report_customer(Request $request)
    {
      
    }
}
