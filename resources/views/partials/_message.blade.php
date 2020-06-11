@foreach($errors->all() as $message)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  {{ $message }}
</div>
@endforeach

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  {!! Session::get('success') !!}
</div>
@endif
@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  {!! Session::get('danger') !!}
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  {!! Session::get('warning') !!}
</div>
@endif