
	
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
                                <span class="text-navy">Quản Lý Người Dùng</span>
                            </h2>
							<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">All User</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">All Admin</a></li>
							
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
								
								<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên</th>
										<th>Email</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($users as $user){ ?>
										<tr>
											
											<td><?= $user->id ?></td>
											<td><?= $user->name ?></td>
											<td><?= $user->email ?></td>
											<td><?= $user->created_at ?></td>
											<td>
												<a href="{{ url('users/'.$user->id) }}"><i class="fa fa-eye"></i></a>
												<a href="{{ url('users/useraccessmanager/'.$user->id) }}"><i class="fa fa-edit"></i></a>
												<a href="{{ url('users/deleteuser/'.$user->id) }}"><i class="fa fa-trash"></i></a>
											
											</td>
										</tr>
										
											<?php } ?>
									</tbody>
								</table>

								</div>
                                    
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    
								<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên</th>
										<th>Email</th>
										<th>số điện thoại</th>
										<th>Thời Gian</th>									
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($admins as $admin){ ?>
											<tr>
												
												<td><?= $admin->user->id ?></td>
												<td><?= $admin->user->name ?></td>
												<td><?= $admin->user->email ?></td>
												<td><?= $admin->phone_number ?></td>
												<td><?= $admin->created_at ?></td>
												<td>
													<a href="{{ url('users/'.$admin->id) }}"><i class="fa fa-eye"></i></a>
													<a href="{{ url('users/useraccessmanager/'.$admin->id) }}"><i class="fa fa-edit"></i></a>
													
												
												</td>
											</tr>
											
												<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
							
							
                        </div>
                            
                        </div>
                            
                        </div>
                            
							
					
							
                            
                        </div>
						
					
                    
                
        </div>
        </div>
		<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
			
        });
		</script>


   
		@endsection