
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

				<li >
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
				<li >
					<a href="{{ url('item/'.$id) }}">4. SẢN PHẨM</a>
				</li>
										
				</ul>
				</li>
				<li class="active">
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
								<strong>	Thông Tin Tài Chính </strong>
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
						<?php if($alert == 1){ ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                 <a class="alert-link" href="#"> Bạn Phải Điền Đầy Đủ Thông Tin Tài Chính</a>.
                            </div>
							<?php } ?>
							 @if (session('success'))
									<?php echo('
								 <div class="alert alert-success alert-dismissable">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
									 <a class="alert-link" href="#"> '.session('success').'</a>
								</div>
								');?>
								@endif
                        <div class="ibox-content">
                            <h2>
                                <span class="text-navy">Thông tin tài chính</span>
                            </h2>
							<h4>Thông tin tài chính giúp chúng tôi xác nhận và chuyển khoản cho bạn khi dự án thành công.</h4>
                            <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9" >
                                <form  method="POST" action="/financialInformationstore/{{ $id }}" role="form" id="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-group"><label>Số Tài Khoản</label> <input id = "account_number" name="account_number" type="text" value="{{ $account_number }}" class="form-control"></div>
                                    <div class="form-group"><label>Tên Tài Khoản</label> <input id = "account_name" name="account_name" type="text" value="{{ $account_name }}"  class="form-control"></div>
									<div class="form-group">
									<label>Tên Ngân Hàng</label> 
									<input id = "bank_name" name="bank_name" type="text"  value="{{ $bank_name }}" class="form-control">	
									</div>
									
									
									
									<div class="form-group">
										<label >Chi Nhánh</label>
										<input id = "branch" name="branch"  value="{{ $branch }}" class="form-control">

									</div>
									
									
                                    <div>
                                        <button  class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>LƯU & TIẾP TỤC</strong></button>
                                    </div>
                                </form>
								</div>
                            </div>
                            
                        </div>
                    </div>
                            
                        </div>
                    
                
        </div>
        </div>


   
		@endsection