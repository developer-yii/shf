@php
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
<div id="pass-reset" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
        <div class="popup-logo">
            <img src="{{ $baseUrl }}img/logo.svg" alt="">
        </div>

        <div class="popup-content">
            <div class="popup-left">
                <h3>Set new password
                </h3>
                <div class="g-line"></div>
                <p>Your new password must be different to previously used password</p>
            </div>
            <div class="popup-right verified-right">
                <form action="" method="POST" autocomplete="off" id="reset-password">
                    @csrf
                    <div id="error-message"></div>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-grp">
                        <input class="form-field" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" readonly>
                    </div>

                    <div class="form-grp">
                        <input class="form-field" type="password" id="password" name="password" placeholder="Password">
                        <div class="error"></div>
                    </div>
                    <div class="form-grp">
                        <input class="form-field" type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password">
                        <div class="error"></div>
                    </div>
                    <button class="button blue">Reset your password</button>
                </form>
                <a href="#sign-in" class="popup-link linkGoto center"><img src="{{$baseUrl}}img/back-arrow.svg" alt=""> Go back to Sign In</a>

            </div>
        </div>
   </div>

    <!-- Pass Reset Successfull -->
    <div id="pass-reset-success" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
        <div class="popup-logo">
            <img src="{{$baseUrl}}img/logo.svg" alt="">
        </div>

        <div class="popup-content">
            <div class="popup-left">
                <h3>Password reset
                </h3>
                <div class="g-line"></div>
                <p>Your password has been succesfully reset. Click below to login magically.</p>
            </div>
            <div class="popup-right verified-right">
                <div class="verified-icon">
                    <img src="{{$baseUrl}}img/verified-icon.svg" alt="">
                </div>
                <a href="{{ route('frontend.home') }}" class="button blue">Continue</a>
                <a href="#sign-in" class="popup-link linkGoto center"><img src="{{$baseUrl}}img/back-arrow.svg" alt=""> Go back to Sign In</a>

            </div>
        </div>
    </div>

@endsection
@section('js')
<script type="text/javascript">

    $.magnificPopup.open({
        items: {
            src: '#pass-reset',
            type: 'inline'
        },
    })

    var resetPasswordUrl = "{{ route('password.update') }}";
    $('#reset-password').on('submit', function(event)
    {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: resetPasswordUrl,
            data: $(this).serialize(),
            success: function(result)
            {
                $('.error').html("");
                $('.error-message').html("");
                if(result.status == true)
                {
                    $.magnificPopup.close({
                        items: {
                            src: '#pass-reset',
                        },

                    });

                    $.magnificPopup.open({
                        items: {
                            src: '#pass-reset-success',
                            type: 'inline'
                        },

                    });
                }
            },
            error: function(response)
            {
                first_input = "";
                $('.error').html("");
                $('.error-message').html("");

                $.each(response.responseJSON.errors, function(key)
                {
                    if(first_input=="") first_input=key;
                    if(!key.includes("[]"))
                        $('#'+key).closest('.form-grp').find('.error').html(response.responseJSON.errors[key]);
                });

                if(response.responseJSON.messages)
                {
                    $('#error-message').html(response.responseJSON.messages);
                }
            }
        });
    });

</script>
@endsection