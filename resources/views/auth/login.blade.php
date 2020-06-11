@extends('layouts.login')
@section('style')
    <style>
    .card{ border: none;margin: 0 auto;position: relative;z-index: 999;background:rgba(255,255,255,0.04);-webkit-box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);color: white;} 
    .lin,.btn-link{font-family: serif;color:white}.lin:hover{color: #007bff;text-decoration: none}
    </style>
@endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card py-2" style="border:none;">
             {{--    <div class="card-header" style="background: red;">{{ __('Login') }}</div> --}}
             <div class="d-flex text-center">
					<div class="col-md-12">
						<img src="{{asset('asset/back')}}/images/icon/logo.png" width="20%" class="brand_logo" alt="Logo">
					</div>
				</div>
                <div class="card-body" >
                    <h4 class="text-center">Only for Merchant's or Vendor's</h4>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                    <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input id="email" type="email" placeholder="E.g Example@com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                          </div>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div> 
                                    </div>                                         
                                        <input id="password" type="password" placeholder="E.g ********" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-white">
                            <div class="col-md-8 offset-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-2">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}" >
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
