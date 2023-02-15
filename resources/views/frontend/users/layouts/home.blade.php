@extends('frontend.users.layouts.master')
@section('title','Tejarh - Home')
@section('content')

<div class="story-wrapper">
    <div class="container">
        <div class="add-story">
            <i class='bx bx-plus' data-bs-toggle="modal"
                @if (Auth::check() && Auth::user()->role == USER_ROLE) data-bs-target="#Uploading-Story" @else data-bs-target="#loginModal" @endif></i>
            <span>@lang('frontend-messages.UserStory.storytext')</span>
        </div>
        <div class="story-slider-wrapper">
            <strong class="close-story-btn">+</strong>
            <div id="sync1" class="slider owl-carousel">
                @if (Auth::check())
                    @if (count($Story) > 1)
                        <div class="multi-story-slider owl-carousel">
                            @foreach ($Story as $str)
                                <div class="item">
                                    <div class="story-slide-box">
                                        <div class="story-slide-img">
                                            <h6>
                                                @if (isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
                                                    <img
                                                        src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                                                @else
                                                    <img src="{{ asset('assets/images/user.png') }}">
                                                @endif
                                                {{ $str->category->category_name }}
                                                <i class='bx bx-info-circle'></i>
                                            </h6>
                                            @php
                                                $extension = pathinfo($str->video_or_image_file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if ($extension == 'mp4')
                                                <video controls autoplay
                                                    src="{{ asset('assets/stories/' . $str->video_or_image_file) }}"></video>
                                            @else
                                                <img
                                                    src="{{ asset('assets/stories/' . $str->video_or_image_file) }}">
                                            @endif

                                        </div>
                                        <div class="story-slide-content">
                                            <h5>{{ $str->product_name }}<strong>{{ $str->product_price }} 
                                            {{env('CURRENCY_TAG')}}</strong>
                                            </h5>
                                            <p>{{ $str->story_description }}<a href="#">More</a></p>
                                            <p>{{ $str->store_location }}</p>
                                            <a href="#" class="btn">Make an offer</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        @foreach ($Story as $str)
                            <div class="story-slide-box">
                                <div class="story-slide-img">
                                    <h6>
                                        @if (isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
                                            <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                                        @else
                                            <img src="{{ asset('assets/images/user.png') }}">
                                        @endif
                                        {{ $str->category->category_name }}
                                        <i class='bx bx-info-circle'></i>
                                    </h6>
                                    @php
                                        $extension = pathinfo($str->video_or_image_file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extension == 'mp4')
                                        <video controls autoplay
                                            src="{{ asset('assets/stories/' . $str->video_or_image_file) }}"></video>
                                    @else
                                        <img src="{{ asset('assets/stories/' . $str->video_or_image_file) }}">
                                    @endif
                                </div>
                                <div class="story-slide-content">
                                    <h5>{{ $str->product_name }}<strong>{{ $str->product_price }} {{env('CURRENCY_TAG')}}</strong>
                                    </h5>
                                    <p>{{ $str->story_description }}<a href="#">More</a></p>
                                    <p>{{ $str->store_location }}</p>
                                    <a href="#" class="btn">Make an offer</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    @foreach ($Story as $str1)
                        @if (count($str1) > 1)
                            <div class="multi-story-slider owl-carousel">
                                @foreach ($str1 as $strtest)
                                    <div class="item">
                                        <div class="story-slide-box">
                                            <div class="story-slide-img">
                                                <h6>
                                                    @if (isset($strtest['user']['profile_picture']) && !empty($strtest['user']['profile_picture']))
                                                        <img
                                                            src="{{ asset('assets/users/' . $strtest['user']['profile_picture']) }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/user.png') }}">
                                                    @endif
                                                    {{ $strtest['category']['category_name'] }}
                                                    <i class='bx bx-info-circle'></i>
                                                </h6>
                                                @php
                                                    $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                                                @endphp
                                                @if ($extension == 'mp4')
                                                    <video controls autoplay="true"
                                                        src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
                                                @endif
                                            </div>
                                            <div class="story-slide-content">
                                                <h5>{{ $strtest['product_name'] }}<strong>{{ $strtest['product_price'] }}
                                                {{env('CURRENCY_TAG')}}</strong></h5>
                                                <p>{{ $strtest['story_description'] }}<a href="#">More</a></p>
                                                <p>{{ $strtest['store_location'] }}</p>
                                                <a href="#" class="btn">Make an offer</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @foreach ($str1 as $strtest)
                                <div class="story-slide-box">
                                    <div class="story-slide-img">
                                        <h6>
                                            @if (isset($strtest['user']['profile_picture']) && !empty($strtest['user']['profile_picture']))
                                                <img
                                                    src="{{ asset('assets/users/' . $strtest['user']['profile_picture']) }}">
                                            @else
                                                <img src="{{ asset('assets/images/user.png') }}">
                                            @endif
                                            {{ $strtest['category']['category_name'] }}
                                            <i class='bx bx-info-circle'></i>
                                        </h6>
                                        @php
                                            $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($extension == 'mp4')
                                            <video controls autoplay
                                                src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                                        @else
                                            <img
                                                src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
                                        @endif
                                    </div>
                                    <div class="story-slide-content">
                                        <h5>{{ $strtest['product_name'] }}<strong>{{ $strtest['product_price'] }}
                                        {{env('CURRENCY_TAG')}}</strong></h5>
                                        <p>{{ $strtest['story_description'] }}<a href="#">More</a></p>
                                        <p>{{ $strtest['store_location'] }}</p>
                                        <a href="#" class="btn">Make an offer</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        @if (Auth::check())
            <div id="sync2" class="story-slider navigation-thumbs owl-carousel">
                @foreach ($LoginuserStory as $key => $user)
                    <div class="story-slider-box">
                        <a href="#">
                            <div class="story-img">
                                @if (isset($user->user->profile_picture))
                                    <img src="{{ asset('assets/users/' . $user->user->profile_picture) }}"
                                        alt="Shape">
                                @else
                                    <img src="{{ asset('assets/images/user.png') }}" alt="Shape">
                                @endif
                            </div>
                            <span>{{ $user->user->first_name}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div id="sync2" class="story-slider navigation-thumbs owl-carousel">
                @if (!empty($LoginuserStory) && count($LoginuserStory) > 0)
                    @foreach ($LoginuserStory as $key => $otheruser)
                        <div class="story-slider-box">
                            @php
                                    $userArr = App\Models\User::where('id', $otheruser->user_id)->first();
                            @endphp

                            @if(!empty($userArr->role) &&  $userArr->role == USER_ROLE)
                                <a class="u" href="#">
                                    <div class="story-img">
                                        @if (isset($userArr->profile_picture) && !empty($userArr->profile_picture))
                                            <img src="{{ asset('assets/users/' . $userArr->profile_picture) }}"
                                                alt="Shape">
                                        @else
                                            <img src="{{ asset('business/user_pictures/user.png') }}" alt="Shape">
                                        @endif
                                    </div>
                                    @if (isset($userArr->first_name) && !empty($userArr->first_name))
                                        <span>{{ $userArr->first_name }}</span>
                                    @else
                                        <span>Lorem Text</span>
                                    @endif
                                </a>
                            @else
                                <a class="b" href="#">
                                    <div class="story-img">
                                        @if (isset($userArr->profile_picture) && !empty($userArr->profile_picture))
                                            <img src="{{ asset('assets/users/' . $userArr->profile_picture) }}"
                                                alt="Shape">
                                        @else
                                            <img src="{{ asset('business/user_pictures/user.png') }}" alt="Shape">
                                        @endif
                                    </div>
                                    @if (isset($userArr->first_name) && !empty($userArr->first_name))
                                        <span>{{ $userArr->first_name }}</span>
                                    @else
                                        <span>Lorem Text</span>
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</div>

<div class="hero-slider-wrapper">
    <div class="hero-slider-user owl-carousel">
        @foreach ($sliderImage as $image)
            <div class="hero-image-slide">
                @if ($image->banner_picture != '' && file_exists(public_path('img/home_slider/' . $image->banner_picture)))
                    <img src="{{ asset('img/home_slider/' . $image->banner_picture) }}">
                @else
                    <img src="{{ asset('assets/images/img/hero-band-img.png') }}">
                @endif
                <div class="hero-slide-content-wrapper">
                    <div class="hero-slide-content">
                        @if (App::isLocale('en'))
                            <h2>{{ $image->banner_heading_title }}</h2>
                            <p>{{ $image->banner_sub_heading_title }}</p>
                        @else
                            <h2>{{ $image->ar_banner_heading_title }}</h2>
                            <p>{{ $image->ar_banner_sub_heading_title }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="category-menu">
    <div class="container">
        <div class="cat-scroll">
            <ul>
                @if (!empty($category) && count($category) > 0)
                    @foreach ($category as $key => $cat)
                        @if ($key < 7)
                            <li>
                                <a @if (Auth::check()) href="{{ route('frontend.users.product_category.index', $cat->id)}}" @else href="{{ route('frontend.users.product_category.index', $cat->id)}}" @endif>
                                    
                                    @if ($cat->cate_picture != '' && file_exists(public_path('img/category/' . $cat->cate_picture)))
                                        <figure><img src="{{ asset('img/category/' . $cat->cate_picture) }}"></figure>
                                    @else
                                        <img src="{{ asset('img/category/placeholder.svg') }}">
                                    @endif
                                    @if (App::isLocale('en'))
                                        <span>{{ $cat->category_name }}</span>
                                    @else
                                        <span>{{ $cat->ar_category_name }}</span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <ul class="morecategory">
            <li class="category-sub-menu-wrapper">
                @if ($AllCategoryCount > 7)
                    <a href="">
                        <figure><img src="{{ asset('img/category/category-morecategory.png') }}"></figure><span> 
                            @lang('messages.category.more_categories')</span>
                    </a>
                @endif
                <div class="category-sub-menu right">
                    <ul>
                        @if (!empty($categorySingle) && count($categorySingle) > 0)
                            @foreach ($categorySingle as $key => $cat)
                                <li><a href="{{ route('frontend.users.product_category.index', $cat->id)}}">
                                    @if (App::isLocale('en'))
                                        <span>{{ $cat->category_name }}</span>
                                    @else
                                        <span>{{ $cat->ar_category_name }}</span>
                                    @endif
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="products-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>
                    @if(!empty($promoted_items_count) && $promoted_items_count > 0)
                        @lang('business_messages.home.promoted_items')
                    @endif
                    @if (!empty($promoted_items_count) && $promoted_items_count > 16)
                        <a href="{{ route('frontend.users.promoted-items.index') }}">@lang('business_messages.home.view_more')</a>
                    @endif
                </h4>
            </div>
            @if (!empty($itemArray) && count($itemArray) > 0)
                @foreach ($itemArray as $key => $value)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                @if (!empty($value['boostItem']['item_id']))
                                    @if ($value['item']['id'] == $value['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a href="{{ route('frontend.users.promoted-items.item_details', $value['item']['id'])}}">

                                    @if ($value['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture1'])))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                @if(Auth::check())
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $value['item']['id'] }}" class="bx bxs-heart"
                                        @if (isset($value['wishlist']['wishlist_status']) &&
                                            !empty($value['wishlist']['wishlist_status']) &&
                                            $value['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="wish-list-icon">                                    
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                @endif
                            </div>
                            <div class="products-box-content">
                                <a href="{{ route('frontend.users.promoted-items.item_details', $value['item']['id'])}}">

                                    @if ($value['condition']['name'] == NEW_ITEMS)
                                        <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>

                                    @elseif($value['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>
                                        
                                    @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                    @else
                                        <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                    @endif

                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}">  {{ $value['item']['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $value['brand']['name'] }}</p>

                                    @if (!empty($value['store']['store_name']))
                                        <p>{{ $value['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $value['city']['name'] }}</p>
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$value['id'])}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
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
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>
                    @if(!empty($newItemsList_count) && $newItemsList_count > 0)
                        @lang('business_messages.home.new_items')
                    @endif
                    @if (!empty($newItemsList_count) && $newItemsList_count > 12)
                        <a href="{{ route('frontend.users.new-items.index') }}">@lang('business_messages.home.view_more')</a>
                    @endif
                </h4>
            </div>
            @if (!empty($newItemsListArray) && count($newItemsListArray) > 0)
                @foreach ($newItemsListArray as $key => $newItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                @if (!empty($newItems['boostItem']['item_id']))
                                    @if ($newItems['id'] == $newItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a href="{{ route('frontend.users.new-items.item_details', $newItems['id']) }}">

                                    @if ($newItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$newItems['item_pictures']['item_picture1'])))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $newItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                @auth
                                    <a href="javascript::void(0)" class="wish-list-icon">
                                        <i data-id="{{ $newItems['id'] }}" class="bx bxs-heart"
                                            @if (isset($newItems['wishlist']['wishlist_status']) &&
                                                !empty($newItems['wishlist']['wishlist_status']) &&
                                                $newItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="wish-list-icon">                                    
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="products-box-content">
                                <a href="{{ route('frontend.users.new-items.item_details', $newItems['id']) }}">

                                    @if ($newItems['condition']['name'] == NEW_ITEMS)
                                       <span class="used-btn new-btn">{{ $newItems['condition']['name'] }}</span>

                                    @elseif($newItems['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $newItems['condition']['name'] }}</span>
                                        
                                    @elseif($newItems['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $newItems['condition']['name'] }}</span>
                                    @else
                                        <span class="used-btn">{{ $newItems['condition']['name'] }}</span>
                                    @endif

                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $newItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $newItems['brand']['name'] }}</p>

                                    @if (!empty($newItems['store']['store_name']))
                                        <p>{{ $newItems['store']['store_location'] }}</p>
                                    @else
                                        @if (!empty($newItems['city']['name']))
                                         <p>{{ $newItems['city']['name'] }}</p>
                                        @endif
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$newItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
                                                    <span class="bFgxSY">{{$newItems['totalReviewAvg']}}</span> 
                                                    <label><i class="fas fa-star ratings_color_set"></i></label>
                                                </div>
                                                <div class="jWgYGv">
                                                    <div underline-thickness="0.5px" class="hnUSvL">
                                                        <span>{{$newItems['reviewRatings']}} Ratings</span>
                                                        <div class="line_review_count"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="products-box-footer">
                                    @if ($newItems['user']['role'] == USER_ROLE)
                                          
                                          @if (isset($newItems['user']['profile_picture']) && !empty($newItems['user']['profile_picture']))
                                              <img src="{{ asset('assets/users/'.$newItems['user']['profile_picture']) }}" width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                          @endif
                                          @if (!empty($newItems['user']['username']))
                                              <p>{{ $newItems['user']['username'] }}</p>
                                          @else
                                              <p>{{ $newItems['user']['first_name'] }}</p>
                                          @endif
                                          @auth
                                              <i class='product-dots'></i>
                                          @else
                                              <i class="product-dots disable"></i>
                                          @endauth
                                      @else
                                          @if (isset($newItems['store']['store_logo_file']) && !empty($newItems['store']['store_logo_file']))
                                              <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $newItems['store']['store_logo_file']) }}"
                                                  width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"
                                                  width="32" height="32">
                                          @endif
                                          @if (!empty($newItems['store']['store_name']))
                                              <p>{{ $newItems['store']['store_name'] }}</p>
                                          @else
                                          <p>{{ $newItems['user']['first_name'] }}</p>
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
        <div class="row">
            <div class="col-md-12">
                <h4> 
                    @if(!empty($usedItemsListArray) && $usedItemsListArray > 0)
                        @lang('business_messages.home.used_items')
                    @endif
                    @if (!empty($usedItemsList_count) && $usedItemsList_count > 12)
                        <a href="{{ route('frontend.users.used-items.index') }}">@lang('business_messages.home.view_more')</a>
                    @endif
                </h4>
            </div>
            @if (!empty($usedItemsListArray) && count($usedItemsListArray) > 0)
                @foreach ($usedItemsListArray as $key => $usedItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                @if (!empty($usedItems['boostItem']['item_id']))
                                    @if ($usedItems['id'] == $usedItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a href="{{ route('frontend.users.used-items.item_details', $usedItems['id']) }}">

                                    @if ($usedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$usedItems['item_pictures']['item_picture1'])))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $usedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                @auth
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $usedItems['id'] }}" class="bx bxs-heart"
                                        @if (isset($usedItems['wishlist']['wishlist_status']) &&
                                            !empty($usedItems['wishlist']['wishlist_status']) &&
                                            $usedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                                @else
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="wish-list-icon">                                    
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="products-box-content">
                                <a href="{{ route('frontend.users.used-items.item_details', $usedItems['id']) }}">
                                    @if ($usedItems['condition']['name'] == NEW_ITEMS)
                                    <span class="used-btn new-btn">{{ $usedItems['condition']['name'] }}</span>

                                    @elseif($usedItems['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $usedItems['condition']['name'] }}</span>
                                        
                                    @elseif($usedItems['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $usedItems['condition']['name'] }}</span>
                                    @else
                                        <span class="used-btn">{{ $usedItems['condition']['name'] }}</span>
                                    @endif
                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $usedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $usedItems['brand']['name'] }}</p>

                                    @if (!empty($usedItems['store']['store_name']))
                                        <p>{{ $usedItems['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $usedItems['city']['name'] }}</p>
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$usedItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
                                                    <span class="bFgxSY">{{$usedItems['totalReviewAvg']}}</span> 
                                                    <label><i class="fas fa-star ratings_color_set"></i></label>
                                                </div>
                                                <div class="jWgYGv">
                                                    <div underline-thickness="0.5px" class="hnUSvL">
                                                        <span>{{$usedItems['reviewRatings']}} Ratings</span>
                                                        <div class="line_review_count"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="products-box-footer">
                                    @if ($usedItems['user']['role'] == USER_ROLE)
                                          
                                          @if (isset($usedItems['user']['profile_picture']) && !empty($usedItems['user']['profile_picture']))
                                              <img src="{{ asset('assets/users/'.$usedItems['user']['profile_picture']) }}" width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                          @endif
                                          @if (!empty($usedItems['user']['username']))
                                              <p>{{ $usedItems['user']['username'] }}</p>
                                          @else
                                              <p>{{ $usedItems['user']['first_name'] }}</p>
                                          @endif
                                          @auth
                                              <i class='product-dots'></i>
                                          @else
                                              <i class="product-dots disable"></i>
                                          @endauth
                                      @else
                                          @if (isset($usedItems['store']['store_logo_file']) && !empty($usedItems['store']['store_logo_file']))
                                              <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $usedItems['store']['store_logo_file']) }}"
                                                  width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"
                                                  width="32" height="32">
                                          @endif
                                          @if (!empty($usedItems['store']['store_name']))
                                              <p>{{ $usedItems['store']['store_name'] }}</p>
                                          @else
                                          <p>{{ $usedItems['user']['first_name'] }}</p>
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
        <div class="row">
            <div class="col-md-12">
                <h4>
                    @if(!empty($unusedItemsList_count) && $unusedItemsList_count > 0)
                        @lang('business_messages.home.unused_items')
                    @endif

                    @if (!empty($unusedItemsList_count) && $unusedItemsList_count > 12)
                        <a href="{{ route('frontend.users.unused-items.index') }}">@lang('business_messages.home.view_more')</a>
                    @endif
                </h4>
            </div>
            @if (!empty($unusedItemsListArray) && count($unusedItemsListArray) > 0)
                @foreach ($unusedItemsListArray as $key => $unusedItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                @if (!empty($unusedItems['boostItem']['item_id']))
                                    @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a
                                    href="{{ route('frontend.users.unused-items.item_details', $unusedItems['id']) }}">


                                    @if ($unusedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$unusedItems['item_pictures']['item_picture1'])))
                                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                @auth
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart"
                                        @if (isset($unusedItems['wishlist']['wishlist_status']) &&
                                            !empty($unusedItems['wishlist']['wishlist_status']) &&
                                            $unusedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                                @else
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="wish-list-icon">                                    
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="products-box-content">
                                <a href="{{ route('frontend.users.unused-items.item_details', $unusedItems['id']) }}">

                                    @if ($unusedItems['condition']['name'] == NEW_ITEMS)
                                        <span class="used-btn new-btn">{{ $unusedItems['condition']['name'] }}</span>

                                    @elseif($unusedItems['condition']['name'] == USED_ITEMS)
                                        <span class="used-btn used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                        
                                    @elseif($unusedItems['condition']['name'] == UNUSED_ITEMS)
                                        <span class="used-btn unused-btn">{{ $unusedItems['condition']['name'] }}</span>
                                    @else
                                        <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                    @endif

                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $unusedItems['brand']['name'] }}</p>

                                    @if (!empty($unusedItems['store']['store_name']))
                                        <p>{{ $unusedItems['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $unusedItems['city']['name'] }}</p>
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$unusedItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
                                                    <span class="bFgxSY">{{$unusedItems['totalReviewAvg']}}</span> 
                                                    <label><i class="fas fa-star ratings_color_set"></i></label>
                                                </div>
                                                <div class="jWgYGv">
                                                    <div underline-thickness="0.5px" class="hnUSvL">
                                                        <span>{{$unusedItems['reviewRatings']}} Ratings</span>
                                                        <div class="line_review_count"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="products-box-footer">
                                    @if ($unusedItems['user']['role'] == USER_ROLE)
                                          
                                          @if (isset($unusedItems['user']['profile_picture']) && !empty($unusedItems['user']['profile_picture']))
                                              <img src="{{ asset('assets/users/'.$unusedItems['user']['profile_picture']) }}" width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                          @endif
                                          @if (!empty($unusedItems['user']['username']))
                                              <p>{{ $unusedItems['user']['username'] }}</p>
                                          @else
                                              <p>{{ $unusedItems['user']['first_name'] }}</p>
                                          @endif
                                          @auth
                                              <i class='product-dots'></i>
                                          @else
                                              <i class="product-dots disable"></i>
                                          @endauth
                                      @else
                                          @if (isset($unusedItems['store']['store_logo_file']) && !empty($unusedItems['store']['store_logo_file']))
                                              <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $unusedItems['store']['store_logo_file']) }}"
                                                  width="32" height="32">
                                          @else
                                              <img src="{{ asset('assets/images/user.png') }}"
                                                  width="32" height="32">
                                          @endif
                                          @if (!empty($unusedItems['store']['store_name']))
                                              <p>{{ $unusedItems['store']['store_name'] }}</p>
                                          @else
                                          <p>{{ $unusedItems['user']['first_name'] }}</p>
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
        <div class="row" style="display:none">
            <div class="col-md-12">
                <h4>
                    @if(!empty($topDealsItemsArray) && $topDealsItemsArray > 0)
                        @lang('business_messages.home.top_deals')
                    @endif
                    <a href="{{ route('frontend.business.top-deals-items.index') }}">@lang('business_messages.home.view_more')</a>
                </h4>
            </div>
            @if (!empty($topDealsItemsArray) && count($topDealsItemsArray) > 0)
                @foreach ($topDealsItemsArray as $key => $unusedItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                <!-- <span class="featured">Featured</span> -->
                                @if (!empty($unusedItems['boostItem']['item_id']))
                                    @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a
                                    href="{{ route('frontend.unused.unused-items.item_details', $unusedItems['id']) }}">
                                    @if (isset($unusedItems['item_pictures']['item_picture1']) &&
                                        !empty($unusedItems['item_pictures']['item_picture1']))
                                        <img
                                            src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="assets/images/img/product-img1.png">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart"
                                        @if (isset($unusedItems['wishlist']['wishlist_status']) &&
                                            !empty($unusedItems['wishlist']['wishlist_status']) &&
                                            $unusedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                            </div>
                            <div class="products-box-content">
                                <a
                                    href="{{ route('frontend.unused.unused-items.item_details', $unusedItems['id']) }}">

                                    <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $unusedItems['brand']['name'] }}</p>

                                    @if (!empty($unusedItems['store']['store_name']))
                                        <p>{{ $unusedItems['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $unusedItems['city']['name'] }}</p>
                                    @endif
                                    <div class="products-box-footer">
                                        @if (isset($unusedItems['user']['profile_picture']) && !empty($unusedItems['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$unusedItems['user']['profile_picture']) }}" width="32" height="32">
                                        @else
                                            <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                        @endif
                                        @if (!empty($unusedItems['user']['username']))
                                            <p>{{ $unusedItems['user']['username'] }}</p>
                                        @else
                                            <p>{{ $unusedItems['user']['first_name'] }}</p>
                                        @endif
                                        @auth
                                            <i class='product-dots'></i>
                                        @else
                                            <i class="product-dots disable"></i>
                                        @endauth
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row" style="display:none">
            <div class="col-md-12">
                <h4>
                    @if(!empty($trendingItemsArray) && $trendingItemsArray > 0)
                        @lang('business_messages.home.trending_items')
                    @endif
                    <a href="{{ route('frontend.business.trending-items.index') }}">@lang('business_messages.home.view_more')</a>
                </h4>
            </div>
            @if (!empty($trendingItemsArray) && count($trendingItemsArray) > 0)
                @foreach ($trendingItemsArray as $key => $unusedItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                <!-- <span class="featured">Featured</span> -->
                                @if (!empty($unusedItems['boostItem']['item_id']))
                                    @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a
                                    href="{{ route('frontend.business.unused-items.item_details', $unusedItems['id']) }}">
                                    @if (isset($unusedItems['item_pictures']['item_picture1']) &&
                                        !empty($unusedItems['item_pictures']['item_picture1']))
                                        <img
                                            src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="assets/images/img/product-img1.png">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart"
                                        @if (isset($unusedItems['wishlist']['wishlist_status']) &&
                                            !empty($unusedItems['wishlist']['wishlist_status']) &&
                                            $unusedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                            </div>
                            <div class="products-box-content">
                                <a
                                    href="{{ route('frontend.business.unused-items.item_details', $unusedItems['id']) }}">

                                    <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $unusedItems['brand']['name'] }}</p>

                                    @if (!empty($unusedItems['store']['store_name']))
                                        <p>{{ $unusedItems['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $unusedItems['city']['name'] }}</p>
                                    @endif
                                    <div class="products-box-footer">
                                        @if (isset($unusedItems['user']['profile_picture']) && !empty($unusedItems['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$unusedItems['user']['profile_picture']) }}" width="32" height="32">
                                        @else
                                            <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                        @endif
                                        @if (!empty($unusedItems['user']['username']))
                                            <p>{{ $unusedItems['user']['username'] }}</p>
                                        @else
                                            <p>{{ $unusedItems['user']['first_name'] }}</p>
                                        @endif
                                        @auth
                                            <i class='product-dots'></i>
                                        @else
                                            <i class="product-dots disable"></i>
                                        @endauth
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row" style="display:none">
            <div class="col-md-12">
                <h4>
                    @if(!empty($recommendedItemsArray) && $recommendedItemsArray > 0)
                        @lang('business_messages.home.recommended_for_you')
                    @endif
                    <a href="{{ route('frontend.business.recommended-items.index') }}">@lang('business_messages.home.view_more')</a></h4>
            </div>
            @if (!empty($recommendedItemsArray) && count($recommendedItemsArray) > 0)
                @foreach ($recommendedItemsArray as $key => $unusedItems)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                <!-- <span class="featured">Featured</span> -->
                                @if (!empty($unusedItems['boostItem']['item_id']))
                                    @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                                        <span class="featured">Featured</span>
                                    @endif
                                @endif
                                <a
                                    href="{{ route('frontend.business.unused-items.item_details', $unusedItems['id']) }}">
                                    @if (isset($unusedItems['item_pictures']['item_picture1']) &&
                                        !empty($unusedItems['item_pictures']['item_picture1']))
                                        <img
                                            src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                        <img src="assets/images/img/product-img1.png">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart"
                                        @if (isset($unusedItems['wishlist']['wishlist_status']) &&
                                            !empty($unusedItems['wishlist']['wishlist_status']) &&
                                            $unusedItems['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                            </div>
                            <div class="products-box-content">
                                <a
                                    href="{{ route('frontend.business.unused-items.item_details', $unusedItems['id']) }}">

                                    <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                    <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $unusedItems['brand']['name'] }}</p>

                                    @if (!empty($unusedItems['store']['store_name']))
                                        <p>{{ $unusedItems['store']['store_location'] }}</p>
                                    @else
                                        <p>{{ $unusedItems['city']['name'] }}</p>
                                    @endif

                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.users.product-reviews.reviews_details',$unusedItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
                                                    <span class="bFgxSY">{{$unusedItems['totalReviewAvg']}}</span> 
                                                    <label><i class="fas fa-star ratings_color_set"></i></label>
                                                </div>
                                                <div class="jWgYGv">
                                                    <div underline-thickness="0.5px" class="hnUSvL">
                                                        <span>{{$unusedItems['reviewRatings']}} Ratings</span>
                                                        <div class="line_review_count"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="products-box-footer">
                                        @if (isset($unusedItems['user']['profile_picture']) && !empty($unusedItems['user']['profile_picture']))
                                            <img src="{{ asset('assets/users/'.$unusedItems['user']['profile_picture']) }}" width="32" height="32">
                                        @else
                                            <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
                                        @endif
                                        @if (!empty($unusedItems['user']['username']))
                                            <p>{{ $unusedItems['user']['username'] }}</p>
                                        @else
                                            <p>{{ $unusedItems['user']['first_name'] }}</p>
                                        @endif
                                        @auth
                                            <i class='product-dots'></i>
                                        @else
                                            <i class="product-dots disable"></i>
                                        @endauth
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

<div class="best-sellers">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>@lang('frontend-messages.Items.TejarhSellers')</h3>
            </div>
            <div class="col-md-3">
                <div class="best-sellers-box">
                    <div class="best-sellers-img">
                        <img src="assets/images/okta-logo.png">
                    </div>
                    <h5>Okta Market<img src="assets/images/best-seller.png"></h5>
                    <p>Member since January 2020</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="best-sellers-box">
                    <div class="best-sellers-img">
                        <img src="assets/images/berol-logo.png">
                    </div>
                    <h5>Berol<img src="assets/images/best-seller.png"></h5>
                    <p>Member since January 2020</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="best-sellers-box">
                    <div class="best-sellers-img">
                        <img src="assets/images/oui-logo.png">
                    </div>
                    <h5>Oui rock you<img src="assets/images/best-seller.png"></h5>
                    <p>Member since January 2020</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="best-sellers-box">
                    <div class="best-sellers-img">
                        <img src="assets/images/cherie-logo.png">
                    </div>
                    <h5>Cherie<img src="assets/images/best-seller.png"></h5>
                    <p>Member since January 2020</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="buy-wholesale">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang('frontend-messages.Wholesale.heading')</h2>
            </div>
            @foreach ($wholesale_general_data as $wholesale_general)
                <div class="col-md-4">
                    @if(file_exists(public_path('assets/wholesale_general/' . $wholesale_general->wholesale_general_image)))
                        <img src="{{ asset('assets/wholesale_general/' . $wholesale_general->wholesale_general_image) }}">
                    @else
                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                    @endif
                    @if (App::isLocale('en'))
                        <h4>{{ ucfirst($wholesale_general->title) }}</h4>
                        <p>{{ ucfirst($wholesale_general->description) }}</p>
                    @else
                        <h4>{{ ucfirst($wholesale_general->ar_title) }}</h4>
                        <p>{{ ucfirst($wholesale_general->ar_description) }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="next-bestseller">
    <div class="container">
        <div class="row">
            @foreach ($short_banner_data as $short_banner)
                <div class="col-md-6">
                    <div class="next-bestseller-box">
                        @if(file_exists(public_path('assets/short_banners/' . $short_banner->short_banners_image)))
                            <img src="{{ asset('assets/short_banners/' . $short_banner->short_banners_image) }}">
                        @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        @endif

                        @if (App::isLocale('en'))
                        <h3>{{ ucfirst($short_banner->title) }}</h3>
                        @else
                        <h3>{{ ucfirst($short_banner->ar_title) }}</h3>
                        @endif

                        <a href="#" class="btn tran-black-btn">@lang('frontend-messages.Wholesale.leftbutton')</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="why-use-tejarh">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang('frontend-messages.TejarhUse.heading')</h2>
            </div>
            @foreach ($general_data as $general)
                <div class="col-md-3">
                    @if(file_exists(public_path('assets/general_image/' . $general->general_image)))
                    <img src="{{ asset('assets/general_image/' . $general->general_image) }}">
                    @else
                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                    @endif

                    @if (App::isLocale('en'))
                        <h5>{{ ucfirst($general->title) }}</h5>
                        <p>{{ ucfirst($general->description) }}</p>
                    @else
                        <h5>{{ ucfirst($general->ar_title) }}</h5>
                        <p>{{ ucfirst($general->ar_description) }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="tejarh-app">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="tejarh-app-use">
                    <ul>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/Easy-payment-icon.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text1')</h5>
                        </li>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/Shipping-icon.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text2')</h5>
                        </li>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/OffersNegotiation.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text3')</h5>
                        </li>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/Promo-Code-icon.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text4')</h5>
                        </li>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/stories-icon.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text5')</h5>
                        </li>
                        <li>
                            <div class="tejarh-app-icon">
                                <img src="assets/images/chat-icon.png">
                            </div>
                            <h5>@lang('frontend-messages.AppText.text6')</h5>
                        </li>
                    </ul>
                </div>
                <div class="mo-application">
                    <h2>@lang('frontend-messages.AppText.heading')</h2>
                    <p>@lang('frontend-messages.AppText.content')</p>
                    <ul>
                        <li>
                            <a href="#"><img src="assets/images/google-play.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img src="assets/images/app-store.png"> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <img src="assets/images/tejarh-app-look.png">
            </div>
        </div>
    </div>
</div>

<div class="subscribe_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>@lang('frontend-messages.footer_top_bar_form_home.subscribe_title')</h3>
                <p>@lang('frontend-messages.footer_top_bar_form_home.subscribe_sub_text')</p>
            </div>
            <div class="col-md-6">
                <form  action="{{route("frontend.users.subscribe.subscribe")}}" id="subscribe_users" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="@lang('frontend-messages.footer_top_bar_form_home.email_address')" class="form-control">
                    </div>
                    <div class="submit">
                        <input type="submit" value="@lang('frontend-messages.footer_top_bar_form_home.submit')" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Uploading-Story" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="clearStoryForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserStory.title')</h5>
            <div id="ajax-alert-error" class="alert" style="display: none;"></div>
            <div id="ajax-alert" class="alert" style="display: none;"></div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="javascript:void(0)" id="user_story_form" name="user_story_form">
                <div class="input-group file-upload">
                    <div class="file-upload-div">
                        <input type='file' id="infileid" class="file" onchange="readURL10(this);" name="file" />
                        <img id="blah10" src="{{ asset('assets/images/Uploading-Story.png') }}" class="imageClear">
                        <video controls autoplay poster="{{ asset('assets/images/w3html5.gif') }}" id="video10"
                            style="display:none;"  class="vidoeClear"></video>
                    </div>
                    <label id="file-error" class="error" for="file"></label>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserStory.placeholder.productname')" class="form-control" name="product_name"
                        id="product_name">
                </div>

                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="category_id"
                        id="userstorycategory">
                        <option value="">@lang('frontend-messages.UserStory.placeholder.category')</option>
                            @foreach (App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="@lang('frontend-messages.UserStory.placeholder.description')" name="story_description" id="story_description"></textarea>
                </div>
                <div class="input-group">
                   <input type="text" class="form-control" name="story_price" id="story_price" value="{{$story_price}}" readonly>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserStory.placeholder.location')" class="form-control" name="store_location"
                        id="store_location">
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn loader_class">@lang('frontend-messages.UserStory.button')</button>
                </div>
            </form>
            {{-- <a href="javascript:void(0)" data-bs-dismiss="modal">@lang('frontend-messages.UserStory.cancel')</a> --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $("#subscribe_users").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "email":{
                required:true,
                email:true,
                // emailCheck:true,
            },
        },
        messages: {
            "email":{
                required: "@lang('frontend-messages.footer_top_bar_form_home.validation.email_is_required')",
                email: "@lang('frontend-messages.footer_top_bar_form_home.validation.valid_email')",
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
        }
    });

    $('#subscribe_users11').submit(function(event) {
        event.preventDefault();
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: 'post',
            url: '{{route("frontend.users.site.subscribe_tejarh")}}',
            data: $('#subscribe_users11').serialize(),
            dataType: 'json',
            success: function(data) {
                toastr.success(data.success);
            },
            error: function(data) {
            }
        });
    });
</script>
<script type="text/javascript">
    if ($("#user_story_form").length > 0) {
        $("#user_story_form").validate({
            ignore: [],
            rules: {
                "file": {
                    required: true,
                },
                "product_name": {
                    required: true,
                },
                "category_id": {
                    required: true,
                },
                "story_description": {
                    required: true,
                },
                "store_location": {
                    required: true,
                },
                select: {
                    required: true,
                }
            },
            messages: {
                select: {
                    required: "Value required"
                },
                "file": {
                    required: "@lang('frontend-messages.UserStory.validation.video_or_image')",
                },
                "product_name": {
                    required: "@lang('frontend-messages.UserStory.validation.productname')",
                },

                "category_id": {
                    required: "@lang('frontend-messages.UserStory.validation.please_select_the_category')",
                },

                "story_description": {
                    required: "@lang('frontend-messages.UserStory.validation.description')",
                },
                "store_location": {
                    required: "@lang('frontend-messages.UserStory.validation.storelocation')",
                },
            },
            errorPlacement: function(error, element) {
                if (element.is('select:hidden')) {
                    error.insertAfter(element.next('.nice-select'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var $this = $('#user_story_form .loader_class');
                var loadingText ='<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#user_story_form .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("user_story_form"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.users.site.add_user_story') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            $('#ajax-alert').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 3000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.UserStory.button")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                let id =  data.response.id
                                window.location.href = "{{ url('/user/story_payment') }}/" + id;
                            });
                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('@lang('frontend-messages.UserStory.error.msg')');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = '@lang('frontend-messages.UserStory.button')';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });

            }
        });
        $('#userstorycategory').on('change', function() {
            $(this).valid();
        })
    }
</script>
<script>
    function myFunction() {
        window.location.reload();
    }
</script>
<script>
$('#search_bar_filter').submit(function(event) {
        event.preventDefault();
        var token = "{{ csrf_token() }}";
        $.ajax({
            dataType: "html",
            type: 'get',
            url: '{{ route("frontend.users.site.home_search_bar") }}',
            data: $('#search_bar_filter').serialize(),
            success: function(response) {
                const ids = JSON.parse(response);
                window.location.href ="{{ url('search-items') }}/"+ids.id;
            },
            error: function(data) {
            }
        });
    });
</script>
<script src="{{ asset('fronted/slider_js/home_slider.js') }}"></script>

<style>
input#date_of_expiry.error {
    color: #000 !important;
}
</style>
@endsection
