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
        <link href="{{$baseUrl}}assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{$baseUrl}}assets/css/toastr.css?time()">

        @yield('css')
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
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

        <!-- Right Sidebar -->
        <div class="right-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar>

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <!-- Settings -->
                    <h5 class="mt-3">Color Scheme</h5>
                    <hr class="mt-1" />

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                            id="light-mode-check" checked />
                        <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                            id="dark-mode-check" />
                        <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Width -->
                    <h5 class="mt-4">Width</h5>
                    <hr class="mt-1" />
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                        <label class="custom-control-label" for="fluid-check">Fluid</label>
                    </div>
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                        <label class="custom-control-label" for="boxed-check">Boxed</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1" />
                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="theme" value="default" id="default-check"
                            checked />
                        <label class="custom-control-label" for="default-check">Default</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="theme" value="light" id="light-check" />
                        <label class="custom-control-label" for="light-check">Light</label>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input type="radio" class="custom-control-input" name="theme" value="dark" id="dark-check" />
                        <label class="custom-control-label" for="dark-check">Dark</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="compact" value="fixed" id="fixed-check"
                            checked />
                        <label class="custom-control-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="compact" value="condensed"
                            id="condensed-check" />
                        <label class="custom-control-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="compact" value="scrollable"
                            id="scrollable-check" />
                        <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                    <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                        class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>
                </div> <!-- end padding-->

            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /Right-bar -->

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