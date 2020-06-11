@extends('layouts.shop')
@section('title', " | Checkout")
@section('content')
@section('style')
<style>
	.checkout-form input{
		border: 0px;
		border-bottom: 2px solid; 
	}
	.form-control:focus {
		box-shadow: unset;
	    border-bottom:   2px solid rgb(0,123,255);
	}
</style>
@endsection
@include('partials._header')
<div class="container-fluid">
	
	<div class="row checkout-form">
		<div class="col-lg-6 offset-lg-1">
			@if(Session::has('success'))
			     <div class="alert alert-success" role="alert">
				  {!!Session::get('success')!!}
				</div>
			@endif
			@foreach($errors->all() as $message)
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        {{ $message }}
		    </div>
		    @endforeach
		    <form method="post" action="{{ route('checkoutBuyNow') }}">
			{{ csrf_field() }}
		    <div id="accordion">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">
			        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOneeeeee" aria-expanded="true" aria-controls="collapseOne">Shipping Address</button>
			      </h5>
			    </div>

			    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			      <div class="card-body">
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
					  <strong>Shipping Cost :</strong><br><br>
						<div class="custom-control custom-radio">
						  <input type="radio" id="customRadio1"  name="shipping" value="idk" class="custom-control-input" checked="checked">
						  <label class="custom-control-label" for="customRadio1">Inside Dhaka ( 60 tk ) </label>
						</div>
						<div class="custom-control custom-radio">
						  <input type="radio" id="customRadio2"  name="shipping" value="odk" class="custom-control-input">
						  <label class="custom-control-label" for="customRadio2">Outside Dhaka ( 120 tk )</label>
						</div>
					  <br>
					  <input type="hidden" name="pq" value="{{ $options['pq'] }}">
					  <input type="hidden" name="size" value="{{ $options['size'] }}">
					  <input type="hidden" name="id" value="{{ $product->id }}">
					  <div class="row">
					  	<div class="col-md-6">
							<div class="form-group">
							    <label for="address">Shipping Address</label>
							    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
							</div>
					  	</div>
					  	<div class="col-md-6">
							<div class="form-group">
								<label for="did">Dreamploy Id (If any)</label>
								<input type="text" class="form-control" id="did" name="did">
								@if($did)
									<h5>{{ $did }}</h5>
								@else
									<input type="text" class="form-control" id="did" name="did">
								@endif
							</div>			  		
					  		<button type="button" class="btn btn-info float-right" id="firstNext">Next Step</button>
					  	</div>
					  </div>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h5 class="mb-0">
			        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwoooo" aria-expanded="false" aria-controls="collapseTwo">Payment Status</button>
			      </h5>
			    </div>
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
			      <div class="card-body">
			      	<h5>বিকাশের মাধ্যমে টাকা পাঠানোর পদ্ধতিঃ</h5>
					<p>01777 18 05 26 (বিকাশ মার্চেন্ট) নম্বরে যেকোনো পার্সোনাল বিকাশ নম্বর থেকে PAYMENT করতে হবে। [Counter No: 1 ; Referance No: 1]</p>
					<p>01716967050 নম্বরে যেকোনো বিকাশ নম্বর থেকে PAYMENT করতে হবে।</p>
					<label for=""><strong>Payment Method</strong></label>
					<div class="custom-control custom-radio">
					  <input type="radio" name="pMethod"  value="bKash" class="custom-control-input" checked="checked">
					  <label class="custom-control-label" >bKash</label>
					</div>
					<br>
					<div class="row">
					  	<div class="col-md-6">
							<div class="form-group">
								<label for="district">Bkash Mobile No: </label>
								<input type="text" class="form-control" name="cashNumb" required>
							</div>
					  	</div>
					  	<div class="col-md-6">
						  	<div class="form-group">
							    <label for="phone">TnX ID: </label>
							    <input type="text" class="form-control" name="txnid" required>
							 </div>
					  	</div>
					</div>
					<div class="btn-group float-right" role="group" aria-label="Default button group">
					    <button type="button" class="btn btn-secondary btn-info" id="previous">Previous</button>
					    <button type="submit" class="btn btn-secondary btn-success">Checkout</button>
					</div>
					<br><br>
			      </div>
			    </div>
			  </div>
			</div>
		</form>
		</div>
		<div class="col-lg-3">
			<h4>Product You choosen</h4>
			<div class="card">
			  <ul class="list-group">
			  		@php
						$imgs = explode('|', $product->images);
					@endphp
			  		<img src="{{ url('product_images/'.$imgs[0]) }}" style="height:300px">
			    	<li class="list-group-item d-flex justify-content-between align-items-center" style="border-top:1px solid rgb(66, 65, 65)">
						{{ $product->product_name }}
						<span class="badge badge-primary badge-pill"><span id="sPrice">{{ $product->price }}</span>	Tk</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Size: <span class="badge badge-primary badge-pill">{{ $options['size'] }}</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Quantity <span class="badge badge-primary badge-pill"><span id="sQty">{{ $options['pq'] }}</span></span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Shipping Cost: <span class="badge badge-primary badge-pill"><span id="sCost">60</span> Tk</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Total <span class="badge badge-primary badge-pill"><span id="sTotal">{{ $options['pq'] * $product->price + 60}}</span> Tk</span>
		<div class="col-lg-4">
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
						<span class="badge badge-primary badge-pill"><span id="sPrice">{{ $cart->totalPrice }}</span>	Tk</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Shipping Cost: <span class="badge badge-primary badge-pill"><span id="sCost">60</span> Tk</span>
			    	</li>
			    	<li class="list-group-item d-flex justify-content-between align-items-center">
						Total <span class="badge badge-primary badge-pill"><span id="sTotal">{{ $cart->totalPrice + 60}}</span> Tk</span>
			    	</li>
			  </ul>
			</div>

		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function(){
		$('#customRadio1').click(function() {
		    if($('#customRadio1').is(':checked')) {
		    	calculate(60)
			}
		});
		$('#customRadio2').click(function() {
		    if($('#customRadio2').is(':checked')) {
		    	calculate(120)
			}
		});

		function calculate(cost){
			var price = $('#sPrice').text();
			var qty = $('#sQty').text();
			$('#sCost').text(cost);
			var total = price * qty + cost;
			$('#sTotal').text(total);
		}
		$('#firstNext').click(function(){
			$('#collapseTwo').addClass('show')
			$('#collapseOne').removeClass('show')
		});
		$('#previous').click(function(){
			$('#collapseOne').addClass('show')
			$('#collapseTwo').removeClass('show')
		});
	});
</script>
@endsection