@extends('backend.layouts.master')
@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Thêm loại sản phẩm</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
            <li><a href="###">Loại sản phẩm</a></li>

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
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Thêm loại phẩm</legend>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên loại sản phẩm</label>
                                <input name="name" type="text" class="form-control" value="{!!old('name')!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
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

