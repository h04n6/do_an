@extends('frontend.layouts.master')
@section('content')
 
    <div class="slider-area">
            <!-- Slider -->
            <div class="block-slider block-slider4">
                <ul class="" id="bxslider-home4">
                    @foreach ($slide as $value)
                        <li>
                        <div class="col-md-8">
                            <img src="{{ asset($value->image) }}" alt="Slide" >
                        </div>
    
                        <div class="caption-group col-md-4"  >
                            <h2 class="caption title">
                                <span class="primary"> {{$value->name}}</span>
                            </h2>
                            <a class="caption button-radius" href="{{ url($value->url) }}"><span class="icon"></span>Xem sản phẩm</a>
                        </div>
                   
                    </li>
                    @endforeach
                    

                </ul>
            </div>
            <!-- ./Slider -->
    </div> <!-- End slider area -->

    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản phẩm mới nhất</h2>
                        <div class="product-carousel">
                            @foreach ($new_products as $value)
                              
                           
                            <div class="single-product" class="uk-width-medium-1-2 uk-flex" data-uk-scrollspy="{cls:'uk-animation-scale-up', delay: 400}">
                                <div class="product-f-image">
                                    <img src="{{ asset($value->image) }}" alt=""  >
                                    <div class="product-hover">
                                         <a href="{{ route('productDetail',$value->id_product) }}" class="add-to-cart-link"><i class="fa fa-link"></i> Xem chi tiết</a>
                                        <a data-toggle="modal" data-target="#detail-prod" id="{{$value->id_product}}" class="view-details-link"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        
                                    </div>
                                </div>
                                
                                <h2 class="text-center"><a href="{{ route('productDetail',$value->id_product) }}">{{$value->name}}</a></h2>
                                
                                <div class="product-carousel-price text-center">
                                    <ins>{{number_format($value->price,"0",",",".")}}</ins> 
                                    @if ($value->promotion_price != 0)
                                        <del>{{number_format($value->promotion_price,"0",",",".")}}</del>
                                    @endif
                                </div> 
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
        <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản phẩm bán chạy</h2>
                        <div class="product-carousel">
                             @foreach ($hot_products as $value)
                                                       
                            <div class="single-product" class="uk-width-medium-1-2 uk-flex" data-uk-scrollspy="{cls:'uk-animation-scale-up', delay: 400}">
                                <div class="product-f-image">
                                    <img src="{{ asset($value->image) }}" alt=""  >
                                    <div class="product-hover">
                                         <a href="{{ route('productDetail',$value->id_product) }}" class="add-to-cart-link"><i class="fa fa-link"></i> Xem chi tiết</a>
                                        <a data-toggle="modal" data-target="#detail-prod" id="{{$value->id_product}}" class="view-details-link"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        
                                    </div>
                                </div>
                                
                                <h2 class="text-center"><a href="{{ route('productDetail',$value->id_product) }}">{{$value->name}}</a></h2>
                                
                                <div class="product-carousel-price text-center">
                                    <ins>{{number_format($value->price,"0",",",".")}}</ins> 
                                    @if ($value->promotion_price != 0)
                                        <del>{{number_format($value->promotion_price,"0",",",".")}}</del>
                                    @endif
                                </div> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Sản phẩm được đánh giá cao</h2>
                        <a href="{{ route('product_is_highly_appreciated') }}" class="wid-view-more">Xem thêm</a>
                        @foreach ($product_star as $value)
                          <div class="single-wid-product">
                            <a href="{{ route('productDetail',$value->id_product) }}"><img src="{{ asset($value->product->image) }}" alt="" class="product-thumb"></a>
                            <h2><a>{{$value->product->name}}</a></h2>
                            <div class="product-wid-rating">
                               @if (round($value->ratings_average,2)< round($value->ratings_average) + 0.25)
                            @for ($i = 0; $i < round($value->ratings_average); $i++)
                            <i class="icon-star-full2" style="color: yellow;"></i>
                            @endfor
                        @elseif(round($value->ratings_average,2) >= (round($value->ratings_average) + 0.25) && round($value->ratings_average,2) < (round($value->ratings_average) + 0.75))
                            @for ($i = 0; $i < round($value->ratings_average); $i++)
                            <i class="icon-star-full2" style="color: yellow;"></i>
                            @endfor
                            <i class=" icon-star-half" style="color: yellow;"></i>
                        @else
                            @for ($i = 0; $i < round($value->ratings_average)+1; $i++)
                            <i class="icon-star-full2" style="color: yellow;"></i>
                            @endfor
                        @endif
                            </div>
                            <div class="product-wid-price">
                                @if ($value->product->promotion_price ==0)
                                    <ins>{{$value->product->price}}</ins>
                                @else
                                <ins>{{$value->product->promotion_price}}</ins> <del>{{$value->product->price}}</del>
                                @endif
                            </div>                            
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title" style="">Sản phẩm giảm giá</h2>
                        <a href="{{ route('product_is_highly_appreciated') }}" class="wid-view-more">Xem thêm</a>
                        @foreach ($discount_product as $value)
                          <div class="single-wid-product">
                            <a href="{{ route('productDetail',$value->id_product) }}"><img src="{{ asset($value->image) }}" alt="" class="product-thumb"></a>
                            <h2><a>{{$value->name}}</a></h2>
                            <div class="product-wid-rating">
                              
                            </div>
                            <div class="product-wid-price">
                                @if ($value->promotion_price==0)
                                    <ins>{{$value->price}}</ins>
                                @else
                                
                                <ins>{{$value->promotion_price}}</ins> <del>{{$value->price}}</del>
                                @endif
                            </div>                            
                        </div>
                        @endforeach

                    </div>
                    
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->



    @if (Session::has('alert'))
      <div class="modal fade" id="success">
      <div class="modal-dialog  modal-sm">
        <div class="modal-content bg-success" >
           
          <div class="modal-body text-center">
          	 <img style="width: 50px;height: 50px;" src="{{ asset('uploads/success.gif') }}">
            <span style="color: white;font-size: 20px;"><i>Đặt hàng thành công!</i></span>
          </div>
        </div>
      </div>
    </div>
    @endif

   
     
 @stop
 @section('script')
 <script>
        $('#success').modal('show');
       
        setTimeout(function() {
            $('#success').modal('hide');
        }, 2000);


</script>
   
    {{--  --}}
   


 @stop
