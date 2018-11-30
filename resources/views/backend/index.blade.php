@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->

<div class="row">
    <div class="report">
        <div class="col-md-12"><h4 class="dashboard-title"><i class="fa fa-signal"></i>Hoạt động hôm nay</h4></div>
        <div class="box-head col-md-4">
            <div class="report-box box-green">
                <div class="infobox-icon">
                    <i class="fa fa-signal"></i>
                </div>
                <div class="infobox-data">
                    <h3 class="infobox-title">Tiền bán hàng</h3>
                    <span class="infobox-data-number text-center">0</span>
                </div>
            </div>
        </div>
        <div class="box-head col-md-4">
            <div class="report-box box-blue">
                <div class="infobox-icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="infobox-data">
                    <h3 class="infobox-title">Số đơn hàng:</h3>
                    <span class="infobox-data-number text-center">{{count($bill)}}</span>

                    <h3 class="infobox-title">Số sản phẩm:</h3>
                    <span class="infobox-data-number text-center">{{($qty_saled_pd)}}</span>
                </div>
            </div>
        </div>
        <div class="box-head col-md-4">
            <div class="report-box box-red">
                <div class="infobox-icon">
                    <i class="fa fa-undo"></i>
                </div>
                <div class="infobox-data">
                    <h3 class="infobox-title">Hàng khách trả</h3>
                    <span class="infobox-data-number">0</span>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="row" style="background: #efefef; margin: 20px 0; overflow: hidden; ">
    <div class="col-md-4">
        <div class="widget widget-blue">
            <div class="widget-header">
                <h3 class="widget-title"><i class="fa fa-signal"></i>Hoạt động</h3>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="info col-xs-7">Tiền bán hàng</div>
                    <div class="info col-xs-5 data text-right">{{$total_bill}}</div>
                    <div class="info col-xs-7">Số đơn hàng</div>
                    <div class="info col-xs-5 data text-right">{{count($bill)}}</div>
                    <div class="info col-xs-7">Số sản phẩm</div>
                    <div class="info col-xs-5 data text-right">{{$qty_saled_pd}}</div>
                    <div class="info col-xs-7">Khách hàng trả</div>
                    <div class="info col-xs-5 data text-right">0</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget widget-orange">
            <div class="widget-header">
                <h3 class="widget-title"><i class="fa fa-tags"></i>Thông tin kho</h3>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="info col-xs-7">Tồn kho</div>
                    <div class="info col-xs-5 data text-right">{{$total_prd_st}}</div>
                    <div class="info col-xs-7">Hết Hàng</div>
                    <div class="info col-xs-5 data text-right">{{$out_off_stock}}</div>
                    <div class="info col-xs-7">Sắp hết hàng</div>
                    <div class="info col-xs-5 data text-right">{{$out_off_stock2}}</div>
                    <div class="info col-xs-7">Vượt định mức</div>
                    <div class="info col-xs-5 data text-right">0</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget widget-green">
            <div class="widget-header">
                <h3 class="widget-title"><i class="fa fa-barcode"></i>Thông tin sản phẩm</h3>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="info col-xs-7">sản phẩm/Nhà sản xuất</div>
                    <div class="info col-xs-5 data text-right">5/4</div>
                    <div class="info col-xs-7">Chưa làm giá bán</div>
                    <div class="info col-xs-5 data text-right">3</div>
                    <div class="info col-xs-7">Chưa nhập giá mua</div>
                    <div class="info col-xs-5 data text-right">1</div>
                    <div class="info col-xs-7">Hàng chưa phân loại</div>
                    <div class="info col-xs-5 data text-right">0</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
