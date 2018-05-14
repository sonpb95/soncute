<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Danh Sách Nhà Đầu Tư</title>

	
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style1.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
	
	
</head>

<body class="top-navigation">

<div id="wrapper">


<div id="page-wrapper" class="gray-bg">
        @include ('layouts.topnavbar')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>	Dự Án {{$campaign->title}}</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('') }}">iFunding</a>
                        </li>
                        <li>
                            {{$campaign->title}}
                        </li>
                        <li class="active">
                            <strong>Danh Sách Nhà Đầu Tư </strong>
                        </li>
                    </ol>
                </div>
				
            </div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                        <div class="ibox-content">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Địa Chỉ</th>
                                <th>Email</th>
								<th>Số Điẹn Thoại</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach($contributions as $contribution) { ?>
                            <tr>
                                <td></td>
                                <td ><a href="{{ asset('/users/' . $contribution->user_id) }}" >{{ $contribution->user->name }}</a></td>
                                <td>{{ $contribution->user->userDetail->address }}</td>
                                <td>{{ $contribution->user->email }}</td>
								<td>{{ $contribution->user->userDetail->phone_number }}</td>
                            </tr>
                          <?php } ?>
                            </tbody>
                        </table>
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
	
	

</body>

</html>
