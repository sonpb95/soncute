
	
	@extends('layouts.master2')
	
	@section('navigation')
	
	@extends('layouts.navigation')
		
		@section('leftnav')
			<li class="nav-header">
					<div class="dropdown profile-element"> <span>
								<img alt="image" class="img-circle" width="60" height="60" src="{{ asset('img/'.$img) }}" />
								 </span>
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Dự án</strong>
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $title }}</strong>
						
					</div>
					
				</li>
			

				<li class="active">
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">KHỞI TẠO DỰ ÁN </span><span class="fa arrow"></a>
				<ul class="nav nav-second-level collapse">
				<li  >
					<a href="{{ url('basic/'.$id) }}">1. TỔNG QUAN</a>
				</li>
				<li >
					<a href="{{ url('story/'.$id) }}">2. CHI TIẾT</a> 
				</li>
				<li >
					<a href="{{ url('perk/'.$id) }}">3. GÓI ĐẦU TƯ</a>
				</li>	
				<li class="active">
					<a href="{{ url('item/'.$id) }}">4. SẢN PHẨM</a>
				</li>
										
				</ul>
				</li>
				<li>
					<a href="{{ url('financialInformation/'.$id) }}"><i class="fa fa-credit-card"></i> <span class="nav-label">THÔNG TIN TÀI CHÍNH</span></a>
				</li>
			
			
			
		@endsection
	@endsection

	@section('content')
	
		
			
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-8">
						<h2>	Dự Án {{ $title }}</h2>
						
						<ol class="breadcrumb">
							<li>
								<a href="{{ url('') }}">iFunding</a>
							</li>
							<li>
								Dự án
							</li>
							<li class="active">
								<strong>	Sản phẩm </strong>
							</li>
							
							
							
						</ol>
						
					</div>
					<div class="col-lg-2">
					<br>
					<br>
						<a class="btn btn-w-m btn-success " href="{{ url('overview/'.$id) }}">Xem trước</a>
					</div>
					<div class="col-lg-2">
					<br>
					<br>
					<form  method="POST" action="{{ url('launchcampaign/'.$id) }}" role="form" enctype="multipart/form-data">
					{{ csrf_field() }}
						<button type="submit" class="btn btn-w-m btn-success ">Khởi chạy</button>
					</form>
					</div>
					
				</div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                        <div class="ibox-content">
                            <h2>
                                <span class="text-navy">Sản phẩm </span>
                            </h2>
							<h4> Bạn cung cấp những sản phẩm gì để đổi lấy sự hỗ trợ của mọi người? </h4>
                            <div class="ibox-content">
								<a href="/itemcreate/{{ $id }}" class="btn btn-sm btn-primary "><strong>TẠO SẢN PHẨM MỚI</strong></a>
							</div>
							<div class="ibox-content">

								<table class="table">
									<thead>
									<tr>
										
										<th>Tên sản phẩm</th>
										<th>Tùy chọn</th>
										<th>Thuộc gói đầu tư</th>
										<th></th>
										
									</tr>
									</thead>
									<tbody>
									<?php foreach($items as $item){ ?>
									<tr>
										
										<td><?= $item->item_name ?></td>
										<td><?= $item->option_name ?></td>
										<td><?php foreach($item->perks->pluck('title') as $perk){ 
													echo $perk.', ';
										} ?></td>
										<td><a href="{{ url('itemedit/'.$item->id) }}"><i class="fa fa-edit"></i></a></td>
										<td><a href="{{ url('itemdelete/'.$item->id) }}"><i class="fa fa-trash"></i></a></td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

						</div>
					
							
                            
                        </div>
						
					
                    
                
        </div>
        </div>
		</div>


   
		@endsection