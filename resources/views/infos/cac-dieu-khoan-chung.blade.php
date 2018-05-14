@extends('layouts.master')
@section('title','How it work')
@section('header')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>

  <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
@endsection

@section('content')

  <div class="layout-2cols">
      <div class="blog-page">
          <div class="grid_12 top-info">
              <h2 class="blog-title rs"><span class="fc-black">iFunding</span> Điều khoản sử dụng</h2>
              <ul class="nav nav-menu-blog clearfix">
                  <li><a href="/cac-dieu-khoan-chung">Các điều khoản chung</a></li>
                  <li class="sep"></li>
                  <li><a href="/chi-phi-goi-von">Chi phí gọi vốn</a></li>
                  <li class="sep"></li>
                  <li><a href="/quy-dinh-hoan-tra">Quy định hoàn trả</a></li>
                  <li class="sep"></li>
                  <li><a href="/chinh-sach-bao-mat">Điều khoản bảo mật</a></li>
              </ul>
          </div>
          <div class="clear"></div>
          <div class="content grid_8 main-info">
              <h3 class="rs title-detail"><a href="post.html">CÁC ĐIỀU KHOẢN CHUNG</a></h3>
          </div>
          <iframe src="https://docs.google.com/document/d/e/2PACX-1vS-Hvv-wBpPEBRbzPgruwN_Ul-RB6qqD9Vsl0bu9z3fIbXZmld3MKJmkMa2QylASzJGlYsWPbQFdS-U/pub?embedded=true" width="900" height="1200"></iframe>
          {{--<div class="content grid_8 main-info">
              <h3 class="rs title-detail"><a href="post.html">A. CÁC QUY ĐỊNH CHUNG</a></h3>
              <div class="box-text-content">
                  <h4 class="rs title-in-box">I. Tạo lập tài khoản</h4>
                  <h4 class="rs title-intro">1. Chủ dự án</h4>
                  <p class="rs">a) Chủ dự án đủ 18 tuổi</p>
                  <p class="rs">Để tạo lập 1 tài khoản trên IFunding, chủ dự án cần phải trên 18 tuổi và hoàn toàn chịu trách nhiệm về các thông tin cung cấp, đăng tải. Không mạo danh người khác.</p>
                  <p class="rs">b) Khi phát hiện ra những sai sót trong quá trình tạo lập hoặc tài khoản bị xâm phạm, vui lòng liên hệ đến email hỗ trợ …. Để được khắc phục sớm. Nếu IFunding phát hiện bất cứ điều khoản nào không được tuân thủ, người dùng sẽ bị xóa tài khoản.</p>
                  <p class="rs">c) Những điều không được thực hiện</p>
                  <p class="rs">- Phạm luật: Bao gồm các hành vi vi phạm pháp lý, bạo lực và xâm phạm đời sống cá nhân của người khác.</p>
                  <p class="rs">- Lừa đảo: Đăng tải thông tin sai sự thật, lừa dối người khác.</p>
                  <p class="rs">- Sử dụng thông tin của người khác để gây hại, đe dọa hoặc gây ảnh hưởng đến cá nhân khác.</p>
                  <p class="rs">- Spam, đăng tải thông tin quảng cáo.</p>
                  <p class="rs">- Nội dung bình luận, đăng tải liên quan đến chính trị, tôn giáo.</p>
                  <p class="rs">- Tin tức, nội dung trái thuần phong mỹ tục Việt Nam</p>
                  <p class="rs">- Sử dụng phần mềm, đường dẫn có chứa virus gây hại đến máy tính người khác.</p>
                  <p class="rs">- Các dự án về thực phẩm, dược phẩm</p>
                  <p class="rs">- Cung cấp các mặt hàng cấm, kinh doanh trái qui định pháp luật</p>
                  <p class="rs">+ Vũ khí, đạn dược, quân trang, quân dụng và phương tiện kỹ thuật quân sự.</p>
                  <p class="rs">+ Các chất ma tuý.</p>
                  <p class="rs">+ Các hiện vật có giá trị thuộc di tích</p>
                  <p class="rs">+ Các vật phẩm, sản phẩm văn hoá phản động, đồi truỵ.</p>
                  <p class="rs">+ Thuốc lá điếu sản xuất tại nước ngoài.</p>
                  <p class="rs">+ Các loại pháo nổ sản xuất trong nước, các loại pháo sản xuất tại nước ngoài.</p>
                  <p class="rs">+ Các loại thuốc chữa bệnh cho người và gia súc, thuốc bảo vệ thực vật và các loại trang thiết bị, dụng cụ y tế chưa được phép sử dụng ở Việt Nam.</p>
                  <p class="rs">+ Thực vật, động vật rừng quý hiếm.	</p>
                  <p class="rs">+ Một số loại đồ chơi cho trẻ em gây nguy hại tới giáo dục nhân cách, tới sức khoẻ của trẻ em, hoặc tới an ninh trật tự, an toàn xã hội.</p>
                  <p class="rs">+ Hành vi có tính kinh doanh hoặc dịch vụ trái với thuần phong mỹ tục Việt Nam.</p>
                  <p class="rs">+ Phế liệu, phế thải kim loại và phế liệu, phế thải có hoá chất độc hại.</p>
                  <p class="rs">+ Hoá chất độc mạnh, chất phóng xạ.</p>
                  <h4 class="rs title-intro">2. Người góp vốn</h4>
                  <p class="rs">a) Người góp vốn tham gia IFunding phải trên 18 tuổi, hoàn toàn chịu trách nhiệm những nội dung mình đăng tải, không mạo danh người khác.</p>
                  <p class="rs">b) Khi thông tin tài khoản bị xâm phạm, vui lòng liên hệ đến email hỗ trợ …. Để được khắc phục sớm.</p>
                  <p class="rs">c) Những điều không được thực hiện:</p>
                  <p class="rs">- Phạm luật: Bao gồm các hành vi vi phạm pháp lý, bạo lực và xâm phạm đời sống cá nhân của người khác.</p>
                  <p class="rs">- Sử dụng thông tin của người khác để gây hại, đe dọa hoặc gây ảnh hưởng đến cá nhân khác.</p>
                  <p class="rs">- Spam, đăng tải thông tin quảng cáo.</p>
                  <p class="rs">- Nội dung bình luận, đăng tải liên quan đến chính trị, tôn giáo,</p>
                  <p class="rs">- Tin tức, nội dung trái thuần phong mỹ tục Việt Nam</p>
                  <p class="rs">- Sử dụng phần mềm, đường dẫn có chứa virus gây hại đến máy tính người khác.</p>
                  <h4 class="rs title-intro">3. Những dự án trong khuôn khổ pháp luật được IFunding chấp nhận</h4>
                  <p class="rs"></p>
                  <p class="rs"></p>
                  <p class="rs"></p>
                  <p class="rs"></p>
              </div> --}}
              <div class="clear"></div>
          </div><!--end: .content -->
        </div>


@endsection
