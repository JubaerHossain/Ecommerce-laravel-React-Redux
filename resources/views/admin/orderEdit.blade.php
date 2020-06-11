@extends('layouts.admin1')
@section('title', 'Order edit')
@section('content')
<div class="pb-2">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Order edit</span></li>
								</ul>
						</div>
				</div>
		</div>
</div>
<main role="main" class="col-md-12"> 
  <div class="dashboard-item">
    <div class="row">
      <div class="col-md-4">
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
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Shippimg Address</h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Country : 
              <p>{{ $order->country }}</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              District : 
              <p>{{ $order->district }}</p>
            </li>
            <li class="list-group-item align-items-center">
              Address :
              <p>{{ $order->address }}</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Phone :
              <p>{{ $order->phone }}</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Shippimg Status</h5>
            <span class="badge badge-primary badge-pill px-3"><h5>{{ $order->status }}</h5></span>
            <br><br>
            <h5 class="card-title">Change Status: @if($order->didpaid == 1) Approved @else Not Approved @endif</h5>
            <a href="{{ route('changePmntStatus', $order->id) }}" class="btn btn-success">Approve Payment</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
@endsection