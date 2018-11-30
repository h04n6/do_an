@extends('frontend.layouts.master')
@section('content')    

<div class="modal fade" id="change-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Địa chỉ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-group col-md-10">
            <label class="">Thành phố</label>
            <select name="id_city" required="required" class=" select2">
                @foreach($citys as $city)
                <option value="{{ $city->id }}"  {{(old('id_city')==$city->id)?'selected':''}}>{!!$city->name!!}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group col-md-10">
            <label class="">Quận/Huyện</label>
            <select name="id_county" id="id_county" required="required" class="form-control select2">
               
            </select>

        </div>
        <div class="form-group col-md-10">
            <label class="">Xã/Phường</label>
            <select name="id_ward" id="id_ward" required="required" class=" select2">
               
            </select>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="change" class="btn btn-primary" data-dismiss="modal">Lưu</button>
        
      </div>
    </div>
  </div>
</div>


        <div class="container">
            <div class="row">
                
                <div class="col-md-7" style="margin-top: 55px;">
                    <div class="product-content-right">
                      
                         <form method="post" action="#">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">Ảnh sản phẩm</th>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($content as $value)
                                        
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Xóa sản phẩm" href="{{ route('delProductInCart',$value->rowId) }}" class="remove"><i class=" icon-cross3"></i></a> 
                                               
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{ asset($value->options->img) }}"></a>
                                            </td>

                                            <td class="product-name">
                                                 <div class="row text-left"><a href="single-product.html">{{$value->name}}</a></div> 
                                               <div class="row prd-cl-sz text-left">
                                                @foreach ($colors as $color)
                                                    @if ($color->id==$value->options->color)
                                                        <span>Màu: {{$color->color_name}}</span>
                                                    @endif
                                                @endforeach
                                                @foreach ($sizes as $size)
                                                    @if ($size->id==$value->options->size)
                                                        <span>Size: {{$size->size_name}}</span>
                                                    @endif
                                                @endforeach
                                                </div>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{number_format($value->price,"0",",",".")}}</span> 
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    
                                                    <input type="number" size="4" readonly="readonly" name="qty" class="input-text qty text-center" title="Qty" value="{{$value->qty}}" min="0" step="1">
                                                  
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{number_format($value->price * $value->qty,0,",",".")}}</span> 
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <div class="coupon col-md-7">
                                                    <div class="row col-md-4">
                                                        <label for="coupon_code" style="display: inline-block;padding-top: 10px;">Mã giảm giá:</label>
                                                    </div>
                                                    <div class=" row col-md-5">
                                                        <input type="text" placeholder="Nhập mã" value="" id="discount_code" class="input-text form-control" name="discount_code" required="required">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="button" value="Áp dụng" name="apply_coupon" class="button butt">
                                                    </div>
                                                </div>
                                              
                                               
                                            </td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </form>
                                     
                    </div>                    
                </div>
                <div class="col-md-5" style="margin-top: 20px">
                    <div class="col-md-12">
                        <form action="{{ route('customer.postCheckout') }}" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="hidden" name="id_store" value="{!!$ship_costs->id_store!!}" />
                        <div class="order-infor border-bottom" >
                            <h3>Địa chỉ giao hàng</h3>
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label class="required">Người nhận</label>
                                    <input name="name" type="text" class="form-control" value="{{$user->name}}">
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label class="required">Địa chỉ nhận hàng</label>
                                    <input name="address" type="text" readonly="readonly"  class="form-control" value="{{$user->address}}">
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="col-md-3 text-right"><a class="change-address " data-toggle="modal" data-target="#change-address"><i class="icon-pencil"></i> Thay đổi</a></div>
                                <div class="form-group col-md-9">
                                    <label class="required">Nơi nhận hàng</label>
                                    <input name="address_detail" required="required" type="text" class="form-control" >
                                    {!! $errors->first('address_detail', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 10px;">

                                    <label class="required">Số điện thoại liên hệ</label>
                                   <div class="input-group col-md-7">
                                    <span class="input-group-addon">(+84)</span>
                                    <input required="required" name="phone" type="number" class="form-control" value="{!!$user->phone!!}">
                                </div>
                                    {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="time-recive border-bottom">
                            <h4 class="text-center"><i class=" icon-truck"> Giao hàng tiêu chuẩn</i></h4>
                            <div class="date_ship">Nhận hàng vào {{date('d/m',strtotime($start_date_ship))}} - {{date('d/m/Y',strtotime($end_date_ship))}}  </div>
                            <div class="aj-ship-cost">Phí vận chuyển: <span>{{number_format($ship_cost,0,',','.')}}</span> đ</div>
                        </div>
                        <div class="order-infor border-bottom" >
                            <h3>Thông tin đơn hàng</h3>
                            <div class="row">
                                <div class="col-md-8">Tiền sản phẩm</div>
                                <div class="col-md-4 text-right">{{number_format($total_price_prd,0,',','.')}} đ</div>
                            </div>
                             <div class="row position-add-coupon">
                                            {{-- nơi thêm mã giảm giá nếu có--}}

                            </div>
                             <div class="row">
                                <div class="col-md-8 ">Phí giao hàng</div>
                                <div class="aj-ship-cost col-md-4 text-right">  <span>{{number_format($ship_cost,0,',','.')}}</span> đ</div>
                                <input type="hidden" name="ship_cost" value="{{$ship_cost}}">
                            </div>
                            <div class="row">
                                <div class="col-md-8 "><h5>Tổng cộng</h5></div>
                                <div class=" total_bill col-md-4 text-right"><h5> <span>{{number_format($total,0,',','.')}}</span> đ</h5></div>
                                <input type="hidden" name="total_bill" value="{{$total}}">
                                <input type="hidden" name="subtotal_vitual" value="0">
                            </div>

                        </div>
                        <div class="payment ">
                             <h4 class="text-center"><i class=" icon-cart5"> Chọn phương thức thanh toán</i></h4>
                             <div class="col-md-6">
                                <label class="radio-inline">
                                        <input type="radio" name="payment" value="Thanh toán khi nhận hàng" checked="checked" class="control-primary" >
                                        Thanh toán khi nhận hàng
                                </label>
                             </div>
                              <div class="col-md-6">
                                <label class="radio-inline">
                                        <input type="radio" name="payment" class="styled" value="Thanh toán bằng thẻ" >
                                        Thanh toán bằng thẻ
                                </label>
                             </div>
                        </div>
                        <div class="finish">
                            <div class="form-group"><input id="sbm" type="submit" name="" value="Tiến hành đặt hàng" data-toggle="modal" data-target="#overlay"></div>
                        
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



@stop
@section('script')
@parent
<script>
    $('.select2').select2({
        placeholder: 'Select an option'
    });

    $(document).on('change', 'select[name=id_city]', function () {
        var id_city = $(this).val();

        $.ajax({
            url: '{{ asset('/api/getCounty') }}',
            method: 'POST',
            data: {
                id_city: id_city
            },
            success: function (html) {
                $('#id_county').html(html);
            }
        });
    });
    $(document).on('change', 'select[name=id_county]', function () {
        var id_county = $(this).val();
        $.ajax({
            url: '{{ asset('/api/getWard') }}',
            method: 'POST',
            data: {
               id_county: id_county
            },
            success: function (html) {
                $('#id_ward').html(html);
            }
        });
    });


      $('#change').click(function() {
        var id_city = $('select[name=id_city]').val();
        var id_county = $('select[name=id_county]').val();
        var id_ward = $('select[name=id_ward]').val();
        var name_city = $('option[value='+id_city+']').text();
        var name_county = $('option[value='+id_county+']').text();
        var name_ward = $('option[value='+id_ward+']').text();
        var address = name_city + ', ' + name_county + ', '+ name_ward;
        $('input[name=address]').val(address);

        var subtotal_vitual= $('input[name=subtotal_vitual]').val();
        var ship_cost= $('input[name=ship_cost]').val();
        $.ajax({
            url: '{{ asset('/api/post_ship_cost') }}',
            method: 'POST',
            data: {
               id_city: id_city,
               subtotal_vitual: subtotal_vitual,
               ship_cost:ship_cost


            },
            success: function (html) {
                $('.aj-ship-cost span').text(html['ship_cost'] );
                $('.total_bill h5 span').text(html['total']);
                $('input[name=ship_cost]').val(html['ship_cost_vitual']);
                $('input[name=total_bill]').val(html['total_vitual']);
                $('.time-recive .date_ship').text(html['date_ship']);
                if (subtotal_vitual !=0) {
                    $('input[name=subtotal_vitual]').val(html['total_vitual']);
                }
                
               
            }
        });
      });

    $('#overlay').modal('show');

setTimeout(function() {
    $('#overlay').modal('hide');
}, 5000);
  
</script>
<script>
    $(document).on('click', 'input[name=apply_coupon]', function () {
        var discount_code = $('input[name=discount_code]').val();
        var ship_cost= $('input[name=ship_cost]').val();
        var subtotal_vitual= $('input[name=subtotal_vitual]').val();
        $.ajax({
            url: '{{ asset('/api/apply_coupon') }}',
            method: 'POST',
            data: {
               discount_code: discount_code,
               ship_cost:ship_cost,
               subtotal_vitual: subtotal_vitual
            },
            success: function (html) {
               if (html=='is_had') {
                 swal('Lỗi!!!',"1 đơn hàng chỉ được dùng 1 mã giảm giá!",  "error");
                 
               }
               else if(html=='error')
               {
                 
                 swal('Lỗi!!!',"Mã bạn nhập chưa đúng hoặc hết hạn sử dụng!",  "error");
               }
                else{
                    $('.total_bill h5 span').text(html['total_bill']);
                    $('input[name=subtotal_vitual]').val(html['subtotal_vitual']);
                    $('input[name=total_bill]').val(html['subtotal_vitual']);
                    $('.position-add-coupon').append(html['html']);
                    swal("Bạn đã sử dụng mã giảm giá "+ html['coupon'] +" !!", "", "success");
                    
                }
            }
        });
    });
</script>
@stop