@extends('layouts.master') 
@section('title','Dashboard')
@section('content')
<div class="">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('merchant.dashboard') }}">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="sales-report-area sales-style-two">
    <div class="row">
        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
            <div class="single-report">
                <div class="s-sale-inner pt--30 mb-3">
                    <div class="s-report-title d-flex justify-content-between">
                        <h4 class="header-title mb-0">Product Sold</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected="">Last 7 Days</option>
                            <option value="0">Last 7 Days</option>
                        </select>
                    </div>
                </div>
                <canvas id="coin_sales4" height="100"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
            <div class="single-report">
                <div class="s-sale-inner pt--30 mb-3">
                    <div class="s-report-title d-flex justify-content-between">
                        <h4 class="header-title mb-0">Gross Profit</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected="">Last 7 Days</option>
                            <option value="0">Last 7 Days</option>
                        </select>
                    </div>
                </div>
                <canvas id="coin_sales5" height="100"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-ml-3 col-md-6  mt-5">
            <div class="single-report">
                <div class="s-sale-inner pt--30 mb-3">
                    <div class="s-report-title d-flex justify-content-between">
                        <h4 class="header-title mb-0">Orders</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected="">Last 7 Days</option>
                            <option value="0">Last 7 Days</option>
                        </select>
                    </div>
                </div>
                <canvas id="coin_sales6" height="100"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
            <div class="single-report">
                <div class="s-sale-inner pt--30 mb-3">
                    <div class="s-report-title d-flex justify-content-between">
                        <h4 class="header-title mb-0">New Coustomers</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected="">Last 7 Days</option>
                            <option value="0">Last 7 Days</option>
                        </select>
                    </div>
                </div>
                <canvas id="coin_sales7" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="{{asset('asset/back')}}/js/line-chart.js"></script>
<!-- all bar chart activation -->
<script src="{{asset('asset/back')}}/js/bar-chart.js"></script>
<!-- all pie chart -->
<script src="{{asset('asset/back')}}/js/pie-chart.js"></script>
@endsection