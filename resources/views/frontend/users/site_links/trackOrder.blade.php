@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Track Order' }}
@endsection

@section('content')
<div class="wallet-wrapper cms-bredcrum">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Track Order</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                @if(!empty($track_Order_tital))
                <h1>{{ $track_Order_tital->title }}</h1>
                @if(!empty($trackOrder_des))
                <p>{{ $trackOrder_des->description }}</p>
                @else
                <p>No Data Found...</p>
                @endif
                @else
                <p>No Data Found...</p>
                @endif
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
                            <a target="_blank" href="https://www.google.com/">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/">
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