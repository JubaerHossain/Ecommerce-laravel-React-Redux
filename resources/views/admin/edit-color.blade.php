@extends('layouts.admin1')
@section('title','Edit color')
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
										<li><span>Edit color</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('admin.updatecolor',$data->id) }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Color name</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$data->color}}" name="color">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Color order</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$data->orders}}" name="orders">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Color code</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$data->code}}" name="code">
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
