
@php
$baseUrl = asset('frontend')."/";
$baseUrlbackend = asset('backend')."/";    
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="description" content="" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="theme-color" content="#fff" />
  <title>Xandoz</title>
  <link rel="shortcut icon" href="{{ $baseUrl }}favicon.ico" type="image/x-icon" />
  <link rel="icon" href="{{ $baseUrl }}favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <link rel="stylesheet" href="{{ $baseUrl }}css/main.css" />
  <link rel="stylesheet" href="{{ $baseUrl }}css/custom.css" />
  <link rel="stylesheet" href="{{$baseUrlbackend}}assets/css/toastr.css?time()">
  

  @yield('css')
</head>

<body class="home-page">
    <!-- Header Starts -->
    <header id="header">
        <div class="overlay"></div>

        <div class="header-box">
            <div class="container">
                <div class="head-left">
                    <div class="logoBox">
                        <a class="logo" href="{{ route('frontend.home') }}">
                            <img src="{{ $baseUrl }}img/logo.svg" alt="Logo" />
                        </a>
                    </div>
                    <ul class="header-list">
                        <li class="drop">
                          <a href="{{ route('products.list') }}">Products</a>
                          <ul>
                            @foreach(getCategories() as $category)
                            <li><a href="{{ route('products.category', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.authenticity')}}">Authenticity</a></li>
                    <li><a href="{{ route('frontend.about')}}">About Xandoz</a></li>
                </ul>
            </div>
            <div class="search-field">
                <input type="search" placeholder="Search Xandoz" class="search-input" name="search" id="search">
                <button class="clear-btn">clear</button>
                <ul id="search-results-list">                    
                </ul> 
            </div>
            <div class="head-right">
              <div class="menuBtn">
                <a href="{{ route('contact') }}" class="button white">Contact</a>
                @if(!Auth::user())                
                <a href="#sign-in" class="button blue popup-link">Sign In</a>
                @else
                <a href="{{ route('logout') }}" class="button blue">Sign Out</a>
                @endif        
                <div class="menu side-menu">
                    <a href="javascript:void(0)" class="js-nav-toggle">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Side Menu -->
<!-- Side Menu -->
<div class="menuOverlay"></div>
<div class="nav-wrapper">
  <nav role="mob-navigation" class="mob-navigation">
    <div class="nav-toggle">
      <span class="nav-back"></span>
      <span class="nav-title">
        <!-- <img src="./img/logo.svg" alt=""> -->
    </span>
    <span class="nav-close"></span>
</div>
<ul>
  <li class="has-dropdown">
    <a href="{{ route('products.list') }}">Products</a>
    <ul>
        @foreach(getCategories() as $category)
        <li><a href="{{ route('products.category', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</li>
<li><a href="{{ route('frontend.authenticity')}}">Authenticity</a></li>
<li><a href="{{ route('frontend.about')}}">About Xandoz</a></li>
<div class="mob-btns">
    <a href="{{ route('contact') }}" class="button white">Contact</a>        
    @if(!Auth::user())                
    <a href="#sign-in" class="button blue popup-link">Sign In</a>
    @else
    <a href="{{ route('logout') }}" class="button blue">Sign Out</a>
    @endif
</div>
</ul>

</nav>
</div>

</header>
<!-- Header Ends -->
@yield('content')

@yield('modal')    

<footer id="footer">
   <!-- Subscribe Starts -->
   <div class="subscribe-wrap">
    <div class="container">
        <div class="subscribe">
            <h3 class="head-2 center">Subscribe To Stay Tuned</h3>
            <p class="txt-1 center">Get the latest researches, news and updates from Xandoz laboratories
            </p>
            <form id="subscribe-form" class="subscribe-form">
                @csrf
                <div class="form-grp form-grp-footer-custom">
                    <input type="email" name="email" id="email" placeholder="your@email.com" class="footer-field"><br>
                    <span class="error"></span>
                </div>
                <button class="button white" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="project-x-big">
        <img src="{{$baseUrl}}img/projectx-big.svg" alt="">
    </div>
</div>
<!-- Subscribe Ends -->

