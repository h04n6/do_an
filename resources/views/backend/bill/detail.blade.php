@extends('backend.layouts.master')
@section('content')
  @if (Session::has('success'))
      <div class="modal fade" id="success">
      <div class="modal-dialog  modal-sm">
        <div class="modal-content" style="background-color: #1ab91a;">
           <span aria-hidden="true">&times;</span>
          <div class="modal-body text-center" style="padding: 0">
            <span style="color: white;font-size: 20px;"><i>{!!Session::get('success')!!}</i></span>
          </div>
        </div>
      </div>
    </div>
    {!!Session::forget('success')!!}
    @endif
<div class="page-header">
     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Chi tiết đơn hàng</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
     <div class="panel panel-flat" style="    margin: 20px;">
            <div class="container ">
                <ul class="progressbar text-left">
                    <li class="stt1 active"><i class=" col-md-12 icon-cart5"></i><span>Khách đặt mua hàng</span>></li>
                    <li class="stt2 "><i class=" col-md-12  icon-user-check"></i><span>Xác nhận đơn hàng</span></li>
                    <li class="stt3 "><i class=" col-md-12  icon-cube3"></i><span> Đóng gói</span></li>
                    <li class="stt4 "><i class=" col-md-12  icon-truck"></i> Vận chuyển</li>
                    <li class="stt5 "><i class=" col-md-12  icon-gift"></i><span> Đã giao hàng</span></li>
                    <li class="stt6 "><i class=" col-md-12  icon-cash"></i><span>Người bán nhận tiền</span></li>
                   
                </ul>
            </div>
            <div class="text-right" style="margin: 15px; height: 50px;">
                <a href="{{ route('admin.bill.accept',$bills->id_bill) }}" class="btn btn-primary"><i class=" icon-clipboard2"></i>  ABC</a>
                @if ($bills->status_order==1)
                    <a href="{{ route('admin.bill.accept',$bills->id_bill) }}" class="btn btn-primary"><i class=" icon-clipboard2"></i>  Duyệt đơn</a>
                    @else  <a href="" class="btn btn-primary disabled"><i class=" icon-clipboard2"></i>  Duyệt đơn</a>
                @endif
                @if ($bills->status_order==4 || $bills->status_order==6 || $bills->status_order==7)
                	 <a href=""  class="btn btn-danger disabled"><i class="  icon-cancel-square2"></i>  Hủy</a>
                	 @else  <a href="{{ route('admin.bill.cancel',$bills->id_bill) }}"  class="btn btn-danger"><i class="  icon-cancel-square2"></i>  Hủy</a>
                @endif
               
                
                <a href="{{ route('admin.bill.print',$bills->id_bill) }}"  target="_blank"   class="btn btn-primary"><i class=" icon-printer2"></i>  In phiếu</a>
                @if ($bills->status_order!=2)
                	 <a   class="btn btn-primary disabled"  data-toggle="modal" data-target="#fullHeightModalRight" ><i class=" icon-cube3"></i>  Đóng gói</a>
                	 @else  <a  class="btn btn-primary"  data-toggle="modal" data-target="#fullHeightModalRight"><i class=" icon-cube3"></i>  Đóng gói</a>
                @endif
                @if ($bills->status_order!=3)
                	 <a  class="btn btn-success disabled" ><i class="icon-check"></i>  Hoàn thành </a>
                	 @else  <a href="{{ route('admin.bill.finish',$bills->id_bill) }}"class="btn btn-success"><i class="icon-check"></i>  Hoàn thành</a>
                @endif
                <a href="" class="btn btn-primary"><i class=" icon-download10"></i>  Nhận lại hàng</a>
            </div>

    </div>
</div>
<div class="content">
 <div class="panel panel-flat">  

            <table class="table ">
                <div class="head-talbe">
                    <div class="row">
                        <div class="bill col-md-9"><b>Mã đơn hàng: {{$bills->id_bill}} </b></div>

                        <div class="bill col-md-3"><b>Trạng thái :  {{$bills->status->name}} </b></div>
                    </div>
                        <div><b>Khách hàng: </b>{{$bills->id_user}} -- {{$bills->user->name}} </div>
                        
                            <div class=""><b> Địa chỉ nhận hàng : </b>{{$bills->recive_address}}</div>
                        
                        <div class=""><b>Số diện thoại: </b> {{$bills->phone}}</div>
                </div>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>

                    </tr>
                </thead>

                <tbody>
                 @foreach($billdt as $key=>$value)
                    <tr>
                       <th>{!!$value->id_product!!}</th>                     
                       <th><img id="img_load" src="{!! asset($value->product->image) !!}"></th>
                       <th>{{$value->product_info}}</th>
                       <th>{!!$value->quantity!!}</th>
                       <th>{!!number_format($value->price,0,',','.')!!}</th>
                       <th>{!!number_format($value->total,0,',','.')!!}</th>
                     
                    </tr>
                    @endforeach
                    <tr colspan=''>
                        <th></th>
                        <th></th>
                        <th>Phí vận chuyển: {{number_format($bills->ship_cost,0,',','.')}}</th>
                        <th>@if ($bills->coupon !=0)
                            Giảm giá: {{number_format($bills->coupon,0,',','.')}}
                        @endif</th>
                        <th></th>
                        <th>Tổng tiền: {{number_format($bills->total_bill,0,',','.')}} vnđ</th>
                    </tr>
                </tbody>
            </table>

