<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ifunding | Tạo dự án</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#goal').keyup(function(event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {
                    var formattedValue = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    console.log(formattedValue);
                    return formattedValue;
                });
            });

        });
    </script>

</head>

<body class="top-navigation">

    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">
            @include ('layouts.topnavbar')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>	Dự Án Mới</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">iFunding</a>
                        </li>
                        <li>
                            Dự án
                        </li>
                        <li class="active">
                            <strong>	Tạo mới </strong>
                        </li>
                    </ol>
                </div>

            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="ibox-content">
                            <h2>
                                <span class="text-navy">Bắt đầu dự án mới</span>
                            </h2>
                            <div class="ibox-content">

                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <form method="POST" action="/campaigns" role="form" id="form">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Tên dự án</label>
                                                <input id="title" name="title" type="text" placeholder="Tên dự án của bạn là gì?" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Bạn muốn kêu gọi bao nhiêu vốn cho dự án của mình?</label>
                                                <input id="goal" name="goal" type="text" placeholder="Đơn vị : vnd" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Tỉ giá 1 usd/vnd hiện tại là {{$exchangeRate}}đ. tỉ giá tại thời điểm này sẽ được lưu lại và sử dụng trong suốt quá trình gọi vốn của dự án.</label>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tạo Dự Án</strong></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include ('layouts.footer2')
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#form").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3
                    }
                }
            });
        });
    </script>

</body>

</html>