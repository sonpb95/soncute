@extends('layouts.master')
@section('title','Tìm kiếm')

@section('header')

@endsection
  <meta charset="utf-8">
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

@section('content')
    <div class="layout-2cols">
        <div class="content grid_9">
            <div class="search-result-page">
                <div class="top-lbl-val">
                    <h3 class="common-title">Discover / <span class="fc-orange">Search</span></h3>
                    <div class="count-result">
                      @if ($result != '' && $result->count() != 0)
                        <span class="fw-b fc-black">{{ $result->count() }}</span> Kết quả tìm kiếm cho từ khoá “<span class="fw-b fc-black">{{$query}}</span>”:
                      @else
                        <span class="fw-b fc-black"></span> Không tìm thấy kết quả nào phù hợp với từ khoá “<span class="fw-b fc-black">{{$query}}</span>”, vui lòng thử lại.
                      @endif
                    </div>
                    {{--<div class="confirm-search">Were you looking for projects in <a href="#" class="fw-b be-fc-orange">Crafts</a>?</div>--}}
                </div>
                <div id="list-search-ajax" class="list-project-result">
                  @if ($result != '')
                  @foreach ($result as $campaign)
                    <?php $author = $campaign->user()->first()?>
                    <div class="project-short larger">
                        <div class="top-project-info">
                            <div class="content-info-short clearfix">
                                <a href="/campaigns/{{ $campaign->id }}" class="thumb-img">
                                    <img src="{{ asset('/img/' . $campaign->avatar ) }}" alt="{{ $campaign->title }}">
                                </a>
                                <div class="wrap-short-detail">
                                    <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{ $campaign->id }}">{{ $campaign->title }}</a></h3>
                                    <p class="rs tiny-desc">by <a href="/users/{{$author->id}}" class="fw-b fc-gray be-fc-orange">{{$author->nane}}</a> in <span class="fw-b fc-gray">{{ $campaign->location }}</span></p>
                                    <p class="rs title-description">{{ $campaign->tagline }}</p>

                                </div>
                                <p class="rs clearfix comment-view">
                                    <a href="#" class="fc-gray be-fc-orange">75 comments</a>
                                    <span class="sep">|</span>
                                    <a href="#" class="fc-gray be-fc-orange">378 views</a>
                                </p>
                            </div>
                        </div><!--end: .top-project-info -->
                        <div class="bottom-project-info clearfix">
                            <div class="project-progress sys_circle_progress" data-percent="{{ $campaign->getPercents() }}">
                                <div class="sys_holder_sector"></div>
                            </div>
                            <div class="group-fee clearfix">
                                <div class="fee-item">
                                    <p class="rs lbl">Bankers</p>
                                    <span class="val">{{ $campaign->getBackerCount() }}</span>
                                </div>
                                <div class="sep"></div>
                                <div class="fee-item">
                                    <p class="rs lbl">Pledged</p>
                                    <span class="val">${{ $campaign->getFundRaised() }}</span>
                                </div>
                                <div class="sep"></div>
                                <div class="fee-item">
                                    <p class="rs lbl">Days Left</p>
                                    <span class="val">{{ $campaign->getDayLeft() }}</span>
                                </div>
                            </div>
                            <a class="btn btn-red btn-buck-project" href="/campaigns/{{ $campaign->id }}">Xem chi tiết</a>
                            <div class="clear"></div>
                        </div>
                    </div><!--end: project-short item -->
                  @endforeach
                @endif
                </div>
                <p class="rs ta-c">
                    {{--<a id="showmoreresults" class="btn btn-black btn-load-more" href="#">Show more projects</a>--}}
                </p>
            </div><!--end: .search-result-page -->
        </div><!--end: .content -->
        <div class="clear"></div>
        {{--$result->links()--}}
    </div>
    <script>
    $(function () {
        var values = [];
        $(".sys_circle_progress").each(function () {
    		if (!$(this).find('.sys_holder_sector').text()) {
    			var getDonePercent = parseInt($(this).attr("data-percent"));
    			var getPendingPercent = 100 - getDonePercent;
    			if(getPendingPercent==0){
    				values[0] = getDonePercent;
    			}else{
    				values[0] = getPendingPercent;
    				values[1]=getDonePercent;
    			}
    			Raphael($(this).find(".sys_holder_sector")[0], 78, 78).pieChart(39, 39, 39, values, "#cecece");
    			$(this).append('<span class="val-progress">' + $(this).attr("data-percent") + '%</span>');
    		}
        });
    });
    </script>
@endsection