<!-- Footer Content Starts -->
<div class="footer-wrap">
    <div class="container">
        <div class="footer-top">
            <div class="footer-logo">
                <img src="{{$baseUrl}}img/logo.svg" alt="">
            </div>
            <div class="footer-line"></div>
            <p><img src="{{$baseUrl}}img/copyright.svg" alt=""> Xandoz Laboratories GmbH
            </p>
        </div>
        <div class="footer-bottom">
            <a href="mailto:info@xandoz-labs.net"><img src="{{$baseUrl}}img/at.svg" alt=""> info@xandoz-labs.net</a>
            <p><img src="{{$baseUrl}}img/location.svg" alt=""> Andreasstraße 5, 65203 Wiesbaden, Germany
            </p>
        </div>
    </div>

</div>
<!-- Footer Content Ends -->
<!-- SignUp -->
<div id="sign-up" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
    <div class="popup-logo">
        <img src="{{$baseUrl}}img/form-logo.svg" alt="">
    </div>

    <div class="popup-content">
        <div class="popup-left">
            <h3>Welcome to Xandoz
            </h3>
            <div class="g-line"></div>
            <p>Sign up to continue to your account.</p>
        </div>
        <div class="popup-right">
            <form action="" method="POST" id="register-form" autocomplete="off">
                @csrf
                <div class="form-grp">
                    <input class="form-field" type="text" id="first_name" name="first_name" placeholder="First Name" />
                    <div class="error"></div>
                </div>

                <div class="form-grp">
                    <input class="form-field" type="text" id="last_name" name="last_name" placeholder="Last Name" />
                    <div class="error"></div>
                </div>

                <div class="form-grp">
                    <input class="form-field" type="email" id="email" name="email" placeholder="your@email.com" />
                    <div class="error"></div>
                </div>
                <div class="form-grp">
                    <input class="form-field" type="phone_number" id="phone_number" name="phone_number" placeholder="Phone number" />
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
                    <input class="form-field" type="password" id="password" name="password" placeholder="Password" />
                    <div class="error"></div>
                </div>
                <div class="form-grp">
                    <input class="form-field" type="password" id="password-confirm" name="password_confirmation"placeholder="Confirm Password" />
                </div>
                <button class="button blue" type="submit">Sign Up</button>
            </form>                    
            <a href="#forgot-pass" class="popup-link linkGoto">Forgot password?</a>                   

            <p class="bottom-line">Already a member?
                <a href="#sign-in" class="popup-link linkGoto">Sign In.</a>
            </p>
        </div>
    </div>
</div>

<!-- Email Verification -->
<div id="email-verification" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
    <div class="popup-logo">
        <img src="{{$baseUrl}}img/form-logo.svg" alt="">
    </div>

    <div class="popup-content">
        <div class="popup-left">
            <h3>Check your email
            </h3>
            <div class="g-line"></div>
            <p>Open your mailbox and check your emails.</p>
        </div>
        <div class="popup-right check-email-right">
            <p class="bottom-line">We sent a confirmation link to <br /><span id="email-address-placeholder"></span>
            </p>
            <button class="button blue">Open email app</button>
            <p class="bottom-line">Don’t receive the email?
                <a href="javascript:void(0);" class="linkGoto resendlink" data-email="">Click to resend</a>
            </p>

            <a href="#sign-in" class="popup-link linkGoto center"><img src="{{$baseUrl}}img/back-arrow.svg" alt=""> Go back to Sign In</a>                        
            <p class="bottom-line">Not a member yet?                            
                <a href="#sign-up" class="popup-link linkGoto">Sign up</a>                    
            </p>
        </div>
    </div>
</div>
<!-- SignIn -->
<div id="sign-in" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
    <div class="popup-logo">
        <img src="{{$baseUrl}}img/form-logo.svg" alt="">
    </div>

    <div class="popup-content">
        <div class="popup-left">
            <h3>Welcome to Xandoz
            </h3>
            <div class="g-line"></div>
            <p>Sign in to continue to your account.</p>
        </div>
        <div class="popup-right">
            <form action="" method="POST" autocomplete="off" id="login-form">
                @csrf
                <input type="hidden" name="hidden_route" id="hidden_route">
                <div id="error-message"></div>
                <div class="form-grp">
                    <input class="form-field" type="email" id="email" name="email" placeholder="your@email.com" />
                    <div class="error"></div>
                </div>
                <div class="form-grp">
                    <input class="form-field" type="password" id="password" name="password" placeholder="Password" />
                    <div class="error"></div>
                </div>
                <button class="button blue" type="submit">Sign In</button>
            </form>

            <!-- <a href="" class="linkGoto">Forgot password?</a> -->
            <a href="#forgot-pass" class="popup-link linkGoto">Forgot password?</a>
            <p class="bottom-line">Not a member yet?
                <a href="#sign-up" class="popup-link linkGoto">Sign up</a>
            </p>
        </div>
    </div>
