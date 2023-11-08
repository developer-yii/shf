@php
    $baseUrl = asset('backend')."/";
    $jsUrl = asset('frontend/js/user')."/";
    $username = Auth::user()->first_name;
    $userrole = Auth::user()->role;
@endphp

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- third party css -->
        <link href="{{$baseUrl}}assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{$baseUrl}}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{$baseUrl}}assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{$baseUrl}}assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{$baseUrl}}assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="{{$baseUrl}}assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="{{$baseUrl}}assets/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="{{$baseUrl}}assets/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
        <link href="{{$baseUrl}}assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{$baseUrl}}assets/css/toastr.css?time()">

        @yield('css')
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>
        <div class="ajax-loader d-none">
            {{-- <img src="{{ $baseUrl }}assets/images/loader.gif" class="img-responsive" /> --}}
          </div>
        <!-- Begin page -->
        <div class="wrapper">
          @include('admin.include.left-sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    @include('admin.include.top-bar')
                    
                    @yield('content')

                </div>
                <!-- content -->
                @yield('modal')
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> ©{{ env('APP_NAME')}}
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        
        <!-- bundle -->
        <script src="{{$baseUrl}}assets/js/vendor.min.js"></script>
        <script src="{{$baseUrl}}assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="{{$baseUrl}}assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{$baseUrl}}assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <script type="text/javascript">
            function showFlash(element, msg, type) {
                $('.error-message').html(msg)
                if (type == 'error') {
                    $('#danger-alert-modal').modal('show');
                } else {
                    $('#success-alert-modal').modal('show');
                }
               
            }
            
        </script>

        <!-- demo app -->
        <script src="{{$baseUrl}}assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="{{$baseUrl}}assets/js/vendor/dataTables.bootstrap4.js"></script>
        <script src="{{$baseUrl}}assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="{{$baseUrl}}assets/js/vendor/responsive.bootstrap4.min.js"></script>
        <script src="{{$baseUrl}}user/js/jquery.slimscroll.js"></script>
        <script src="{{$baseUrl}}assets/js/toastr.js?{{time()}}"></script>
        <script src="{{$baseUrl}}assets/js/sweetalert2.js?{{time()}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>
        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,                
            });
        </script>
        @if($userrole== 1 || $userrole == 2)
        <script type="text/javascript">            
            var viewAllUrl="{{ route('admin.message') }}";  
            var viewChat="{{ route('admin.view_chat') }}"; 
             var chatstatus = "{{ route('admin.messages.mark_as_read') }}";
        </script>        
        @else
        <script type="text/javascript">            
             var viewAllUrl="{{ route('user.message') }}";  
             var viewChat="{{ route('user.view_chat') }}";             
             var chatstatus = "{{ route('user.messages.mark_as_read') }}";
        </script>
        @endif        
        <script type="text/javascript">
            var getNotificationUrl = "{{ route('notification.getNotification') }}";            
            var readAllUrl="{{ route('notification.readAll') }}";            
        </script>
        <script src="{{$baseUrl}}assets/js/chat.js"></script>
        <script>
            var addToCart = "{{ route('user.add.to.cart') }}"; 
            var updateCart = "{{ route('user.update.cart') }}"; 
            var removeCartItem = "{{ route('user.remove.from.cart') }}";
            var checkoutOrder = "{{ route('user.checkout') }}";
        </script>
        <script src="{{$jsUrl}}cart.js"></script>
        <!-- <script src="{{$baseUrl}}assets/js/notification.js"></script> -->
        @yield('js')
        <!-- end demo js-->
    </body>
</html>