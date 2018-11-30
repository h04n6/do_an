@extends('backend.layouts.master')
@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Cập nhật sản phẩm</span></h4>
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
    <form action="{{ route('admin.products.update', $products->id_product) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Cập nhật sản phẩm</legend>
                        <div class="row">
                          <div class="form-group col-md-2">
                                <label class="">Mã sản phẩm</label>
                                <input name="id_product" type="text" class="form-control"  style="background-color: #81F7D8; text-align: center;" readonly="readonly" value="{!!$products->id_product!!}">
                               
                          </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="required">Tên sản phẩm</label>
                                <input name="name" type="text" class="form-control" value="{{$products->name}}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">Nhãn hiệu</label>
                                <select name="id_manufacturer" class="form-control select2">
                                    @foreach($manuf as $manu)
                                    @if ($products->id_manufacturer==$manu->id)
                                    <option value="{{ $manu->id }}"  {{"selected= 'selected'"}}>{!!$manu->name!!}</option>
                                    @else <option value="{{$manu->id}}" >{{$manu->name}}</option>
                                     @endif
                                    @endforeach
                                </select>
                            </div>
                            

                        </div>
                        <div class="row">
 
                             <div class="form-group col-md-4">
                                <label class="">Giới tính</label>
                                <select name="gender" class="form-control select2">
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
                                <select name="id_type" class="form-control select2">
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
                            <div class="list-color-size">
                              <div class="row">
                            @foreach ($color as $colo)
                              <div class="singer-color-size col-md-12">
                             <div class="form-group col-md-4">
                                <label for="id_color" class="required">Màu sắc</label>
                                <select name="id_color[]" id="id_color" class="color1 select2">
                                    @foreach($colorAll as $col)
                                    @if ($colo->id_color==$col->id)
                                    <option value="{{ $col->id }}"  {{"selected= 'selected'"}}>{!!$col->color_name!!}</option>
                                    @else <option value="{{$col->id}}" >{{$col->color_name}}</option>
                                     @endif
                                    @endforeach
                                </select>
                                 {!! $errors->first('id_color', '<span class="text-danger">:message</span>') !!}
                            </div>
                                <div class="group-img row">
                                    {{-- <div class="form-group ">
                                    <label for="file" id="file" >Ảnh sản phẩm</label >
                                    <input class="input-list{{$colo->id_color}} " name="image_list[{{$colo->id_color}}][]" type="file" multiple> --}}
                                <div class="group-img-add col-md-10">
                                 @foreach ($images[$j] as $img)
                                   {{-- <div class="img-cl col-md-4"><img height="70px" width="70px" id="image" src="/{{$img}}" height="200px" /><span class="remove-img text-center">X</span> </div> --}}
                                   <div class="col-md-3">
                                <input type="hidden" name="image_old[{{$j}}][{{$i}}]" value="{!!is_null(old('image'))?$img:old('image')!!}">
                                <input type="file" name="image-list[{{$j}}][{{$i}}]" data-value="{!!is_null(old('image-list[$j][$i]'))?$img:old('image-list[$j][$i]')!!}" class="file-input-overwrite" data-field="image-list[{{$j}}][{{$i}}]" data-name="{!!is_null(old('image_name[$i]'))?$img:old('image_name[$i]')!!}" data-size="{!!$img!!}">
                                   </div>


                                     <i class="hidden {{$i++}} "></i>
                                @endforeach
                                @for ($i = 0; $i < 3-count($images[$j]); $i++)
                                 <div class="col-md-4">
                                    <input type="file" name="image-list[{{$j}}][]" class="file-input-overwrite" data-field="image-list[{{$j}}][]">
                                </div>
                                @endfor
                                </div>
                               {{--  <div class="col-md-3">
                                    <span class="btn btn-default btn-file"> Chọn ảnh
                                    <input type="file" name="image-list[{{$i}}][]" id="file" class="inputfile form-control" multiple="multiple"  />
                                </span>
                                </div> --}}
                                
                                
                                
                               
                                </div>
                               
                           </div>{{--singer-color-size--}}
                            <i class="hidden {{$j++}} "></i>
                            @endforeach
                            </div>

                          </div>
                         </div>
                         <div class="row" style="margin: 10px 0;">
                            
                         </div>
          
                        {{-- <div class="row">
                            <div class="form-group col-md-8 row">
                                <label for="file" id="file">Ảnh sản phẩm</label >
                                
                                <input type="file" name="image1[]" data-value="{!!is_null(old('image1'))?$products->image:old('image1')!!}" class="file-input-overwrite" data-field="image1[]" data-name="{!!is_null(old('image_name'))?$products->image_name:old('image_name')!!}" data-size="{!!$products->image_size!!}">
                            </div> 
                            
                         </div> --}}
                        
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
</div>

@stop
@section('script')
    <script type="text/javascript">
        

    function previewFile1() {

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

<script>    CKEDITOR.replace('editor1');</script>
<script>
    var $disabledResults = $(".select2");
    $disabledResults.select2();





  $(document).on('click', '.addSize', function () {
    var id_store = $('input[name=id_store]').val();
    var id_product = $('input[name=id_product]').val();
       $.ajax({
            url: '/api/addSizeOrColor',
            method: 'POST',
            data: {
               id_store: id_store,
               id_product: id_product,
               i: 1
            },
            success: function (html) {
               $('.list-size').append(html);
                $('.select').select2({});
            }
        });
  

    });

  $(document).on('click', '.addColor', function () {
    var id_store = $('input[name=id_store]').val();
    var id_product = $('input[name=id_product]').val();
       $.ajax({
            url: '/api/addSizeOrColor',
            method: 'POST',
            data: {
               id_store: id_store,
               id_product: id_product,
               i: 2
            },
            success: function (html) {
               $('.list-color').append(html);
                $('.select').select2({});
            }
        });
  

    });


</script>
<script>
  $(document).on('click', '.remove-img', function () {
   
    $(this).closest('.img-cl').remove('.img-cl');
  

    });

  $(document).on('change', 'input[type=file1]', function () {
    var file= $(this).val();
    var img= file.split('\\');

    if($(this).closest('.group-img').find('.group-img-add .img-cl').length<3)
    {
     $(this).closest('.group-img').find('.group-img-add').append(' <div class="img-cl col-md-4"><img height="70px" width="70px" id="image" src="/uploads/'+img[2]+'" height="200px" /><span class="remove-img text-center">X</span> </div>')
    }
    else{
        alert('Không được quá 3 ảnh!');
    }
   // var reader  = new FileReader();  
     
   //   reader.onloadend = function () {
   //   var src = reader.result;
   //  alert(src);
   //        }
   //        if (file) {
   //          reader.readAsDataURL(file);
             
   //        } else {
   //           preview.src = "";
           
   //        }
        

    });

</script>
@stop

