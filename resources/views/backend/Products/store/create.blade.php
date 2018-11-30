@extends('backend.layouts.master')
@section('content')
<div class="row">
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Thêm sản phẩm</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
            <li><a href="###">Sản phẩm</a></li>

        </ul>


    </div>
    <div class="breadcrumb-line breadcrumb-line-component" style="margin-bottom: 15px;">
            <ul id="navMenus" class="nav nav-pills">
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products-all'))?'active':''}} text-center"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>   
                <li style="width: 150px;" class="{{(strpos(\Request::path(),'Products-in-store')|| strpos(\Request::path(),'course'))?'active':''}} text-center"><a href="{{ route('admin.productsInStore.index') }}">Kho</a></li>  
            </ul>
    </div>

</div>
<div class="content">
    <form action="{{ route('admin.productsInStore.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
          @if (Session::has('mss_error'))
          <div class="alert alert-danger alert-styled-left">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <span class="text-semibold">{{ Session::get('mss_error') }}</span>
          </div>
          @endif
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Thêm sản phẩm</legend>
                        <div class="row">
                              <div class="form-group col-md-4">
                                <label class="">Kho</label>
                                <select name="id_store" class="form-control select2">
                                    @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{(old('id_store')==$store->id)?'selected':''}}>{!!$store->name!!}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                          
                            <div class="form-group select-prd col-md-7">
                                <label class="required">Sản phẩm</label>
                                <select name="id_product" class="form-control product select2">
                                    @foreach($products as $product)
                                    <option value="{{ $product['id_product'] }}"  {{(old('id_product')==$store->$product['id'])?'selected':''}} data-image="{{ asset($product->image) }}" style="padding:20px">{{ $product['id_product'] }} - - {!!$product['name']!!}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('id_product', '<span class="text-danger">:message</span>') !!}
                            </div>


                        </div>
                        <div class=" group col-md-8">
                          
                        </div>

                        
                    
                    </fieldset>
                </div>


            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple">{{trans('base.submit')}} <i class="icon-arrow-right14 position-right"></i></button>
            </div>


        </div>
    </form>
</div>
</div>
@stop
@section('script')
@parent
<script>
  $(".select2").select2({
    templateResult: addUserPic,
        templateSelection: addUserPic
});
  
function addUserPic (opt) {
  if (!opt.id) {
    return opt.text;
  }               
  var optimage = $(opt.element).attr('data-image'); 
  if(!optimage){
    return opt.text;
  } else {
    var $opt = $(
    '<span class="select-prd"><img src="' + optimage + '" class="userPic" /> ' + $(opt.element).text() + '</span>'
    );
    return $opt;
  }
};
</script>
    <script type="text/javascript">
        

    function previewFile() {
     var preview=document.getElementById('img_load');
     var file    = document.querySelector('input[type=file]').files[0];
     
     var reader  = new FileReader();  
     
     reader.onloadend = function () {
     preview.src = reader.result;
     
          }
          if (file) {
            reader.readAsDataURL(file);
             
          } else {
             preview.src = "";
           
          }
        }
    </script>


<script>


   $(document).on('change', '.product', function () {
        var id_product = $(this).val();
        var id_store = $('select[name=id_store]').val();
        $.ajax({
            url: '{{ asset('/api/changeProduct') }}',
            method: 'POST',
            data: {
               id_product: id_product,
               id_store:id_store
            },
            success: function (html) {
              $('.group').each(function () {
                    if($(this).find('.content').length>0){
                      $(this).find('.content').remove();
                      $('.group').append(html);
                    }
                    else{
                      $('.group').append(html);
                    }

                    
                });
              
            }
        });
    });
</script>
<script >
  $(document).on('change','.add_number', function(){
    var id= $(this).attr('data');
    var value= $(this).val();
    var value2=$(this).closest('.group-add-qty').find('input[data-main='+id+']').val();
    $(this).closest('.group-add-qty').find('input[data-main='+id+']').val(parseInt(value2)+parseInt(value));
  });

</script>
@stop

{{-- <select name="id_size[]" id="id_size"  multiple="multiple" class="select-access-multiple-value"> --}}
  {{-- <input id="input-list" name="image[]" type="file" multiple> --}}