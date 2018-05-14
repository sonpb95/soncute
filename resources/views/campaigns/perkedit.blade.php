
	
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
                            <h2>
                                <span class="text-navy">Chi tiết về gói đầu tư</span>
                            </h2>
							<h4> Perks are incentives offered to backers in exchange for their support. You may edit your perk details until the perk is claimed. Visit the Help Center to learn about different kinds of perks you can offer.</h4>
                            <div class="ibox-content">
								<div class="row">
									<div class="col-sm-9 ">
								<form  method="POST" action="/perkupdate/{{request()->route('id')}}" role="form" id="form" enctype="multipart/form-data">
								{{ csrf_field() }}
                                    <div class="form-group"><label>Giá *</label> <input id = "price" name="price" type="text" value="{{ $price }}" class="form-control"></div>
                                    <div class="form-group"><label>Giá bán lẻ</label> <input id="retailprice" name="retailprice" type="text" value="{{ $retail_price }}"  class="form-control"></div>
									<div class="form-group"><label>Tên gói đầu tư *</label> <input id = "title" name="title" type="text" value="{{ $title }}" class="form-control"></div>
									<div class="form-group">
										<label >Bao gồm những sản phẩm *</label>
										
											<select data-placeholder="Choose a Item..." class="chosen-select" multiple style="width:350px;" name="included_item[]" tabindex="4" onchange="myFunction()" id="mySelect">
											
											<option value="x" >TẠO SẢN PHẨM</option>
											<?php
											foreach($items as $item){
											?>
												
												<option value="<?= $item->id ?>"><?= $item->item_name ?></option>
											<?php } ?>	
												
											</select>
										
									</div>
									<div class="form-group"><label>Mô tả *</label> <textarea  id = "description" rows="4" cols="50" name="description"  class="form-control">{{ $description }}</textarea></div>
									<div class="form-group">
										<label>Tải ảnh lên</label>
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-default btn-file">
													Tải lên… <input type="file" id="imgInp" name="img"  accept=".jpg, .jpeg, .png">
												</span>
											</span>
											<input type="text" class="form-control" readonly>
										</div>
										<img id='img-upload' name="img-upload" src="{{ asset('img/'.$img) }}"/>
									</div>
									<div class="form-group"><label>Số lượng có sẵn</label> <input id="total_quantily" name="total_quantily" type="text" value="{{ $total_quantily }}"  class="form-control"></div>
									<div class="form-group" id="data_1">
										<label >Thời gian giao hàng ước tính</label>
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"  name="estimated_delivery_date" class="form-control" value="04/02/2018"  readonly>
										</div>
									</div>
									<div class="form-group">
										<h3>
                                            Hình thức vận chuyển
                                        </h3>
                                       <p>
                                            Những sản phẩm này có thể vận chuyển được hay không?
                                        </p>
                                        
                                            
											<?php if($ship == 0){  echo '
                                                <div class="radio">
													 
                                                    <input type="radio" name="radio1" id="radio1" value="0" checked="" >
                                                    <label for="radio1">
                                                        Không, những sản phẩm này không thể vận chuyển được.
                                                    </label>
                                                </div>
                                                <div class="radio">
													
                                                    <input type="radio" name="radio1" id="radio2" value="1"  >
													
                                                    <label for="radio2">
                                                        Có, những sản phẩm này có thể vận chuyển được.
                                                    </label>
													
                                                </div>
													';?>
													<?php }else{ echo '
                                                <div class="radio">
													 
                                                    <input type="radio" name="radio1" id="radio1" value="0"  >
                                                    <label for="radio1">
                                                        Không, những sản phẩm này không thể vận chuyển được.
                                                    </label>
                                                </div>
                                                <div class="radio">
													
                                                    <input type="radio" name="radio1" id="radio2" value="1"  checked="">
													
                                                    <label for="radio2">
                                                        Có, những sản phẩm này có thể vận chuyển được.
                                                    </label>
													
                                                </div>
													';}?>
													 
                                            
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


		<script>
		function myFunction() {
			var x = document.getElementById("mySelect").value;
			if(x == "x"){
				window.location.href = "{{ url('itemcreate/'.$id) }}"
			}
			
		}
		</script>
		@endsection