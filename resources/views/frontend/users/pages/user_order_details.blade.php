@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User Order Details' }}
@endsection

@section('content')
    <div class="order-details-wrapper user-order-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> Home</a></li>
                            {{-- <li class="breadcrumb-item" aria-current="page">My Account</li> --}}
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('frontend.users.my-orders.index')}}">My Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">#123456</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn trans-btn">Download Invoice</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="order-detail">
                        <div class="order-detail-content">
                            <div class="delivery-address">
                                <h6>Delivery Address</h6>
                                <p>Ahmad Jabri</p>
                                <address>P.O Box 401247, Dubai</address>
                                <p>Phone:<a href="tel:767 462 9259">767 462 9259</a></p>
                            </div>
                            <div class="payment-method">
                                <h6>Payment Method</h6>
                                <p><img src="assets/images/img/mastercard-icon.png"> **** 1234</p>
                            </div>
                            <div class="payment-details">
                                <h6>Payment Details</h6>
                                <table>
                                    <tr>
                                        <td>Item price</td>
                                        <td>7,000 {{env('CURRENCY_TAG')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sell tax</td>
                                        <td>50 {{env('CURRENCY_TAG')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td>10 {{env('CURRENCY_TAG')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Commission (15%)</td>
                                        <td class="red-color">-10 {{env('CURRENCY_TAG')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>7,060 {{env('CURRENCY_TAG')}}</strong></td>
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
                                <h6 class="order-deliver">Order Deliver</h6>
                                <p>Apple airpods</p>
                                <span>7,000 {{env('CURRENCY_TAG')}}</span>
                            </div>
                        </div>
                        <div class="order-buttons">
                            <a href="#" class="btn trans-btn">Archive order</a>
                            <a href="#" class="btn">Rate Seller</a>
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
                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                        <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                        <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
