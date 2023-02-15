@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business My Items'}} 
@endsection
@section('content')

    <div class="my-items-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.conditions.new_items')</li>
                        </ol>
                    </nav>                                        
                </div>
                <div class="col-md-7">
                    <div class="my-items-filter">
                        <!-- <ul>
                            <li><a href="#" class="btn">On Sell</a></li>
                            <li><a href="#" class="btn tran_btn">Sold</a></li>
                            <li><a href="#" class="btn tran_btn">Buy</a></li>
                            <li><a href="#" class="btn tran_btn">Booked Items</a></li>                               
                        </ul> -->
                        <h5>@lang('business_messages.conditions.new_items')</h5>
                    </div>                                    
                </div>
            </div>
            <div class="row">                                   
                @if(!empty($newItemsArray) && count($newItemsArray) > 0)
                    @foreach($newItemsArray as $key => $value)
                        <div class="col-md-3">
                            <div class="products-box">
                                <div class="products-box-img">
                                    <span class="featured">@lang('business_messages.conditions.featured')</span>
                                    @if(!empty($item['boostItem']['item_id']))
                                        @if($item['id'] == $item['boostItem']['item_id'])
                                            <span class="featured">@lang('business_messages.conditions.featured')</span>
                                        @endif
                                    @endif
                                    <a href="{{ route('frontend.business.new-items.item_details', $value['item']['id']) }}">
                                        @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                            <img src="{{asset(BUSINESS_ITEMS_POST_FOLDER.'/'.$value['item_pictures']['item_picture1'])}}">
                                        @else
                                            <img src="assets/images/img/product-img1.png">
                                        @endif
                                    </a>
                                    <a href="#" class="wish-list-icon">
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </div>
                                <div class="products-box-content">
                                    <a href="{{ route('frontend.business.new-items.item_details', $value['item']['id']) }}">

                                        @if ($value['condition']['name'] == NEW_ITEMS)
                                            <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == USED_ITEMS)
                                            <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>
                                        @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                            <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                        @else
                                            <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                        @endif
                                        <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{$value['price']}} {{env('CURRENCY_TAG')}}</h6>
                                        <p>{{$value['brand']['name']}}</p>

                                        @if(!empty($value['store']['store_name']))
                                            <p>{{$value['store']['store_location']}}</p>
                                        @else
                                            <p>{{ $value['city']['name'] }}</p>
                                        @endif
                                        <div class="products-box-footer">
                                            @if ($value['user']['role'] == USER_ROLE)
                                                      
                                                @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                                                    <img src="{{ asset('assets/users/'.$value['user']['profile_picture']) }}" width="32" height="32">
                                                @else
                                                    <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
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
                                                    <img src="{{ asset('assets/images/user.png') }}"
                                                        width="32" height="32">
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
                @else                                   
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">@lang('business_messages.conditions.featured')</span>
                            <a href="product-details.html">
                                <img src="assets/images/img/product-img1.png">
                            </a>
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a href="product-details.html">
                                <span class="used-btn used-btn">Used</span>
                                <h6>7,000 SAR</h6>
                                <p>Apple airpods</p>
                                <p>Jeddah, Saudi Arabia</p>
                                <div class="products-box-footer">
                                    <img src="assets/images/img/product-profile-img.png">
                                    <p>The Full Cart</p>
                                    <i class='product-dots'></i>                                    
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">></a></li>
                        </ul>
                        </nav>
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