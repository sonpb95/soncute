
	
	@extends('layouts.master2')
	
	@section('navigation')
	
	@extends('layouts.navigation')
		
		@section('leftnav')
			<li class="nav-header">
					<div class="dropdown profile-element"> <span>
								<img alt="image" class="img-circle" width="60" height="60" src="{{ asset('img/'.$img) }}" />
								 </span>
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Campaign</strong>
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
                                <span class="text-navy">Chi tiết sản phẩm</span>
                            </h2>
							<h4> Sản phẩm thuộc gói đầu tư mà bạn muốn đem lại cho người ủng hộ</h4>
                            <div class="ibox-content">
								<div class="row">
                                    <div class="col-sm-9" >
								<form  method="POST" action="/itemupdate/{{request()->route('id')}}" role="form" id="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-group"><label>Tên sản phẩm *</label> <input id = "item_name" name="item_name" type="text" value="{{ $items->item_name }}" class="form-control"></div>
                                    
									<div class="form-group">
										<h3>
                                           Tùy chọn
                                        </h3>
                                       <p>
                                            Bạn muốn người hỗ trợ được tùy chọn sản phẩm, ví dụ: size, màu sắc,... ?
                                        </p>
                                        
                                                <div class="radio">
                                                    <input type="radio" name="radio1" id="radio1" value="option1" >
                                                    <label for="radio1">
                                                         Không, Sản phẩm này không có bất cứ tùy chọn nào.
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="radio1" id="radio2" value="option2" checked="">
                                                    <label for="radio2">
                                                        Có, Sản phẩm này có tùy chọn.
                                                    </label>
                                                </div>
                                            </div>
										
										<div class="form-inline" id="show_option" ><label>Tên tùy chọn</label> 
											<input id = "option_name" name="option_name" type="text" placeholder="Size" value="{{ $items->option_name }}" class="form-control">
											<label>Giá trị tùy chọn</label> 
											<input id="option_value" name="option_value" type="text" placeholder="Small,Medium,Large" value="{{ $items->option_value }}" class="form-control">
										
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