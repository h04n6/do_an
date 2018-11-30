@extends('backend.layouts.master')
@section('content')
<div class="modal fade" id="modal-color"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm màu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products.create_color') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                       <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Màu</label>
                                <input name="color_name" type="text" class="form-control" required="required" value="{!!old('name')!!}">
                               
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
<div class="modal fade" id="modal-manufacturer"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm nhãn hiệu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.manufacturer.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                       <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên nhãn hiệu</label>
                                <input name="name" type="text" class="form-control" required="required" value="{!!old('name')!!}">
                               
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
{{-- add loai sp --}}
<div class="modal fade" id="modal-product-type"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm loại sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.typeproduct.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                       <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên loại sản phẩm</label>
                                <input name="name" type="text" class="form-control" required="required" value="{!!old('name')!!}">
                               
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
{{-- end --}}
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
</div>
<div class="content">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Thêm sản phẩm</legend>
                        <div class="row">
                          <div class="form-group col-md-2">
                                <label class="">Mã sản phẩm</label>
                                <input name="id_product" type="text" class="form-control"  style="background-color: #81F7D8; text-align: center;" readonly="readonly" value="{!!$id_product!!}">
                               
                            </div>
                        </div>
                        <div class="row">
                          
                            <div class="form-group col-md-8">
                                <label class="required">Tên sản phẩm</label>
                                <input name="name" type="text" class="form-control" value="{!!old('name')!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>

                            

                        </div>
                        

                        <div class="row">
 
                             <div class="form-group col-md-4">
                                <label class="">Giới tính</label>
                                <select name="gender" class="form-control select2">
                                 @foreach($gender as $typ)
                                    <option value="{{ $typ->id }}"  {{(old('id_type')==$typ->id)?'selected':''}}>{!!$typ->name!!}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                           

                             <div class="form-group col-md-4">
                                <label class="">Loại sản phẩm</label>
                                <select name="id_type" class="form-control select2">
                                    @foreach($type as $typ)
                                    <option value="{{ $typ->id }}"  {{(old('id_type')==$typ->id)?'selected':''}}>{!!$typ->name!!}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-1">
                              <a class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" data-toggle="modal" data-target="#modal-product-type" style="    bottom: -30px;">       
                                <i class="icon-plus-circle2 text-primary"></i><span></span>
                            </a>
                            </div>

                        </div>
                         <div class="row">
                            <div class="list-color-size">
                              <div class="row">
                              <div class="singer-color-size">
                             <div class="form-group col-md-3">
                                <label for="id_color" class="required">Màu sắc</label>
                                <select name="id_color[]" id="id_color" class="color1 select2">
                                  <option value="" selected="selected">--Chọn màu--</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color->id }}"  {{(old('id_color')==$color->id)?'selected':''}}>{!!$color->color_name!!}</option>
                                    @endforeach
                                </select>
                                 {!! $errors->first('id_color', '<span class="text-danger">:message</span>') !!}

                            </div>
                            <div class="col-md-1">
                              <a id="button-color" class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" data-toggle="modal" data-target="#modal-color" style="    bottom: -30px;">       
                                <i class="icon-plus-circle2 text-primary"></i><span></span>
                            </a>
                            </div>

                           </div>{{--singer-color-size--}}
                            </div>

                          </div>
                         </div>
                          <div class="row form-group">
                             <button type="button" class="btn bg-teal-400 btn-labeled btn-rounded add"><b><i class=" icon-plus3"></i></b> Thêm màu</button>
                          </div>
                         
                         <div class="row">
                           <div class="form-group col-md-6">
                                <label class="">Nhãn hiệu</label>
                                <select name="id_manufacturer" class="form-control select2">
                                    @foreach($manuf as $manu)
                                    <option value="{{ $manu->id }}"  {{(old('id_type')==$manu->id)?'selected':''}}>{!!$manu->name!!}</option>
                                    @endforeach
                                </select>

                            </div>
                             <div class="col-md-1">
                              <a id="button-manufacturer" class="btn btn-link btn-float text-size-small has-text legitRipple text-slate" data-toggle="modal" data-target="#modal-manufacturer" style="    bottom: -30px;">       
                                <i class="icon-plus-circle2 text-primary"></i><span></span>
                            </a>
                            </div>
                         </div>
                  {{--       <div class="row">
                            <div class="form-group col-md-11">
                            <label for="file" id="file"  class="required">Ảnh sản phẩm</label >
                            
                            <input type="file" name="image" class="file-input-overwrite" data-field="image">
                            {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
                            </div>
                         </div> --}}
                        
                         <div class="row">
                        <div class="form-group">
                            <label class="required">Mô tả:</label>
                            <textarea name="description" id="editor1" rows="10" cols="80">{!!old('description')!!}</textarea>
                            {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                        </div>
                        </div>

                         <div class="row">
                             <div class="form-group col-md-4">
                                <label class="required">Giá nhập</label>
                                <input name="import_price" type="number" class="form-control" value="{!!old('import_price')!!}">
                              {!! $errors->first('import_price', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4">
                                <label class="required">Giá bán</label>
                                <input name="price" type="number" class="form-control" value="{!!old('price')!!}">
                              {!! $errors->first('price', '<span class="text-danger">:message</span>') !!}
                            </div>
                             <div class="form-group col-md-4">
                                <label class="">Giá khuyến mại</label>
                                <input name="promotion_price" type="number" class="form-control" value="{!!old('promotion_price')!!}">
                              {!! $errors->first('promotion_price', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>

                       <div class="row">
                        <div class="form-group col-md-3">
                        <label class="switch" style="">
                          <input type="checkbox" name="new">
                          <span class="slider round" ></span> 
                        </label>
                         <span>New!</span>
                         </div>
                         <div class="form-group col-md-3">
                        <label class="switch" style="">
                          <input type="checkbox" name="hot">
                          <span class="slider round" ></span> 
                        </label>
                         <span>Hot!</span>
                         </div>
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

</div>
<script>    CKEDITOR.replace('editor1');</script>
<script>
    var $disabledResults = $(".select2");
    $disabledResults.select2();

    $("#input-list").fileinput({
        uploadUrl: "{{ asset('uploads') }}",
        maxFileCount: 3
    });

  $(document).on('click', '.add', function () {
       $.ajax({
            url: '/api/addColor',
            method: 'GET',
            data: {
            },
            success: function (html) {
              
               $('.list-color-size').append(html);
                $('.select').select2({});
            }
        });
    });
   $(document).on('change', '.color1', function () {
        var i = $('.singer-color-size').length;

        $(this).addClass('changed');
        $.ajax({
            url: '{{ asset('/api/changeColorGetImg') }}',
            method: 'POST',
            data: {
               i: i
            },
            success: function (html) {

              $('.singer-color-size').each(function () {
                    if($(this).find('.changed').length>0){
                      $(this).find('.group-img').remove();
                       $(this).find('.changed').removeClass('changed');
                       $(this).append(html);
                         $(".input-list").fileinput({
                            uploadUrl: "{{ asset('uploads')}}",
                            maxFileCount: 3
                         });
                    }
                    
                });
              
            }
        });
    });
</script>
@stop

{{-- <select name="id_size[]" id="id_size"  multiple="multiple" class="select-access-multiple-value"> --}}
  {{-- <input id="input-list" name="image[]" type="file" multiple> --}}