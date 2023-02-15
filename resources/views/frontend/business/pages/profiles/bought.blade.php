@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Bought List' }}
@endsection
@section('content')
    <div class="my-items-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.menu.my_items') - Bought List</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!-- pagination-hidden-section  start-->
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <!-- pagination-hidden-section  end-->

            <div class="row" id="pagingBox">
                @if (!empty($itemArray) && count($itemArray) > 0)
                    @foreach ($itemArray as $key => $value)
                        <div class="col-md-3">
                            <div class="products-box">
                                @if ($value['condition']['name'] == NEW_ITEMS)
                                <div class="products-box-img">
                                    @if (!empty($value['boostItem']['item_id']))
                                        @if ($value['item']['id'] == $value['boostItem']['item_id'])
                                            <span class="featured">@lang('business_messages.postDetails.featured')</span>
                                        @endif
                                    @endif
                                    <a href="{{ route('frontend.business.new-items.item_details', ($value['item']['id'])) }}">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                            <img
                                                src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                        @endif
                                    </a>
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $value['item']['id'] }}" class="bx bxs-heart"
                                            @if (isset($value['wishlist']['wishlist_status']) &&
                                                !empty($value['wishlist']['wishlist_status']) &&
                                                $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                @elseif($value['condition']['name'] == USED_ITEMS)
                                <div class="products-box-img">
                                    @if (!empty($value['boostItem']['item_id']))
                                        @if ($value['item']['id'] == $value['boostItem']['item_id'])
                                            <span class="featured">@lang('business_messages.postDetails.featured')</span>
                                        @endif
                                    @endif
                                    <a href="{{ route('frontend.business.used-items.item_details', ($value['item']['id'])) }}">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                            <img
                                                src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                        @endif
                                    </a>
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $value['item']['id'] }}" class="bx bxs-heart"
                                            @if (isset($value['wishlist']['wishlist_status']) &&
                                                !empty($value['wishlist']['wishlist_status']) &&
                                                $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                <div class="products-box-img">
                                    @if (!empty($value['boostItem']['item_id']))
                                        @if ($value['item']['id'] == $value['boostItem']['item_id'])
                                            <span class="featured">@lang('business_messages.postDetails.featured')</span>
                                        @endif
                                    @endif
                                    <a href="{{ route('frontend.business.unused-items.item_details', ($value['item']['id'])) }}">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                            <img
                                                src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                        @endif
                                    </a>
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $value['item']['id'] }}" class="bx bxs-heart"
                                            @if (isset($value['wishlist']['wishlist_status']) &&
                                                !empty($value['wishlist']['wishlist_status']) &&
                                                $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                @else
                                <div class="products-box-img">
                                    @if (!empty($value['boostItem']['item_id']))
                                        @if ($value['item']['id'] == $value['boostItem']['item_id'])
                                            <span class="featured">@lang('business_messages.postDetails.featured')</span>
                                        @endif
                                    @endif
                                    <a href="javascript::void(0)">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                            <img
                                                src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                        @endif
                                    </a>
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $value['id'] }}" class="bx bxs-heart"
                                            @if (isset($value['wishlist']['wishlist_status']) &&
                                                !empty($value['wishlist']['wishlist_status']) &&
                                                $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                @endif
                                <div class="products-box-content">
                                    <a href="javascript::void(0)">
                                        @if ($value['condition']['name'] == NEW_ITEMS)
                                            <a href="{{ route('frontend.business.new-items.item_details', ($value['id'])) }}">
                                            <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == USED_ITEMS)
                                            <a href="{{ route('frontend.business.used-items.item_details', ($value['id'])) }}">
                                            <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                            <a href="{{ route('frontend.business.unused-items.item_details', ($value['id'])) }}">
                                            <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                        @else
                                            <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                        @endif
                                        <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}">
                                            {{ $value['item']['price'] }} {{ env('CURRENCY_TAG') }}</h6>
                                        <p>{{ $value['brand']['name'] }}</p>

                                        @if (!empty($value['store']['store_name']))
                                            <p>{{ $value['store']['store_location'] }}</p>
                                        @else
                                            <p>{{ $value['city']['name'] }}</p>
                                        @endif
                                        <div class="products-box-footer">
                                            @if ($value['user']['role'] == USER_ROLE)
                                                @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                                                    <img src="{{ asset('assets/users/' . $value['user']['profile_picture']) }}"
                                                        width="32" height="32">
                                                @else
                                                    <img src="{{ asset('assets/images/user.png') }}" width="32"
                                                        height="32">
                                                @endif
                                                @if (!empty($value['user']['username']))
                                                    <p>{{ $value['user']['username'] }}</p>
                                                @else
                                                    <p>{{ $value['user']['first_name'] }}</p>
                                                @endif
                                                @auth
                                                    <i class='product-dots'></i>
                                                @else
                                                    <i class="product-dots disable"></i>
                                                @endauth
                                            @else
                                                @if (isset($value['store']['store_logo_file']) && !empty($value['store']['store_logo_file']))
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['store']['store_logo_file']) }}"
                                                        width="32" height="32">
                                                @else
                                                    <img src="{{ asset('assets/images/user.png') }}" width="32"
                                                        height="32">
                                                @endif
                                                @if (!empty($value['store']['store_name']))
                                                    <p>{{ $value['store']['store_name'] }}</p>
                                                @else
                                                    <p>{{ $value['user']['first_name'] }}</p>
                                                @endif
                                                @auth
                                                    <i class='product-dots'></i>
                                                @else
                                                    <i class="product-dots disable"></i>
                                                @endauth
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- pagination  start-->
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
            </div>
            <!-- pagination end-->
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
@endsection
