@extends('backend.layouts.master')
@section('content')

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
   @if (Session::has('success'))
    <div class="alert bg-success alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ Session::get('success') }}</span>
    </div>
    @endif
    <form action="{{ route('admin.products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Cập nhật sản phẩm</legend>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên sản phẩm</label>
                                <input name="name" type="text" class="form-control" value="{{$products->name}}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>

                            

                        </div>
                        <div class="row">
 
                             <div class="form-group col-md-4">
                                <label class="">Giới tính</label>
                                <select name="gender" class="form-control ">
                                   @if ($products->gender==0)
                                    <option value="0" selected="true" >Nam</option>
                                    <option value="1" >Nữ</option>
                                  
                                   @else
                                   <option value="0" >Nam</option>
                                    <option value="1" selected="true"  >Nữ</option>
                                    @endif
                                </select>
                            </div>
                           

                             <div class="form-group col-md-4">
                                <label class="">Loại sản phẩm</label>
                                <select name="id_type" class="form-control ">
                                    @foreach($type as $typ)
                                    @if ($products->id_type==$typ->id)
                                    <option value="{{ $typ->id }}"  {{"selected= 'selected'"}}>{!!$typ->name!!}</option>
                                    @else <option value="{{$typ->id}}" >{{$typ->name}}</option>
                                     @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                         <div class="row">
                             <div class="form-group col-md-4">
                                <label class="required">Màu sắc</label>
                                <input name="color" type="text" class="form-control" value="{!!$products->color!!}">
                               {!! $errors->first('color', '<span class="text-danger">:message</span>') !!}
                            </div>
                             <div class="form-group col-md-4">
                                <label class="required">Kích cỡ</label>
                                <input name="size" type="text" class="form-control" value="{!!$products->size!!}">
                                 {!! $errors->first('size', '<span class="text-danger">:message</span>') !!}
                            </div>
                         </div>
                        <div class="row">
                            <div class="form-group col-md-8 row">
                                <label for="file" id="file">Ảnh sản phẩm</label >
                                <input type="hidden" name="image_old" value="{!!is_null(old('image'))?$products->image:old('image')!!}">
                                <input type="file" name="image" data-value="{!!is_null(old('image'))?$products->image:old('image')!!}" class="file-input-overwrite" data-field="image" data-name="{!!is_null(old('image_name'))?$products->image_name:old('image_name')!!}"data-size="{!!$products->image_size!!}">
                            </div>

                         </div>
                        
                         <div class="row">
                        <div class="form-group">
                            <label class="required">Mô tả:</label>
                            <textarea name="description" id="editor1" rows="10" cols="80">{!!$products->description!!}</textarea>
                            {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                        </div>
                        </div>

                         <div class="row">
 
                            <div class="form-group col-md-4">
                                <label class="required">Giá sản phẩm</label>
                                <input name="price" type="number" class="form-control" value="{!!$products->price!!}">
                              {!! $errors->first('price', '<span class="text-danger">:message</span>') !!}
                            </div>
                             <div class="form-group col-md-4">
                                <label class="">Giá giá khuyến mại</label>
                                <input name="promotion_price" type="number" class="form-control" value="{!!$products->promotion_price!!}">
                              {!! $errors->first('promotion_price', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>

                       <div class="row">
                        <div class="form-group col-md-3">
                        <label class="switch" style="">
                          @if ($products->new==1)
                             <input type="checkbox" name="new" checked="true">
                             @else <input type="checkbox" name="new">
                          @endif
                         
                          <span class="slider round" ></span> 
                        </label>
                         <span>New!</span>
                         </div>
                         <div class="form-group col-md-3">
                        <label class="switch" style="">
                          @if ($products->hot==1)
                          <input type="checkbox" name="hot" checked="true">
                          @else <input type="checkbox" name="hot">
                          @endif
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
<script type="text/javascript">
    

</script>
@stop

