@extends('layouts.master')
@section('style')
<link href="{{ url('/') }}/plugins/hamB-t.v.css" rel="stylesheet" type="text/css">

@endsection
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Add Product Category</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
		</div>
	</div>
	<!--
	<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
	<div class="dashboard-item">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped text-center">
						<thead style="background: rgb(0, 105, 217);color: #fff;">
							<th>ID</th>
							<th>Name</th>
							<th>Parent</th>
							<th>Action</th>
						</thead>
						<tbody>
							<div id="catListing">
								@foreach($categories as $c)
									<tr>
										<td>{{$c->id}}</td>
										<td>{{$c->name}}</td>
										<td> {{ $c->father ? $c->father->name : 'Root Category' }} </td>
										<td>
										  <a href="{{ route('adminEditCategory', $c->id)}}">
											<button class="btn btn-sm btn-success">
												<i class="fa fa-edit"></i>
											</button>
										   </a>
										</td>
									</tr>
								@endforeach
						</tbody>
					</table>
						<div id="treeview_container" class="hummingbird-treeview">
							<form action="{{ route('getMerchantCategories') }}" method="POST">
								@csrf
						    	<ul id="treeview" class="hummingbird-base">
						    		@foreach($categories as $c)
								    <li>
										<i class="fa fa-plus"></i>
										<label><input id="xnode-0" name="la-{{ $c->id }}" data-id="custom-0" type="checkbox" value="{{$c->id}}" /> {{$c->name}} - {{ $c->depth }} </label>
										<ul>
											@foreach($c->child as $d)
										    <li>
												<i class="fa fa-plus"></i>
												<label>
												    <input  id="xnode-0-1" name="la-{{ $d->id }}" data-id="custom-0-1" type="checkbox" value="{{$d->id}}" />{{$d->name}} - {{ $d->depth }}
												</label>
												<ul>
													@foreach($d->child as $e)
												    <li>
														<label><input class="hummingbird-end-node" id="xnode-0-1-1" name="la-{{ $e->id }}" data-id="custom-0-1-1" type="checkbox" value="{{$e->id}}" /> {{ $e->name }} - {{ $e->depth }}</label>
												    </li>
												    @endforeach
												</ul>
										    </li>
										    @endforeach
										</ul>
								    </li>
								    @endforeach
								</ul>
								<input type="submit" value="Cats" class="mt-3">
							</form>
					    </div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection


@section('script')
<script src="{{ url('/') }}/plugins/hamB-t.v.js"></script>
<script>
	$("#treeview").hummingbird();
</script>
@endsection