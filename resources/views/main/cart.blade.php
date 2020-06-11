@extends('layouts.shop')
@section('title', " | Shopping Cart")
@section('content')
@include('partials._header')

<div class="product-main">
	<div class="product-head">
		<div class="container">
			<div class="line">
			<div class="row">
				<div class="col-md-2">
					<h5>Product</h5>
				</div>
				<div class="col-md-2">
					<h5>Product Name</h5>
				</div>
				<div class="col-md-2">
					<h5>QTY</h5>
				</div>
				<div class="col-md-2">
					<h5>Price</h5>
				</div>
				<div class="col-md-2">
					<h5>Total</h5>
				</div>
			</div>
		 </div>	
		</div>
	</div>
	<!-- product add here -->
	<div class="cart-product">
		<div class="container">
			@foreach($cart->items as $item)
			<div class="product-here">
				<div class="row">
					<div class="col-md-2">
						@php
							$imgs = explode('|', $item['item']['images']);
						@endphp
						<img src="{{ url('product_images/'.$imgs[0]) }}" class="img-thumbnail" alt="">
					</div>
					<div class="col-md-2">
						<div class="product-name">
							<a href="{{ route('singleProduct', $item['item']['slug']) }}">
								<p>{{ $item['item']['product_name'] }}</p>
							</a>
						</div>
						<div class="product-description">
							@if($item['size'])
							<p><strong>Size:</strong>
								<span class="btn">{{ $item['size'] }}</span>
						    </p>
						    @endif
						</div>
					</div>
					<div class="col-md-2">
						<div class="qty">{{ $item['qty'] }}</div>
					</div>
					<div class="col-md-1">
						{{ $item['item']['dpp'] }}
					</div>
					<div class="col-md-2">
						<span> {{ $item['price'] }} </span>
						<br>
						<div class="delete">
							<a href="{{ route('deletFromCart', $item['item']['id']) }}">
								<button class="btn btn-sm btn-danger">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- product-end here -->
	<div class="cart-check">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<br>
				</div>
				<div class="col-md-5 offset-md-5">
					<br>
					<div class="card">
					  <ul class="list-group">
				    	<li class="list-group-item d-flex justify-content-between align-items-center">
							Sub-total:
							<span class="badge badge-primary badge-pill">{{ $cart->totalPrice }}</span>
				    	</li>
						<p>
							<a href="{{ route('submitCheckout') }}">
								<button class="btn btn-primary" type="submit">Checkout</button>
							</a>
						</p>
					  </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
