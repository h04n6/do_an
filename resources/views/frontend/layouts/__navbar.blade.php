 <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="user-menu">
                        <ul class="list-user-menu">
                            
                            <li><a href="{{ route('customer.myAccount') }}"><i class="fa fa-user"></i>Tài khoản của tôi</a></li>
                            <li><a href="{{ route('customer.myProduct') }}"><i class="fa fa-heart"></i>Sanh sách yêu thích</a></li>
                            
                            <li><a href="{{ route('customer.myOrder') }}"><i class="icon-bag"></i>Đơn hàng của tôi</a></li>
                             @if (Session::has('user_id'))
                              <li id="user-login" ><a href="{{ route('logout') }}" ><i class="icon-exit2"></i>đăng xuất</a></li>
                                @else  <li id="user-login" ><a href="{{ route('login') }}" ><i class="icon-enter3"></i> Đăng nhập</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                 @if (Session::has('name'))
                 <div class="col-md-2">
                    <span style=" padding-top: 10px;display: inline-block;">Xin chào : {{ Session::get('name') }}</span>
                 </div>
                  @endif
            </div>
        </div>
    </div> <!-- End header -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo">
                        <h1><a href="/"><img  style="height: 75px;" src="{{ asset('/uploads/HVC-logo.PNG') }}"></a></h1>
                    </div>
                </div>
                <form method="GET" action="{{ route('search') }}">
               
                <div class="search-header col-sm-6">
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span id="search_concept">Tìm theo</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li class="divider"></li>
                              @foreach ($type_product as $value)
                                  <li><a id="{{$value->id}}">{{$value->name}}</a></li>
                              @endforeach
                             
                            </ul>
                        </div>
                        <input type="hidden" name="search_param" value="all" id="search_param">         
                        <input type="text" class="form-control" required="required" name="txtsearch" placeholder="Tìm kiếm...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                       
                 </div>
                  
                </div>
                </form>
                <div class="col-sm-2">
                    <div class="shopping-item">
                        <a href="{{ route('cart') }}">Giỏ hàng <i class="fa fa-shopping-cart"></i> <span class="product-count">{{Cart::count()}}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
               
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav menu">
                        <li class="active"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a>Thời trang nam</a>
                            <ul class="submenu category_male">
                               
                            </ul>

                        </li>
                        <li><a href="shop.html">Thời trang nữ</a>
                             <ul class="submenu category_female">

                                
                            </ul>

                        </li>
                     <!--   <li><a href="single-product.html">Single product</a></li> -->
                        <li><a href="#">Thời trang trẻ em</a></li>
                        <li><a href="{{ route('category_new_products') }}">Hàng mới</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
