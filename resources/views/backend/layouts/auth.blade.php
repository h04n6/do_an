<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend/layouts/__header')
    </head>

    <body class="login-container">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    @yield('content')   

                </div
            </div>
        </div>


        <!-- Footer -->
        @include('backend/layouts/__footer')
        <!-- /footer -->

    </div>
    @section('script')
    @show
</body>
</html>