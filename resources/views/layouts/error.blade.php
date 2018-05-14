@if (count($errors))
  {{--<div class="form-group">
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  </div>--}}

  @if ($errors->has('name'))
      <?php echo('<script type="text/javascript">alert("Tên đăng nhập không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('biography'))
      <?php echo('<script type="text/javascript">alert("Tiểu sử bạn nhập không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('avatar'))
      <?php echo('<script type="text/javascript">alert("Ảnh đại diện tải lên không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('full_name'))
      <?php echo('<script type="text/javascript">alert("Họ và tên không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('phone_number'))
      <?php echo('<script type="text/javascript">alert("Số điện thoại vừa nhập không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('country'))
      <?php echo('<script type="text/javascript">alert("Vui lòng lựa chọn một quốc gia hoặc vùng lãnh thổ");</script>');?>
  @endif
  @if ($errors->has('city'))
      <?php echo('<script type="text/javascript">alert("Tên thành phố không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('postal_code'))
      <?php echo('<script type="text/javascript">alert("Mã bưu chính không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('address'))
      <?php echo('<script type="text/javascript">alert("Địa chỉ không hợp lệ, vui lòng thử lại");</script>');?>
  @endif
  @if ($errors->has('password'))
      <?php echo('<script type="text/javascript">alert("Mật khẩu không hợp lệ, vui lòng thử lại");</script>');?>
  @endif

@endif
