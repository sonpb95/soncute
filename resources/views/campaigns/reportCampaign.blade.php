@extends('layouts.master')

@section('header')
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>

  <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
@endsection
@section('content')
  <div class="layout-2cols">
        <div class="content grid_8">
            <div class="project-detail">
                <div class="project-tab-detail tabbable accordion">
					<div class="tab-content">
						<div class="tab-pane accordion-content active">
							<div class="form form-profile">
								<div class="row-item clearfix">
									<label class="lbl" for="txt_bio">Lý Do:</label>
									<div class="val">
									  @if (Auth::check() && Auth::id() == $userid)
										  <form  method="POST" action="/reportSent/{{request()->route('id')}}" role="form" enctype="multipart/form-data">
										  {{ csrf_field() }}
											<textarea class="txt fill-width" name="reason" id="reason" cols="30" rows="10" value=""></textarea>
										 
										  <p class="rs description-input">Lý do bạn report dự án này.</p>
										  <br>
										 <div>
											<button  class="btn btn-red " type="submit"><strong>Gửi Đi</strong></button>
										</div>
										</form>
									  @else
										<label class="lbl" for="txt_bio">Bạn cần đăng nhập để thực hiện chức năng này</label>
									  @endif
									
									  
									</div>
								</div>
							</div>
						</div>
					</div>
                </div><!--end: .project-tab-detail -->
            </div>
        </div><!--end: .content -->
       
        <div class="clear"></div>
    </div>
@endsection
