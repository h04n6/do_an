<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#" class="legitRipple"><img src="{{asset('assets/images/placeholder.jpg')}}" class="img-circle img-responsive" alt=""></a>
                    <h6>{!!Auth::user()->name!!}</h6>
                    <span class="text-size-small">{!!Auth::user()->address!!}</span>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse" class="legitRipple"><span>{{trans('base.account')}}</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
               
            </div>
        </div>
        <!-- /user menu -->



        <!-- Main navigation -->
        <div class=" sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion sidebar-menu">

                    <!-- Main -->
                    @if (Session::get('role_id')==1)
                        {{-- expr --}}
                    
                    <li class="navigation-header"><span>{{trans('base.manage')}} {{trans('base.system')}}</span> <i class="icon-menu" title="" data-original-title="Main pages"></i></li>

                    <li class="treeview"><a href="{{route('admin.index')}}" class="legitRipple"><i class="icon-home4"></i> <span>Hệ thống</span></a>
                                     			
                    	<ul class="hidden-ul treeview-menu "> 
                            <li><a href="{{route('admin.manage')}}" class="legitRipple"><i class="icon-user"></i> <span>Quản lý tài khoản hệ thống</span></a></li>
                             <li><a href="{{ route('admin.config.index') }}" class="legitRipple"><i class="icon-gear"></i> <span>Cấu hình hệ thống</span></a></li>
                             <li><a href="" class="legitRipple"><i class="icon-database"></i> <span>Sao lưu - phục hồi dữ liệu</span></a></li>
                        </ul>
                    		

                    </li>

                    <li class=""><a href="" class="legitRipple"><i class="icon-clipboard6"></i> <span>Đơn hàng</span></a>
                            
                        <ul class="">    
                            <li><a href="{{ route('admin.bill.index') }}" class="legitRipple"><i class=" icon-clipboard"></i> <span>Danh sách đơn hàng</span></a></li>
                            
                            <li><a href="{{ route('admin.staff.index') }}" class="legitRipple"><i class="icon-collaboration"></i> <span>Nhân viên</span></a></li>
                            <li><a href="" class="legitRipple"><i class="icon-clippy"></i> <span>Trả hàng</span></a></li>
                            
                        </ul>

                    </li>
                    <li><a href="{{ route('admin.customer.index') }}" class="legitRipple"><i class="icon-user"></i> <span>Khách hàng</span></a></li>
                   
                    <li><a href="" class="legitRipple"><i class="icon-bag"></i> <span>Sản phẩm</span></a>
                	  
                	  <ul class="hidden-ul">    
                                    
	                    <li ><a href="{{ route('admin.products.index') }}" class="legitRipple"><i class="icon-basket"></i> <span>Danh sách sản phẩm</span></a></li>
	                    <li><a href="{{ route('admin.typeproduct.index') }}" class="legitRipple"><i class="icon-stack2"></i> <span>Loại sản phẩm</span></a></li>

	                    <li><a href="{{ route('admin.manufacturer.index') }}" class="legitRipple"><i class=" icon-price-tags"></i> <span>Hãng sản phẩm</span></a></li>
                        <li><a href="{{ route('admin.supplier.index') }}" class="legitRipple"><i class="icon-office"></i> <span>Nhà cung cấp</span></a></li>
                        <li><a href="{{ route('admin.store.index') }}" class="legitRipple"><i class="icon-store"></i> <span>Kho</span></a></li>
                        
	                   
	                </ul>
				    </li>
                    <li><a href="{{ route('admin.discountcode.index') }}" class="legitRipple"><i class=" icon-percent"></i> <span>Quản lý mã giảm giá</span></a></li>
              
                    
					 
					 <li><a href="" class="legitRipple"><i class="icon-graph"></i> <span>Báo cáo</span></a>
                        <ul class="hidden-ul">  
                            <li><a href="{{ route('admin.report.sales') }}" class="legitRipple"><i class="icon-bag"></i> <span>Báo cáo bán hàng</span></a></li>
                            <li><a href="{{ route('admin.report.store') }}" class="legitRipple"><i class="icon-store"></i> <span>Báo cáo kho</span></a></li>
                            
                        </ul>
                     </li>
                     @elseif(Session::get('role_id')==2)
                     <li class=""><a href="" class="legitRipple"><i class="icon-clipboard6"></i> <span>Đơn hàng</span></a>
                            
                        <ul class="">    
                            <li><a href="{{ route('admin.bill.index') }}" class="legitRipple"><i class=" icon-clipboard"></i> <span>Danh sách đơn hàng</span></a></li>
                            
                            <li><a href="{{ route('admin.staff.index') }}" class="legitRipple"><i class="icon-collaboration"></i> <span>Nhân viên</span></a></li>
                            <li><a href="" class="legitRipple"><i class="icon-clippy"></i> <span>Trả hàng</span></a></li>
                            
                        </ul>

                    </li>
                    
                     @endif


                    <!-- /main -->
                </ul>

            </div>
        </div>
        <!-- /main navigation -->
        <ul class="navigation">
                    <li><a href="{{route('logout')}}" class="legitRipple"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                </ul>
    </div>
</div>