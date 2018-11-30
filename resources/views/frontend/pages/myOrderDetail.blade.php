@extends('frontend.layouts.master')
@section('content')


<!-- Button trigger modal-->

<!--Modal: modalSocial-->
<div class="modal fade" id="modal-rating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">

    <!--Content-->
    <div class="modal-content" style="height: 440px;">

      <!--Header-->
      <div class="modal-header">
        <h4 class="title"><i class="fa fa-users"></i> Đánh giá</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body mb-0 text-center">


        <!--Facebook-->
        <div class="form-group col-md-5 text-left">
            <label>Tên</label>
            <input name="name" type="text" required="required" class="form-control" value="">
           <input type="hidden" name="id_product" value="" />
          
        </div>
                    
        <div class="rating col-md-12">
            <div class="col-md-3 text-left"><span>Số sao</span></div>
            <div class="col-md-7">
            <div class="stars">
              <form action="">
                <input class="star star-5" id="star-5" type="radio" data="5" name="star"/>
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" data="4" name="star"/>
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" data="3" name="star"/>
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" data="2" name="star"/>
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" id="star-1" type="radio" data="1" name="star"/>
                <label class="star star-1" for="star-1"></label>
              </form>
            </div>
            </div>
        </div>

       <div class="col-md-12 form-group text-left">
            <label class="required">Nội dung đánh giá</label>
            <textarea name="content-rate" rows="4" cols="60" ></textarea>
          
        </div>
         <div class="col-md-12">
        <a  class="btn btn-primary send_rating ">Gửi</a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Hủy</a>
      </div>
      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalSocial-->
<!--Modal: modalSocial-->
<div class="modal fade" id="modal-returns" tabindex="-1" role="dialog" >
  <div class="modal-dialog " role="document"  style="min-height: 450px;height: auto;" >

    <!--Content-->
    <div class="modal-content" >

      <div class="cnt" style="min-height: 450px;height: auto;">
      <div class="modal-header">
        <h4 class="title"><i class="fa fa-users"></i> Trả hàng</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body " style="min-height: 480px;height: auto;">
        <div class="col-md-10 prd-returns">
          <label>Chọn sản phẩm cần trả</label>
          @foreach ($billDetail as $value)
            <div class="form-group">
          <input type="checkbox" value="{{$value->id_product}}"  name="prd" />
          <label for="product"><img src="{{ asset($value->product->image) }}" style="width: 60px; height: 60px;margin: 5px;"><span>{{$value->product->name}}</span></label>'
          </div>
          @endforeach
          
          
        </div>
        <div class="form-group col-md-10">
            <label class="">Lý do</label>
            <select name="reason" required="required" class="select2">
                <option value="Sản phẩm lỗi">Sản phẩm lỗi</option>
                <option value="Giao nhầm sản phẩm" >Giao nhầm sản phẩm</option>
                <option value="Chất lượng không giống mô tả trước đó">Chất lượng không giống mô tả trước đó</option>
                <option value="0">Lý do khác</option>

            </select>

        </div>

       <div class="col-md-12 form-group col-md-10" >
            <div class="add-reason">
              
            </div>

        </div>
         <div class="col-md-12 text-center">
        <a  class="btn btn-primary send_returns ">Gửi</a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Hủy</a>
      </div>
      </div>
      </div>
    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalSocial-->



