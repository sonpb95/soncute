<div class="popup-common" id="sys_popup_common">
<div class="overlay-bl-bg"></div>
<div class="container_12 pop-content">
    <div class="grid_12 wrap-btn-close ta-r">
        <i class="icon iBigX closePopup"></i>
    </div>
    <div class="grid_6 prefix_1">
        <div class="form login-form">
            <form method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}

                <h3 class="rs title-form">Đăng Ký</h3>
                <div class="box-white">
                    <h4 class="rs title-box">Tạo Tài Khoản Mới</h4>
                    <!-- <p class="rs">A Kickstars account is required to continue.</p> -->

                    <div class="form-action {{-- $errors->has('name') ? ' has-error' : '' --}}">
                        <label for="name">
                            <input id="name" class="txt fill-width" type="text" placeholder="Tên đăng nhập" name="name" value="{{ old('name') }}" required autofocus>
                        </label>
                        @if ($errors->has('name'))
                            {{--<span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>--}}
                            <?php echo('<script type="text/javascript">alert("Tên đăng nhập đã được đăng ký hoặc không hợp lệ, vui lòng thử lại!");</script>');?>
                        @endif

                        <div class="wrap-2col clearfix">
                            <div class="col {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">
                                    <input id="register_email" class="txt fill-width" type="email" placeholder="Địa chỉ e-mail" name="email" value="{{ old('email') }}" required>
                                </label>

                                <label for="txt_re_email">
                                    <input id="txt_re_email" class="txt fill-width" type="email" placeholder="Nhập lại địa chỉ e-mail"/>
                                </label>
                                @if ($errors->has('email'))
                                    {{--<span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>--}}
                                    <?php echo('<script type="text/javascript">alert("Địa chỉ email đã được đăng ký hoặc không hợp lệ, vui lòng thử lại!");</script>');?>
                                @endif
                            </div>
                            <div class="col">
                                <label for="password">
                                    <input id="password" class="txt fill-width" type="password" placeholder="Mật khẩu" name="password" required>
                                </label>
                                @if ($errors->has('password'))
                                    {{--<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>--}}
                                    <?php echo('<script type="text/javascript">alert("Mật khẩu không hợp lệ, vui lòng thử lại!");</script>');?>
                                @endif


                                <label for="password-confirm">
                                    <input id="password-confirm" class="txt fill-width" type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" required/>
                                </label>
                            </div>
                        </div>
                        <p class="rs pb10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bằng cách đăng ký tài khoản, bạn đã đồng ý với <br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/cac-dieu-khoan-chung" class="fc-orange">Điều khoản sử dụng</a> và <a href="/chinh-sach-bao-mat" class="fc-orange">Chính sách bảo mật </a>của chúng tôi.</p>
                        <p class="rs ta-c">
                            <button class="btn btn-red btn-submit" type="submit">Tạo Tài Khoản</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="grid_4">
        <div class="form login-form">
            <form method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

                <h3 class="rs title-form">Đăng Nhập</h3>
                <div class="box-white">
                    <h4 class="rs title-box">Bạn Đã Có Tài Khoản ?</h4>
                    <p class="rs">Hãy đăng nhập để tiếp tục.</p>
                    <div class="form-action {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">
                            <input id="email" class="txt fill-width" type="email" placeholder="Địa chỉ e-mail" name="email" value="{{ old('email') }}" required autofocus>
                        </label>
                        @if ($errors->has('email'))
                            {{--<span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>--}}
                            <?php echo('<script type="text/javascript">alert("Địa chỉ email đăng nhập không đúng, vui lòng thử lại!");</script>');?>
                        @endif

                        <label for="password">
                            <input id="txt_password_login" class="txt fill-width" type="password" placeholder="Nhập mật khẩu" name="password" required>
                        </label>
                        @if ($errors->has('password'))
                            {{--<span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>--}}
                            <?php echo('<script type="text/javascript">alert("Mật khẩu đăng nhập không đúng, vui lòng thử lại!");</script>');?>
                        @endif

                        <label for="chk_remember" class="rs pb20 clearfix">
                            <input id="chk_remember" type="checkbox" class="chk-remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="lbl-remember">Nhớ mật khẩu</span>
                        </label>
                        <p class="rs ta-c pb8">
                            <button class="btn btn-red btn-submit" type="submit">Đăng Nhập</button>
                        </p>
                        <p class="rs ta-c">
                            <a href="{{ route('password.request') }}" class="fc-orange">Quên mật khẩu ?</a>
                        </p>

                        <p class="rs ta-c">
						   <a href="/redirect/facebook" class="btns btns-facebook">
                            <i class="fa fa-facebook"> </i> Đăng nhập bằng Facebook
							</a>
                        </p>

                        <p class="rs ta-c">

						    <a href="/redirect/google" class="btns btns-google">
                            <i class="fa fa-google"> </i> Đăng nhập bằng Google &nbsp;&nbsp;&nbsp;
							</a>
                        </p>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>
