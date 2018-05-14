
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
				<li  class="active">
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
								<strong>	Tổng quan </strong>
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
                                 <a class="alert-link" href="#">Không Được Để Trống Avatar.</a>.
                            </div>
							<?php } ?>
                            <h2>
                                <span class="text-navy">Tổng quan </span>
                            </h2>
							<h4>Tạo một ấn tượng tốt với mọi người bằng việc: giới thiệu mục tiêu dự án của bạn .</h4>
                            <div class="ibox-content">
                        <div class="row">
								<div class="col-sm-9 ">
                                <form  method="POST" action="/basicstore/{{ $id }}" role="form" id="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-group"><label>Tên dự án *</label> <input id = "title" name="title" type="text" value="{{ $title }}" class="form-control"></div>
                                    <div class="form-group"><label>Khẩu hiệu dự án *</label> <input id = "tagline" name="tagline" type="text" value="{{ $tagline }}" placeholder="Mô tả ngắn về dự án của bạn để thu hút mọi người" class="form-control"></div>
									<div class="form-group">
										<label>Tải ảnh lên</label>
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-default btn-file">
													Chọn… <input type="file" id="imgInp" name="img"  accept=".jpg, .jpeg, .png">
												</span>
											</span>
											<input type="text" class="form-control" readonly>
										</div>
										<img id='img-upload' name="img-upload" src="{{ asset('img/'.$img) }}"/>
									</div>
									<div class="form-group">
									<label>Địa điểm *</label> 
									<input id = "location" name="location" type="text" placeholder="Location" value="{{ $location }}" class="form-control">
									
									
									
									</div>
									
									<div class="form-group">
										<label >Danh mục *</label>
										
											<select class="select2_demo_1 form-control" name="categories" >
											<?php
											foreach($categories as $category){
											?>
												<?php if($category->id == $categori ) { ?>
													<option selected="<?= $category->id ?>" value="<?= $category->id ?>"><?= $category->name ?></option>		
												<?php }else{ ?>
												<option value="<?= $category->id ?>"><?= $category->name ?></option>
											<?php }} ?>	
											</select>
										
									</div>
									<div class="form-group">
										<label >Tags *</label>
										
										<input class="tagsinput form-control" name="tags" type="text" value="<?= $tag ?>"/>
										
									</div>
									<div class="form-group">
										<label >Thời gian chạy dự án *</label>
										<input id = "duration" name="duration" type="number" value="{{ $duration }}" class="form-control" placeholder="Tối đa 60 ngày">

									</div>
									
									
                                    <div>
                                        <button  class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>SAVE & CONTINUE</strong></button>
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