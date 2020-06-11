  <header>
    <div class="main-header">
      <div class="container">
        <div class="row justify-content-between py-2">
          <div class="col-md-2 col-sm-2">
            <a class="navbar-brand" href="{{ route('home') }}">
              <img src="{{ url('image/logo.png') }}" id="logo" alt="Unistag" style="width:60px;margin-top: -10px">
            </a>
          </div>
          <div class="col-md-8 col-sm-10">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <form action="{{ route('searchProd') }}" method="get">
                  <div class="input-group" style="height: 30px;margin-top: 5px;">
                    <input type="text" class="form-control head-search" name="search_string" minlength="3">
                    <div class="input-group-append">
                      <button class="input-group-text" id="inputGroup-sizing-lg" style="cursor: pointer;">
                        <i class="fa fa-search" aria-hidden="true" style="color:#0fa2b3"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </li>
              <li class="nav-item px-3">
                <a href="{{ route('shoppingCart') }}" class="nav-link mn-nav" id="cart">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                  <span><strong>({{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }})</strong></span>
                </a>
              </li>
              <li class="nav-item px-2">
                <a href="{{ route('login') }}" class="nav-link mn-nav">Log In</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link mn-nav">Register</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="primary">
      <nav class="navbar navbar-expand-lg navbar-light bg-uni">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            @foreach($cats as $cat)
            <li class="nav-item mainmenu0">
              <a class="nav-link " href="#">{{ $cat->name }}</a>
              <ul class="submenu">
              @foreach($cat->child as $ch)
                <li class="level1">
                  <a href="{{ route('subView', $ch->id) }}" class="nav-link"><span>{{ $ch->name }}</span></a>
                  <ul class="submenu1">
                    @foreach($ch->child as $c)
                    <li class="sublevel1"><a href="{{ route('poductDisplay', $c->name) }}" class="nav-link">{{ $c->name }}</a></li>
                    @endforeach
                  </ul>
                </li>
              @endforeach
              </ul>
            </li>
            @endforeach
          </ul>
        </div>
      </nav>
    </div>
</header>