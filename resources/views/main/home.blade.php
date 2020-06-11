@extends('layouts.shop')
@section('title', " | Home")
@section('style')
<style>
	.card-title,.product-price{
		font-size: 1rem;
	}	
	.product-discount{
		font-size: .90rem;
	}
	.card-body{
		height: 130px;
		padding: 20px 0px;
	}
	.nav-link {
	    padding: .5rem .2rem;
	}
	.card-title{
		margin: 0;
	}
	.product-price span {
	    font-size: 1rem;
	    top: 0px;
	    position: relative;
	}
</style>
@endsection

@section('content')
@include('partials._header')

  <div class="main">
		<div class="container-fluid">
			<div class="row no-gutters">
				<div class="col-md-3">
					<div class="left-img">
						<div class="col-md-12 mb-2">
							<a href=""><img src="image/left.png" class="w-100" alt=""></a>
						</div>
						<div class="col-md-12">
							<img src="image/left.jpg"  class="w-100" alt="">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="center-img">
						<a href="{{ url('product-sub-view/8') }}">
							<img src="image/center.png" class="w-100" alt="">
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="right-img">
						<div class="col-md-12 mb-2">
							<a href="{{ url('product-cat-view/1') }}"><img src="image/right.png"  class="w-100 hober" alt=""></a>
						</div>
						<div class="col-md-12">
							<a href=""><img src="image/right1.jpg"    class="w-100 hober" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="m-t-20"></div>
	<!-- 	<div class="complain">
			<marquee behavior="slide" direction="left" loop="">If you have any complain contact with unistag.com .+880267262212, or email us info@unistag.com</marquee>
	</div> -->
	<div class="container-fluid">
		<div class="week-product">
			<h2 class="item-name">This Week Specials</h2>
			<section class="customer-logos slider">
				@foreach ($spacs->take(8) as $prod)
				<div class="slide">
					<a href="{{ url('product/'.$prod->slug) }}">
						@php
							$imgs = explode('|', $prod->images);
						@endphp
						<img src="{{ url('product_images/'.$imgs[0]) }}" class="image">
					</a>								
				</div>
				@endforeach
			</section>
		</div>
	</div>
<div class="container-fluid">
	<div class="home-product row">
		<div class="col-md-12">
			<img src="image/ad.jpg" class="img-fluid" alt="">
		</div>
	</div>
</div>


	<div class="container-fluid">
		<h2 class="item-name">Flash Sale</h2>
		<div class="home-item">
			<div class="row">
				@foreach($spacs as $prod)
				<div class="col-md-3">
					<div class="card">
						@php
							$imgs = explode('|', $prod->images);
						@endphp
						<div class="product">
							<div class="media" style="width:100%;height: 250px">
								<img src="{{ url('product_images/'.$imgs[0]) }}" style="display: block;max-width: 100%; max-height: 250px;margin: 0px auto;">
							</div>
							<div class="overlay">
								<div class="text">
									<a href="{{ url('product/'.$prod->slug) }}" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;Buy </a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<a href="{{ url('product/'.$prod->slug) }}" class="nav-link">
								<h5 class="card-title">{{ $prod->product_name }}</h5>
							</a>
							<h5 class="product-price">Price:&nbsp;<span>৳</span> 545</h5>
							@foreach($prod->categories() as $cat)
								<a href="#" class="badge badge-primary">{{$cat->name}}</a>
							@endforeach
						</div>
					</div>
				</div>
				@endforeach						
			</div>			
		</div>
	</div>
@endsection
