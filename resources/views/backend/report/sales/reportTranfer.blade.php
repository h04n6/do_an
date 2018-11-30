@extends('backend.layouts.master')
@section('content')
<div class="col-md-12">
	<div class="page-header">
     <div class="page-header-content">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Báo cáo giao hàng</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
    </div>
	</div>

<div class="panel panel-flat">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        
                    </ul>
                </div>
            </div>
            <form action="{{route('admin.reportInDate')}}" method="GET">  
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="panel-body row">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">Ngày đóng gói:</label>
                            <div class="col-md-6">
                    <input type="text" class="form-control " name="dates" value="">
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">Nhân viên đóng gói:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="staff" value="">
                            </div>
                        </div>   
                   
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">Mã gói hàng:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="staff" value="">
                            </div>
                        </div> 
                    
                     </div>
                     <div class="row">
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">Nhân viên vận chuyển:</label>
                            <div class="col-md-6">
                    <input type="text" class="form-control" name="start_date" value="">
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">khách hàng:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="staff" value="">
                            </div>
                        </div>   
                   
                        <div class="col-md-4 text-right">
                            <label class="col-md-6 control-label">Phiên bản sản phẩm:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="staff" value="">
                            </div>
                        </div> 
                    
                     </div>
                     <div class="col-md-11 text-right" style="    margin-top: 15px;">
                        <button type="submit" class="btn btn-primary legitRipple">Xem báo cáo<i class="icon-arrow-right14 position-right"></i></button>
                    </div>

                </div>
            </form>

</div>

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

                        <th>Mã gói hàng</th>
                        <th>Mã đơn hàng</th>
                        <th>Người nhận</th>
                        <th>Phí giao hàng</th>
                        <th>Tổng tiền</th>
                        <th>Nhân viên đóng gói</th>
                        <th>Nhân viên xuất kho</th>
                        <th>Nhân viên nhân viên giao hàng</th>
                        <th>Phương thức</th>
                        <th>Ngày đóng gói</th>
                        <th>Ngày giao hàng</th>
                        <th>Ngày ngày hủy</th>
                    
                       
                    </tr>
                </thead>

                <tbody>
                    @foreach($report_TF as $key=>$value)
                    <tr>
                        <td>{{$value->id}}</td> 
                        <td><a href="{{ route('admin.customer.detail',$value->id) }}">{{$value->id_bill}}</a></td>
                        <td>{{$value->bill->reciver}}</td>

                        <td>{{$value->bill->ship_cost}}</td>
                        <td>{{$value->bill->total_bill}}</td>
                        
                        <td>{{$value->package->name}}</td>
                        <td>{{$value->export->name}}</td>
                        <td>{{$value->ship->name}}</td>
                        <td>{{$value->payment_method}}</td>
                        <td>{{$value->date_package}}</td>
                        <td>{{$value->date_finish}}</td>
                        <td>{{$value->date_cancel}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>
</div>
@stop
@section('script')
<script >
            $('input[name="dates"]').daterangepicker({
                 language: "vi-VN",
                locale: {
                 monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
                  format: 'DD/MM/YY'
                }
            });
        </script>
@stop