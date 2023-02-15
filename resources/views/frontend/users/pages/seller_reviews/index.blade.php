
@extends('frontend.users.layouts.master')
@section('title','Tejarh - Product Seller Reviews')
@section('content')

    <div class="wallet-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">Reviews</a></li>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4">
                    @if (!empty($sellerDetails))
                            <div class="product-slider1">
                                <div class="profile-seller-sidebar1">
                                    <div class="seller-review-section-content">
                                        <div class="profile-seller-img">
                                            @if (!empty($sellerDetails['profile_picture']))
                                                <img class="seller_profile" src="@if (isset($sellerDetails['profile_picture'])) {{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $sellerDetails['profile_picture']) }} @endif">
                                            @else
                                                <img src="{{ asset('assets/images/user.png') }}">
                                            @endif
                                        </div>
                                        @if ($sellerDetails['role'] == USER_ROLE)
                                            <div class="profile-seller-content" style="text-align: center">
                                                <h5>{{ $sellerDetails['first_name'] }} <img
                                                        src="{{ asset('assets/images/best-seller.png') }}"></h5>
                                                @php
                                                    $member_since = date('M Y', strtotime($sellerDetails['updated_at']));
                                                @endphp
                                                <p>Member since {{ $member_since }}</p>
                                                @if (!empty($sellerDetails['phone_code']))
                                                    <p>{{ $sellerDetails['phone_code'] }} {{ $sellerDetails['phone_number'] }}
                                                    </p>
                                                @else
                                                    <p>{{ $sellerDetails['phone_number'] }}</p>
                                                @endif
                                            </div>
                                        @else
                                            <div class="profile-seller-content">
                                                <h5>{{ $profileArrayBussiness['company_legal_name'] }} <img
                                                        src="{{ asset('assets/images/best-seller.png') }}"></h5>
                                                @php
                                                    $member_since = date('M Y', strtotime($profileArrayBussiness['updated_at']));
                                                @endphp
                                                <p>Member since {{ $member_since }}</p>
                                                <p><a href="{{ $profileArrayBussiness['website'] }}" target="_blank"
                                                        style="color: black;">{{ $profileArrayBussiness['website'] }}</a>
                                                </p>
                                                <p><a href="tel:{{ $profileArrayBussiness['store_phone_number'] }}"
                                                        style="color: black;">{{ $profileArrayBussiness['user']['phone_code'] }}
                                                        {{ $profileArrayBussiness['user']['phone_number'] }}</a></p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="user_review_message_section">
                        @if (!empty($reviewRatingArray) && count($reviewRatingArray) > 0)
                            @foreach ($reviewRatingArray as $key => $value)
                                <div class="review-dialog-list">
                                    <div class="review-block-listing">
                                        <div class="reviews-listing">
                                            <div class="customer-review">
                                                <div class="review-img">I
                                                    @if (!empty($value['user']['profile_picture']))
                                                        <img
                                                            src="@if (isset($value['user']['profile_picture'])) {{ asset('assets/users/' . $value['user']['profile_picture']) }} @endif">
                                                    @else
                                                        <img src="{{ asset('assets/images/user.png') }}">
                                                    @endif
                                                </div>
                                                <div class="review-sec">
                                                    <div class="review-content">
                                                        <h5>{{ $value['user']['first_name'] }} {{ $value['user']['last_name'] }}
                                                        </h5>
                                                    </div>
                                                    <div class="dots"><img
                                                            src="{{ asset('assets/images/dots-icon.png') }}" /></div>
                                                </div>
                                            </div>
                                            <div class="review-time-sec">
                                                <div class="rate inner">
                                                    @if ($value['rating_star'] == 5)
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                    @elseif($value['rating_star'] == 4)
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                    @elseif($value['rating_star'] == 3)
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                    @elseif($value['rating_star'] == 2)
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                    @else
                                                        <i
                                                            class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                                    @endif
                                                </div>
                                                <span>{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</span>
                                            </div>
                                            <div class="customer-review-content mt-1">
                                                <p>{{ $value['review_description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center mt-5">
                                <h6>Not Found Reviews</h6>
                            </div>
                        @endif
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
                                <a href="javascript:void(0)"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
    <style>
        .review-block-listing {
            border-bottom: 1px solid #ecedef;
            padding: 28px 0;
        }
    </style>
@endsection
@section('script')
@endsection