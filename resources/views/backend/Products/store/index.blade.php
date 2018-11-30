@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->

<div class="modal fade" id="modal-coppy"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 832px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Chuyển kho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products.warehouseTransfer') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                   
                     <div class="row">
                          <div class="form-group col-md-3"></div>
                             <div class="form-group col-md-3">
                                <label class="">Từ kho </label>
                                <input name="id_store1" type="text" readonly="readonly" class="form-control" value="{{$id_store}}">

                            </div>

                            <div class="form-group col-md-3">
                                <label class="">Đến kho </label>
                                  <select name="id_store2" class="form-control select-search">
                                      @foreach($store as $sto)
                                       @if ($id_store==$sto->id)
                                      <option value="{{ $sto->id }}" {{"disabled"}}>{!!$sto->name!!}</option>
                                      @else <option value="{{$sto->id}}" >{{$sto->name}}</option>
                                      @endif
                                      @endforeach
                                  </select>

                            </div>

                             <div class="form-group col-md-3"></div>
                        </div>

                       <div class="list-add" >
                          <div class="content-add" style="height: 300px;">
                            <div class="row">
                             <div class="form-group col-md-8 ">
                                <label class="">Chọn sản phẩm</label>
                                <select name="id[]" class="form-control select2 product" >
                                    @foreach($products as $key=>$value)
                                    <option value="{{ $value->id_product }}" > {{ $value->id_product }} - {!!$value->name!!}</option>
                                     @endforeach
                                </select>

                            </div>
                            </div>
                           
                                   <div class="form-group list-size-color" style="height: 180px;">
                                  </div>
                            
                          </div>
                        </div> 
                                 
                        
                          <button type="button" class="btn bg-teal-400 btn-labeled btn-rounded add"><b><i class=" icon-plus3"></i></b> Thêm sản phẩm</button>
                   
                        <div class="text-right">
                            <button type="submit" id="submit-st" class="btn btn-primary legitRipple">{{trans('base.submit')}} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                </form>
            </div>

        </div>

    </div>
</div>


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
                <li><a href="">Kho sản phẩm</a></li>

            </ul>
        </div>
   </div>
  <div class="breadcrumb-line breadcrumb-line-component" style="margin-bottom: 15px;">
            <ul id="navMenus" class="nav nav-pills">
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products-all'))?'active':''}} text-center"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>   
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products-in-store')|| strpos(\Request::path(),'course'))?'active':''}} text-center"><a href="{{ route('admin.productsInStore.index') }}">Kho</a></li>  
            </ul>
    </div>

 <div class="panel panel-flat">
  
            <div class="panel-heading "> 
                <h5 class="panel-title col-md-6">Danh sách sản phẩm</h5>
                   <div class="form-group col-md-6 text-right">
                    <form class="form-show col-md-5" action="{{ route('admin.productsInStore.index') }}" method="GET"> 
                      <div class=" ">
                      <select name="id_store" id="load" class="form-control select-search">
                          @foreach($store as $sto)
                           @if ($id_store==$sto->id)
                          <option value="{{ $sto->id }}" {{"selected= 'selected'"}}>{!!$sto->name!!}</option>
                          @else <option value="{{$sto->id}}" >{{$sto->name}}</option>
                          @endif
                          @endforeach
                      </select>
                    </div>
                    </form>
                    <div class="col-md-7">
                    <a href="{{ route('admin.productsInStore.create')}}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-plus-circle2 text-primary"></i><span>Cập nhật</span>
                    </a>
                     <a id="button-coppy" class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" data-toggle="modal" data-target="#modal-coppy">                     
                        <i class=" icon-database-refresh"></i><span>Chuyển kho</span>
                    </a>

                     <a id="button-delete" class="btn btn-link btn-float text-size-small has-text legitRipple">
                        <i class="icon-trash icon_delete"></i><span>Xóa</span>
                    </a>
                  </div>
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
                        <th width="5%">Mã Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                       {{--  <th>Giới tính</th>
                        <th>Loại sản phẩm</th> --}}
                        <th>Số lượng tồn</th>
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

                      @foreach ($pro_store as $pr_st)
                        @if ($id_store==$pr_st->id_store && $pr_st->id_product==$value->id_product)
                         <th>{!!$pr_st->number!!}</th>
                        @endif
                      @endforeach
                
                      
                       <th>{!!$value->price!!}</th>
                       <th>{!!$value->promotion_price!!}</th>
                       <th><img id="img_load" src="/{{$value->image}}" style="height: 50px; width: 50px;"> </th>
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
{{--                             
                       
                            <a  href="{{ route('admin.products.edit',['id_product' => $value->id_product , 'id_store' => $id_store ] ) }}" title="Chỉnh sửa" class="text-success">
                                <i class="icon-pencil"></i>
                            </a> --}}
                           
                            <form action="{{ route('admin.productsInStore.destroyInStore',['id_product'=>$value->id_product ,'id_store'=>$id_store]) }}" method="POST">
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


    //   $(document).on('change', '.product', function () {
  
    //     var id = $(this).val();
    //     var id_store = $('input[name=id_store1]').val();
    //      $(this).addClass('changed');
    //     $.ajax({
    //         url: '/api/getNumber',
    //         method: 'POST',
    //         data: {
    //            id: id,
    //            id_store: id_store
    //         },
    //         success: function (html) {

    //            $('.content-add').each(function () {
    //                 if($(this).find('.changed').length>0){
                      
    //                    $(this).find('#number').attr('placeholder','Max : '+ html);
    //                   $(this).find('#number').attr('max',html);
    //                     $(this).find('.changed').removeClass('changed');

    //                 }
                    
    //             });
               
    //         }
    //     });
    // });


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