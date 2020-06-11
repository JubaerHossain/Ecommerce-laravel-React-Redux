@extends('layouts.admin1')
@section('title','Slide list')
@section('content')
<div class="pb-2">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Slide list</span></li>
								</ul>
						</div>
				</div>
		</div>
</div>
	<div class="container-fluid">
		<div class="row">		
			<main role="main" class="col-md-12">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
							<h3 class="h2" style="font-size:20px"></h3>
							<a href="{{ route('admin.add_slide') }}" class="btn btn-success">Add slide</a>
						</div>
						@include('partials._message')	
				<div class="dashboard-item">
					<div class="table-responsive">
						<table class="table">
							<thead class="">
								<tr>
									<th scope="col">Sl No</th>
									<th scope="col">Title</th>
									<th scope="col">Image</th>
									<th scope="col">description</th>
									<th>Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($slides as $key => $item)
								<tr>
								<td class="coupon-code"><span class="code">{{$key+1}}</span></td>
								<td class="coupon-code">{{$item->title}}</td>
								<td class="coupon-code">{{ str_limit($item->description,'62')}}</td>
								<td width="20%">
							  	<img src="{{url('slide/'.$item->image)}}" alt="{{$item->image}}" width="30%" class="img-fluid">
								</td>
								<td>
									<button onclick="Approve({{$key}})" class="btn btn-sm {{$item->status == 0 ?'btn-info':'btn-secondary'}}">
										<i class="{{$item->status == 0 ?'fas fa-check':'fas fa-times'}}"></i>
									</button>
									<form id="app-form-{{ $key }}" action="{{ route('adminApproveSlide', $item->id) }}" method="POST" style="display: none;">
										@csrf
										@method('POST')
									 </form>
								</td>
									
									<td class="coupon-code">
											
										<a href="{{route('admin.edit_slide',$item->id)}}" class="btn btn-primary btn-sm">
										<i class="fa fa-edit" aria-hidden="true"></i>
										</a>
										
										<a href="#" onclick="delePro({{$key}})" class="btn btn-danger btn-sm">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
										</a>
									<form id="delete-form-{{$key}}" action="{{route('admin.delete_slide',$item->id)}}" method="POST" style="display: none;">
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

			</main>
		
	</div>
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
						confirmButtonText: 'Yes, delete it!',
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
   <script> 
    $("a[name=tabs]").on("click", function () { 
               var a = $(this).data("id"); 
               var modal=$('.modal')              
    
         $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
               type: 'post',
               url: '/admin/message-status/'+a,
               data: {},
               dataType : 'json',
               success: function(data) {
                 console.log(data);
                 
                /* $(".close").click(function(){
                  setTimeout(5000);
                  location.reload();
                }); */
               }
           });
       });
   </script>
  @endsection