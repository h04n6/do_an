@extends('backend.layouts.master')
@section('content')
<div class="page-header">
     <div class="page-header-content">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Báo cáo bán hàng</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
    </div>
</div>

<div class="panel panel-flat">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        
                    </ul>
                </div>
            </div>
            <form action="{{route('admin.reportInDate')}}" method="GET">  
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="panel-body row">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-md-3 control-label">Từ ngày:</label>
                            <div class="col-md-9">
                    <input type="text" class="form-control datepicker" name="start_date" value="{{$start_date}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-3 control-label">Đến ngày:</label>
                            <div class="col-md-9">
                    <input type="text" class="form-control datepicker" name="end_date" value="{{$end_date}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-3 control-label">Nhân viên tạo đơn:</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="staff" value="">
                            </div>
                        </div>   
                   

                    <div class="col-md-11 text-right" style="    margin-top: 15px;">
                        <button type="submit" class="btn btn-primary legitRipple">Xem báo cáo<i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                     </div>

                </div>
            </form>
        <div class="row">
        	<div class="col-md-2"></div>
        	<div class="col-md-8">
        	<div id="app" class="chart ">
            {!! $chart->container() !!}
        	</div>
        	</div>

        </div>
</div>

 <div class="panel panel-flat " >
 	 <div class="panel-heading text-center">
             
                <h5 class="panel-title ">Thông tin đơn hàng</h5> 
      </div>
            <div class="view">
            	<div class=" view-box">
	            	<div class="col-md-4">
	            	</div>
	            	<div class="col-md-4 text-center">Số lượng đơn hàng</div>
	            	<div class="col-md-4 text-center">Doanh số</div>
            	</div>
            	<div class=" view-box ordered">
	            	<div class="col-md-4">
	            		<i class="icon-arrow-right13"></i> Đã đặt hàng
	            	</div>
	            	<div class="col-md-4 text-center">{{count($orderd)}}</div>
	            	<div class="col-md-4 text-center">{{number_format($sub_orderd,0,',','.')}}</div>
            	</div>
            	<div class="positon-ordered">
            	
            	</div>
            	<div class=" view-box accept">
	            	<div class="col-md-4">
	            		<i class="icon-arrow-right13"></i> Đã duyệt
	            	</div>
	            	<div class="col-md-4 text-center">{{count($accept)}}</div>
	            	<div class="col-md-4 text-center">{{number_format($sub_accept,0,',','.')}}</div>
            	</div>
            	<div class="positon-accept">
            	
            	</div>
            	<div class=" view-box finish">
	            	<div class="col-md-4">
	            		<i class="icon-arrow-right13"></i> Đã hoàn thành
	            	</div>
	            	<div class="col-md-4 text-center">{{count($finish)}}</div>
	            	<div class="col-md-4 text-center">{{number_format($sub_finish,0,',','.')}}</div>
            	</div>
            	<div class="positon-finish">
            	
            	</div>
            	<div class=" view-box cancel">
	            	<div class="col-md-4">
	            		<i class="icon-arrow-right13"></i> Đã hủy
	            	</div>
	            	<div class="col-md-4 text-center">{{count($cancel)}}</div>
	            	<div class="col-md-4 text-center">{{number_format($sub_cancel,0,',','.')}}</div>
            	</div>
            	<div class="positon-cancel">
            	
            	</div>
 </div>   
           
            {{-- <table class="table " id="example">
                <thead>
                    <tr style="background:#B0E0E6; font-size: 14px;">
                    
                        <td>Mã chứng từ</td>
                        
                        <td>Thời gian</td>
                        <td>Doanh thu</td>

                    </tr>
                    <tr style="font-size: 16px; font-weight: bold; background: #FFF0F5">
                    	<td colspan="">SL: {{$count}}</td>
                    	<td colspan=""></td>
                    	<td colspan="1"> {{number_format($total,0,',','.')}}</td>
                    </tr>
                </thead>

                <tbody>
                 @foreach($bills as $key=>$value)
                    <tr>
                      
                       <td class="details-control"><a data-toggle="modal" class="view-detail" data-target="#modal_backdrop">{!!$value->id_bill!!}</a></td> 
                       <td>{{$value->get_time()}}</td>
                       <td>{{number_format($value->total_bill,0,',','.')}}</td>
 						
                    </tr>
                    @endforeach
                    
                </tbody>
            </table> --}}

</div>


        <div id="modal_backdrop" class="modal fade" data-backdrop="false">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title">Chi tiết đơn hàng  #<span class="id_bill"></span></h5>
							</div>

							<div class="modal-body">
							
							<table class="table ">
				                <thead>
				                    <tr>
				                    
				                        <th>Mã sản phẩm</th>
                                        <th>Chi tiết</th>
				                        <th>Số lượng</th>
				                        <th>Đơn giá</th>
				                        <th>Thành tiền</th>

				                    </tr>
				                
				                </thead>

				                <tbody class="detail">
				                
				                </tbody>
				            </table>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
