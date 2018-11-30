@extends('frontend.layouts.master')
@section('content')
<div class="container" style="padding: 15px 0;">
	<form>
	<div class="search-position col-md-3">
		<div class="search-price row">
			<h3 class="label-search-category">Giá</h3>
			
			<div class="form-group">
				<div class="col-md-5">
				<input class="search-price-ip form-control col-md-6" min="0" required type="number" name="min-price" placeholder="Tối thiểu">
				</div>
				<div class="col-md-5">
				<input class="search-price-ip form-control col-md-6" min="0" required type="number" name="max-price" placeholder="Tối đa">
				</div>
				<button type="button" id="price" style="width: 40px; height: 37px;"  class=" btn btn-link col-md-2"><i class="icon-play4" style="    padding-bottom: 5px; left: -6px;"></i></button>
			</div>
			
		</div>
		<div class="row text-center"><hr class="col-md-10"></div>
		<div class="search-color row " >
			<h3 class="label-search-category" style=" ">Loại</h3>
			<div class="scroll scroll1">
			<form>
			
			<div class="form-group scroll-content" >
				@foreach ($type_product as $value)
				<div class="checkbox"><input type="checkbox" name="id_type" value="{{$value->id}}" /><label>{!!$value->name!!}</label></div>
				@endforeach
			</div>
			
			</form>
			</div>
		</div>
		<div class="row text-center"><hr class="col-md-10"></div>
		<div class="search-brand row ">
			<h3 class="label-search-category" style=" ">Thương hiệu</h3>
			<form>
				<div class="scroll  scroll1">
			<div class="form-group scroll-content">
				@foreach ($manufacturer as $value)
				<div class="checkbox"><input type="checkbox" name="id_manufacturer" value="{{$value->id}}" /><label>{!!$value->name!!}</label></div>
				@endforeach
			</div>
			</div>
			</form>
		</div>
		

		

	</div>
	</form>
	{{-- end filter --}}
	<div class="product-category col-md-9">
		@yield('product')
	</div>
</div>   


 @stop