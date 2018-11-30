@extends('frontend.layouts.master')
@section('content')    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                   
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Sản phẩm liên quan</h2>
                       <div class="thubmnail-recent">
                            <img src="/uploads/ao_doi2.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Áo cặp thun in hình đôi mắt</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$150.00</ins> <del>$100.00</del>
                            </div>                             
                        </div>
                        <div class="thubmnail-recent">
                            <img src="/uploads/ao_thun5.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Áo khoác cặp đôi</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$299.00</ins> <del>$100.00</del>
                            </div>                             
                        </div>
                        <div class="thubmnail-recent">
                            <img src="/uploads/ao_doi5.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Áo đôi thun đẹp</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$140.00</ins> <del>$100.00</del>
                            </div>                             
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="get" action="{{ route('customer.checkout') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">Ảnh</th>
                                            <th class="product-name" width="280">Sản phẩm</th>
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
                                                <a title="Cập nhật sản phẩm" class="update" id="{{$value->rowId}}" ><i class=" icon-loop3"></i></a>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="{{ route('productDetail',$value->id) }}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{ asset($value->options->img) }}"></a>
                                            </td>

                                            <td class="product-name">
                                               <div class="row text-left"><a>{{$value->name}}</a></div> 
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
                                                    <input type="button" class="minus" value="-">
                                                    <input type="number" name="qty" class="input-text qty text" title="Qty" value="{{$value->qty}}" min="0" step="1">
                                                    <input type="button" class="plus" value="+">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{number_format($value->price * $value->qty,0,",",".")}}</span> 
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                          

                            <div class="cart-collaterals">




                            <div class="cart_totals ">
                                <h2>Tổng tiền</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Tiền sản phẩm</th>
                                            <td><span class="amount">{{$total}} VNĐ</span></td>
                                        </tr>
{{-- 
                                        <tr class="shipping">
                                            <th>Phí ship</th>
                                            <td>0</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Tổng đơn hàng</th>
                                            <td><strong><span class="amount">215.000</span></strong> </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>

                                  <!--</section> -->

                            </div>
                            <div class="row">
                                    <div class="col-md-3 link-left">
                                        <a href="{{route('home')}}" class="link-a submit"> <i class="icon-cart-add2"> Tiếp tục mua sắm </i> </a>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-3 link-right">
                                        <a class="button submit link-b" value="1" name="calc_shipping" href="{{ route('customer.checkout') }}" style="float: right;">  <i class="icon-cart-remove"> Xác nhận giỏ hàng</i></a>
                                    </div>
                            </div>
                        </form>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>


   
 @stop
@section('script')
<script>
    $(document).on('click', '.update', function () {
      
    var rowId = $(this).attr('id');
    var qty = $(this).parent().parent().find('.qty').val();
    var token =$("input[name='_token']").val();
       $.ajax({
            url: 'updateCart/'+rowId+'/'+qty,
            cache: false,
            method: 'GET',
            data: {
                "_token" : token,
                id: rowId,
                qty: qty
            },
            success: function (html) {
                
               window.location='/cart';
        }
        });
  

    });

</script>

@stop