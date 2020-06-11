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
                  		<form action="{{ route('postCategoryEdit', $category->id) }}" method="POST">
                  			@csrf
                           <h5>Parent: </h5>
                  			<div class="form-group">
                  				<label>
                  					Edit Name
                  				</label>
                               <input type="type" name="category" class="form-control" value="{{ $category->name }}">
                  			    <input type="text" name="type" value="{{-- {{ $type }} --}}" hidden>
                  			</div>
                  	     <button type="submit" class="btn btn-success">Change</button>
                  		</form>
                  	</div>
                  </div>
						</div>
					</div>
				</main>

@endsection
