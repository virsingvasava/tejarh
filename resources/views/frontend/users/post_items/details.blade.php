@extends('frontend.users.layouts.master')
@section('title','Tejarh - sell item')
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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('frontend.users.product_category.index',$value['category_id'])}}">{{ $value['category']['category_name'] }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $value['what_are_you_selling'] }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8">
                <div class="product-slider">
                    @if (!empty($value['boostItem']['item_id']))
                    @if ($value['id'] == $value['boostItem']['item_id'])
                    <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                    @endif
                    @endif
                    <div id="product-slider1" class="owl-carousel owl-theme">

                        @if ($value['item_pictures']['item_picture1'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture1'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture2'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture2'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture3'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture3'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture4'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture4'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture5'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture5'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture6'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture6'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                    </div>

                    <div id="product-slider2" class="owl-carousel owl-theme">
                        @if ($value['item_pictures']['item_picture1'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture1'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture2'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture2'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture3'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture3'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture4'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture4'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture5'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture5'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif

                        @if ($value['item_pictures']['item_picture6'] != "")
                        @if(file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture6'])))
                        <div class="item">
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="product-details">
                    <h5> @lang('frontend-messages.postDetails.details')</h5>
                    <table>
                        <tr>
                            <td>Sku</td>
                            <td>{{$value['sku']}}</td>
                        </tr>
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
                                    <li>
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
                                    <li><a href="javascript:void(0)" id="bulkproduct" data-bs-toggle="modal" data-bs-target="#sharebuttons">
                                            <i class="fas fa-share-alt"></i>
                                        </a>
                                    </li>
                                    <li> <a href="javascript::void(0)" class="wish-list-icon heart_icons">
                                            <i data-id="{{ $value['id'] }}" class="bx bxs-heart" @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                        </a></li>
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

                            <div class="review_count mb-3">
                                <a href="{{route('frontend.users.product-reviews.reviews_details',$value['id'])}}">
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
                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$value['id'])}}" class="product-right-arrow">></a>
                    </div>
                    @if(Auth::check())
                    @if ($value['user_id'] == Auth::user()->id)

                    @else
                    <div class="product-author">
                        
                        @if (isset($value['user']['profile_picture']) && $value['user']['profile_picture'] != "" && file_exists(USERS_SELLER_PROFILE_FOLDER . '/' . $value['user']['profile_picture']))
                            <img class="product_author_profile" src="{{ asset(USERS_SELLER_PROFILE_FOLDER . '/' . $value['user']['profile_picture']) }}">
                        @else
                            <img src="{{ asset('assets/images/user.png') }}">
                        @endif
                        <h6>{{ $value['user']['first_name'] }}<img src="{{ asset(USERS_ASSETS_FOLDER . '/images/best-seller.png') }}">
                        </h6>
                        @php
                        $itemUserMembership = date('d M Y', strtotime($value['user']['created_at']));
                        @endphp
                        <p>@lang('frontend-messages.postDetails.member_since') {{ $itemUserMembership }}</p>
                        <div class="product-rating">
                            <div class="review_count mb-3">
                                <a @if (Auth::check()) href="{{ route('frontend.users.seller-reviews.seller_reviews_details', $value['user']['id']) }}" @else href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
                                    <div class="cxeKyx">
                                        <div color="#0AD188" class="kCxoGQ">
                                            <span class="bFgxSY">{{$value['sellerTotalReviewAvg']}}</span>
                                            <label><i class="fas fa-star ratings_color_set"></i></label>
                                        </div>
                                        <div class="jWgYGv">
                                            <div underline-thickness="0.5px" class="hnUSvL">
                                                <span>{{$value['sellerTotalCountReviewRatings']}} Ratings</span>
                                                <div class="line_review_count"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a @if (Auth::check()) href="{{ route('frontend.users.profile-seller.index', $value['user']['id']) }}" @else href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal" @endif class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        <div class="make_payment_message"></div>
                        <input type="hidden" id="get-item-user-membership" value="{{ $itemUserMembership }}">
                        <input type="hidden" name="price" id="get_item_price" value="{{ $value['price'] }} {{env('CURRENCY_TAG')}}">
                        <ul>
                            <?php
                            $buyerId = \Auth::User()->id;
                            $sellerId = $value['user_id'];

                            $buyerDetails = \Auth::User();
                            $sellerDetails = \App\Models\User::where('id', $sellerId)->first();
                            if (!empty($itemsDetails)) {
                                $itemsDetails = $itemsDetails;
                            } else {
                                $itemsDetails = null;
                            }
                            ?>
                            <li class="pro-d-chat">
                                <button onclick="createChat({{$buyerDetails}},{{$sellerDetails}},{{$itemsDetails}});" class="btn grey_btn">
                                    <img src="{{ asset('fronted/users_flow/assets/images/chat-icon-white.png') }}" class="cdb">
                                    <img src="{{ asset('fronted/users_flow/assets/images/chat-icon-white-hover.png') }}" class="cdn">
                                </button>
                            </li>
                            
                            @if($value['price_type'] == 1)
                            <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#post-your-offer">@lang('frontend-messages.postDetails.make_an_offer')</a></li>
                            @elseif($value['price_type'] == 0)
                            @if( $value['inventory']['stock_remaining'] == '0')
                            <li>
                                Out of Stock
                            </li>
                            @else
                            <li>
                                <a class="btn add_to_cart" id="addtoCard" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}">@lang('frontend-messages.postDetails.add_to_cart')</a>
                            </li>
                            @endif
                            @endif
                            <!-- <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-bs-target="#hold-an-offer">@lang('frontend-messages.postDetails.hold_an_offer')</a></li> -->
                        </ul>
                    </div>
                    @endif
                    @else
                    <div class="product-author">
                        @if (isset($value['user']['profile_picture']) && $value['user']['profile_picture'] != "" && file_exists(USERS_SELLER_PROFILE_FOLDER . '/' . $value['user']['profile_picture']))
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
                            <div class="review_count mb-3">
                                <a @if (Auth::check()) href="{{ route('frontend.users.seller-reviews.seller_reviews_details', $value['user']['id']) }}" @else href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
                                    <div class="cxeKyx">
                                        <div color="#0AD188" class="kCxoGQ">
                                            <span class="bFgxSY">{{$value['sellerTotalReviewAvg']}}</span>
                                            <label><i class="fas fa-star ratings_color_set"></i></label>
                                        </div>
                                        <div class="jWgYGv">
                                            <div underline-thickness="0.5px" class="hnUSvL">
                                                <span>{{$value['sellerTotalCountReviewRatings']}} Ratings</span>
                                                <div class="line_review_count"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a @if (Auth::check()) href="{{ route('frontend.users.profile-seller.index', $value['user']['id']) }}" @else href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal" @endif class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        <div class="make_payment_message"></div>
                        <input type="hidden" id="get-item-user-membership" value="{{ $itemUserMembership }}">
                        <input type="hidden" name="price" id="get_item_price" value="{{ $value['price'] }} {{env('CURRENCY_TAG')}}">
                        <ul>

                            @if (Auth::check())
                            @if(!empty($value['orders']['item_id']) == $value['id'])
                            <li><button class="btn grey_btn">
                                    <img src="{{ asset('fronted/users_flow/assets/images/chat-icon-white.png') }}"></button>
                            </li>
                            @endif
                            @endif
                            @if($value['price_type'] == 1)

                            <li><a href="javascript:void(0)" class="btn tran_btn" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#loginModal">@lang('frontend-messages.postDetails.make_an_offer')</a></li>
                            @elseif($value['price_type'] == 0)

                            <li>
                                <a @if (Auth::check()) class="btn add_to_cart" id="addtoCard" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}" @else href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" @endif class="btn details_page" data-item_id="{{$value['id']}}" data-text="details_page">@lang('frontend-messages.postDetails.add_to_cart')</a>
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
                        @foreach ($boostItemArray as $boostKey => $boostValue)
                        <li>
                            <div class="products-box">
                                <div class="products-box-img pro-boost">
                                    <!-- <span class="featured">@lang('frontend-messages.postDetails.featured')</span> -->
                                    @if (!empty($boostValue['item_id']))
                                    @if ($boostValue['items']['id'] == $boostValue['item_id'])
                                    <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                    @endif
                                    @endif
                                    <a href="{{ route('frontend.users.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                        @if ($boostValue['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$boostValue['item_pictures']['item_picture1'])))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $boostValue['item_pictures']['item_picture1']) }}">
                                        @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                        @endif
                                    </a>
                                    @if(Auth::check())
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $boostValue['id'] }}" class="bx bxs-heart" @if (isset($boostValue['wishlist']['wishlist_status']) && !empty($boostValue['wishlist']['wishlist_status']) && $boostValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                                    @endif
                                </div>
                                <div class="products-box-content pro-boost">
                                    <a href="{{ route('frontend.users.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                        <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $boostValue['items']['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                        @if ($boostValue['condition']['name'] == NEW_ITEMS)
                                        <span class="used-btn new-btn">{{ $boostValue['condition']['name'] }}</span>

                                        @elseif($boostValue['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $boostValue['condition']['name'] }}</span>

                                        @elseif($boostValue['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $boostValue['condition']['name'] }}</span>
                                        @else
                                        <span class="used-btn">{{ $boostValue['condition']['name'] }}</span>
                                        @endif
                                        <p>{{ $boostValue['brand']['name'] }}</p>

                                        @if (!empty($boostValue['store']['store_name']))
                                        <p>{{ $boostValue['store']['store_location'] }}</p>
                                        @else
                                        <p> {{ $boostValue['city']['name'] }}</p>
                                        @endif
                                        <div class="products-box-footer">
                                            @if ($boostValue['user']['role'] == USER_ROLE)

                                            @if (isset($boostValue['user']['profile_picture']) && $boostValue['user']['profile_picture'] != "" && file_exists(USERS_SELLER_PROFILE_FOLDER . '/' . $boostValue['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$boostValue['user']['profile_picture']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                            @endif
                                            @if (!empty($boostValue['user']['username']))
                                            <p>{{ $boostValue['user']['username'] }}</p>
                                            @else
                                            <p>{{ $boostValue['user']['first_name'] }}</p>
                                            @endif
                                            @auth
                                            <i class='product-dots'></i>
                                            @else
                                            <i class="product-dots disable"></i>
                                            @endauth
                                            @else
                                            @if (isset($boostValue['store']['store_logo_file']) && !empty($boostValue['store']['store_logo_file']))
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $boostValue['store']['store_logo_file']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                            @endif
                                            @if (!empty($boostValue['store']['store_name']))
                                            <p>{{ $boostValue['store']['store_name'] }}</p>
                                            @else
                                            <p>{{ $boostValue['user']['first_name'] }}</p>
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

<div class="related-ads-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (!empty($relatedItemArray) && count($relatedItemArray) > 4)
                    <h4>@lang('frontend-messages.postDetails.related_ads') <a href="javascript:void(0)">@lang('frontend-messages.postDetails.view_more')</a></h4>
                @endif
            </div>

            @if (!empty($relatedItemArray) && count($relatedItemArray) > 0)
            @foreach ($relatedItemArray as $relatedKey => $relatedValue)
            <div class="col-md-3">
                <div class="products-box">
                    @if ($relatedValue['condition']['name'] == NEW_ITEMS)
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('frontend-messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                        @endif
                        @endif
                        <a href="{{ route('frontend.users.new-items.item_details', ($relatedValue['id'])) }}">
                            @if ($relatedValue['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$relatedValue['item_pictures']['item_picture1'])))
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                            @endif
                        </a>
                        @if(Auth::check())
                        <a href="javascript::void(0)" class="wish-list-icon">
                            <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                        @endif
                    </div>
                    @elseif ($relatedValue['condition']['name'] == USED_ITEMS)
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('frontend-messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                        @endif
                        @endif
                        <a href="{{ route('frontend.users.used-items.item_details', ($relatedValue['id'])) }}">
                            @if ($relatedValue['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$relatedValue['item_pictures']['item_picture1'])))
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                            @endif
                        </a>
                        @if(Auth::check())
                        <a href="javascript::void(0)" class="wish-list-icon">
                            <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                        @endif
                    </div>
                    @elseif ($relatedValue['condition']['name'] == UNUSED_ITEMS)
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('frontend-messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                        @endif
                        @endif
                        <a href="{{ route('frontend.users.unused-items.item_details', ($relatedValue['id'])) }}">
                            @if ($relatedValue['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$relatedValue['item_pictures']['item_picture1'])))
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                            @endif
                        </a>
                        @if(Auth::check())
                        <a href="javascript::void(0)" class="wish-list-icon">
                            <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                        @endif
                    </div>
                    @else
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('frontend-messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured"> @lang('frontend-messages.postDetails.featured')</span>
                        @endif
                        @endif
                        <a href="javascript::void(0)">
                            @if ($relatedValue['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$relatedValue['item_pictures']['item_picture1'])))
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                            @endif
                        </a>
                        @if(Auth::check())
                        <a href="javascript::void(0)" class="wish-list-icon">
                            <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                        @endif
                    </div>
                    @endif
                    <div class="products-box-content">
                        <a href="javascript::void(0)">
                            @if ($relatedValue['condition']['name'] == NEW_ITEMS)
                            <a href="{{ route('frontend.users.new-items.item_details', ($relatedValue['id'])) }}">
                                <span class="used-btn new-btn">{{ $relatedValue['condition']['name'] }}</span>

                                @elseif($relatedValue['condition']['name'] == USED_ITEMS)
                                <a href="{{ route('frontend.users.used-items.item_details', ($relatedValue['id'])) }}">
                                    <span class="used-btn used-btn">{{ $relatedValue['condition']['name'] }}</span>

                                    @elseif($relatedValue['condition']['name'] == UNUSED_ITEMS)
                                    <a href="{{ route('frontend.users.unused-items.item_details', ($relatedValue['id'])) }}">
                                        <span class="used-btn unused-btn">{{ $relatedValue['condition']['name'] }}</span>
                                        @else
                                        <span class="used-btn">{{ $relatedValue['condition']['name'] }}</span>
                                        @endif
                                        <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $relatedValue['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                        <p>{{ $relatedValue['brand']['name'] }}</p>

                                        @if (!empty($relatedValue['store']['store_name']))
                                        <p>{{ $relatedValue['store']['store_location'] }}</p>
                                        @else
                                        <p> {{ $relatedValue['city']['name'] }}</p>
                                        @endif
                                        <div class="products-box-footer">
                                            @if ($relatedValue['user']['role'] == USER_ROLE)

                                            @if (isset($relatedValue['user']['profile_picture']) && $relatedValue['user']['profile_picture'] != "" && file_exists(USERS_SELLER_PROFILE_FOLDER . '/' . $relatedValue['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$relatedValue['user']['profile_picture']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                            @endif
                                            @if (!empty($relatedValue['user']['username']))
                                            <p>{{ $relatedValue['user']['username'] }}</p>
                                            @else
                                            <p>{{ $relatedValue['user']['first_name'] }}</p>
                                            @endif
                                            @auth
                                            <i class='product-dots'></i>
                                            @else
                                            <i class="product-dots disable"></i>
                                            @endauth
                                            @else
                                            @if (isset($relatedValue['store']['store_logo_file']) && !empty($relatedValue['store']['store_logo_file']))
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $relatedValue['store']['store_logo_file']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                            @endif
                                            @if (!empty($relatedValue['store']['store_name']))
                                            <p>{{ $relatedValue['store']['store_name'] }}</p>
                                            @else
                                            <p>{{ $relatedValue['user']['first_name'] }}</p>
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
                        @if (isset($value1['user']['profile_picture']) && $value1['user']['profile_picture'] != "" && file_exists(USERS_SELLER_PROFILE_FOLDER . '/' . $value1['user']['profile_picture']))
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

<!-- share buttons -->
<div class="modal fade" id="sharebuttons" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content social-modal-content">
            <h5>Social Media Share Buttons</h5>
            <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                <div class="sample-pro-store">
                    <div class="input-group file-upload-icon">
                        {!! $shareComponent !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script type="module" src="{{asset('js/constants.js')}}"></script>

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

                console.log(data.data.count);

                if (data.data.count > 1) {
                    window.location.href = "{{ url('order-details/checkout')}}/" + data.data.id;
                } else {
                    window.location.href = "{{ url('address/shipping-address')}}/" + item_id;
                }
            }
        });
    });
</script>
@endsection