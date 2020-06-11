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
		    <form method="post" action="{{ route('checkoutOrder') }}">
			{{ csrf_field() }}
		    <div id="accordion">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h4 class="mb-0">Order Details</h4>
			    </div>
			    <div class="card-body">
			      <h5 class="mb-0">Order Number: #{{ $order->id + 100100 }}</h5>
			      <br><br>
			      <div class="row">
				  	<div class="col-md-6">
						<p><strong>Email address: {{ $order->email }}</strong></p>	
				  	</div>
				  	<div class="col-md-6">
					  	<p><strong>District: {{ $order->district }}</strong></p>	
				  	</div>
				  </div>
				  <div class="row">
				  	<div class="col-md-6">
						<p><strong>Phone: {{ $order->phone }}</strong></p>	
				  	</div>
				  	@php
	                  if($order->shipping == 'odk'){
	                    $scost = 120;
	                    $method = 'Outside Dhaka';
	                  }else{
	                    $scost = 60;
	                    $method = 'Inside Dhaka';
	                  }
	                @endphp
				  	<div class="col-md-6">
					  	<p><strong>Shipping({{ $method }}): {{ $scost }}</strong></p>	
				  	</div>
				  </div>
				  <div class="row">
				  	<div class="col-md-6">
					  	<p><strong>Shipping Address: {{ $order->address }}</strong></p>	
				  	</div>
				  	<div class="col-md-6">
					  	<p><strong>Dreamploy Id: {{ $order->did }}</strong></p>	
				  	</div>
				  </div>
				  <div class="row">
					  	<div class="col-md-6">
					  		<p><strong>Bkash Mobile No: {{ $order->cashNumb }}</strong></p>
					  	</div>
					  	<div class="col-md-6">
					  		<p><strong>TnX ID: {{ $order->txnid }}</strong></p>
					  	</div>
					</div>
			    </div>
			  </div>
			</div>
		</form>
		</div>
		<div class="col-lg-4">
			<h4>Your Shopping Cart</h4>
			<div class="card">
			  <ul class="list-group">
	            @foreach($order->products as $item)
	              <li class="list-group-item d-flex justify-content-between align-items-center">
	              <p>{{$item->name}} ( {{$item->dp}} * {{$item->qty }} )
	              <br>Size: {{ $item->size }}</p>
	              <span class="badge badge-primary badge-pill">{{$item->dp * $item->qty }}</span>
	              </li>
	            @endforeach
	              <li class="list-group-item d-flex justify-content-between align-items-center" style="border-top:1px solid rgb(66, 65, 65)">
	                Sub-total:
	              <span class="badge badge-primary badge-pill"><span id="sPrice">{{ $order->subtotal }}</span> Tk</span>
	              </li>
	              <li class="list-group-item d-flex justify-content-between align-items-center">
	                @php
	                  if($order->shipping == 'odk'){
	                    $scost = 120;
	                  }else{
	                    $scost = 60;
	                  }
	                @endphp
	              Shipping Cost({{ $order->shipping }}): <span class="badge badge-primary badge-pill"><span id="sCost">{{ $scost }}</span> Tk</span>
	              </li>
	              <li class="list-group-item d-flex justify-content-between align-items-center">
	              Total <span class="badge badge-primary badge-pill"><span id="sTotal">{{ $order->total + + $scost}}</span> Tk</span>
	              </li>
	          </ul>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')

@endsection