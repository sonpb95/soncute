
	
	@extends('layouts.master2')
	
	@section('navigation')
	
	@extends('layouts.navigation')
		
		@section('leftnav')
			<li class="nav-header">
					<div class="dropdown profile-element"> <span>
								<img alt="image" class="img-circle" width="60" height="60" src="{{ asset('img/'.$imgs) }}" />
								 </span>
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Dự án</strong>
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $title }}</strong>
						
					</div>
					
				</li>
			

				<li class="active">
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">KHỞI TẠO DỰ ÁN </span><span class="fa arrow"></a>
				<ul class="nav nav-second-level collapse">
				<li >
					<a href="{{ url('basic/'.$id) }}">1. TỔNG QUAN</a>
				</li >
				<li class="active">
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
								<strong>	Chi tiết </strong>
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
                                 <a class="alert-link" href="#"> Bạn phải có ít nhất 1 ảnh hoặc video</a>.
                            </div>
							<?php } ?>
                            <h2>
                                <span class="text-navy">Ảnh Hoặc Video về Dự Án </span>
                            </h2>
							<h4> Vui lòng đính kèm đường link tải video hoặc hình ảnh giới thiệu về dự án của bạn tại đây. Lưu ý video của bạn đã được up lên youtube trước đó.</h4>
                            <div class="ibox-content">
						<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> VIDEO</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">HÌNH ẢNH</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
								
                                     <form  method="POST" action="/videostore/{{ $id }}" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-inline"><label>Đường dẫn Video *</label> <input id = "video" name="video" type="text" value="" class="form-control">
									<button  class="btn btn-sm btn-primary " type="submit"><strong>THÊM VIDEO</strong></button>
									</div>
									</form>
									<div class="ibox-content">
										<figure>
											<iframe width="425" height="349" src="{{ $videos }}" frameborder="0" allowfullscreen></iframe>
										</figure>
									</div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <form  method="POST" action="/storystore/{{ $id }}" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
									<div class="form-group">
										<div class="col-sm-9 ">
										<label>Hình ảnh *</label>
										<h5>Tải hình ảnh xuất hiện dầu tiên về dự án của bạn. Độ phân giải khuyến khích là 695 x 460.</h5>
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-default btn-file ">
													Chọn ảnh… <input type="file" id="imgInp" name="img"  accept=".jpg, .jpeg, .png">
												</span>
											</span>
											<input type="text" class="form-control" readonly>
										</div>
										<img id='img-upload' name="img-upload" src="{{ asset('img/'.$img) }}"/>
										</div>
										
									</div>
                                </div>
                            </div>
                        </div>
                            
                        </div>
                    </div>
					
					<div class="ibox-content">
						
							<div class="form-group">
								<h2>
                            <span class="text-navy">Chi tiết về dự án *</span>
                            </h2>
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5>Hãy cho chúng tôi biết đặc điểm về dự án/ sản phẩm mà bạn muốn cho mọi người thấy, hữu ích và có khả năng được cộng đồng đón nhận</h5>
											
										</div>
										<div class="ibox-content no-padding">
											<div class="col-sm-10 ">
											
											<textarea name="pitch" class="summernote">
												
												{!! $pitch !!}
												
											</textarea>
												<!-- <h3>Lorem Ipsum is simply</h3>
												dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
												when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
												typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
												<br/>
												<br/>
												<ul>
													<li>Remaining essentially unchanged</li>
													<li>Make a type specimen book</li>
													<li>Unknown printer</li>
												</ul> -->
											
											</div>
										</div>
									</div>
								
							</div>
									
							</div>
							<div class="ibox-content">
								<button  class="btn btn-sm btn-primary " type="submit"><strong>LƯU & TIẾP TỤC</strong></button>
								</form>
							</div>
                            
                        </div>
						
					
                    
                
        </div>
        </div>
		</div>
	

   
		@endsection