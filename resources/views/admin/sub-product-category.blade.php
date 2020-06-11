@extends('layouts.admin')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
					<h1 class="h2">Add Product Sub Category</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
					</div>
				</div>
				<!--
				<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
				<div class="dashboard-item">
					<div class="container">
						<div class="row">
							<div class="col-md-6 offset-md-3">
								@foreach($errors->all() as $message)
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									  {{ $message }}
								</div>
								@endforeach
								<form class="mx-auto" enctype="multipart/form-data" method="post" action="{{ route('admin.store-product-sub-categories')}}">
									@csrf
									<div class="form-group">
										<label>Product Category</label>
										<select class="form-control" name="product_category_id">
											@foreach($product_categories as $product_category)
												<option value="{{$product_category->id}}">{{$product_category->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
									<label for="exampleInputname">Category Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="name">
									</div>
									
									
								      <button type="submit" class="btn btn-primary m-b-50">Submit
								      </button>
									</form>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped text-center">
										<thead style="background: rgb(0, 105, 217);color: #fff;">
											<th>ID</th>
											<th>Product Category Name</th>
											<th>Product Sub Name</th>
											<th>
												Action
											</th>
										</thead>
										<tbody>
											@foreach($products as $p)
											<tr>
												<td>{{$p->id}}</td>
												<td>{{$p->category->name}}</td>
												<td>{{$p->name}}</td>
												<td>
												  <a href="{{ route('editCategory', [$p->id, 'child'])}}">
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
