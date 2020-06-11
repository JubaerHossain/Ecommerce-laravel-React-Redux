@extends('layouts.admin1')
@section('title','Edit brand')
@section('style')
<link href="{{ url('/') }}/css/product_j.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Edit brand</span></li>
								</ul>
						</div>
				</div>
		</div>
</div>
<main role="main" class="col-md-12">

	<div class="dashboard-item">
		<div class="container">
			<div class="row">
				<div class="col-md-4 offset-md-3">
					@include('partials._message')
					<form class="mx-auto" method="post" action="{{ route('admin.update_brand',$brand->id) }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Brand name</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$brand->name}}" name="name">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Brand user id</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$brand->user_id}}" name="user_id">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Brand orders</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$brand->orders}}" name="orders">
						</div>
					    <button type="submit" class="btn btn-primary mt-3 mb-3" style="background:#8818fd;">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
@section('script')

@endsection
