@extends('layouts.master')
@section('content')
<div class="">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route('merchant.dashboard') }}">Home</a></li>
                            <li><span>Manage withdraw</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<main role="main" class="col-md-12">
	<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
	<div class="dashboard-item">
		<div class="container">
                  <div class="row">
                  	<div class="col-md-6">
                  		<table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">Ammount</th>
                                    <th scope="col">Applied</th>
                                    <th scope="col">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdraws as $wd)
                                  <tr>
                                    <td>{{ $wd->ammount }}</td>
                                    <td>{{ $wd->updated_at }}</td>
                                    @php
                                          if($wd->status == 1){
                                                $stat = 'Approved';
                                          }
                                          else{
                                                $stat = "Not Approved Yet";
                                          }
                                    @endphp
                                    <td>{{ $stat }}</td>
                                  </tr>
                                </tbody>
                                    @endforeach
                              </table>
                  	</div>
                        <div class="col-md-6">
                              <form action="{{ route('postVendorWithdraw') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                          <label>
                                                <strong>Ammount</strong>
                                          </label>
                                          <input type="type" name="ammount" class="form-control">
                                    </div>
                                   <button type="submit" class="btn btn-success">Apply</button>
                              </form>
                        </div>
                  </div>
		</div>
	</div>
</main>

@endsection
