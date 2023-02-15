
@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User Promoted Items' }}
@endsection

@section('content')
<div class="my-items-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Used Promoted Items</li>
                    </ol>
                </nav>                                        
            </div>
            <div class="col-md-7">
                <div class="my-items-filter">
                    <h5>Promoted Items</h5>
                </div>                                    
            </div>
        </div>
        <div class="row">                                   
            @if(!empty($usedItemsArray) && count($usedItemsArray) > 0)
                @foreach($usedItemsArray as $key => $value)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                <span class="featured">Featured</span>
                                @if(!empty($item['boostItem']['item_id']))
                                    @if($item['id'] == $item['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a href="{{ route('frontend.business.item-post.items_details')}}">
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
                                <a href="{{ route('frontend.business.item-post.items_details')}}">

                                    <span class="used-btn">{{$value['condition']['name']}}</span>
                                    <h6>{{$value['price']}} SAR</h6>
                                    <p>{{$value['brand']['name']}}</p>

                                    @if(!empty($value['store']['store_name']))
                                        <p>{{$value['store']['store_location']}}</p>
                                    @else
                                        <p>{{$value['zip_code']}}</p>
                                    @endif
                                    <div class="products-box-footer">
                                        @if (isset($value['store']['store_logo_file']) && !empty($value['store']['store_logo_file']))
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER.'/'.$value['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER.'/product-profile-img.png') }}" width="32" height="32">
                                        @endif
                                        @if(!empty($value['store']['store_name']))
                                            <p>{{$value['store']['store_name']}}</p>
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



