@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Add Coupon'}} 
@endsection
@section('content')
    <div class="track-order-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Your Account</li>
                            <li class="breadcrumb-item" aria-current="page">Your Orders</li>
                            <li class="breadcrumb-item" aria-current="page">Order Details</li>
                            <li class="breadcrumb-item active" aria-current="page">Track Package</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="track-order-address">
                        <h6>Shipping Address</h6>
                        <p>Ahmad Jabri</p>
                        <address>P.O Box 401247, Dubai</address>
                        <p>Phone: <a href="tel:767 462 9259">767 462 9259</a></p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="track-order-line">
                        <ul>
                            <li class="active">
                                <h6>Order placed</h6>
                                <p>18th Aug</p>
                            </li>
                            <li class="active">
                                <h6>Item Shipped to delivery center</h6>
                                <p>19th Aug</p>
                            </li>
                            <li>
                                <h6>Item out for delivery</h6>
                                <p>20th Aug</p>
                            </li>
                            <li>
                                <h6>Delivered</h6>
                                <p>20th Aug</p>
                            </li>
                        </ul>
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