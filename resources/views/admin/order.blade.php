@extends('layouts.admin1')
@section('title', 'Order')
@section('content')
<div class="pb-2">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Order list</span></li>
								</ul>
						</div>
				</div>
		</div>
</div>
      <main role="main" class="col-md-12">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
					
{{--   <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
  </form> --}}
				</div>
				<!--
				<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
				<div class="dashboard-item">
					<div class="table-responsive">
						<table class="table">
  <thead class="">
    <tr>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Address</th>
      <th scope="col">Patment Method</th>
      <th scope="col">Phone</th>
      <th scope="col">Txn ID</th>
      <th scope="col">Order Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="order">
    @foreach($orders as $order)
    <tr>
      <td>{{ $order->email }}</td>
		  <td class="status">{{ $order->status }}</td>
      <td>{{ $order->address }}</td>
      <td>{{ $order->pMethod }}</td>
      <td>{{ $order->cashNumb }}</td>
      <td>{{ $order->txnid }}</td>
		  <td>{{ $order->total }}</td>
      <td class="coupon-code">
      	<a href="{{ route('adminOrderEdit', $order->id) }}" class="btn btn-primary">
      	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      	</a>
      	<a href="" class="btn btn-danger">
      	 <i class="fa fa-trash-o" aria-hidden="true"></i>
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
		</div>
		    	</div>

			</main>
      @endsection
  
