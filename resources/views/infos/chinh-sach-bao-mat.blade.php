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
              <h3 class="rs title-detail"><a href="post.html">CHÍNH SÁCH BẢO MẬT</a></h3>
          </div>
          <iframe src="https://docs.google.com/document/d/e/2PACX-1vTiFjg7bh3j_UqpBndkeb56s4Hsi-pwx70rqEEPYq4oyrf534CntH-H9GzRZURIlwA-JA4Kj__3KJLz/pub?embedded=true" width="900" height="1200"></iframe>
              <div class="clear"></div>
          </div><!--end: .content -->
        </div>


@endsection
