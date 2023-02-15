@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - sell item' }}
@endsection

@section('content')

<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            @if (!empty($itemArray) && count($itemArray) > 0)
            @foreach ($itemArray as $key => $value)
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">{{ $value['category']['category_name'] }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $value['what_are_you_selling'] }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8">
                <div class="product-slider">
                    <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                    @if (!empty($item['boostItem']['item_id']))
                    @if ($item['id'] == $item['boostItem']['item_id'])
                    <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                    @endif
                    @endif
                    <div id="product-slider1" class="owl-carousel owl-theme">
                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @endif
                    </div>

                    <div id="product-slider2" class="owl-carousel owl-theme">
                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="product-details">
                    <h5> @lang('frontend-messages.postDetails.details')</h5>
                    <table>
                        <tr>
                            <td>@lang('frontend-messages.postDetails.brand')</td>
                            <td>{{ $value['brand']['name'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('frontend-messages.postDetails.model')</td>
                            <td>{{ $value['brand']['model'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('frontend-messages.postDetails.weight')</td>
                            <td>{{ $value['weight'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('frontend-messages.postDetails.quantity')</td>
                            <td>{{ $value['inventory']['stock_remaining'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="product-description">
                    <h5>{{ $value['what_are_you_selling'] }}</h5>
                    <p>{{ $value['describe_your_items'] }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-details-right-side">
                    <div class="product-details-price">
                        <div class="row">
                            <div class="col-md-8">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> <span id="price_plus">{{ $value['price'] }} {{env('CURRENCY_TAG')}}</span>
                                    </div>
                                </div>
                                </h5>
                                @if ($value['condition']['name'] == NEW_ITEMS)
                                <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>

                                @elseif($value['condition']['name'] == USED_ITEMS)
                                <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>

                                @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                @else
                                <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                @endif
                                <ul>
                                    <li><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/dollar-tag.png') }}">
                                        {{ $value['what_are_you_selling'] }}
                                    </li>
                                    <li><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/line-map-icon.png') }}">
                                        @if (!empty($value['store']['store_name']))
                                        {{ $value['store']['store_location'] }}
                                        @else
                                        {{ $value['city']['name'] }}
                                        @endif
                                    </li>
                                    @if(!empty($choice_optionsarray) && count($choice_optionsarray) > 0)
                                    <li>
                                        <select class="form-select category-h " name="attribute_id" id="attribute_id">
                                            <option value="">select_size</option>
                                            @foreach ($choice_optionsarray as $v)
                                            <option value="{{$v[$key]['id']}}">{{ $v[$key]['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-4">
                                @if(Auth::check())
                                <ul>
                                    <li>
                                        <a href="javascript::void(0)">
                                            <i data-id="{{ $value['id'] }}" class="fas fa-thumbs-up" id="add-like" @if (isset($value['likelist']['like_status']) && !empty($value['likelist']['like_status']) && $value['likelist']['like_status'])==1 att="0" style="color:blue;" @else att="0" style="color:black;" @endif></i>
                                        </a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-share-alt"></i></a></li>
                                    <li> <a href="javascript::void(0)" class="wish-list-icon heart_icons">
                                            <i data-id="{{ $value['id'] }}" class="bx bxs-heart" @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                        </a></li>
                                    <!-- <li><a href="javascript:void(0)"><i class="fas fa-heart"></i></a></li> -->
                                </ul>
                                @else
                                <ul>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-thumbs-up"></i></a></li>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-share-alt"></i></a></li>
                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a></li>
                                </ul>
                                @endif
                                @php
                                $create_date = date('d M Y', strtotime($value['created_at']));
                                @endphp
                                <p class="product-detail-date">{{ $create_date }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail-customer-review">
                        <h5>@lang('frontend-messages.postDetails.customer_review')</h5>
                        <div class="product-rating">
                            {{-- <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <strong>3 @lang('frontend-messages.postDetails.out_of') 5</strong> --}}

                            <div class="review_count mb-3">
                                <a href="{{route('frontend.business.product-reviews.reviews_details',$value['id'])}}">
                                    <div class="cxeKyx">
                                        <div color="#0AD188" class="kCxoGQ">
                                            <span class="bFgxSY">{{$value['totalReviewAvg']}}</span>
                                            <label><i class="fas fa-star ratings_color_set"></i></label>
                                        </div>
                                        <div class="jWgYGv">
                                            <div underline-thickness="0.5px" class="hnUSvL">
                                                <span>{{$value['reviewRatings']}} Ratings</span>
                                                <div class="line_review_count"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- <p>1000 @lang('frontend-messages.postDetails.global_ratings')</p> --}}
                        <a href="{{ route('frontend.business.product-reviews.reviews_details',$value['id'])}}" class="product-right-arrow">></a>
                    </div>
                    @if(Auth::check())
                    @if ($value['user_id'] == Auth::user()->id)

                    @else
                    <div class="product-author">
                        @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                        <img class="product_author_profile" src="{{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $value['user']['profile_picture']) }}">
                        @else
                        <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/strory-img1.png') }}">
                        @endif
                        <h6>{{ $value['user']['first_name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}">
                        </h6>
                        @php
                        $itemUserMembership = date('d M Y', strtotime($value['user']['created_at']));
                        @endphp
                        <p>@lang('frontend-messages.postDetails.member_since') {{ $itemUserMembership }}</p>
                        <div class="product-rating">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                        </div>
                        <a href="{{ route('frontend.users.profile-seller.index', $value['user']['id']) }}" class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        <div class="make_payment_message"></div>
                        <input type="hidden" id="get-item-user-membership" value="{{ $itemUserMembership }}">
                        <input type="hidden" name="price" id="get_item_price" value="{{ $value['price'] }} {{env('CURRENCY_TAG')}}">
                        <ul>
                            @if(isset($value['orders']['item_id']) && $value['id'] == $value['orders']['item_id'])
                            <li><a href="javascript:void(0)" class="btn grey_btn">
                                    <img src="{{ asset('fronted/users_flow/assets/images/chat-icon-white.png') }}"></a>
                            </li>
                            @endif
                            @if($value['price_type'] == Negotiable)
                            <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#post-your-offer">@lang('frontend-messages.postDetails.make_an_offer')</a></li>
                            @elseif($value['price_type'] == Fixed_Price)
                            <li>
                                <a class="btn add_to_cart" id="addtoCard" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}">@lang('frontend-messages.postDetails.buy')</a>
                            </li>
                            @endif
                            <!-- <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-bs-target="#hold-an-offer">@lang('frontend-messages.postDetails.hold_an_offer')</a></li> -->
                        </ul>
                    </div>
                    @endif
                    @else
                    <div class="product-author">
                        @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                        <img class="product_author_profile" src="{{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $value['user']['profile_picture']) }}">
                        @else
                        <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/strory-img1.png') }}">
                        @endif
                        <h6>{{ $value['user']['first_name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}">
                        </h6>
                        @php
                        $itemUserMembership = date('d M Y', strtotime($value['user']['created_at']));
                        @endphp
                        <p>@lang('frontend-messages.postDetails.member_since') {{ $itemUserMembership }}</p>
                        <div class="product-rating">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                        </div>
                        <a href="{{ route('frontend.users.profile-seller.index', $value['user']['id']) }}" class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        <div class="make_payment_message"></div>
                        <input type="hidden" id="get-item-user-membership" value="{{ $itemUserMembership }}">
                        <input type="hidden" name="price" id="get_item_price" value="{{ $value['price'] }} {{env('CURRENCY_TAG')}}">
                        <ul>
                            @if (Auth::check())
                            @if(isset($value['orders']['item_id']) && $value['id'] == $value['orders']['item_id'])
                            <li><a href="javascript:void(0)" class="btn grey_btn">
                                    <img src="{{ asset('fronted/users_flow/assets/images/chat-icon-white.png') }}"></a>
                            </li>
                            @endif
                            @endif
                            @if($value['price_type'] == Negotiable)
                            <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#loginModal">@lang('frontend-messages.postDetails.make_an_offer')</a></li>
                            @elseif($value['price_type'] == Fixed_Price)
                            <li>
                                <a @if (Auth::check()) class="btn add_to_cart" id="addtoCard" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}" @else href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" @endif class="btn details_page" data-item_id="{{$value['id']}}" data-text="details_page">@lang('frontend-messages.postDetails.buy')</a>
                            </li>
                            @endif
                            <!-- <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('frontend-messages.postDetails.hold_an_offer') </a></li> -->
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="product-report">
                    <a>Promoted PRODUCT</a>
                </div>

                <div class="related-product-list">
                    <ul>
                        @if(!empty($boostItemArray) && count($boostItemArray) > 0)
                        @foreach ($boostItemArray as $key => $value)
                        <li>
                            <div class="products-box">
                                <div class="products-box-img pro-boost">
                                    <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                    @if (!empty($item['boostItem']['item_id']))
                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                    <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                    @endif
                                    @endif
                                    <a href="{{ route('frontend.users.promoted-items.item_details', base64_encode($value['id'])) }}">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('assets/images/img/product-img1.png')}}">
                                        @endif
                                    </a>
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $value['id'] }}" class="bx bxs-heart" @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                </div>
                                <div class="products-box-content pro-boost">
                                    <a href="{{ route('frontend.business.promoted-items.item_details', base64_encode($value['id'])) }}">

                                        <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $value['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                        @if ($value['condition']['name'] == NEW_ITEMS)
                                        <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>

                                        @elseif($value['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>

                                        @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                        @else
                                        <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                        @endif
                                        <p>{{ $value['brand']['name'] }}</p>

                                        @if (!empty($value['store']['store_name']))
                                        <p>{{ $value['store']['store_location'] }}</p>
                                        @else
                                        <p> {{ $value['city']['name'] }}</p>
                                        @endif
                                        <div class="products-box-footer">
                                            @if ($value['user']['role'] == USER_ROLE)

                                            @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$value['user']['profile_picture']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['store']['store_logo_file']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<!--  -->
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h6>Product Stock Table</h6>
                <div class="wishlist_deleted_message"></div>
                <div class="wishlist-table">
                    <table>
                        <tr>
                            <th>Sr.No</th>
                            <th>sku</th>
                            <th>Quantity</th>
                            <th>Upload status</th>
                            <th>Date</th>
                            <th>Stock Status</th>
                        </tr>
                        @if (!empty($stockArray) && count($stockArray) > 0)
                        <?php $i = 1; ?>
                        @foreach ($stockArray as $value)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$value['items']['sku']}}</td>
                            <td>{{$value['quantity']}}</td>
                            <td>{{$value['item_upload_status']}}</td>
                            <td>{{$value['created_at']}}</td>
                            @if($value['stock_status'] == '1')
                            <td><img src="{{ asset('assets/images/down-arrow.png') }}"></td>
                            @else
                            <td><img src="{{ asset('assets/images/down-arrow-1.png') }}"></td>
                            @endif
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->

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
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('fronted/users_flow/assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('fronted/users_flow/assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post your Offer -->
<div class="modal fade" id="post-your-offer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>Post your Offer</h5>
            <form id="make_an_offers" action="{{route('frontend.users.make-an-offer.make_an_offer_post')}}" method="post">
                @csrf
                @foreach ($itemArray as $key => $value1)
                <div class="model-product-author">
                    <div class="model-product-author-content">
                        @if (isset($value1['user']['profile_picture']) && !empty($value1['user']['profile_picture']))
                        <img src="{{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $value1['user']['profile_picture']) }}">
                        @else
                        <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/strory-img1.png') }}">
                        @endif
                        <h6>{{ $value1['user']['first_name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}"></h6>
                        @php
                        $itemUserMembership = date('d M Y', strtotime($value1['user']['created_at']));
                        @endphp
                        <p>Member since {{ $itemUserMembership }}</p>
                        <div class="product-rating">
                            <img src="{{ asset('fronted/users_flow/assets/images/fill-star.png')}}">
                            <img src="{{ asset('fronted/users_flow/assets/images/fill-star.png')}}">
                            <img src="{{ asset('fronted/users_flow/assets/images/grey-star.png')}}">
                            <img src="{{ asset('fronted/users_flow/assets/images/grey-star.png')}}">
                            <img src="{{ asset('fronted/users_flow/assets/images/grey-star.png')}}">
                        </div>
                    </div>
                    <div class="model-product-author-product">
                        @if (isset($value1['item_pictures']['item_picture1']) && !empty($value1['item_pictures']['item_picture1']))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value1['item_pictures']['item_picture1']) }}">
                        </div>
                        @endif
                        <p><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $value1['price'] }} {{env('CURRENCY_TAG')}}</p>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="productAuthorId" value="{{ $value1['user']['id'] }}">
                    <input type="hidden" name="productId" value="{{ $value1['id'] }}">
                    <input type="hidden" name="productPrice" value="{{ $value1['price'] }}">
                </div>
                @endforeach
                <div class="input-group">
                    <input type="text" placeholder="Enter offer price" name="offer_price" class="form-control">
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="offer_message" placeholder="Write your message"></textarea>
                </div>
                <div class="form-group submit">
                    <input type="submit" value="Send" class="form-control btn btn-primary">
                </div>
            </form>
            {{-- <a href="javascript:void(0)" class="cancle">Cancel</a> --}}
        </div>
    </div>
</div>


<!-- Hold an offer -->
<div class="modal fade" id="hold-an-offer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>Hold an offer</h5>
            <div class="model-product-author-product">
                <img src="assets/images/img/product-slider-img.png">
                <h5>Apple airpods</h5>
                <p><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> 7,000 {{env('CURRENCY_TAG')}}</p>
            </div>
            <p>Booking charge is 5% of the item price for 1 month</p>

            <ul>
                <li>Booking price<strong><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> 10 {{env('CURRENCY_TAG')}}</strong></li>
                <li>Payable amount for items<strong><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> 190 {{env('CURRENCY_TAG')}}</strong></li>
            </ul>

            <form>
                <div class="form-group submit">
                    <input type="submit" value="Book now" class="form-control btn">
                </div>
            </form>
            {{-- <a href="javascript:void(0)" class="cancle">Cancel</a> --}}
        </div>
    </div>
</div>
@endsection

@section('script')


<script>
    $('#add_qty').click(function() {
        if ($(this).prev().val() < 10) {
            $(this).prev().val(+$(this).prev().val() + 1);
            let quantity = $('#qty_add_minus').val();
            let price = $('.session_price').val();
            let item_id = $('#qty_add_minus').attr("data-item_id");
            let user_id = $('.qty_add_minus').attr("data-user_id");
            let status_check = true;
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{route("frontend.users.order-details.qty_add_minus")}}',
                type: "POST",
                dataType: "json",
                data: {
                    'quantity': quantity,
                    'price': price,
                    'item_id': item_id,
                    'user_id': user_id,
                    'status_check': status_check,
                    _token: token
                },
                success: function(total_amount) {
                    document.getElementById("price_plus").innerHTML = total_amount['total_amount'];
                }
            });
        }
    });

    $('#minus_qty').click(function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) {
                $(this).next().val(+$(this).next().val() - 1);
                let quantity = $('#qty_add_minus').val();
                let price = $('.session_price').val();
                let item_id = $('#qty_add_minus').attr("data-item_id");
                let user_id = $('.qty_add_minus').attr("data-user_id");
                let status_check = false;
                var token = "{{csrf_token()}}";
                $.ajax({
                    url: '{{route("frontend.users.order-details.qty_add_minus")}}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'quantity': quantity,
                        'price': price,
                        'item_id': item_id,
                        'user_id': user_id,
                        'status_check': status_check,
                        _token: token
                    },
                    success: function(total_amount) {
                        document.getElementById("price_plus").innerHTML = total_amount['total_amount'];
                    }
                });
            }
        }
    });
</script>


<script>
    if ($("#make_an_offers").length > 0) {
        $("#make_an_offers").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {

                "offer_price": {
                    required: true,
                },

                "offer_message": {
                    required: true,
                },
            },
            messages: {
                "offer_price": {
                    required: 'Price is required',
                },

                "offer_message": {
                    required: 'Message is required',
                },
            },
            submitHandler: function(form) {
                var $this = $('#make_an_offers .loader_class');
                var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#make_an_offers .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
            }
        });
    }
</script>

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
</script>

<script type="text/javascript">
    $('#addtoCard').click(function() {

        let item_id = $('.add_to_cart').attr("data-item_id");
        let user_id = $('.add_to_cart').attr("data-user_id");
        let attribute_id = $('.category-h').val();
        var token = "{{csrf_token()}}";

        $.ajax({
            url: '{{route("frontend.users.order-details.addToCart")}}',
            type: "POST",
            dataType: "json",
            data: {
                'item_id': item_id,
                'user_id': user_id,
                'attribute_id': attribute_id,
                _token: token
            },
            success: function(data) {
                window.location.href = "{{ url('address/shipping-address')}}/" + item_id;

            }
        });
    });
</script>
@endsection