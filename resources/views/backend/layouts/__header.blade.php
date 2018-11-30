

<meta charset="utf-8">
<title>HVC Shop</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Hệ thống quản lý">
@section('style')
<!-- Global stylesheets -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<link href="{!!asset('assets/css/icons/icomoon/styles.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/jquery-ui.min.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/bootstrap.css')!!}" rel="stylesheet" type="text/css">
<link href="{!! asset('assets/css/core.min.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/components.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/colors.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/custom.css')!!}" rel="stylesheet" type="text/css">
<link href="{!!asset('assets/css/animate.min.css')!!}" rel="stylesheet" type="text/css">

<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="{!!asset('assets/js/plugins/loaders/pace.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/core/libraries/jquery.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/core/libraries/jquery-ui.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/core/libraries/bootstrap.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/loaders/blockui.min.js')!!}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="{!!asset('assets/js/plugins/tables/datatables/datatables.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/styling/switchery.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/styling/uniform.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/selects/select2.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/ui/moment/moment.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/pickers/daterangepicker.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/uploaders/dropzone.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/editors/wysihtml5/wysihtml5.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/editors/wysihtml5/toolbar.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/editors/wysihtml5/parsers.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/editable/editable.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/wizards/steps.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/plugins/forms/selects/select2.min.js')!!}"></script>

<script type="text/javascript" src="{!!asset('assets/js/pages/form_select2.js')!!}"></script>

<script type="text/javascript" src="{!!asset('assets/js/core/app.js')!!}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


<script type="text/javascript" src="{!!asset('assets/js/plugins/ui/ripple.min.js')!!}"></script>

<script type="text/javascript" src="{!!asset('assets/js/custom.js')!!}"></script>
<!-- /theme JS files -->
<!-- /Ckeditor files -->
<script type="text/javascript" src="{!!asset('ckeditor/ckeditor.js')!!}"></script>

@show