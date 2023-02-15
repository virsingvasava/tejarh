@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Seller Profile' }}
@endsection
@section('content')

@php
$followerId = Auth::id();
@endphp

<div class="mini-banner">
    <form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="business_banner_replace">
        @csrf
    </form>
    @if(isset($bannerReplace) && !empty($bannerReplace))
    <img src=" @if (isset($bannerReplace)) {{ asset(USERS_SELLER_BANNER_FOLDER . '/' . $bannerReplace['banner_image']) }} @endif">
    @else
    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/img/Profile-Seller-banner.png') }}">
    @endif
</div>

<div class="profile-seller">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-seller-sidebar">
                    <div class="profile-seller-img-content">
                        <div class="profile-seller-img">
                            @if (!empty($profileArray['profile_picture']))
                            <img class="or_profile_img" src="@if (isset($profileArray['profile_picture'])) {{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $profileArray['profile_picture']) }} @endif">
                            @else
                            <img src="assets/images/img/okta-logo.png">
                            @endif
                        </div>
                        <div class="profile-seller-content">
                            <?php
                            if ($profileArray['role'] == '4') {
                            ?>
                                <h5>{{ $profileArrayBussiness['company_legal_name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}"></h5>
                            <?php
                            } else {
                            ?>
                                <h5>{{ $profileArray['name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}"></h5>
                            <?php
                            }
                            ?>
                            @php
                            $member_since = date('M Y', strtotime($profileArray['updated_at']));
                            @endphp
                            <p>Member since {{ $member_since }}</p>
                            <p><a href="{{ $profileArray['website'] }}">{{ $profileArray['website'] }}</a></p>
                            <p><a href="tel:{{ $profileArray['store_phone_number'] }}">{{ $profileArray['phone_code'] }}
                                    {{ $profileArray['phone_number'] }}</a></p>
                            <p>CR No. : {{ $profileArray['enter_cr_number'] }}</p>
                            <p>VAT No. : {{ $profileArray['vat_number'] }}</p>
                            <address>
                                @php
                                $cityName = App\Models\City::where('id', $profileArray['city_id'])->first();
                                @endphp
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/map-icon.png') }}">
                                @if (!empty($cityName->name))
                                {{ $cityName->name }}
                                @endif
                            </address>
                            <div class="rating">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            </div>
                            <div class="location">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googlemap-Modal">
                                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/location-img.png')}}">
                                </a>
                            </div>
                            <div class="selling-number">
                                <ul>
                                    <li>10<strong>Bought</strong></li>
                                    <li>20<strong>Sold</strong></li>
                                    <li><span id="orFollowers">0</span><strong>Followers1</strong></li>
                                    <li><span id="orFollowing">0</span><strong>Following</strong></li>
                                </ul>
                            </div>
                            <div class="follow-btn">
                                <a href="javascript:void(0)" id="follow_btn" att="{{ isset($follow->follow_unfollow_status) && !empty($follow->follow_unfollow_status) && $follow->follow_unfollow_status ? '1' : '0' }}" class="follow btn follow_btn">
                                    <span class="msg-follow" data-followingId="{{$profileArray['id']}}" id="follow_user" data-followerId="{{ $followerId }}"> @if(isset($follow->follow_unfollow_status) && !empty($follow->follow_unfollow_status) && $follow->follow_unfollow_status == 1) Unfollow @else Follow @endif</span>
                                    <span class="msg-following"> @if(isset($follow->follow_unfollow_status) && !empty($follow->follow_unfollow_status) && $follow->follow_unfollow_status == 1) Follow @else Unfollow @endif</span>
                                    <span class="msg-unfollow" att="0" id="unfollow_user">Unfollow</span>
                                </a> 
                            </div>

                            <div class="verified-your-account">
                                <h6>Verified your account</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fas fa-envelope"></i><strong>Email<br> Verified</strong></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-phone"></i><strong>Phone<br> Verified</strong></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-address-card"></i><strong>Government<br> Verified</strong></a></li>
                                    <li class="vya-mr"><a href="javascript:void(0)"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/ministry-of-commerce-and-industry.png')}}"></a></li>
                                    <li class="vya-mr"><a href="javascript:void(0)"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/Maroof-logo.png')}}"></a></li>
                                </ul>
                            </div>
                            <div class="verified-your-account vsb">
                                <h6>Verified seller badge</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/weekly-calendar-page-symbol.png')}}"><strong>Member<br> Since 1 year</strong></a></li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-truck"></i><strong>Quick Shipper</strong></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/security-on-icon.png')}}"><strong>Reliable</strong></a>
                                    </li>
                                </ul>
                            </div>

                            <p><a href="#">*Return policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="story-wrapper">
                    <div class="container">
                        <div class="add-story">
                            <i class='bx bx-plus'></i><span>My Story</span>
                        </div>
                        <div class="story-slider-wrapper1">
                            <strong class="close-story-btn">+</strong>
                            <div id="sync1" class="slider1 owl-carousel">
                                @foreach ($story as $str1)
                                @if (count($str1) > 1)
                                <div class="multi-story-slider owl-carousel">
                                    @foreach ($str1 as $strtest)
                                    <div class="item">
                                        <div class="story-slide-box">
                                            <div class="story-slide-img">
                                                <h6>
                                                    @if (isset($strtest['user']['profile_picture']) && !empty($strtest['user']['profile_picture']))
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtest['user']['profile_picture']) }}">
                                                    @else
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                                    @endif
                                                    {{ $strtest['category']['category_name'] }}
                                                    <i class='bx bx-info-circle'></i>
                                                </h6>
                                                @php
                                                $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                                                @endphp
                                                @if ($extension == 'mp4')
                                                <video controls autoplay="true" src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                                                @else
                                                <img src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
                                                @endif
                                            </div>
                                            <div class="story-slide-content">
                                                <h5>{{ $strtest['product_name'] }}<strong>{{ $strtest['product_price'] }}
                                                        SAR</strong></h5>
                                                <p>{{ $strtest['story_description'] }}
                                                    @if (strlen($strtest['story_description']) > 30)
                                                    <a href="#">More</a>
                                                    @endif
                                                </p>
                                                <p>{{ $strtest['store_location'] }}</p>
                                                <a href="#" class="btn">Make an offer</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                @foreach ($str1 as $strtest)
                                <div class="story-slide-box">
                                    <div class="story-slide-img">
                                        <h6>
                                            @if (isset($strtest['user']['profile_picture']) && !empty($strtest['user']['profile_picture']))
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtest['user']['profile_picture']) }}">
                                            @else
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                            @endif
                                            {{ $strtest['category']['category_name'] }}
                                            <i class='bx bx-info-circle'></i>
                                        </h6>
                                        @php
                                        $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($extension == 'mp4')
                                        <video controls autoplay src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                                        @else
                                        <img src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
                                        @endif
                                    </div>
                                    <div class="story-slide-content">
                                        <h5>{{ $strtest['product_name'] }}<strong>{{ $strtest['product_price'] }}
                                                SAR</strong></h5>
                                        <p> {{ $strtest['story_description'] }}
                                            @if (strlen($strtest['story_description']) > 5)
                                            <a href="#">More</a>
                                            @endif
                                        </p>
                                        <p>{{ $strtest['store_location'] }}</p>
                                        <a href="#" class="btn">Make an offer</a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endforeach
                            </div>
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
                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
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