</div>
</div>


    </div>

</div>




<!-- Side Modal Top Right -->

<!-- To change the direction of the modal animation change .right class -->
<!-- Full Height Modal Right -->
<div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">

    	<form method="post" action="{{ route('admin.bill.package',$bills->id_bill) }}">
    		 <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100" id="myModalLabel"><i class=" icon-cube3 animated rotateIn" style="font-size: 30px;    animation-duration: 2s;"></i> ĐÓNG GÓI ĐƠN HÀNG</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="height: 440px;">
 			 <div class="form-group ">
	               <span>Đơn hàng : #<i>{{$bills->id_bill}}</i></span>
            </div>
             <div class="form-group ">
	               <span>Người nhận hàng : <i>{{$bills->reciver}}</i></span>
            </div>
             <div class="form-group ">
	               <span>Địa chỉ nhận hàng : <i>{{$bills->recive_address}}</i></span>
            </div>
            <div class="form-group ">
	               <span>Số lượng sản phẩm : {{count($billdt)}}</span>
            </div>
             <div class="form-group ">
	               <span>Phương thức thanh toán : <i>{{$bills->payment_method}}</i></span>
            </div>
              <div class="form-group row">
              		<div class="col-md-6">
	               <span class="">Phí vận chuyển : <i>{{$bills->ship_cost}} vnđ</i></span>
	              	</div>
	              	<div class="col-md-6">
	              	 <span>Tổng đơn hàng : <i>{{$bills->total_bill}} vnđ</i></span>
	              	</div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
                <label class="">Nhân viên đóng gói</label>
                <select name="package_staff" class="form-control select2">
                    @foreach($package_staff as $pk)
                    <option value="{{ $pk->id }}"  {{(old('package_staff')==$pk->id)?'selected':''}}>{!!$pk->name!!}</option>
                    @endforeach
                </select>
            </div>
             <div class="form-group col-md-6">
                <label class="">Nhân viên xuất kho</label>
                <select name="export_staff" class="form-control select2">
                    @foreach($export_staff as $exp)
                    <option value="{{ $exp->id }}"  {{(old('export_staff')==$exp->id)?'selected':''}}>{!!$exp->name!!}</option>
                    @endforeach
                </select>
            </div>
             <div class="form-group col-md-8">
                <label class="">Nhân viên vận chuyển</label>
                <select name="shipper" class="form-control select2">
                    @foreach($shipper as $ship)
                    <option value="{{ $ship->id }}"  {{(old('shipper')==$ship->id)?'selected':''}}>{!!$ship->name!!}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <a  class="btn btn-primary">In</a>
          <button type="submit" class="btn btn-primary">Lưu</button>

        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Full Height Modal Right -->
@stop
@section('script')
@parent
<script>
       $(document).on('change', '.DuyetDon', function () {
  
        var id = $(this).val();
        var id_store = $('input[name=id_store1]').val();
        var i = $('.list-size-color').length;

            $(this).addClass('changed');
        $.ajax({
            url: '/api/getSizeAndColor',
            method: 'POST',
            data: {
               id: id,
               i: i,
               id_store: id_store
            },
            success: function (html) {

              $('.content-add').each(function () {
                    if($(this).find('.changed').length>0){
                      $(this).find('.cont').remove();
                       $(this).find('.changed').removeClass('changed');
                       $(this).find('.list-size-color').append(html);
                    }
                    
                });
              
            }
        });
    });

 $('.select2').select2({});

$('#success').modal('show');

// setTimeout(function() {
//     $('#success').modal('hide');
// }, 2000);

	$( document ).ready(function() {

    if({{$bills->status_order}}==2)
    {
    	$('.stt2').attr('class','active');
    }
    if({{$bills->status_order}}==3)
    {
    	$('.stt2').attr('class','active');
    	$('.stt3').attr('class','active');
    	$('.stt4').attr('class','active');
    }
    if({{$bills->status_order}}==4)
    {
    	$('.stt2').attr('class','active');
    	$('.stt3').attr('class','active');
    	$('.stt4').attr('class','active');
    	$('.stt5').attr('class','active');
    	$('.stt6').attr('class','active');
    }
    if({{$bills->status_order}}==5)
    {
    	$('.stt2').attr('class','active');
    	$('.stt3').attr('class','active');
    	$('.stt4').attr('class','active');
    	$('.progressbar').find('.stt5 span').text('Giao hàng thất bại');
    	$('.stt5').attr('class','cancel');
    	
    	
    }
    if({{$bills->status_order}}==6)
    {
    	$('.stt2').attr('class','cancel');
    	
    }
    if({{$bills->status_order}}==7)
    {
    	$('.progressbar').find('.stt2 span').text('Hệ thống hủy');
    	$('.stt2').attr('class','cancel');
    	
    }
    if({{$bills->status_order}}==8)
    {
    	$('.stt2').attr('class','active');
    	$('.stt3').attr('class','active');
    	$('.stt4').attr('class','active');
    	$('.stt5').attr('class','active');
    	
    	$('.progressbar').find('.stt6 span').text('Trả hàng');
    	$('.stt6').attr('class','cancel');

    	
    }
	});


</script>
@stop