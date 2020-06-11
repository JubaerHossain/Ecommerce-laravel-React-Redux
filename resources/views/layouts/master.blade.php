<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unistag || @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="{{asset('asset/back')}}/images/icon/logo.png">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/metisMenu.css">
  <!-- others css -->
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/typography.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/default-css.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/styles.css">
    <link rel="stylesheet" href="{{asset('asset/back')}}/css/responsive.css">
    @yield('style')	
</head>

<body class="body-bg">
        <div id="preloader">
                <div class="loader"></div>
            </div>
            <!-- preloader area end -->
            <!-- page container area start -->
            <div class="page-container">
                <!-- sidebar menu area start -->
                <div class="sidebar-menu">
                    <div class="sidebar-header">
                        <div class="logo">
                            <a href="{{ route('home') }}" ><img src="{{asset('asset/back')}}/images/icon/logo.png" width="50%" alt="logo"></a>
                        </div>
                    </div>
                    <div class="main-menu">
                        <div class="menu-inner">
                            <nav>
                                <ul class="metismenu" id="menu">
                                    <li class="active">
                                        <a href="{{ route('merchant.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                        
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-box-open"></i><span>Product
                                            </span></a>
                                        <ul class="collapse">
                                            <li><a href="{{ route('merchantProductIndex') }}" >Product list</a></li>
                                            <li><a href="{{ route('merchantProductCreate') }}" >Product add</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-briefcase" aria-hidden="true"></i><span>Profile</span></a>
                                        <ul class="collapse">
                                            <li><a href="{{ route('vendorProfile') }}" >Profile</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span>Orders</span></a>
                                        <ul class="collapse">
                                            <li><a href="{{ route('orders') }}" >Order list</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- sidebar menu area end -->
                <!-- main content area start -->
                <div class="main-content">
                    <!-- header area start -->
                    <div class="header-area">
                        <div class="row align-items-center">
                            <!-- nav and search button -->
                            <div class="col-md-6 col-sm-8 clearfix">
                                <div class="nav-btn pull-left">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="search-box pull-left">
                                    <form action="#">
                                        <input type="text" name="search" placeholder="Search..." required>
                                        <i class="ti-search"></i>
                                    </form>
                                </div>
                            </div>
                            <!-- profile info & task notification -->
                            <div class="col-md-6 col-sm-4 clearfix">
                                <ul class="notification-area pull-right">
                                        <li class="dropdown">
                                                <i class="fa fa-envelope dropdown-toggle" data-toggle="dropdown">
                                                  @if (count($messg)>0) 
                                                  <span>{{count($messg)}}</span>
                                                  @endif
                                                </i>
                                                <div class="dropdown-menu bell-notify-box notify-box">
                                                    <span class="notify-title">You have {{count($messg)}} new message</span>
                                                    @if (count($messg)>0) 
                                                    <div class="nofity-list">
                                                        @foreach ($messg as $item) 
                                                        <a href="{{route('merchant.message_see',$item->product_id)}}" class="notify-item">
                                                            <div class="notify-thumb">Admin</div>
                                                            <div class="notify-text">
                                                                <p>{{ str_limit($item->message,'20')}} <span class="blockquote-footer float-right">{{$item->created_at->format('F d, Y ')}}</span></p>                                                        
                                                            </div>
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </li>
                                    <li class="dropdown">
                                        <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                            <span>2</span>
                                        </i>
                                        <div class="dropdown-menu bell-notify-box notify-box">
                                            <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                            <div class="nofity-list">
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                                    <div class="notify-text">
                                                        <p>You have Changed Your Password</p>
                                                        <span>Just Now</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                                    <div class="notify-text">
                                                        <p>New Commetns On Post</p>
                                                        <span>30 Seconds ago</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                                    <div class="notify-text">
                                                        <p>Some special like you</p>
                                                        <span>Just Now</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                                    <div class="notify-text">
                                                        <p>New Commetns On Post</p>
                                                        <span>30 Seconds ago</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                                    <div class="notify-text">
                                                        <p>Some special like you</p>
                                                        <span>Just Now</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                                    <div class="notify-text">
                                                        <p>You have Changed Your Password</p>
                                                        <span>Just Now</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                                    <div class="notify-text">
                                                        <p>You have Changed Your Password</p>
                                                        <span>Just Now</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="">
                                            <div class="user-profile">
                                            <img class="avatar user-thumb" src="{{asset('asset/back')}}/images/author/avatar.png" alt="avatar">
                                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Marchant <i class="fa fa-angle-down"></i></h4>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Message</a>
                                                <a class="dropdown-item" href="{{ route('vendorProfile') }}">Profile</a>
                                                <a class="dropdown-item" href="{{ __('Logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <span class="icon"></span>
                                                    Log Out
                                                </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                            </div>
                                            </div>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- header area end -->
                    <!-- page title area start -->
                    
                    <!-- page title area end -->
                    <div class="main-content-inner">                            
                        @yield('content')
                    </div>
                </div>
                <!-- main content area end -->
                <!-- footer area start-->
                <footer>
                    <div class="footer-area">
                        <p>© Copyright {{ now()->year }}. All right reserved by <a href="https://unistag.com/" >Unistag</a>.</p>
                    </div>
                </footer>
                <!-- footer area end-->
            </div>
            <!-- page container area end -->
    <!-- jquery latest version -->
    <script src="{{asset('asset/back')}}/js/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('asset/back')}}/js/popper.min.js"></script>
    <script src="{{asset('asset/back')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('asset/back')}}/js/metisMenu.min.js"></script>
    <script src="{{asset('asset/back')}}/js/jquery.slimscroll.min.js"></script>
    <!-- others plugins -->
    <script src="{{asset('asset/back')}}/js/plugins.js"></script>
    <script src="{{asset('asset/back')}}/js/scripts.js"></script>
    
    @yield('script')
</body>

</html>
