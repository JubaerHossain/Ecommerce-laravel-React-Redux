@extends('layouts.master')
@section('title','Edit product')
@section('style')
<link href="{{ url('/') }}/plugins/hamB-t.v.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('/') }}/css/product_j.css" rel="stylesheet" type="text/css">
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
.table td{
    border-top: 0;
}
.tblRow{
	border-bottom: 1px solid #000;
}
label{
		font-size: 16px;
	}
	.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(2.5); 
}

</style>
@endsection
@section('content')
<div class="">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('merchant.dashboard') }}">Home</a></li>
                    <li><span>Edit product</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<main role="main" class="col-md-12 ml-sm-auto">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		
		@include('partials._message')
	</div>
	<div class="dashboard-item pb-5">
		<div class="">							
			<div class="row">
			    <div class="card  bg-light col-md-12">
					<div class="card-body">
						<h5 class="card-title">Product Address</h5>
						<a href="{{ url('product/'.$product->slug) }}">{{ url('product/'.$product->slug) }}</a>
						<br><br>
						<h5 class="card-title">Meta Informationas</h5>
					</div>
                </div>			
				<div class="card bg-light col-md-12">
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
							<a class="nav-item nav-link {{$option == '#nav-home'? 'active show':''}}" id="basic-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic info</a>
							<a class="nav-item nav-link {{$option == '#nav-variation'?'active' :''}}" id="variation" data-toggle="tab" href="#nav-variation" role="tab" aria-controls="nav-contact" aria-selected="false">Variation</a>
							<a class="nav-item nav-link" id="info" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-about" aria-selected="false">Information</a>
						</div>
					</nav>
						<div class="tab-content px-3" id="nav-tabContent">
                           <div class="tab-pane fade show {{$option == 'nav-home'? 'active':''}}" id="nav-home" role="tabpanel" aria-labelledby="basic-tab">
								<form enctype="multipart/form-data" method="post" id="upload_form" action="{{route('merchant.productUpdate',$product->id)}}">
									@csrf

									<div class="row">
										<div class="col-md-6">
											<div class="form-group p-2">
												<label for="">Product Name</label>
												<input type="text" id="product_name" class="form-control" name="name" value="{{ $product->name }}"  maxlength="150">
											</div>
											<div class="row p-2">
												<div class="col-md">
													<div class="form-group">
														<label for="">Brand</label>
														<select class="js-example-tags custom-select" name="brand">
																<option value="no">Select brand</option>
															@foreach ($brand as $item)                                                            
															<option {{$item->name == $product->brand?'selected':'' }} value="{{$item->name}}">{{$item->name}}</option>
															@endforeach
															</select>
													</div>
												</div>
											</div>
											<div id="treeview_container" class="hummingbird-treeview">
												    <label class="pb-3">Category</label>
													<ul id="treeview" class="hummingbird-base pl-3">
													@foreach($categories as $c)
														<li>
															<i class="fa fa-plus"></i>
															<label>
																<!-- <input id="xnode-0" name="la-{{ $c->id }}" data-id="custom-0" type="checkbox" value="{{$c->id}}" /> --> {{$c->name}} - {{ $c->depth }}
															</label>
																<ul>
																@foreach($c->child as $d)
																	<li class="ml-3">
																		@if($d->child->first())
																		<i class="fa fa-plus"></i>
																		@endif
																			
																		<label>
		                                                                @if(!$d->child->first())                                                                            
																			<input  id="xnode-0-1" name="category" data-id="custom-0-1" type="radio" {{$product->category_id ==$d->id ? "checked" :''}} value="{{$d->id}}" />
		                                                                           @endif
		                                                                            
																					{{$d->name}} - {{ $d->depth }}
																		</label>
																		<ul>
																		@foreach($d->child as $e)
																			<li class="ml-3">
																				<label>
																				<input class="hummingbird-end-node" id="xnode-0-1-1" name="category" data-id="custom-0-1-1" type="radio" {{$product->category_id ==$e->id ? "checked" :''}} value="{{$e->id}}" />
																						{{ $e->name }} - {{ $e->depth }}
																				</label>
																			</li>
																		@endforeach
																		</ul>
																	</li>
																			@endforeach
																</ul>
															</li>
															@endforeach
													</ul>
											</div>
											<div class="form-group p-2">
												<button  type="submit"  class="btn btn-primary btn-sm" style="background:#8818fd;">save</button>
											</div>
										</div>																	   
								</form>
									<div class="col-md-6 pt-4">
										<label style="margin-left: -15px;">Default Image</label>
											<div class="form-inline">
                                                @php
													$imgs = explode('|', $product->images);													
												@endphp
												@if($imgs)
												<div class="col-md-12">
													<input type="hidden" id="key" name="key" value="{{count($imgs)}}">
														<table class="table">
															<thead>
															  <tr>
																<th scope="col">Image</th>
																<th scope="col"></th>
																<th scope="col">Action</th>
															  </tr>
															</thead>
															@foreach ($imgs as $key => $item)
															<tbody>
																  <tr>
																	<td>
																			<img class="zoom" src="{{ url('product_images/'.$item) }}" id="previewfil_{{$key}}"  height="50" style="height: 74px;">
																	</td>
																	<td>
																	<form action="{{route('merchant.productimage_update',$product->id)}}" method="POST" enctype="multipart/form-data">
																			{{ csrf_field() }}
																			<div class="upload-btn-wrapper">
																				<input type="hidden" name="key" value="{{$key}}">
																				<input type="hidden" name="img_name" value="{{$item}}">
																				<input type="file" name="images" onchange="previewFile({{$key}})">
																				<button class="t btn btn-success btn-sm">change</button>
																			 </div>
																			 <div>
																			 <button type="submit" class="btn btn-primary btn-sm" style="background:#8818fd;">save</button>
																			 </div>
																		</form>
																	</td>
																	<td>																							 
																		<button   onclick="deleDefault({{$key}})" class="btn btn-danger btn-sm">
																				<i class="fa fa-trash"></i>
																		</button>
																			
																	<form id="delete-form-{{ $key }}" action="{{route('merchant.delete_defaultimg',$product->id)}}" method="POST" style="display: none;">
																			@csrf
																			<input type="hidden" name="key" value="{{$key}}">
																			<input type="hidden" name="img_name" value="{{$item}}">
																			@method('DELETE')
																	</form>
																	</td>
																  </tr>
																  </tr>
															</tbody>
															@endforeach
														</table>
																
														</div>
														@endif
													<form action="{{route('merchant.productimage_add',$product->id)}}" method="POST" enctype="multipart/form-data">
														@csrf
														<table class="table">
																<thead>
																		<tr>
																		</tr>
																	</thead>
																	<tbody>
																		  <tr>
																			<td>
																				<div class="form-group">																							
																					<ul id="imgArray"></ul>
																				</div>
																			</td>
																			<td>
													              	<button  type="submit"  class="btn btn-primary btn-sm bt" id="bt" style="background:#8818fd;">Add image</button>
																			</td>
																			<td class="bttn">
																					<button type="button" class="btn btn-outline-info btn-sm" id="addButton"><i style="font-size:20px" class="far fa-images"></i></button>
																					<div class="form-group p-2">
																							
																					</div> 
																			</td>
																			</tr>
																	</tbody>
														</table>																                                                              
														</form>
												</div>
											</div>
                                   </div>
                                   </div>
								<div name="nav-variation" class="nav-variation tab-pane fade {{$option =='nav-variation'? 'show active':''}}" id="nav-variation" role="tabpanel" aria-labelledby="basic_btn">
										<div class="col-md-12 p-2" id="lol" style="padding-left:555px">
												<div class="pt-4">
													@if(count($product->colors)>0)
													<label class="font-weight-bold">Add color</label>              
													<div class="form-row align-items-center pb-5">
                                                       <form method="post" action="{{route('merchant.Color',$product->id)}}" enctype="multipart/form-data">
                                                              @csrf
																	<div class="row">
																		<div class="col-md-5 my-1">
																		<input type="file" id="Pimage" name="image" value="{{ old('image')}}">
																		</div>
																		<div class="col-md-5 my-1">
																			  <select class="custom-select mr-sm-2" id="Pcolor" name="name">
																						@foreach ($colorcode as $item)																			
																						<option value="{{$item->slug}}">{{$item->slug}}</option>
																						@endforeach
																				</select>
																		</div>
																		<div class="col-md-2 my-1">	
																			<input type="hidden" name="tab" value="nav-variation">														
																			<button type="submit" id="Color" class="btn btn-primary" style="background:#8818fd;">Add</button>
																		</div>
																	</div>
														</form>
														<table class="table">
																<thead><tr><th>Image</th><th>Color</th></tr></thead>
																@foreach ($product->colors as $key => $item)
																<input type="hidden" name="var_id[]" value="{{$item->id}}">
															      <tbody class="color">
																	<td scope="col"><img style='height:50px;' id="profile-img-tag" src="{{ url('product_variation/'.$item->image) }}" class="zoom"  alt="{{$item->image}}"></td>
																	<td scope="col">{{$item->name}}</td>	
																	<td>
																	<button   onclick="deleColr({{ $item->id }})" class="btn btn-danger btn-sm">
																						<i class="fa fa-trash"></i>
																	</button>
																		<form id="delete-form-{{ $item->id }}" action="{{ route('merchant.delete_Color_img',$item->id) }}" method="POST" style="display: none;">
																		@csrf
																		@method('DELETE')
																		</form>
																	</td>															
															    </tbody>
                                                                @endforeach
														</table>
                                                    </div> 
                                                    @endif
													<label class="font-weight-bold">Variation</label>
													<div class="table-responsive">
                                                   
													<table class="table" id="tbl">
															<form method="post" action="{{route('merchant.variation',$product->id)}}" enctype="multipart/form-data">
																			@csrf
												    	<input type="hidden" name="image" value="nav-variation">	
														<thead class="thead-light">                                                            
															<tr class="tt">
																<td></td>
																<td></td>
																<td width="12%">
																	<select class="custom-select" name="color" id="colorVariations">
																		@if (count($product->colors)>=1)
																		@foreach($product->colors as $key => $item)
																		<option value="{{$item->name}}">{{$item->name}}</option>
																		@endforeach
																		@else	
																		<option value="0">No Color</option>
																		@endif														
																	</select>
																</td>
																<td width="8%">
																		<select class="custom-select mr-sm-2" id="sizeVariation" name="Psize"> 
																				@foreach ($weight as $item)																		
																	    	<option value="{{$item->name}}">{{$item->name}}</option>
																				@endforeach
																		</select>
																		</td>
																<td width="12%">
																<select class="custom-select mr-sm-2" id="unitVariation" name="unit"> 
																	<option value="No">No unit</option>
																	<option value="Kg">kg</option>
																	<option value="liter">litre</option>
																	<option value="Pcs">pcs</option>
																	<option value="gm">gm</option>
																	<option value="ml">ml</option>
																</select>
																</td>
																<td scope="row"><input type="number" min="1" name="qty" id="qtyVariation" class="form-control" value="{{old('qty')}}"></td>
																<td scope="row"><input type="number" min="1" name="price" id="priceVariation" class="form-control" value="{{ old('price')}}"></td>
																<td><input type="number" min="1" name="v_price" id="v_priceVariation" class="form-control" value="{{ old('v_price')}}"></td>
																<td><input type="number" min="0" name="discount" id="discount" class="form-control" value="{{ old('discount')}}"></td>
																<td scope="row">
																	 <button type="submit" id="Allcolor" class="btn btn-primary" style="background:#8818fd;">Add</button>
																</td>
															</tr>
															<tr>
																<th scope="col">status</th>
																<th scope="col">Default</th>
																<th scope="col">Color</th>
																<th scope="col" width="12%">Size</th>
																<th></th>
																<th scope="col">Quantity</th>
																<th scope="col">Price</th>
																<th scope="col">V_Price</th>
																<th scope="col">Discount</th>
																<th scope="col">Action</th>
															</tr>
                              </thead>
														</form>
																@foreach ($product->variations as $key => $item)
														<tbody id="dynamicAllVariations">														
                                <tr>
																	<td><input type="checkbox" onclick="return false;"  value="1" {{$item->status == 1 ?'checked':''}}></td>																
															    <td><input type="radio" onclick="return false;" name="default" value="1" {{$item->onload==1?'checked':''}}></td>
																	<td>{{$item->color === "0"?'No':$item->color}}</td>
																	<td>{{$item->size}}{{$item->unit}}</td>
																	<td></td>
																	<td>{{$item->qty}}</td>
																	<td>{{$item->price}}</td>
																	<td>{{$item->v_price}}</td>
																	<td>{{$item->discount == "0" ?'No':$item->discount}}</td>
																	<td class="iconlink">
																		<i data-toggle="modal" data-target="#{{$item->id}}"  class="fa fa-edit"></i>                                                                    
																		<i onclick="deletevar({{ $item->id }})" class="fa fa-trash"></i>
																		<form id="delete-form-{{ $item->id }}" action="{{ route('merchant.delete_variation',$item->id) }}" method="POST" style="display: none;">
																		@csrf
																		<input type="hidden" name="p_id" value="{{$product->id}}">
																		@method('DELETE')
																		</form>
																	</td>
															</tr>
														</tbody>														

														@endforeach
												</table>
													</div>
												</div>                               
									</div>
									@foreach ($product->variations as $key => $p)	
									<div class="modal fade" id="{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Update varitaion</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<form action="{{route('merchant.variation_update',$p->id)}}" method="POST">
										@csrf
											<input type="hidden" name="product_id" value="{{$p->product_id}}">
										<div class="modal-body">
											<div class="form-group">
												
												<label for="recipient-name" class="col-form-label">Color:</label>
												<strong>{{$p->color}}</strong>
												<label for="message-text" class="col-form-label">Size:</label>
												<strong>{{$p->size}}</strong>												
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Status</label>
												<label class="radio-inline pl-3">
													<input type="radio" name="status" value="1" checked>Enable
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="0">Disable
												</label>
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Quantity:</label>
												<input type="text" class="form-control" name="qty" id="qtyVariation" value="{{$p->qty}}">
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Price:</label>
												<input type="text" class="form-control" name="price" id="qtyVariation" value="{{$p->price}}">
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">V_Price:</label>
												<input type="text" class="form-control" name="v_price" id="qtyVariation" value="{{$p->v_price}}">
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Discount:</label>
												<input type="text" class="form-control" name="discount" id="qtyVariation" value="{{$p->discount}}">
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<input type="checkbox" class="form-check-input" value="1"  {{$p->onload==1?'checked':''}} name="default">Default
												</label>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">save</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div>
									</form>
										</div>
									</div>
									</div>
									@endforeach
								</div>
								<div class="tab-pane fade {{$option =='nav-info'? 'show active':''}}" id="nav-info" role="tabpanel" aria-labelledby="Nextdetails">
							   <form action="{{route('propertyupdate',$product->id)}}" method="POST">
									@csrf
									<div class="p-2">
										<div class="form-group">
												<label>Product Details</label>
												<textarea class="form-control" id="details" rows="3" name="details">{{ $product->properties->description }}</textarea>
                   </div>
                    <div class="form-group">
											<label for="status">Product Status</label>
														<select name="status" id="status" class="custom-select">
                               <option value="1" {{$product->status =='1'?'selected': ''}}>Published</option>
                              <option value="0" {{$product->status =='0'?'selected': ''}}>Draft</option>
														</select>
										</div>             
									<button  type="submit" id="detail" class="btn btn-primary btn-sm" style="background:#8818fd;">save</button>
								</div>
							</form>
								</div>
								</div>
							</div>
				</div>
			</div>	
			</div>
		</div>
