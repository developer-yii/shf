@php    
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
<!-- Account Verified -->
    <div id="acc-verified" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
        <div class="popup-logo">
            <img src="{{ $baseUrl }}img/form-logo.svg" alt="">
        </div>

        <div class="popup-content">
            <div class="popup-left">
                <h3>
                    @if(Session::has('modalLabel'))
                        {{ Session::get('modalLabel') }}
                    @endif
                </h3>
                <div class="g-line"></div>
                @if(Session::has('verify'))
                <p>{{ Session::get('verify') }} Thank You!</p>
                @endif   
            </div>
            <div class="popup-right verified-right">
                <div class="verified-icon">
                    <img src="{{ $baseUrl }}img/verified-icon.svg" alt="">
                </div>
                <a href="{{ route('frontend.home') }}"><button class="button blue">Back to Home</button></a>
                <div class="popup-buttons">
                    <a href="#sign-in" class="linkGoto center popup-link"><img src="{{ $baseUrl }}img/back-arrow.svg" alt=""> Go back to Sign In</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script type="text/javascript">

    $.magnificPopup.open({
        items: {
            src: '#acc-verified',
            type: 'inline'
        },       
    })
    
</script>
@endsection