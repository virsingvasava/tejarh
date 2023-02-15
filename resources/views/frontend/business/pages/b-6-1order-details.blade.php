@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Order Details'}} 
@endsection
@section('content')

    <div class="order-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item" aria-current="page">Orders</li>
                            <li class="breadcrumb-item active" aria-current="page">#123456</li>
                        </ol>
                    </nav>                                        
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn tras_btn">Download Invoice</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="order-line">
                        <p>Order Delivered</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="order-detail">
                        <ul>
                            <li>Order ID : #123456</li>
                            <li>Date : 06/08/2021</li>
                        </ul>
                        <div class="order-detail-content">
                            <div class="delivery-address">
                                <h6>Delivery Address</h6>
                                <div class="profile">
                                    <img src="assets/images/img/profile-pic.png">
                                    <h6>Bryan Ugarte</h6>
                                </div>
                                <address>P.O Box 401247, Dubai</address>
                                <p>Phone:<a href="tel:767 462 9259">767 462 9259</a></p>
                            </div>
                            <div class="payment-method">
                                <h6>Payment Method</h6>
                                <p>**** 1234</p>
                                <h6>Shipped by</h6>
                                <p>FedEX</p>
                            </div>
                            <div class="payment-details">
                                <h6>Payment Details</h6>
                                <table>
                                    <tr>
                                        <td>Item price</td>
                                        <td>7,000 SAR</td>
                                    </tr>
                                    <tr>
                                        <td>Sell tax</td>
                                        <td class="red-color">50  SAR</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td class="red-color">10 SAR</td>
                                    </tr>
                                    <tr>
                                        <td>Commission (15%)</td>
                                        <td class="green-color">10 SAR</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>7,060 SAR</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="order-select-wrapper">
                        <div class="order-product">
                            <img src="assets/images/img/product-img1.png">
                            <div class="order-product-content">
                                <p>Apple airpods</p>
                                <span>7,000 SAR</span>
                                <p>Qty: 2 Nos.</p>
                            </div>                                
                        </div>
                        <div class="order-buttons">
                            <div class="product-rating">
                                <h6>Client Review</h6>
                                <img src="assets/images/img/big-star.png">
                                <img src="assets/images/img/big-star.png">
                                <img src="assets/images/img/big-star.png">
                                <img src="assets/images/img/big-star-grey.png">
                                <img src="assets/images/img/big-star-grey.png">
                            </div>
                        </div>
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