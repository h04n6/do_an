<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend/layouts/__header')
    </head>

    <body>
        @include('backend/layouts/__navbar')
        <!-- Page container -->
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <!-- Main sidebar -->
                @include('backend/layouts/__sidebar')
                <!-- /main sidebar -->
                <!-- Main content -->
                <div class="content-wrapper">
                    <!-- Content area -->
                    <div class="content row">
                        
                        <!-- Dashboard content -->
                        @yield('content')   
                        <!-- /dashboard content -->
                        
                        <!-- Footer -->
                        @include('backend/layouts/__footer')
                        <!-- /footer -->
                    </div>
                    <!-- /content area -->
                </div>
                <!-- /main content -->
            </div>
            <!-- /page content -->
        </div>
        <!-- /page container -->
    </body>
    @yield('script')   
</html>