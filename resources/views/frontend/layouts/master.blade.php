<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend/layouts/__header')
    </head>

    <body>
    	 @include('frontend/layouts/__navbar')
    	 <!-- -->
         <div class="col-md-12">
        @include('frontend/layouts/view_product')
    	  @yield('content')   
          </div>
    	 <!-- -->
    	  @include('frontend/layouts/__footer')
    </head>
    </body>
     @include('frontend/layouts/script')
      @yield('script') 
</html>  