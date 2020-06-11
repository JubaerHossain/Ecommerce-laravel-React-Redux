@extends('layouts.shop')
@section('title', " | $product->product_name")

@section('fb')
	@php
      $imgs = explode('|', $product->images);
    @endphp
    <meta property="og:url"           content="{{ route('singleProduct', $product->slug) }}" />
    <meta property="og:type"          content="Ecommerce" />
    <meta property="og:title"         content="{{ $product->product_name }}" />
    <meta property="og:description"   content="{{ substr(strip_tags($product->details), 0, 100) }}" />
    <meta property="og:image"         content="{{ url('product_images/'.$imgs[0]) }}" />
@endsection
@section('content')

@include('partials._header')

<div class="body">
	<div class="product-essential">
		<div class="container">
			@if(Session::has('warning'))
			     <div class="alert alert-danger" role="alert">
				  {!!Session::get('warning')!!} {{ $product->merchant->name }}
				</div>
			@endif
			<div class="row">
				<div class="col-md-4">
					<div class="zoom">
						<img id="img_01" src="{{ url('product_images/'.$imgs[0]) }}" class="img-fluid zoomImg" data-zoom-image="{{ url('product_images/'.$imgs[0]) }}">							
					</div>
					<div id="gal1">
						@foreach($imgs as $key => $img)
						<a href="#" data-image="{{ url('product_images/'.$imgs[$key]) }}" data-zoom-image="{{ url('product_images/'.$imgs[$key]) }}" class="galImg">
							<img id="img_011" src="{{ url('product_images/'.$imgs[$key]) }}">
						</a>
						@endforeach
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="col-md-8">
					<form action="{{ route('postAddtoCart', $product->id) }}" method="post">
						{{ csrf_field() }}
						<div class="product-description">
							<h1>{{ $product->product_name }}</h1>
							<div class="product-code">
								<h4>Product Code: <strong>#{{ $product->id + 100100 }}</strong></h4>
							</div>
							<div class="details-price">
								<div class="new-price">
									<strong>Price:</strong>&nbsp;
									<span>{{ $product->dpp }} Tk</span>
								</div>
								<div class="dp-price">
									<strong>DP</strong>&nbsp;
									@php
										$price = round(($product->dpp - $product->price) * 35 /100 / 78, 3);
										$var = explode('.', $price);
									@endphp
									<span>{{ $var[0].$var[1] }}</span>
								</div>
								<div class="vendor">
									<strong>Vendor</strong>&nbsp;
									<span> - {{ $product->merchant->name }}</span>
								</div>
							</div>
							<div class="details">
								<p>{{ $product->details }}</p>
							</div>
							@if($product->product_size)
							@php
								$sizes = explode('|', $product->product_size);
							@endphp
							<div class="size">
								<strong>Size</strong><br>
								@foreach($sizes as $size)
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="size" id="exampleRadios1" value="{{ $size }}" required>
									<label class="form-check-label" for="exampleRadios1">
										{{ $size }}
									</label>
								</div>
								@endforeach
							</div>
							@endif
							<div class="qty-num">
								<strong>QTY</strong><input type="number" name="pq" min="1" max="" value="1">
							</div>
						</div>
						<br>
						@if(Session::has('carted'))
						     <div class="alert alert-success" role="alert">
							  {!!Session::get('carted')!!}
							  <br><br><a href="{{ route('shoppingCart') }}" class="btn btn-info">View Your Cart</a>
							</div>
						@endif
						<div class="details-buy">
							<button type="submit">
								<i class="fa fa-shopping-basket" aria-hidden="true"></i>
								&nbsp; Buy Now
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="topic">
		<div class="container">
			<div class="row">
				<div class="col-md-3 offset-md-4">
					<div class="">
						<img src="image/shield.png" alt="">
					</div>
					<div class="protect-text">
						<h5>100% Buyer Protection</h5>
						<small>7 Days Replacement</small>
					</div>
				</div>
				<div class="col-md-2">
					<div class="deliver">
						<img src="image/deliver.png" class="" alt="">
					</div>
					<div class="protect-text">
						<h5>Delivery Time</h5>
						<small>Usualy in 1-5 business days</small>
					</div>
				</div>
				<div class="col-md-3">
					<div class="call">
						<img src="image/call.png" alt="">
					</div>
					<div class="protect-text">
						<h5>Order By Call</h5>
						<small>+8801711328179</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="week-product">
			<h2 class="item-name">Products From {{ $product->merchant->name }}</h2>
			<section class="customer-logos slider">
				@foreach ($product->merchant->products as $prod)
				<div class="slide">
					<a href="{{ url('product/'.$prod->slug) }}">
						@php
							$imgs = explode('|', $prod->images);
						@endphp
						<img src="{{ url('product_images/'.$imgs[0]) }}" class="image" style="height: 100px; width: auto;">
					</a>								
				</div>
				@endforeach
			</section>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active',responsive:true, imageCrossfade: true,}); 
$("#img_01").bind("click", function(e) {  
  var ez =   $('img_01').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});

</script>
<script>
	var initHight = $('.zoom').height();
	$('#gal1').css({"margin-top": initHight + 20 +'px'});
	$('.galImg').click(function(){
		setInterval(function(){ 
		var initHight = $('.zoomImg').height();
			$('#gal1').css({"margin-top": initHight + 20 +'px'});
		}, 500);
		
	});	
</script>
@endsection