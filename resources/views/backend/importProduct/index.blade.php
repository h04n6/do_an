@section('style')
@parent
<!--Thêm file style--> 
<style>
    .dataTables_filter{
        display: none;
    }
    label{
        padding: 9px!important;
    }
</style>
@stop

@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Danh sách đơn hàng</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a href="">Danh sách đơn hàng</a></li>

            </ul>
        </div>
    </div>
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Công cụ tìm kiếm<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <form action="{{route('admin.customer.index')}}" method="GET">  
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="panel-body row">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="col-md-3 control-label">Nhập từ:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="keyword" value="{!!isset($search['keyword'])?$search['keyword']:''!!}">
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label class="col-md-3 control-label">Từ ngày:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker" name="start_date" value="{!!isset($search['start_date'])?$search['start_date']:''!!}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="col-md-3 control-label">Đến ngày:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datepicker" name="end_date" value="{!!isset($search['end_date'])?$search['end_date']:''!!}">
                            </div>
                        </div>  
                    </div>
                 

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary legitRipple">Tìm kiếm <i class="icon-arrow-right14 position-right"></i></button>
                    </div>

                </div>
            </form>
        </div>
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('base.list_customer')}}</h5>
                <div class="heading-elements">
                    <div class="heading-btn-group">
                        <a id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple"><i class="icon-database-export text-primary"></i><span>Xuất danh sách</span></a>
                    </div>
                </div>
            </div>    

            <table class="table datatable-basic">
                <thead>
                    <tr>
                      
                        <th>
                            <form action="{{route('admin.customer.export')}}" method="POST" class="form-group">  
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="styled" id="checkall" type="checkbox" name="group[]" value="0"/>
                            </form>
                        </th>
                        <th>Mã phiếu nhập</th>
                        <th>Kho nhập</th>
                        <th>Ngày nhập</th>
                        <th>Người nhập</th>
                        <th>Tổng tiền</th>
                        <th>Nợ</th>
                    
                        <th>{{trans('base.control')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($customers as $key=>$customer)
                    <tr>
                        
                        <th><input class="check styled" type="checkbox" name="group[]" value="{{$customer->id}}"/></th>
                        <td>{{$customer->id}}</td>
                        <td><a href="{{ route('admin.customer.detail',$customer->id) }}">{{$customer->name}}</a></td>
                        <td>{{$customer->city->name}}</td>

                        <td>{{$customer->county->name}}</td>
                        <td>{{$customer->ward->name}}</td>
                        
                        <td>{{$customer->created_at()}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->email}}</td>
                        <td class="text-center">
                            <a onclick="copyToClipboard('{{$customer->phone()}}')" title="{{trans('base.clipboard')}}">
                                <i class="icon-mobile"></i>
                            </a>
                            <form action="{!! route('admin.customer.destroy', $customer->id) !!}" method="POST" style="display: inline-block">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="{!! trans('base.delete') !!}" class="delete text-danger">
                                    <i class="icon-close2"></i>
                                </a>              
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /basic datatable -->
    </div>
</div>
@stop

@section('script')
@parent
<script>
    $('#button-export').click(function() {
        $('.form-group').submit();
    });
</script>
@stop