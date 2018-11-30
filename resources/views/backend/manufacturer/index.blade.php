@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->

   <div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class=" text-semibold ">Hãng sản phẩm</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
          </div>

           <div class="heading-elements">
           	 <div class="heading-btn-group">
                   
                     <a href="{{ route('admin.manufacturer.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" >                     
                        <i class="icon-plus-circle2 text-primary"></i><span>Thêm mới</span>
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
             

                <h5 class="panel-title ">Danh sách hãng sản phẩm</h5> 
               
            </div>   

            <table class="table datatable-basic">
                <thead>
                    <tr>
                    
                        <th width="5px">
                        <form action="{{ route('admin.typeproduct.toggleGroup') }}" method="POST" class="form-group">  
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="styled checked" id="checkall" type="checkbox" name="group[]" value="0">
                        </form>
                        </th>

                        <th>Mã hãng sản phẩm</th>
                        <th>Tên hãng sản phẩm</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th style="text-align: center">Control</th>  
                    </tr>
                </thead>

                <tbody>
                 @foreach($Manufac as $key=>$value)
                    <tr>

                       <th><input class="check" type="checkbox" name="group[]" value="{{$value->id}}"/></th>
                       <th>{!!$value->id!!}</th>                     
                       <th><a href="#">{!!$value->name!!}</a></th>
                       <th>{{$value->created_at}}</th>
                       <th>{{$value->updated_at}}</th>
                       <th style="text-align: center">
                            
                       
                            <a  href="{{ route('admin.manufacturer.edit', $value->id) }}" title="Chỉnh sửa" class="text-success">
                                <i class="icon-pencil"></i>
                            </a>
                           
                            <form action="{{ route('admin.manufacturer.destroy',  $value->id ) }}" method="POST">
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
        $('.form-group').append('<input type="hidden" name="status" value="0">');
        $('.form-group').submit();
    }
    });

</script>
@stop