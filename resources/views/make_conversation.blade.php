<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thiết lập kịch bản</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .box-shadow{
            box-shadow: 5px 10px 18px #888888;
            border: 1px solid black;
            border-radius: 6px;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>
    <div class="container box-shadow">
        <h4>Tạo kịch bản mới cho chatbot</h4>
        <div class="form-group">
            <label for="customer">Từ khóa</label>
            <textarea type="text" class="form-control" id="customer" placeholder="Từ khóa cho chatbot nhận biết"></textarea>
        </div>
        <div class="form-group">
            <label for="customer">Khách hàng</label>
            <textarea type="text" class="form-control" id="customer" placeholder="Yêu cầu của khách hàng"></textarea>
        </div>
        <div class="form-group">
            <label for="chatbot">Chatbot</label>
            <textarea type="text" class="form-control" id="chatbot" placeholder="Chatbot trả lời"></textarea>
        </div>
        <div id="add-conversation"></div>
        <div>
            <input type="butotn" class="btn btn-danger" id="cancel" value="Hủy">
            <input type="button" class="btn btn-primary float-right" id="add" value="Thêm">
            <input type="submit" class="btn btn-save float-right" id="save" value="Lưu">
        </div>   
    </div>
</body>
</html>