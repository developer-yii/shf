@php    
    $baseUrl = asset('frontend')."/";
    $baseUrlold = asset('frontend/old')."/";
    $baseUrlbackend = asset('backend')."/";
@endphp
@extends('layouts.app-frontend')


@section('title', 'Check Product')
@section('css')
<link href="{{$baseUrlbackend}}assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
@endsection
@section('content')
<!-- Main Container Starts -->
  <div class="main-container">
    <!-- Authenticity -->
      <div class="main-wrap">
        <div class="check-bg-wrap">
            <div class="check-bg">
                <img src="{{ $baseUrlold }}img/check-bg.png" alt="">
            </div>
                <button type="submit" form="verify-product" class="button blue">Verify</button>
        </div>
        <div class="x-elem x-elem-check">
            <img src="{{ $baseUrlold }}img/x-elem.png" alt="">
        </div>

        <div class="check-txt">
            <h2>Simple To Check
                Your Product</h2>
            <p>One click-verification. Instant product verification.
                Easy compliance. Check if your product is legit.
            </p>
            <div class="check-btns">
                <form id="verify-product" method="POST">
                    @csrf
                <!-- <a href="" class="button white">Type your productcode</a> -->
                <input type="text" name="product_code" class="product-code"
                    placeholder="Type your product code">
                
                    <div id="review_recaptcha" style="margin-left:8rem; margin-top:2rem;"></div>
                </form>
            </div>
        </div>
      </div>
    <!-- Authenticity -->
  </div>

@endsection

@section('modal')

<!-- Standard modal -->

<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:115%;background: none;
        box-shadow: none;">
            <div class="modal-header" style="border: 0;">
                <div class="elements-wrap">
                    <div class="message-box green">
                        
                    </div>
            
                </div>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('js')
<script src="{{$baseUrl}}js/vendor.min.js"></script>
<script type="text/javascript">
    var review_recaptcha_widget;
    var onloadCallback = function() {
      if($('#review_recaptcha').length) {
          review_recaptcha_widget = grecaptcha.render('review_recaptcha', {
            'sitekey' : "{{ env('RECAPTCHAV3_SITEKEY') }}"
          });
      }
    };      
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
    var checkproduct = "{{ route('check.code') }}";
</script>
<script src="{{ $baseUrl}}js/check-product.js"></script>

@endsection