<!DOCTYPE html>
<html>
<head>
    <title>@yield('title','Welcome to ifunding')</title>
    @yield('header')
    
    {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/md-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
	
    <!--not in the index, just appear in project.blade.php-->
    <link rel=”stylesheet” href="{{ asset('css/responsiveslides.css') }}"/>
    <!--not in the index, just appear in view/payment/process.blade.php-->
    <!--link rel="stylesheet" href="{{ asset('css/app.css') }}"-->

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
    <!--not in the index, just appear in project.blade.php-->
    <script type="text/javascript" src="{{ asset('js/responsiveslides.min.js') }}"></script>
    <!--not in the index, just appear in view/payment/process.blade.php-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script> --}}
  </head>
  <body>
    @include('layouts.nav')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')
  </body>
</html>
