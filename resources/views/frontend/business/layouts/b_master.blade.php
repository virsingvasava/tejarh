@section('pageTitle','Tejarh - Business Home')
@include('frontend.business.includes.head')

<body>
    <!-- Preloader -->
    <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="pre-load">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    @include('frontend.business.includes.header')
    <!-- end header -->
    @yield('content')

    <!--story-wrapper -->
    <div class="story-wrapper">
        <div class="container">
            <div class="add-story">
                <i class='bx bx-plus' data-bs-toggle="modal" @if (Auth::check() && Auth::user()->role == BUSINESS_ROLE) data-bs-target="#Uploading-Story" @else data-bs-target="#loginModal" @endif></i>
                <span>@lang('business_messages.story.my_story')</span>
            </div>
            <div class="story-slider-wrapper">
                <strong class="close-story-btn">+</strong>
                <div id="sync1" class="slider owl-carousel">
                    @foreach ($Story as $str1)
                    @if (count($str1) > 1)
                    <div class="multi-story-slider owl-carousel">
                        @foreach ($str1 as $strtest)
                        <div class="item">
                            <div class="story-slide-box">
                                <div class="story-slide-img">
                                    <h6>
                                        @if (isset($strtest['user']['profile_picture']) && !empty($strtest['user']['profile_picture']))
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtest['user']['profile_picture']) }}">
                                        @else
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                        @endif
                                        {{ $strtest['category']['category_name'] }}
                                        <i class='bx bx-info-circle'></i>
                                    </h6>
                                    @php
                                    $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extension == 'mp4')
                                    <video controls autoplay="true" src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                                    @else
                                    <img src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
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
                                <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $strtest['user']['profile_picture']) }}">
                                @else
                                <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}">
                                @endif
                                {{ $strtest['category']['category_name'] }}
                                <i class='bx bx-info-circle'></i>
                            </h6>
                            @php
                            $extension = pathinfo($strtest['video_or_image_file'], PATHINFO_EXTENSION);
                            @endphp
                            @if ($extension == 'mp4')
                            <video controls autoplay src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}"></video>
                            @else
                            <img src="{{ asset('assets/stories/' . $strtest['video_or_image_file']) }}">
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
                </div>
            </div>

            <div id="sync2" class="story-slider navigation-thumbs owl-carousel">
                @foreach ($LoginuserStory as $key => $otheruser)
                <div class="story-slider-box">
                    @if ($otheruser->user->role == 3)
                    <a class="u" href="#">
                        <div class="story-img">
                            @if (isset($otheruser->user->profile_picture) && !empty($otheruser->user->profile_picture))
                            <img src="{{ asset('assets/users/' . $otheruser->user->profile_picture) }}" alt="Shape">
                            @else
                            <img src="{{ asset('business/user_pictures/user.png') }}" alt="Shape">
                            @endif
                        </div>
                        <span>{{ $otheruser->user->first_name }}</span>
                    </a>
                    @else
                    <a class="b" href="#">
                        <div class="story-img">
                            @if (isset($otheruser->user->profile_picture) && !empty($otheruser->user->profile_picture))
                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $otheruser->user->profile_picture) }}" alt="Shape">
                            @else
                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/user.png') }}" alt="Shape">
                            @endif
                        </div>
                        <span>{{ $otheruser->user->first_name }}</span>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end story-wrapper -->

    <div class="hero-slider-wrapper">
        <div class="hero-slider owl-carousel">
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
    <!-- hero-slider-wrapper -->

    <div class="category-menu">
        <div class="container">
            <ul>
                @if(!empty($category) && count($category) > 0)
                @foreach($category as $key => $cat)
                @if($key < 7) <li>
                    <a @if(Auth::check()) href="{{ route('frontend.business.product_category.index', $cat->id)}}" @else href="javascript:void(0)" @endif>
                        @if($cat->cate_picture != '' && file_exists(public_path('img/category/'.$cat->cate_picture)))
                        <img src="{{asset('img/category/'.$cat->cate_picture)}}">
                        @else
                        <img src="{{asset('img/category/placeholder.svg')}}">
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
                    <li class="category-sub-menu-wrapper">
                        @if($AllCategoryCount > 7)
                        <a href=""><img src="{{asset('img/category/placeholder.svg')}}">More Categories</a>
                        @endif
                        <div class="category-sub-menu right">
                            <ul>
                                @if(!empty($categorySingle) && count($categorySingle) > 0)
                                @foreach($categorySingle as $key => $cat)
                                <li><a @if(Auth::check()) href="{{ route('frontend.business.product_category.index', $cat->id)}}" @else href="javascript:void(0)" @endif>
                                        @if (App::isLocale('en'))
                                        <span>{{ $cat->category_name }}</span>
                                        @else
                                        <span>{{ $cat->ar_category_name }}</span>
                                        @endif
                                    </a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
    <!-- category-menu -->

    <div class="products-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>@lang('business_messages.home.promoted_items')
                        @if (!empty($promoted_items_count) && $promoted_items_count > 16)
                        <a href="{{ route('frontend.business.promoted-items.index') }}">@lang('business_messages.home.view_more')</a>
                        @endif
                    </h4>
                </div>
                @if (!empty($itemArray) && count($itemArray) > 0)
                @foreach ($itemArray as $key => $value)
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">Featured</span>
                            @if (!empty($value['boostItem']['item_id']))
                            @if ($value['item']['id'] == $value['boostItem']['item_id'])
                            <span class="featured">Featured</span>
                            @endif
                            @endif
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.promoted-items.item_details', ($value['item']['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.promoted-items.item_details', ($value['item']['id'])) }}">
                                    @endif
                                    @if ($value['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture1'])))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $value['item']['id'] }}" class="bx bxs-heart" @if (isset($value['wishlist']['wishlist_status']) && !empty($value['wishlist']['wishlist_status']) && $value['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>

                        </div>
                        <div class="products-box-content">

                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.promoted-items.item_details', ($value['item']['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.promoted-items.item_details', ($value['item']['id'])) }}">
                                    @endif
                                    @if ($value['condition']['name'] == NEW_ITEMS)
                                    <span class="used-btn new-btn">{{ $value['condition']['name'] }}</span>

                                    @elseif($value['condition']['name'] == USED_ITEMS)
                                    <span class="used-btn used-btn">{{ $value['condition']['name'] }}</span>

                                    @elseif($value['condition']['name'] == UNUSED_ITEMS)
                                    <span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span>
                                    @else
                                    <span class="used-btn">{{ $value['condition']['name'] }}</span>
                                    @endif
                                    <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}"> {{ $value['item']['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                    <p>{{ $value['brand']['name'] }}</p>

                                    @if (!empty($value['store']['store_name']))
                                    <p>{{ $value['store']['store_location'] }}</p>
                                    @else
                                    <p>{{ $value['city']['name'] }}</p>
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.business.product-reviews.reviews_details',$value['id'])}}">
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
                                    <div class="products-box-footer">
                                        @if ($value['user']['role'] == USER_ROLE)
                                        @if (isset($value['user']['profile_picture']) && !empty($value['user']['profile_picture']))
                                        <img src="{{ asset('assets/users/'.$value['user']['profile_picture']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                    <h4>@lang('business_messages.home.new_items')
                        @if (!empty($newItemsList_count) && $newItemsList_count > 12)
                        <a href="{{ route('frontend.business.new-items.index') }}">@lang('business_messages.home.view_more')</a>
                        @endif
                    </h4>
                </div>
                @if (!empty($newItemsListArray) && count($newItemsListArray) > 0)
                @foreach ($newItemsListArray as $key => $newItems)
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <!-- <span class="featured">Featured</span> -->
                            @if (!empty($newItems['boostItem']['item_id']))
                            @if ($newItems['id'] == $newItems['boostItem']['item_id'])
                            <span class="featured">Featured</span>
                            @endif
                            @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <a href="{{ route('frontend.store.new-items.item_details', ($newItems['id'])) }}">
                                    @else
                                    <a href="{{ route('frontend.business.new-items.item_details', ($newItems['id'])) }}">
                                    @endif
                                    @if ($newItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$newItems['item_pictures']['item_picture1'])))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $newItems['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $newItems['id'] }}" class="bx bxs-heart" @if (isset($newItems['wishlist']['wishlist_status']) && !empty($newItems['wishlist']['wishlist_status']) && $newItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                        </div>
                        <div class="products-box-content">
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.new-items.item_details', ($newItems['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.new-items.item_details', ($newItems['id'])) }}">
                                    @endif

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
                                    <p>{{ $newItems['city']['name'] }}</p>
                                    @endif
                                    <div class="review_count mb-3">
                                        <a href="{{ route('frontend.business.product-reviews.reviews_details',$newItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div color="#0AD188" class="kCxoGQ">
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
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $newItems['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                    <h4> @lang('business_messages.home.used_items')
                        @if (!empty($usedItemsList_count) && $usedItemsList_count > 12)
                        <a href="{{ route('frontend.business.used-items.index') }}">@lang('business_messages.home.view_more')</a>
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
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.used-items.item_details', ($usedItems['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.used-items.item_details', ($usedItems['id'])) }}">
                                    @endif
                                    @if ($usedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$usedItems['item_pictures']['item_picture1'])))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $usedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $usedItems['id'] }}" class="bx bxs-heart" @if (isset($usedItems['wishlist']['wishlist_status']) && !empty($usedItems['wishlist']['wishlist_status']) && $usedItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                        </div>
                        <div class="products-box-content">
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.used-items.item_details', ($usedItems['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.used-items.item_details', ($usedItems['id'])) }}">
                                    @endif

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
                                        <a href="{{ route('frontend.business.product-reviews.reviews_details',$usedItems['id'])}}">
                                            <div class="cxeKyx">
                                                <div color="#0AD188" class="kCxoGQ">
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
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $usedItems['store']['store_logo_file']) }}" width="32" height="32">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                    <h4>@lang('business_messages.home.unused_items')
                        @if (!empty($unusedItemsList_count) && $unusedItemsList_count > 12)
                        <a href="{{ route('frontend.business.unused-items.index') }}">@lang('business_messages.home.view_more')</a>
                        @endif
                    </h4>
                </div>
                @if (!empty($unusedItemsListArray) && count($unusedItemsListArray) > 0)
                @foreach ($unusedItemsListArray as $key => $unusedItems)
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <!-- <span class="featured">Featured</span> -->
                            @if (!empty($unusedItems['boostItem']['item_id']))
                            @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                            <span class="featured">Featured</span>
                            @endif
                            @endif
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.unused-items.item_details', ($unusedItems['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">
                                    @endif
                                    @if ($unusedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$unusedItems['item_pictures']['item_picture1'])))
                                    <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </a>
                                <a href="javascript::void(0)" class="wish-list-icon">
                                    <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart" @if (isset($unusedItems['wishlist']['wishlist_status']) && !empty($unusedItems['wishlist']['wishlist_status']) && $unusedItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                </a>
                        </div>
                        <div class="products-box-content">
                            @if(Auth::user()->role == STORE_ROLE)
                            <a href="{{ route('frontend.store.unused-items.item_details', ($unusedItems['id'])) }}">
                                @else
                                <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">
                                    @endif
                                    <!-- <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}"> -->

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
                                            <a href="{{ route('frontend.business.product-reviews.reviews_details',$unusedItems['id'])}}">
                                                <div class="cxeKyx">
                                                    <div color="#0AD188" class="kCxoGQ">
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
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $unusedItems['store']['store_logo_file']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                    <h4>@lang('business_messages.home.top_deals') <a href="{{ route('frontend.business.top-deals-items.index') }}">@lang('business_messages.home.view_more')</a></h4>
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
                            <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">
                                @if ($unusedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$unusedItems['item_pictures']['item_picture1'])))
                                <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart" @if (isset($unusedItems['wishlist']['wishlist_status']) && !empty($unusedItems['wishlist']['wishlist_status']) && $unusedItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">

                                <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                <p>{{ $unusedItems['brand']['name'] }}</p>

                                @if (!empty($unusedItems['store']['store_name']))
                                <p>{{ $unusedItems['store']['store_location'] }}</p>
                                @else
                                <p>{{ $unusedItems['city']['name'] }}</p>
                                @endif
                                <div class="products-box-footer">
                                    @if (isset($unusedItems['store']['store_logo_file']) && !empty($unusedItems['store']['store_logo_file']))
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $unusedItems['store']['store_logo_file']) }}" width="32" height="32">
                                    @else
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/product-profile-img.png') }}" width="32" height="32">
                                    @endif
                                    @if (!empty($unusedItems['store']['store_name']))
                                    <p>{{ $unusedItems['store']['store_name'] }}</p>
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
            <div class="row" style="display:none">
                <div class="col-md-12">
                    <h4>@lang('business_messages.home.trending_items')<a href="{{ route('frontend.business.trending-items.index') }}">@lang('business_messages.home.view_more')</a>
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
                            <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">
                                @if ($unusedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$unusedItems['item_pictures']['item_picture1'])))
                                <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart" @if (isset($unusedItems['wishlist']['wishlist_status']) && !empty($unusedItems['wishlist']['wishlist_status']) && $unusedItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">

                                <span class="used-btn">{{ $unusedItems['condition']['name'] }}</span>
                                <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $unusedItems['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                <p>{{ $unusedItems['brand']['name'] }}</p>

                                @if (!empty($unusedItems['store']['store_name']))
                                <p>{{ $unusedItems['store']['store_location'] }}</p>
                                @else
                                <p>{{ $unusedItems['city']['name'] }}</p>
                                @endif
                                <div class="products-box-footer">
                                    @if (isset($unusedItems['store']['store_logo_file']) && !empty($unusedItems['store']['store_logo_file']))
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $unusedItems['store']['store_logo_file']) }}" width="32" height="32">
                                    @else
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/product-profile-img.png') }}" width="32" height="32">
                                    @endif
                                    @if (!empty($unusedItems['store']['store_name']))
                                    <p>{{ $unusedItems['store']['store_name'] }}</p>
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
            <div class="row">
                <div class="col-md-12">
                    <h4>@lang('business_messages.home.recommended_for_you')
                        @if (!empty($recommendedItemsList_count) && $recommendedItemsList_count > 12)
                        <a href="{{ route('frontend.business.recommended-items.index') }}">@lang('business_messages.home.view_more')</a>
                        @endif
                    </h4>
                </div>
                @if (!empty($recommendedItemsArray) && count($recommendedItemsArray) > 0)
                @foreach ($recommendedItemsArray as $key => $unusedItems)
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            @if (!empty($unusedItems['boostItem']['item_id']))
                            @if ($unusedItems['id'] == $unusedItems['boostItem']['item_id'])
                            <span class="featured">Featured</span>
                            @endif
                            @endif
                            <a href="javascript::void(0)">
                            @if ($unusedItems['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$unusedItems['item_pictures']['item_picture1'])))
                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $unusedItems['item_pictures']['item_picture1']) }}">
                            @else
                            <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                            @endif
                            </a>
                            <a href="javascript::void(0)" class="wish-list-icon">
                                <i data-id="{{ $unusedItems['id'] }}" class="bx bxs-heart" @if (isset($unusedItems['wishlist']['wishlist_status']) && !empty($unusedItems['wishlist']['wishlist_status']) && $unusedItems['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                        </div>
                        <div class="products-box-content">

                            @if ($unusedItems['condition']['name'] == NEW_ITEMS)
                            <a href="{{ route('frontend.business.new-items.item_details', ($unusedItems['id'])) }}">
                                <span class="used-btn new-btn">{{ $unusedItems['condition']['name'] }}</span>

                                @elseif($unusedItems['condition']['name'] == USED_ITEMS)
                                <a href="{{ route('frontend.business.used-items.item_details', ($unusedItems['id'])) }}">
                                    <span class="used-btn used-btn">{{ $unusedItems['condition']['name'] }}</span>

                                    @elseif($unusedItems['condition']['name'] == UNUSED_ITEMS)
                                    <a href="{{ route('frontend.business.unused-items.item_details', ($unusedItems['id'])) }}">
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
                                            <a href="{{route('frontend.business.product-reviews.reviews_details',$unusedItems['id'])}}">
                                                <div class="cxeKyx">
                                                    <div color="#0AD188" class="kCxoGQ">
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
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $unusedItems['store']['store_logo_file']) }}" width="32" height="32">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
        </div>
    </div>
    <!-- products-wrapper -->

    <div class="best-sellers">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>@lang('business_messages.home.tejarh_best_sellers')</h3>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="best-sellers-box">
                            <div class="best-sellers-img">
                                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/okta-logo.png') }}">
                            </div>
                            <h5>Okta Market<img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}"></h5>
                            <p>Member since January 2020</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="best-sellers-box">
                            <div class="best-sellers-img">
                                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/berol-logo.png') }}">
                            </div>
                            <h5>Berol<img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}">
                            </h5>
                            <p>Member since January 2020</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="best-sellers-box">
                            <div class="best-sellers-img">
                                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/oui-logo.png') }}">
                            </div>
                            <h5>Oui rock you<img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}"></h5>
                            <p>Member since January 2020</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="best-sellers-box">
                            <div class="best-sellers-img">
                                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/cherie-logo.png') }}">
                            </div>
                            <h5>Cherie<img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/best-seller.png') }}">
                            </h5>
                            <p>Member since January 2020</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- best-seller -->

    <div class="buy-wholesale">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('business_messages.wholesale_section.wholesale_title')</h2>
                </div>
                @foreach($wholesale_general_data as $wholesale_general)
                <div class="col-md-4">
                    @if(file_exists(public_path('assets/wholesale_general/' . $wholesale_general->wholesale_general_image)))
                    <img src="{{ asset('assets/wholesale_general/'.$wholesale_general->wholesale_general_image) }}">
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
    <!-- buy wholesale -->

    <div class="next-bestseller">
        <div class="container">
            <div class="row">
                @foreach($short_banner_data as $short_banner)
                <div class="col-md-6">
                    <div class="next-bestseller-box">
                        @if(file_exists(public_path('assets/short_banners/' . $short_banner->short_banners_image)))
                        <img src="{{ asset('assets/short_banners/'.$short_banner->short_banners_image) }}">
                        @else
                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        @endif
                        @if (App::isLocale('en'))
                            <h3>{{ ucfirst($short_banner->title) }}</h3>
                        @else
                            <h3>{{ ucfirst($short_banner->ar_title) }}</h3>
                        @endif
                        <a href="#" class="btn tran-black-btn">@lang('business_messages.shop_get_products_section.shop_products')</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- next-bestseller -->
    <div class="why-use-tejarh">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('business_messages.why_use_tejarh_section.why_use_tejarh_title')</h2>
                </div>
                @foreach($general_data as $general)
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
    <!-- WHY USE Tejarh? -->

    <div class="tejarh-app">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="tejarh-app-use">
                        <ul>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Easy-payment-icon.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.easy_payment')</h5>
                            </li>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Shipping-icon.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.shipping')</h5>
                            </li>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/OffersNegotiation.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.offers_negotiation')</h5>
                            </li>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Promo-Code-icon.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.promo_code')</h5>
                            </li>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/stories-icon.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.story')</h5>
                            </li>
                            <li>
                                <div class="tejarh-app-icon">
                                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/chat-icon.png') }}">
                                </div>
                                <h5>@lang('business_messages.menu.chat')</h5>
                            </li>
                        </ul>
                    </div>
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
                <div class="col-md-5">
                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/tejarh-app-look.png') }}">
                </div>
            </div>
        </div>
    </div>
    <!-- TEJARH APP -->

    <div class="subscribe_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>@lang('business_messages.footer_top_bar_form_home.subscribe_title')</h3>
                    <p>@lang('business_messages.footer_top_bar_form_home.subscribe_sub_text')</p>
                </div>
                <div class="col-md-6">
                    <form action="{{route("frontend.business.subscribe.subscribe")}}" id="subscribe_business_users" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" placeholder="Email Address" placeholder="@lang('business_messages.footer_top_bar_form_home.email_address')" class="form-control">
                        </div>
                        <div class="submit">
                            <input type="submit" value="@lang('business_messages.footer_top_bar_form_home.submit')" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/profille_slider/b_story_slider.js') }}"></script>

    <!-- Footer -->
    @include('frontend.business.includes.footer')
    <!-- End Footer -->