</main>
@endsection

@section('script')
<script src="{{ url('/') }}/plugins/hamB-t.v.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="{{asset('js/sweet-alert.js')}}"></script>
<script>
	$(".js-example-tags").select2({
      tags: true
    });
  function previewFile(event) {
	var preview = document.getElementById('previewfil_'+event);
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
		function deleDefault(id) {
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
		function deleColr(id) {
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
		function deletevar(id) {
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
$('#bt').hide();	
var index=0;

function addImgCtrl(){
   /*  index++; */
	var key=$('#key').val();	
	index=parseInt(key)+index;
	str = index.toString(),
	len = str.length;
	console.log(len);
	
	if(len==3){
	$('#addButton').css("display", "none");
	}
	
	if (index <= 2) {		
    $("#imgArray").append(createTemplate(index));
	}
}
function createTemplate(fileId){
	var li = $('<li><input class="dynoImg" type="file" name="images[]" onChange="previewImage(this);" id="file'+fileId+'"><label for="file'+fileId+'"  class="custom-file-upload"><img src="{{ url('image/Photo-icon.png') }}" style="width:54px" id="previewfile'+fileId+'"></lable> </li><br>');
    return li;
}
function previewImage(input) {
    if (input.files && input.files[0]) {		 
		
        var inputId = $(input).attr("id");var reader = new FileReader();
        reader.onload = function (e) {
          $('#preview'+inputId).attr('src', e.target.result).height(50);
					$('#bt').show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$(function(){
    // Add event hadler to the main button.
    $("#addButton").on("click",addImgCtrl);
});
</script>
|<script>
	
	$("#basic_btn").on('click',function(e){
	e.preventDefault();	
	
	var product_name=$('#product_name').val();
	/* var image=$('.dynoImg').val(); */
	var brand=$('#brand').val();
	var cat_id = document.getElementsByName('category');
	var category = $("input[name='category']:checked").val();	
	var catValue = false;
	console.log(category);
        for(var i=0; i<cat_id.length;i++){
            if(cat_id[i].checked == true){
                catValue = true;    
            }
        }
	if(product_name == "") {
	  toastr.error("Please enter product title");
      toastr.options.timeOut = 600;
      return false;
    }
	console.log(image);
	
	/* if(!image) {
	  toastr.error("Please enter product image");
      toastr.options.timeOut = 600;
      return false;
    } */	
	if(!catValue) {
	  toastr.error("Please select product category");
      toastr.options.timeOut = 600;
      return false;
    }

	});
</script>

<script>
	$("#treeview").hummingbird();
</script>
<script>

$('#detail').change(function(){
	var details=$('#detail').val();
	if(!details) {
	toastr.error("Please give description");
	toastr.options.timeOut = 600;
	return false;
	}

});
$('$Color').click(function(e){
	
	var color=$('#ttt').val();
	if(qty == 0) {
		e.preventDefault()
		toastr.error("you can't create color");
		toastr.options.timeOut = 600;
	}
})

   
</script>
@endsection