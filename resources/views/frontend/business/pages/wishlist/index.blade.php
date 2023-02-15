@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Wishlist'}}
@endsection
@section('content')
<div class="wishlist-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.menu.wishlist')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="wishlist_deleted_message"></div>
                <div class="wishlist-table">
                    @if(!empty($itemArray) && count($itemArray) > 0)
                    <table>
                        <tr>
                            <th>@lang('business_messages.wishlist.products')</th>
                            <th>@lang('business_messages.wishlist.price')</th>
                            <th>@lang('business_messages.wishlist.stock_status')</th>
                            <th width="220px">@lang('business_messages.wishlist.action')</th>
                            <th width="120px"> @lang('business_messages.wishlist.remove')</th>
                        </tr>
                        @if(!empty($itemArray) && count($itemArray) > 0)
                        @foreach ($itemArray as $key => $value)
                        <tr>
                            <td>
                                <div class="wishlist-item">
                                    @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{asset('img/category/placeholder.svg')}}">
                                    @endif
                                    <div class="wishlist-item-content">
                                        <h5>{{$value['items']['what_are_you_selling']}}</h5>
                                        <div class="product-rating">
                                            <a href="{{ route('frontend.business.product-reviews.reviews_details',$value['items']['id'])}}">
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
                                </div>
                            </td>
                            <td>
                                {{$value['items']['price']}} {{env('CURRENCY_TAG')}}
                            </td>
                            <td>
                                <p class="stock">In Stock</p>
                            </td>
                            <td>
                                <a href="javascript::void(0)" class="btn">@lang('business_messages.wishlist.buy_now')</a>
                            </td>
                            <td>
                                <a class="wishlist_delete" href="javascript:void(0)" data-id="{{$value['id']}}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">
                                <div>
                                    <p>@lang('business_messages.wishlist.your_wishlist_is_empty')</p>
                                    <a href="{{route('frontend.business.home.index')}}">@lang('business_messages.wishlist.shopping')</a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </table>
                    @else
                    <div class="breadcrumb-item" style="text-align:center;">
                        <h5 class="" style="color:gray">No Items in wishlist</h5>
                    </div>
                    @endif
                </div>
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
@endsection