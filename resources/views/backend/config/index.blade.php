@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><a href="{{route('admin.index')}}"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">{{trans('base.config')}}</span></h4>

            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li>{{trans('base.config')}}</li>
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
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title"><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('admin.config.update', ['config'=>$config->id])}}">
                    <input type="hidden" name="id" value="1">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="text-semibold">
                                            <i class="icon-file-text2 position-left"></i>
                                            Thông tin chung
                                            <a class="control-arrow" data-toggle="collapse" data-target="#demo1">
                                                <i class="icon-circle-down2"></i>
                                            </a>
                                        </legend>

                                        <div class="collapse in" id="demo1">
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label required">Tên Website:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="title" value="{{is_null(old('title'))?$config->title:old('title')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Tên công ty:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="company_name" value="{{is_null(old('company_name'))?$config->company_name:old('company_name')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label">Thẻ meta:</label>

                                                <label class="col-lg-12 control-label">description:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="description" name="description" value="{{is_null(old('description'))?$config->description:old('description')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">keywords:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="keywords" name="keywords" value="{{is_null(old('keywords'))?$config->keywords:old('keywords')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">working hours:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="working_hours" name="working_hours" value="{{is_null(old('working_hours'))?$config->working_hours:old('working_hours')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">address:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="address" name="address" value="{{is_null(old('address'))?$config->address:old('address')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">geo address:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="geo_address" name="geo_address" value="{{is_null(old('geo_address'))?$config->geo_address:old('geo_address')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">hotline:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="hotline" name="hotline" value="{{is_null(old('hotline'))?$config->hotline:old('hotline')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">mobile:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="mobile" name="mobile" value="{{is_null(old('mobile'))?$config->mobile:old('mobile')}}" class="form-control" placeholder="">

                                                </div>

                                                <label class="col-lg-12 control-label">email:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="email" name="email" value="{{is_null(old('email'))?$config->email:old('email')}}" class="form-control" placeholder="">

                                                </div>
                                                <!--
                                                <label class="col-lg-12 control-label">business registration certificate:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="business_registration_certificate" name="business_registration_certificate" value="" class="form-control" placeholder="">

                                                </div>-->
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend class="text-semibold">
                                            <i class="icon-file-text2 position-left"></i>
                                            Thông tin khác
                                            <a class="control-arrow" data-toggle="collapse" data-target="#demo2">
                                                <i class="icon-circle-down2"></i>
                                            </a>
                                        </legend>
                                        <div class="collapse in" id="demo2">
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label">Mạng xã hội:</label>

                                                <label class="col-lg-12 control-label">facebook:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="facebook" name="facebook" value="{{is_null(old('facebook'))?$config->facebook:old('facebook')}}" class="form-control" placeholder="">
                                                </div>

                                                <label class="col-lg-12 control-label">google plus:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="google_plus" name="google_plus" value="{{is_null(old('google_plus'))?$config->google_plus:old('google_plus')}}" class="form-control" placeholder="">
                                                </div>

                                                <label class="col-lg-12 control-label">youtube channel:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="youtube_channel" name="youtube_channel" value="{{is_null(old('youtube_channel'))?$config->youtube_channel:old('youtube_channel')}}" class="form-control" placeholder="">
                                                </div>

                                                <label class="col-lg-12 control-label">twitter:</label>
                                                <div class="col-lg-12">
                                                    <input type="text" data-field="twitter" name="twitter" value="{{is_null(old('twitter'))?$config->twitter:old('twitter')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group" data-field="image">
                                                <label class="col-lg-12">Image:</label>
                                                <div class="col-lg-12"> 
                                                    <input type="file" name="image" data-value="{!!is_null(old('image'))?$config->image:old('image')!!}" class="file-input-overwrite" data-field="image" data-name="{!!is_null(old('image_name'))?$config->image_name:old('image_name')!!}" data-size="{!!$config->image_size!!}">
                                                    {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group" data-field="icon">
                                                <label class="col-lg-12">Logo:</label>
                                                <div class="col-lg-12"> 
                                                    <input type="file" name="icon" data-value="{!!is_null(old('icon'))?$config->icon:old('icon')!!}" class="file-input-overwrite" data-field="icon" data-name="{!!is_null(old('icon_name'))?$config->icon_name:old('icon_name')!!}" data-size="{!!$config->icon_size!!}">
                                                    {!! $errors->first('icon', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12">{{trans('base.favicon')}}</label>
                                                <div class="col-lg-12"> 
                                                    <input type="file" name="favicon" data-value="{!!is_null(old('favicon'))?$config->favicon:old('favicon')!!}" class="file-input-overwrite" data-field="favicon" data-name="{!!is_null(old('favicon_name'))?$config->favicon_name:old('favicon_name')!!}" data-size="{!!$config->favicon_size!!}">
                                                    {!! $errors->first('favicon', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Lưu thông tin <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
@stop