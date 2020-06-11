@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border:none;">
                <div class="card-body" >
                    <form method="POST" action="{{ route('loginAffiliater') }}" class="text-center">
                        <br><br>
                        <img src="{{ url('image/logo.png') }}" alt="Unistag" style="width:100px">
                        <br><br>
                        <h5 class="text-center">Dreamploy Member's Affiliate Login</h5>
                        <br>
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    Login
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
