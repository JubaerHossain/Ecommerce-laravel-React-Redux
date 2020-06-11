@extends('layouts.master')
@section('title','Add Product')
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
	.active img {
		border: 2px solid #333 !important;
	}
	label{
		font-size: 16px;
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
                    <li><span>Add New product</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<main role="main" class="col-md-12 m-b-50 ml-sm-auto {{-- pt-3 px-4 --}}">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		@include('partials._message')	
	</div>
	<div class="dashboard-item pb-5">
		<div class="">
		<form enctype="multipart/form-data" method="post" id="upload_form" action="{{ route('merchantCreateProduct') }}">
				@csrf
			<div class="row">
				<div class="card bg-light {{-- p-2 --}} col-md-12">
						<nav>
							<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="basic-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic info</a>
								<a style="cursor: not-allowed;" class="nav-item nav-link" id="variation" data-toggle="tab" href="#nav-variation" role="tab" aria-controls="nav-contact" aria-selected="false">Variation</a>
								<a style="cursor: not-allowed;" class="nav-item nav-link" id="info" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-about" aria-selected="false">Information</a>
							</div>
						</nav>
						<div class="tab-content {{-- py-3 px-3 px-sm-0 --}}" id="nav-tabContent" style="border:0">
								<div class="nav-home tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="basic-tab">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group p-2">
												<label for="">Product Name</label>
												<input type="text" id="product_name" class="form-control" name="name" maxlength="150">
											</div>
											<div class="form-group">
												<label for="">Brand</label>
												<select class="js-example-tags custom-select" name="brand">
														<option value="no">Select brand</option>
													@foreach ($brand as $item)                                                            
													<option {{$item->name === Auth::user()->marchant->brand?'selected':'' }} value="{{$item->name}}">{{$item->name}}</option>
													@endforeach
												  </select>
											</div>
											<div id="treeview_container" class="hummingbird-treeview">
												<label class="pb-3">Category</label>
												<ul id="treeview" class="hummingbird-base px-2">
													@foreach($categories as $c)
													<li class="lol">
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
																			<input  id="xnode-0-1" class="ml-1" name="category" data-id="custom-0-1" type="radio" value="{{$d->id}}" />
																			@endif
																			{{$d->name}} - {{ $d->depth }}
																	</label>
																	<ul>
																		@foreach($d->child as $e)
																			<li class="ml-3">
																			<label class="">
																				<input class="hummingbird-end-node" id="xnode-0-1-1" name="category" data-id="custom-0-1-1" type="radio" value="{{$e->id}}" />
																				{{ $e->name }} - {{ $e->depth }}</label>
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
										</div>
										<div class="col-md-6">
											<div class="col-md pt-4">
											   <label style="margin-left: -15px;">Default Image</label>
												<div class="form-inline pt-4">
													<div class="form-group">
														<ul id="imgArray"></ul>
														<button type="button" class="btn btn-outline-info btn-sm" id="addButton"><i style="font-size:20px" class="far fa-images"></i></button>
													</div>
												</div>
										    </div>
										</div>			
										</div>
										<div class="col-md pt-2">
											<div class="form-group">
													<div class="nav nav-tabs nav-fill float-right" id="nav-tab" role="tablist">
														<a type="button" class="btn btn-primary nav-item nav-link text-white" id="basic_btn" data-toggle="tab" href="#nav-variation" role="tab" aria-controls="nav-contact" aria-selected="false" style="background:#8818fd;">Next</a>
													</div>
											</div>
										</div>	
																			
								</div>
								<div class="nav-variation tab-pane fade" id="" role="tabpanel" aria-labelledby="basic_btn">
										<div class="col-md-12 p-2 pt-4" id="lol" style="padding-left:555px">
												<div class="pt-5">
													<button type="button" id="colr_variation_show" class="btn btn-primary btn-sm">Color variation</button>
													<button type="button" id="colr_variation_hide" class="btn btn-primary btn-sm">Color variation</button>													
													<h6 class="textt font-weight-bold">Add color</h6>
													<div class="form-row align-items-center pb-5" id="addcolr">
														<div class="col-md-5 my-1">
															<input type="file" id="Pimage" name="Pimage">
														</div>
														<div class="col-md-5 my-1">
															<select class="custom-select mr-sm-2" id="Pcolor" name="Pcolor">
																@foreach ($colorcode as $item)																			
																<option value="{{$item->slug}}">{{$item->slug}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-2 my-1">															
															<button type="button" id="Color" class="btn btn-primary">Add</button>
														</div>
														<table class="table">
															<thead><tr><th>Image</th><th>Color</th></tr></thead>
															<tbody class="color" id="dynamicColors">
																@if(Session::has('color'))
																@foreach(Session::get('color') as $color)
																<tr>
																	<td scope="col"><img style='height:50px;' src="/uploads/{{$color['image']}}"></td>
																	<td scope="col">{{$color['color']}}</td>
																</tr>
																@endforeach
																@endif
															</tbody>
														</table>
													</div>

													<h6 class="font-weight-bold">Variation</h6>
													<div class="table-responsive">
													<table class="table" id="tbl">
														<thead class="thead-light">															
															<tr class="td">
																<td></td>
																<td width="12%" class="colorr">
																<select class="custom-select  colr" name="color" id="colorVariations" style="width:96px">
																	<option value="0">No Color</option>
																	@if(Session::has('color'))
																	@foreach(Session::get('color') as $color)
																	<option value="{{$color['color']}}">{{$color['color']}}</option>
																	@endforeach
																	@endif
																</select>
																</td>
																<td width="10%">
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
																<td><input type="number" min="1" name="qty" id="qtyVariation" class="form-control"></td>
																<td><input type="number" min="1" name="priceVariation" id="priceVariation" class="form-control"></td>
																<td><input type="number" min="1" name="v_priceVariation" id="v_priceVariation" class="form-control"></td>
																<td><input type="number" min="0" name="discount" id="discount" class="form-control"></td>
																<td>
																	<button type="button" id="Allcolor" class="btn btn-primary">Add</button>
																</td>
															</tr>
															<tr>
																<th scope="col">Default</th>
																<th scope="col">Color</th>
																<th class="not"></th>
																<th scope="col" width="12%">Size</th>
																<th scope="col">Quantity</th>
																<th scope="col">Price</th>
																<th scope="col">V_Price</th>
																<th scope="col">Discount</th>
																<th scope="col">Action</th>
															</tr>
														</thead>
														<tbody id="dynamicAllVariations">
																@if(Session::has('size'))
																@php
																	$allVar = Session::get('size');
																	$arr = rsort($allVar);
																@endphp
																@foreach(Session::get('size') as $key => $size)
																<tr class="tblRow">
																	<td scope="col">{{$size['color']}}</td>
																	<td>{{$size['size']}}</td>
																	<td>{{$size['qty']}}</td>
																	<td>{{$size['price']}}</td>
																	<td>{{$size['v_price']}}</td>
																	<td><i onClick="onDeleteClick({{$key}})" class="fa fa-trash"></i>{{$key}}</td>
																</tr>
																@endforeach
																@endif
														</tbody>
													</table>
													</div>
													<div class="nav nav-tabs nav-fill float-right" id="nav-tab" role="tablist">
														<a type="button" class="btn btn-primary nav-item nav-link text-white" id="Nextdetails" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-about" aria-selected="false" style="background:#8818fd;">Next</a>
													</div>
												</div>                               
									</div>
								</div>
								<div class=" tab-pane fade des" id="" role="tabpanel" aria-labelledby="Nextdetails">
									<div class="p-2">
										<div class="form-group">
											<label>Product Details</label>
											<textarea class="form-control" id="details" rows="3" name="details"></textarea>
										</div>
										<div class="form-group">
											<label for="status">Product Status</label>
											<select name="status" id="status" class="custom-select">
												<option value="1">Published</option>
												<option value="0">Draft</option>
											</select>
										</div>
									<button  type="submit" id="detail" class="btn btn-primary m-b-50" style="background:#8818fd;">Add Product</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
				
			</form>
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
	$('#basic-tab').click(function(){
	$('.nav-info').removeAttr('id', 'nav-info');
	$('.nav-variation').removeAttr('id', 'nav-variation');
	$('.nav-home').addClass('active show');
	$('.nav-variation').removeClass('active show');
	$('.nav-info').removeClass('active show');
	});
	$('#variation').click(function(){
	var image=$('.dynoImg').val();	
	if(image.match(/(?:jpg|png|PNG|jpeg)$/)){
	$('.nav-home').removeAttr('id', 'nav-home');
	$('.nav-variation').addClass('active show');
	$('.nav-home').removeClass('active show');
	$('.nav-info').removeClass('active show');
	$('.nav-info').removeAttr('id', 'nav-info');
	}
	});
	$('#info').click(function(){
		var def = $('#dynamicAllVariations').find('input[name="defVar"]').is(':checked');	
		if(def == false) {
		toastr.error("Please fill up varition before");
        toastr.options.timeOut = 2000;
    }else{
		$('.nav-variation').removeAttr('id', 'nav-variation');
		$('.nav-variation').removeClass('active show');
		$('.nav-home').removeAttr('id', 'nav-variation');
		$('.nav-home').removeClass('active show');
		$('.nav-info').addClass('active show');
		}
	});
	$('#colr_variation_hide').each(function(){
		$(this).css("display", "none");
   });
   $('#colr_variation_show').each(function(){
		$(this).css("margin-top", "-50px");
		$(this).css("margin-bottom", "20px");
	});	
	$('#addcolr').hide();
	$('.textt').hide();
	$(".colorr").css("display","none");
	$('#tbl').find("tr th:nth-child(2)").each(function(){
		$(this).css("display", "none");
   });  
var index=0;
function addImgCtrl(){
    index++;
	if (index <= 3) {		
    $("#imgArray").append(createTemplate(index));
	}
}
function createTemplate(fileId){
	var li = $('<li><input class="dynoImg" type="file" name="images[]" onChange="previewImage(this);" id="file'+fileId+'"><label for="file'+fileId+'"  class="custom-file-upload"><img src="{{ url('image/Photo-icon.png') }}" height="50" id="previewfile'+fileId+'" style="width:54px"></lable> </li>');
    return li;
}
function previewImage(input) {
    if (input.files && input.files[0]) {
		const file = input.files[0];
		const fileType = file['type'];
        var inputId = $(input).attr("id");var reader = new FileReader();
		const validImageTypes = ['image/jpeg','image/jpg', 'image/png'];
		if (!validImageTypes.includes(fileType)) {
			toastr.error("Image type must be jpg , jpeg, png");
			toastr.options.timeOut = 600;
				return false;
      }else{
		reader.onload = function (e) {
          $('#preview'+inputId).attr('src', e.target.result).height(50);
        };
        reader.readAsDataURL(input.files[0]);
	  }
       
    }
}
$(function(){
    // Add event hadler to the main button.
    $("#addButton").on("click",addImgCtrl);
});
</script>
|<script>
	document.getElementById("variation").disabled = true;
	document.getElementById("info").disabled = true;
	$("#basic_btn").on('click',function(e){
	e.preventDefault();		
	var product_name=$('#product_name').val();
	var image=$('.dynoImg').val();		
	var brand=$('#brand').val();
	var cat_id = document.getElementsByName('category');
	var category = $("input[name='category']:checked").val();	
	var catValue = false;
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
		
	if(!image) {
	  toastr.error("Please enter product image");
      toastr.options.timeOut = 600;
      return false;
    }
	if(!catValue) {
	  toastr.error("Please select product category");
      toastr.options.timeOut = 600;
      return false;
    }	
	if (!image.match(/(?:jpg|png|PNG|jpeg)$/)) {
		toastr.error("Image type must be jpg , jpeg, png");
		toastr.options.timeOut = 600;
		return false;
    }else{
	 document.getElementById("variation").disabled = false;	
	$('.nav-variation').attr('id', 'nav-variation');
	$('#basic-tab').removeClass('active show');
	$('.nav-home').removeClass('active show');
	$("#variation").addClass('active');
	$("#nav-variation").addClass('active show');
	$("#variation").css("cursor", "pointer"); 
	}	
	});
</script>

<script>
	$("#treeview").hummingbird();
	

</script>
<script> 
 $("#Color").click(function(e){
		e.preventDefault(); 
		var color = document.getElementById("colorVariations").value;					
		var qty = document.getElementById("qtyVariation").value;					
		var img=$('#Pimage').val();
		var color=$('#Pcolor').val();
		console.log(color);					
		if(!img) {
		toastr.error("Please select Image");
		toastr.options.timeOut = 600;
		return false;
		}
		if(color == '0') {
		toastr.error("Please select color");
		toastr.options.timeOut = 600;
		return false;
		}					
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			url:'{{route('merchant.Pcolor')}}',						
			contentType: false,
			processData: false,
			data:new FormData($("#upload_form")[0]),
			success:function(data){
				console.log(data);				
				const colors = JSON.parse(data.colors);
				console.log(colors)							
				var table = document.getElementById("dynamicColors").innerHTML = ' ' ;
				var table = document.getElementById("colorVariations").innerHTML = ' ' ;
				colors.map((d, i) => {
					createTableRow(d);
					createSelectOprions(d);
				});
			},
			error: function(data){
				toastr.error(data.responseText);
				toastr.options.timeOut = 600;
			}
		});
		
   });
	function createTableRow(d){
		var table = document.getElementById("dynamicColors");
		var row = table.insertRow(0);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		cell1.innerHTML = `<img style='height:50px;' src='/uploads/${d.image}'>`;
		cell2.innerHTML = d.color;
	}
	function createSelectOprions(d){
		var select = document.getElementById("colorVariations");
		var option = document.createElement("option");
		option.text = d.color;
		option.value = d.color;
		select.appendChild(option);
	}
