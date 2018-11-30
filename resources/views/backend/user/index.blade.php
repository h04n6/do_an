@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('base.user')}}</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
            </div>
            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="{!!route('admin.user.create')!!}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple"><i class="icon-plus-circle2 text-primary"></i><span>Thêm tài khoản</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a href="{!!route('admin.user.index')!!}">{{trans('base.user')}}</a></li>
            </ul>
        </div>
    </div>
    <div class="content">

        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('base.list_user')}}</h5> 
            </div>   
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>{{trans('base.id')}}</th>
                        <th>{{trans('base.username')}}</th>
                        <th>{{trans('base.name')}}</th>
                        <th>{{trans('base.role')}}</th>
                        <th>{{trans('base.created_at')}}</th>
                        <th>{{trans('base.control')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $key=>$user)
                    <tr>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /basic datatable -->
    </div>
</div>
@stop

