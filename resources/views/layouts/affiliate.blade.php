<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Affiliate || @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client.css') }}">    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- ==============JS===================   -->
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/css/dashboard.css') }}">
      
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type="text/javascript" src="{{asset('js/slide.js') }}"></script>
      <script type="text/javascript" src="{{asset('js/scroll.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script> 
  <script src="{{ asset('js/jquery.elevateZoom.min.js') }}"></script>     
</head>
<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
      <img src="image/logo.jpg" id="dashlogo" alt="">
    </a>
    <div class="btn-group px-4">
      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Admin
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="dsetting.php">
          <span><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></span>
          Settings
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ __('Logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          <span class="icon"><i class="fa fa-power-off" aria-hidden="true"></i></span>
          Log Out
        </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

      </div>
    </div>
  </nav>
   <div class="container-fluid">
    <div class="row">
          {{-- <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item bg-red">
              <a class="nav-link active" href="adminhome.php">
                <span class="icon"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" target="_blank" href="index.php">
                <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                Visit Site 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.product-categories')}}">
                <span class="icon"><i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                Product Category
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.product-sub-categories')}}">
                <span class="icon"><i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                Product Sub Category
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="{{route('admin.product-sub-sub-categories')}}">
                <span class="icon"><i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                Product Sub Sub Category
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('adminAllProduct') }}">
                <span class="icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                All Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dreport.php">
                <span class="icon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                Report
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dwidraw.php">
                <span class="icon"><i class="fa fa-upload" aria-hidden="true"></i></span>
                Widraw
              </a>
            </li>
          </ul>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="dsetting.php">
                <span><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></span>
                Settings
              </a>
            </li>
          </ul>
        </div>
      </nav> --}}
      @yield('content')
      
    </div>
  </div>



   <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  @yield('script')
</body>
  