<div class="container" style="min-height: 400px;">
	<div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title text-center">
                <h4><i class="icon-gift icon-gift-beat" style="font-size: 25px; top: -6px;"></i> <span class=" text-semibold ">CHI TIẾT ĐƠN HÀNG</span></h4>
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
     <div class="box-content-detail ">
        <div class="head">
     	<div class="col-md-5">
     	<p class="text-left" style="font-weight: bold;font-size: 16px;">Đơn hàng #{{$bill->id_bill}}</p>
     	<span style="color: #a49eab;"><i>Ngày đặt {{$bill->created_at()}}</i></span>
     	
     	</div>
        <div class="col-md-3"><span>Trạng thái: <i>@if ($bill->status_order==1)
            {{'Chờ duyệt'}}
            @else {{$bill->status->name}}
        @endif
        </i> 
        </span></div>
     	<div class="col-md-4 text-right">
     		<span style=" font-size: 15px;">Tổng cộng: {{$bill->total_bill}} VNĐ</span>
     	</div>
        </div>
        <div class="main-box">
            <div class="recive-date text-right" style="height: 40px;">
                <div class="col-md-3 text-center">
                    @if ($bill->status_order==4 && date('Y-m-d',(strtotime('+2 day',strtotime($bill->date_finish))))>= date('Y-m-d',strtotime(date('Y-m-d'))))
                    <span><a id="returns" data-toggle="modal" data-target="#modal-returns" >Trả hàng</a></span>
                    @elseif($bill->status_order==1) <span><a id="cancel-order">Hủy đơn hàng</a></span>
                @endif
                </div>
                <div class="col-md-9">
                @if ($bill->status_order==4)
                    <span>Ngày giao hàng {{date('d/m/Y',strtotime($bill->date_finish))}}</span>
                @elseif($bill->status_order==1 || $bill->status_order==2 || $bill->status_order==3)
                 <span>Giao hàng dự kiến: {{date('d/m',strtotime($start_date_ship))}} - {{date('d/m/Y',strtotime($end_date_ship))}}</span>
                @endif
                </div>
            </div>
            <div class="step-order">
                <div class="container ">
                <ul class="progressbar text-left">
                    <li class="stt1 active"><i class=" col-md-12 icon-cart5"></i><span>Đặt hàng</span></li>
                    <li class="stt2 "><i class=" col-md-12  icon-user-check"></i><span>Xác nhận đơn hàng</span></li>
                    <li class="stt3 "><i class=" col-md-12  icon-cube3"></i><span> Đang đóng gói</span></li>
                    <li class="stt4 "><i class=" col-md-12  icon-truck"></i> Đang vận chuyển</li>
                    <li class="stt5 "><i class=" col-md-12  icon-gift"></i><span> Đã giao hàng</span></li>

                </ul>
                </div>
            </div>
            <div class="list-prd">
                @foreach ($billDetail as $value)
                <div class="product-in-order">
                  
                    <div class="group-prd col-md-5">
                        <div class="col-md-4"><img src="{{ asset($value->product->image) }} " style="width: 105px; height: 100px"></div>
                        
                        <div class="col-md-8">
                        <div><span class="id_prd" id="{{$value->id_product}}">{{$value->product->name}}</span></div>
                        <div><span class="" style="color:#9e9a9a;">{{$value->product_info}}</span></div> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span>{{number_format($value->price,0,',','.')}} đ</span>
                    </div>
                     <div class="col-md-2">
                        <span>Qty : {{$value->quantity}}</span>
                    </div>
                    <div class="col-md-2">
                      
                        @if ($bill->status_order==4)
                            <span><a data-toggle="modal" class="get_id_prd" data-target="#modal-rating">Viết đánh giá</a></span>
                        @endif
                       
                    </div>
                 </div>
                @endforeach

            
            
            </div>
            <div class="info-order " >
                <div class="col-md-7">
                    <h3>Địa chỉ giao hàng</h3>
                    <p>Người nhận: {{$bill->reciver}}</p>
                    <p>Địa chỉ nhận: {{$bill->recive_address}}</p>
                    <p>SĐT: {{$bill->phone}}</p>
                </div>
                <div class="col-md-5">
                    <div><h3>Tổng cộng</h3></div>
                    <div class="col-md-12" style="padding: 5px 0;border-bottom:1px solid #eae9e9; ">
                    <div class="col-md-7 text-left">
                        <p>Tạm tính</p>
                        <p>Phí vận chuyển</p>
                    </div>
                    <div class="col-md-5 text-right">
                        <p>{{number_format($bill->total_bill - $bill->ship_cost,0,',','.')}} đ</p>
                        <p>{{number_format($bill->ship_cost,0,',','.')}} đ</p>
                    </div>
                    </div>
                     <div class="col-md-12" style="padding: 10px 0;">
                    <div class="col-md-7 text-left">
                        <p>Tổng cộng</p>
                        <p>{{$bill->payment_method}}</p>
                    </div>
                    <div class="col-md-5 text-right">
                        <p>{{number_format($bill->total_bill,0,',','.')}} đ</p>

                    </div>
                </div>
                </div>
               
            </div>
        </div>
     	
     </div>


     </div>
	</div>
 </div>
 
@stop
@section('script')
<script>
    $('.select2').select2();
    $( document ).ready(function() {

    if({{$bill->status_order}}==2)
    {
        $('.stt2').attr('class','active');
    }
    if({{$bill->status_order}}==3)
    {
        $('.stt2').attr('class','active');
        $('.stt3').attr('class','active');
        $('.stt4').attr('class','active');
    }
    if({{$bill->status_order}}==4)
    {
        $('.stt2').attr('class','active');
        $('.stt3').attr('class','active');
        $('.stt4').attr('class','active');
        $('.stt5').attr('class','active');
        $('.stt6').attr('class','active');
    }
    if({{$bill->status_order}}==5)
    {
        $('.stt2').attr('class','active');
        $('.stt3').attr('class','active');
        $('.stt4').attr('class','active');
        $('.progressbar').find('.stt5 span').text('Giao hàng thất bại');
        $('.stt5').attr('class','cancel');
        
        
    }
    if({{$bill->status_order}}==6)
    {
        $('.progressbar').find('.stt2 span').text('Khách hàng hủy đơn');
        $('.stt2').attr('class','cancel');
        
    }
    if({{$bill->status_order}}==7)
    {
        $('.progressbar').find('.stt2 span').text('Hệ thống hủy');
        $('.stt2').attr('class','cancel');
        
    }
    if({{$bill->status_order}}==8)
    {
        $('.stt2').attr('class','active');
        $('.stt3').attr('class','active');
        $('.stt4').attr('class','active');
        $('.stt5').attr('class','active');
        
        $('.progressbar').append('<li class="stt6 cancel"><i class=" col-md-12  icon-gift"></i><span> Trả hàng</span></li>');

        
    }
    });
