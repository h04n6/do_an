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
                    <a href="{!!route('admin.manage.create')!!}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple"><i class="icon-plus-circle2 text-primary"></i><span>{{trans('base.add_user')}}</span></a>                 
                </div>
            </div>   
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a>{{trans('base.user')}}</a></li>
            </ul>
        </div>
    </div> 
    <div class="content">
<!--        @if (Session::has('success'))
        <div class="alert bg-success alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">{{ Session::get('success') }}</span>
        </div>
        @endif-->
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('base.list_user')}}</h5>            
            </div>   
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{trans('base.name')}}</th>               
                        <th>{{trans('base.role')}}</th>
                        <th>{{trans('base.status')}}</th>        
                        <th class="text-center">{{trans('base.control')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $key=>$admin)
                    <tr> 
                        <td>{{$key+1}}</td> 
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->role->name}}
                        <td class="text-center">
                            <a href="{{route('admin.user.toggle',$admin->id)}}">
                                @if($admin->status==1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-default">Disabled</span>
                                @endif
                            </a>
                        </td>
                        <td style="text-align: center" > 
                            <a  href="{!!route('admin.manage.edit',$admin->id)!!}" title="{{trans('base.update')}}" class="text-success">
                                <button type="button" class="btn text-success btn-flat btn-icon">
                                    <i class="icon-pencil"></i>
                                </button>
                            </a>
                            <button type="button" class="btn text-warning-600 btn-flat btn-icon">
                                <form action="{!!route('admin.manage.delete',$admin->id)!!}" method="POST" class="del">
                                    {!! csrf_field() !!}
                                    <a title="{!! trans('backend/base.btn_delete') !!}" class="delete text-danger">
                                        <i class="icon-close2"></i>
                                    </a>              
                                </form>
                            </button>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- /basic datatable -->
    </div>
</div>
@stop
