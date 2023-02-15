@extends('frontend.business.includes.web')

@section('pageTitle') 
    {{'Tejarh - Business - Like Listing'}} 
@endsection

@section('content')

    <div class="wishlist-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.header.Likelist')</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-12">
                    <div class="likelist_deleted_message"></div>
                    <div class="wishlist-table">
                        <table>
                            <tr>
                                <!-- <th width="60px">
                                    <div class="form-check">
                                        <input class="form-check-input parent" type="checkbox" value=""
                                            id="flexCheckDefault">
                                    </div>
                                </th> -->
                                <th>@lang('frontend-messages.likelist.products')</th>
                                <th>@lang('frontend-messages.likelist.price')</th>
                                <th>@lang('frontend-messages.likelist.stock_status')</th>
                                <th width="220px">@lang('frontend-messages.likelist.action')</th>
                                <th width="120px"> @lang('frontend-messages.likelist.remove')</th>
                            </tr>
                            @if (!empty($itemArray) && count($itemArray) > 0)
                                @foreach ($itemArray as $key => $value)
                                    <tr>
                                        <!-- <td>
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                            </div>
                                        </td> -->
                                        <td>
                                            <div class="wishlist-item">
                                                @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                                    <img
                                                        src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                                @else
                                                    <img src="{{ asset('img/category/placeholder.svg') }}">
                                                @endif
                                                <div class="wishlist-item-content">
                                                    <h5>{{ $value['items']['what_are_you_selling'] }}</h5>
                                                    <div class="product-rating">
                                                        <img src="{{ asset('assets/images/fill-star.png') }}">
                                                        <img src="{{ asset('assets/images/fill-star.png') }}">
                                                        <img src="{{ asset('assets/images/grey-star.png') }}">
                                                        <img src="{{ asset('assets/images/grey-star.png') }}">
                                                        <img src="{{ asset('assets/images/grey-star.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $value['items']['price'] }} {{env('CURRENCY_TAG')}}
                                        </td>
                                        <td>
                                            <p class="stock">In Stock</p>
                                        </td>
                                        <td>
                                            <a href="javascript::void(0)" class="btn">@lang('frontend-messages.likelist.buy_now')</a>
                                        </td>
                                        <td>
                                            <a class="likelist_delete" href="javascript:void(0)"
                                                data-id="{{ $value['id'] }}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            <p>@lang('frontend-messages.likelist.your_wishlist_is_empty')</p>
                                            <a href="{{ route('frontend.business.home.index') }}">@lang('frontend-messages.likelist.shopping')</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
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
                        <h2>TRY THE TEJARH APP</h2>
                        <p>Buy, sell and find just about anything using the app on your mobile.</p>
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.google.com/">
                                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.google.com/">
                                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
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
