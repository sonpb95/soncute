@extends('layouts.master')

@section('header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/md-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
	  <link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>
	  <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.touchwipe.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/md_slider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

@endsection

@section('content')
  <div id="home-slider">
     <div class="md-slide-items md-slider" id="md-slider-1" data-thumb-width="105" data-thumb-height="70">
        <div class="md-slide-item slide-0" data-timeout="6000">
           <div class="md-mainimg"><img src="{{ asset('images/ex/th-slide0.jpg')}}" alt=""></div>
           <div class="md-objects">
              <div class="md-object rs slide-title" data-x="20" data-y="38" data-width="480" data-height="30" data-start="700" data-stop="5500" data-easein="random" data-easeout="keep">
                 <p>Hiện thực hoá mọi ý tưởng sáng tạo.</p>
              </div>
              <div class="md-object rs slide-description" data-x="20" data-y="160" data-width="480" data-height="90" data-start="1400" data-stop="7500" data-easein="random" data-easeout="keep">
                 <p>Bắt đầu khởi nghiệp ngay hôm nay và biến ý tưởng thành thực tế nhờ vào sự trợ giúp từ cộng đồng.</p>
              </div>
              <div class="md-object rs" data-x="20" data-y="260" data-width="120" data-height="23" data-padding-top="9" data-padding-bottom="7" data-padding-left="10" data-padding-right="10" data-start="1800" data-stop="7500" data-easein="random" data-easeout="keep">
                 <a href="/cac-dieu-khoan-chung" class="btn btn-gray">Tìm hiểu thêm</a>
              </div>
              <div class="md-object" data-x="495" data-y="0" data-width="612" data-height="365" data-start="1800" data-stop="7500" data-easein="fadeInRight" data-easeout="keep" style=""><img src="{{ asset('images/ex/th-slide-man.png')}}" alt="Search Money for Your Creative Ideas" width="612" height="365" /></div>
           </div>
        </div>
        <div class="md-slide-item slide-1" data-timeout="6000">
           <div class="md-mainimg"><img src="{{ asset('images/ex/th-slide1.jpg')}}" alt=""></div>
           <div class="md-objects">
              <div class="md-object rs slide-title" data-x="20" data-y="188" data-width="390" data-height="30" data-start="700" data-stop="5500" data-easein="random" data-easeout="random">
                 <p>Cùng iFunding</p>
              </div>
              <div class="md-object rs slide-description2" data-x="20" data-y="250" data-width="390" data-height="100" data-start="1400" data-stop="4500" data-easein="random" data-easeout="random">
                 <p>Nâng tầm cuộc sống.</p>
              </div>
              <div class="md-object" data-x="454" data-y="44" data-width="327" data-height="268" data-start="1000" data-stop="5500" data-easein="random" data-easeout="random" style=""><img src="{{ asset('images/ex/slide1_1.png')}}" alt="Responsive" width="327" height="268" /></div>
              <div class="md-object" data-x="628" data-y="142" data-width="298" data-height="176" data-start="1600" data-stop="5100" data-easein="random" data-easeout="random" style=""><img src="{{ asset('images/ex/slide1_2.png')}}" alt="Responsive" width="298" height="176" /></div>
              <div class="md-object" data-x="837" data-y="169" data-width="119" data-height="149" data-start="2200" data-stop="4800" data-easein="random" data-easeout="random" style=""><img src="{{ asset('images/ex/slide1_3.png')}}" alt="Responsive" width="119" height="149" /></div>
              <div class="md-object" data-x="809" data-y="208" data-width="59" data-height="114" data-start="2800" data-stop="4500" data-easein="random" data-easeout="random" style=""><img src="{{ asset('images/ex/slide1_4.png')}}" alt="Responsive" width="59" height="114" /></div>
           </div>
        </div>
        <div class="md-slide-item slide-2" data-timeout="4000">
           <div class="md-mainimg"><img src="{{ asset('images/ex/th-slide2-1.jpg')}}" alt=""></div>
           <div class="md-objects">
              <div class="md-object slide-with-background" data-x="20" data-y="58" data-width="500" data-height="170" data-padding-top="30" data-padding-bottom="30" data-padding-left="35" data-padding-right="35" data-start="300" data-stop="3600" data-easein="random" data-easeout="keep">
                 <h2 class="rs slide-title">Bạn muốn khởi nghiệp?</h2>
                 <p class="rs slide-description2">Cùng chung tay xây dựng cộng đồi khởi nghiệp Việt Nam bằng cách khởi động một dự án ngay để nhận được sự hỗ trợ từ cộng đồng và quảng bá sản phẩm dịch vụ của bạn với người tiêu dùng.</p>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--end: #home-slider -->

  <div class="home-feature-category">
     <div class="container_12 clearfix">
        <div class="grid_4 left-lst-category">
           <div class="wrap-lst-category">
              <h3 class="title-welcome rs">Chào mừng bạn đến với iFunding!</h3>
              <p class="description rs">Hãy khám phá những ý tưởng, dịch vụ, sản phẩm độc đáo, mới lạ và tiềm năng bằng cách lựa chọn các danh mục dưới đây nhé!</p>
              <nav class="lst-category">
                 <ul class="rs nav nav-category">
                   @foreach ($categories as $category)
                     <li> {{--dat thuoc tinh <li class="active" de hien thi chu mau do --}}
                        <a href="/categories/{{ $category->id }}">
                        {{ $category->name }}
                        <span class="count-val">({{$category->getCampaignCount()}})</span>
                        <i class="icon iPlugGray"></i>
                        </a>
                     </li>
                   @endforeach
                 </ul>
                 <p class="rs view-all-category">
                    <a href="/discover" class="be-fc-orange">Xem tất cả các danh mục</a>
                 </p>
              </nav>
              <!--end: .lst-category -->
           </div>
        </div>
        <!--end: .left-lst-category -->
        <div class="grid_8 marked-category">

           <div class="wrap-title clearfix">
              <h2 class="title-mark rs">Dự án tiêu biểu: <span class="fc-orange">{{ $staffPickCampaign->getCategoryName() }}</span></h2>
              <a href="/categories/{{ $staffPickCategory[0]->id }}" class="count-project be-fc-orange">Xem tất cả <span class="fw-b">{{ $staffPickCategory[0]->campaigns()->count() }}</span> dự án {{ $staffPickCategory[0]->name }} </a>
           </div>

           <div class="box-marked-project project-short">
              <div class="top-project-info">
                 <div class="content-info-short clearfix">
                    <a href="/campaigns/{{ $staffPickCampaign->id }}" class="thumb-img">
                    <img src="{{ asset('img/'.$staffPickCampaign->avatar) }}" style="height: 100%;" alt="{{ $staffPickCampaign->title }}">
                    </a>
                    <div class="wrap-short-detail">
                       <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{ $staffPickCampaign->id }}">{{ $staffPickCampaign->title }}</h3>
                       <p class="rs tiny-desc">tạo bởi <a href="/users/{{ $staffPickCampaign->getAuthorId() }}" class="fw-b fc-gray be-fc-orange">{{ $staffPickCampaign->getAuthorName() }}</a> tại <span class="fw-b fc-gray">{{ $staffPickCampaign->location }}</span></p>
                       <p class="rs title-description">{{ $staffPickCampaign->tagline }}</p>
                    </div>
                    <p class="rs clearfix comment-view">
                       <a href="/campaigns/{{ $staffPickCampaign->id }}/4" class="fc-gray be-fc-orange">{{ $staffPickCampaign->getCommentsCount() }} bình luận</a>
                       {{--<span class="sep">|</span>
                       <a href="/campaigns/{{ $staffPickCampaign->id }}" class="fc-gray be-fc-orange">378 lượt xem</a> --}}
                    </p>
                 </div>
              </div>
              <!--end: .top-project-info -->
              <div class="bottom-project-info clearfix">
                 <div class="project-progress sys_circle_progress" data-percent={{ $staffPickCampaign->getPercents() }}>
                    <div class="sys_holder_sector"></div>
                 </div>
                 <div class="group-fee clearfix">
                    <div class="fee-item">
                       <p class="rs lbl">Nhà đầu tư</p>
                       <span class="val">{{ $staffPickCampaign->getBackerCount() }}</span>
                    </div>
                    <div class="sep"></div>
                    <div class="fee-item">
                       <p class="rs lbl">Đã thu được</p>
                       <span class="val">{{ number_format($staffPickCampaign->getFundRaised(), 0, ',', '.') }}đ</span>
                    </div>
                    <div class="sep"></div>
                    <div class="fee-item">
                       <p class="rs lbl">Ngày còn lại</p>
                       <span class="val">{{ $staffPickCampaign->getDayLeft() }} ngày</span>
                    </div>
                 </div>
                 <div class="clear"></div>
              </div>
           </div>
        </div>
        <!--end: .marked-category -->
        <div class="clear"></div>
     </div>
  </div>

  <!--end: .home-feature-category -->
  <div class="home-popular-project">
     <div class="container_12">
        <div class="grid_12 wrap-title">
           <h2 class="common-title">Nổi bật</h2>
           <a class="be-fc-orange" href="/discover">Xem tất cả</a>
        </div>
        <div class="clear"></div>
        <div class="lst-popular-project clearfix">
          @foreach ($randomCampaigns as $randomCampaign)
            @if ($loop->index == 1)
              <div class="clear clear-2col"></div>
            @endif
           <div class="grid_3">
              <div class="project-short sml-thumb">
                 <div class="top-project-info">
                    <div class="content-info-short clearfix">
                       <a href="/campaigns/{{ $randomCampaign->id }}" class="thumb-img">
                       <img src="{{ asset('img/'.$randomCampaign->avatar) }}" alt="{{ $randomCampaign->title }}">
                       </a>
                       <div class="wrap-short-detail">
                          <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{ $randomCampaign->id }}">{{ $randomCampaign->title }}</a></h3>
                          <p class="rs tiny-desc">tạo bởi <a href="/users/{{ $randomCampaign->getAuthorId() }}" class="fw-b fc-gray be-fc-orange">{{ $randomCampaign->getAuthorName() }}</a></p>
                          <p class="rs title-description">{{ str_limit($randomCampaign->tagline, 119, '...') }}</p>
                          <p class="rs project-location">
                             <i class="icon iLocation"></i>
                             {{ $randomCampaign->location }}
                          </p>
                       </div>
                    </div>
                 </div>
                 <div class="bottom-project-info clearfix">
                    <div class="line-progress">
                       <div class="bg-progress">
                          <span  style="width: {{ $randomCampaign->getPercents() }}%"></span>
                       </div>
                    </div>
                    <div class="group-fee clearfix">
                       <div class="fee-item">
                          <p class="rs lbl">Tiến độ</p>
                          <span class="val">{{ $randomCampaign->getPercents() }}%</span> <!-- % so tien du an -->
                       </div>
                       <div class="sep"></div>
                       <div class="fee-item">
                          <p class="rs lbl">Thu được</p>
                          <span class="val">{{ $randomCampaign->getFomattedFundRaised() }}</span>
                       </div>
                       <div class="sep"></div>
                       <div class="fee-item">
                          <p class="rs lbl">Còn lại</p>
                          <span class="val">{{ $randomCampaign->getDayLeft() }} ngày</span>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
          @endforeach
           <!--end: .grid_3 > .project-short-->
        </div>
     </div>
  </div>

  <!--end: .home-popular-project -->
  <div class="home-discover-friends">
     <div class="container_12">
        <div class="row-friends">
          @foreach ($randomUsers as $randomUser)
            @if ($loop->index < 8)
                <a class="thumb-avatar" href="/users/{{$randomUser->id}}"><img src="{{ asset('uploads/avatars/'.$randomUser->getAvatar()) }}" alt="{{ $randomUser->name }}"/></a>
            @endif
          @endforeach
           <div class="clear"></div>
        </div>
        <div class="row-friends row-connect-fb">
           <a class="thumb-avatar t-first" href="/users/{{$randomUsers[8]->id}}"><img src="{{ asset('uploads/avatars/'.$randomUsers[8]->getAvatar()) }}" alt="{{ $randomUsers[8]->name }}"/></a>
           <div class="connect-fb">
              <p class="rs description">Khám phá và chia sẻ những điều kỳ thú cùng bạn bè!</p>
              <a href="/redirect/facebook" class="btn btn-fb">Kết nối với Facebook</a>
           </div>
           <a class="thumb-avatar t-last" href="/users/{{$randomUsers[9]->id}}"><img src="{{ asset('uploads/avatars/'.$randomUsers[9]->getAvatar()) }}"  alt="{{ $randomUsers[9]->name }}"/></a>
           <div class="clear"></div>
        </div>
        <div class="row-friends">
          @foreach ($randomUsers as $randomUser)
            @if ($loop->index > 9)
                <a class="thumb-avatar" href="/users/{{$randomUser->id}}"><img src="{{ asset('uploads/avatars/'.$randomUser->getAvatar()) }}" alt="{{ $randomUser->name }}"/></a>
            @endif
          @endforeach
           <div class="clear"></div>
        </div>
     </div>
  </div>

  <!--end: .home-discover-friends -->
  <div class="additional-info-line">
     <div class="container_12">
        <div class="grid_9">
           <h2 class="rs title">Hãy cùng chúng tôi hiện thực hoá những giấc mơ của bạn!</h2>
           <p class="rs description">Bắt đầu một dự án ngay hôm nay để nhận được những sự hỗ trợ tốt nhất từ cộng đồng khởi nghiệp Việt Nam.</p>
        </div>
        <div class="grid_3 ta-r">
           <a class="btn bigger btn-red" href="/cac-dieu-khoan-chung">Tìm hiểu thêm</a>
        </div>
        <div class="clear"></div>
     </div>
  </div>
  <!--end: .additional-info-line -->
  @if (session('error'))
    <?php echo('<script type="text/javascript">alert("'.session('error').'");</script>');?>
  @endif

@endsection
