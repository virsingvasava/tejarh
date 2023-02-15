@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Seller Profile' }}
@endsection

@section('content')
<div class="mini-banner">
    <form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="business_banner_replace">
        @csrf
    </form>
    @if($profileArray['role'] == BUSINESS_ROLE)
    @if (isset($bannerReplace) && !empty($bannerReplace))
    <img src=" @if (isset($bannerReplace)) {{ asset(BUSINESS_BANNER_FOLDER . '/' . $bannerReplace['banner_image']) }} @endif">
    @else
    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Profile-Seller-banner.png') }}">
    @endif
    @else
    @if (isset($userBannerReplace) && !empty($userBannerReplace))
    <img src=" @if (isset($userBannerReplace)) {{ asset(BUSINESS_BANNER_FOLDER . '/' . $userBannerReplace['banner_image']) }} @endif">
    @else
    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Profile-Seller-banner.png') }}">
    @endif
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
                            <img class="or_profile_img" src="@if (isset($profileArray['profile_picture'])) {{ asset(BUSINESS_PROFILE_FOLDER . '/' . $profileArray['profile_picture']) }} @endif">
                            @else
                            <img src="{{ asset('assets/images/user.png') }}">
                            @endif
                        </div>
                        @if($profileArray['role'] == USER_ROLE)
                        <div class="profile-seller-content">
                            <h5>{{ $profileArray['first_name'] }} <img src="{{ asset('assets/images/best-seller.png')}}"></h5>
                            @php
                            $member_since = date('M Y', strtotime($profileArray['updated_at']));
                            @endphp
                            <p>Member since {{ $member_since }}</p>
                            @if(!empty($profileArray['phone_code']))
                            <p>{{ $profileArray['phone_code'] }} {{ $profileArray['phone_number'] }}</p> 
                            @else
                            <p>{{ $profileArray['phone_number'] }}</p>
                            @endif
                            <div class="rating">
                                {{-- <img src="{{ asset('assets/images/fill-star.png')}}">
                                <img src="{{ asset('assets/images/fill-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}"> --}}
                              
                                <div class="review_count mb-3">
                                    <a href="{{route('frontend.users.seller-reviews.seller_reviews_details',$profileArray['id'])}}">
                                        <div class="cxeKyx">
                                            <div  color="#0AD188" class="kCxoGQ">
                                                <span class="bFgxSY">{{$totalReviewAvg}}</span> 
                                                <label><i class="fas fa-star ratings_color_set"></i></label>
                                            </div>
                                            <div class="jWgYGv">
                                                <div underline-thickness="0.5px" class="hnUSvL">
                                                    <span>{{$totalCountReviewRatings}} Ratings</span>
                                                    <div class="line_review_count"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <button type="button" id="write_review_Ids" class=" btn-review"
                                        data-bs-toggle="modal" data-bs-target="#seller_review_writing_btton"
                                        data-bs-dismiss="modal"><span class="review-icon"><img src="{{ asset('assets/images/edit-icon.png') }}"></span>Write a review</button>
                                </div>
                            </div>
                            <address>
                                <img src="{{ asset('assets/images/map-icon.png')}}">
                                @if (!empty($getCityName->first_name))
                                {{ $getCityName->first_name }} , {{ $getCountryName->first_name }}
                                @endif
                            </address>
                            <div class="location">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googlemap-Modal">
                                    <img src="{{ asset('assets/images/location-img.png')}}">
                                </a>
                            </div>
                            <div class="selling-number">
                                <ul>
                                    <li>{{ $itemBought }}<strong>@lang('frontend-messages.UserProfile.bought')</strong></li>
                                    <li>{{ $itemSold }}<strong>@lang('frontend-messages.UserProfile.sold')</strong></li>
                                    <li><span id="following_user">{{ $follower_user }}</span><strong>@lang('frontend-messages.UserProfile.followers')</strong></li>
                                    <li>{{ $following_user }}<strong>@lang('frontend-messages.UserProfile.following')</strong></li>
                                </ul>
                            </div>
                            <div class="follow-btn">
                                <button id="followbutton" data-following_id="{{$followingId}}" 
                                    data-follower_id="{{$followerId}}" 
                                    class="getIds
                                     
                                    {{ isset($follow_data->follow_unfollow_status) && !empty($follow_data->follow_unfollow_status) && 
                                    $follow_data->follow_unfollow_status == 1 ? 'unfollow' : '' }}"> 

                                
                                    {{ isset($follow_data->follow_unfollow_status) && !empty($follow_data->follow_unfollow_status) && 
                                        $follow_data->follow_unfollow_status == 1 ? 'Unfollow' : 'Follow' }}

                                </button>
                            </div>
                            <div class="verified-your-account">
                                <h6>@lang('frontend-messages.UserProfile.verified_your_account')</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fas fa-envelope"></i><strong>@lang('frontend-messages.UserProfile.email')<br> @lang('frontend-messages.UserProfile.verified')</strong></a>
                                    </li>
                                    @if($profileArray['phone_number_approved'] == 1)
                                    <li><a href="#"><i class="fas fa-phone"></i><strong>@lang('frontend-messages.UserProfile.phone')<br>
                                    @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    @else
                                    <li><a href="#"><i class="fas fa-phone notVerified"></i><strong>@lang('frontend-messages.UserProfile.phone')<br>
                                    @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    @endif
                                    <li><a href="#"><i class="fas fa-address-card"></i><strong>@lang('frontend-messages.UserProfile.government')<br>
                                    @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i><strong>@lang('frontend-messages.UserProfile.confirmed')</strong></a></li>
                                </ul>
                            </div>
                            <div class="verified-your-account vsb">
                                <h6>@lang('frontend-messages.UserProfile.verified_seller_badge')</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/weekly-calendar-page-symbol.png')}}"><strong>@lang('frontend-messages.UserProfile.member')<br> @lang('frontend-messages.UserProfile.since_1_year')</strong></a></li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-truck"></i><strong>@lang('frontend-messages.UserProfile.quick_shipper')</strong></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/security-on-icon.png')}}"><strong>@lang('frontend-messages.UserProfile.reliable')</strong></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="profile-seller-content">
                            <h5>{{ $profileArrayBussiness['company_legal_name'] }} <img src="{{ asset('assets/images/best-seller.png')}}"></h5>
                            @php
                            $member_since = date('M Y', strtotime($profileArrayBussiness['updated_at']));
                            @endphp
                            <p>Member since {{ $member_since }}</p>
                            <p><a href="{{ $profileArrayBussiness['website'] }}" target="_blank" style="color: black;">{{ $profileArrayBussiness['website'] }}</a></p>
                            <p><a href="tel:{{ $profileArrayBussiness['store_phone_number'] }}" style="color: black;">{{ $profileArrayBussiness['user']['phone_code'] }}
                                    {{ $profileArrayBussiness['user']['phone_number'] }}</a></p>
                            <p>CR No. : {{ $profileArrayBussiness['enter_cr_number'] }}</p>
                            <p>VAT No. : {{ $profileArrayBussiness['vat_number'] }}</p>
                            <address>
                                @php
                                $cityName = App\Models\City::where('id', $profileArrayBussiness['city_id'])->first();
                                $countryName = App\Models\Country::where('id', $profileArrayBussiness['country_id'])->first();
                                @endphp
                                <img src="{{ asset('assets/images/map-icon.png')}}">
                                @if (!empty($cityName->name))
                                {{ $cityName->name }} , {{ $countryName->name }}
                                @endif
                            </address>
                            <div class="rating">
                                <img src="{{ asset('assets/images/fill-star.png')}}">
                                <img src="{{ asset('assets/images/fill-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}">
                                <img src="{{ asset('assets/images/grey-star.png')}}">
                            </div>
                            <div class="location">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googlemap-Modal">
                                    <img src="{{ asset('assets/images/location-img.png')}}">
                                </a>
                            </div>
                            <div class="selling-number">
                                <ul>
                                    <li>{{$itemBought }}<strong>@lang('frontend-messages.UserProfile.bought')</strong></li>
                                    <li>{{ $itemSold }}<strong>@lang('frontend-messages.UserProfile.sold')</strong></li>
                                    <li><span id="following_user">{{ $follower_user }}</span><strong>@lang('frontend-messages.UserProfile.followers')</strong></li>
                                    <li>{{ $following_user }}<strong>@lang('frontend-messages.UserProfile.following')</strong></li>
                                </ul>
                            </div>
                            <div class="follow-btn">
                                <button id="followbutton" data-following_id="{{$followingId}}" 
                                    data-follower_id="{{$followerId}}" 
                                    class="getIds
                                     
                                    {{ isset($follow_data->follow_unfollow_status) && !empty($follow_data->follow_unfollow_status) && 
                                    $follow_data->follow_unfollow_status == 1 ? 'unfollow' : '' }}"> 

                                
                                    {{ isset($follow_data->follow_unfollow_status) && !empty($follow_data->follow_unfollow_status) && 
                                        $follow_data->follow_unfollow_status == 1 ? 'Unfollow' : 'Follow' }}

                                </button>
                            </div>
                            <div class="verified-your-account">
                                <h6>@lang('frontend-messages.UserProfile.verified_your_account')</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fas fa-envelope"></i><strong>@lang('frontend-messages.UserProfile.email')<br> @lang('frontend-messages.UserProfile.verified')</strong></a>
                                    </li>

                                    @if($profileArrayBussiness['user']['phone_number_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone"></i><strong>@lang('business_messages.profile.phone')<br>
                                    @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone notVerified"></i><strong>@lang('business_messages.profile.phone')<br>
                                    @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profileArrayBussiness['vat_certificate_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card"></i><strong>@lang('business_messages.profile.government')<br>
                                    @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card notVerified" style="color: gray;"></i><strong>@lang('business_messages.profile.government')<br>
                                    @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profileArrayBussiness['ministry_of_government_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="{{ asset('assets/images/ministry-of-commerce-and-industry.png')}}"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="{{ asset('assets/images/ministry-of-commerce-and-industry-logo-4BC819E9A3-seeklogo.png')}}"></a></li>
                                    @endif

                                    @if($profileArrayBussiness['upload_maroof_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="{{ asset('assets/images/Maroof-logo.png')}}"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="{{ asset('assets/images/MAROOF7.png')}}"></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="verified-your-account vsb">
                                <h6>@lang('frontend-messages.UserProfile.verified_seller_badge')</h6>
                                <ul>
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/weekly-calendar-page-symbol.png')}}"><strong>@lang('frontend-messages.UserProfile.member')<br> @lang('frontend-messages.UserProfile.since_1_year')</strong></a></li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-truck"></i><strong>@lang('frontend-messages.UserProfile.quick_shipper')</strong></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/security-on-icon.png')}}"><strong>@lang('frontend-messages.UserProfile.reliable')</strong></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="bpro-policy">
                                <ul>  
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#return_policy_madol" >*Return policy</a></li>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#terms_condition_madol">*Terms and Condition</a></li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if($profileArray['role'] == BUSINESS_ROLE)
                <div class="story-wrapper">
                    <div class="container">
                        <div class="story-slider-wrapper">
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
                                                {{env('CURRENCY_TAG')}}</strong></h5>
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
                                        {{env('CURRENCY_TAG')}}</strong></h5>
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
                        <div id="sync2" class="story-slider navigation-thumbs1 owl-carousel seller_profile_story">
                            @foreach ($userStory as $usrstr)
                            <div class="story-slider-box">
                                <a href="#">
                                    @if (!empty($usrstr->category->cate_picture))
                                    <div class="story-img"><img src="{{ asset('img/category/' . $usrstr->category->cate_picture) }}" alt="Shape"></div>
                                    @else
                                    <div class="story-img"><img src="{{ asset('img/category/placeholder.svg') }}" alt="Shape">
                                    </div>
                                    @endif
                                    <span>#{{ $usrstr->category->category_name }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif($profileArray['role'] == USER_ROLE)
                <div class="story-wrapper">
                    <div class="container">
                        <div class="story-slider-wrapper">
                            <strong class="close-story-btn">+</strong>
                            <div id="sync1" class="slider1 owl-carousel">
                                @foreach ($storyNormal as $strNor1)
                                @if (count($strNor1) > 1)
                                <div class="multi-story-slider owl-carousel">
                                    @foreach ($strNor1 as $strtestNor)
                                    <div class="item">
                                        <div class="story-slide-box">
                                            <div class="story-slide-img">
                                                <h6>
                                                    @if (isset($strtestNor['user']['profile_picture']) && !empty($strtestNor['user']['profile_picture']))
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtestNor['user']['profile_picture']) }}">
                                                    @else
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                                    @endif
                                                    {{ $strtestNor['category']['category_name'] }}
                                                    <i class='bx bx-info-circle'></i>
                                                </h6>
                                                @php
                                                $extension = pathinfo($strtestNor['video_or_image_file'], PATHINFO_EXTENSION);
                                                @endphp
                                                @if ($extension == 'mp4')
                                                <video controls autoplay="true" src="{{ asset('assets/stories/' . $strtestNor['video_or_image_file']) }}"></video>
                                                @else
                                                <img src="{{ asset('assets/stories/' . $strtestNor['video_or_image_file']) }}">
                                                @endif
                                            </div>
                                            <div class="story-slide-content">
                                                <h5>{{ $strtestNor['product_name'] }}<strong>{{ $strtestNor['product_price'] }}
                                                {{env('CURRENCY_TAG')}}</strong></h5>
                                                <p>{{ $strtestNor['story_description'] }}
                                                    @if (strlen($strtestNor['story_description']) > 30)
                                                    <a href="#">More</a>
                                                    @endif
                                                </p>
                                                <p>{{ $strtestNor['store_location'] }}</p>
                                                <a href="#" class="btn">Make an offer</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                @foreach ($strNor1 as $strtestNor)
                                <div class="story-slide-box">
                                    <div class="story-slide-img">
                                        <h6>
                                            @if (isset($strtestNor['user']['profile_picture']) && !empty($strtestNor['user']['profile_picture']))
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtestNor['user']['profile_picture']) }}">
                                            @else
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                            @endif
                                            {{ $strtestNor['category']['category_name'] }}
                                            <i class='bx bx-info-circle'></i>
                                        </h6>
                                        @php
                                        $extension = pathinfo($strtestNor['video_or_image_file'], PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($extension == 'mp4')
                                        <video controls autoplay src="{{ asset('assets/stories/' .strtestNor['video_or_image_file']) }}"></video>
                                        @else
                                        <img src="{{ asset('assets/stories/' . $strtestNor['video_or_image_file']) }}">
                                        @endif
                                    </div>
                                    <div class="story-slide-content">
                                        <h5>{{ $strtestNor['product_name'] }}<strong>{{ $strtestNor['product_price'] }}
                                        {{env('CURRENCY_TAG')}}</strong></h5>
                                        <p> {{ $strtestNor['story_description'] }}
                                            @if (strlen($strtestNor['story_description']) > 5)
                                            <a href="#">More</a>
                                            @endif
                                        </p>
                                        <p>{{ $strtestNor['store_location'] }}</p>
                                        <a href="#" class="btn">Make an offer</a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div id="sync2" class="story-slider navigation-thumbs1 owl-carousel seller_profile_story">
                            @foreach ($userStoryNormal as $usrstrNor)
                            <div class="story-slider-box">
                                <a href="#">
                                    @if (!empty($usrstrNor->category->cate_picture))
                                    <div class="story-img"><img src="{{ asset('img/category/' . $usrstrNor->category->cate_picture) }}" alt="Shape"></div>
                                    @else
                                    <div class="story-img"><img src="{{ asset('img/category/placeholder.svg') }}" alt="Shape">
                                    </div>
                                    @endif
                                    <span>#{{ $usrstrNor->category->category_name }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <!-- end story-wrapper -->

                <div class="row">
                    <div class="pagination-hidden-section">
                        <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                    </div>
                </div>
                <!-- pagination-hidden-section  end-->
                <div class="products-wrapper">
                    <div class="row" id="pagingBox">
                        @if(!empty($itemArray) && count($itemArray) > 0)
                        @foreach ($itemArray as $key => $item)
                        <div class="col-md-4">
                            <div class="products-box">
                                <div class="products-box-img">
                                    <span class="featured">Featured</span>
                                    @if (!empty($item['boostItem']['item_id']))
                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                    <span class="featured">Featured</span>
                                    @endif
                                    @endif
                                    @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                    @endif
                                    <a href="javascript:void(0)" class="wish-list-icon">
                                        <i data-id="{{ $item['id'] }}" class="bx bxs-heart" @if(isset($item['wishlist']['wishlist_status']) && !empty($item['wishlist']['wishlist_status']) && $item['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                <div class="products-box-content">
                                    @if ($item['condition']['name'] == NEW_ITEMS)
                                    <span class="used-btn new-btn">{{ $item['condition']['name'] }}</span>

                                    @elseif($item['condition']['name'] == USED_ITEMS)
                                    <span class="used-btn used-btn">{{ $item['condition']['name'] }}</span>

                                    @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                    <span class="used-btn unused-btn">{{ $item['condition']['name'] }}</span>
                                    @else
                                    <span class="used-btn">{{ $item['condition']['name'] }}</span>
                                    @endif
                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $item['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $item['brand']['name'] }}</p>
                                    <p>
                                        @if (!empty($item['store']['store_name']))
                                    <p>{{ $item['store']['store_location'] }}</p>
                                    @else
                                    <p>{{ $item['city']['name'] }}</p>
                                    @endif
                                    </p>
                                    <div class="products-box-footer">

                                        @if (isset($item['user']['profile_picture']) && !empty($item['user']['profile_picture']))
                                        <img src="{{ asset('assets/users/'.$item['user']['profile_picture']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                        @endif
                                        @if (!empty($item['user']['username']))
                                        <p>{{ $item['user']['username'] }}</p>
                                        @else
                                        <p>{{ $item['user']['first_name'] }}</p>
                                        @endif
                                        @auth
                                        <i class='product-dots'></i>
                                        @else
                                        <i class="product-dots disable"></i>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- products-wrapper -->

                <div class="pagination-wrapper">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Return policy modal  -->
<div class="modal fade" id="return_policy_madol" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">@lang('business_messages.return_policy.return_policy')</h5>
            <p>
                @if(!empty($return_policy->description))
                {!! $return_policy->description !!}
                @else
                @lang('business_messages.return_policy.comming_soon')
                @endif()
            </p>
            <!-- <p><a href="javascript:void(0)" data-bs-dismiss="modal">@lang('business_messages.return_policy.close')</a></p> -->
        </div>
    </div>
</div>
<!-- Return policy modal modal  End-->


<!-- Terms & Condition modal  -->
<div class="modal fade" id="terms_condition_madol" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">@lang('business_messages.profile.terms_condition')</h5>
            <p>
                @if(!empty($term_condition->description))
                {!! $term_condition->description !!}
                @else
                @lang('business_messages.return_policy.comming_soon')
                @endif()
            </p>
            <!-- <p><a href="javascript:void(0)" data-bs-dismiss="modal">@lang('business_messages.return_policy.close')</a></p> -->
        </div>
    </div>
</div>
<!-- Terms & Condition modal  End-->

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('assets/images/try-tejarg-app.png')}}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/google-play.png')}}"> </a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/app-store.png')}}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Review Rating -->

    <div class="modal fade" id="seller_review_writing_btton" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content new-review">
                <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="m-25">Write a Review</h5>
    
                <form id="customer_review_post_seller" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="reviewer_userId" value="{{Auth::id()}}">
                    <input type="hidden" name="sellerId"  value="{{$profileArray['id']}}">
                    <input type="hidden" name="rating_data" id="rating_data" class="rating_data_check" value="">

                    <div class="review-dialog-list">
                        <div class="customer-review">
                            <div class="review-img">
                                <a href="javascript:void(0)" id="review_profile" class="review_profile">
                                    @if (isset(Auth::user()->profile_picture))
                                        <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                                    @else
                                        <img src="{{ asset('assets/images/user.png') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="review-sec">
                                <div class="review-content">
                                    <h5>

                                        @if (isset(Auth::user()->first_name))
                                             <span class="first_name" id="first_name">{{Auth::user()->first_name}}</span>
                                             <span class="last_name" id="last_name">{{Auth::user()->last_name}}</span>
                                        @endif
                                       
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h4 class="text-center mt-2 mb-4 star_ratting">
                                <i class="fas fa-star star-light submit_star mr-1 add_review_start5" id="submit_star_1"
                                    data-rating="1"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2"
                                    data-rating="2"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3"
                                    data-rating="3"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4"
                                    data-rating="4"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5"
                                    data-rating="5"></i>
                            </h4>
                        </div>
                        <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control"
                                placeholder="Enter Your Name">
                        </div>
                        <div class="form-group mb-2">
                            <div class="new-user-review">
                                <textarea name="user_review_description" id="user_review_description" rows="4" cols="50"
                                    placeholder="Share details of your own experience at this place"></textarea>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="input-group file-upload">
                                <div class="file-upload-div review">
                                    <input type='file' onchange="readURL0022(this);" name="user_review_items_Image"
                                        id="user_review_items_Image">
                                    <img id="blah0022" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                                    Add photos
                                    <video controls autoplay poster="/images/w3html5.gif" id="video10"
                                        style="display: none;"></video>
                                </div>
                                <label id="user_review_items_Image-error" class="error"
                                    for="user_review_items_Image"></label>
                            </div>
                        </div> --}}
                        <div class="review-btn-sec">
                            <button type="button" style="width:100px" class="btn-cancle" data-bs-dismiss="modal" aria-label="Close">Cancle</button>
                            <button type="submit" style="width:100px" class="btn-post review_submit_btn_mute" id="save_review" disabled>Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Review Rating End-->

