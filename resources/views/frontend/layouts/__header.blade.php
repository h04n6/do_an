

<meta charset="utf-8">
<title>HVC Shop</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Hệ thống quản lý">
<!-- Global stylesheets -->
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
<!-- Css -->
 <link href='{{asset('assets/css/uikit/uikit.min.css')}}' rel='stylesheet' type='text/css'>
<link href='{{asset('assets/css/uikit/uikit.css')}}' rel='stylesheet' type='text/css'>
<link href="{!!asset('assets/css/icons/icomoon/styles.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/jquery-ui.min.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/bootstrap.css')!!}" rel="stylesheet" type="text/css">
<link href="{!! asset('assets/css/core.min.css')!!}" rel="stylesheet" type="text/css">

<link href="{!!asset('assets/css/colors.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/animate.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/components.css')!!}" rel="stylesheet" type="text/css">


{{-- <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'> --}}

   <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/style.css') }}">
<!-- /global stylesheets -->

<!-- Core JS files -->



{{-- <script type="text/javascript" src="{!!asset('assets/js/core/app.js')!!}"></script> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- <script type="text/javascript" src="{!!asset('assets/js/plugins/ui/ripple.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/custom.js')!!}"></script> --}}
<!-- /theme JS files -->
<!-- /Ckeditor files -->
<script type="text/javascript" src="{!!asset('ckeditor/ckeditor.js')!!}"></script>

<script>
    var botmanWidget = {
        frameEndpoint: '/chatbot'    
    };
</script>
<script src='{{asset('/assets/js/widget.js')}}'></script>

