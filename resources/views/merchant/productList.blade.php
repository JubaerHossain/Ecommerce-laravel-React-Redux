@extends('layouts.master')
@section('title',' Products')
@section('content')
<div class="">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('merchant.dashboard') }}">Home</a></li>
                    <li><span>Product list</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
	<div class="container-fluid">
		<div class="row">
      <main role="main" class="col-md-12 m-b-50 ml-sm-auto {{-- col-lg-10 --}} pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h3 class="h2" style="font-size:20px"></h3>
          <a href="{{ route('merchantProductCreate') }}" class="btn btn-success">Add Product</a>
        </div>
  		  @if(Session::has('success'))
          <div class="alert alert-danger" role="alert">
            {!!Session::get('success')!!}
          </div>
        @endif
				<!--
				<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
				<div class="dashboard-item">
					<div class="table-responsive">
						<table class="table">
              <thead class="">
                <tr>
                  <th scope="col">SKU</th>
                  <th scope="col">Product name</th>
                  <th scope="col">Brand name </th>
                  {{-- 
                  <th scope="col">Customer Price</th>
                  <th scope="col">Vendor Price</th> --}}
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $key => $product)
                <tr>
                  <td class="coupon-code"><span class="code">{{ $product->id +100100 }}</span></td>
                  <td class="coupon-code">{{ $product->name }}</td>
                  <td class="coupon-code">{{ $product->brand }}</td>{{-- 
                  <td class="coupon-code">{{ $product->variations[0]->price }}</td> --}}
                  {{-- <td class="coupon-code">{{ $product->price }}</td> --}}
                  <td class="coupon-code">
                      @if (count($product->messages->where('receiver',Auth::user()->id))>0)									
											@foreach ($product->messages->where('receiver',Auth::user()->id) as $key => $value)
											@if($loop->last)
											 <a  href="{{route('merchant.message_see',$product->id)}}" class="btn text-white  {{$value->s_status==1?'btn-secondary':'btn-info'}} btn-sm" name="tabs" data-id="{{ $product->id }}">
											   <i class="{{$value->s_status == 1?'fas fa-envelope-open-text':'fa fa-envelope'}}"></i>
											</a>  		
								  		@endif
                      @endforeach
                      @elseif(count($product->messages->where('sender',Auth::user()->id))>0)
                      <a class="text-white btn btn-dark btn-sm"><i class="fa fa-envelope"></i></a>
											@else
											<a class="text-white btn btn-dark btn-sm"><i class="fa fa-exclamation-triangle"></i></a>
											@endif
                  	<a href="{{ route('merchant.productEdit', $product->id) }}" class="btn btn-primary btn-sm">
                  	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  	</a>
                  	<button onclick="delePro({{$key}})" class="btn btn-danger btn-sm">
                  	 <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <form id="delete-form-{{ $key }}" action="{{ route('deletMarProd', $product->id) }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                  </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <?php echo $products->render(); ?>
            </div>
		    </div>
			</main>
    </div>
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
               url: '/merchant/product-message/'+a,
               data: {},
               dataType : 'json',
               success: function(data) {
                 
                /* $(".close").click(function(){
                  setTimeout(5000);
                  location.reload();
                }); */
               }
           });
       });
   </script>
  @endsection