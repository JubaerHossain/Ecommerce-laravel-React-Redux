@extends('layouts.admin1')
@section('title','Edit category')
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
										<li><span>Edit Category</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('postCategoryEdit',$data->id) }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Category name</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$data->name}}" name="name">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Category icon</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="e. g : fas fa-edit" value="{{$data->icon}}" name="icon">
						</div>
						<div class="form-group">
						<label for="Parent">Parent category</label>
						<select name="parent" class="custom-select">
							<option value="0">Root Level</option>
							@foreach($categories as $c)							
							<option {{$c->id == $data->parent?'selected':''}} value="{{$c->id}}">{{ $c->id == $data->parent?$c->name:$c->name }}</option>
							@endforeach
						</select>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" value="1" id="exampleCheck1" name="central" {{$data->central == 1 ? "checked" :''}}>
							<label class="form-check-label" for="exampleCheck1">Central Category</label>
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