<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />

<script>
    // product details slider 
    $(document).ready(function() {
        var sync1 = $(".slider1");
        var sync2 = $(".navigation-thumbs1");
        var thumbnailItemClass = '.owl-item';
        var slides = sync1.owlCarousel({
            video: true,
            startPosition: 12,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                767: {
                    items: 3,
                    margin: 15,
                },
                1200: {
                    items: 5,
                    margin: 20,
                }
            },
            loop: false,
            touchDrag: false,
            mouseDrag: false,
            nav: true,
            dots: false,
            video: true,
            lazyLoad: true,
            center: true
        }).on('changed.owl.carousel', syncPosition);


        function syncPosition(el) {
            $owl_slider = $(this).data('owl.carousel');
            var loop = $owl_slider.options.loop;

            if (loop) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
            } else {
                var current = el.item.index;
            }

            var owl_thumbnail = sync2.data('owl.carousel');
            var itemClass = "." + owl_thumbnail.options.itemClass;


            var thumbnailCurrentItem = sync2
                .find(itemClass)
                .removeClass("synced")
                .eq(current);

            thumbnailCurrentItem.addClass('synced');
            thumbnailCurrentItem.addClass('see-this-story');

            if (!thumbnailCurrentItem.hasClass('active')) {
                var duration = 300;
                sync2.trigger('to.owl.carousel', [current, duration, true]);

            }
        }
        var thumbs = sync2.owlCarousel({
                startPosition: 1,
                items: 12,
                responsive: {
                    1200: {
                        margin: 20,
                    },
                    767: {
                        margin: 15,
                    },
                    0: {
                        margin: 10,
                    }
                },
                autoWidth: true,
                loop: false,
                margin: 0,
                autoplay: false,
                nav: false,
                dots: false,
                onInitialized: function(e) {
                    var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                    thumbnailCurrentItem.addClass('synced');
                    thumbnailCurrentItem.addClass('see-this-story');

                },
            })
            .on('click', thumbnailItemClass, function(e) {
                e.preventDefault();
                var duration = 300;
                var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
            }).on("changed.owl.carousel", function(el) {
                var number = el.item.index;
                $owl_slider = sync1.data('owl.carousel');
                $owl_slider.to(number, 100, true);
            });

        $('.story-slider-wrapper').hide();
        $('#sync2 .owl-item').click(function() {
            $('.story-slider-wrapper').show();
            $('body').css('overflow', 'hidden');
        })

        $('.close-story-btn').click(function() {
            $('.story-slider-wrapper').hide();
            $('body').css('overflow', 'unset');
        });

        var videoSlider = $('.multi-story-slider.owl-carousel');
        videoSlider.owlCarousel({
            margin: 0,
            nav: false,
            dots: true,
            animateOut: 'fadeOut',
            navText: [
                "<i class='bx bx-left-arrow-alt'></i>",
                "<i class='bx bx-right-arrow-alt'></i>"
            ],
            items: 1,
            smartSpeed: 1000,
            loop: false
        });




        $('#sync2 .owl-item').click(function() {
            setTimeout(function() {
                if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {
                    $('.owl-item.active .item video').get(0).play();
                    $(this).get(0).currentTime = 0;
                } else {
                    $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).pause();
                    $(this).get(0).currentTime = 0;
                }
            }, 1000);
        })

        $('.close-story-btn').click(function() {
            $('.item video').get(0).pause();
        })


        sync1.on('translate.owl.carousel', function(e) {
            setTimeout(function() {
                $('.multi-story-slider .owl-item .item video').each(function() {
                    $(this).get(0).pause();
                    $(this).get(0).currentTime = 0;
                });
            }, 1000);
            setTimeout(function() {
                if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {
                    $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).play();
                    $(this).get(0).currentTime = 0;
                }
            }, 1000);
        });
        $('.owl-item.active.see-this-story').removeClass('see-this-story');
    });