</script>


</script>
<script >
    $( ".rating-star" ).click(function() {
        $(this).addClass('checked');
    });
   

</script>

    <script >
        $(document).on('click', '#cancel-order', function () {

            swal({
                  title: "Bạn có muốn hủy đơn hàng?",
                  buttons: {
                    cancel: true,
                    confirm: true,

                  },
                }).then((isConfirm) => {
                  if (isConfirm) {
                    var id_bill='{{$bill->id_bill}}';
                    $.ajax({
                    url: '{{ asset('/api/cancel_order') }}',
                    method: 'POST',
                    data: {
                        id_bill: id_bill
                    },
                    success: function (html) {

                        if(html=="Deleted")
                        {

                            swal(
                              'Đã hủy!',
                              'Đơn hàng của bạn đã được hủy',
                              'success',{
                                
                                  buttons: false,
                                  timer: 2000,

                              }
                            )
                            location.reload();    
                           
                        }
                        else{
                            swal({
                                  type: 'error',
                                  title: 'Oops...',
                                  text: 'Something went wrong!',
                                  footer: '<a href>Why do I have this issue?</a>'
                                })
                        }
                        
                    }
                });
                }
                })
            
    


    });
    </script>

    <script>
         $(document).on('click', 'input[name=star]', function () {
           if ($(this).closest('.stars').find('.is_choise').length>0) {
             $(this).closest('.stars').find('.is_choise').removeClass('is_choise');

           }
           $(this).addClass('is_choise');
         });
    </script>
    <script>
      $(document).on('click','.get_id_prd',function(){
        var id=$(this).closest('.product-in-order').find('.id_prd').attr('id');
        $('input[name=id_product]').val(id);
      });
    </script>
     <script >
        $(document).on('click', '.send_rating', function () {
            if ($('.stars').find('.is_choise').length<=0) {
            alert('Mời bạn chọn số sao cho sản phẩm!');
            return false;
           }
            var name = $('input[name=name]').val();
            var star = $('.stars').find('.is_choise').attr('data');
            var product = $('input[name=id_product]').val();
            var content = $('textarea[name=content-rate]').val();
            if (content='') {
              content='';
            }
            $.ajax({
            url: '{{ asset('/api/send_rating') }}',
            method: 'POST',
            data: {
                star: star,
                name:name,
                product:product,
                content:content
            },
            success: function (html) {

                if(html=="sent")
                {

                    swal(
                      'Đã gửi đánh giá!',
                      'Cảm ơn bạn đã nhận xét sản phẩm!!',
                      'success',{
                        
                          buttons: false,
                          timer: 2000,

                      }
                    ) 
                    $('#modal-rating').modal('hide');
                   
                }

                
            }
        });
               
    });
    </script>
    <script>
  $(document).on('change','select[name=reason]',function(){
      if ($('select[name=reason]').val()=='0') {
          var html='<label >Nội dung</label>' 
             + '<textarea name="content-reason" class="form-control" required rows="2" cols="60" ></textarea>';
          $('.add-reason').append(html);
      }
      else{
        $('.add-reason').text('');
      }
    });
  $(document).on('click', 'input[name=prd]', function () {
           if ($(this).attr('class')=='is_choise') {
             $(this).removeClass('is_choise');

           }
           else{
            $(this).addClass('is_choise');
           }
           
         });

      
    </script>
    <script>
      $(document).on('click','.send_returns',function(){
      var id= $('.prd-returns').find('input.is_choise').toArray();
      var arr='';
        for (i=0;i<id.length;i++){
          arr +=id[i].value+',';
        }
      var reason =$('select[name=reason]').val();
      if (id.length==0) {
        alert('Bạn chưa chọn sản phẩm cần trả!');
        return false;
      }
      if(reason=='0')
      {
        reason= $('textarea[name=content-reason]').text();
      }
      
       $.ajax({
            url: '{{ asset('/api/returns') }}',
            method: 'POST',
            data: {
                arr: arr,
                reason:reason
            },
            success: function (html) {
              alert(html);
                if(html=="sent")
                {

                    swal(
                      'Đã gửi yêu cầu trả hàng!',
                      'Cửa hàng sẽ đưa nhân viên đến nhận hàng sớm nhất có thể',
                      'success',{
                        
                          buttons: false,
                          timer: 2000,

                      }
                    ) 
                    $('#modal-returns').modal('hide');
                   
                }

                
            }
        });
      });
    </script>
@stop