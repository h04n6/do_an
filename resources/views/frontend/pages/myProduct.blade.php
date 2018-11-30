@extends('frontend.layouts.master')
@section('content')

<div class="container">
<div class="col-md-3">
<div class="single-sidebar">
    <div class="page-title text-center">
    <h4> <span class=" text-semibold ">Sản phẩm liên quan</span></h4>

</div>
<hr>
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
<div class="whish-list col-md-9">
<div class="page-title text-center">
    <h4><i class="fa fa-heart fa-4x fa-beat " style="font-size: 25px; top: -6px;animation-duration: 2s;"></i> <span class=" text-semibold ">Danh sách Sản phẩm yêu thích</span></h4>

</div>
<hr>



<div class="card">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Sản phẩm</th>
  <th scope="col" width="120">Giá</th>
  <th scope="col" width="200" class="text-right">Thao tác</th>
</tr>
</thead>
<tbody>
	@foreach ($wishlist as $value)
	<div class="whish-list-row">
	<tr class="my-wishlist" id="{{$value->id_product}}">
	<td>
	<div class="img-wrap col-md-5"><img src="{{ asset($value->image) }}" class="img-thumbnail img-wishlist"></div>
	<div class="col-md-7">
		<h6 class="title text-truncate">{{$value->product->name}} </h6>
		@if ( !empty($value->id_size) )
		<dl class="param param-inline small">
		  <dt>Size: </dt>
		  <dd class="id_size" id="{{$value->id_size}}">{{$value->size->size_name}}</dd>
		</dl>
		@endif
		@if (!empty($value->id_color))
			<dl class="param param-inline small">
		  <dt>Color: </dt>
		  <dd class="id_color" id="{{$value->id_color}}">{{$value->color->color_name}}</dd>
		</dl>
		@endif
		

	</div>
		


	</td>
	<td> 
		<div class="price-wrap"> 
			<p class="price">{{$value->product->price}} đ</p> 
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right"> 
	<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Save to Wishlist"> <i class=" icon-cart-add"> </i> </a> 
	<a  class="btn btn-outline-danger del-in-wishlist"> <i class=" icon-x"> </i></a>
	</td>
</tr>
</div>
	@endforeach


</tbody>
</table>
</div> <!-- card.// -->
</div>
</div> 
@stop
@section('script')
	<script >
        $(document).on('click', '.del-in-wishlist', function () {


        	var id_product = $(this).closest('.my-wishlist').attr('id');
            var id_size = $(this).closest('.my-wishlist').find('.id_size').attr('id');
            var  id_color= $(this).closest('.my-wishlist').find('.id_color').attr('id');

			swal({
				  title: "Bạn có muốn xóa?",
				  buttons: {
				    cancel: true,
				    confirm: true,

				  },
				}).then((isConfirm) => {
				  if (isConfirm) {
				  	$(this).closest('.my-wishlist').remove();
				    $.ajax({
		            url: '{{ asset('/api/delete-in-wishlist') }}',
		            method: 'POST',
		            data: {
		                id_product: id_product,
		                id_color: id_color,
		                id_size: id_size
		            },
		            success: function (html) {

		                if(html=="Deleted")
		                {
		                	
		                	swal(
						      'Deleted!',
						      'Your file has been deleted.',
						      'success',{
						      	
								  buttons: false,
								  timer: 2000,

						      }
						    )
						   
		                }
		                else{
		                	swal({
								  type: 'error',
								  title: 'Oops...',
								  text: 'Something went wrong!',
								  footer: '<a href>Why do I have this issue?</a>'
								})
		                }
		                
		            }
		        });
				}
				})
            
    


    });
    </script>
   
@stop