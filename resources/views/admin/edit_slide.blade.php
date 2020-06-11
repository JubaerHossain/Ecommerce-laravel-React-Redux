@extends('layouts.admin1')
@section('title','Edit slide')
@section('style')
<link href="{{ url('/') }}/css/product_j.css" rel="stylesheet" type="text/css">
<style>

    .file-upload {
        position: relative;
        display: inline-block;
    }

    .file-upload__label {
    display: block;
    border-radius: .4em;
    transition: background .3s;  
    &:hover {
        cursor: pointer;
        background: #000;
    }
    }    
    .file-upload__input {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        font-size: 1;
        width:0;
        height: 100%;
        opacity: 0;
    }
    .img {cursor: -webkit-grab; cursor: grab;}
    .dotted{
 border-style: dotted;
}</style>
@endsection
@section('content')
<div class="">
		<div class="row align-items-center">
				<div class="col-sm-6">
						<div class="breadcrumbs-area clearfix">
								<ul class="breadcrumbs pull-left">
										<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
										<li><span>Edit slide</span></li>
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
					<form class="mx-auto" method="post" action="{{ route('admin.update_slide',$data->id) }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
						<label for="exampleInputname">Slider title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$data->title}}"  name="title">
						</div>
						<div class="form-group">
						<label for="exampleInputname">Slider description</label>
						<textarea name="description"  cols="40" rows="5">{{$data->description}}</textarea>
						</div>
						<div class="form-group">
						<label for="exampleInputname">Slider image</label>
                        <div class="dz-default dz-message im">
                                <label for="upload" class="file-upload__label  dotted text-center"> 
                                    <img src="{{url('slide/'.$data->image)}}" class="img-fluid img" alt="avatar">
                                </label>
                                <input id="upload" class="file-upload__input" type="file" name="image">
                        </div>
						</div>
					    <button type="submit" class="btn btn-primary mt-3 mb-3" style="background:#8818fd;">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection
@section('script')
<script>
  function readURL(input) {

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
    $('.img').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}

$("#upload").change(function() {
readURL(this);
});
</script>
@endsection
