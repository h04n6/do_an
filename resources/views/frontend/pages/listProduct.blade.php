@extends('frontend.pages.product')
@section('product')
    <div class="position-add-list-product">
     @foreach ($products as $value)
     <div class="box-product col-md-4">
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
             
            @if ($value->promotion_price == 0)
                <ins>{{number_format($value->price,"0",",",".")}}</ins>
              @else 
               <ins>{{number_format($value->promotion_price,"0",",",".")}}</ins>
               <del>{{number_format($value->price,"0",",",".")}}</del>
            @endif
        </div> 
    </div>
</div>
    @endforeach
   <div class="col-md-12 text-center" style="margin: 50px auto;">{{$products->links()}}</div> 
    </div>
@stop

@section('script')
<script>
    $(document).on('click', '#price', function (e) {
        var min_price = $('input[name=min-price]').val();
        var max_price = $('input[name=max-price]').val();
        if (min_price=="") {
            min_price=0;
        }
        if (max_price=="") {
            alert("Nhập giá cần lọc!" );
           $('input[name=max-price]').focus();
            return false;  
        }

        var type=$('input[name=id_type]');
      var arr_type='';
       for (var i = 0; i < type.length; i++) {
          if(type[i].checked==true)
          {
            arr_type += type[i].value + ',';
          }
      }
      var color=$('input[name=id_color]');
      var arr_color='';
      
      for (var i = 0; i < color.length; i++) {
          if(color[i].checked==true)
          {
            arr_color += color[i].value + ',';
          }
      }
      var manufacturer=$('input[name=id_manufacturer]');
      var arr_manufacturer='';
       for (var i = 0; i < manufacturer.length; i++) {
          if(manufacturer[i].checked==true)
          {
            arr_manufacturer += manufacturer[i].value + ',';
          }
      }
        
        $.ajax({
            url: '{{ asset('/api/search_group') }}',
            method: 'POST',
            data: {
                min_price: min_price,
                max_price: max_price,
                arr_type:arr_type,
                arr_manufacturer: arr_manufacturer
            },
            success: function (html) {
                if ( $('.position-add-list-product').find('.box-product').length>0) {
                    $('.position-add-list-product').find('.box-product').remove('.box-product');
                }
                $('.position-add-list-product').html(html);
            }
        });
    });
</script>

<script>
    $(document).on('click', 'div.checkbox input[type=checkbox]', function () {
        var min_price = $('input[name=min-price]').val();
        var max_price = $('input[name=max-price]').val();
        if (min_price=="") {
            min_price=0;
        }
        var type=$('input[name=id_type]');
        var arr_type='';
       for (var i = 0; i < type.length; i++) {
          if(type[i].checked==true)
          {
            arr_type += type[i].value + ',';
          }
      }
      var color=$('input[name=id_color]');
      var arr_color='';
      
      for (var i = 0; i < color.length; i++) {
          if(color[i].checked==true)
          {
            arr_color += color[i].value + ',';
          }
      }
      var manufacturer=$('input[name=id_manufacturer]');
      var arr_manufacturer='';
       for (var i = 0; i < manufacturer.length; i++) {
          if(manufacturer[i].checked==true)
          {
            arr_manufacturer += manufacturer[i].value + ',';
          }
      }
        $.ajax({
            url: '{{ asset('/api/search_group') }}',
            method: 'POST',
            data: {
                min_price: min_price,
                max_price: max_price,
                arr_type:arr_type,
                arr_manufacturer: arr_manufacturer
            },
            success: function (html) {
                if ( $('.position-add-list-product').find('.box-product').length>0) {
                    $('.position-add-list-product').find('.box-product').remove('.box-product');
                }
                $('.position-add-list-product').html(html);
            }
        });
    });
</script>
@stop