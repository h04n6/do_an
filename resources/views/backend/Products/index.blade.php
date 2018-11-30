@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->

   <div class="page-header">
   	<div class="page-header-content">
   		<div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class=" text-semibold ">Sản phẩm</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
      </div>

   	</div>
    <div style="margin: 15px 0;" class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a href="{!!route('admin.customer.index')!!}">Sản phẩm</a></li>

            </ul>
        </div>
   </div>
   <div class="breadcrumb-line breadcrumb-line-component" style="margin-bottom: 15px;">
            <ul id="navMenus" class="nav nav-pills">
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products'))?'active':''}} text-center"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>   
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products-in-store')|| strpos(\Request::path(),'course'))?'active':''}} text-center"><a href="{{ route('admin.productsInStore.index') }}">Kho</a></li>  
            </ul>
    </div>

 <div class="panel panel-flat">
  
            <div class="panel-heading "> 
                <h5 class="panel-title col-md-8">Danh sách sản phẩm</h5>
                <div class="col-md-4 text-right">
                    <a href="{{ route('admin.products.create')}}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-plus-circle2 text-primary"></i><span>Tạo mới</span>
                    </a>
                     <a id="button-delete" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-trash icon_delete"></i><span>Xóa</span>
                    </a>
                  </div>
            </div>   

            <table class="table datatable-basic">
                <thead>
                    <tr>
                    
                        <th width="5px">
                        <form action="{{ route('admin.products.toggleGroup') }}" method="POST" class="form-group">  
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="styled checked" id="checkall" type="checkbox" name="group[]" value="0">
                        </form>
                          </th>
                        <th>Mã Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Giá nhập</th>
                        <th>Giá gốc</th>
                        <th>Giá khuyến mại</th>
                        <th>Ảnh</th>
                        <th>Tình trạng</th>

                        <th style="text-align: center">Control</th>  
                    </tr>
                </thead>

                <tbody>
                 @foreach($products as $key=>$value)
                    <tr>

                       <th><input class="check" type="checkbox" name="group[]" value="{{$value->id_product}}"/></th>
                       <th>{!!$value->id_product!!}</th>                     
                       <th><a href="#">{!!$value->name!!}</a></th>
                       <th>{{$value->type->name}}</th>
                       <th>{{$value->import_price}}</th>

                       <th>{!!$value->price!!}</th>
                       <th>{!!$value->promotion_price!!}</th>
                       <th><img id="img_load" src="{{ asset($value->image) }}" style="height: 50px; width: 50px;"> </th>
                       <th>
                        <a href="{{route('admin.products.changeStatus',['id'=>$value->id_product,'name'=>'new'])}}"> 
                       @if($value->new == 1)
                       	  <span class="label success" style="margin: 3px auto;">New</span>
                       	  @else
                       	  <span class="label label-default" style="margin: 3px auto;">New</span>
                       @endif
                     </a>
                     <a href="{{route('admin.products.changeStatus',['id'=>$value->id_product,'name'=>'hot'])}}"> 
                        @if($value->hot == 1)
                          <span class="label success">Hot</span>
                          @else
                          <span class="label label-default">Hot</span>
                       @endif
                     </a>
                       </th>
                     

                       <th style="text-align: center">
                            
                       
                            <a  href="{{ route('admin.products.edit',['id_product' => $value->id_product ] ) }}" title="Chỉnh sửa" class="text-success">
                                <i class="icon-pencil"></i>
                            </a>
                           
                            <form action="{{ route('admin.products.destroy',['id_product'=>$value->id_product ]) }}" method="POST">
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
 $('.select2').select2({});


</script>
<script>
    $('#load').change(function () {
        $('.form-show').submit();
    });



      $(document).on('change', '.product', function () {
  
        var id = $(this).val();
        var id_store = $('input[name=id_store1]').val();
        var i = $('.list-size-color').length;

            $(this).addClass('changed');
        $.ajax({
            url: '{{ asset('/api/getSizeAndColor') }}',
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


  
// $(document).on('change', '#numberSize', function () {
//     var value = $(this).val();
//     var total = $('#totalsize').val();
      
//       $('#totalsize').attr('value',parseInt(total)+parseInt(value));
  

//     });

   



  $(document).on('click', '.add', function () {
    var id_store = $('input[name=id_store1]').val();
       $.ajax({
            url: '{{ asset('/api/addSP') }}',
            method: 'POST',
            data: {
                id_store: id_store
            },
            success: function (html) {
               $('.list-add').append(html);
                $('.select').select2({});
            }
        });
  

    });

       

     
   
</script>

@stop