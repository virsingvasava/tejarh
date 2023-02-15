
@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - Searched Items' }}
@endsection

@section('content')

<div class="my-items-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i>@lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.search.search_items')</li>
                    </ol>
                </nav>                                        
            </div>
            <div class="col-md-7">
                <div class="my-items-filter">
                    <h5>@lang('frontend-messages.search.search_items')</h5>
                </div>                                    
            </div>
        </div>
        <div class="row" id="dataFilter">                                   
            @if(!empty($usedItemsArray) && count($usedItemsArray) > 0)
                @foreach($usedItemsArray as $key => $unusedItems)
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <!-- <span class="featured">Featured</span> -->
                            @if (!empty($unusedItems['boostItem']['item_id']))
                                @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                                    <span class="featured">@lang('frontend-messages.search.featured')</span>
                                @endif
                            @endif
                            <a href="javascript::void(0)">
                                @if (isset($unusedItems['item_pictures']['item_picture1']) &&
                                    !empty($unusedItems['item_pictures']['item_picture1']))
                                    <img
                                        src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                @else
                                    <img src="assets/images/img/product-img1.png">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart"
                                    @if (isset($unusedItems['wishlist']['wishlist_status']) &&
                                        !empty($unusedItems['wishlist']['wishlist_status']) &&
                                        $unusedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a  href="javascript::void(0)">

                                @if ($unusedItems['condition']['name'] == NEW_ITEMS)
                                    <a href="{{ route('frontend.users.new-items.item_details', ($unusedItems['id'])) }}">
                                    <span class="used-btn new-btn">{{ $unusedItems['condition']['name'] }}</span>
                                @elseif($unusedItems['condition']['name'] == USED_ITEMS)
                                    <a href="{{ route('frontend.users.used-items.item_details', ($unusedItems['id'])) }}">
                                    <span class="used-btn used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                @elseif($unusedItems['condition']['name'] == UNUSED_ITEMS)
                                    <a href="{{ route('frontend.users.unused-items.item_details', ($unusedItems['id'])) }}">
                                    <span class="used-btn unused-btn">{{ $unusedItems['condition']['name'] }}</span>
                                @else
                                    <span class="used-btn">{{ $item['condition']['name'] }}</span>
                                @endif
                                <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                <p>{{ $unusedItems['brand']['name'] }}</p>

                                @if (!empty($unusedItems['store']['store_name']))
                                    <p>{{ $unusedItems['store']['store_location'] }}</p>
                                @else
                                    <p>{{ $unusedItems['city']['name'] }}</p>
                                @endif
                                <div class="products-box-footer">
                                    @if (isset($unusedItems['user']['profile_picture']) && !empty($unusedItems['user']['profile_picture']))
                                        <img src="{{ asset('assets/users/'.$unusedItems['user']['profile_picture']) }}" width="32" height="32">
                                    @else
                                        <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                    @endif
                                    @if (!empty($unusedItems['user']['username']))
                                        <p>{{ $unusedItems['user']['username'] }}</p>
                                    @else
                                        <p>{{ $unusedItems['user']['first_name'] }}</p>
                                    @endif
                                    @auth
                                        <i class='product-dots'></i>
                                    @else
                                        <i class="product-dots disable"></i>
                                    @endauth
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-md-12 text-center mt-10">
                     <p>No Found Items</p>
                </div>
            @endif               
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
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                <ul>
                    <li>
                        <a target="_blank" href="https://www.google.com/"><img
                            src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.google.com/"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
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



