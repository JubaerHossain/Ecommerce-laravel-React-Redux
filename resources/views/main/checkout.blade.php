@extends('layouts.shop')
@section('content')
@include('partials._header')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 offset-lg-2">
			<form method="post" action="{{ route('checkoutOrder') }}">
				{{ csrf_field() }}
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
					<div class="form-group">
						<label for="district">District</label>
						<input type="text" class="form-control" name="district" id="district" placeholder="District">
					</div>	
			  	</div>
			  	<div class="col-md-6">
				  	<div class="form-group">
					    <label for="phone">Phone</label>
					    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
					 </div>
			  	</div>
			  </div>
			  <div class="form-group">
			    <label for="address">Shipping Address</label>
			    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
			  </div>
			  <button type="submit" class="btn btn-primary">Checkout</button>
			</form>			
		</div>
		<div class="col-lg-4 offset-lg-1">
			<h4>Your Shopping Cart</h4>
			<div class="card">
			  <ul class="list-group">
			  	@foreach($cart->items as $item)
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						{{$item['item']['product_name']}} ( {{$item['item']['price']}} * {{$item['qty']}} )
						<span class="badge badge-primary badge-pill">{{$item['price']}}</span>
			    	</li>
			    @endforeach
			    	<li class="list-group-item d-flex justify-content-between align-items-center" style="border-top:1px solid rgb(66, 65, 65)">
						Sub-total:
						<span class="badge badge-primary badge-pill">{{ $cart->totalPrice }}</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Shipping Cost: <span class="badge badge-primary badge-pill">60</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Total: <span class="badge badge-primary badge-pill">{{ $cart->totalPrice + 60}}</span>
			    	</li>
			  </ul>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')

@endsection