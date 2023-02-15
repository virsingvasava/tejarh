@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business | Business Reports'}} 
@endsection
@section('content')

    <div class="dashborad-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Business Reports</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row br-top-bar">
                <div class="col-md-6">
                    <div class="input-group br-fc">
                        <select class="form-select"  id="opt_level" name="opt_level">
                            <option selected>Select</option>
                            <option value="1">Last Week</option>
                            <option value="2">Last Month</option>
                            <option value="3">Last Year</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 ta-right" style="display:none">
                    <a href="#" class="btn-download"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/icon-download.png') }}">Download</a>
                    <a href="#" class="btn-print"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/icon-print.png') }}">Print</a>
                </div>
            </div>
            <div class="bot-bdr"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="br-box-sec">
                        <p>Business growth rate</p>
                        <h5 class="dark-green-color">{{$growthRate}}</h5><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/orange-arrow.png') }}" alt="Credit Icon"><span class="orange-color">{{$growthRateLatest}}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="br-box-sec">
                        <p>New Orders</p>
                        <h5 class="blue-color">{{$newOrders}}</h5><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/orange-arrow.png') }}" alt="Credit Icon"><span class="orange-color">{{$newOrdersLatest}}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="br-box-sec">
                        <p>Return Orders</p>
                        <h5 class="purple-color">{{$returnOrders}}</h5><span><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/green-arrow.png') }}" alt="Credit Icon"><span class="green-color green-arrow">{{$returnOrdersLatest}}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="br-box-sec">
                        <p>Customer Visit</p>
                        <h5 class="orange-color">{{$customerVisit}} %</h5><span><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/green-arrow.png') }}" alt="Credit Icon"><span class="green-color green-arrow">{{$customerVisitLatest}} %</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="itemchart">
                        <div class="itemchart-sec">
                            <div class="itemchart-sec-l">
                                <p>Item Sold</p>
                                <h4>3829</h4><span class="green-arrow green-color">{{$itemSold}}</span>
                            </div>
                            <div class="itemchart-sec-r">
                                <h4>3427<span>Was last month</span></h4>
                                <p><i></i>Jan 1 - Jan 30, 2021</p>
                            </div>
                        </div>
                        <!-- <div class="clear-fix"></div> -->
                        <!-- <div id="itemschart"></div> -->
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="offer-box">
                        <div class="offer-left">
                            <h5>60%</h5>
                            <p>Type of offer</p>
                        </div>
                        <div class="offer-right">
                            <h5>17530</h5>
                            <p>Offer increase</p>
                            <span>7.5%</span>
                        </div>
                    </div>
                    <div class="offer-box orange-ob">
                        <div class="offer-left">
                            <h5>60%</h5>
                            <p>Number of Customers</p>
                        </div>
                        <div class="offer-right">
                            <h5>17530</h5>
                            <p>New Customer</p>
                            <span>7.5%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-box">
                        <h4>Followers and Following</h4>

                        <div id="followers"></div>
                        <div class="chart-tmain">
                            <div class="chart-text-left">
                                <h5>81%</h5>
                                <p>Followers</p>
                            </div>
                            <div class="chart-text-right">
                                <h5>19%</h5>
                                <p>Following</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="chart-box ods">
                        <h4>Order status</h4>
                        <div class="chart-tmain">
                            <div class="chart-text-left ctl-act">
                                <h5>3227</h5>
                                <p>Active</p>
                            </div>
                            <div class="chart-text-left ctl-dis">
                                <h5>282</h5>
                                <p>Dispatched</p>
                            </div>
                            <div class="chart-text-left ctl-rtn">
                                <h5>320</h5>
                                <p>Return</p>
                            </div>
                        </div>
                        <div id="orderstatus"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="try-tejarg-app-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                        <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                        <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img
                                src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection