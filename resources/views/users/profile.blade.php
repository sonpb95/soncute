@extends('layouts.master')
@section('title', $user->name)
@section('header')
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>

  <script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

@endsection
@section('content')
<style>
	#table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
	}

	#table td, #table th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#table tr:nth-child(even){background-color: #f2f2f2;}

	#table tr:hover {background-color: #ddd;}

	#table th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #e84837;
		color: white;
	}
  </style>

  <script>
  $(document).ready(function(){
    var tabId = {!! $tabId !!}
    switch(tabId) {
    case 1:
        $("#profile-tab").addClass("active");
        $("#profile-pane").addClass("active");
        break;
    case 2:
        $("#account-tab").addClass("active");
        $("#account-pane").addClass("active");
        break;
    case 3:
        $("#detail-tab").addClass("active");
        $("#detail-pane").addClass("active");
        break;
    case 4:
        $("#password-tab").addClass("active");
        $("#password-pane").addClass("active");
        break;
    case 5:
        $("#project-tab").addClass("active");
        $("#project-pane").addClass("active");
        break;
    case 6:
        $("#contribution-tab").addClass("active");
        $("#contribution-pane").addClass("active");
        break;
    case 7:
        $("follow-tab").addClass("active");
        $("#profile-pane").addClass("active");
        break;
    default:
        $("#profile-tab").addClass("active");
        $("#profile-pane").addClass("active");
    }

    {{--$('#biography').on("cut copy paste",function(e) {
          e.preventDefault();
    });--}}

  });
