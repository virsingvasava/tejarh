@extends('frontend.users.layouts.master')

<!-- Add Title Here particular page wise -->
@section('title')
{{ 'Tejarh - Sold-List' }}
@endsection
@section('content')
<div class="my-items-wrapper">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i
                                        class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                            <li class="breadcrumb-item">Sold Products</li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
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

            <div class="col-md-12">
                    <div class="wishlist_deleted_message"></div>
                    <div class="wishlist-table">
                        <table>
                            @if(!empty($itemArray) && count($itemArray) > 0)
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Condition</th>
                                    <th>Brand</th>
                                    <th>Location</th>
                                    <th>Who Purchase</th>
                                </tr>
                            @endif
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
                                                <h5>{{$value['item']['what_are_you_selling']}}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                       {{$value['item']['price']}} {{env('CURRENCY_TAG')}}
                                    </td>
                                    <td>
                                        @if ($value['condition']['name'] == NEW_ITEMS)
                                        <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == USED_ITEMS)
                                            <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                            <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                        @else
                                            <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                       {{ $value['brand']['name'] }}
                                    </td>
                                    <td>
                                        @if (!empty($value['store']['store_name']))
                                                <p>{{ $value['store']['store_location'] }}</p>
                                        @else
                                            <p>{{ $value['city']['name'] }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        $orderId = App\Models\Orders::where('id',$value['order_id'])->first();
                                        $userId = $orderId->customer_id;
                                        $purchaseUser = App\Models\User::where('id',$userId)->first();
                                        $userName = $purchaseUser->first_name;
                                        @endphp
                                        <p>{{ $userName }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="text-center mt-5">
                                        <h6>Not Found Sold Products</h6>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        </table>
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
                    <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                        <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                        <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
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
