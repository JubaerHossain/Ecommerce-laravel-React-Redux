@extends('layouts.admin1')
@section('title','Dashboard')
@section('content')
<main role="main" class="col-md-12">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
            </button>
          </div>
        </div>
              <div class="row">
                  <div class="col-md-4 mt-5">
                      <div class="card">
                          <div class="seo-fact sbg1">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="fas fa-chart-area"></i> Sales</div>
                                  <h2>2,315</h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-md-5">
                      <div class="card">
                          <div class="seo-fact sbg2">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="fas fa-shopping-basket"></i> Orders</div>
                                  <h2>3,984</h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-5">
                      <div class="card">
                          <div class="seo-fact sbg3">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="fas fa-user"></i> Vendor</div>
                                  <h2>2,315</h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-md-5">
                      <div class="card">
                          <div class="seo-fact sbg4">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="fas fa-ellipsis-h"></i>Pending </div>
                                  <h2>3,984</h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-5">
                      <div class="card">
                          <div class="seo-fact sbg5">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="fas fa-shipping-fast"></i> Shipping</div>
                                  <h2>2,315</h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-md-5">
                      <div class="card">
                          <div class="seo-fact sbg6">
                              <div class="p-4 d-flex justify-content-between align-items-center">
                                  <div class="seofct-icon"><i class="ti-share"></i> Share</div>
                                  <h2>3,984</h2>
                              </div>
                          </div>
                      </div>
                  </div>
        </div>
      </main>

@endsection
