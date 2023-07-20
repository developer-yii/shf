@php 

$baseUrl = asset('backend')."/";

@endphp 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ $baseUrl }}assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ $baseUrl }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ $baseUrl }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ $baseUrl }}assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ $baseUrl }}assets/css/custom.css" rel="stylesheet" type="text/css" id="dark-style" />
        @yield('css')
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                       
                        <!-- end card -->
                        @yield('content')

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> ©{{ env('APP_NAME') }}
        </footer>

        <!-- bundle -->
        <script src="{{ $baseUrl }}assets/js/vendor.min.js"></script>
        <script src="{{ $baseUrl }}assets/js/app.min.js"></script>
        @yield('js')
    </body>
</html>
