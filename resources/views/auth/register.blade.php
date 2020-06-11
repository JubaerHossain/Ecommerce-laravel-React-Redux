@extends('layouts.login')
@section('title','Registration | Unistag')
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
                    <div class="d-flex text-center">
                            <div class="col-md-12">
                                <img src="{{asset('asset/back')}}/images/icon/logo.png" width="20%" class="brand_logo" alt="Logo">
                            </div>
                        </div>
                        
                        <div class="card-body">
                         <h2 class="text-center pb-4">Registration</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-10 offset-md-1">
                                <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                                        </div>
                                        <input id="name" placeholder="E.g John" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-10 offset-md-1">
                                    <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                            </div>
                                            <input id="email" type="email" placeholder="E.g Example@.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-10 offset-md-1">
                                    <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                            </div>
                                            <input id="password" placeholder="E.g ********" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                            </div>
                        </div>
                       

                        <div class="form-group row">

                            <div class="col-md-10 offset-md-1">
                                <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                        </div>
                                        <input id="password-confirm" placeholder="E.g ********" type="password" class="form-control" name="password_confirmation" required>
                        
                                </div> 
                            </div>
                        </div>
                         <div class="form-group row">

                            <div class="col-md-10 offset-md-1">
                                    <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                            </div>
                                            <input id="password" type="text" placeholder="E.g 01XXXXXXXX" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" required>

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-md-10 offset-md-1">
                                <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-users"></i></div>
                                        </div>
                                        <select id="password" class="custom-select {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" required>
                                            <option value="customer">Customer</option>
                                            <option value="merchant">Merchant</option>
                                        </select>

                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
