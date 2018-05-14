<style>
.dropbtn {
    color: white;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
	  font-family: "Benton Sans","Helvetica","sans-serif";
    font-size: 14px;
    line-height: 20px;
	  z-index: 10;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;

}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.img-circle {
    height: 34px;
    width: 34px;
    border-radius: 50%;
    margin-right: 10px;
}
</style>
<div id="wrapper">
    <header id="header">
         <div class="wrap-top-menu">
            <div class="container_12 clearfix">
                <div class="grid_12">
                    <!--nav class="top-menu">
                        <ul id="main-menu" class="nav nav-horizontal clearfix">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li class="sep"></li>
                            <li><a href="all-pages.html">All Pages</a></li>
                            <li class="sep"></li>
                            <li><a href="how-it-work.html">Help</a></li>
                            <li class="sep"></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                        <a id="btn-toogle-menu" class="btn-toogle-menu" href="#alternate-menu">
                            <span class="line-bar"></span>
                            <span class="line-bar"></span>
                            <span class="line-bar"></span>
                        </a>
                        <div id="right-menu">
                            <ul class="alternate-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="all-pages.html">All Pages</a></li>
                                <li><a href="how-it-work.html">Help</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </nav-->
                    <!--div class="top-message clearfix">
                        <i class="icon iFolder"></i>
                        <span class="txt-message">Nulla egestas nulla ac diam ultricies id viverra nisi adipiscing.</span>
                        <i class="icon iX"></i>
                        <div class="clear"></div>
                    </div-->
                    <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i>
                </div>
            </div>
        </div><!-- end: .wrap-top-menu -->
        <div class="container_12 clearfix">
            <div class="grid_12 header-content">
                <div id="sys_header_right" class="header-right">
                    <div class="account-panel">
                      @if (Auth::check())
                      <?php $userDetail = Auth::user()->userDetail()->first() ?>
        							  <div class="dropdown">
                          <a href="/users/{{Auth::id()}}">
          							      <img alt="image" class="dropbtn img-circle" src="{{ asset('/uploads/avatars/' . $userDetail['avatar']) }}" /><span>{{Auth::user()->name}} <i class="fa fa-angle-down"></i></span>
                          </a>
          							  <div class="dropdown-content">
                            @if ($userDetail->is_admin == 1)
                              <a href="/campaignmanager">Quản lý dự án</a>
                            @endif
            								<a href="/users/{{Auth::id()}}/5">Dự án của tôi</a>
            								<a href="/users/{{Auth::id()}}/6">Danh sách đầu tư</a>
            								<a href="/users/{{Auth::id()}}">Trang cá nhân</a>
            								<a href="/logout">Đăng xuất</a>
          							  </div>
        							  </div>
                      @else
                        <a href="#" class="btn btn-red sys_show_popup_login">Đăng Ký</a>
                        <a href="#" class="btn btn-black sys_show_popup_login">Đăng Nhập</a>
                      @endif
                    </div>
                    <div class="form-search">
                        <form action="/search" method="get">
                            <label for="sys_txt_keyword">
                              {{ csrf_field() }}
                                <input id="sys_txt_keyword" class="txt-keyword" type="text" name="query" placeholder="Tìm kiếm"/>
                            </label>
                            <button class="btn-search" type="submit"><i class="icon iMagnifier"></i></button>
                            <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>
                        </form>
                    </div>
                </div>
                <div class="header-left">
                    <h1 id="logo">
                        <a href="{{ url('') }}"><img src="{{ asset('images/logo.png') }}" alt="ifunding"/></a>
                    </h1>
                    <div class="main-nav clearfix">
                        <div class="nav-item">
                            <a href="/discover" class="nav-title">Khám Phá</a>
                            <p class="rs nav-description">iFunding</p>
                        </div>
                        <span class="sep"></span>
                        <div class="nav-item">
                            <a href="{{ url('create') }}" class="nav-title">Bắt Đầu</a>
                            <p class="rs nav-description">Dự Án Của Bạn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!--end: #header -->
