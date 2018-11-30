@extends('frontend.layouts.master')
@section('content')  
    <div class="row">
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                   
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Sản phẩm liên quan</h2>
                        @foreach ( $group_product as $value)
                          <div class="thubmnail-recent">
                            <img src="{{ asset( $value->image) }}" class="recent-thumb" alt="">
                            <h2><a href="{{ route('productDetail',$value->id_product) }}">{{$value->name}}</a></h2>
                            <div class="product-sidebar-price">
                              @if ($value->promotion_price ==0)
                                <ins>{{number_format($value->price,0,',','.')}}</ins>
                              @else<ins>{{number_format($value->promotion_price,0,',','.')}}</ins> <del>{{number_format($value->price,0,',','.')}}</del>
                              @endif
                                
                            </div>                             
                        </div>
                        @endforeach
                       
                    </div>
                    
                   
                </div>
        <div class="col-md-9">
         <div>
		  <div>
		  <div>
          <div class="modal-header">
           
          </div>
          <div class="modal-body">

            <div class="row">
                  <div class="col-md-6">
                     
                    <div class="main-img col-md-12">
                      <div class="tile" data-scale="1.6" data-image="{{ asset($product->image) }}"></div>
                    </div>
                    <div class="list-add">
                    <div class="list-img col-md-9">';
                    @for ($i=0; $i < count($img); $i++) 
                   <div class="img-prd row col-md-4"><img  src="{{asset($img[$i]) }}"alt="a"></div>
                    @endfor


                   </div> 
                  </div>
                  </div>
                  <div class="col-md-6">
        
                        
                <div class="tabbable"> 
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Thông tin sản phẩm</a></li>
                    <li><a href="#tab2" data-toggle="tab">Chi tiết</a></li>
                   
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                       <p class="id_product" id="{{$product->id_product}}">{{$product->name}}</p>
                       <p>
                         @if ($star==0) 
                            @for ($i = 0; $i < 5; $i++)
                               <i class="icon-star-empty3" ></i>
                            @endfor
                        
                       	@elseif(round($star,2)< round($star) + 0.25)
                       		@for ($i = 0; $i < round($star); $i++)
	                  		<i class="icon-star-full2" style="color: yellow;"></i>
	                  		@endfor
	                  	@elseif(round($star,2) >= (round($star) + 0.25) && round($star,2) < (round($star) + 0.75))
	                  		@for ($i = 0; $i < round($star); $i++)
	                  		<i class="icon-star-full2" style="color: yellow;"></i>
	                  		@endfor
	                  		<i class=" icon-star-half" style="color: yellow;"></i>
	                  	@else
	                  		@for ($i = 0; $i < round($star)+1; $i++)
	                  		<i class="icon-star-full2" style="color: yellow;"></i>
	                  		@endfor
                       	@endif
                       	
                       </p>
                       <p>{{$product->price}} đ</p>
                       <div class="color-prd row">
                          <p>Màu sắc:</p>
                          <div class="group-img" data="{{$i=0}}">'
                          @foreach ($list_img as $key => $value)
                           <div class="col-md-2"> <img id="{{$list_color[$i]}}" style="width: 60px; height: 50px; margin: 0 5px;" src="{{ asset($value) }}" class="img-responsive" alt="{{$i++}}"></div>
                          @endforeach

                       </div>
                       </div>
                       <form>
                       <div class="size-prd row col-md-12">
                        <p>Kích thước: </p>
                        <div class="group-size"><div class="size-cont">
                        	<div class="hiden {{$arr[]=0}}{{$i=0}}"></div>

                           @if (count($size)==0)
                           <div class="out-of-stock"><span>Hết hàng</span></div>
                           @endif
                         @foreach ($size as $key => $value1) 
                      
                            {{--  @if($value1->quantity !=0 && ($this->check($arr,$value1->id_size))==1 )  --}}
                             
                                
                        <div class="col-md-1"><a id="{{$value1->id_size}}" class="size text-center">{{$value1->size->size_name}}</a></div>
                                      {{-- $arr[]=$value1->id_size; --}}
                             

                        @endforeach   
                          
                       </div></div>
                       </div>
                        <div class="quantity buttons_added">
                          <label>Số lượng </label>
                            <input type="button" class="minus" value="-">
                            <input type="number" size="4" name="qty" class="input-text qty text" title="Qty" value="1" min="1" step="1">
                            <input type="button" class="plus" value="+">
                        </div>

                        <div class=" col-md-12">
                        @if (count($size)==0) 
                            <div class=" btn-add-cart row col-md-7"><a class="btn border-slate btn-flat disable" data-dismiss="modal"><i class="icon-cart"></i> Thêm vào giỏ hàng</a></div>
                        
                        @else
                           <div class=" btn-add-cart row col-md-7"><a class="btn border-slate btn-flat " data-dismiss="modal"><i class="icon-cart"></i> Thêm vào giỏ hàng</a></div>
                        @endif
                        <div class=" btn-heart row col-md-5"><a  class="wishlist btn border-slate text-slate-800 btn-flat"><i class="icon-heart5"></i> </a></div>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <p>Hãng:{{$product->manufacturer->name}} </p>
                      <p>Mô tả:{!!html_entity_decode($product->description,ENT_HTML5 )!!} </p>
                    </div>

                  </div>
              </div>
            </div>
              </div>
            
           
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


  <div class="tile" data-scale="2.4" data-image="{{ asset($product->image) }}"></div>

    </div>
    <div class="row col-md-12" style="margin-top: 20px;">
    <div class="col-md-2"></div>
    <div class="col-md-7">
    	<div class="page-header">
        <h1> Bình luận <small class="pull-right">{{count($comment)}} bình luận</small></h1>
      </div> 
       <div class="comments-list">
       	@foreach ($comment as $value)
       		 <div class="media">
               <p class="pull-right"><small>{{$value->created_at}}</small></p>
                <div class="media-body">
                    
                  <h4 class="media-heading user_name">{{$value->virtual_name}}</h4>
                  <p>Đánh giá: 
                  	@for ($i = 0; $i < $value->star; $i++)
                  		<i class="icon-star-full2" style="color: yellow;"></i>
                  	@endfor
                  </p>
                  <p>{{$value->content}}</p>
                  
                </div>
              </div>
       	@endforeach
          

       </div>
    </div>
    </div>
          
    </div>
    </div>
    </div>

   </div>
   
 @stop
 @section('script')
  <script>
        $(document).ready(function(){
            $('.group-img').find('img').first().addClass('active');
        })
    </script>
     <script >
       $(document).ready(function(){
        var id_color = $('.group-img img.active').attr('id');
        var id_product = $('.group-img img.active').closest('.tab-content').find('.id_product').attr('id');
        var src =  $('.group-img img.active').attr("src");
        $.ajax({
            url: '{{ asset('/api/get_list_img') }}',
            method: 'POST',
            data: {
                id_product: id_product,
                id_color: id_color
            },
            success: function (html) {
               
               $('.modal-body').find('.list-img').remove('.list-img');
               $('.modal-body').find('.list-add').append(html[0]);
               $('.modal-body').find('.group-size .size-cont').remove('.size-cont');
               $('.modal-body').find('.group-size').append(html[1]);
               $('.modal-body').find('.group-size a').first().addClass('active');
                
            }
        });


    });
    </script>
  
 @stop