@extends('layouts.merchant')
@section('title', 'Order edit')
@section('content')
<main role="main" class="col-md-9 m-b-50 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Order</h1>
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
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
	</div>
	<div class="dashboard-item">
    <form method="post" action="{{route('postEditProdust', $product->id)}}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-3">
        <div class="card">

          <img class="card-img-top" src="{{ url('product_variation/'.$product->variations->Pimage) }}" alt="Card image cap">
         
        </div>
      </div>
      <div class="col-md-5">
            @csrf
            <div class="form-group">
            <label for="exampleInputname">Chose Category</label>
              {{-- <select class="form-control" name="nephew">
                @foreach($nepews as $nep)
                   <option value="{{$nep->id}}">{{$nep->name}}</option>
                @endforeach
              </select> --}}
            </div>
            <div class="form-group">
              <label for="">Product Name</label>
              <input type="text" class="form-control" name="product_name" value="{{ $product->name }}">
            </div>           
            <div class="form-group">
              <label for="">Stock Available</label>
              <input type="number" class="form-control" min="1" max="" value="{{ $product->stock }}" name="stock_available">
            </div>
            <div class="form-group">
              <label for="">Vendor Price</label>
              <input type="number" class="form-control" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group">
              <label for="">Customer Price</label>
              <input type="number" class="form-control" name="dp_price" value="{{ $product->s_price }}">
            </div>
            <div class="form-group">
              <label>Product Details</label>
              <textarea class="form-control" id="" rows="3" name="details">{{ $product->properties->description }}</textarea>
            </div>              
            <div class="size">
              <div class="panel panel-default">
                <div class="panel-body">
                  <h6>Available Size</h6>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="size_m">
                    <label class="form-check-label" for="inlineCheckbox1">M</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="size_l" >
                    <label class="form-check-label" for="inlineCheckbox2">L</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="size_xl">
                    <label class="form-check-label" for="inlineCheckbox2">XL</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="size_xxl">
                    <label class="form-check-label" for="inlineCheckbox2">XXL</label>
                  </div>
                </div>  
              </div>
            </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Address</h5>
            <a href="{{ url('product/'.$product->slug) }}">{{ url('product/'.$product->slug) }}</a>
            <br><br>
            <h5 class="card-title">Meta Informationas</h5>
            <br><br>
          </div>
        </div>
        <br><br>
        <div class="card">
          <div class="card-body">
            <label for="status">Product Status</label>
            <select name="status" id="status" class="form-control">
              <option value="1">Published</option>
              <option value="0">Unpublished</option>
            </select>
            <br><br>
            <button type="submit" class="btn btn-primary btn-block m-b-50">Update Informations</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>

</main>
@endsection
  
