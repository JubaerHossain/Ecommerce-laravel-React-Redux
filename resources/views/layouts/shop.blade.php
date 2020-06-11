<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Unistag @yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('asset/back')}}/images/icon/logo.png">
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    @yield('fb')
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Add the slick-theme.css if you want default styling -->
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>    
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{asset('css/client.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css') }}">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">

    @yield('style')
	</head>
	<body>
  <div class="header-top">
  <div class="row justify-content-between">
    <div>
      <span><small class="h-item">Hotline:&nbsp;+8801711328179</small></span>
    </div>
    <div>
      <a href="" class="h-item">
        <span>How to use</span>
      </a>
      <a href="" class="h-item">
        <span>Replacement Policy</span>
      </a>
    </div>
  </div>

</div>

@yield('content')

<button onclick="topFunction()" id="myBtn" class="animated infinite bounce" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
    <div class="m-t-100"></div>
    <div class="footer-top">
      <div class="container">
        {{-- <div class="row">
          <div class="col-md-6">
            <div class="input-group newsletter">
              <span class="news">Newsletter</span>
              <input type="text" class="form-control" placeholder="Enter Your Email">
              <div class="input-group-append">
                <span class="input-group-text">
                  <a href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="social-icons">
              <i class="icon fa fa-twitter"></i>
              <i class="icon fa fa-facebook"></i>
              <i class="icon fa fa-google-plus"></i>
              <i class="icon fa fa-instagram"></i>
              <i class="icon fa fa-pinterest"></i>
              <i class="icon fa fa-youtube-play"></i>
            </div>
          </div>
        </div>    --}}     
      </div>
    </div>
    
    <footer>
      <div class="footer" id="footer">
        <div class="container">
          <div class="row">
            
            <div class="col-lg-3 col-xs-12">
              <span class="logo">
                <a href="{{ route('home') }}">
                  <img src="{{ url('image/logo.png') }}" class="img-fluid" alt="logo" width="100px">
                </a>
              </span>
            </div>
            <div class="col-lg-3 col-xs-12">
              <h3>MENU</h3>
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Services</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-xs-12">
              <h3>Services</h3>
              <ul>
                <li><a href="{{ route('affiliateLogin') }}">Affiliate Login</a></li>
                <li><a href="#">Advertise Here</a></li>
                <li><a href="#">Vendor Registration</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-xs-12">
              <h3>CONTACT</h3>
              <address>
                <strong>Unistag</strong><br>
                Address: House 49, Road:12,<br>
                  Sector:11,Uttara, Dhaka.<br><br>
                 <p>Phone: +8801711328179</p>
                 <p>E-mail: info@dreamploy.com</p>
                 <p>Website: www.unistag.com</p>
              </address>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <div class="footer-bottom ">
      <p class="text-center">Copyright © {{ now()->year }}. All Right Reserved <a href="www.dreamploy.com" class="f-white">Dreamploy</a></p>
    </div> 
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type="text/javascript" src="{{ asset('js/slide.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/scroll.js') }}"></script>
    
  <script src="{{asset('js/jquery.elevateZoom.min.js') }}"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
      <script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>  
  <script src="{{ url('js/slider.js') }}"></script>
  <script src="{{ url('js/jquery.elevateZoom.min.js') }}"></script>
    @yield('script')
</body>
</html>
