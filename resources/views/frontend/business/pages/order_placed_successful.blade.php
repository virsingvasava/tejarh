@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Order Placed Successful'}}
@endsection
@section('content')
<div class="your-order-placed-successful">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="your-order-place">
                    <img src="{{asset('fronted/users_flow/assets/images/your-order-placed-successful.png')}}">
                    <p>Your order placed successfully</p>
                    {{-- <a href="track-order.html" class="btn">Track Order</a>
                        <a href="my-orders.html" class="btn trans-btn">My Order</a> --}}

                    <a href="javascript:void(0)" class="btn">Track Order</a>
                    <a href="{{route('frontend.business.my-orders.index')}}" class="btn trans-btn">My Order</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('fronted/users_flow/assets/images/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>TRY THE TEJARH APP</h2>
                    <p>Buy, sell and find just about anything using the app on your mobile.</p>
                    <ul>
                        <li>
                            <a href="#"><img src="{{ asset('fronted/users_flow/assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('fronted/users_flow/assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection