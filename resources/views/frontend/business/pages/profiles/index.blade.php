@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Profile'}}
@endsection

@section('content')

<div class="mini-banner replace-img-wrapper">
    <form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="business_banner_replace">
        @csrf
        <img src=" @if (isset($bannerReplace)) {{ asset(BUSINESS_BANNER_FOLDER . '/' . $bannerReplace['banner_image']) }} @endif" id="blah02">
        <div class="replace-img">
            <h5>@lang('frontend-messages.UserProfile.Userbanner.title')</h5>
            <div class="banner-input-file">
                <input type='file' onchange="readURL02(this);" name="business_replace_banner_image" id="file" />
                <a href="#" class="btn">@lang('frontend-messages.UserProfile.Userbanner.btn')</a>
            </div>
            <div class="form-group submit" style="display:none;">
                <input type="submit" id="banner_submit_btn" class="btn btn-info" value="send">
            </div>
        </div>
    </form>
</div>

<div class="profile-seller business-profile-seller">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-seller-sidebar">
                    <div class="profile-seller-img-content">
                        <div class="profile-seller-img">
                            @if (!empty($profileArray['user']['profile_picture']))
                            <img class="or_profile_img" src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . Auth::user()->profile_picture) }}">
                            @else
                            <img src="{{ asset('assets/images/user.png') }}">
                            @endif
                        </div>
                        <div class="profile-seller-content">
                            @if(!empty($profilebusinessArray))
                            <h5>{{ $profilebusinessArray['company_name'] }}<img src="assets/images/img/best-seller.png"></h5>
                            @else
                            <h5>{{ $profileArray['company_name'] }}<img src="assets/images/img/best-seller.png"></h5>
                            @endif
                            @php
                            if(!empty($profilebusinessArray)){
                            $member_since = date('M Y', strtotime($profilebusinessArray['user']['updated_at']));
                            }else{
                            $member_since = date('M Y', strtotime($profileArray['user']['updated_at']));
                            }
                            @endphp
                            <p>@lang('business_messages.profile.member_since') {{ $member_since }}</p>
                            @if(!empty($profilebusinessArray))
                            <p><a href="{{ $profilebusinessArray['website'] }}" target="_blank">{{ $profilebusinessArray['website'] }}</a></p>
                            @else
                            <p><a href="{{ $profileArray['website'] }}" target="_blank">{{ $profileArray['website'] }}</a></p>
                            @endif
                            @if(!empty($profilebusinessArray))
                            <p><a href="tel:{{ $profilebusinessArray['store_phone_number'] }}">{{ $profilebusinessArray['user']['phone_code'] }}
                                    {{ $profilebusinessArray['user']['phone_number'] }}</a></p>
                            @else
                            <p><a href="tel:{{ $profileArray['store_phone_number'] }}">{{ $profileArray['user']['phone_code'] }}
                                    {{ $profileArray['user']['phone_number'] }}</a></p>
                            @endif
                            @if(!empty($profilebusinessArray))
                            <p> @lang('business_messages.profile.cr_no') {{ $profilebusinessArray['enter_cr_number'] }}</p>
                            @else
                            <p> @lang('business_messages.profile.cr_no') {{ $profileArray['enter_cr_number'] }}</p>
                            @endif
                            @if(!empty($profilebusinessArray))
                            <p> @lang('business_messages.profile.vat_no') {{ $profilebusinessArray['vat_number'] }}</p>
                            @else
                            <p> @lang('business_messages.profile.vat_no') {{ $profileArray['vat_number'] }}</p>
                            @endif
                            @if(!empty($profilebusinessArray))
                            <address>
                                @php
                                $cityName = App\Models\City::where('id', $profilebusinessArray['city_id'])->first();
                                @endphp
                                <img src="assets/images/img/map-icon.png">
                                @if (!empty($cityName->name))
                                {{ $cityName->name }}
                                @endif
                            </address>
                            @else
                            <address>
                                @php
                                $cityName = App\Models\City::where('id', $profileArray['city_id'])->first();
                                @endphp
                                <img src="assets/images/img/map-icon.png">
                                @if (!empty($cityName->name))
                                {{ $cityName->name }}
                                @endif
                            </address>
                            @endif
                            <div class="rating mb-3" style="margin:auto; float:none; display:inline-block">
                                {{-- <img src="assets/images/img/fill-star.png">
                                <img src="assets/images/img/fill-star.png">
                                <img src="assets/images/img/grey-star.png">
                                <img src="assets/images/img/grey-star.png">
                                <img src="assets/images/img/grey-star.png"> --}}
                                <a href="javascript:void(0)" style="text-align: center">
                                    <div class="cxeKyx">
                                        <div  color="#0AD188" class="kCxoGQ">
                                            <span class="bFgxSY">{{$totalReviewAvg}}</span> 
                                            <label><i class="fas fa-star ratings_color_set"></i></label>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="location">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googlemap-Modal">
                                    <img src="assets/images/img/location-img.png">
                                </a>
                            </div>
                            <div class="selling-number">
                                <ul>
                                    <li><a href="{{route('frontend.business.profile.bought_details')}}">{{ $itemBought }}<strong style="color:black">@lang('business_messages.profile.bought')</strong></a></li>
                                    <li><a href="{{route('frontend.business.profile.sold_details')}}">{{ $itemSold }}<strong style="color:black">@lang('business_messages.profile.sold')</strong></a></li>
                                    <li><a href="{{route('frontend.business.profile.follower_details')}}">{{ $follower_user }}<strong style="color:black">@lang('business_messages.profile.followers')</strong></a></li>
                                    <li><a href="{{route('frontend.business.profile.following_details')}}">{{ $following_user }}<strong style="color:black">@lang('business_messages.profile.following')</strong></a></li>
                                </ul>
                            </div>
                            @if(!empty($profilebusinessArray))

                            @else

                            <div class="follow-btn">
                                <ul>
                                    <li><a href="{{ route('frontend.business.business-profile.editProfile') }}" class="btn trans-btn">@lang('business_messages.profile.edit_profile')</a></li>
                                    <li><a href="javascript:void(0)" class="btn trans-btn" data-bs-toggle="modal" data-bs-target="#business_profile_change_password">@lang('business_messages.profile.change_password')</a></li>
                                </ul>
                            </div>
                            @endif
                            @if(!empty($profilebusinessArray))
                            <div class="verified-your-account">
                                <h6>@lang('business_messages.profile.verified_seller_account')</h6>
                                <ul>
                                    <li><a href="javavascript:void(0)"><i class="fas fa-envelope"></i><strong>@lang('business_messages.profile.email')<br> @lang('business_messages.profile.verified')</strong></a>
                                    </li>
                                    @if(Auth::user()->phone_number_approved == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone"></i><strong>@lang('business_messages.profile.phone')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone notVerified"></i><strong>@lang('business_messages.profile.phone')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profilebusinessArray['vat_certificate_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card"></i><strong>@lang('business_messages.profile.government')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card notVerified"></i><strong>@lang('business_messages.profile.government')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profilebusinessArray['ministry_of_government_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/ministry-of-commerce-and-industry.png"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/ministry-of-commerce-and-industry-logo-4BC819E9A3-seeklogo.png"></a></li>
                                    @endif

                                    @if($profilebusinessArray['upload_maroof_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/Maroof-logo.png"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/MAROOF7.png"></a></li>
                                    @endif

                                </ul>
                            </div>
                            @else
                            <div class="verified-your-account">
                                <h6>@lang('business_messages.profile.verified_seller_account')</h6>
                                <ul>
                                    <li><a href="javavascript:void(0)"><i class="fas fa-envelope"></i><strong>@lang('business_messages.profile.email')<br> @lang('business_messages.profile.verified')</strong></a>
                                    </li>
                                    @if(Auth::user()->phone_number_approved == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone"></i><strong>@lang('business_messages.profile.phone')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-phone notVerified"></i><strong>@lang('business_messages.profile.phone')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profileArray['vat_certificate_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card"></i><strong>@lang('business_messages.profile.government')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><i class="fas fa-address-card notVerified"></i><strong>@lang('business_messages.profile.government')<br>
                                                @lang('business_messages.profile.verified')</strong></a></li>
                                    @endif

                                    @if($profileArray['ministry_of_government_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/ministry-of-commerce-and-industry.png"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/ministry-of-commerce-and-industry-logo-4BC819E9A3-seeklogo.png"></a></li>
                                    @endif

                                    @if($profileArray['upload_maroof_approved'] == 1)
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/Maroof-logo.png"></a></li>
                                    @else
                                    <li><a href="javavascript:void(0)"><img src="assets/images/img/MAROOF7.png"></a></li>
                                    @endif

                                </ul>
                            </div>
                            @endif
                            <div class="verified-your-account vsb">
                                <h6>@lang('business_messages.profile.verified_seller_badge')</h6>
                                <ul>
                                    @if(Auth::user()->member_since_approved == 1)
                                    <li><a href="javascript:void(0)"><img src="assets/images/img/weekly-calendar-page-symbol.png"><strong>@lang('business_messages.profile.member')<br> Since 1 year</strong></a></li>
                                    @else
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/weekly-calendar-page-symbol-gray.png') }}"><strong>@lang('business_messages.profile.member')<br> Since 1 year</strong></a></li>
                                    @endif
                                    @if (Auth::user()->quick_shipper_approved == 1)
                                    <li><a href="javascript:void(0)"><i class="fas fa-truck"></i><strong>@lang('business_messages.profile.quick_shipper')</strong></a>
                                    </li>
                                    @else
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/delivery-truck-gray.png') }}"><strong>@lang('business_messages.profile.quick_shipper')</strong></a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->reliable_approved == 1)
                                    <li><a href="javascript:void(0)"><img src="assets/images/img/security-on-icon.png"><strong>@lang('business_messages.profile.reliable')</strong></a>
                                    </li>
                                    @else
                                    <li><a href="javascript:void(0)"><img src="{{ asset('assets/images/security-on-gray.png') }}"><strong>@lang('business_messages.profile.reliable')</strong></a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @if(!empty($profilebusinessArray))
                            @else
                            <div class="bpro-policy">
                                <ul>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#return_policy_madol">* @lang('business_messages.profile.return_policy')</a> &nbsp; &nbsp; <a class="edit-link" href="{{ route('frontend.business.profile.return_policy') }}"><i class="fas fa-edit"></i></a></li>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#terms_condition_madol">* @lang('business_messages.profile.terms_condition')</a>&nbsp; &nbsp; <a class="edit-link" href="{{ route('frontend.business.profile.term_condition') }}"><i class="fas fa-edit"></i></a></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="story-wrapper">
                    <div class="container">
                        <div class="add-story">
                            <i class='bx bx-plus' data-bs-toggle="modal" data-bs-target="#bProfileUploadingStory"></i>
                            <span>@lang('frontend-messages.UserStory.storytext')</span>
                        </div>
                        <div class="story-slider-wrapper">
                            <strong class="close-story-btn">+</strong>
                            <div id="sync1" class="slider1 owl-carousel">
                                @if (Auth::check())
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
                                @endif
                            </div>
                        </div>
                        <div id="sync2" class="story-slider navigation-thumbs1 owl-carousel">
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
                <!-- end story-wrapper -->
                <!-- pagination-hidden-section  start-->
                <div class="row">
                    <div class="pagination-hidden-section">
                        <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                    </div>
                </div>
                <!-- pagination-hidden-section  end-->
                <div class="products-wrapper">
                    <div class="row" id="pagingBox">
                        <div class="col-md-4">
                            <div class="products-box add-items">
                                <a href="{{ route('frontend.business.item-post.index') }}">
                                    <img src="assets/images/img/add-items-icon.png">
                                    <h5>@lang('business_messages.profile.story.add_items')</h5>
                                </a>
                            </div>
                        </div>
                        @if (Auth::check())
                        @if (!empty($itemArray) && count($itemArray) > 0)
                        @foreach ($itemArray as $key => $item)
                        <div class="col-md-4">
                            <div class="products-box">
                                <div class="products-box-img">
                                    <a href="{{ route('frontend.business.boost-items.item_details', base64_encode($item['id'])) }}">
                                        @if (!empty($item['boostItem']['item_id']))
                                        @if ($item['id'] == $item['boostItem']['item_id'])
                                        <span class="featured">@lang('business_messages.profile.featured')</span>
                                        @endif
                                        @endif
                                        @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                        <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                        @endif
                                    </a>
                                    <!-- <a href="javascript:void(0)">
                                        <i data-id="{{ $item['id'] }}" class="bx bxs-heart" @if(isset($item['wishlist']['wishlist_status']) && !empty($item['wishlist']['wishlist_status']) && $item['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a> -->
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
                                    <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{ $item['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $item['brand']['name'] }}</p>

                                    @if (!empty($item['store']['store_name']))
                                    <p>{{ $item['store']['store_location'] }}</p>
                                    @else
                                    <p>{{ $item['city']['name'] }}</p>
                                    @endif

                                    <div class="products-box-footer">
                                        @if ($item['user']['role'] == USER_ROLE)
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
                                        @else
                                        @if (isset($item['store']['store_logo_file']) && !empty($item['store']['store_logo_file']))
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $item['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                        @endif
                                        @if (!empty($item['store']['store_name']))
                                        <p>{{ $item['store']['store_name'] }}</p>
                                        @else
                                        <p>{{ $item['user']['first_name'] }}</p>
                                        @endif
                                        @auth
                                        <i class='product-dots'></i>
                                        @else
                                        <i class="product-dots disable"></i>
                                        @endauth
                                        @endif
                                    </div>
                                    @if(auth()->user()->id == $item['user_id'])
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <div class="products-box-footer">
                                        <a class="" href="{{route('frontend.store.item-post.edit',$item['id'])}}" style="margin-right:10px;">
                                            <i class="fas fa-edit"></i></a>
                                        <a class="post_delete_business" href="javascript:void(0)" data-id="{{ $item['id'] }}"><i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    @else
                                    <div class="products-box-footer">
                                        <a class="" href="{{route('frontend.business.item-post.edit',$item['id'])}}" style="margin-right:10px;">
                                            <i class="fas fa-edit"></i></a>
                                        <a class="post_delete_business" href="javascript:void(0)" data-id="{{ $item['id'] }}"><i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    @endif
                                    @else
                                    <div class="products-box-footer">
                                        <a class="" href="" style="margin-right:10px;"></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
                </div>
                <!-- products-wrapper -->

                <!-- pagination  start-->
                @if (!empty($itemArray) && count($itemArray) > 0)
                <div class="pagination-wrapper">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
                @endif
                <!-- pagination end-->
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
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
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



<!-- Business Password Changes modal  -->
<div class="modal fade" id="business_profile_change_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">@lang('business_messages.change_password.change_pwd_title')</h5>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{ route('frontend.business.business-profile.businessChangePassword') }}" enctype="multipart/form-data" method="post" id="business_pwd_change">
                @csrf
                <div class="input-group">
                    <input type="password" name="current_password" placeholder="@lang('business_messages.change_password.enter_old_password')" class="form-control">
                </div>
                <div class="input-group">
                    <input type="password" name="new_password" id="new_password_business" placeholder="@lang('business_messages.change_password.enter_new_password')" class="form-control">
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_new_password" placeholder="@lang('business_messages.change_password.confirm_new_password')" class="form-control">
                </div>
                <div class="form-group submit">
                    <input type="submit" id="btnTest" class="btn btn-primary" value="@lang('business_messages.change_password.save')">
                </div>
            </form>
            <!-- <p><a href="javascript:void(0)" data-bs-dismiss="modal">@lang('business_messages.change_password.cancel')</a></p> -->
        </div>
    </div>
</div>
<!-- Business Password Changes modal  End-->

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

<!-- delete modal Modal start-->
<div class="modal fade" id="profile_post_delete" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="items_delete_popup">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
            </button> --}}
            </div>
            <div class="modal-body">
                <p style="text-align: left"> <strong>Are you sure to Delete Item ?</strong></p>
            </div>
            <form action="{{route('frontend.business.business-profile.post_removed')}}" method="POST">
                @csrf
                <input type="hidden" name="post_id" class="post_id">
                <div class="modal-footer">
                    <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>

                    <button type="submit" class="btn delete_post ml-1 post_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.delete')</strong></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal Modal start-->
<style>
    button.btn.delete_post {
        padding: 5px 15px;
    }
</style>
<!-- <link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/pagination.css') }}"> -->
<!-- <script src="{{ asset('fronted/slider_js/profile_slider.js') }}"></script> -->
<!-- <script src="{{ asset('fronted/slider_js/pagination.js') }}"></script> -->
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/profille_slider/b_story_slider.js') }}"></script>

@endsection