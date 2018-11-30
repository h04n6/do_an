@extends('frontend.layouts.master')
@section('content')
<div class="container" style="min-height: 400px;">
	<div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title text-center">
                <h4><i class="icon-gift icon-gift-beat" style="font-size: 25px; top: -6px;"></i> <span class=" text-semibold ">DANH SÁCH ĐƠN HÀNG</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
          </div>

         
   	</div>
   </div>
	<div>
	<div class="col-md-3 text-left My-Account">
		<p class="item " id="Manage-My-Account"><a ><span ">Quản lý tài khoản</span></a></p>
            <ul class="item-container">
                <li id="My-profile" class="sub"><a >Thông tin cá nhân</a></li>
                <li id="Address-book" class="sub"><a >Sổ địa chỉ</a></li>
                <li id="Payment-methods" class="sub"><a >Tùy chọn thanh toán</a></li>
                <li id="Vouchers" class="sub"><a>Mã giảm giá</a></li>
            </ul>
        <p><a href=""><span>Đơn hàng của tôi</span></a></p>
         <ul class="item-container">
                <li id="My-profile" class="sub"><a >Đơn hàng hủy</a></li>
                <li id="Address-book" class="sub"><a >Đơn hàng đổi trả</a></li>
              
         </ul>
         <p><a href=""><span>Sản phẩm yêu thích</span></a></p>
	</div>
	<div class="box col-md-9">
	@foreach ($myOrders as $order)
		
	
     <div class="box-content ">
     	<div class="col-md-12">
     	<div class="col-md-4">
     	<p class="text-left" style="font-weight: bold;font-size: 16px;">Đơn hàng #{{$order->id_bill}}</p>
     	<span style="color: #a49eab;"><i>Ngày đặt {{$order->created_at()}}</i></span>
     	
     	</div>
     	<div class="col-md-4">
     	<p>Trạng thái : <i>{{$order->status->name}}</i> </p>
     	{{-- <p>Số lượng sản phẩm : {{count($order->billDetail())}}</p> --}}
     	
     	</div>
     	<div class="col-md-4 text-right">
     		<span style=" font-size: 15px;">Tổng cộng: {{number_format($order->total_bill,0,',','.')}} VNĐ</span>
     	</div>
     	</div>
     	<a class="view-order btn btn-primary" href="{{ route('customer.myOrderDetail',$order->id_bill) }}" style="border-radius:0 ">Chi tiết</a>
     </div>

     @endforeach
     </div>
	</div>
 </div>
 
@stop
@section('script')
<script>
    
</script>
@stop