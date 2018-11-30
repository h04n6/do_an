
<!DOCTYPE html>
<html >
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   @include('backend/layouts/__header')
  <style type="text/css">
    body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tohoma";
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
      width: 900px;
    overflow: hidden;
    min-height: 297mm;
    padding: 20px;
    margin-left: auto;
    margin-right: auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}
 @page {
 size: A3;
 margin: 0;
}
button {
    width:100px;
    height: 24px;
}
.header {
    overflow:hidden;
}
.logo {
    background-color:#FFFFFF;
    text-align:left;
    float:left;
}
.company {
    padding-top:25px;
    padding-right: 90px;
    text-transform:uppercase;
    background-color:#FFFFFF;
    text-align:right;
    float:right;
    font-size:20px;
}
.title {
    text-align:center;
    position:relative;
    color:#0000FF;
    font-size: 24px;
    top:1px;
}
.footer-left {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    float:left;
    font-size: 15px;
    bottom:1px;
}
.footer-right {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    font-size: 15px;
    float:right;
    bottom:1px;
}
.TableData {
    background:#ffffff;
    font: 11px;
    width:100%;
    border-collapse:collapse;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:12px;
    border:thin solid #d3d3d3;
}
.TableData TH {
    background: rgba(0,0,255,0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}
.TableData TR {
    height: 24px;
    border:thin solid #d3d3d3;
}
.TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border:thin solid #d3d3d3;
}
.TableData TR:hover {
    background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
    text-align:center;
    width: 10%;
}
.TableData .cotTenSanPham {
    text-align:left;
    width: 40%;
}
.TableData .cotHangSanXuat {
    text-align:left;
    width: 20%;
}
.TableData .cotGia {
    text-align:right;
    width: 120px;
}
.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}
.TableData .cotSo {
    text-align: right;
    width: 120px;
}
.TableData .tong {
    text-align: right;
    font-weight:bold;
    text-transform:uppercase;
    padding-right: 4px;
}
.TableData .cotSoLuong input {
    text-align: center;
}
@media print {
 @page {
 margin: 0;
 border: initial;
 border-radius: initial;
 width: initial;
 min-height: initial;
 box-shadow: initial;
 background: initial;
 page-break-after: always;
}
}
.head-table-printf{
    height: 120px;
    border: none;
}
.inf{
        padding: 3px 0;
}
.inf span{
     font-style: italic;
}
  </style>

</head>
<body onload="In_Content('print')">
 
  <div>
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img src="{{ asset('uploads/HVC-logo.png') }}" style="width: 80px; height: 80px; margin: 0 90px;" /></div>
        <div class="company">HVC Fashion</div>
    </div>
  <br/>
  <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
  </div>
  <br/>
  <br/>
 <!--  <div class="head-talbe">
        <div class="row">
            <div class="bill col-md-9"><b>Mã đơn hàng: {{$bills->id_bill}} </b></div>
        </div>
        <div><b>Người nhận hàng: </b> {{$bills->reciver}} </div>
            
        <div class=""><b> Địa chỉ nhận hàng : </b>{{$bills->recive_address}}</div>
            
        <div class=""><b>Số diện thoại: </b> {{$bills->phone}}</div>
    </div> -->
    <br>
  <table class="table ">
                <div class="head-table-printf">
                    <div class="row inf">
                        <div class="bill col-md-9"><b>Mã đơn hàng: <span>{{$bills->id_bill}} </span> </b></div>

                    </div>
                    <div class="inf"><b>Người nhận hàng: </b> <span>{{$bills->reciver}}</span> </div>
                        
                    <div class="inf"><b> Địa chỉ nhận hàng : </b><span>{{$bills->recive_address}}</span></div>
                        
                    <div class="inf"><b>Số diện thoại: </b> <span>{{$bills->phone}}</span></div>
                </div>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        

                  
                    </tr>
                </thead>

                <tbody>
                 @foreach($billdt as $key=>$value)
                    <tr>
                       <th>{!!$value->id_product!!}</th>                     
                       <th>{!!$value->product->name!!}</th>
                       <th>{{$value->product_info}}</th>
                       <th>{!!$value->quantity!!}</th>
                       <th>{!!number_format($value->price,0,',','.')!!}</th>
                       <th>{!!number_format($value->total,0,',','.')!!}</th>
                     
                    </tr>
                    @endforeach
                    <tr colspan='5'>
                        <th colspan="4"></th>
           
                        <th colspan="2" style="color:red; font-size: 17px;">Tổng tiền: {{number_format($bills->total_bill,0,',','.')}} vnđ</th>
                    </tr>
                </tbody>
            </table>
  <div class="footer-left"> Hải Phòng, ngày  tháng  năm <br/>
    Khách hàng </div>
  <div class="footer-right"> Hải Phòng, ngày  tháng  năm <br/>
    Nhân viên </div>
</div>
</div>
<script>
function In_Content(strid){   
    // var prtContent = document.getElementById(strid);
    // var WinPrint = window.open();
    // WinPrint.document.write(prtContent.innerHTML);
    // WinPrint.close();
    // WinPrint.focus();
   
    window.print();
     window.close();
   
}
</script>
</body>
</html>