</script>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @elseif(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('warning'))
        toastr.error('{{ Session::get('
            warning ') }}');
        @elseif(Session::has('info'))
        toastr.error('{{ Session::get('
            info ') }}');
        @endif
    });

    $('#followbutton').click(function() {


        $(this).text(function(_, text) {
            return text === "Follow" ? "Unfollow" : "Follow";
        });

        if($(this).text() == "Follow") {

            $(this).removeClass('unfollow');

        } else if($(this).text() == "Unfollow") {

            $(this).addClass('unfollow');
        }

        let following_id = $('.getIds').attr("data-following_id");
        let follower_id = $('.getIds').attr("data-follower_id");
        let follow_unfollow_status = $('#followbutton').text();
        let token = "{{csrf_token()}}";

        $.ajax({
            url:'{{route("frontend.users.profile-seller.followers")}}',
            type: "post",
            dataType: "json",
            data: {'following_id': following_id,'follower_id': follower_id,'follow_unfollow_status': follow_unfollow_status, _token:token},
            success: function (data) {
                document.getElementById("following_user").innerHTML = data.data;   
            }
        });
    });
</script>
<script type="text/javascript">

    
    function load_rating_data() {

        var userIds = $('#userOfReviewId').val();
        var itemsIds = $('#itemOfId').val();
        var token = "{{ csrf_token() }}";

        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{ route("frontend.users.my-orders.users_retrive_reviews") }}',
            data: {
                'userId': userIds,
                'itemId': itemsIds,
                _token: token
            },
            success: function(data) {
                if (data) {
                    $('#reviewMessageSection').html(data);
                } else {
                    location.reload();
                }
            },
            timeout: 10000
        });
    }

    var rating_data = 0;
    $('.add_review_start5').click(function() {
        $('#submit_star_' + count).addClass('btn_mute');
        $('#submit_star_' + count).removeClass('btn_mute');
    });

    $(document).on('mouseenter', '.submit_star', function() { 
        var rating = $(this).data('rating');
        reset_background();
        for (var count = 1; count <= rating; count++) {
            $('#submit_star_' + count).addClass('text-warning');

        }
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' + count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function() {
        reset_background();
        for (var count = 1; count <= rating_data; count++) {
            $('#submit_star_' + count).removeClass('star-light');
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
        $('#rating_data').val(rating_data);
        if ($('.rating_data_check').val() != '')
        {
            $('button#save_review').prop('disabled', false).removeClass('review_submit_btn_mute');
        }
    });
    
    $("#customer_review_post_seller").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            "user_name": {
                required: true,
            },
            "user_review_description": {
                required: true,
            },
            "user_review_items_Image": {
                required: true,
            },
        },
        messages: {
            "user_name": {
                required: "{{ __('frontend-messages.review_post.validation.user_name') }}",
            },
            "user_review_description": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_description') }}",
            },
            "user_review_items_Image": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_items_Image') }}",
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText =
                '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formdata = new FormData(document.getElementById("customer_review_post_seller"));
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: "{{ route('frontend.users.seller-reviews.seller_review_post_store') }}",
                data: formdata,
                success: function(data) {
                    $('#seller_review_writing_btton').modal('hide');
                    // $('#seller_review_writing_btton').modal('show');
                    window.location.reload();

                    //load_rating_data();
                }
            })
        }
    });
</script>
<style>
    
    .follow {
      flex: 1;
      margin: 10px;
      align-self: center;
    }
    button {
      background: #0AD188;
      border: none;
      padding: 10px 10px;
      color: whitesmoke;
      width: 100%;
      border-radius: 5px;
      transition: all .3s ease-in;
    }
    button:active {
      outline: none;
    }
    button:visited {
      outline: none;
    }
    .unfollow {
      background: #455bc0;
      color: white;
    }
</style>
@endsection