@stop
@section('script')
@parent
<script>
      $('.select2').select2({});
       $(document).on('click', '.view-detail', function () {
  
        var id = $(this).text();
        $('.id_bill').text(id);
   		$(this).addClass('changed');
        $.ajax({
            url: '{{ asset('/api/view-detail') }}',
            method: 'post',
            data: {
               id: id
            },
            success: function (html) {
            	 $('.detail').each(function () {
              	if($('.changed').length>0){
              		  $('.changed').removeClass('changed');
              		  $(this).find('.cont').remove();
              		  $(this).append(html);
              	}
              });
                     

              
            }
        });
    });


</script>


 {{-- <script src="https://unpkg.com/vue"></script>
        <script>
            var app = new Vue({
                el: '#app',
            });
        </script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}
        <script src="{{ asset('assets/js/chart/chart.min.js') }}"></script>
        {!! $chart->script() !!}



        <script >
            $('input[name="dates"]').daterangepicker({
                 language: "vi-VN",
                locale: {
                 monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
                  format: 'DD/MM/YY'
                }
            });
        </script>
        <script >

			    $(document).on( 'click', '.ordered', function () {

			      //var id = $(this).closest('tr').find('.details-control').text();
			      var start_date = $('input[name=start_date]').val();
                  var end_date = $('input[name=end_date]').val();
			       
			    $.ajax({
		            url: '{{ asset('/api/get-ordered') }}',
		            method: 'POST',
		            data: {
		               start_date: start_date,
                       end_date: end_date,
		               id_status: 0
		            },
		            success: function (html) {
		            	$('.ordered').parent('.view').each(function () {
	                    if($('.view').find('.count').length>0){
	                    	$('.ordered').find('i').attr('class',' icon-arrow-right13');
	                        $('.positon-ordered').find('.content-table').remove();
	                        $('.view').find('.count').removeClass('count');
	                      
	                      
                    }
                    else {
                    	$('.positon-ordered').addClass('count');
                    	$('.ordered').find('i').attr('class',' icon-arrow-down12');
                    	$('.positon-ordered').append(html);
                    }
                    
               		 });
		            }
		        });
			} );
			 
		
        </script>
         <script >

			    $(document).on( 'click', '.accept', function () {

			      //var id = $(this).closest('tr').find('.details-control').text();
			      var start_date = $('input[name=start_date]').val();
                  var end_date = $('input[name=end_date]').val();
			       
			    $.ajax({
		            url: '{{ asset('/api/get-ordered') }}',
		            method: 'POST',
		            data: {
		               start_date: start_date,
                       end_date: end_date,
		               id_status: 1
		            },
		            success: function (html) {
		            	$('.accept').parent('.view').each(function () {
	                    if($('.view').find('.count-accept').length>0){
	                    	$('.accept').find('i').attr('class',' icon-arrow-right13');
	                        $('.positon-accept').find('.content-table').remove();
	                        $('.view').find('.count-accept').removeClass('count-accept');
	                      
	                      
                    }
                    else {
                    	$('.positon-accept').addClass('count-accept');
                    	 $('.accept').find('i').attr('class',' icon-arrow-down12');
                    	  $('.positon-accept').append(html);
                    }
                    
               		 });
		            }
		        });
			} );
			 
		
        </script>
         <script >

			    $(document).on( 'click', '.finish', function () {

			      //var id = $(this).closest('tr').find('.details-control').text();
			      var start_date = $('input[name=start_date]').val();
                  var end_date = $('input[name=end_date]').val();
			       
			    $.ajax({
		            url: '{{ asset('/api/get-ordered') }}',
		            method: 'POST',
		            data: {
		               start_date: start_date,
                       end_date: end_date,
		               id_status: 2
		            },
		            success: function (html) {
		            	$('.finish').parent('.view').each(function () {
	                    if($('.view').find('.count-finish').length>0){
	                    	$('.finish').find('i').attr('class',' icon-arrow-right13');
	                        $('.positon-finish').find('.content-table').remove();
	                        $('.view').find('.count-finish').removeClass('count-finish');
	                      
	                      
                    }
                    else {
                    	$('.positon-finish').addClass('count-finish');
                    	 $('.finish').find('i').attr('class',' icon-arrow-down12');
                    	  $('.positon-finish').append(html);
                    }
                    
               		 });
		            }
		        });
			} );
			 
		
        </script>
         <script >

			    $(document).on( 'click', '.cancel', function () {

			      //var id = $(this).closest('tr').find('.details-control').text();
			      var start_date = $('input[name=start_date]').val();
                  var end_date = $('input[name=end_date]').val();
			       
			    $.ajax({
		            url: '{{ asset('/api/get-ordered') }}',
		            method: 'POST',
		            data: {
		               start_date: start_date,
                       end_date: end_date,
		               id_status: 3
		            },
		            success: function (html) {
		            	$('.cancel').parent('.view').each(function () {
	                    if($('.view').find('.count-cancel').length>0){
	                    	$('.cancel').find('i').attr('class',' icon-arrow-right13');
	                        $('.positon-cancel').find('.content-table').remove();
	                        $('.view').find('.coun-cancel').removeClass('count-cancel');
	                      
	                      
                    }
                    else {
                    	$('.positon-cancel').addClass('count-cancel');
                    	 $('.cancel').find('i').attr('class',' icon-arrow-down12');
                    	  $('.positon-cancel').append(html);
                    }
                    
               		 });
		            }
		        });
			} );
			 
		
        </script>
       
@stop