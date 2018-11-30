@extends('backend.layouts.master')
@section('content')
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('base.user')}}</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>

    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href=""><i class="icon-home2 position-left"></i>{{trans('base.system')}} </a></li>
            <li><a href="{!!route('admin.manage')!!}">Quản lý tài khoản hệ thống</a></li>

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
    <form action="{!!route('admin.manage.update',$admin->id)!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>{{trans('base.update')}} {{trans('base.user')}}</legend>     
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.name')}}</label>
                                <input name="name" type="text" class="form-control" value="{!!!is_null(old('name'))?old('name'):$admin->name!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>                      
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <p><input type="checkbox" id="changepassword" name="changepassword" class=""><i>Thay đổi mật khẩu</i></p>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required">{{trans('base.password')}}</label>
                            <input name="password" type="password" class="form-control password" disabled>
                            {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">{{trans('base.password_confirm')}}</label>
                            <input name="password_confirmation" type="password" class="form-control password" disabled>
                            {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">{{trans('base.role')}}</label><br>
                        @if($admin->role_id ==2)
                        <label class="radio-inline">
                            <input name="role_id" value="2" checked="" type="radio">Nhân viên bán hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="3" type="radio">Nhân viên quản lý kho
                        </label>
                         <label class="radio-inline">
                            <input name="role_id" value="4" type="radio">Nhân viên chăm sóc khách hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="5" type="radio">Nhân viên quản lý đăng tin.
                        </label> 
                        @elseif($admin->role_id ==3)
                       <label class="radio-inline">
                            <input name="role_id" value="2" type="radio">Nhân viên bán hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="3" checked="" type="radio">Nhân viên quản lý kho
                        </label>
                         <label class="radio-inline">
                            <input name="role_id" value="4" type="radio">Nhân viên chăm sóc khách hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="5" type="radio">Nhân viên quản lý đăng tin.
                        </label>
                         @elseif($admin->role_id ==4)
                         <label class="radio-inline">
                            <input name="role_id" value="2" type="radio">Nhân viên bán hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="3"  type="radio">Nhân viên quản lý kho
                        </label>
                         <label class="radio-inline">
                            <input name="role_id" value="4" checked="" type="radio">Nhân viên chăm sóc khách hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="5" type="radio">Nhân viên quản lý đăng tin.
                        </label> 
                        @elseif($admin->role_id ==5)
                         <label class="radio-inline">
                            <input name="role_id" value="2" type="radio">Nhân viên bán hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="3"  type="radio">Nhân viên quản lý kho
                        </label>
                         <label class="radio-inline">
                            <input name="role_id" value="4" type="radio">Nhân viên chăm sóc khách hàng
                        </label>
                        <label class="radio-inline">
                            <input name="role_id" value="5" checked="" type="radio">Nhân viên quản lý đăng tin.
                        </label>
                        @endif
                    </div>
                </div>
                </fieldset>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary legitRipple">{{trans('base.submit')}} <i class="icon-arrow-right14 position-right"></i></button>
        </div>
    </form>
</div>
@stop
@section('script')
@parent
<script>
    $(document).ready(function () {
        $("#changepassword").change(function () {
            if ($(this).is(":checked")) {
                $(".password").removeAttr('disabled');
            } else {
                $(".password").attr('disabled', '');
            }
        });
    });
</script>
@stop

