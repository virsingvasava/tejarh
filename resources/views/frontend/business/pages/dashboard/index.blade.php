@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Dashboard'}} 
@endsection
@section('content')

<div class="dashborad-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.menu.dashboard')</li>
                    </ol>
                </nav>                                        
            </div>
        </div>
        <div class="row">  
            <div class="col-md-4">
                <div class="dashborad-left-side">
                    <ul>
                        <li>
                            <h5 class="green-color"><a href="javascript:void(0)">
                            {{$currentBalance}} @lang('business_messages.dashboard.sar')</a></h5>
                            <p>@lang('business_messages.dashboard.current_balance')</p>
                            <span>{{ $todayDate }}</span>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.net_profit')</p>
                            <h5 class="dark-green-color">{{$netProfit}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.total_GMV')({{$currentYear}})</p>
                            <h5 class="orange-color">{{$totalGMV}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.repeating_customers')</p>
                            <h5 class="dark-green-color">{{$repeatingCustomers}}</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.delivered_order_value')</p>
                            <h5 class="orange-color">{{$deliveredOrderValue}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.number_of_customers')</p>
                            <h5 class="red-color">{{$numberofCustomers}}</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.Inventory_value')</p>
                            <h5 class="purple-color">{{$InventoryValue}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.completed_orders_value')</p>
                            <h5 class="dark-green-color">{{$completedOrdersValue}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.total_to_collect')</p>
                            <h5 class="orange-color">{{$totaltoCollect}} @lang('business_messages.dashboard.sar')</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.delivered_order')</p>
                            <h5 class="dark-green-color">{{$deliveredOrder}}</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.pending_order')</p>
                            <h5 class="orange-color">{{$pendingOrder}}</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.rejected_order')</p>
                            <h5 class="green-color">{{$rejectedOrder}}</h5>
                        </li>
                        <li>
                            <p>@lang('business_messages.dashboard.returned_order')</p>
                            <h5 class="purple-color">{{$returnedOrder}}</h5>
                        </li>
                    </ul>
                </div>
                
            </div>                                  
            <div class="col-md-8">
                <h4>@lang('business_messages.menu.orders')<a href="{{route('frontend.business.my-orders.index')}}">@lang('business_messages.home.view_more')</a></h4>
                <div class="row">
                    @if(!empty($ordersItemArray) && count($ordersItemArray))
                        @foreach($ordersItemArray as $key => $value)
                            <div class="col-md-6">
                                <div class="products-box">
                                    <div class="products-box-img">
                                        <span class="featured">Featured</span>
                                        @if (!empty($item['boostItem']['item_id']))
                                            @if ($item['id'] == $item['boostItem']['item_id'])
                                                <span class="featured">Featured</span>
                                            @endif
                                        @endif
                                        <a
                                            href="{{ route('frontend.business.promoted-items.item_details', base64_encode($value['id'])) }}">
                                            @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                                <img
                                                    src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                            @else
                                                <img src="assets/images/img/product-img1.png">
                                            @endif
                                        </a>
                                        <a href="javascript::void(0)" class="wish-list-icon">
                                            <i data-id="{{ $value['id'] }}" class="bx bxs-heart"
                                                @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status']) == 1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                        </a>
                                    </div>
                                    <div class="products-box-content">

                                        <a
                                            href="{{ route('frontend.business.promoted-items.item_details', base64_encode($value['id'])) }}">
                                            <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                            <h6>{{ $value['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                            <p>{{ $value['brand']['name'] }}</p>

                                            @if (!empty($value['store']['store_name']))
                                                <p>{{ $value['store']['store_location'] }}</p>
                                            @else
                                            <p>Lorem text</p>
                                            @endif
                                            <div class="products-box-footer">
                                                @if (isset($value['store']['store_logo_file']) && !empty($value['store']['store_logo_file']))
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['store']['store_logo_file']) }}"
                                                        width="32" height="32">
                                                @else
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/product-profile-img.png') }}"
                                                        width="32" height="32">
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