</script>

  <div class="layout-2cols">
        <div class="content grid_8">
            <div class="project-detail">
                <div class="project-tab-detail tabbable accordion">
                    <ul class="nav nav-tabs clearfix">
                      <li id="profile-tab" ><a class="be-fc-orange">Tiểu sử</a></li>
                      <li id="account-tab" ><a class="be-fc-orange">Tài khoản</a></li>
                      @if (Auth::check() && Auth::id() == $user->id)
                        <li id="detail-tab" ><a class="be-fc-orange">Chi tiết</a></li>
                        @if (!$isSocialAccount)
                          <li id="password-tab" ><a class="be-fc-orange">Mật khẩu</a></li>
                        @endif
                      @else
                        <li class="disable"><a class="be-fc-orange">Chi tiết</a></li>
                        @if (!$isSocialAccount)
                          <li class="disable"><a class="be-fc-orange">Mật khẩu</a></li>
                        @endif
                      @endif
                      <li id="project-tab"><a class="be-fc-orange">Dự án</a></li>
					            <li id="contribution-tab"><a class="be-fc-orange">Đóng góp</a></li>
                      <li id="follow-tab"><a class="be-fc-orange">Theo dõi</a></li>
                    </ul>
                    <div class="tab-content">
                        <div>
                            <h3 class="rs alternate-tab accordion-label">Tiểu sử</h3>
                            <div class="tab-pane accordion-content" id="profile-pane">
                                <div class="form form-profile">
                                    <form method="post" action="/users/{{$user->id}}/update">
                                      {{ csrf_field() }}
                                        <div class="row-item clearfix">
                                            <label class="lbl" for="txt_name1">Tên:</label>
                                            <div class="val">
                                              @if (Auth::check() && Auth::id() == $user->id)
                                                <input class="txt" type="text" id="name" name="name" value="{{$user->name}}" required>
                                              @else
                                                <input class="txt" type="text" id="name" name="name" value="{{$user->name}}" disabled required>
                                              @endif
                                                <p class="rs description-input">Tiên của bạn sẽ được hiển thị trên trang cá nhân, tại phần tiểu sử.</p>
                                            </div>
                                        </div>

                                        <div class="row-item clearfix">
                                            <label class="lbl" for="txt_bio">Tiểu sử:</label>
                                            <div class="val">
                                              @if (Auth::check() && Auth::id() == $user->id)
                                                <textarea class="txt fill-width" name="biography" id="biography" cols="30" rows="10" value="">{{ $user->biography }}</textarea>
                                              @else
                                                <textarea class="txt fill-width" name="biography" id="biography" cols="30" rows="10" value="" disabled>{{ $user->biography }}</textarea>
                                              @endif
                                              <p class="rs description-input">Khuyến cáo giới thiệu về bản thân ngắn gọn không quá 300 từ.</p>
                                            </div>
                                        </div>

                                      {{--  @include('layouts.error')--}}

                                        <p class="wrap-btn-submit rs ta-r">
                                          @if (Auth::check() && Auth::id() == $user->id)
                                            <input type="submit" class="btn btn-red btn-submit-all"></input>
                                          @endif
                                        </p>
                                    </form>
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                        <div>
                            <h3 class="rs alternate-tab accordion-label">Tài khoản</h3>
                            <div class="tab-pane accordion-content" id="account-pane">
                                <div class="tab-pane-inside">
                                    <div class="project-author pb20">
                                        <div class="media">
                                            <a href="#" class="thumb-left">
                                                <img src="{{ asset('/uploads/avatars/' . $userDetail['avatar']) }}" alt="$USER_NAME">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b">{{$user->name}}</a></h4>
                                                <p class="rs">{{$userDetail['city']}}</p>
                                                <p class="rs fc-gray pb10">{{$user->getCampaignCount()}} dự án</p>
                                                <p class="rs description">{{$user->biography}}</p>
                                            </div>
                                        </div>
                                    </div><!--end: .project-author -->
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                        <div>
                            <h3 class="rs alternate-tab accordion-label">Chi tiết</h3>
                            <div class="tab-pane accordion-content" id="detail-pane">
                                <div class="form form-profile">
                                    <form enctype="multipart/form-data" method="post" action="/users/{{$user->id}}/details/update">
                                      {{ csrf_field() }}
                                      <div class="row-item clearfix">
                                          {{--<img src="{{$userDetail['avatar']}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"> --}}
                                          <label class="lbl" for="txt_avatar">Ảnh đại diện:</label>
                                          <div class="val">
                                              <input type="file" name="avatar">
                                              <p class="rs description-input">Ảnh đại diện sẽ được điều chỉnh về kích cỡ 90*90px.</p>
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_full_name">Họ và tên:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <input class="txt" type="text" id="full_name" name="full_name" value="{{$userDetail['fullName']}}" required>
                                            @else
                                              <input class="txt" type="text" id="full_name" name="full_name" value="{{$userDetail['fullName']}}" disabled required>
                                            @endif
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_phone_number">Số điện thoại:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <input class="txt" type="text" id="phone_number" name="phone_number" value="{{$userDetail['phoneNumber']}}" required>
                                            @else
                                              <input class="txt" type="text" id="phone_number" name="phone_number" value="{{$userDetail['phoneNumber']}}" disabled required>
                                            @endif
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_country">Quốc gia:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <select name="country" required>
                                                @if ($userDetail['country'] == '')
                                                  <option value="" disabled="disabled" selected="selected">Lựa chọn quốc gia hoặc vùng lãnh thổ</option>
                                                @else
                                                  <option value="{{$userDetail['country']}}" selected="selected">{{$userDetail['country']}}</option>
                                                @endif
                                                @foreach ($countries as $country)
                                                  <option value="{{$country}}">{{$country}}</option>
                                                @endforeach
                                              </select>
                                            @endif
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_city">Thành phố:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <input class="txt" type="text" id="city" name="city" value="{{$userDetail['city']}}" required>
                                            @else
                                              <input class="txt" type="text" id="city" name="city" value="{{$userDetail['city']}}" disabled required>
                                            @endif
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_postal_code">Mã bưu chính:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <input class="txt" type="text" id="postal_code" name="postal_code" value="{{$userDetail['postalCode']}}">
                                            @else
                                              <input class="txt" type="text" id="postal_code" name="postal_code" value="{{$userDetail['postalCode']}}" disabled>
                                            @endif
                                          </div>
                                      </div>

                                      <div class="row-item clearfix">
                                          <label class="lbl" for="txt_address">Địa chỉ:</label>
                                          <div class="val">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <textarea class="txt fill-width" name="address" id="address" cols="20" rows="10" value="" required>{{$userDetail['address']}}</textarea>
                                            @else
                                              <textarea class="txt fill-width" name="address" id="address" cols="20" rows="10" value="" disabled required>{{$userDetail['address']}}</textarea>
                                            @endif
                                          </div>
                                      </div>

                                    {{--  @include('layouts.error')--}}

                                        <p class="wrap-btn-submit rs ta-r">
                                          @if (Auth::check() && Auth::id() == $user->id)
                                            <input type="submit" class="btn btn-red btn-submit-all"></input>
                                          @endif
                                        </p>
                                    </form>
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                        {{--<div>
                            <h3 class="rs alternate-tab accordion-label">Notifications</h3>
                            <div class="tab-pane accordion-content">
                                <br /> Notifications<br /> <br /> <br /> <br /><br /><br />

                            </div><!--end: .tab-pane -->
                        </div> --}}
                        @if (!$isSocialAccount)
                          <div>
                              <h3 class="rs alternate-tab accordion-label">Mật khẩu</h3>
                              <div class="tab-pane accordion-content" id="password-pane">
                                  <div class="form form-profile">
                                      <form method="post" action="/users/{{$user->id}}/password/update">
                                        {{ csrf_field() }}
                                          <div class="row-item clearfix">
                                            @if (Auth::check() && Auth::id() == $user->id && !( Auth::user()->password == ''))
                                              <label class="lbl" for="txt_current_password">Mật khẩu hiện tại:</label>
                                              <div class="val">
                                                  <input class="txt" type="password" id="current-password" name="current-password" required>
                                              </div>
                                            @endif
                                          </div>

                                          <div class="row-item clearfix">
                                            <label class="lbl" for="txt_new_password">Mật khẩu mới:</label>
                                            <div class="val">
                                                <input class="txt" type="password" id="new-password" name="new-password" required>
                                            </div>
                                          </div>

                                          <div class="row-item clearfix">
                                            <label class="lbl" for="txt_confirm_password">Nhập lại mật khẩu:</label>
                                            <div class="val">
                                                <input class="txt" type="password" id="new-password_confirmation" name="new-password_confirmation" required>
                                              </div>
                                          </div>

                                        {{--  @include('layouts.error')--}}

                                          <p class="wrap-btn-submit rs ta-r">
                                            @if (Auth::check() && Auth::id() == $user->id)
                                              <input type="submit" class="btn btn-red btn-submit-all"></input>
                                            @endif
                                          </p>
                                      </form>
                                      <div class="clear"></div>
                                      {{-- Bao loi nhap sai password tai day --}}
                                      @if (session('error'))
                                        <div class="alert alert-danger">
                                          {{ session('error') }}
                                        <?php echo('<script type="text/javascript">alert("'.session('error').'");</script>');?>
                                        </div>
                                      @endif
                                      @if (session('success'))
                                        <div class="alert alert-success">
                                          {{ session('success') }}
                                        <?php echo('<script type="text/javascript">alert("'.session('success').'");</script>');?>
                                        </div>
                                      @endif

                                  </div>
                              </div><!--end: .tab-pane -->
                          </div>
                        @endif
                        <div>
                            <h3 class="rs alternate-tab accordion-label">Dự án</h3>
                            <div class="tab-pane accordion-content" id="project-pane">
                              @foreach ($campaigns as $campaign)
                                <div class="box-marked-project project-short inside-tab">
                                    <div class="top-project-info">
                                        <div class="content-info-short clearfix">
                                            <a href="/campaigns/{{$campaign->id}}" class="thumb-img">
                                                <img src="{{ asset('img/'.$campaign->avatar) }}" style="height: 100%;" alt="{{$campaign->title }}">
                                            </a>
                                            <div class="wrap-short-detail">
                                                <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{$campaign->id}}">{{$campaign->title}}</a></h3>
                                                <p class="rs tiny-desc">tạo bởi <a href="/users/{{$user->id}}" class="fw-b fc-gray be-fc-orange">{{$user->name}}</a> tại <span class="fw-b fc-gray">{{$userDetail['city']}}</span></p>

                                            </div>
                                            <p class="rs clearfix comment-view">
                                                 @if (Auth::check() && Auth::id() == $user->id)
													                           <a class="btn btn-red" href="/basic/{{$campaign->id}}">Cập Nhật</a>
													                           <span class="sep">|</span>
													                           <a class="btn btn-blue" href="/investerlist/{{$campaign->id}}">Nhà Đầu Tư</a>
												                         @endif
                                            </p>
                                        </div>
                                    </div><!--end: .top-project-info -->
                                    <div class="bottom-project-info clearfix">
                                        <div class="project-progress sys_circle_progress" data-percent="{{$campaign->getPercents()}}">
                                            <div class="sys_holder_sector"></div>
                                        </div>
                                        <div class="group-fee clearfix">
                                            <div class="fee-item">
                                                <p class="rs lbl">Nhà Đầu Tư</p>
                                                <span class="val">{{$campaign->getBackerCount()}}</span>
                                            </div>
                                            <div class="sep"></div>
                                            <div class="fee-item">
                                                <p class="rs lbl">Thu Được</p>
                                                <span class="val">{{ number_format($campaign->getFundRaised(), 0, ',', '.') }}đ</span>
                                            </div>
                                            <div class="sep"></div>
                                            <div class="fee-item">
                                                <p class="rs lbl">Còn Lại</p>
                                                <span class="val">{{$campaign->getDayLeft()}} ngày</span>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div><!--end: .box-marked-project -->
                              @endforeach
                            </div><!--end: .tab-pane -->
                        </div>

						            <div>
                            <h3 class="rs alternate-tab accordion-label">Đóng góp</h3>
                            <div class="tab-pane accordion-content" id="contribution-pane">


                           <table id="table">
                            <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Dự Án</th>
                                <th>Số Tiền</th>
                                <th>Gói Đầu Tư</th>
                            </tr>
                            </thead>
                            <tbody>
							              @foreach ($mycontributions as $contribution)
                            <tr>
                                <td>{{$contribution->date}}</td>
                                <td>{{$contribution->campaign->title}}</td>
                                <td>{{$contribution->Perk->price}}</td>
                                <td>{{$contribution->Perk->title}}</td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>


                            </div><!--end: .tab-pane -->
                        </div>
                        <div>
                            <h3 class="rs alternate-tab accordion-label">Theo dõi</h3>
                            <div class="tab-pane accordion-content" id="follow-pane">
                              @foreach ($followCampaigns as $campaign)
                                <?php $author = $campaign->user()->first()?>
                                <div class="box-marked-project project-short inside-tab">
                                    <div class="top-project-info">
                                        <div class="content-info-short clearfix">
                                            <a href="/campaigns/{{$campaign->id}}" class="thumb-img">
                                              <img src="{{ asset('img/'.$campaign->avatar) }}" alt="{{$campaign->title }}">
                                            </a>
                                            <div class="wrap-short-detail">
                                                <h3 class="rs acticle-title"><a class="be-fc-orange" href="/campaigns/{{$campaign->id}}">{{$campaign->title}}</a></h3>
                                                <p class="rs tiny-desc">tạo bởi <a href="/users/{{$author->id}}" class="fw-b fc-gray be-fc-orange">{{$author->name}}</a> tại <span class="fw-b fc-gray">{{ $author->getCity() }}</span></p>
                                                <p class="rs title-description">{{$campaign->tagline}}</p>
                                            </div>
                                            <p class="rs clearfix comment-view">
                                                <a href="/campaigns/{{ $campaign->id }}/4" class="fc-gray be-fc-orange">{{ $campaign->getCommentsCount() }} bình luận</a>
                                                <span class="sep">|</span>
                                                <a href="/campaigns/{{ $campaign->id }}" class="fc-gray be-fc-orange">378 lượt xem</a>
                                            </p>
                                        </div>
                                    </div><!--end: .top-project-info -->
                                    <div class="bottom-project-info clearfix">
                                        <div class="project-progress sys_circle_progress" data-percent="{{$campaign->getPercents()}}">
                                            <div class="sys_holder_sector"></div>
                                        </div>
                                        <div class="group-fee clearfix">
                                            <div class="fee-item">
                                                <p class="rs lbl">Nhà đầu tư</p>
                                                <span class="val">{{$campaign->getBackerCount()}}</span>
                                            </div>
                                            <div class="sep"></div>
                                            <div class="fee-item">
                                                <p class="rs lbl">Thu được</p>
                                                <span class="val">{{ number_format($campaign->getFundRaised(), 0, ',', '.') }}đ</span>
                                            </div>
                                            <div class="sep"></div>
                                            <div class="fee-item">
                                                <p class="rs lbl">Còn lại</p>
                                                <span class="val">{{$campaign->getDayLeft()}} ngày</span>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div><!--end: .box-marked-project -->
                              @endforeach
                            </div><!--end: .tab-pane -->
                        </div>
                      </div>
                </div><!--end: .project-tab-detail -->
            </div>
        </div><!--end: .content -->
        <div class="sidebar grid_4">
            <div class="box-gray project-author">
                <h3 class="title-box">Trang cá nhân </h3>
                <div class="media">
                    <a href="/users/{{$user->id}}" class="thumb-left">
                        <img src="{{ asset('/uploads/avatars/' . $userDetail['avatar']) }}" alt="$USER_NAME"/>
                    </a>
                    <div class="media-body">
                        <h4 class="rs pb10"><a href="#" class="be-fc-orange fw-b">{{$user->name}}</a></h4>
                        <p class="rs">{{$userDetail['city']}}</p>
                        <p class="rs fc-gray">{{$user->getCampaignCount()}} dự án</p>
                    </div>
                </div>
                @if (Auth::check())
                  <div class="author-action">
                    @if (Auth::id() == $user->id)
                      <a class="btn btn-red" href="/users/{{$user->id}}">Cập nhật thông tin</a>
                    @endif
                      <a class="btn btn-white" href="/logout">Đăng xuất</a>
                  </div>
                @endif
            </div><!--end: .project-author -->
        </div><!--end: .sidebar -->
        <div class="clear"></div>
    </div>
      @include('layouts.error') {{-- ERROR HANDLE PLEASE CHECK layouts/error.blade.php--}}

@endsection
