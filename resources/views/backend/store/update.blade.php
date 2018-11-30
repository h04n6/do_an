@extends('backend.layouts.master')
@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Cập nhật kho</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
            <li><a href="###">Kho</a></li>

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
    <form action="{{ route('admin.store.update', $Stores->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Cập nhật kho</legend>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="required">Tên kho</label>
                                <input name="name" type="text" class="form-control" value="{{$Stores->name}}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>

                        </div>
                        <div class="row">
                              <div class="form-group col-md-8">
                                <label class="required">Địa chỉ kho</label>
                                <input name="address" type="text" class="form-control" value="{{$Stores->address}}">
                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
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

