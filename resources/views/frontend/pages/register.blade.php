@extends('frontend.layouts.master')
@section('content')

<div class="content col-md-6 " style="margin-left: 300px">
    <form action="{!!route('postCustomerRegister')!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="panel panel-body results">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class=" text-center" style="text-transform: uppercase;"><i class="icon-reading position-left"></i> Đăng ký</legend>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="required">Tên</label>
                                <input name="name" type="text" class="form-control" value="{!!old('name')!!}">
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                           
                        </div>
                        <div class="row">
                        	 <div class="form-group col-md-10">
                                <label class="required">Tài khoản</label>
                                <input name="username" type="text" class="form-control" value="{!!old('username')!!}">
                                {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="required">Mật khẩu</label>
                                <input name="password" type="password" class="form-control" value="{!!old('password')!!}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                           
                        </div>
                        <div class="row">
                        	 <div class="form-group col-md-10">
                                <label class="required">Xác nhận mật khẩu</label>
                                <input name="password_confirmation" type="password" class="form-control" value="{!!old('password_confirmation')!!}">
                                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="required">Email</label>
                                <input name="email" type="email" class="form-control" value="{!!old('email')!!}">
                           
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                            </div>
                          
                        </div>
                        <div class="row">
                        	  <div class="form-group col-md-12 ">
                                <label>Địa chỉ</label>
                            <div class="input-group">
                               <div class="form-group col-md-4">
                                <label class="required">Thành phố</label>
                                <select name="id_city" required="required" class=" select2">
                                    @foreach($citys as $city)
                                    <option value="{{ $city->id }}"  {{(old('id_city')==$city->id)?'selected':''}}>{!!$city->name!!}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label class="required">Quận/Huyện</label>
                                <select name="id_county" id="id_county" required="required" class="form-control select2">
                                   
                                </select>
                                 {!! $errors->first('id_county', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4">
                                <label class="required">Xã/Phường</label>
                                <select name="id_ward" id="id_ward" required="required" class=" select2">
                                   
                                </select>
                                {!! $errors->first('id_ward', '<span class="text-danger">:message</span>') !!}

                            </div>
                                
                                
                            </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="">Số điện thoại</label>
                            <div class="input-group">
                                <span class="input-group-addon">(+84)</span>
                                <input name="phone" type="number" class="form-control" value="{!!old('phone')!!}">
                            </div>
                            {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                        </div>
                        </div>
                    </fieldset>
                </div>


            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple">Đăng ký<i class="icon-arrow-right14 position-right"></i></button>
            </div>


        </div>
    </form>
</div>    
@stop
@section('script')
@parent
<script>
    $('.select2').select2({
        placeholder: 'Select an option'
    });

    $(document).on('change', 'select[name=id_city]', function () {
        var id_city = $(this).val();

        $.ajax({
            url: '{{ asset('/api/getCounty') }}',
            method: 'POST',
            data: {
                id_city: id_city
            },
            success: function (html) {
                $('#id_county').html(html);
            }
        });
    });
    $(document).on('change', 'select[name=id_county]', function () {
        var id_county = $(this).val();
        $.ajax({
            url: '{{ asset('/api/getWard') }}',
            method: 'POST',
            data: {
               id_county: id_county
            },
            success: function (html) {
                $('#id_ward').html(html);
            }
        });
    });
</script>
@stop