</div>
<!-- SignIn end-->
<!-- Forgot Password -->
<div id="forgot-pass" class="white-popup mfp-with-anim mfp-hide onboard-journey-popup">.
    <div class="popup-logo">
        <img src="{{$baseUrl}}img/form-logo.svg" alt="">
    </div>

    <div class="popup-content">
        <div class="popup-left">
            <h3>Forgot password?
            </h3>
            <div class="g-line"></div>
            <p>No worries, we’ll send you reset instructions.</p>
        </div>
        <div class="popup-right">
            <form action="" method="POST" autocomplete="off" id="forgot-password-form">
                @csrf  
                <div id="success-message"></div>                  
                <div class="form-grp">
                    <input class="form-field" type="email" id="email" name="email" placeholder="your@email.com" />
                    <div class="error"></div>
                </div>
                <button class="button blue" type="submit">Reset your password</button>
            </form>

            <a href="#sign-in" class="popup-link linkGoto center"><img src="{{$baseUrl}}img/back-arrow.svg" alt=""> Go back to Sign In</a>

            <p class="bottom-line">Not a member yet?
                <a href="#sign-up" class="popup-link linkGoto">Sign up</a>
            </p>
        </div>
    </div>
</div>
<!-- Forgot Password end-->
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js"></script>
<script src="{{$baseUrl}}js/megamenu.js"></script>
<script src="{{$baseUrl}}js/home.js"></script>
<script src="{{$baseUrl}}js/common.js"></script>
<script src="{{$baseUrlbackend}}assets/js/toastr.js?{{time()}}"></script>


