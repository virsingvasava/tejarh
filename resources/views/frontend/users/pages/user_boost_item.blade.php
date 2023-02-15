@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Sell item' }}
@endsection

@section('content')
<div class="product-details-wrapper boost-item-wrapper">
    <div class="container">
        <div class="row">
            @if (!empty($itemArray) && count($itemArray) > 0)
            @foreach ($itemArray as $value)
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">{{ $value['category']['category_name'] }}</a></li>
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
                    <h5>@lang('frontend-messages.postDetails.details')</h5>
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
                                <h5><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $value['price'] }} {{env('CURRENCY_TAG')}}</h5>
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
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul>
                                    <li>
                                        <a href="javascript::void(0)">
                                            <i data-id="{{ $value['id'] }}" class="fas fa-thumbs-up" id="add-like" @if (isset($value['likelist']['like_status']) && !empty($value['likelist']['like_status']) && $value['likelist']['like_status'])==1 att="0" style="color:blue;" @else att="0" style="color:black;" @endif></i>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fas fa-share-alt"></i></a></li>
                                    <li><a href="javascript:void(0)"><i data-id="{{ $value['id'] }}" class="bx bxs-heart"
                                                    @if (isset($value['wishlist']['wishlist_status']) &&
                                                        !empty($value['wishlist']['wishlist_status']) &&
                                                        $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i></a></li>
                                </ul>
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
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/fill-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/grey-star.png') }}">
                            <strong>3 @lang('frontend-messages.postDetails.out_of') 5</strong>
                        </div>
                        <p>1000 @lang('frontend-messages.postDetails.global_ratings')</p>
                        <a href="#" class="product-right-arrow">></a>
                    </div>
                    <div class="product-action-button">
                        @php
                        $total_amount = $value['price'];
                        $boosted_price = round(10/100 * $total_amount);
                        @endphp
                        <input type="hidden" name="price" id="get_item_price" value="{{ $boosted_price }} {{env('CURRENCY_TAG')}}">
                        <a href="javascript:void(0)" class="btn get_items_id" data-id="{{ $value['id'] }}" data-bs-toggle="modal" data-bs-target="#boost-item">@lang('frontend-messages.postDetails.boost_item')</a></li>
                    </div>
                </div>
                <div class="related-product-list">

                    @if (!empty($boostItemArray) && count($boostItemArray) > 0)
                    <h4>@lang('frontend-messages.postDetails.boosted_items') <a href="{{ route('frontend.users.boost-items.index') }}">@lang('frontend-messages.postDetails.view_more')</a></h4>
                    @else
                    <h4>@lang('frontend-messages.postDetails.boosted_items') <a href="javascript::void(0)" style="pointer-events:none;">@lang('frontend-messages.postDetails.view_more')</a></h4>
                    @endif

                    @if (!empty($boostItemArray) && count($boostItemArray) > 0)
                    <ul>
                        @foreach ($boostItemArray as $key => $boostItems)
                        @php
                        $boostItems_name = $boostItems->item_id;
                        $boostItemDetails = App\Models\Item::where('id', $boostItems_name)->get();
                        @endphp
                        <li>
                            @foreach($boostItemDetails as $item_name)
                            @php
                            $item_condition_id = $item_name->condition_id;
                            $item_condition = App\Models\Condition::where('id', $item_condition_id)->first();
                            $item_images = App\Models\ItemsImages::where('id', $item_name->id)->first();
                            $user = App\Models\User::where('id', $item_name->user_id)->first();
                            $userCity = $user->city_id;
                            $getCity = App\Models\City::where('id', $userCity)->first();
                            @endphp
                            <div class="products-box">
                                <div class="products-box-img">
                                    <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                    @if (isset($item_images['item_picture1']) && !empty($item_images['item_picture1']))
                                    <div class="item">
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_images['item_picture1']) }}">
                                    </div>
                                    @endif
                                    <a href="#" class="wish-list-icon">
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </div>
                                <div class="products-box-content">
                                    @if ($item_condition['name'] == NEW_ITEMS)
                                    <span class="used-btn new-btn">{{ $item_condition['name'] }}</span>

                                    @elseif($item_condition['name'] == USED_ITEMS)
                                    <span class="used-btn used-btn">{{ $item_condition['name'] }}</span>

                                    @elseif($item_condition['name'] == UNUSED_ITEMS)
                                    <span class="used-btn unused-btn">{{ $item_condition['name'] }}</span>
                                    @else
                                    <span class="used-btn">{{ $item_condition['name'] }}</span>
                                    @endif
                                    <h6>{{ $boostItems->boost_amount }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $item_name->what_are_you_selling }}</p>
                                    <p>{{ $getCity->name }}</p>
                                    <div class="products-box-footer" style="display:none">
                                        <img src="assets/images/img/product-profile-img.png">
                                        <p>The Full Cart</p>
                                        <i class='product-dots'></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>@lang('frontend-messages.postDetails.boost_item_not_found')</p>
                    @endif
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
                <h4>@lang('frontend-messages.postDetails.related_ads') <a href="javascript:void(0)">@lang('frontend-messages.postDetails.view_more')</a></h4>
            </div>

            @if (!empty($relatedItemArray) && count($relatedItemArray) > 0)
            @foreach ($relatedItemArray as $key => $value)
            <div class="col-md-3">
                <div class="products-box">
                    @if ($value['condition']['name'] == NEW_ITEMS)
                        <div class="products-box-img">
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @if (!empty($value['boostItem']['item_id']))
                                @if ($value['id'] == $value['boostItem']['item_id'])
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @endif
                                @endif 
                                <a href="{{ route('frontend.users.new-items.item_details', ($value['id'])) }}">
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
                    @elseif ($value['condition']['name'] == USED_ITEMS)
                        <div class="products-box-img">
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @if (!empty($value['boostItem']['item_id']))
                                @if ($value['id'] == $value['boostItem']['item_id'])
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @endif
                                @endif
                                <a href="{{ route('frontend.users.used-items.item_details', ($value['id'])) }}">
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
                    @elseif ($value['condition']['name'] == UNUSED_ITEMS)
                        <div class="products-box-img">
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @if (!empty($value['boostItem']['item_id']))
                                @if ($value['id'] == $value['boostItem']['item_id'])
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @endif
                                @endif
                                <a href="{{ route('frontend.users.unused-items.item_details', ($value['id'])) }}">
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
                    @else
                        <div class="products-box-img">
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @if (!empty($value['boostItem']['item_id']))
                                @if ($value['id'] == $value['boostItem']['item_id'])
                                <span class="featured">@lang('frontend-messages.postDetails.featured')</span>
                                @endif
                                @endif
                                <a href="javascript::void(0)">
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
                    @endif  
                    <div class="products-box-content">
                            @if ($value['condition']['name'] == NEW_ITEMS)
                            <a href="{{ route('frontend.users.new-items.item_details', ($value['id'])) }}">
                            <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>

                            @elseif($value['condition']['name'] == USED_ITEMS)
                            <a href="{{ route('frontend.users.used-items.item_details', ($value['id'])) }}">
                            <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>

                            @elseif($value['condition']['name'] == UNUSED_ITEMS)
                            <a href="{{ route('frontend.users.unused-items.item_details', ($value['id'])) }}">
                            <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                            @else
                            <span class="used-btn">{{ $value['condition']['name'] }}</span>
                            @endif
                            <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $value['price'] }} {{env('CURRENCY_TAG')}}</h6>
                            <p>{{ $value['brand']['name'] }}</p>

                            @if (!empty($value['store']['store_name']))
                            <p>{{ $value['store']['store_location'] }}</p>
                            @else
                            <p> {{ $value['city']['name'] }}</p>
                            @endif
                            <div class="products-box-footer" style="display:none">
                                @if (isset($value['store']['store_logo_file']) && !empty($value['store']['store_logo_file']))
                                <img src="{{ asset(USERS_PROFILE_FOLDER . '/' . $value['store']['store_logo_file']) }}" width="32" height="32">
                                @else
                                <img src="{{ asset(USERS_PROFILE_FOLDER . '/product-profile-img.png') }}" width="32" height="32">
                                @endif
                                @if (!empty($value['store']['store_name']))
                                <p>{{ $value['store']['store_name'] }}</p>
                                @else
                                <p>Lorem text</p>
                                @endif
                                <i class='product-dots'></i>
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
                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- What is User Modal -->
<div class="modal fade" id="boost-item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.postDetails.boost_item')</h5>
            <p>@lang('frontend-messages.postDetails.boosted_items_desc')</p>
            <h3 id="set_item_price"></h3>
            <h4>@lang('frontend-messages.postDetails.boosted_items_short_desc')</h5>
                <p><a href="javascript:void(0)" data-id="" class="btn make_payment" id="set_item_id">@lang('frontend-messages.postDetails.pay_now')</a></p>
                {{-- <p><a href="javascript:void(0)" class="cancle">@lang('frontend-messages.postDetails.cancel')</a></p> --}}
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection