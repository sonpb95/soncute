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
  <link rel="stylesheet" href="{{ asset('css/modal.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>

  {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

  <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/responsiveslides.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap-modal.js') }}"></script>

  {{--<script>
    $(document).ready(function() {
      $("#MyModal").modal('show');
    });
  </script> --}}
@endsection

@section('content')
<script>
  $(document).ready(function(){

    var tabId = {!! $tabId !!}
    switch(tabId) {
    case 1:
        $("#describe-tab").addClass("active");
        $("#describe-pane").addClass("active");
        break;
    case 2:
        $("#update-tab").addClass("active");
        $("#update-pane").addClass("active");
        break;
    case 3:
        $("#backer-tab").addClass("active");
        $("#backer-pane").addClass("active");
        break;
    case 4:
        $("#comment-tab").addClass("active");
        $("#comment-pane").addClass("active");
        break;
    default:
        $("#describe-tab").addClass("active");
        $("#describe-pane").addClass("active");
    }

    var campaignId = {!! $campaign->id !!}
    var isFollowed = {!! $campaign->isFollowed() !!}
    /*alert(isFollowed == true);
    console.log(isFollowed);*/
    var followButton = $("#follow-btn");
    if (isFollowed == true) {
      followButton.html("Bỏ theo dõi");
      followButton.removeClass("btn-white");
      followButton.addClass("btn-red");
    } else {
      followButton.html("Theo dõi");
      followButton.removeClass("btn-red");
      followButton.addClass("btn-white");
    }

    var isExpired = {!! $isExpired !!}
    if (isExpired == true) {
      //$("#primary-investBtn").removeClass("btn-green");
      //$("#small-investBtn").removeClass("btn-red");
      $("#primary-investBtn,#small-investBtn").click(function () {
        alert("Dự án đã hết hạn gọi vốn, không thể tiến hành đầu tư!");
        return false;});
    }

     $(document).on('click','#follow-btn',function(){
         $.ajax({
           type: 'GET',
           url: "/follow/" + campaignId ,
         }).done(function(data) {
            /*alert(data);
            console.log(data);*/
              if (data == "followed") {
                followButton.html("Bỏ theo dõi");
                followButton.removeClass("btn-white");
                followButton.addClass("btn-red");
              } else {
                followButton.html("Theo dõi");
                followButton.removeClass("btn-red");
                followButton.addClass("btn-white");
              }
         });
     });
  });
</script>
{{--
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
  </button>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{--<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                            <p class="rs pledge-description">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            <p class="rs fw-b pb20">Ocupated ({{ $perk->contributions()->count() }} of {{ $perk->total_quantily }})</p>
                            <p class="rs"><span class="fw-b">Estimated delivery:</span> {{ $perk->estimated_delivery_date }} </p>
                            <p class="rs fw-thin fc-gray pb20">Ships within the US only</p>
                            <p class="rs ta-c"><a class="btn big btn-red" href="/payment/{{ $perk->id }}" data-toggle="modal" data-target="#myModal">Buck this project</a></p>
                        </div>
                    </div>
                </li><!--end: pledge-item -->
              @endforeach
            </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Lưu thay đổi</button>
      </div>
    </div>
  </div>
</div> --}}

  <div class="layout-2cols">
      <div class="content grid_8">
          <div class="project-detail">
              <h2 class="rs project-title">{{ $campaign->title }}</h2>
              <p class="rs post-by">tạo bởi <a href="/user/"{{ $campaign->getAuthorId() }}>{{ $campaign->getAuthorName() }}</a></p>
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
                              <p class="rs lbl">người tài trợ</p>
                              <span class="val">{{ $campaign->getBackerCount() }}</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                              <p class="rs lbl">đã thu được</p>
                              <span class="val">{{ number_format($campaign->getFundRaised(), 0, ',', '.') }}đ</span>
                          </div>
                          <div class="sep"></div>
                          <div class="fee-item">
                              <p class="rs lbl">ngày còn lại</p>
                              <span class="val">{{ $campaign->getDayLeft() }} ngày</span>
                          </div>
                      </div>
                      <div class="clear"></div>
                  </div>
              </div>
              <div class="project-tab-detail tabbable accordion">
                  <ul class="nav nav-tabs clearfix">
                    <li id="describe-tab" ><a href="#">Mô tả dự án</a></li>
                    <li><a id="backer-tab" href="#" class="be-fc-orange">Nhà đầu tư ({{ $campaign->getBackerCount() }})</a></li>
                    <li  id="comment-tab" ><a href="#" class="be-fc-orange">Bình luận ({{ $campaign->getCommentsCount() }}) </a></li>
                  </ul>
                  <div class="tab-content">
                      <div>
                          <h3 class="rs alternate-tab accordion-label">Mô tả dự án</h3>
                          <div class="tab-pane accordion-content" id="describe-pane">
                              <div class="editor-content">
                                  <h3 class="rs title-inside">{{ $campaign->title }}</h3>
                                  <p class="rs post-by">tạo bởi <a href="/user/"{{ $campaign->getAuthorId() }} class="fw-b fc-gray be-fc-orange">{{ $campaign->getAuthorName() }}</a> tại <span class="fw-b fc-gray">{{ $campaign->location }}</span></p>
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
                                @if (Auth::check())
                                  <a class="btn big btn-white" id="follow-btn" >Theo dõi</a>
                                  <a class="btn big btn-black" href="{{ url('reportCampaign/'.$campaign->id) }}">Báo cáo</a>
                                @endif
                              </div>
                          </div><!--end: .tab-pane(About) -->
                      </div>

                      <div>
                          <h3 class="rs alternate-tab accordion-label" id="backer-pane">Nhà đầu tư ({{ $campaign->getBackerCount() }})</h3>
                          <div class="tab-pane accordion-content">
                              <div class="tab-pane-inside">

                                @foreach ($backers as $backer)
                                  @if (get_class($backer) == "App\User")
                                    <div class="project-author pb20">
                                        <div class="media">
                                            <a href="/users/{{ $backer->id }}" class="thumb-left">
                                                <img src="{{ asset('/uploads/avatars/' . $backer->getAvatar()) }}" alt="{{ $backer->name }}"/>
                                            </a>
                                            <div class="media-body">
                                                <h4 class="rs pb10"><a href="/users/{{ $backer->id }}" class="be-fc-orange fw-b">{{ $backer->name }}</a></h4>
                                                <p class="rs">{{ $backer->getCity() }}</p>
                                                <a href="/users/{{ $backer->id }}/5" class="rs fc-gray">{{ $backer->getCampaignCount() }} dự án</a>
                                            </div>
                                        </div>
                                    </div><!--end: .project-author -->
                                  @else
                                    <div class="project-author pb20">
                                        <div class="media">
                                            <a href="#" class="thumb-left">
                                                <img src="{{ asset('/uploads/avatars/default-avatar.png') }}" alt="{{ $backer->full_name }}"/>
                                            </a>
                                            <div class="media-body">
                                                <h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b">{{ $backer->full_name }}</a></h4>
                                                <p class="rs">{{ $backer->city }}</p>
                                                <p class="rs fc-gray">Tài khoản khách vãng lai</p>
                                            </div>
                                        </div>
                                    </div><!--end: .project-author -->
                                  @endif
                                @endforeach
                              </div>
                              @if (Auth::check())
                                <div class="project-btn-action">
                                    <a class="btn btn-red" id="follow-btn" href="#">Theo dõi</a>
                                    <a class="btn btn-black" href="#">Báo cáo</a>
                                </div>
                              @endif
                          </div><!--end: .tab-pane(Backers) -->
                      </div>
                      <div>
                          <h3 class="rs active alternate-tab accordion-label" >Bình luận</h3>
                          <div class="tab-pane accordion-content" id="comment-pane">
                            @foreach ($comments as $comment)
                              <div class="box-list-comment">
                                  <div class="media comment-item">
                                      <a href="#" class="thumb-left">
                                          <img src="{{ asset('uploads/avatars/'.$comment->user->userDetail->avatar) }}" >
                                      </a>
                                      <div class="media-body">
                                          <h4 class="rs comment-author">
                                              <a href="#" class="be-fc-orange fw-b">{{$comment->user->name}}</a>
                                              <span class="fc-gray">đã bình luận:</span>
                                          </h4>
                                          <p class="rs comment-content"> {{$comment->text}}</p>
                                          <p class="rs time-post">{{$comment->updated_at->format('M d Y')}}</p>
                                      </div>
                                  </div><!--end: .comment-item -->
                              </div>
                            @endforeach
							                <div class="wrapper-box box-post-comment">
								                  <form method="POST" action="/comment/{{ $campaign->id }}">
									                   {{ csrf_field() }}
									                   <div class="form form-post-comment">
											                  <label for="txt_content_comment">
												                   <textarea name="comment" id="txt_content_comment" cols="30" rows="10" class="txt fill-width" placeholder="Your comment "></textarea>
											                  </label>
										                    <div class="clear"></div>
										                       <p class="rs ta-r clearfix">
										                         <input type="submit" class="btn btn-white btn-submit-comment" value="Submit">
									                         </p>
									                  </div>
								                 </form>
							              </div><!--end: .box-list-comment -->
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
                      <span class="val"><span class="fw-b">Khởi chạy: </span>{{ date_format($campaign->start_at, 'd/m/Y H:i:s') }}</span>
                  </div>
                  <div class="project-date clearfix">
                      <i class="icon iClock"></i>
                      <span class="val"><span class="fw-b">Kết thúc: </span>{{ date_format($campaign->end_at, 'd/m/Y H:i:s') }}</span>
                  </div>
                  @if ($isExpired == 'true')
                    <a id="primary-investBtn" class="btn btn-black btn-buck-project" href="#">
                        <span class="lbl">Kết thúc</span>
                        <span class="desc">Dự án đã kết thúc</span>
                    </a>
                    <p class="rs description">Dự án này đã kết thúc gọi vốn, không thể tiến hành đầu tư, bạn vui lòng tham khảo các dự án khác.</p>
                  @else
                    <a id="primary-investBtn" class="btn btn-green btn-buck-project" href="/payment/{{ $perks->first()->id }}">
                        <span class="lbl">Đầu tư</span>
                        <span class="desc">{{ number_format($perks['0']->price, 0, ',', '.') }}đ mức thấp nhất</span>
                    </a>
                    <p class="rs description">Dự án này sẽ được cấp vốn nếu quyên góp được số vốn tối thiểu {{ number_format($campaign->goal, 0 , ',', '.') }} vnđ trước ngày {{ date_format($campaign->end_at, 'd/m/Y') }}.</p>
                  @endif
              </div>
          </div><!--end: .project-runtime -->
          <div class="project-author">
              <div class="box-gray">
                  <h3 class="title-box">Người tạo</h3>
                  <div class="media">
                      <a href="/users/{{ $author->get('0')->id }}" class="thumb-left">
                          <img src="{{ asset('uploads/avatars/'.$author->get('0')->getAvatar()) }}" alt="{{ $author->get('0')->name }}"/>
                      </a>
                      <div class="media-body">
                          <h4 class="rs pb10"><a href="/users/{{ $author->get('0')->id }}" class="be-fc-orange fw-b">{{ $author->get('0')->name }}</a></h4>
                          <p class="rs">{{ $author->get('0')->getCity() }}</p>
                          <p class="rs fc-gray">{{ $author->get('0')->getCampaignCount()}} dự án</p>
                      </div>
                  </div>
                  <div class="author-action">
                      <a class="btn btn-red" href="/users/{{ $author->get('0')->id }}">Liên hệ với tôi</a>
                      <a class="btn btn-white" href="/users/{{ $author->get('0')->id }}">Xem thêm</a>
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
                          <span class="pledge-amount">Gói tài trợ {{ number_format($perk->price, 0, ',', '.') }} vnđ</span>
                          <span class="count-val">({{ $perk->contributions()->count() }} trong tổng số {{ $perk->total_quantily }})</span>
                      </div>
                      @if ($loop->first)
                        <div class="active pledge-content accordion-content">
                      @else
                         <div class=" pledge-content accordion-content">
                      @endif
                          <div class="pledge-detail">
                              <p class="rs pledge-description">{{ $perk->description }}.</p>
                              <p class="rs fw-b pb20">Đã bán ({{ $perk->contributions()->count() }} trong tổng số {{ $perk->total_quantily }})</p>
                              <p class="rs"><span class="fw-b">Ngày nhận hàng (ước tính):</span> {{ $perk->estimated_delivery_date }} </p>
                              <p class="rs fw-thin fc-gray pb20">Chỉ vận chuyển sản phẩm trong nội địa VN</p>
                              @if ($isExpired != 'true')
                                <p class="rs ta-c"><a id="small-investBtn" class="btn big btn-red" href="/payment/{{ $perk->id }}">Đầu tư</a></p>
                              @else
                                <p class="rs ta-c"><a id="small-investBtn" class="btn big btn-black" href="#">Không thể đầu tư</a></p>
                              @endif

                          </div>
                      </div>
                  </li><!--end: pledge-item -->
                @endforeach
              </ul>
          </div><!--end: .wrap-nav-pledge -->
      </div><!--end: .sidebar -->
      <div class="clear"></div>
  </div>
	@if (session('success'))
		<?php echo('<script type="text/javascript">alert("'.session('success').'");</script>');?>
	@endif
@endsection
