@extends('layouts.affiliate')
@section('content')
	<div class="container-fluid">
		<div class="row">
		
			<main role="main" class="col-md-9 m-b-50 ml-sm-auto col-lg-10 pt-3 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
					<h1 class="h2">All Products</h1>
					<form class="form-inline" method="get" action="{{ route('affHome') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchStr">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
          </form>
				</div>
				<!--
				<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
				<div class="dashboard-item">
					<div class="table-responsive">
						<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">Img</th>
      <th scope="col">Name</th>
      <th scope="col">Stock</th>
      <th scope="col">Price</th>
      <th scope="col">DP</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
    <tr>
      <td class="coupon-code"><span class="code">{{ $product->id +100100 }}</span></td>
      @php
        $imgs = explode('|', $product->images);
      @endphp
      <td class="coupon-code">
        <img class="card-img-top" src="{{ url('product_images/'.$imgs[0]) }}" style="width:50px">
      </td>
      <td class="coupon-code">{{ $product->product_name }}</td>
      <td class="coupon-code">{{ $product->stock_available }}</td>
      <td class="coupon-code">{{ $product->dpp }}</td>
      <td class="coupon-code">
        @php
          $price = round(($product->dpp - $product->price) * 35 /100 / 78, 3);
          $var = explode('.', $price);
        @endphp
        DP: &nbsp; {{ $var[0].$var[1] }}
      </td>
      <td class="coupon-code">
      	<a href="{{ route('affSingleProduct', $product->id) }}" class="btn btn-primary">
      	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="text-center">
  {!! $products->links() !!}
</div>
		</div>
		    	</div>

			</main>
		
	</div>
	@endsection