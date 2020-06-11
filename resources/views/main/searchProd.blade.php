@extends('layouts.shop')
@section('content')

@include('partials._header')

<div class="main-men">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="sidebar">
					<h2 class="category">Men</h2>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="" class="nav-link">T-shirts</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">T-shirts</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">Jeans</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">Jeans</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">Jeans</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">Jeans</a>
						</li>														
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="home-item">
					<h5>For string <strong>"{{ $string }}"</strong> we found <strong>{{ $products->count() }}</strong> results.</h5>
					<div class="row">
						@foreach($products as $product)
						<div class="col-md-3">
							<div class="card ">
								<div class="product">
									@php
										$imgs = explode('|', $product->images);
									@endphp
									<img src="{{ url('product_images/'.$imgs[0]) }}" class="image">
									<div class="overlay">
										<div class="text">
											<a href="{{ route('singleProduct', $product->slug) }}" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;Buy </a>
										</div>
										{{-- <div class="overlay-other">
											<div class="myoverlay-wishlist">
												<a href="" title="Add to Wishlist" class="btn btn-sm btn-warning">
													<i class="fa fa-heart-o" aria-hidden="true">
													</i>
												</a>
											</div>
											<div class="myoverlay-view">
												<a href="" title="Quick View" class="btn btn-sm btn-warning">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
											</div>
											<div class="myoverlay-compare">
												<a href="" title="Compare" class="btn btn-sm btn-warning">
													<i class="fa fa-exchange" aria-hidden="true"></i>
												</a>
											</div>
										</div> --}}
									</div>
								</div>
								<div class="card-body">
									<a href="{{ route('singleProduct', $product->slug) }}" class="nav-link">
										<h5 class="card-title">{{ $product->product_name }} </h5>
									</a>
									<h5 class="product-price">Price:&nbsp;<span>৳</span> {{ $product->dpp }}</h5>
									@php
										$price = round(($product->dpp - $product->price) * 35 /100 / 78, 3);
										$var = explode('.', $price);
									@endphp
									<h5 class="product-discount">DP:&nbsp;৳ {{ $var[0].$var[1] }}</h5>
								</div>
							</div>
						</div>
						@endforeach
					</div>						
				</div>
				<!-- row end -->
			</div>
		</div>
	</div>
</div>
@endsection
