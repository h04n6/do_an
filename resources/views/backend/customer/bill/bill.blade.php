 @extends('backend.customer.bill.detail')
 @section('main')

 	 <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Danh sách đơn hàng của {{$customer->name}}-Mã :{{$customer->id}}</h5> 
            </div>   
            <table class="table datatable-basic">
                <thead>
                    <tr>                        
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Phí vận chuyển</th>
                        <th>Giảm giá</th>
                        <th>Giá trị</th>
                        <th>Ngày nhận</th>
                    </tr>
                </thead>

                <tbody>
                 @foreach($bill as $key=>$value)
                    <tr>                       
                       <th><a href="{!!route('admin.customer.billDetail',['id'=>$customer->id,'id_bill'=>$value->id_bill])!!}">{!!$value->id_bill!!}</a></th>
                       <th>{{ $value->status->name }}</th>
                         <th>{{ $value->ship_cost }}</th> 
                          <th>{{$value->coupon}}</th>
                        <th>{{ $value->total_bill }}</th>
                        <th>{!!$value->date_finish!!}</th>            
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

 @stop
 
