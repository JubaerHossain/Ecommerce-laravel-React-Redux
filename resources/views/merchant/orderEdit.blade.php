@extends('layouts.master')
@section('title', 'Invoice')
@section('content')
<main role="main" class="col-md-12">
	<div class="dashboard-item">
    <input type="button" class="btn btn-outline-info m-3" onclick="printDiv('invoice')" value="Print Invoice" />
    <div id="invoice" style="font-size: 20px !important; width: 400px">
      <div class="row">
        <div class="col-md-12">

          <h4>Order Id: #{{ $order->id }}</h4>
          <p>Division: {{ $address->division }}</p>
          <p>District:  {{ $address->district }}</p>
          <p>city: {{ $address->city }}</p>
          <p>Street: {{ $address->street }}</p>
          <p>Full Address: {{ $address->address }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <table class="table">
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
              </tr>
              @foreach($cartProducts as $key =>$item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->price}}</td>
                  <td>{{$item->qty}}</td>
                  <td class="text-right">{{$item->price * $item->qty }}</td>
                </tr>
              @endforeach
                <tr>
                  <td colspan="4" class="text-right">Subtotal</td>
                  <td class="text-right">{{ $order->subtotal }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Shipping</td>
                  <td class="text-right">{{ $order->shipping }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Discount</td>
                  <td class="text-right">{{ $order->discount }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Grand Total</td>
                  <td class="text-right">{{ $order->total}}</td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
@section('script')
<script>
  function printDiv(divName) {
    const text = 'Thanks for ordering from Unistag. If you have any complain about this order, please call us at 01677723484 or mail us at '
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
@endsection