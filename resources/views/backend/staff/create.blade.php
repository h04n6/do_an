
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
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}} </a></li>
            <li><a href="{!!route('admin.customer.index')!!}"> {{trans('base.manage_agency')}}</a></li>
            @if($parent==1)
            <li>{{trans('base.create_manage_agency')}}</li>
            @else
            <li><a href="{!!route('admin.customer.index', $parent)!!}">{{trans('base.agency')}}</a></li>
            <li>{{trans('base.create_agency')}}</li>
            @endif
        </ul>
    </div>
</div>


<div class="content">
    <form action="{!!route('admin.customer.store')!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <input type="hidden" name="parent_id" value="{!!$parent!!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i> {{trans('base.create')}}</legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.customername')}}</label>
                                <input name="customername" type="text" class="form-control" value="{!!old('customername')!!}">
                                {!! $errors->first('customername', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required">{!!$parent==1?trans('base.manage_agency_name'):trans('base.agency_name')!!}</label>
                                <input name="fullname" type="text" class="form-control" value="{!!old('fullname')!!}">
                                {!! $errors->first('fullname', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.password')}}</label>
                                <input name="password" type="password" class="form-control" value="{!!old('password')!!}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.password_confirm')}}</label>
                                <input name="password_confirmation" type="password" class="form-control" value="{!!old('password_confirmation')!!}">
                                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label class="required">{{trans('base.discount')}}</label>
                                <div class="input-group">
                                    <input name="discount" type="number" class="form-control" value="{!!old('discount')!!}">
                                    <span class="input-group-addon">%</span>
                                </div>
                                {!! $errors->first('discount', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-10 col-md-offset-1">
                                <label>{{trans('base.address')}}</label>
                                <input name="address" type="text" class="form-control" value="{!!old('address')!!}">
                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('base.tel')}}</label>
                            <div class="input-group">
                                <span class="input-group-addon">(+84)</span>
                                <input name="tel" type="number" class="form-control" value="{!!old('tel')!!}">
                            </div>
                            {!! $errors->first('tel', '<span class="text-danger">:message</span>') !!}
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

