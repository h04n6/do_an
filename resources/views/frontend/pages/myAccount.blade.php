@extends('frontend.layouts.master')
@section('content')

<div class="content col-md-6 " style="margin-left: 300px">
    <form action="{!!route('postCustomerRegister')!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class=" text-center" style="text-transform: uppercase;"><i class="icon-reading position-left"></i>Thông tin tài khoản</legend>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label class="required">Tên</label>
                                <input name="name" type="text"  class="form-control" value="{!!$user->name!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            
                           
                        </div>
                        <div class="row">
                        	 <div class="form-group col-md-9">
                                <label class="required">Tài khoản</label>
                                <input name="username" type="text"  class="form-control" value="{!!$user->username!!}">
                            </div>
                           {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                             <div class="col-md-3 text-right"><a class="change-address change-if"><i class="icon-pencil"></i> Thay đổi mật khẩu</a></div>
                        </div>
                        <div class="row passwrd hidden">
                             <div class="form-group col-md-9">
                                <label class="required">Mật khẩu cũ</label>
                                <input name="username" type="password" class="form-control" value="">
                            </div>
                             <div class="form-group col-md-9">
                                <label class="required">Mật khẩu mới</label>
                                <input name="username" type="password"  class="form-control" value="">
                            </div>
                             <div class="form-group col-md-9">
                                <label class="required">xác nhận mật khẩu</label>
                                <input name="username" type="password"  class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label class="">Email</label>
                                <input name="email" type="email"  class="form-control" value="{!!$user->email!!}">
                           
                            </div>
                          
                          
                        </div>
                        <div class="row">
                        	  <div class="form-group col-md-9 ">
                                <label>Địa chỉ</label>
                                <input name="address" type="text" class="form-control" value="{!!$user->address!!}">
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="">Số điện thoại</label>
                            <div class="input-group">
                                <span class="input-group-addon">(+84)</span>
                                <input name="phone" type="number" class="form-control" value="{!!$user->phone!!}">
                            </div>
                        </div>
                        
                        </div>
                        </div>
                    </fieldset>
                </div>
                 <div class="text-right">
                <button type="submit" class=" btn btn-primary legitRipple">Cập nhật<i class="icon-arrow-right14 position-right"></i></button>
            </div>

            </div>



        </div>
    </form>
</div>    
@stop
@section('script')
<script>
    
    $(document).on('click', '.change-if', function () {
        $('.passwrd').removeClass('hidden');

    });
</script>
@stop