
@extends('backend.layouts.master')
@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('base.manage_agency')}}</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>

    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i> {{trans('base.system')}}</a></li>
            <li><a href="{!!route('admin.customer.index')!!}">{{trans('base.manage_agency')}}</a></li>
            @if($customer->parent_id==1)
            <li>{{trans('base.update_manage_agency')}}</li>
            @else
            <li><a href="{!!route('admin.customer.index', $customer->parent_id)!!}">{{trans('base.agency')}}</a></li>
            <li>{{trans('base.update_agency')}}</li>
            @endif
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
    <form action="{!!route('admin.customer.update', $customer->id)!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <input type="hidden" name="parent" value="{!!$customer->parent_id!!}" />
        <input type="hidden" name="role_id" value="{!!$customer->role_id!!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i> Tạo mới {!!$customer->parent_id==1?'quản lý':''!!} đại lý </legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.customername')}}</label>
                                <input name="customername" type="text" class="form-control" value="{!!!is_null(old('customername'))?old('customername'):$customer->customername!!}">
                                {!! $errors->first('customername', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required">{!!$customer->parent_id==1?trans('base.manage_agency_name'):trans('base.agency_name')!!}</label>
                                <input name="fullname" type="text" class="form-control" value="{!!!is_null(old('fullname'))?old('fullname'):$customer->fullname!!}">
                                {!! $errors->first('fullname', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{trans('base.password')}}</label>
                                <input name="password" type="password" class="form-control" value="{!!old('fullname')!!}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{trans('base.password_confirm')}}</label>
                                <input name="password_confirmation" type="password" class="form-control" value="{!!old('password_confirmation')!!}">
                                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label class="required">{{trans('base.discount')}}</label>
                                <div class="input-group">
                                    <input name="discount" type="number" class="form-control" value="{!! !is_null(old('discount'))?old('discount'):$customer->discount!!}">
                                    <span class="input-group-addon">%</span>
                                </div>

                                {!! $errors->first('discount', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-10 col-md-offset-1">
                                <label>{{trans('base.address')}}</label>
                                <input name="address" type="text" class="form-control" value="{!! !is_null(old('address'))?old('address'):$customer->address!!}">
                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('base.tel')}}</label>
                            <div class="input-group">
                                <span class="input-group-addon">(+84)</span><input name="tel" type="number" class="form-control" value="{!! !is_null(old('tel'))?old('tel'):$customer->tel!!}">
                            </div>
                            {!! $errors->first('tel', '<span class="text-danger">:message</span>') !!}
                        </div>


                    </fieldset>
                </div>


            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>


        </div>
    </form>
</div>
@stop

