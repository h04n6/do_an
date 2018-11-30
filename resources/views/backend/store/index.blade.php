@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->

<div class="modal fade" id="modal-coppy"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm kho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.store.postCreate') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <input type="hidden" name="id_store" value="{!! $getID !!}" />
                       <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên kho</label>
                                <input name="name" type="text" class="form-control" required="required" value="{!!old('name')!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Địa chỉ kho</label>
                                <input name="address" type="text" class="form-control " required="required" value="{!!old('address')!!}">
                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                            </div>

                        </div>
                       

                   
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary legitRipple">{{trans('base.submit')}} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                </form>
            </div>

        </div>

    </div>
</div>

   <div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class=" text-semibold ">Kho</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
          </div>

           <div class="heading-elements">
           	 <div class="heading-btn-group">
                   
                     <a id="button-coppy" class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" data-toggle="modal" data-target="#modal-coppy">                     
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
             

                <h5 class="panel-title ">Danh sách kho</h5> 
               
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
                        <th>Mã kho</th>
                        <th>Tên kho</th>
                        <th>Địa chỉ</th>
                        
                        <th style="text-align: center">Control</th>  
                    </tr>
                </thead>

                <tbody>
                 @foreach($Stores as $key=>$value)
                    <tr>

                       <th><input class="check" type="checkbox" name="group[]" value="{{$value->id}}"/></th>
                       <th>{!!$value->id!!}</th>                     
                       <th><a href="#">{!!$value->name!!}</a></th>
                       <th>{!!$value->address!!}</th>  
                       
                       <th style="text-align: center">
                            
                       
                            <a  href="{{ route('admin.store.edit', $value->id) }}" title="Chỉnh sửa" class="text-success">
                                <i class="icon-pencil"></i>
                            </a>
                           
                            <form action="{{ route('admin.store.destroy',  $value->id ) }}" method="POST">
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