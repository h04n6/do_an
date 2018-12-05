<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thiết lập kịch bản</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/create_conversation.css')}}">
    <script src="{{asset('assets/js/create_conversation.js')}}"></script>
    
</head>
<body>
    <form id="myForm" method="POST" action="{!!route('chatbot.create.save')!!}" class="container">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-4">
                {{-- <h4>Danh sách kịch bản</h4>
                <br>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>Tên</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th class="hidden"></th>
                            <th class="hidden"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scripts as $s)
                            <tr class="tr-script">
                                <td><input type="checkbox" class="ckb" {{$s->status == '1' ? 'checked' : ''}}></td>
                                <td>{{$s->name}}</td>
                                <td>{{$s->created_at}}</td>
                                <td>{{$s->updated_at}}</td>
                                <td class="hidden">{{$s->script}}</td>
                                <td class="hidden id">{{$s->id}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
            <div class="col-sm-5">
                <div class="chat-frame box-shadow">
                    <div class="chat-frame-header">
                        <input type="text" class="name" name="name" value="" placeholder="Đặt tên cho kịch bản mới ...">
                    </div>
                    <div class="chat-frame-body">
                        <ul class="chat"></ul>
                    </div>
                    <div class="chat-frame-footer">
                        <input type="text" id="msg-input" value="" placeholder="Nhập tin nhắn của khách hàng vào đây ...">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-success" value="Lưu kịch bản">
                <input type="button" class="btn btn-danger" value="Hủy">

                <br><br>
                <label><i>* Nhấn chuột hai lần vào ô chat để xóa</i></label>
                <br><br>

                <div class="form-group">
                    <label for="input-key-word">Từ khóa</label>
                    <input type="text" id="input-key-word" class="form-control" value="" placeholder="Nhập từ khóa của kịch bản ...">
                </div>
                <div class="row">
                    <div class="col-sm-6 even"></div>
                    <div class="col-sm-6 odd"></div>
                </div>
            </div>
        </div>

        <input type="text" class="hidden" value="" id="saved-key-word" name="key-word">
        <input type="text" class="hidden" value="" id="saved-script" name="script">
    </form>
</body>
</html>