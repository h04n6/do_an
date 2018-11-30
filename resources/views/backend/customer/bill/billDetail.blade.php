 @extends('backend.customer.bill.detail')
 @section('main')

 	 <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Danh sách sản phẩm</h5> 
            </div>   
            <table class="table datatable-basic">
                <thead>
                    <tr>                        
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm </th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                 @foreach($bill as $key=>$value)
                    <tr>                       
                       <th>{!!$value->id_product!!}</th>
                       <th>{{ $value->product->name }}</th>
                       <th>{{ $value->price }}</th>
                        <th>{{ $value->quantity }}</th>
                        <th>{{ $value->total }}</th>   
                        <th></th>     
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

 @stop
 