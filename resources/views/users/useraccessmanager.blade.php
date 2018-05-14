
	
	@extends('layouts.master2')
	
	@section('navigation')
	
	@extends('layouts.navigation')
		
		@section('leftnav')
			<li class="nav-header">
					<div class="dropdown profile-element"> <span>
								
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">ADMIN</strong>
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}} </strong>
						
					</div>
					
				</li>

			<li class="active">
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label"> QUẢN LÝ </span><span class="fa arrow"></a>
				<ul class="nav nav-second-level collapse">
				<li >
					<a href="{{ url('campaignmanager/') }}">1. QUẢN LÝ DỰ ÁN</a>
				</li>
				<li class="active">
					<a href="{{ url('users/usermanager/') }}">2. QUẢN LÝ NGƯỜI DÙNG</a> 
				</li>
				<li >
					<a href="{{ url('categorymanager') }}">2. DANH MỤC</a> 
				</li>
										
				</ul>
			</li>
		@endsection
	@endsection

	@section('content')
	
		
			
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-9">
						<h2>	Admin</h2>
						<ol class="breadcrumb">
							<li>
								<a href="{{ url('') }}">Trang chủ</a>
							</li>
							<li>
								Người Dùng
							</li>
							<li class="active">
								<strong>	Quản lý người dùng</strong>
							</li>
						</ol>
					</div>
				</div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="ibox-content">
						<h2>
							<span class="text-navy">Phân Quyền</span>
						</h2>
							
						<?php  if(!$admin) {		?>
										
						
							<H4>Bạn Có Muốn <span class="text-navy"><?= $users->name ?></span> Trở Thành Quản Trị Viên</H4>
							<button class="btn btn-warning btn-sm demo3" onclick="admin()">CÓ TÔI MUỐN</button>
							
						<?php }else{ ?>
							
							<H4>Bạn Có Muốn Xóa Quyền Quản Trị Viên Của <span class="text-navy"><?= $users->name ?></span> Không </H4>
							<button class="btn btn-danger btn-sm demo4" onclick="rmadmin()">CÓ TÔI MUỐN</button>
							
						<?php } ?>
							
													
					</div>
				</div>
			</div>
		</div>
		
	
		<script>


		function admin(){
			
			swal({
				title: "Bạn có chắc không?",
				text: "<?= $users->name ?> Sẽ trở thành quản trị viên!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#66ff66",
				confirmButtonText: "Vâng, Tôi muốn!",
				cancelButtonText: "không !",
				closeOnConfirm: false,
				closeOnCancel: false },
				function (isConfirm) {
					if (isConfirm) {
					   window.location = "{{ url('/users/isadmin/'.request()->route('id')) }}";
					} else {
						swal("Cancelled", "", "error");
					}
				}
			);}
			function rmadmin(){
			
			swal({
				title: "Bạn có chắc không?",
				text: "<?= $users->name ?> Sẽ không còn là quản trị viên!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#ff1a1a",
				confirmButtonText: "Vâng, Tôi muốn!",
				cancelButtonText: "không !",
				closeOnConfirm: false,
				closeOnCancel: false },
				function (isConfirm) {
					if (isConfirm) {
					   window.location = "{{ url('/users/removeadmin/'.request()->route('id')) }}";
					} else {
						swal("Cancelled", "", "error");
					}
				}
			);}
		
		</script>

   
		@endsection