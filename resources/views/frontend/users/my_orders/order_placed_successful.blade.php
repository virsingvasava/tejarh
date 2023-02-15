@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User order placed successful' }}
@endsection

@section('content')
    <div class="your-order-placed-successful">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="your-order-place">
                        <img src="{{asset('fronted/users_flow/assets/images/your-order-placed-successful.png')}}">
                        <p>@lang('frontend-messages.card.your_order_placed_successfully')</p>

                        <a href="javascript:void(0)" class="btn">@lang('frontend-messages.card.track_order')</a>
                        <a href="{{route('frontend.users.my-orders.index')}}" class="btn trans-btn">@lang('frontend-messages.card.my_order')</a>
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
                        <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                        <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.google.com/"><img
                                        src="{{ asset('fronted/users_flow/assets/images/google-play.png') }}"> </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.google.com/"><img
                                        src="{{ asset('fronted/users_flow/assets/images/app-store.png') }}"> </a>
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
