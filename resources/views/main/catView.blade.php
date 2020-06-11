@extends('layouts.shop')
@section('content')

@include('partials._header')

<div class="main-men">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="sidebar">
					<h2 class="category">{{ $category->name }}</h2>
					<ul class="navbar-nav">
						@foreach($category->childs as $cat)
						<li class="nav-item">
							<a href="{{ route('poductDisplay', $cat->name) }}" class="nav-link">{{ $cat->name }}</a>
						</li>
						@endforeach														
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="home-item">
					<div class="row">
						@foreach($category->products as $product)
						<div class="col-md-3">
							<div class="card ">
									@php
										$imgs = explode('|', $product->images);
									@endphp
								<div class="product" style="background-image: url('{{ url('product_images/'.$imgs[0]) }}'); background-size: cover;height: 150px">
									<div class="overlay">
										<div class="text">
											<a href="{{ route('singleProduct', $product->slug) }}" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;Buy</a>
										</div>
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
									<h5 class="product-discount">DP:&nbsp; {{ $var[0].$var[1] }}</h5>
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
