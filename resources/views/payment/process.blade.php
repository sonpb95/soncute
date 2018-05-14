@extends('layouts.master')
@section('title', 'Thanh toán')
@section('header')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ asset('css/jquery.sidr.light.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/ifunding.css') }}"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.sidr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.tweet.min.js') }}"></script>
{{--
<link href="{{ asset('css/payment.css') }}" rel="stylesheet">
--}}
@endsection
@section('content')
<script>
   $(document).ready(function(){
       var button = document.querySelector('#submit-button');

       braintree.dropin.create({
         authorization: "{{ Braintree_ClientToken::generate() }}",
         container: '#dropin-container',
         /*paypal: {
           flow: 'vault'
         }*/
       }, function (createErr, instance) {
         if (createErr) {
           // An error in the create call is likely due to
           // incorrect configuration values or network issues.
           // An appropriate error will be shown in the UI.
           console.error(createErr);
           return;
         }

         button.addEventListener('click', function () {
           instance.requestPaymentMethod(function (err, payload) {
             $.get("/payment/process/{{$perk->id}}", {payload}, function (response) {
               if (response.success) {
                 alert('Thanh toán thành công. Quay lại trang dự án!');
                 window.location.href = '/payment/sucess/' + {!! $perk->id !!};
               } else {
                 alert('Thanh toán thất bại, Vui lòng thử lại!');
               }
             }, 'json');
           });
         });
       });
   });
</script>
<div class="layout-2cols">
   <div class="content grid_8">
      <div class="project-detail">
         <div class="project-tab-detail tabbable accordion">
            <div class="tab-content">
               <div class="tab-pane accordion-content active">
                  <div class="form form-profile">
                     <form id="payment-form" enctype="multipart/form-data" action="/update-user-detail" method="post" >
                        {{ csrf_field() }}
                        @if (Auth::check())

                        <div class="row-item clearfix">
                           <label for="txt_full_name" class="lbl" >Họ và tên:</label>
                           <div class="val">
                              <input type="text" class="txt" name="full_name" id="full_name" value="{{$userDetail->full_name}}" required>
                           </div>
                        </div>
                        <div class="row-item clearfix">
                           <label for="txt_full_name" class="lbl" >Điện thoại:</label>
                           <div class="val">
                              <input type="text" class="txt" name="phone_number" id="phone_number" value="{{$userDetail->phone_number}}" required>
                           </div>
                        </div>
                        <div class="row-item clearfix">
                           <label for="txt_full_name" class="lbl" >Quốc gia:</label>
                           <div class="val">
                              {{--}<input type="text" class="txt" name="country" id="country" value="{{$userDetail->country}}" required> --}}
                              <select name="country" required>
                                 @if ($userDetail->country == '')
                                   <option value="" disabled="disabled" selected="selected">Lựa chọn quốc gia hoặc vùng lãnh thổ</option>
                                 @else
                                   <option value="{{$userDetail->country}}" selected="selected">{{$userDetail->country}}</option>
                                 @endif
                                 @foreach ($countries as $country)
                                   <option value="{{$country}}">{{$country}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="row-item clearfix">
                           <label for="txt_full_name" class="lbl" >Tỉnh thành:</label>
                           <div class="val">
                              <input type="text" class="txt" name="city" id="city" value="{{$userDetail->city}}" required>
                           </div>
                        </div>
                        <div class="row-item clearfix">
                           <label for="txt_full_name" class="lbl" >Mã bưu chính:</label>
                           <div class="val">
                              <input type="text" class="txt" name="postal_code" id="postal_code" value="{{$userDetail->postal_code}}" required>
                           </div>
                        </div>
                        <div class="row-item clearfix">
                           <label class="lbl" for="txt_address">Địa chỉ:</label>
                           <div class="val">
                              <textarea class="txt fill-width" name="address" id="address" cols="20" rows="10" value="" required>{{$userDetail->address}}</textarea>
                           </div>
                        </div>


                        {{-- GUEST INPUT --}}
                        @else
                          <div class="row-item clearfix">
                             <label for="txt_full_name" class="lbl" >Họ và tên:</label>
                             <div class="val">
                                <input type="text" class="txt" name="full_name" id="full_name" value="{{Session::get('full_name')}}" required>
                             </div>
                          </div>
                          <div class="row-item clearfix">
                             <label for="txt_full_name" class="lbl" >Điện thoại:</label>
                             <div class="val">
                                <input type="text" class="txt" name="phone_number" id="phone_number" value="{{Session::get('phone_number')}}" required>
                             </div>
                          </div>
                          <div class="row-item clearfix">
                             <label for="txt_full_name" class="lbl" >Quốc gia:</label>
                             <div class="val">
                                {{--}<input type="text" class="txt" name="country" id="country" value="{{$userDetail->country}}" required> --}}
                                <select name="country" required>
                                   @if (Session::get('country') == '')
                                     <option value="" disabled="disabled" selected="selected">Lựa chọn quốc gia hoặc vùng lãnh thổ</option>
                                   @else
                                     <option value="{{Session::get('country')}}" selected="selected">{{Session::get('country')}}</option>
                                   @endif
                                   @foreach ($countries as $country)
                                     <option value="{{$country}}">{{$country}}</option>
                                   @endforeach
                                </select>
                             </div>
                          </div>
                          <div class="row-item clearfix">
                             <label for="txt_full_name" class="lbl" >Tỉnh thành:</label>
                             <div class="val">
                                <input type="text" class="txt" name="city" id="city" value="{{Session::get('city')}}" required>
                             </div>
                          </div>
                          <div class="row-item clearfix">
                             <label for="txt_full_name" class="lbl" >Mã bưu chính:</label>
                             <div class="val">
                                <input type="text" class="txt" name="postal_code" id="postal_code" value="{{Session::get('postal_code')}}" required>
                             </div>
                          </div>
                          <div class="row-item clearfix">
                             <label class="lbl" for="txt_address">Địa chỉ:</label>
                             <div class="val">
                                <textarea class="txt fill-width" name="address" id="address" cols="20" rows="10" value="" required>{{Session::get('address')}}</textarea>
                             </div>
                          </div>
                        @endif
                        <input type="hidden" name="perkId" id="perkId" value="{{$perk->id}}">
                        @include('layouts.error')
                        <p class="wrap-btn-submit rs ta-r">
                           <button id="finish_payment" class="btn btn-red btn-submit-all" type="submit">Lưu thông tin</button>
                        </p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="sidebar grid_4">
      <div>
        <h4 class="rs pb10" class="be-fc-orange fw-b">Thanh toán cho gói đầu tư: {{$perk->title}}</h4>
        <p class="rs">Trị giá: {{ number_format($perk->price, 0, ',', '.') }} VND.</p>
         <div id="dropin-container"></div>
         @if (Auth::check() || !is_null(Session::get('guest_id')))
           <button id="submit-button" class="btn btn-red btn-submit-all">Thanh toán</button>
           <p class="rs description-input">Lưu ý: Việc thanh toán được thực hiện thông qua paypal. Giá trị giao dịch sẽ được chuyển sang USD với tỷ giá hối đoái được công bố bởi ngân hàng Vietcombank tại thời điểm tạo dự án.</p>
           <p class="rs description-input">Tỷ giá hối đoái được áp dụng cho dự án này là: 1 USD tương ứng với {{number_format($exchangeRate, 0, ',', '.')}} VND.</p>
         @endif
      </div>
   </div>
   <div class="clear"></div>
</div>
@endsection
