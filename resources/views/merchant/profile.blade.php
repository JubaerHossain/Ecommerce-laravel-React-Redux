@extends('layouts.master')
@section('title','Profile')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <style>
    .file-upload {
	position: relative;
	display: inline-block;
}

.file-upload__label {
  display: block;
  border-radius: .4em;
  transition: background .3s;  
  &:hover {
     cursor: pointer;
     background: #000;
  }
}    
.file-upload__input {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    font-size: 1;
    width:0;
    height: 100%;
    opacity: 0;
  }
  .img {cursor: -webkit-grab; cursor: grab;}
</style>
@endsection
@section('content')
<div class="pb-2">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route('merchant.dashboard') }}">Home</a></li>
                            <li><span>Vendor profile</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<main role="main" class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        @include('partials._message')	
                  </div>
            <div class="container">
                        <div class="row my-2">
                              
                            <div class="col-lg-8 order-lg-2">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                                    </li><li class="nav-item">
                                        <a href="" data-target="#brand" data-toggle="tab" class="nav-link">Brand create</a>
                                    </li>
                                </ul>
                                <div class="tab-content py-4">
                                    <div class="tab-pane active" id="profile">
                                        <h5 class="mb-3">Vendor Profile</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="pt-2 pb-0 col-form-label">Name</h6>
                                                <span class="text-secondary">{{ Auth::user()->marchant->name }}</span>
                                                <h6 class="pt-2 pb-0 col-form-label">Brand name</h6>
                                                <span class="text-secondary">{{ Auth::user()->marchant->brand }}</span>
                                                <h6 class="pt-2 pb-0 col-form-label">Address</h6>
                                                <span class="text-secondary">{{ Auth::user()->marchant->address }}</span>
                                                <h6 class="pt-2 pb-0 col-form-label">Email</h6>
                                                <span class="text-secondary">{{ Auth::user()->email }}</span>
                                                <h6 class="pt-2 pb-0 col-form-label">Phone</h6>
                                                <span class="text-secondary">{{ Auth::user()->marchant->phone }}</span>
                                                <h6 class="pt-2 pb-0 col-form-label">Website</h6>
                                                <span class="text-secondary">{{ Auth::user()->marchant->web }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="border-bottom p-2">Account information</h6>
                                                <div class="pl-3 pt-2">                                                      
                                                <p class="col-form-label text-secondary"><strong class="text-dark pr-1"> Account  :</strong>  {{ Auth::user()->marchant->account }} </p>
                                                <p class="col-form-label text-secondary"><strong class="text-dark pr-1"> Bank name  :</strong>   {{ Auth::user()->marchant->bankname }}</p>
                                                <p class="col-form-label text-secondary"><strong class="text-dark pr-1"> Account name  :</strong>  {{ Auth::user()->marchant->accountname }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="tab-pane" id="edit">
                                        <form action="{{ route('postVendorProfile') }}" method="POST">
                                                      @csrf
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Shop Name</label>
                                                <div class="col-lg-9">
                                                      <input type="type" name="vendor" class="form-control" value="{{ Auth::user()->marchant->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                                <div class="col-lg-9">
                                                   <input type="type" name="address" class="form-control" value="{{ Auth::user()->marchant->address }}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                                <div class="col-lg-9">
                                                      <input type="type" disabled name="email" class="form-control" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
                                                <div class="col-lg-9">
                                                     <input type="type" name="phone" class="form-control" value="{{ Auth::user()->marchant->phone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                                <div class="col-lg-9">
                                                      <input type="type" name="web" class="form-control" value="{{ Auth::user()->marchant->web }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Account</label>
                                                <div class="col-lg-9">
                                                      <input type="type" name="account" class="form-control" value="{{ Auth::user()->marchant->account }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Bank name</label>
                                                <div class="col-lg-9">
                                                            <input type="type" name="bankname" class="form-control" value="{{ Auth::user()->marchant->bankname }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Account name</label>
                                                <div class="col-lg-9">
                                                      <input type="type" name="accountname" class="form-control" value="{{ Auth::user()->marchant->accountname }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <input type="submit" class="btn btn-primary" value="Save">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="brand">
                                    <div class="text-center">
                                        <form action="{{ route('merchant.brand') }}" method="POST">
                                                @csrf
                                                  <div class="form-group row">
                                                    <div class="col-md-2 offset-md-4">
                                                        <label for="exampleInputEmail1">Brand name</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                    <select class="js-example-tags form-control" name="brand">
                                                            <option value="no">Select brand</option>
                                                            @foreach ($brand as $item)                                                            
                                                            <option {{$item->name === Auth::user()->marchant->brand?'selected':'' }} value="{{$item->name}}">{{$item->name}}</option>
                                                            @endforeach
                                                          </select>
                                                  </div>
                                                  <div class="col-md-5 offset-md-3 pt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                  </div>
                                                  </div>
                                                  
                                                
                                            </form>
                                    </div>
                               </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-4 order-lg-1 text-center">
                                <form action="{{ route('profile_mage') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf
                                    <div class="dz-default dz-message im">
                                            <label for="upload" class="file-upload__label">
                                                <img src="{{ Auth::user()->marchant->image?url('merchant/profile/'.Auth::user()->marchant->image): asset('asset/back/images/icon/avatar2.png') }}" class="rounded-circle img" width="50%" alt="avatar">
                                            </label>
                                            <input id="upload" class="file-upload__input" type="file" name="image">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Upload</button>
                                  </div>
                              </form>
                            
                            </div>
                            
                        </div>
                        
                    </div>
</main>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script type="text/javascript">

    $(".js-example-tags").select2({
      tags: true
    }); 

    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('.img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#upload").change(function() {
    readURL(this);
    });
</script>
@endsection