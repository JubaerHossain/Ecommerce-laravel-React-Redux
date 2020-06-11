<body>
	@include("dnav")
	<div class="container-fluid">
		<div class="row">
			@include("dsidebar")
			<main role="main" class="col-md-9 m-b-50 ml-sm-auto col-lg-10 pt-3 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
					<h1 class="h2">withraw Money</h1>
				</div>
				<!--
				<canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
				<div class="dashboard-item">
            <div class="row">
            <div class="col-md-4">
			<div class="dash-box dash-box-color-1">
                  <div class="dash-box-icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </div>
                  <div class="dash-box-body">
                    <span class="dash-box-count">8,252</span>
                    <span class="dash-box-title">Tolal Earning</span>
                  </div>
                  
                  <div class="dash-box-action">
                    <button>More Info</button>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
			<div class="dash-box dash-box-color-3">
                  <div class="dash-box-icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </div>
                  <div class="dash-box-body">
                    <span class="dash-box-count">8,252</span>
                    <span class="dash-box-title">Total withraw</span>
                  </div>
                  
                  <div class="dash-box-action">
                    <button>More Info</button>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
			<div class="dash-box dash-box-color-2">
                  <div class="dash-box-icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </div>
                  <div class="dash-box-body">
                    <span class="dash-box-count">8,252</span>
                    <span class="dash-box-title">Pending withraw</span>
                  </div>
                  
                  <div class="dash-box-action">
                    <button class="withraw">withraw</button>
                  </div>
                </div>
            </div>
        </div>
		<div class="container">			
			<div class="col-md-6 col-sm-12 offset-md-3">
			<div class="payment-form">
			<h2 class="">Account Details</h2>
		<form action="">
			<label for="" class="label">Account No</label>
			<select class="custom-select">
				<option selected>Choose a Payment Method</option>
				<option value="1">Bkash</option>
				<option value="2">Mcash</option>
				<option value="3">Ucash</option>
			</select>
			<label for="" class="label">Account No</label>
			<input type="text" class="form-control">			<label for="" class="label">Withdraw Amount</label>
			<input type="text" class="form-control">
			<label for="" class="label">Confirm Withdraw Amount</label>
			<input type="text" class="form-control">
        </form>
        <a href="" class="btn btn-primary">Submit</a>
			</div>
			</div>
		</div>
    	 </div>

			</main>
		</div>
	</div>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- Icons -->
	<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
$(document).ready(function(){
    $(".withraw").click(function(){
        $(".payment-form").show(2000);
    });
});
</script>
</body>