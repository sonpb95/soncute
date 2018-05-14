
	
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
				<li class="active">
					<a href="{{ url('perk/'.$id) }}">3. GÓI ĐẦU TƯ</a>
				</li>	
				<li >
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
								<strong>	Gói đầu tư </strong>
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
							<?php if($alert == 1){ ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                 <a class="alert-link" href="#"> Bạn phải tạo ít nhất 1 gói đầu tư.</a>.
                            </div>
							<?php } ?>
                            <h2>
                                <span class="text-navy">Các gói đầu tư</span>
                            </h2>
							<h4> Gói đầu tư là những ưu đãi được cung cấp cho người ủng hộ để đổi lấy sự hỗ trợ của họ.</h4>
                            <div class="ibox-content">
								
									<a href="{{ url('perkcreate/'.$id) }}" class="btn btn-sm btn-primary "><strong>TẠO GÓI ĐẦU TƯ MỚI</strong></a>
								
							</div>
							<div class="ibox-content">

								<table class="table">
									<thead>
									<tr>
										
										<th>Giá</th>
										<th>Tên gói đầu tư</th>
										<th>Số lượng</th>
										<th>Ngày gửi sản phẩm dự tính</th>
										<th>Những vật phẩm bao gồm</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($perks as $perk){ ?>
									<tr>
										
										<td><?= number_format($perk->price, 0, ',', '.') ?> đ</td>
										<td><?= $perk->title ?></td>
										<td><?= $perk->total_quantily ?></td>
										<td><?= $perk->estimated_delivery_date ?></td>
										
										<td><?php foreach($perk->items->pluck('item_name') as $item){ 
													echo $item.', ';
										} ?></td>
										<td><a href="{{ url('perkedit/'.$perk->id) }}"><i class="fa fa-edit"></i></a></td>
										<td><a href="{{ url('perkdelete/'.$perk->id) }}"><i class="fa fa-trash"></i></a></td>
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