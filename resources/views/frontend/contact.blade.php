@php
$baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
<!-- Main Container Starts -->
<div class="main-container">

  <!-- about-banner -->
  <div class="about-section">
    <div class="container center">
      <h1 class="head-1 white">More Informations Needed?</h1>
    </div>
    <div class="about-bg">
      <img src="{{ $baseUrl }}img/contact-bg.jpg" alt="">
    </div>
  </div>
  <!-- about-banner -->


  <!-- contact starts -->
  <div class="contact-section">
    <div class="container">
      <div class="contact-wrap">
        <h3 class="head-2 center">Contact us</h3>
        <p class="txt-1 center">
          Connect with the experts at SHF Laboratories today. Submit your information using our online contact form. The future of health is clear. <br /> Join us on the journey. Reach out now to start your personalized path to peak performance with SHF Laboratories as your dedicated guide. The first step begins when you engage with our team.
        </p>
        <div class="contact-form">
          <form id="contactform">
            @csrf
            <div class="form-grp">
              <input class="form-field" type="email" id="email" name="email" placeholder="your@email.com" />
              <div class="error"></div>
            </div>
            <div class="form-grp">
              <input class="form-field" type="text" id="first_name" name="first_name"placeholder="First name" />
              <div class="error"></div>
            </div>
            <div class="form-grp">
              <input class="form-field" type="text" id="last_name" name="last_name" placeholder="Last name" />
              <div class="error"></div>
            </div>
            <div class="form-grp">
              <select id="country" name="country" class="form-field">
                <option value="" class="d-none">Select Country</option>
                @foreach(getcountries() as $country)
                    <option value="{{$country->id}}" {{ old('country') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                @endforeach
              </select>
              <div class="error"></div>
            </div>
            <div class="form-grp">
              <textarea class="form-field" id="message" name="message" placeholder="Your message"></textarea>
              <div class="error"></div>
            </div>
            <div class="form-grp">
              <div id="review_recaptcha" class="g-recaptcha-response" style="margin-left:8rem; margin-top:2rem;"></div>
              <span class="error"></span>
            </div>
            <button class="button blue" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- contact ends -->


</div>
<!-- Main Container Ends -->
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

<script type="text/javascript">

  var contactUrl ="{{ route('contact.submit')}}";
  $(document).ready(function()
  {

    $('#contactform').submit(function(event)
    {
      event.preventDefault();
      var $this = $(this);

      $.ajax({
        url: contactUrl,
        type: 'POST',
        data: $('#contactform').serialize(),
        dataType: 'json',
        beforeSend: function()
        {
          $($this).find('button[type="submit"]').prop('disabled', true);
        },
        success: function(response)
        {
          $($this).find('button[type="submit"]').prop('disabled', false);
          if (response.status == true)
          {
            $this[0].reset();
            toastr.success(response.message);
            $('.error').html("");
          }
          else
          {
            first_input = "";
            $('.error').html("");
            $.each(response.errors, function(key)
            {
              if(first_input=="") first_input=key;
              if(key=="g-recaptcha-response"){
                $('.'+key).closest('.form-grp').find('.error').html(response.errors[key]);

              }else{
                $('#'+key).closest('.form-grp').find('.error').html(response.errors[key]);
              }
            });
          }

        },
        error: function(error)
        {
          $($this).find('button[type="submit"]').prop('disabled', false);
          alert('Something went wrong!', 'error');
        }
      });
    });

    $.ajaxSetup({
      headers:
      {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
</script>
@endsection