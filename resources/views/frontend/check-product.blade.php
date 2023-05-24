@php
    $baseUrl = asset('frontend')."/";
@endphp

@extends('layouts.app-main')
@section('title', 'Check Product')
@section('css')
<link rel="stylesheet" href="{{ $baseUrl }}css/custom.css" /> 
@endsection
@section('content')


    <div class="check-bg-wrap">
        <div class="check-bg">
            <img src="{{ $baseUrl }}img/check-bg.png" alt="">
        </div>
            <button type="submit" form="verify-product" class="button blue">Verify</button>
    </div>
    <div class="x-elem x-elem-check">
        <img src="{{ $baseUrl }}img/x-elem.png" alt="">
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

@endsection
@section('js')
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
<script src="{{ $baseUrl}}js/check-product.js"></script>

@endsection
