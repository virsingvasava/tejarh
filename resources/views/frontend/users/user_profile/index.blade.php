@extends('frontend.users.layouts.master')
@section('title')
{{ 'Tejarh - User Profile' }}
@endsection

@section('content')

<div class="mini-banner replace-img-wrapper">
    <form action="javascript:void(0)" id="banner_submit_image" method="POST">
        <img src=" @if (isset($UserBannerImage)) {{ asset('assets/banner/' . $UserBannerImage['banner_image']) }} @endif" id="blah13">
        <div class="replace-img">
            <h5>@lang('frontend-messages.UserProfile.Userbanner.title')</h5>
            <div class="banner-input-file">
                <input type='file' onchange="readURL13(this);" name="file" id="file" />
                <a href="#" class="btn">@lang('frontend-messages.UserProfile.Userbanner.btn')</a>
            </div>
            <div class="form-group submit" style="display: none;">
                <input type="submit" id="banner_submit_btn" class="btn btn-primary" value="send">
            </div>
        </div>
    </form>
</div>

<div class="profile-seller business-profile-seller">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="post_deleted_message"></div>
                <div class="profile-seller-sidebar">
                    <div class="profile-seller-img-content">
                        <div class="profile-seller-img">
                            @if (isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
                            <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                            @else
                            <img src="{{ asset('assets/images/user.png') }}">
                            @endif
                        </div>
                        <div class="profile-seller-content">
                            <h5>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<img src="{{ asset('assets/images/best-seller.png') }}"></h5>
                            <p>@lang('frontend-messages.UserProfile.member_since') {{ date('M Y', strtotime(Auth::user()->created_at)) }}</p>

                            <div class="rating">
                                <img src="{{ asset('assets/images/fill-star.png') }}">
                                <img src="{{ asset('assets/images/fill-star.png') }}">
                                <img src="{{ asset('assets/images/grey-star.png') }}">
                                <img src="{{ asset('assets/images/grey-star.png') }}">
                                <img src="{{ asset('assets/images/grey-star.png') }}">
                            </div>

                            <address>
                                <img src="{{ asset('assets/images/map-icon.png') }}">
                                @if (!empty($getCity->name) && !empty($getState->name))
                                {{ $getCity->name }} , {{ $getState->name }}
                                @endif
                            </address>

                            <div class="selling-number">
                                <ul>
                                    <li><a href="{{ route('frontend.users.profile.bought_details') }}"><b style="color:black">{{ $itemBought }}</b><strong style="color:black">@lang('frontend-messages.UserProfile.bought')</strong></a></li>
                                    <li><a href="{{ route('frontend.users.profile.sold_details') }}"><b style="color:black">{{ $itemSold }}</b><strong style="color:black">@lang('frontend-messages.UserProfile.sold')</strong></a></li>
                                    <li><a href="{{ route('frontend.users.profile.follower-details') }}"><b style="color:black">{{ $follower_user }}</b><strong style="color:black">@lang('frontend-messages.UserProfile.followers')</strong></a></li>
                                    <li><a href="{{ route('frontend.users.profile.following-details') }}"><b style="color:black">{{ $following_user }}</b><strong style="color:black">@lang('frontend-messages.UserProfile.following')</strong></a></li>
                                </ul>
                                <div class="follow-btn">
                                    <!-- <a href="#" class="btn">Follow</a> -->
                                    <a href="javascript:void(0) " class="btn trans-btn" data-bs-toggle="modal" data-bs-target="#edit-profile">@lang('frontend-messages.UserProfile.Edit.btn')</a>
                                </div>
                                <br>

                            </div>
                            <div class="verified-your-account">
                                <h6>@lang('frontend-messages.UserProfile.verified_your_account')</h6>
                                <ul>
                                    <li><a href="#"><i class="fas fa-envelope"></i><strong>@lang('frontend-messages.UserProfile.email')<br>
                                                @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    @if (Auth::user()->phone_number_approved == 1)
                                    <li><a href="#"><i class="fas fa-phone"></i><strong>@lang('frontend-messages.UserProfile.phone')<br>
                                                @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    @else
                                    <li><a href="#"><i class="fas fa-phone notVerified"></i><strong>@lang('frontend-messages.UserProfile.phone')<br>
                                                @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    @endif
                                    <li><a href="#"><i class="fas fa-address-card"></i><strong>@lang('frontend-messages.UserProfile.government')<br>
                                                @lang('frontend-messages.UserProfile.verified')</strong></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i><strong>@lang('frontend-messages.UserProfile.confirmed')</strong></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="verified-your-account vsb">
                                <h6>@lang('frontend-messages.UserProfile.verified_seller_badge')</h6>
                                <ul>
                                    @if (Auth::user()->member_since_approved == 1)
                                    <li><a href="#"><img src="{{ asset('assets/images/weekly-calendar-page-symbol.png') }}"><strong>@lang('frontend-messages.UserProfile.member')
                                                <br>@lang('frontend-messages.UserProfile.since_1_year')</strong></a>
                                    </li>
                                    @else
                                    <li><a href="#"><img src="{{ asset('assets/images/weekly-calendar-page-symbol-gray.png') }}"><strong>@lang('frontend-messages.UserProfile.member')
                                                <br>@lang('frontend-messages.UserProfile.since_1_year')</strong></a>
                                    </li>
                                    @endif

                                    @if (Auth::user()->quick_shipper_approved == 1)
                                    <li><a href="#"><i class="fas fa-truck"></i><strong>@lang('frontend-messages.UserProfile.quick_shipper')</strong></a>
                                    </li>
                                    @else
                                    <li><a href="#"><img src="{{ asset('assets/images/delivery-truck-gray.png') }}"></i><strong>@lang('frontend-messages.UserProfile.quick_shipper')</strong></a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->reliable_approved == 1)
                                    <li><a href="#"><img src="{{ asset('assets/images/security-on-icon.png') }}"><strong>@lang('frontend-messages.UserProfile.reliable')</strong></a>
                                    </li>
                                    @else
                                    <li><a href="#"><img src="{{ asset('assets/images/security-on-gray.png') }}"><strong>@lang('frontend-messages.UserProfile.reliable')</strong></a>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="story-wrapper">
                    <div class="container">
                        <div class="add-story">
                            <i class='bx bx-plus' data-bs-toggle="modal" data-bs-target="#Uploading-Story"></i>
                            <span>@lang('frontend-messages.UserStory.storytext')</span>
                        </div>
                        <div class="story-slider-wrapper">
                            <strong class="close-story-btn">+</strong>
                            <div id="sync1" class="slider1 owl-carousel">
                                @if (Auth::check())
                                @foreach ($Story as $str1)
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
                                    <span>{{ $usrstr->category->category_name }}</span>
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
                                <a href="{{ route('frontend.users.post-items.index') }}">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/add_items_icon.png') }}">
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
                                    <a href="{{ route('frontend.users.boost-items.item_details', base64_encode($item['id'])) }}">
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

                                    <div class="products-box-footer" style="display:none">

                                        @if (isset($item['store']['store_logo_file']) && !empty($item['store']['store_logo_file']))
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $item['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset(USERS_PROFILE_FOLDER . '/profile-pic.png') }}" width="32" height="32">
                                        @endif
                                        @if (!empty($item['store']['store_name']))
                                        <p>{{ $item['store']['store_name'] }}</p>
                                        @else
                                        <p>Lorem text</p>
                                        @endif
                                        <i class='product-dots'></i>
                                    </div>
                                    <div class="products-box-footer">
                                        <a class="" href="{{ route('frontend.users.post-items.edit', $item['id']) }}" style="margin-right:10px;">
                                            <i class="fas fa-edit"></i></a>

                                        <a class="post_delete_user" href="javascript:void(0)" data-id="{{ $item['id'] }}">
                                            <i class="fas fa-trash-alt"></i></a>
                                    </div>
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



<!-- Uploading-Story -->
<div class="modal fade" id="Uploading-Story" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="clearStoryForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserStory.title')</h5>
            <div id="ajax-alert-error" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert" class="alert" style="display: none;">
            </div>
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
            <form action="javascript:void(0)" id="user_story_form" name="user_story_form">
                <div class="input-group file-upload">
                    <div class="file-upload-div">
                        <input type='file' onchange="readURL10(this);" name="file" />
                        <img id="blah10" src="{{ asset('assets/images/Uploading-Story.png')}}" class="imageClear">
                        <video controls autoplay poster="/images/w3html5.gif" id="video10" style="display: none;"></video>
                    </div>
                    <label id="file-error" class="error" for="file"></label>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserStory.placeholder.productname')" class="form-control" name="product_name" id="product_name">
                </div>

                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="category_id" id="usercategory">
                        <option value="">@lang('frontend-messages.UserStory.placeholder.category')</option>
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="@lang('frontend-messages.UserStory.placeholder.description')" name="story_description" id="story_description"></textarea>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" name="story_price" value="{{ $story_price }}" readonly>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserStory.placeholder.location')" class="form-control" name="store_location" id="store_location">
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn loader_class">@lang('frontend-messages.UserStory.button')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Profile -->
<div class="modal fade" id="edit-profile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserProfile.title')</h5>
            <div id="ajax-alert-error-profile" class="alert" style="display:none;">
            </div>
            <div id="ajax-alert-profile" class="alert" style="display:none;">
            </div>
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
            <form id="user_profile" action="javascript:void(0)" method="POST">
                <div class="input-group file-upload">
                    <div class="file-upload-div">
                        <input type="file" onchange="readURL(this);" name="profile_picture">
                        @if (isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
                        <img id="blah1" src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                        @else
                        <img id="blah1" src="{{ asset('assets/images/Uploading-Story.png') }}">
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="" name="username" class="form-control" value="@if (isset(Auth::user()->username)) {{ Auth::user()->username }} @endif">
                </div>
                <div class="input-group">
                    <input type="email" placeholder="" class="form-control" name="email" value="@if (isset(Auth::user()->email)) {{ Auth::user()->email }} @endif">
                </div>
                <div class="input-group">
                    <select class="form-select required" aria-label="Default select example" name="gender" id="gender">
                        <option value="">select</option>
                        <option value="male" @if (isset(Auth::user()->id)) {{ old('gender', Auth::user()->gender) == 'male' ? 'Selected' : '' }} @endif>
                            Male</option>
                        <option value="female" @if (isset(Auth::user()->id)) {{ old('gender', Auth::user()->gender) == 'female' ? 'Selected' : '' }} @endif>
                            Female</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="date" class="form-control" name="birthdate" value="@if(isset(Auth::user()->id)) {{ Auth::user()->birth_date }} @endif">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="" class="form-control" name="phone_number" value="@if (isset(Auth::user()->phone_number)) {{ Auth::user()->phone_number }} @endif">
                </div>
                <div class="input-group change-location">
                    <input type="text" placeholder="Address" class="form-control user-address" name="address" value="@if (isset($userAddress) && !empty($userAddress)) {{ $userAddress->address }} @endif" readonly="readonly">
                    @if (isset($userAddress) && !empty($userAddress))
                    <a href="{{ route('frontend.users.address.index') }}">Change</a>
                    @else
                    <a href="{{ route('frontend.users.address.index') }}">Add</a>
                    @endif
                </div>
                <div class="form-group submit">
                    <button type="button" class="input-btn trans-btn" data-bs-toggle="modal" data-bs-target="#profile-change-password" data-bs-dismiss="modal">@lang('frontend-messages.UserProfile.changepasswordbtn')</button>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn loader_class">@lang('frontend-messages.UserProfile.savebtn')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit password -->
<div class="modal fade" id="profile-change-password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">@lang('frontend-messages.ChangPassword.title')</h5>
            <div id="ajax-alert-error-password" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert-password" class="alert" style="display: none;">
            </div>
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
            <form id="user_changepassword" action="javascript:void(0)" method="POST">
                <div class="input-group">
                    <input type="password" placeholder="@lang('frontend-messages.ChangPassword.placeholder.oldpassword')" class="form-control" name="old_password">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="@lang('frontend-messages.ChangPassword.placeholder.newpassword')" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="@lang('frontend-messages.ChangPassword.placeholder.confirmpassword')" class="form-control" name="confirm_password">
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn loader_class">@lang('frontend-messages.ChangPassword.btn.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal Modal start-->
<div class="modal fade" id="profile_post_delete_user" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="items_delete_popup">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
            </div>
            <div class="modal-body">
                <p style="text-align: left"> <strong>Are you sure to Delete Item ?</strong></p>
            </div>
            <form action="{{ route('frontend.users.profile.post_removed') }}" method="POST">
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

@endsection

@section('script')
<script type="text/javascript">
    if ($("#user_story_form").length > 0) {

        $("#user_story_form").validate({
            ignore: [],
            rules: {
                "file": {
                    required: true,
                },
                "product_name": {
                    required: true,
                },
                "category_id": {
                    required: true,
                },
                "story_description": {
                    required: true,
                },
                "store_location": {
                    required: true,
                },
                select: {
                    required: true,
                }
            },
            messages: {
                select: {
                    required: "Value required"
                },
                "file": {
                    required: "@lang('frontend-messages.UserStory.validation.video_or_image')",
                },
                "product_name": {
                    required: "@lang('frontend-messages.UserStory.validation.productname')",
                },
                "story_description": {
                    required: "@lang('frontend-messages.UserStory.validation.description')",
                },
                "store_location": {
                    required: "@lang('frontend-messages.UserStory.validation.storelocation')",
                },
            },
            errorPlacement: function(error, element) {
                if (element.is('select:hidden')) {
                    error.insertAfter(element.next('.nice-select'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var $this = $('#user_story_form .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#user_story_form .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formdata = new FormData(document.getElementById("user_story_form"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.users.site.add_user_story') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            $('#ajax-alert').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 3000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = "@lang('frontend-messages.UserStory.button ')";
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                let id = data.response.id
                                window.location.href =
                                    "{{ url('/profile/story_payment') }}/" + id;
                            });
                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('@lang("frontend - messages.UserStory.error.msg")');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = '@lang("frontend - messages.UserStory.button")';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });

            }
        });
        $('#usercategory').on('change', function() {
            $(this).valid();
        })

    }
</script>
<script type="text/javascript">
    if ($("#user_changepassword").length > 0) {
        $("#user_changepassword").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "old_password": {
                    required: true,
                },
                "new_password": {
                    required: true,
                    minlength: 6,
                },
                "confirm_password": {
                    required: true,
                    minlength: 6,
                    equalTo: "#new_password"
                },
            },
            messages: {
                "old_password": {
                    required: "@lang('frontend-messages.ChangPassword.validation.oldpassword')",
                },

                "new_password": {
                    required: "@lang('frontend-messages.ChangPassword.validation.newpassword')",
                    minlength: "@lang('frontend-messages.ChangPassword.validation.newpasswordlength')",
                },
                "confirm_password": {
                    required: "@lang('frontend-messages.ChangPassword.validation.confirmpassword')",
                    minlength: "@lang('frontend-messages.ChangPassword.validation.confirmpasswordlength')",
                    equalTo: "@lang('frontend-messages.ChangPassword.validation.equal')",
                },
            },
            submitHandler: function(form) {
                var $this = $('#user_changepassword .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#user_changepassword .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formdata = new FormData(document.getElementById("user_changepassword"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ url('profile/change_password') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {

                            $('#ajax-alert-password').addClass('alert-success').show(
                                function() {
                                    $(this).html(data.success);
                                    setTimeout(function() {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                    }, 2000)
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = "@lang('frontend-messages.ChangPassword.btn.save')";
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                    location.reload();
                                });
                        } else {
                            $('#ajax-alert-error-password').addClass('alert-danger').show(
                                function() {
                                    $(this).html("@lang('frontend-messages.ChangPassword.error.msg')");
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = "@lang('frontend-messages.ChangPassword.btn.save')";
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                        }
                    },
                });

            }
        });
    }
