
	
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
				<li class="active">
					<a href="{{ url('campaignmanager/') }}">1. QUẢN LÝ DỰ ÁN</a>
				</li>
				<li >
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
								Dự án
							</li>
							<li class="active">
								<strong>	Quản lý report </strong>
							</li>
						</ol>
					</div>
				</div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                        <div class="ibox-content">
                            <h2>
                                <span class="text-navy">Quản Lý Report</span>
                            </h2>
							<div class="panel-body">
								
								<div class="ibox-content">

								<table class="table">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Report Bởi</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($reports as $report){ ?>
									<tr>
										
										<td>{{ $report->id }}</td>
										<td>{{ $report->campaigns->title }}</td>
										<td>{{ $report->user->name }}</td>
										<td>{{ $report->created_at }}</td>
										
										<td>
											<a href="{{ url('reportViewByAdmin/'.$report->id) }}"><i class="fa fa-eye"></i></a>
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
		


   
		@endsection