@extends('layouts.affiliate')
@section('title', 'Product Details')
@section('content')
<main role="main" class="col-md-9 m-b-50 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Product</h1>
    @foreach($errors->all() as $message)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
    @endforeach
    @if(Session::has('error'))
         <div class="alert alert-danger" role="alert">
        {!!Session::get('error')!!}
      </div>
    @endif
    <a href="{{ route('affHome') }}" class="btn btn-info">All Products</a>
	</div>
	<div class="dashboard-item">
    
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          @php
            $imgs = explode('|', $product->images);
          @endphp
          @foreach($imgs as $img)
          <img class="card-img-top" src="{{ url('product_images/'.$img) }}" alt="Card image cap">
          @endforeach
        </div>
      </div>
      <div class="col-md-5">
            @csrf
            <div class="form-group">
            <label for="exampleInputname">Product Base Category</label>
              <strong>{{ $product->nephew->name }}</strong>
            </div>
            <div class="form-group">
              <label for="">Product Name</label>
              <strong>{{ $product->product_name }}</strong>
            </div>
            <div class="form-group">
              <label for="">Stock Available</label>
              <strong>{{ $product->stock_available }}</strong>
            </div>
            <div class="form-group">
              <label for="">Price</label>
              <strong>{{ $product->dpp }}</strong>
            </div>
            <div class="form-group">
              <label>Product Details</label>
              <strong>{{ $product->details }}</strong>
            </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Link</h5>
            <a href="{{ url('product/'.$product->slug) }}">{{ $product->slug }}</a>
            <br><br>
            <h5 class="card-title">Meta Informationas</h5>
            <br><br>
          </div>
        </div>
        <br><br>
        <div class="card">
          <div class="card-body">
            <button id="affCd" class="btn btn-success">Get Affiliate Link</button>
            <br><br>
            <strong id="affCdShow" style="display:none"><a href="{{ url('product/'.$product->slug).'/'.Auth::user()->dpid }}">{{ url('product/'.$product->slug).'/'.Auth::user()->dpid }}</a></strong>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</main>
@endsection
@section('script')
<script>
  jQuery('#affCd').click(function(){
    jQuery('#affCdShow').show();
  });
</script>
@endsection