</script>
<script type="text/javascript">
    if ($("#user_profile").length > 0) {
        $('#user_profile').validate({
            ignore: [],
            rules: {
                "username": {
                    required: true,
                },
                "email": {
                    required: true,
                },

                "birthdate": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                },
                "address": {
                    required: true,
                },
                select: {
                    required: true
                }
            },
            messages: {
                select: {
                    required: "Value required"
                },
                "username": {
                    required: "@lang('frontend-messages.UserProfile.validation.username')",
                },
                "email": {
                    required: "@lang('frontend-messages.UserProfile.validation.email')",
                },
                "birthdate": {
                    required: "@lang('frontend-messages.UserProfile.validation.birthdate')",
                },
                "phone_number": {
                    required: "@lang('frontend-messages.UserProfile.validation.phonenumber')",
                },
                "address": {
                    required: "@lang('frontend-messages.UserProfile.validation.address')",
                },
            },
            errorPlacement: function(error, element) {
                if (element.is('select:hidden')) {
                    error.insertAfter(element.next('.nice-select'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var $this = $('#user_profile .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#user_profile .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("user_profile"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ url('profile/edit_profile') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            $('#ajax-alert-profile').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 5000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.UserProfile.savebtn")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                location.reload();
                            });
                        } else {
                            $('#ajax-alert-error-profile').addClass('alert-danger').show(
                                function() {
                                    $(this).html('@lang("frontend-messages.UserProfile.error.msg")');
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.UserProfile.savebtn")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                        }
                    },
                });
            }
        });
        $('#gender').on('change', function() {
            $(this).valid();
        })
    }
</script>
<script>
    $(document).ready(function() {
        $("#banner_submit_image").submit(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formdata = new FormData(document.getElementById("banner_submit_image"));
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url:"{{ route('frontend.users.profile.profile_banner') }}",
                data: formdata,
                success: function(data) {
                    if (data.code === 200) {}
                },
                error: function(data) {

                }
            });

        });
    });
</script>
<style>
    button.btn.delete_post {
        padding:5px 15px;
    }
</style>
<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/pagination.css') }}">
<script src="{{ asset('fronted/slider_js/profile_slider.js') }}"></script>
<script src="{{ asset('fronted/slider_js/pagination.js') }}"></script>
@endsection