@extends('backend.layouts.master')
@section('content')
<div class="col-md-12">
<div class="page-header">
 <div class="page-header-content">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Báo cáo kho</span></h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
</div>

<div class="content-right-product container-report__main" style="overflow:initial">

            <div class="col-md-12 content-table">
                <div class="col-md-6">
                    <a href="/admin/reports/inventories/onhand">

                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-store.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo tồn kho</div>
                            <div>Quản lý giá trị tồn kho của chi nhánh và toàn hệ thống.</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/admin/reports/inventories/stock_adjustments">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-kiemhang.jpg') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo kiểm hàng</div>
                            <div>Quản lý các thông tin khi kiểm hàng, số lượng hàng hỏng, lý do.</div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="col-md-12 content-table">
                <div class="col-md-6">
                    <a href="/admin/reports/inventories/low_rate">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-duoi-dinh-muc.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo dưới định mức</div>
                            <div>Quản lý được tồn kho và sản phẩm dưới định mức.</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/admin/reports/inventories/export_import_onhand">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-xuat-nhap-ton.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Xuất, nhập tồn</div>
                            <div>Quản lý giá trị tồn đầu kì, nhập trong kì, xuất trong kì, tồn cuối kì.</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-12 content-table">
                <div class="col-md-6">
                    <a href="/admin/reports/inventories/high_rate">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-vuot-dinh-muc.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo vượt định mức</div>
                            <div>Quản lý tồn kho và sản phẩm vượt định mức.</div>
                        </div>
                    </a>
                </div>
                
            </div>

        </div>
</div>
	
</div>
@stop