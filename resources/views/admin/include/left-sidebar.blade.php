 @php
     $baseUrl = asset('backend')."/";
 @endphp
 
 <!-- ========== Left Sidebar Start ========== -->
  <div class="left-side-menu">
    
    <!-- LOGO -->
    <a href="{{route('admin.adminHome')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{$baseUrl}}assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{route('admin.adminHome')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{$baseUrl}}assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            
            <li class="side-nav-item">
                <a href="{{ route('admin.adminHome') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Products</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.code.list') }}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> Code </span>
                </a>
            </li>

        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->