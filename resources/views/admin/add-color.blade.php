@extends('layouts.admin1')
@section('title','Colors')
@section('style')		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
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
		.swal2-popup .swal2-input {
    height: 40px !important;
   }
	 .swal2-popup .swal2-input, .swal2-popup .swal2-file, .swal2-popup .swal2-textarea, .swal2-popup .swal2-select, .swal2-popup .swal2-radio, .swal2-popup .swal2-checkbox {
    margin: 0 auto !important;
	 }
	 .swal2-title{
		font-size: 20px !important
    }
		.btn-info {
    background-color: #520e98 !important;
    border-color: #520e98 !important;
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
										<li><span>Add color</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('admin.storecolor') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Color name</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="E.g  Green" name="color">
						</div>
						<div class="form-group">
								<label for="exampleInputname">Color code</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="E.g  #ffffff" name="code">
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
							<th>Order</th>
							<th>Code</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($colors as $key => $c)
							<tr>
								<td>{{$c->color}}</td>
								<td class="show" onclick="edit({{$c->id}})">
											<span class="or" >{{$c->orders}}</span>						
									
								</td>
								<td> {{$c->code}} </td>
								<td>
								  <a href="{{ route('admin.editcolor', $c->id)}}">
									<button class="btn btn-sm btn-success">
										<i class="fa fa-edit"></i>
									</button>
								   </a>
								  
									 <button onclick="delePro({{$key}})" class="btn btn-danger btn-sm">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									 </button>
									 <form id="delete-form-{{ $key }}" action="{{ route('admin.delete', $c->id) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									 </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<?php echo $colors->render(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
@section('script')
<script src="{{asset('js/sweet-alert.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
			function edit(id) {
			swal({
					title: 'Order',
					input: 'text',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'save',
					confirmButtonClass: 'btn btn-info btn-sm',
					buttonsStyling: false,
					reverseButtons: true
			}).then((result) => {
					if (result.value) {
						console.log(id);
						
							event.preventDefault();	
							$.ajax({
											headers: {
															'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
														},
												type: 'post',
												url:'{{route('admin.orders')}}',	
												data: {
														orders:result.value,
														id    :id,
												},
												dataType : 'json',
												success: function(data) {	                       
                        location.reload();
												},
												error: function(xhr, status, error){
													var err = JSON.parse(xhr.responseText);
												toastr.error(err.message);
												toastr.options.timeOut = 600;
											}
										});  
					}
			})
	}
</script>
@endsection
