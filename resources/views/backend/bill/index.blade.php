@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">
   <div class="page-header ">
   	<div class="page-header-content">
   		<div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class=" text-semibold ">Danh sách đơn hàng</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
          </div>

   	</div>


    <div class="breadcrumb-line breadcrumb-line-component" >
            <ul id="navMenus" class="nav nav-pills">
               
                <li class="{{(strpos(\Request::path(),'billAll'))?'active':''}}"><a href="{!!route('admin.bill.index')!!}">Tất cả</a></li>   
                <li class="{{(strpos(\Request::path(),'filter-1'))?'active':''}}"><a href="{!!route('admin.bill.index1')!!}"><i class="badge bg-warning-400">{{$count}}</i>Mới</a></li>  
                 <li class="{{(strpos(\Request::path(),'filter-2'))?'active':''}}"><a href="{!!route('admin.bill.index2')!!}">Đang xử lý</a></li>   
                <li class="{{(strpos(\Request::path(),'filter-3'))?'active':''}}"><a href="{!!route('admin.bill.index3')!!}">Đang giao hàng</a></li>  
                <li class="{{(strpos(\Request::path(),'filter-4'))?'active':''}}"><a href="{!!route('admin.bill.index4')!!}">hoàn thành</a></li> 
                
                <li class="{{(strpos(\Request::path(),'filter-5'))?'active':''}}"><a href="{!!route('admin.bill.index5')!!}">Đơn hàng hủy</a></li> 
            </ul>
      </div>
   </div>
   <div class="content">
 <div class="panel panel-flat" style="background: ">
            <div class="panel-heading">
             

                <h5 class="panel-title ">Danh sách đơn đặt hàng</h5> 
            </div>   

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Sử dụng mã giảm giá</th>
                        <th>Chi phí ship</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày đặt</th>

                        <th style="text-align: center">Control</th>  
                    </tr>
                </thead>

                <tbody>
                 @foreach($bill as $key=>$value)
                    <tr>
                       <th>{!!$value->id_bill!!}</th>                     
                       <th><a href="#">{!!$value->user->name!!}</a></th>
                       <th>{!!$value->id_code!!}</th>
                       <th>{!!$value->ship_cost!!}</th>
                       <th>{!!$value->total_bill!!}</th>
                       <th>{!!$value->status_order!!}</th>
                       <th>{!!$value->date_order!!}</th>
                       
                       <th style="text-align: center">

                        <a  href="{{  route('admin.bill.detail',$value->id_bill ) }}" style="margin-bottom: 3px;" title="" class="label label-primary">
                                <i class="icon-enter2">Chi tiết</i>
                            </a>
                           
                            <form action="{{ route('admin.bill.cancel',  $value->id_bill ) }}" method="GET">
                               
                                <a title="Xoa" class="delete label label-danger" style="    width: 80px;">
                                    <i class="icon-close2"> Hủy</i>
                                </a>              
                            </form>
                        </th>  
                    </tr>

                    @endforeach
                </tbody>
            </table>

</div>
</div>

</div>

@stop
@section('script')
@parent
<script>
      $('#button-delete').click(function() {
        if (confirm("Bạn có hủy đơn hàng!")){
        console.log('delete');
        $('.form-group').append('<input type="hidden" name="status" value="0">');
        $('.form-group').submit();
    }
    });
</script>
@stop