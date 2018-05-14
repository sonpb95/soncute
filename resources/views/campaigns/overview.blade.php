@extends('layouts.master')
@section('title',$campaign->title)

@section('header')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsiveslides.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>

  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/responsiveslides.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

@endsection

@section('content')
  <div class="layout-2cols">
      <div class="content grid_8">
          <div class="project-detail">
              <h2 class="rs project-title">{{ $campaign->title }}</h2>
              <p class="rs post-by">by <a href="/users/"{{ $campaign->getAuthorId() }}>{{ $campaign->getAuthorName() }}</a></p>
              <div class="project-short big-thumb">
                 <div class="top-project-info">
                        <div class="content-info-short clearfix">
                            <div class="thumb-img">
                                <div class="rslides_container">
                                  <ul class="rslides" id="slider1">
                                    @if ($videos != "")
                                    @foreach ($videos as $video)
                                      <li>
  										                   <iframe width="555" height="349" src="{{ $video->link }}" frameborder="0" allowfullscreen></iframe>
  									                  </li>
                                    @endforeach
									@endif
									 @foreach ($photos as $photo)
                                    <li><img style="height: 100%;" src="{{ asset('img/'.$photo->link) }}" alt=""></li>
                                  @endforeach
                                  </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--end: .top-project-info -->
                  <div class="bottom-project-info clearfix">
                      <div class="project-progress sys_circle_progress" data-percent={{ $campaign->getPercents() }}>
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
                      <div class="clear"></div>
                  </div>
              </div>
              <div class="project-tab-detail tabbable accordion">
                  <ul class="nav nav-tabs clearfix">
                    <li class="active"><a href="#">About</a></li>
                    <li><a href="#" class="be-fc-orange">Comments (2)</a></li>
                  </ul>
                  <div class="tab-content">
                      <div>
                          <h3 class="rs alternate-tab accordion-label">About</h3>
                          <div class="tab-pane active accordion-content">
                              <div class="editor-content">
                                  <h3 class="rs title-inside">{{ $campaign->title }}</h3>
                                  <p class="rs post-by">by <a href="/user/"{{ $campaign->getAuthorId() }} class="fw-b fc-gray be-fc-orange">{{ $campaign->getAuthorName() }}</a> in <span class="fw-b fc-gray">{{ $campaign->location }}</span></p>
                                  <?= $campaign->pitch  ?>

                                  <div class="social-sharing">
                                      <!-- AddThis Button BEGIN -->
                                      <div class="addthis_toolbox addthis_default_style">
                                      <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                      <a class="addthis_button_tweet"></a>
                                      <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                                      <a class="addthis_counter addthis_pill_style"></a>
                                      </div>
                                      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
                                      <!-- AddThis Button END -->
                                  </div>
                              </div>
                              <div class="project-btn-action">
                                    <a class="btn big btn-white" id="follow-btn" >Theo dõi</a>
                                  <a class="btn big btn-black" href="#">Báo cáo</a>
                              </div>
                          </div><!--end: .tab-pane(About) -->
                      </div>

                      <div>
                          <h3 class="rs active alternate-tab accordion-label">Comments (2)</h3>
                          <div class="tab-pane accordion-content">
                              <div class="box-list-comment">
                                  <div class="media comment-item">
                                      <a href="#" class="thumb-left">
                                          <img src="{{ url('uploads/avatars/default-avatar.png') }}" >
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs comment-author">
                                              <a href="#" class="be-fc-orange fw-b">John Doe</a>
                                              <span class="fc-gray">say:</span>
                                          </h4>
                                          <p class="rs comment-content"> Dự án này quá hay</p>
                                          <p class="rs time-post">5 days ago</p>
                                      </div>
                                  </div><!--end: .comment-item -->
                                  <div class="media comment-item">
                                      <a href="#" class="thumb-left">
                                           <img src="{{ url('uploads/avatars/default-avatar.png') }}" >
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs comment-author">
                                              <a href="#" class="be-fc-orange fw-b">Eminem</a>
                                              <span class="fc-gray">say:</span>
                                          </h4>
                                          <p class="rs comment-content">Tuyệt vời.</p>
                                          <p class="rs time-post">5 days ago</p>
                                      </div>
                                  </div><!--end: .comment-item -->
                                
                              </div>
                          </div><!--end: .tab-pane(Comments) -->
                      </div>
                    </div>
              </div><!--end: .project-tab-detail -->
          </div>
      </div><!--end: .content -->
      <div class="sidebar grid_4">
          <div class="project-runtime">
              <div class="box-gray">
                  <div class="project-date clearfix">
                      <i class="icon iCalendar"></i>
                      <span class="val"><span class="fw-b">Launched: </span>{{ $campaign->start_at }}</span>
                  </div>
                  <div class="project-date clearfix">
                      <i class="icon iClock"></i>
                      <span class="val"><span class="fw-b">Funding ends: </span>{{ $campaign->end_at }}</span>
                  </div>
				   <a id="primary-investBtn" class="btn btn-green btn-buck-project" href="{{URL::route('basic', [$campaign->id])}}">
                        <span class="lbl">Trở lại chỉnh sửa</span>
                        <span class="desc"></span>
                    </a>
                  <p class="rs description">Dự án này sẽ được cấp vốn nếu quyên góp được số vốn tối thiểu ${{ $campaign->goal }} vnđ trước ngày {{ $campaign->end_at }}.</p>
              </div>
          </div><!--end: .project-runtime -->
          <div class="project-author">
              <div class="box-gray">
                  <h3 class="title-box">Project by</h3>
                  <div class="media">
                      <a href="/users/{{ $author->get('0')->id }}" class="thumb-left">
                          <img src="{{ $author->get('0')->getAvatar() }}" alt="{{ $author->get('0')->name }}"/>
                      </a>
                      <div class="media-body">
                          <h4 class="rs pb10"><a href="/users/{{ $author->get('0')->id }}" class="be-fc-orange fw-b">{{ $author->get('0')->name }}</a></h4>
                          <p class="rs">{{ $author->get('0')->getCity() }}</p>
                          <p class="rs fc-gray">{{ $author->get('0')->getCampaignCount()}} projects</p>
                      </div>
                  </div>
                  <div class="author-action">
                      <a class="btn btn-red" href="/users/{{ $author->get('0')->id }}">Contact me</a>
                      <a class="btn btn-white" href="/users/{{ $author->get('0')->id }}">See full bio</a>
                  </div>
              </div>
          </div><!--end: .project-author -->
          <div class="clear clear-2col"></div>
          <div class="wrap-nav-pledge">
              <ul class="rs nav nav-pledge accordion">
                @foreach ($perks as $perk)
                  <li>
                      @if ($loop->first)
                        <div class="active pledge-label accordion-label clearfix">
                      @else
                        <div class=" pledge-label accordion-label clearfix">
                      @endif
                          <i class="icon iPlugGray"></i>
                          <span class="pledge-amount">Pledge ${{ $perk->price }} or more</span>
                          <span class="count-val">({{ $perk->contributions()->count() }} of {{ $perk->total_quantily }})</span>
                      </div>
                      @if ($loop->first)
                        <div class="active pledge-content accordion-content">
                      @else
                         <div class=" pledge-content accordion-content">
                      @endif
                          <div class="pledge-detail">
                              <p class="rs pledge-description">{{ $perk->title }}</p>
                              <p class="rs fw-b pb20">Ocupated ({{ $perk->contributions()->count() }} of {{ $perk->total_quantily }})</p>
                              <p class="rs"><span class="fw-b">Estimated delivery:</span> {{ $perk->estimated_delivery_date }} </p>
                              <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                              
                          </div>
                      </div>
                  </li><!--end: pledge-item -->
                @endforeach
              </ul>
          </div><!--end: .wrap-nav-pledge -->
      </div><!--end: .sidebar -->
      <div class="clear"></div>
  </div>
  </div>
  </div>
  
  
@endsection