</script>
<script>
$("#Allcolor").click(function(e){	
	var color = document.getElementById("colorVariations").value;
	var size = document.getElementById("sizeVariation").value;
	var unit = document.getElementById("unitVariation").value;
	var qty = document.getElementById("qtyVariation").value;
	var price = document.getElementById("priceVariation").value;
	var v_price = document.getElementById("v_priceVariation").value;
	var discount = document.getElementById("discount").value;
	if(color == 0){$('#Color').prop("disabled",true);}
	var formData = new FormData();
	formData.append('color', color);
	formData.append('size', size);
	formData.append('unit', unit);
	formData.append('qty', qty);
	formData.append('price', price);
	formData.append('v_price', v_price);
	formData.append('discount', discount);
	
	if(qty == "") {
	toastr.error("Please select quantity");
      toastr.options.timeOut = 600;
    }	
	if(price == "") {
	toastr.error("Please select price");
      toastr.options.timeOut = 600;
      return false;
    }	
	if(v_price == "") {
	toastr.error("Please select v_price");
      toastr.options.timeOut = 600;
      return false;
    }		
		if (parseInt(price) > parseInt(v_price)) {
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				url:'{{route('merchant.psize')}}',
				contentType: false,
				processData: false,
				data:formData,
				success:function(data){
					const sizes = JSON.parse(data.sizes);
					console.log(sizes)					
					var table = document.getElementById("dynamicAllVariations").innerHTML = ' ' ;
					sizes.map((size, i) => {
						createAllVariationRow(size, i)
					})
				},
				error: function(data){
					toastr.error(data.responseText);
					toastr.options.timeOut = 600;
				}
			});			
		}else{
			toastr.error("Price must be grater than v_price");
      toastr.options.timeOut = 600;
      return false;
		}
	
	
	function createAllVariationRow(d, i){
			var table = document.getElementById("dynamicAllVariations");
			var col=d.color;			
			var row = table.insertRow(0);
			row.setAttribute("class", "tblRow");
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);
			var cell6 = row.insertCell(5);
			var cell7 = row.insertCell(6);
			var cell8 = row.insertCell(7);
			var cell9 = row.insertCell(8);			
			var cell10 = row.insertCell(9);			
			cell1.innerHTML = `<input type="radio" name="defVar" value="${i}" class="form-control defaultvar">`;
			cell2.innerHTML = `<span id="collr" ${d.color==0?'hidden':d.color}>${d.color}</span>`;			
			cell3.innerHTML =d.size+ d.unit;
			cell4.innerHTML = d.qty;
			cell5.innerHTML = d.price;
			cell6.innerHTML = d.v_price;
			cell7.innerHTML = d.discount;
			cell8.innerHTML = `<i onClick="onDeleteClick(${i})" class="fa fa-trash"></i>`;
			cell9.innerHTML = `<input type="hidden" name="colorName" value="${d.color}">`;
					
		}
});
$("#Nextdetails").click(function(){
	var qty
	var price
	var v_price
	var def = $('#dynamicAllVariations').find('input[name="defVar"]').is(':checked');	
	var t = $('#dynamicAllVariations').each(function(){
		 qty    = ($(this).find("td:nth-child(3)").html()); 
		 price   =($(this).find("td:nth-child(4)").html()); 
		 v_price = ($(this).find("td:nth-child(5)").html()); 
   });		
	if(qty == "") {
		toastr.error("Please select quantity");
      toastr.options.timeOut = 600;
    }
	if(price == "") {
	toastr.error("Please select price");
      toastr.options.timeOut = 600;
      return false;
    }
	if(v_price == "") {
	toastr.error("Please select price");
      toastr.options.timeOut = 600;
      return false;
    }
	if(def == false) {
		toastr.error("Please select default varition");
        toastr.options.timeOut = 600;
    }else{
	document.getElementById("info").disabled = false;
	$('.nav-info').attr('id', 'nav-info');
	$("#info").css("cursor", "pointer");
	$('#basic-tab').removeClass('active show');
	$('#variation').removeClass('active show');
	$('.nav-variation').removeClass('active show');
	$("#info").addClass('active show');
	$('#nav-home').removeClass('active show');
	$(".des").addClass('nav-info');
	$(".des").addClass('active show');
	}
});
$('#detail').change(function(){
	var details=$('#detail').val();
	if(!details) {
	toastr.error("Please give description");
	toastr.options.timeOut = 600;
	return false;
	}

});
function onDeleteClick(i) {
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
					var color = document.getElementById("colorVariations").value;
					if (i==0) {
					$('#Color').prop("disabled",false);			
					}		
					var url = '{{ route("merchant.psizeDelet", ":id") }}';
					url = url.replace(':id', i);
					$.ajax({
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						type:'GET',
						url: url,
						success:function(data){
							const sizes = JSON.parse(data.sizes);
							console.log(sizes)
							var table = document.getElementById("dynamicAllVariations").innerHTML = ' ';
							if(sizes.length > 0){
								sizes.map((size, i) => {
									createAllVariationRow(size, i)
								})
							}else{
								console.log('No size found');
							}
						},
						error: function(xhr, status, error){
						var err = JSON.parse(xhr.responseText);
						toastr.error(err.message);
						toastr.options.timeOut = 600;
					}
					});
					function createAllVariationRow(d, i){
							var table = document.getElementById("dynamicAllVariations");
							var row = table.insertRow(0);
							row.setAttribute("class", "tblRow");
							var cell1 = row.insertCell(0);
							var cell2 = row.insertCell(1);
							var cell3 = row.insertCell(2);
							var cell4 = row.insertCell(3);
							var cell5 = row.insertCell(4);
							var cell6 = row.insertCell(5);
							var cell7 = row.insertCell(6);
							var cell8 = row.insertCell(7);
							var cell9 = row.insertCell(8);
							cell1.innerHTML = `<input type="radio" name="defVar" value="${i}" class="form-control defaultvar">`;
							cell2.innerHTML = `<span id="collr" ${d.color==0?'hidden':d.color}>${d.color}</span>`;
							cell3.innerHTML = d.size+d.unit;
							cell4.innerHTML = d.qty;
							cell5.innerHTML = d.price;
							cell6.innerHTML = d.v_price;
							cell7.innerHTML = d.discount;
							cell8.innerHTML = `<i onClick="onDeleteClick(${i})" class="fa fa-trash"></i>`;
							cell9.innerHTML = `<input type="hidden" name="colorName" value="${d.color}">`;
						}
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
$('#colr_variation_show').click(function(){
	$('#addcolr').show();
	$('.textt').show();
	$(".colorr").css("display","block")
	$('#tbl').find("tbody tr td:nth-child(2)").each(function(){
		$(this).after('<td></td>');
   });
	$('#tbl').find("tr th:nth-child(2)").each(function(){
		$(this).css("display", "block");
   });
   $('#colr_variation_hide').each(function(){
		$(this).css("display", "block");		
		$(this).css("margin-top", "-50px");
		$(this).css("margin-bottom", "20px");

   });
   $('#colr_variation_show').each(function(){
		$(this).css("display", "none");
   });
   });
   
$('#colr_variation_hide').click(function(){
	var color = document.getElementById("colorVariations").value;
	var colorr=document.getElementById("collr").value;	
	console.log(colorr);
	
	if (color == '0') {
		$('#addcolr').hide();
	    $('.textt').hide();
		$(".colorr").css("display","none")
		$('#tbl').find("tbody tr td:nth-child(2)").each(function(){
			$(this).css("display", "none");
        });
		
			$('#tbl').find("tr th:nth-child(2)").each(function(){
				$(this).css("display", "none");
		});
		$('#colr_variation_hide').each(function(){
				$(this).css("display", "none");
		});
		$('#colr_variation_show').each(function(){
				$(this).css("display", "block");
				$(this).css("margin-top", "-50px");
		       $(this).css("margin-bottom", "20px");
		});
	}
	
   });
   
</script>
@endsection