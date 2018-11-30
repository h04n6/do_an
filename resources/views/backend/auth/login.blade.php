@extends('backend.layouts.auth')
@section('content')
<!-- Advanced login -->
<form action="{!! route('postLogin') !!}" method="post">
    <div class="panel panel-body login-form">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input name="username" type="text" class="form-control" placeholder="Username">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
        </div>
        <div class="text-center">
            <span class="txt1">
               Hoặc đăng nhập bắng
            </span>
        </div >
        <div class="group" style="height: 25px; margin: 15px auto;">
        <a href="{{ route('login.google') }}" class="btn-face col-md-6 text-center">
            <i class="icon-facebook2"></i>
            Facebook
        </a>

        <a href="{{ route('login.google') }}" class="btn-google col-md-6 text-center">
           <i class="icon-google-plus2"></i>
            Google
        </a>
        </div>
        <div class="text-center w-full p-t-10">
            <span class="txt1">
                Thành viên mới?
            </span>

            <a class="txt1 bo1 hov1" href="{{ route('getCustomerRegister') }}">
               đăng ký tại đây!                     
            </a>
        </div>

        @if(Session::has('error'))
        <div class='alert alert-danger'>
            <p>{!! Session::get('error') !!}</p>                       
        </div>
        @endif   

         @if (Session::has('register_success'))
      <div class="modal fade" id="register_success">
      <div class="modal-dialog  modal-sm">
        <div class="modal-content bg-success" >
           
          <div class="modal-body text-center">
            <span style="color: white;font-size: 20px;"><i>Đăng ký thành công!</i></span>
          </div>
        </div>
      </div>
    </div>
    @endif
    </div>
</form>
<!-- /advanced login -->

@stop

@section('script')
@parent
<script type="text/javascript" src="{!!asset('assets/backend/js/pages/login.js')!!}"></script>
<script >
    $('#register_success').modal('show');
        $('#goToCart').modal('show');
        setTimeout(function() {
            $('#register_success').modal('hide');
        }, 2000);
</script>
@stop