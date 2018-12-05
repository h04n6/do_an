@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->



   <div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class=" text-semibold ">Mã giảm giá</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
          </div>

           <div class="heading-elements">
           	 <div class="heading-btn-group">
                   
                     <a href="{{ route('admin.discountcode.create')}}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-plus-circle2 text-primary"></i><span>Tạo mới</span>
                    </a>
                     <a id="button-delete" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-trash icon_delete"></i><span>Xóa</span>
                    </a>
                </div>
           </div>
   	</div>
   </div>
 <div class="panel panel-flat">
            <div class="panel-heading">
             

                <h5 class="panel-title animated swing">Danh sách mã giảm giá</h5> 
               
            </div>   

            <table class="table datatable-basic">
                <thead>
                    <tr>
                    
                        <th width="5px">
                        <form action="{{ route('admin.discountcode.toggleGroup') }}" method="POST" class="form-group">  
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="styled checked" id="checkall" type="checkbox" name="group[]" value="0">
                        </form>
                        </th>
                        <th>Mã giảm giá</th>
                        <th>Giá trị </th>
                        <th>Trạng thái</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày tạo</th>

                        <th>Hạn sử dụng</th>
                        <th style="text-align: center">Control</th>  
                    </tr>
                </thead>

                <tbody>
                 @foreach($code as $key=>$value)
                    <tr>
                      <th><input class="check" type="checkbox" name="group[]" value="{{$value->id}}"/></th>
                       <th>{!!$value->code!!}</th>
                       @if($value->cash!=0)
                       <th>{!!number_format($value->cash,0,',','.')!!} đ</th>
                       @else <th>{!!$value->percent!!} %</th>
                       @endif
                       @if ($value->is_used==0)
                    <th><span class="text-center lable label-success" style="display: inline-block; width: 99px; padding: 2px 4px; border-radius: 15px; color: white;background:green;">Chưa kích hoạt</span></th>  
                       @else <th><span class="text-center lable label-danger" style="display: inline-block; padding: 2px 4px;width: 99px; border-radius: 15px;">Đã kích hoạt</span></th>  
                       @endif
                       @if (!empty($value->user->name))
                        <th>{!!$value->user->name !!}</th>
                       @else <th>---</th>
                       @endif
                       
                       <th>{!!date('d-m-Y',strtotime($value->created_at))!!}</th>
                       <th>{!!$value->expiration_date!!}</th>  
                       <th style="text-align: center">
                            
                           
                            <form action="{{ route('admin.discountcode.destroy',  $value->id ) }}" method="POST">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="Xoa" class="delete text-danger">
                                    <i class="icon-close2"></i>
                                </a>              
                            </form>
                        </th>  
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

@stop
@section('script')
@parent
<script>
      $('#button-delete').click(function() {
        if (confirm("Bạn có muốn xóa!")){
        console.log('delete');
        $('.form-group').submit();
    }
    });

</script>
@stop