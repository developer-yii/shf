 @php
     $baseUrl = asset('backend')."/";
 @endphp

 <!-- ========== Left Sidebar Start ========== -->
  <div class="left-side-menu">

    <!-- LOGO -->
    <a href="" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{$baseUrl}}assets/images/logo.svg" alt="" height="60">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}assets/images/logo.svg" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{$baseUrl}}assets/images/logo.svg" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}assets/images/logo.svg" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">
            @if($userrole== 1 || $userrole == 2)
                <li class="side-nav-item">
                    <a href="{{ route('admin.adminHome') }}" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.user') }}" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> User Management</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.file.list') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Imported File </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.code.list') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Code </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link">
                        <i class="uil-briefcase"></i>
                        <span> Products</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.product') }}"><i class="uil-briefcase"></i> Product List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.productart') }}"><i class="uil uil-notebooks"></i> Product Art</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.producttarget') }}"><i class="uil uil-notebooks"></i> Product Target</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.productuse') }}"><i class="uil-calender"></i> Product Use</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.productingredient') }}"><i class="uil-calender"></i> Product Ingredient</a>
                        </li>
                    </ul>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('order') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Order Management </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.message') }}" class="side-nav-link">
                        <i class="mdi mdi-message-bulleted"></i>
                        <span> Message </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.subscriber') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Subscriber</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.contactus') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Contact Us</span>
                    </a>
                </li>
             @endif

             @if($userrole== 3)
                <li class="side-nav-item">
                    <a href="{{ route('user.Home') }}" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('user.product') }}" class="side-nav-link">
                        <i class="uil-briefcase"></i>
                        <span> Product List</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('order') }}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Orders</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('user.message') }}" class="side-nav-link">
                        <i class="mdi mdi-message-bulleted"></i>
                        <span> Message </span>
                    </a>
                </li>
             @endif

        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->