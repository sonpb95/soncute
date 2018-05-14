@extends('layouts.master')
@section('title',$category->name)
@section('header')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>

  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

@endsection

@section('content')
  <script>
  var lastPriority = 0;
  $(document).ready(function(){
    lastPriority = {{$lastPriority}};
     $(document).on('click','#showmoreprojects',function(){
         $("#showmoreprojects").html("Loading...");
         {{--alert("loading data");--}}
         $.ajax({
           type: 'GET',
           url: "/loadMoreCampaign/" + lastPriority + "/{{$category->id}}",
         }).done(function(data) {
           //console.log(data);
              if (data != '') {
                  $("#list-project-ajax").append(data);
                  lastPriority += 12;
                  console.log(lastPriority);
              }
            $("#showmoreprojects").html("Show more projects");
         });
     });
  });
</script>


  <div class="layout-2cols">
        <div class="content grid_9">
            <div class="search-result-page">
                <div class="top-lbl-val">
                    <h3 class="common-title">Khám phá / <span class="fc-orange">{{ $category->name }}</span></h3>
                    <div class="count-result">
                      @if ($category->id > 0)
                        <span class="fw-b fc-black">{{ $category->getCampaignCount() }}</span> dự án được tìm thấy trong danh mục này
                      @endif
                    </div>
                </div>
                <div class="list-project-in-category">
                    <div class="lbl-type clearfix">
                        <h4 class="rs title-lbl"><a href="/categories/{{ $category->id }}" class="be-fc-orange">Phổ biến trong tuần</a></h4>
                        {{--<a href="/categories/{{ $category->id }}" class="view-all be-fc-orange">Xem tất cả</a>--}}
                    </div>
                    <div id="list-project-ajax" class="list-project">
                      @if ($campaigns != "")
                        @foreach ($campaigns as $campaign)
                          <?php $author = $campaign->user()->get()?>
                          <div class="grid_3">
                              <div class="project-short sml-thumb">
                                  <div class="top-project-info">
                                      <div class="content-info-short clearfix" >
                                          <a href="/campaigns/{{ $campaign->id }}" class="thumb-img">
                                              <img src="{{ asset('img/'.$campaign->avatar) }}" alt="{{ $campaign->title }}">
                                          </a>
                                          <div class="wrap-short-detail">
                                              <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{ $campaign->id }}">{{ $campaign->title }}</a></h3>
                                              <p class="rs tiny-desc">by <a href="/users/{{ $author[0]->id }}" class="fw-b fc-gray be-fc-orange">{{ $author[0]->name }}</a></p>
                                              <p class="rs title-description">{{ str_limit($campaign->tagline, 119, '...') }}</p>
                                              <p class="rs project-location">
                                                  <i class="icon iLocation"></i>
                                                  {{ $campaign->location }}
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="bottom-project-info clearfix">
                                      <div class="line-progress">
                                          <div class="bg-progress">
                                            @if ($campaign->getPercents() >= 100)
                                              <span class="success" style="width: {{ $campaign->getPercents() }}%"></span>
                                            @else
                                              <span style="width: {{ $campaign->getPercents() }}%"></span>
                                            @endif

                                          </div>
                                      </div>
                                      <div class="group-fee clearfix">
                                          <div class="fee-item">
                                              <p class="rs lbl">tiến độ</p>
                                              <span class="val">{{ $campaign->getPercents() }}%</span>
                                          </div>
                                          <div class="sep"></div>
                                          <div class="fee-item">
                                              <p class="rs lbl">Thu được</p>
                                              <span class="val">{{ $campaign->getFomattedFundRaised() }}</span>
                                          </div>
                                          <div class="sep"></div>
                                          <div class="fee-item">
                                              <p class="rs lbl">Còn lại</p>
                                              <span class="val">{{ $campaign->getDayLeft() }} ngày</span>
                                          </div>
                                      </div>
                                      <div class="clear"></div>
                                  </div>
                              </div>
                          </div><!--end: .grid_3 > .project-short-->
                          @if ($loop->iteration % 3 == 0 )
                            <div class="clear"></div>
                          @endif
                        @endforeach
                      @endif
                        <div class="clear"></div>
                    </div>
                </div><!--end: .list-project-in-category -->
                @if ($category->id != 0 && $category->getCampaignCount() > 12)
                <p class="rs ta-c">
                    <a id="showmoreprojects" class="btn btn-black btn-load-more">Hiển thị thêm </a>
                </p>
                @endif
            </div><!--end: .search-result-page -->
        </div><!--end: .content -->
        <div class="sidebar grid_3">
            <div class="left-list-category">
                <h4 class="rs title-nav">Trạng thái</h4>
                <ul class="rs nav nav-category">
                  @if ($category->name == "Now lauched")
                    <li class="active">
                  @else
                    <li>
                  @endif
                        <a href="/now-launched">
                            Mới chạy
                            <span class="count-val"></span>
                            <i class="icon iPlugGray"></i>
                        </a>
                    </li>
                    @if ($category->name == "Ending soon")
                      <li class="active">
                    @else
                      <li>
                    @endif
                        <a href="/ending-soon">
                            Sắp kết thúc
                            <span class="count-val"></span>
                            <i class="icon iPlugGray"></i>
                        </a>
                    </li>
                    @if ($category->name == "Small project")
                      <li class="active">
                    @else
                      <li>
                    @endif
                        <a href="/small-project">
                            Dự án nhỏ
                            <span class="count-val"></span>
                            <i class="icon iPlugGray"></i>
                        </a>
                    </li>
                </ul>
            </div><!--end: .left-list-category -->
            <div class="left-list-category">
                <h4 class="rs title-nav">Danh mục</h4>
                <ul class="rs nav nav-category">
                  @foreach ($allCategory as $cat)
                    @if ($cat->id === $category->id)
                      <li class="active">
                    @else
                      <li>
                    @endif
                        <a href="/categories/{{ $cat->id }}">
                            {{ $cat->name }}
                            <span class="count-val">({{ $cat->getCampaignCount() }})</span>
                            <i class="icon iPlugGray"></i>
                        </a>
                    </li>
                  @endforeach
                </ul>
            </div><!--end: .left-list-category -->
        </div><!--end: .sidebar -->
        <div class="clear"></div>
    </div>



@endsection
