@extends('layouts.admin1')
@section('title','Sizes')
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
										<li><span>Size</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('admin.addWeight') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Size name</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ex: 100" name="name">
						</div>
						
					    <button type="submit" class="btn btn-primary mt-3 mb-3" style="background:#8818fd;">Submit</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped text-center">
						<thead style="background: rgb(0, 105, 217);color: #fff;">							
							<th>Name</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($weight as $key => $c)
							<tr>
								<td>{{$c->name}}</td>
								<td>								  
									 <button onclick="delePro({{$key}})" class="btn btn-danger btn-sm">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									 </button>
									 <form id="delete-form-{{ $key }}" action="{{ route('admin.deleteWeight', $c->id) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									 </form>
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
@section('script')
<script src="{{asset('js/sweet-alert.js')}}"></script>
<script>
				function delePro(id) {
			swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, do it!',
					cancelButtonText: 'No, cancel!',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
					buttonsStyling: false,
					reverseButtons: true
			}).then((result) => {
					if (result.value) {
							event.preventDefault();
							document.getElementById('delete-form-'+id).submit();
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
