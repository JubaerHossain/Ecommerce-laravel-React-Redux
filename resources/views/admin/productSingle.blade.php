@extends('layouts.admin1')
@section('title', 'Product view')
@section('style')
<style>
		section {
			float: left;
			width: 400px;
			margin-right: 20px;
		}
		textarea {
			box-sizing: border-box;
			padding: 10px;
			vertical-align: top;
			height: 100px;
			width: 100%;
    }
    .zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
	</style>
@endsection
@section('content')
<div class="">
  <div class="row align-items-center">
      <div class="col-sm-6">
          <div class="breadcrumbs-area clearfix">
              <ul class="breadcrumbs pull-left">
                  <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li><span>Product view</span></li>
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
    
    <div class="row">
      <p><strong>Product image :</strong></p>
      <div class="col-md-7">
          <div class="row">
              @php
                $imgs = explode('|', $product->images);
              @endphp
              @foreach($imgs as $img)
              <div class="col-md-3">
                <img class="img-fluid zoom" src="{{ url('product_images/'.$img) }}" alt="{{$img}}" width="200">
              </div>
              @endforeach
            </div>
      </div>
      
      <div class="col-md-8">           
            
            <div class="form-group">
            <p><strong>Product name :</strong></p>
               <p>{{$product->name}}</p>
            </div>
            <div class="form-group">
            <p><strong>Product category :</strong></p>
               <p>{{$product->category->slug}}</p>
            </div>
            <div class="form-group">
             <p><strong>Product details :</strong></p>
              <p>{{ $product->properties->description }}</p>
            </div>              
            
            <p><strong>Product variation :</strong></p>
            <div class="table-responsive">
              <table class="table">
                <thead class="thead-light">
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
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($product->variations as $key=>$item)
                      <tr>
                          <td>{{$item->status==0?'Draft':'Publish'}}</td>
                        <td>{{$item->onload==1?'Yes':'No'}}</td>
                        <td>{{$item->color==0?'No':$item->color}}</td>
                        <td>{{$item->size}} {{$item->unit}}</td>
                        <td></td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->v_price}}</td>
                        <td>{{$item->discount==0?'No':$item->discount}}</td>
                      </tr>                        
                      @endforeach
                  </tbody>
              </table>
            </div>


      </div>

      <div class="col-md-4">
          
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Address</h5>
            <a href="{{ url('product/'.$product->slug) }}">{{ url('product/'.$product->slug) }}</a>
            <br><br>
            <h5 class="card-title">Meta Informationas</h5>
            <br><br>
          </div>
        </div>
        <br><br>
       
        <div class="card">
          <div class="card-body">
            <h5 class="pb-2">Product Status</h5>
            <a href="#" onclick="Approve({{$product->id}})" class="btn {{$product->adstatus == 1?'btn-secondary disabled':'btn-info'}}">
              @if($product->adstatus == 1)Approved @else Approve This @endif
            </a>  
            <form id="delete-form-{{ $product->id }}" action="{{ route('adminApproveProd', $product->id) }}" method="POST" style="display: none;">
              @csrf
              @method('POST')
           </form>                     
            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#msg">Message</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.message',$product->id)}}" method="POST">  
                  @csrf                  
                    <div class="form-group">
                      <label for="exampleInputPassword1">Message</label>
                      <section>
                        <textarea id="autoexpand" name="message" class="form-control"  cols="30" rows="10"></textarea>
                      </section>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">sent</button>
                  </form>
            </div>
          </div>
        </div>
      </div>
    
  </div>

</main>
@endsection
@section('script')
  <script>
   var textarea = document.querySelector('textarea');
  textarea.addEventListener('keydown', autosize);
  function autosize(){
    var el = this;
    setTimeout(function(){
      el.style.cssText = 'height:auto; padding:0';
      el.style.cssText = 'height:' + el.scrollHeight + 'px';
    },0);
}
  </script>
  <script src="{{asset('js/sweet-alert.js')}}"></script>
  <script>
      		function Approve(id) {
				swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, approve it!',
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
@endsection
  
