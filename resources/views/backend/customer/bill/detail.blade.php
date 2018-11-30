@extends('backend.layouts.master') 
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Chi tiết lịch sử mua hàng</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
            </div>
            <div class="heading-elements">
                 

            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
               {{--  <li><a href="{!!route('admin.customer.bill, $customer->id')!!}">Danh sách đơn hàng</a></li> 
 --}}
            </ul>
        </div>
         <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul id="navMenus" class="nav nav-pills">
               
               {{--  <li class="{{(strpos(\Request::path(),'bill'))?'active':''}}"><a href="{!!route('admin.customer.bill', $customer->id)!!}">Danh sách đơn hàng</a></li>  --}}  
                {{-- <li class="{{(strpos(\Request::path(),'congno'))?'active':''}}"><a href="{!!route('admin.customer.congno',$customer->id)!!}">Công nợ khách hàng</a></li>   --}}
            </ul>
        </div>
       

    </div>
    <div class="content">

        <!-- Basic datatable -->
       @yield('main')
        <!-- /basic datatable -->
    </div>
</div>
@stop