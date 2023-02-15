@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - Business Item Details' }}
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
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('frontend.business.product_category.index',$value['category_id'])}}">{{ $value['category']['category_name'] }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $value['what_are_you_selling'] }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8">
                <div class="product-slider">
                    @if (!empty($value['boostItem']['item_id']))
                    @if ($value['id'] == $value['boostItem']['item_id'])
                    <span class="featured">@lang('business_messages.postDetails.featured')</span>
                    @endif
                    @endif
                    <div id="product-slider1" class="owl-carousel owl-theme">
                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @endif
                    </div>

                    <div id="product-slider2" class="owl-carousel owl-theme">
                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                        </div>
                        @endif

                        @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                        <div class="item">
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="buisness-product-details">
                    <h5>@lang('business_messages.postDetails.details')</h5>
                    <table>
                        <tr>
                            <td>Sku</td>
                            <td>{{$value['sku']}}</td>
                        </tr>
                        <tr>
                            <td>@lang('business_messages.postDetails.brand')</td>
                            <td>{{ $value['brand']['name'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('business_messages.postDetails.model')</td>
                            <td>{{ $value['brand']['model'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('business_messages.postDetails.weight')</td>
                            <td>{{ $value['weight'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('business_messages.postDetails.quantity')  </td>
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
                                <h5><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{ $value['price'] }} {{env('CURRENCY_TAG')}}</h5>
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
                                    <li><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/dollar-tag.png') }}">
                                        {{ $value['what_are_you_selling'] }}
                                    </li>
                                    <li><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/line-map-icon.png') }}">
                                        @if (!empty($value['store']['store_name']))
                                        {{ $value['store']['store_location'] }}
                                        @else
                                        {{ $value['city']['name'] }}
                                        @endif
                                    </li>
                                    <!-- <li>
                                        <select class="form-select category-h " name="attribute_id" id="attribute_id">
                                            <option value="">select_size</option>
                                            @foreach ($choice_optionsarray as $v)
                                            <option value="{{$v[$key]['id']}}">{{ $v[$key]['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="col-md-4">
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
                                    <li><a href="javascript::void(0)" class="wish-list-icon">
                                            <i data-id="{{ $value['id'] }}" class="bx bxs-heart" @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                        </a></li>
                                </ul>
                                @php
                                $create_date = date('d M Y', strtotime($value['created_at']));
                                @endphp
                                <p class="product-detail-date">{{ $create_date }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail-customer-review">
                        <h5>@lang('business_messages.postDetails.customer_review')</h5>
                        <div class="product-rating">
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
                        <a href="{{ route('frontend.business.product-reviews.reviews_details',$value['id'])}}" class="product-right-arrow">></a>
                    </div>
                    @if ($value['user_id'] == Auth::user()->id)

                    @else
                    <div class="product-author">
                        @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                        <img class="product_author_profile" src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['user']['profile_picture']) }}">
                        @else
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/strory-img1.png') }}">
                        @endif
                        <h6>{{ $value['user']['first_name'] }}<img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}">
                        </h6>
                        @php
                        $itemUserMembership = date('d M Y', strtotime($value['user']['created_at']));
                        @endphp
                        <p>Member since {{$itemUserMembership }}</p>
                        <div class="product-rating">
                            <div class="review_count mb-3">
                                <a href="{{route('frontend.business.seller-reviews.seller_reviews_details',$value['user']['id'])}}">
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
                        <a href="{{ route('frontend.business.profile-seller.index',$value['user']['id'])}}" class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        <div class="make_payment_message"></div>
                        <input type="hidden" id="get-item-user-membership" value="{{$itemUserMembership}}">
                        <input type="hidden" name="price" id="get_item_price" value="{{ $value['price'] }} {{env('CURRENCY_TAG')}}">

                        <ul>

                             <?php
                            $buyerId = \Auth::User()->id;
                            $sellerId = $value['user_id'];

                            $buyerDetails = \Auth::User();
                            // dd($buyerDetails);
                            $sellerDetails = \App\Models\User::where('id', $sellerId)->first();
                            if (!empty($itemsDetails)) {
                                $itemsDetails = $itemsDetails;
                            } else {
                                $itemsDetails = null;
                            }

                            ?>
                           <li class="pro-d-chat">
                            <button onclick="createChat({{$buyerDetails}},{{$sellerDetails}},{{$itemsDetails}});" class="btn grey_btn">
                            <img src="{{ asset('fronted/business_flow/assets/images/img/chat-icon-white.png') }}" class="cdb">
                                    <img src="{{ asset('fronted/business_flow/assets/images/img/chat-icon-white-hover.png') }}" class="cdn">

                                </button>
                            </li>
                            @if($value['price_type'] == 1)
                            <li><a href="javascript:void(0)" class="btn tran_btn or_make_an_offer" data-id="{{$value['id']}}" data-bs-toggle="modal" data-bs-target="#post-your-offer">@lang('business_messages.postDetails.make_an_offer')</a></li>
                            @elseif($value['price_type'] == 0)
                            @if($value['inventory']['stock_remaining'] == '0')
                            <li>
                                Out of Stock
                            </li>
                            @else
                            <li class="addtocart-btn">
                                @if(Auth::user()->role == STORE_ROLE)
                                <a class="btn add_to_cart_store" id="addtoCardStore" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}">Add To Cart</a>
                                @else
                                <a class="btn add_to_cart" id="addtoCard" data-item_id="{{$value['id']}}" data-user_id="{{$value['user']['id']}}">Add To Cart</a>
                                @endif
                            </li>
                            @endif
                            @endif
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
                                    @if (!empty($boostValue['item_id']))
                                    @if ($boostValue['items']['id'] == $boostValue['item_id'])
                                    <span class="featured">@lang('business_messages.postDetails.featured')</span>
                                    @endif
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <a href="{{ route('frontend.store.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                        @else
                                        <a href="{{ route('frontend.business.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                            @endif
                                            @if (isset($boostValue['item_pictures']['item_picture1']) && !empty($boostValue['item_pictures']['item_picture1']))
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $boostValue['item_pictures']['item_picture1']) }}">
                                            @else
                                            <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/product-img1.png') }}">
                                            @endif
                                            <a href="javascript::void(0)" class="wish-list-icon">
                                                <i data-id="{{ $boostValue['items']['id'] }}" class="bx bxs-heart" @if (isset($boostValue['wishlist']['wishlist_status']) && !empty($boostValue['wishlist']['wishlist_status']) && $boostValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                            </a>
                                </div>
                                <div class="products-box-content pro-boost">
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <a href="{{ route('frontend.store.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                        @else
                                        <a href="{{ route('frontend.business.promoted-items.item_details', ($boostValue['items']['id'])) }}">
                                            @endif
                                            <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{ $boostValue['items']['price'] }} {{env('CURRENCY_TAG')}}</h6>
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
                                            <p>{{ $boostValue['city']['name'] }}</p>
                                            @endif
                                            <div class="products-box-footer">
                                                @if ($boostValue['user']['role'] == USER_ROLE)
                                                @if (isset($boostValue['user']['profile_picture']) && !empty($boostValue['user']['profile_picture']))
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
                <h4>@lang('business_messages.postDetails.related_ads') <a href="javascript:void(0)">@lang('business_messages.postDetails.view_more')</a></h4>
            </div>
            @if (!empty($relatedItemArray) && count($relatedItemArray) > 0)
            @foreach ($relatedItemArray as $relatedKey => $relatedValue)
            <div class="col-md-3">
                <div class="products-box">
                    @if ($relatedValue['condition']['name'] == NEW_ITEMS)
                    <div class="products-box-img">
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured">@lang('business_messages.postDetails.featured')</span>
                        @endif
                        @endif
                        @if(Auth::user()->role == STORE_ROLE)
                        <a href="{{ route('frontend.store.new-items.item_details', ($relatedValue['id'])) }}">
                            @else
                            <a href="{{ route('frontend.business.new-items.item_details', ($relatedValue['id'])) }}">
                                @endif
                                @if (isset($relatedValue['item_pictures']['item_picture1']) && !empty($relatedValue['item_pictures']['item_picture1']))
                                <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset('assets/images/img/product-img1.png')}}">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                    </div>
                    @elseif ($relatedValue['condition']['name'] == USED_ITEMS)
                    <div class="products-box-img">
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured">@lang('business_messages.postDetails.featured')</span>
                        @endif
                        @endif
                        @if(Auth::user()->role == STORE_ROLE)
                        <a href="{{ route('frontend.store.used-items.item_details', ($relatedValue['id'])) }}">
                            @else
                            <a href="{{ route('frontend.business.used-items.item_details', ($relatedValue['id'])) }}">
                                @endif
                                @if (isset($relatedValue['item_pictures']['item_picture1']) && !empty($relatedValue['item_pictures']['item_picture1']))
                                <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset('assets/images/img/product-img1.png')}}">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                    </div>
                    @elseif ($relatedValue['condition']['name'] == UNUSED_ITEMS)
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('business_messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured">@lang('business_messages.postDetails.featured')</span>
                        @endif
                        @endif
                        @if(Auth::user()->role == STORE_ROLE)
                        <a href="{{ route('frontend.store.unused-items.item_details', ($relatedValue['id'])) }}">
                            @else
                            <a href="{{ route('frontend.business.unused-items.item_details', ($relatedValue['id'])) }}">
                                @endif
                                @if (isset($relatedValue['item_pictures']['item_picture1']) && !empty($relatedValue['item_pictures']['item_picture1']))
                                <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset('assets/images/img/product-img1.png')}}">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                    </div>
                    @else
                    <div class="products-box-img">
                        <!-- <span class="featured">@lang('business_messages.postDetails.featured')</span> -->
                        @if (!empty($relatedValue['boostItem']['item_id']))
                        @if ($relatedValue['id'] == $relatedValue['boostItem']['item_id'])
                        <span class="featured">@lang('business_messages.postDetails.featured')</span>
                        @endif
                        @endif
                        <a href="javascript::void(0)">
                            @if (isset($relatedValue['item_pictures']['item_picture1']) && !empty($relatedValue['item_pictures']['item_picture1']))
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $relatedValue['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('assets/images/img/product-img1.png')}}">
                            @endif
                        </a>
                        <a href="javascript::void(0)" class="wish-list-icon">
                            <i data-id="{{ $relatedValue['id'] }}" class="bx bxs-heart" @if (isset($relatedValue['wishlist']['wishlist_status']) && !empty($relatedValue['wishlist']['wishlist_status']) && $relatedValue['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                        </a>
                    </div>
                    @endif
                    <div class="products-box-content">
                        <a href="javascript::void(0)">
                            @if ($relatedValue['condition']['name'] == NEW_ITEMS)
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.new-items.item_details', ($relatedValue['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.new-items.item_details', ($relatedValue['id'])) }}">
                                    @endif
                                    <span class="used-btn new-btn">{{ $relatedValue['condition']['name'] }}</span>

                                    @elseif($relatedValue['condition']['name'] == USED_ITEMS)
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <a href="{{ route('frontend.store.used-items.item_details', ($relatedValue['id'])) }}">
                                        @else
                                        <a href="{{ route('frontend.business.used-items.item_details', ($relatedValue['id'])) }}">
                                            @endif
                                            <span class="used-btn used-btn">{{ $relatedValue['condition']['name'] }}</span>

                                            @elseif($relatedValue['condition']['name'] == UNUSED_ITEMS)
                                            @if(Auth::user()->role == STORE_ROLE)
                                            <a href="{{ route('frontend.store.unused-items.item_details', ($relatedValue['id'])) }}">
                                                @else
                                                <a href="{{ route('frontend.business.unused-items.item_details', ($relatedValue['id'])) }}">
                                                    @endif
                                                    <span class="used-btn unused-btn">{{ $relatedValue['condition']['name'] }}</span>
                                                    @else
                                                    <span class="used-btn">{{ $relatedValue['condition']['name'] }}</span>
                                                    @endif
                                                    <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{ $relatedValue['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                                    <p>{{ $relatedValue['brand']['name'] }}</p>

                                                    @if (!empty($relatedValue['store']['store_name']))
                                                    <p>{{ $relatedValue['store']['store_location'] }}</p>
                                                    @else
                                                    <p>{{ $relatedValue['city']['name'] }}</p>
                                                    @endif
                                                    <div class="products-box-footer">
                                                        @if ($relatedValue['user']['role'] == USER_ROLE)

                                                        @if (isset($relatedValue['user']['profile_picture']) && !empty($relatedValue['user']['profile_picture']))
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

<!-- What is User Modal -->
<div class="modal fade" id="buy-item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Enjoy With Game</h5>
            <p>Enjoy With Game your Item that helps your product to show by more buyer</p>
            <h3 id="set_item_price"></h3>
            <h4>for Enjoy With Game your Item</h5>
                <!-- <p><a href="#" class="btn">Pay Now</a></p> -->
                <p><a style="color:#fff" href="javascript:void(0)" id="set_item_id" data-id="" class="btn make_payment checking">Pay Now</a></p>
                <p><a href="javascript:void(0)" class="cancle">Cancel</a></p>
        </div>
    </div>
</div>

<!-- Post your Offer -->
<div class="modal fade" id="post-your-offer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>Post your Offer</h5>
            <div class="model-product-author">
                <div class="model-product-author-content">
                    <img id="product-author-profile" src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/file-upload-icon.png')}}">
                    <h6><span id="product-author-name">John Doe</span><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}"></h6>
                    <p>Member since <span id="product-author-member-date">jan 2020</span></p>
                    <div class="product-rating">
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/fill-star.png') }}">
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/fill-star.png') }}">
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/grey-star.png') }}">
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/grey-star.png') }}">
                        <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/grey-star.png') }}">
                    </div>
                </div>
                <div class="model-product-author-product">
                    <img id="item-picture-7000" src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/product-slider-img.png') }}">
                    <p id="make_an_offer_item_price">7,000 {{env('CURRENCY_TAG')}}</p>
                </div>
            </div>
            <form action="{{route('frontend.business.make-an-offer.make_an_offer_post')}}" enctype="multipart/form-data" method="post" id="b_make_an_offer">
                @csrf
                <div>
                    <input type="hidden" name="productAuthorId" id="setProductAuthorId_make_an_offer" value="">
                    <input type="hidden" name="productId" id="setProductId_make_an_offer" value="">
                    <input type="hidden" name="productPrice" id="setProductPrice_make_an_offer" value="">

                </div>
                <div class="input-group">
                    <input type="text" name="offer_price" value="{{old('offer_price')}}" placeholder="Enter offer price" class="form-control">
                    @if ($errors->has('offer_price'))
                    <span class="text-danger">{{ $errors->first('offer_price') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="offer_message" value="{{old('offer_message')}}" placeholder="Write your message"></textarea>
                    @if ($errors->has('offer_message'))
                    <span class="text-danger">{{ $errors->first('offer_message') }}</span>
                    @endif
                </div>
                <div class="form-group submit">
                    <input type="submit" value="Send" class="form-control btn btn-primary">
                </div>
            </form>
            <!-- <a href="javascript:void(0)" class="cancle">Cancel</a> -->
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
                <img id="item-picture-8000" src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/product-slider-img.png') }}">
                <h5 id="product-name-hold-an-offer">Apple airpods</h5>
                <p id="product-price-hold-an-offer">7,000 {{env('CURRENCY_TAG')}}</p>
            </div>
            <p>Booking charge is 10% of the item price for 1 month</p>
            <ul>
                <li>Booking price<strong><span id="bookingPrice">10</span> {{env('CURRENCY_TAG')}}</strong></li>
                <li>Payable amount for items<strong><span id="payableAmountItems">190</span> {{env('CURRENCY_TAG')}}</strong></li>
            </ul>
            <form action="{{route('frontend.business.hold-an-offer.hold_an_offer_post')}}" enctype="multipart/form-data" method="post" id="b_hold_an_offer">
                @csrf
                <div class="form-group submit">
                    <input type="hidden" name="productAuthorId" id="setProductAuthorId" value="">
                    <input type="hidden" name="productId" id="setProductId" value="">
                    <input type="hidden" name="productPrice" id="setProductPrice_hold_an_offer" value="">
                    <input type="hidden" name="bookingPrice" id="setBookingPrice" value="">
                    <input type="hidden" name="payableAmountForItem" id="setPayableAmountForItem" value="">

                    <input type="submit" value="Book now" class="form-control btn">
                </div>
            </form>
            <!-- <a href="javascript:void(0)" class="cancle">Cancel</a> -->
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
