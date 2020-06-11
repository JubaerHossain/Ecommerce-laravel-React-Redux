@extends('layouts.master')
@section('title', 'Order')
@section('content')
<main role="main" class="col-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders</h1>
    <form class="form-inline mt-2">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  <div class="dashboard-item">
    <div class="table-responsive">
      <table class="table">
        <thead class="">
          <tr>
            <th scope="col">Email</th>
            <th scope="col">Patment Method</th>
            <th scope="col">Phone</th>
            <th scope="col">Order Total</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="order">
          @foreach($orders as $key => $order)
          <tr>
            <td>{{ $order->email }}</td>
            <td>{{ $order->methos }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->total }}</td>
            <td class="status">
              @if($order->status ==  0)
              <button onclick="Deliver({{$key}})" class="btn btn-primary btn-sm">
                  	 <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                <form id="deliver-form-{{ $key }}" action="{{ route('changeStatus', $order->id) }}" method="GET" style="display: none;">
                      @csrf
                      @method('GET')
                  </form>
             @else
             <button  class="btn btn-secondary btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
             @endif
            </td>
            <td class="coupon-code">
              <a href="{{ route('orderEdit', $order->id) }}" class="btn btn-primary">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
@section('script')
  <script src="{{asset('js/sweet-alert.js')}}"></script>
  <script>
      		function Deliver(id) {
				swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, Deliver it!',
						cancelButtonText: 'No, cancel!',
						confirmButtonClass: 'btn btn-success',
						cancelButtonClass: 'btn btn-danger',
						buttonsStyling: false,
						reverseButtons: true
				}).then((result) => {
						if (result.value) {
								event.preventDefault();
								document.getElementById('deliver-form-'+id).submit();
						} else if (
								result.dismiss === swal.DismissReason.cancel
						) {
								swal(
										'Cancelled',
										'Your data is safe :)',
										'error'
								)
						}
				})
		}
  </script>
  @endsection
