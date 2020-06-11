@extends('layouts.admin1')
@section('title','Categories')
@section('style')
		
<style>
		#imgArray input[type="file"] {
			display: none;
		}
		.custom-file-upload {
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
			cursor: pointer;
		}
		#imgArray li{
			display: inline-block;
			list-style: none;
		}
		.active img {
			border: 2px solid #333 !important;
		}
	
	</style>
@endsection
@section('content')
<div class="">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Add Category</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('postAdminProductCategory') }}">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Category name</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="e.g : Men shirt" name="name">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Category icon</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder=" e.g : fa fa-home" name="icon">
						</div>
						<div class="form-group">
						<label for="Parent">Parent category</label>
						<select name="parent" class="custom-select">
							<option value="0">Root level</option>
							@foreach($categories as $c)
							<option value="{{$c->id}}">{{ $c->name }}</option>
							@endforeach
						</select>
						</div>						
						<div class="form-check">
							<input type="checkbox" class="form-check-input" value="1" id="exampleCheck1" name="central">
							<label class="form-check-label" for="exampleCheck1">Central Category</label>
						</div>
												
					    <button type="submit" class="btn btn-primary mt-3 mb-3" style="background:#8818fd;border-color:#8818fd">Submit</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped text-center">
						<thead style="background: rgb(0, 105, 217);color: #fff;">
							<th>ID</th>
							<th>Name</th>
							<th>Parent</th>
							<th>Icon</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($categories as $c)
							<tr>
								<td>{{$c->id}}</td>
								<td>{{$c->name}}</td>
								<td>{{ $c->father ? $c->father->name : 'Root Category' }} </td>
								<td><i class="{{$c->icon}}"></i></td>
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
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
