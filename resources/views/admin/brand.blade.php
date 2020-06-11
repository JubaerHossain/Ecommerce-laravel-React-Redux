@extends('layouts.admin1')
@section('title','Brand list')
@section('style')		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

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
	 i{
		 cursor: pointer;		 
	 }
	
	</style>
@endsection
@section('content')
<div class="pb-3">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Brand list</span></li>
								</ul>
						</div>
				</div>
		</div>
</div>
<main role="main" class="col-md-12">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
				@include('partials._message')	
		</div>
	<div class="dashboard-item">
		<div class="container">
			<div class="row pb-2">
					<div class="col-md-4 offset-md-3">
							<form action="{{ route('admin.add_brand') }}" method="POST">
								<div class="form-group row">
												@csrf
										<label class="col-md-4 col-form-label form-control-label">Brand name</label>
										<div class="col-lg-9">
												<select class="js-example-tags custom-select" name="brand">
												<option value="no">Select brand</option>
												@foreach ($brand as $item)                                                            
												<option  value="{{$item->name}}">{{$item->name}}</option>
												@endforeach
											  </select>
										</div>
									</div>
									<button type="submit" class="btn btn-info btn-sm">save</button>
								</form>
						</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped text-center">
						<thead style="background: rgb(0, 105, 217);color: #fff;">							
							<th>Name</th>
							<th>Order</th>
							<th>User id</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($brand as $key => $c)
							<tr>
								<td>{{$c->name}}</td>
								<td class="show" onclick="edit({{$c->id}})">
											<span class="or pr-4" data-id="{{$c->orders}}">{{$c->orders}}</span>	
											<i class="fa fa-edit"></i>					
									
								</td>
								<td class="show" onclick="user_id({{$c->id}})"> <span class="pr-4">{{$c->user_id}} </span>	<i class="fa fa-edit"></i>
								</td>
								<td>
									<button onclick="Approve({{$key}})" class="btn btn-sm {{$c->verified === 0 ?'btn-info':'btn-secondary'}}">
										<i class="{{$c->verified === 0 ?'fas fa-check':'fas fa-times'}}"></i>
									</button>
								</td>
								<td>
								  <a  href="{{ route('admin.edit_brand', $c->id)}}">
									<button class="btn btn-sm btn-success">
										<i class="fa fa-edit"></i>
									</button>
								   </a>
									
								  <form id="app-form-{{ $key }}" action="{{ route('adminApproveBrand', $c->id) }}" method="POST" style="display: none;">
										@csrf
										@method('POST')
									 </form>
								  
									 <button onclick="delePro({{$key}})" class="btn btn-danger btn-sm">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									 </button>
									 <form id="delete-form-{{ $key }}" action="{{ route('admin.brand_delete', $c->id) }}" method="POST" style="display: none;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script>
	$(".js-example-tags").select2({
      tags: true
    }); 
			function delePro(id) {
			swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete!',
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
				var name=$('.or').data("id");
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
												url:'{{route('admin.brand_orders')}}',	
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
												toastr.error('This data already taken');
												toastr.options.timeOut = 600;
											}
										});  
					}
			})
	}
			function user_id(id) {
			swal({
					title: 'User',
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
												url:'{{route('admin.user_id')}}',	
												data: {
														user_id:result.value,
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

	function Approve(id) {
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
								document.getElementById('app-form-'+id).submit();
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
