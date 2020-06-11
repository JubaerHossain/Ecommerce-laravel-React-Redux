@extends('layouts.merchant')
@section('style')
<link href="{{ url('/') }}/plugins/hamB-t.v.css" rel="stylesheet" type="text/css">
<style>
/* 	input[type="file"] {
    display: none;
} */
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
#addButton{
	padding: 5px 10px;
}
</style>
@endsection
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Add Product</h1>
		@include('partials._message')	
	</div>
	<div class="dashboard-item">
		<div class="container">
			<form enctype="multipart/form-data" method="post" action="{{route('merchantCreateProduct')}}">
				@csrf
			<div class="row">
				<div class="card bg-light p-2 col-md-10">
						@csrf
						<div class="form-group">
							<label for="">Product Name</label>
							<input type="text" class="form-control" name="product_name">
						</div>
						<div class="row">
							<div class="col-md">
								<div class="form-group">
									<label for="">Stock Available</label>
									<input type="number" class="form-control" min="1" max="" value="1" name="stock_available">
								</div>
							</div>
							<div class="col-md">
								<div class="form-group">
									<label for="">Brand</label>
									<input type="text" class="form-control" name="brand">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md">
								<div class="form-group">
									<label for="">Price</label>
									<input type="number" class="form-control" name="price">
								</div>
							</div>
							<div class="col-md">
								<div class="form-group">
									<label for="">Sell Price</label>
									<input type="number" class="form-control" name="s_price">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Product Details</label>
							<textarea class="form-control" id="" rows="3" name="details"></textarea>
						</div>				
						{{-- <div class="size">
							<div class="panel panel-default">
							    <div class="panel-body">
						            <div class="form-inline">
						              {{-- <div class="form-group">
										<ul id="imgArray"></ul>
						              	<button type="button" id="addButton">(+)</button>
						              </div>
						            </div>
							        <h6>Available Size</h6>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="size_m">
									  <label class="form-check-label" for="inlineCheckbox1">M</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="size_l">
									  <label class="form-check-label" for="inlineCheckbox2">L</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="size_xl">
									  <label class="form-check-label" for="inlineCheckbox2">XL</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="size_xxl">
									  <label class="form-check-label" for="inlineCheckbox2">XXL</label>
									</div>
							    </div>
							</div>
						</div> --}}
				</div>
				
						<div class="col-md-10" id="lol">
						
								
												<div class="form-group Add">
													<label for="inputPassword" class="col-sm-2 col-form-label"><a>Variation</a></label>
													<div class="table-responsive">
														<table class="table table-bordered">
																<thead>
																	<tr>
																		<th scope="col">Color</th>
																		<th scope="col">Size</th>
																		<th scope="col">Quantity</th>
																		<th scope="col">Image</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																	<td>
																			<select class="form-control addButto" onchange="delMe(this.value)" name="Pcolor[]">
																					<option>Select color</option>
																					<option value="orange">orange</option>
																					<option value="white">white</option>
																					<option value="purple">purple</option>
																				</select>
																	</td>
																	<td>
																			<select class="form-control t" name="Psize[]">
																					<option>Selecet size</option>
																					<option value="23">23</option>
																					<option value="24">24</option>
																					<option value="25">25</option>
																					<option value="26">26</option>
																					<option value="27">27</option>
																			</select>
																	</td>
																	<td>
																		<input type="text" name="Pqty[]">
																	</td>
																	<td>																			
																		<img src="" id="profile-img-tag" width="100px" />
																		<input type="file" name="Pimage[]" id="profile-img" style="width:91px">
																	</td>
																	<tr>																	
																</tbody>
															</table>	
														</div>											
													</div>
													<div class="p-2 pb-4">
													 <button type="button" class="btn btn-sm btn-outline-info col-sm-2 addColor" id="addColor">  <i class="fa fa-plus addColor"></i> Add New</button>
											   </div>
									
						</div>
					
				
					<div class=" col-md-10 card bg-light p-2" style="width:100%">
						<h4 class="mt-3 mb-1">Choose Category</h4>

						<div id="treeview_container" class="hummingbird-treeview">
							@csrf
					    	<ul id="treeview" class="hummingbird-base">
					    		@foreach($categories as $c)
							    <li>
									<i class="fa fa-plus"></i>
									<label>
										<!-- <input id="xnode-0" name="la-{{ $c->id }}" data-id="custom-0" type="checkbox" value="{{$c->id}}" /> --> {{$c->name}} - {{ $c->depth }} </label>
									<ul>
										@foreach($c->child as $d)
									    <li>
									    	@if($d->child->first())
											    <i class="fa fa-plus"></i>
											@endif
											
											<label>
												@if(!$d->child->first())
											    <input  id="xnode-0-1" name="category" data-id="custom-0-1" type="radio" value="{{$d->id}}" />
											    @endif
											    {{$d->name}} - {{ $d->depth }}
											</label>
											<ul>
												@foreach($d->child as $e)
											    <li>
													<label>
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
						<div class="form-group">
							<label for="status">Product Status</label>
				            <select name="status" id="status" class="form-control">
				              <option value="1">Published</option>
				              <option value="0">Draft</option>
				            </select>
						</div>
						<button type="submit" class="btn btn-primary m-b-50">Add Product</button>
					</div>
				
			</form>
			</div>
		</div>
</main>
@endsection

@section('script')
<script src="{{ url('/') }}/plugins/hamB-t.v.js"></script>

<script>
	$("#treeview").hummingbird();
var colorArray = [];
var yahooId = null;
var imgId = null;
function delMe(value){
	      let find = colorArray.find( color => color === value );
				if(find){
					document.getElementById(yahooId).disabled = true;
				}
				else{
				colorArray.push(value);
				document.getElementById(yahooId).disabled = false;
				}
				
				}
/* function addSize(value){
	      let find = sizeArray.find( color => color === value );
				console.log(value);
				
				if(find){
					$(`#addButto option[value=${find}]`).prop("disabled","disabled");  

				}
				else{
					sizeArray.push(value);
				
				}
				} */

	$( ".addColor").click(function () {
		yahooId = Math.random();
		imgId = Math.random();
		// table-responsive
		var responsiveClass='table-responsive'
			 $(".Add").append(`<div class="table-responsive">
														<table class="table table-bordered">
																<thead>
																	<tr>
																		<th scope="col">Color</th>
																		<th scope="col">Size</th>
																		<th scope="col">Quantity</th>
																		<th scope="col">Image</th>
																	</tr>
																</thead>
																<tbody>
																	<td>
																			<select class="form-control addButto"  onchange="delMe(this.value)" name="Pcolor[]">
																					<option>Selecet color</option>
																					<option value="orange">orange</option>
																					<option value="white">white</option>
																					<option value="purple">purple</option>
																				</select>
																	</td>
																	<td>
																			<select class="form-control t" name="Psize[]">
																					<option>Select Size</option>
																					<option value="23">23</option>
																					<option value="24">24</option>
																					<option value="25">25</option>
																					<option value="26">26</option>
																					<option value="27">27</option>
																			</select>
																	</td>
																	<td>
																		<input type="text" name="Pqty[]">
																	</td>
																	<td>
																		
																				<img src="" id=${imgId} width="100px" />
																				<input id=${yahooId} onchange="imageAdd(this.value)" type="file" name="Pimage[]" style="width:91px">
																	    
																	</td>
																	</tr>																	
																</tbody>
															</table>	
														</div>
														</div>`);
			});

		
			function imageAdd(value){
				
		$("#yahooId").on("change",function(){
					console.log('lol');					
		     	readURL(this);
				});
			
				
			
				
			/* 	document.getElementById(yahooId).on("change", function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;

        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
							document.getElementById(imgId).attr('src', this.value);
            }
        }
    }); */
				

			}
	</script>
	

<script type="text/javascript">

	function readURL(input) {
			if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
							$('#profile-img-tag').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
			}
	}
	$("#profile-img").change(function(){
			readURL(this);
	});
</script>
@endsection