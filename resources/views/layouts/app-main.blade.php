
@php
    $baseUrl = asset('frontend/old')."/";
    $baseUrlbackend = asset('backend')."/";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="description" content="" />
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="theme-color" content="#fff" />
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ $baseUrl }}favicon.ico" type="image/x-icon" />
  <link rel="icon" href="{{ $baseUrl }}favicon.ico" type="image/x-icon" />

  <script src="https://unpkg.com/phosphor-icons"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="{{ $baseUrl }}css/main.css" />
  <link href="{{$baseUrlbackend}}assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{$baseUrlbackend}}assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
  @yield('css')
</head>

<body>
    <div class="main-wrap">
        @yield('content')
    </div>
    @yield('modal')
    
  <!-- Header Starts -->
  <!-- <header id="header"></header> -->
  <!-- Header Ends -->

  <!-- Main Container Starts -->
  <!-- <div class="main-container">

  </div> -->
  <!-- Main Container Ends -->

  <!-- <footer id="footer"></footer> -->
  <!-- Footer Ends -->

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/megamenu.js"></script>
  <script src="js/common.js"></script> -->
   <!-- third party js -->
   <script src="{{$baseUrl}}js/vendor.min.js"></script>
   <script src="{{$baseUrl}}js/app.min.js"></script>
   <script src="{{$baseUrl}}js/jquery-jvectormap-1.2.2.min.js"></script>
   <script src="{{$baseUrl}}js/jquery-jvectormap-world-mill-en.js"></script>
   <script src="{{$baseUrlbackend}}assets/js/pages/demo.toastr.js"></script>
    @yield('js')
   <!-- third party js ends -->

</body>

</html>