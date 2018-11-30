@extends('backend.layouts.master')
@section('content')

<div class="panel panel-flat">
     <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Báo cáo bán hàng</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-title text-semibold">
                        <i class="icon-calendar3 position-left"></i>
                        Thời gian
                    </div>
                </div>

                <form action="#">
                    <div class="panel-body">
                        <label>Ngày cụ thể</label>
                        <div class="input-group">
                            
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="date" class="form-control" >
                        </div>
                    </div>
                     <div class="panel-body">
                        <label>Khoảng thời gian</label>
                        <div class="input-group">
                            
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" name="dates" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
         
            <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-title text-semibold">
                                <i class="icon-calendar3 position-left"></i>
                                Date posted
                            </div>
                        </div>

                        <form action="#">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="radio no-margin-top">
                                        <label>
                                            <input type="radio" name="when_posted" class="styled">
                                            Today
                                            <span class="text-muted text-size-small">&nbsp;(632)</span>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="when_posted" class="styled">
                                            Yesterday
                                            <span class="text-muted text-size-small">&nbsp;(431)</span>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="when_posted" class="styled">
                                            Last week
                                            <span class="text-muted text-size-small">&nbsp;(31)</span>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="when_posted" class="styled">
                                            Last month
                                            <span class="text-muted text-size-small">&nbsp;(124)</span>
                                        </label>
                                    </div>

                                    <div class="radio no-margin-bottom">
                                        <label>
                                            <input type="radio" name="when_posted" class="styled">
                                            Any time
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
        <div class="panel panel-flat col-md-9">
        <div id="app">
            {!! $chart->container() !!}
        </div>
        </div>
    </div>
    
@stop
@section('script')
@parent
        <script src="https://unpkg.com/vue"></script>
        <script>
            var app = new Vue({
                el: '#app',
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        {!! $chart->script() !!}



        <script >
            $('input[name="dates"]').daterangepicker({
                 language: "vi-VN",
                locale: {
                 monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
                  format: 'DD/MM/YY'
                }
            });
        </script>
  @stop