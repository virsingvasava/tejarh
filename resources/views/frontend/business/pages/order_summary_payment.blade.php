@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Order Summary Payment'}} 
@endsection
@section('content')
    <div class="order-summary-payment-wrapper">
        <div class="container">
            <div class="row">   
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Checkout</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-12">
                    <div class="right-order-summary-payment" style="margin:0 auto;width:400px;">
                        <table>
                            <tr>
                                <td colspan="2"><strong>Payment Details</strong></td>
                            </tr>
                            <tr>
                                <td>Item price</td>
                                <td> @if(!empty($items->price))

                                {{$items->price}}

                                @else
                                7000
                                @endif

                                {{env('CURRENCY_TAG')}}
                            </td>
                            </tr>
                            <tr>
                                <td>Sell tax</td>
                                <td>60 {{env('CURRENCY_TAG')}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge</td>
                                <td>10 {{env('CURRENCY_TAG')}}</td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td>-10 {{env('CURRENCY_TAG')}}</td>
                            </tr>
                            <tr>
                                <td><strong>Amount Payable</strong></td>
                                <td><strong>
                                    @if(!empty($items->price))

                                    {{$items->price}}

                                    @else
                                    7000
                                    @endif

                                    {{env('CURRENCY_TAG')}}</strong>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group submit">
                            <a style="width:100%" href="{{ route('frontend.business.order-details.card_details',($itemId->id)) }}" class="btn">Pay Now</a>
                            <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->
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