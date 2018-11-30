
@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('base.detail_agency')}}</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
            </div>
            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="{!!route('admin.order.index', $user->id)!!}">{{trans('base.list_order')}}</a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a href="{!!route('admin.user.index')!!}">{{trans('base.manage_agency')}}</a></li>
                <li>{{trans('base.detail_agency')}}</li>
            </ul>
        </div>
    </div>
    <div class="content">

        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Chi tiết doanh thu<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-xlg text-nowrap">
                        <tbody>
                            <tr>
                                <td class="col-md-4">
                                    <div class="media-left media-middle">
                                        <div id="tickets-status"><svg width="42" height="42"><g transform="translate(21,21)"><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path d="M1.1634144591899855e-15,19A19,19 0 0,1 -12.326087772183463,-14.459168725498339L-6.163043886091732,-7.229584362749169A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z" style="fill: rgb(41, 182, 246);"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(102, 187, 106);" d="M-12.326087772183463,-14.459168725498339A19,19 0 0,1 14.331188229058796,-12.474656065130077L7.165594114529398,-6.237328032565038A9.5,9.5 0 0,0 -6.163043886091732,-7.229584362749169Z"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(239, 83, 80);" d="M14.331188229058796,-12.474656065130077A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 7.165594114529398,-6.237328032565038Z" transform="translate(0,0)"></path></g></g></svg></div>
                                    </div>
                                    <div class="media-left">
                                        <h5 class="text-semibold no-margin">{{count($orders)}}</h5>
                                        <span class="text-muted"><span class="status-mark border-success position-left"></span> Số lượng đơn hàng</span>
                                    </div>
                                </td>
                                <td class="col-md-4">
                                    <div class="media-left media-middle">
                                        <div id="tickets-status"><svg width="42" height="42"><g transform="translate(21,21)"><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path d="M1.1634144591899855e-15,19A19,19 0 0,1 -12.326087772183463,-14.459168725498339L-6.163043886091732,-7.229584362749169A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z" style="fill: rgb(41, 182, 246);"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(102, 187, 106);" d="M-12.326087772183463,-14.459168725498339A19,19 0 0,1 14.331188229058796,-12.474656065130077L7.165594114529398,-6.237328032565038A9.5,9.5 0 0,0 -6.163043886091732,-7.229584362749169Z"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(239, 83, 80);" d="M14.331188229058796,-12.474656065130077A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 7.165594114529398,-6.237328032565038Z" transform="translate(0,0)"></path></g></g></svg></div>
                                    </div>

                                    <div class="media-left">
                                        <h5 class="text-semibold no-margin">{{number_format($orders->sum('price'), 0, ',', '.')}} {{trans('base.currency')}}</h5>
                                        <span class="text-muted"><span class="status-mark border-success position-left"></span>Tổng giá trị đơn hàng </span>
                                    </div>
                                </td>
                                <td class="col-md-4">
                                    <div class="media-left media-middle">
                                        <div id="tickets-status"><svg width="42" height="42"><g transform="translate(21,21)"><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path d="M1.1634144591899855e-15,19A19,19 0 0,1 -12.326087772183463,-14.459168725498339L-6.163043886091732,-7.229584362749169A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z" style="fill: rgb(41, 182, 246);"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(102, 187, 106);" d="M-12.326087772183463,-14.459168725498339A19,19 0 0,1 14.331188229058796,-12.474656065130077L7.165594114529398,-6.237328032565038A9.5,9.5 0 0,0 -6.163043886091732,-7.229584362749169Z"></path></g><g class="d3-arc" style="stroke: rgb(255, 255, 255); cursor: pointer;"><path style="fill: rgb(239, 83, 80);" d="M14.331188229058796,-12.474656065130077A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 7.165594114529398,-6.237328032565038Z" transform="translate(0,0)"></path></g></g></svg></div>
                                    </div>

                                    <div class="media-left">
                                        <h5 class="text-semibold no-margin">{{number_format($orders->sum('price_discount'), 0, ',', '.')}} {{trans('base.currency')}}</h5>
                                        <span class="text-muted"><span class="status-mark border-success position-left"></span>Tổng giá trị chiết khấu</span>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>	
                </div>
            </div>
        </div>
        <!-- /basic datatable -->

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('base.order_list')}}</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>{{trans('base.id')}}</th>
                        <th>{{trans('base.agency_name')}}</th>
                        <th>{{trans('base.status')}}</th>
                        <th>{{trans('base.request')}}</th>
                        <th>{{trans('base.created_at')}}</th>
                        <th>{{trans('base.updated_at')}}</th>
                        <th>{{trans('base.created_at')}}</th>
                        <th style="text-align: center">{{trans('base.update')}}</th>
                        <th style="text-align: center">{{trans('base.detail')}}</th>
                        <th>{{trans('base.delete')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $ukey=>$order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->fullname}}</td>
                        <td>
                            <a href="{{route('admin.order.toggle', ['id'=>$order->id, 'attribute'=>'status'])}}">
                                @if($order->status==1)
                                <span class="label bg-success-400">{{trans('base.activce')}}</span>
                                @else
                                <span class="label bg-grey-400">{{trans('base.pending')}}</span>
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="{{route('admin.order.toggle', ['id'=>$order->id, 'attribute'=>'printed'])}}">
                                @if($order->printed==1)
                                <span class="label bg-success-400">{{trans('base.requested')}}</span>
                                @else
                                <span class="label bg-grey-400">{{trans('base.pending')}}</span>
                                @endif
                            </a>
                        </td>
                        <td>{{number_format($order->price, 0, ',', '.')}}</td>
                        <td>{{number_format($order->price_discount, 0, ',', '.')}}</td>
                        <td>
                            {{$order->created_at}}
                        </td>

                        <th style="text-align: center" >
                            <a  href="{!!route('admin.order.edit', $order->id)!!}" title="Cập nhật" class="text-success">
                                <i class="icon-pencil"></i>
                            </a>
                        </th>
                        <th style="text-align: center" >
                            <a target="_blank" href="{!!route('admin.order.detail', $order->id)!!}" title="Chi tiết" class="text-success">
                                <i class="icon-file-text"></i>
                            </a>
                        </th>
                        <td>
                            <form action="{!! route('admin.order.destroy', $order->id) !!}" method="POST">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="{!! trans('backend/base.btn_delete') !!}" class="delete text-danger">
                                    <i class="icon-close2"></i>
                                </a>              
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>
<!-- /dashboard content -->

@stop
