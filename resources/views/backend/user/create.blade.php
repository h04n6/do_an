 
@extends('backend.layouts.master')
@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('school.manage_school')}}</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>

    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}} </a></li>
            <li><a href="{!!route('admin.user.index')!!}"> {{trans('base.manage_user')}}</a></li>

        </ul>
    </div>
</div>
<div class="content">
    <form action="{!!route('admin.user.store')!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i> {{trans('base.create')}}</legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.username')}}</label>
                                <input name="username" type="text" class="form-control" value="{!!old('username')!!}">
                                {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required">{{trans('base.name')}}</label>
                                <input name="name" type="text" class="form-control" value="{!!old('name')!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
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

                        <div class="form-group">
                            <label class="required">{{trans('base.role')}}</label>
                            <select name="role_id" class="form-control">
                                @foreach($provil as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('role_id', '<span class="text-danger">:message</span>') !!}
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

