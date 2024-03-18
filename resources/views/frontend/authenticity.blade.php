@php
    $baseUrl = asset('frontend') . '/';
@endphp
@extends('layouts.app-frontend')
@section('title', 'Check Product')

@section('content')
    <!-- Main Container Starts -->
    <div class="main-container">
        <!-- Authenticity -->
        <div class="main-wrap">
            <div class="check-bg-wrap">
                <div class="check-bg">
                    <img src="{{ $baseUrl }}img/check-bg.png" alt="">
                </div>
                <button type="submit" form="verify-product" class="button blue">Verify</button>
            </div>

            <div class="check-txt">
                <h1 class="head-1 black">Simple To Check Your Product</h1>
                <div class="authenticity-txt">
                    <p>One click-verification. Instant product verification.
                        Easy compliance. Check if your product is legit.
                    </p>
                    <ul class="authenticity-list">
                        <li><img src="{{ $baseUrl }}img/auth-1.svg" alt=""> You can find your authenticity code
                            under a scratch
                            layer on the hologram on the leaflet card.</li>
                        <li><img src="{{ $baseUrl }}img/auth-2.svg" alt=""> Scratch off the layer.
                            input your code.
                            click to verify. </li>
                    </ul>
                    <div class="check-btns">
                        <form id="verify-product" method="POST">
                            @csrf
                            <input type="text" name="product_code" class="product-code button white" placeholder="Type your productcode">
                            <div id="review_recaptcha" style="margin-left:8rem; margin-top:2rem;"></div>
                        </form>
                        {{-- <a href="" class="button white">Type your productcode</a>
                        <a href="" class="button white">Captcha code</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Authenticity -->
    </div>

@endsection

@section('modal')

    <!-- Standard modal -->

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
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
    <script src="{{ $baseUrl }}js/vendor.min.js"></script>
    <script type="text/javascript">
        var review_recaptcha_widget;
        var onloadCallback = function() {
            if ($('#review_recaptcha').length) {
                review_recaptcha_widget = grecaptcha.render('review_recaptcha', {
                    'sitekey': "{{ env('RECAPTCHAV3_SITEKEY') }}"
                });
            }
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        var checkproduct = "{{ route('check.code') }}";
    </script>
    <script src="{{ $baseUrl }}js/check-product.js"></script>

@endsection
