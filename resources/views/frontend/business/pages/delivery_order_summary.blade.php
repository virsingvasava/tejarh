        
@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Delivery order summary'}} 
@endsection
@section('content')

        <div class="delivery-order-summary-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="delivery-order-address">
                            <p>Shipping to <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-delivery-order-summary">Change</a></p>
                            <p>Ahmad Jabri</p>
                            <address>P.O Box 401247, Dubai</address>
                            <p>Phone: <a href="tel:767 462 9259">767 462 9259</a></p>
                            <a href="#" class="btn">Deliver to this address</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="delivery-order-address-add" data-bs-toggle="modal" data-bs-target="#add-delivery-order-summary">
                            <img src="assets/images/img/add-address-icon.png">
                            <h5>Add address</h5>
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
        