<script type="text/javascript">

    var loginUrl= "{{ route('user-login') }}";
    var resetUrl= "{{ route('password.email') }}";
    var registerUrl= "{{ route('register') }}";
    var resendVerificationEmailUrl = "{{ route('resendverificationmail') }}";
    var subscribeUrl = "{{ route('subscribe') }}";
    
    $(document).ready(function() 
    {
        $('.error').html("");
        $('#login-form').on('submit', function(event) 
        {
            event.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: loginUrl,
                data: $(this).serialize(),
                beforeSend: function() 
                {
                    $($this).find('button[type="submit"]').prop('disabled', true);
                },
                success: function(result) 
                {
                    $('.error').html("");
                    $('#error-message').html("");
                    $($this).find('button[type="submit"]').prop('disabled',false);
                    if (result.status == true) 
                    {                        
                       window.location.href = result.route;
                   }
                   else 
                   {                        
                    first_input = "";
                        // $('.error').html("");
                    if(result.message)
                    {
                        $('#error-message').html(result.message);
                    }
                    else
                    {
                        $.each(result.errors, function(key) 
                        {
                            if(first_input=="") first_input=key;
                            if(!key.includes("[]"))
                                $('#'+key).closest('.form-grp').find('.error').html(result.errors[key]);
                        });
                    }

                }                    
            },
            error: function(response) 
            {   
                $($this).find('button[type="submit"]').prop('disabled', false);                 
                alert("something went wrong");
            }
        });
        });


        $('#register-form').on('submit', function(event) 
        {
            event.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: registerUrl,
                data: $(this).serialize(),
                beforeSend: function() 
                {
                    $($this).find('button[type="submit"]').prop('disabled', true);
                },
                success: function(result) 
                {
                    $('.error').html("");                    
                    $($this).find('button[type="submit"]').prop('disabled',false);
                    if (result.status == true) 
                    {

                        $('#email-address-placeholder').text(result.email);
                        $('.resendlink').attr('data-email', result.email);
                        $.magnificPopup.open({
                            items: {
                                src: '#email-verification',
                                type: 'inline'
                            },

                        });
                        $this[0].reset();
                    }
                    else
                    {
                        first_input = "";
                        $('.error').html("");
                        $($this).find('button[type="submit"]').prop('disabled', false);                     
                        $.each(result.errors, function(key) 
                        {
                            if(first_input=="") first_input=key;
                            if(!key.includes("[]"))
                                $('#'+key).closest('.form-grp').find('.error').html(result.errors[key]);
                        });
                    }                                
                },
                error: function(result) 
                {             
                    $($this).find('button[type="submit"]').prop('disabled',false);
                    alert("something wen't wrong")   ;
                }
            });
        });

        $('#forgot-password-form').on('submit', function(event) 
        {
            event.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: resetUrl,
                data: $(this).serialize(),
                beforeSend: function() 
                {
                    $($this).find('button[type="submit"]').prop('disabled', true);
                },
                success: function(response) 
                {     
                    $($this).find('button[type="submit"]').prop('disabled',false);
                    $('.error').html("");                    
                    $('#success-message').html("");
                    if(response.status == true)
                    {
                        $("#forgot-password-form")[0].reset();
                        $('#success-message').html(response.message);                        
                    }                    
                    if (response.status == false) 
                    {                           
                        $('.error').html(response.message);
                    }
                },
                error: function(response) 
                {                    
                    first_input = "";
                    $('.error').html("");
                    $('#success-message').html("");
                    $($this).find('button[type="submit"]').prop('disabled', false);
                    $.each(response.responseJSON.errors, function(key) 
                    {
                        if(first_input=="") first_input=key;
                        if(!key.includes("[]"))
                            $('#'+key).closest('.form-grp').find('.error').html(response.responseJSON.errors[key]);
                    });  
                }
            });
        });  

        $('.resendlink').on('click', function(event) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            event.preventDefault();
            var $this = $(this);

            var userEmail = $this.data('email');
            
            
            $.ajax({
                type: 'POST',
                url: resendVerificationEmailUrl,
                data: { email: userEmail },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                beforeSend: function() 
                {

                },
                success: function(result) 
                {                    
                    // alert(result.message);
                    toastr.success(result.message);
                },
                error: function(result) 
                {                
                    alert('Error: ' + result.responseText);
                }
            });
        });

        $(document).on('click', '.mfp-close', function (e) 
        {
            e.preventDefault();
            $('.error').html('');
            $('#error-message').html('');
            $('#success-message').html('');

            $('form').each(function() 
            {
                this.reset();
            });
            $.magnificPopup.close();
        });

        $('#search').on('input', function() {
            search();
        });

        function search() {
            var keyword = $('#search').val();

            if (keyword.length >= 3) 
            {
                $.post('{{ route("product.search") }}', 
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                }, function(data) {
                    $('#search-results-list').empty();
                    if (data.hasOwnProperty('filteredProducts')) 
                    {
                        let resultsFound = false;
                        for (let category in data.filteredProducts) 
                        {
                            if (data.filteredProducts[category].length > 0) 
                            {
                                resultsFound = true;
                                $('#search-results-list').append('<li><strong>' + category + '</strong></li>');
                                $.each(data.filteredProducts[category], function(index, product) {
                                    $('#search-results-list').append('<li style="margin-left:10px;"><a href="{{ url('product/detail') }}/' + product.id + '">' + product.name + '</a></li>');
                                });
                            }
                        }
                        if (!resultsFound) 
                        {
                            $('#search-results-list').append('<li><strong>No results found.</strong></li>');
                        }
                    } 
                    else 
                    {
                        $('#search-results-list').append('<li><strong>No results found.</strong></li>');
                    }
                });
            } 
            else 
            {        
                $('#search-results-list').empty();
            }
        }

        $(".clear-btn").on("click", function () 
        {
            search();
        });

        $("#subscribe-form").submit(function(event) {

            event.preventDefault(); // Prevent the form from submitting in the traditional way
            var $this = $(this);
            
            $.ajax({
                type: "POST",
                url: subscribeUrl, 
                data: $(this).serialize(),
                beforeSend: function() 
                {
                    $($this).find('button[type="submit"]').prop('disabled', true);
                },
                success: function(result) 
                {     
                    $($this).find('button[type="submit"]').prop('disabled',false);
                    $('.error').html("");                    
                    
                    if(result.status == true)
                    {   
                        $("#subscribe-form")[0].reset();                                              
                        toastr.success(result.message);
                    }                    
                    if (result.status == false) 
                    {                               
                        first_input = "";
                        $('.error').html("");
                        $($this).find('button[type="submit"]').prop('disabled', false);                     
                        $.each(result.errors, function(key) 
                        {
                            if(first_input=="") first_input=key;
                            if(!key.includes("[]"))
                                $('#subscribe-form #'+ key).closest('.form-grp').find('.error').html(result.errors[key]);
                        });
                    }
                },
                error: function(response) 
                {   
                    alert("something wen't wrong");
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
@yield('js')

</body>

</html>