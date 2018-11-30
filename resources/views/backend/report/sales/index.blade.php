@extends('backend.layouts.master')
@section('content')
<div class="col-md-12">
<div class="page-header">
 <div class="page-header-content">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Báo cáo bán hàng</span></h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
</div>
</div>
	<div class="content-right-product container-report__main" style="overflow:initial">

            <div class="col-md-12 content-table">
                <div class="col-md-6">
                    <a href="{{ route('admin.reportInDate') }}">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-sale.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo bán hàng</div>
                            <div>Quản lý doanh thu, thực thu, tiền hàng trả lại theo thời gian.</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/admin/reports/sales/by_customer">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-customer.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo bán hàng theo khách hàng</div>
                            <div>Theo dõi được doanh thu bán hàng theo khách hàng của 1 chi nhánh hoặc cả hệ thống.</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-12 content-table">

                <div class="col-md-6">
                    <a href="{{ route('admin.report.tranfer') }}">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-tranfer.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo giao hàng</div>
                            <div>Theo dõi được tình trạng giao hàng của cửa hàng, giúp cửa hàng vận hành được tốt hơn.</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/admin/reports/sales/by_variant">
                        <div class="img">
                            <img width="60" height="60" src="{{ asset('uploads/img-ban-chay.png') }}">
                        </div>
                        <div class="text-report">
                            <div class="text-head">Báo cáo hàng bán chạy</div>
                            <div>Theo dõi được mặt hàng bán chạy trong 1 khoảng thời gian.</div>
                        </div>
                    </a>
                </div>

            </div>
          


            
        </div>
</div>
@stop