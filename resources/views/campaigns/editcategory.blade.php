
	
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
				<li >
					<a href="{{ url('users/usermanager/') }}">2. QUẢN LÝ NGƯỜI DÙNG</a> 
				</li>
				<li class="active">
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
								<strong>	Quản lý danh mục</strong>
							</li>
						</ol>
					</div>
				</div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="ibox-content">
						<h2>
							<span class="text-navy">Chỉnh SỬa Danh Mục</span>
						</h2>
							   <form  method="POST" action="/campaigns/updatecategory/{{$id}}" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-inline"><label>Tên Danh Mục</label> <input id = "name" name="name" type="text" value="{{$category}}" class="form-control">
									<button  class="btn btn-sm btn-primary " type="submit"><strong>Lưu</strong></button>
									</div>
									</form>
					
										
						
						
							
						
						
							
						
													
					</div>
				</div>
			</div>
		</div>
		
	


   
		@endsection