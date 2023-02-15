@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - Product Category' }}
@endsection

@section('content')

    <div class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product-sidebar">
                        <div class="categories-wrapper">
                            <h5 class="line">@lang('frontend-messages.categories.categories')</h5>
                            <h6>@lang('frontend-messages.categories.all_categories')</h6>
                            <div class="categories_acc" id="categories_acc">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            @if (App::isLocale('en'))
                                                {{ $cate_name->category_name }}
                                            @else
                                                {{ $cate_name->ar_category_name }}
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach ($sub_categories as $key => $sub_cate)
                                                <div class="form-check">
                                                    <input class="form-check-input userCateFilter" type="checkbox"
                                                        name="subCates[]" data-categoryId="{{ $sub_cate->category_id }}"
                                                        value="{{ $sub_cate->id }}" id="electronics_sub{{ $key }}">

                                                    <label class="form-check-label"
                                                        for="electronics_sub{{ $key }}">
                                                        @if (App::isLocale('en'))
                                                            {{ $sub_cate->sub_cate_name }}
                                                        @else
                                                            {{ $sub_cate->ar_sub_cate_name }}
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="condition-wrapper m-30">
                            <h5 class="line">@lang('frontend-messages.categories.condition')</h5>
                            <form class="condition_filter" enctype="multipart/form-data">
                                @foreach ($conditions as $key => $can)
                                    <div class="form-check">
                                        <input class="form-check-input userCateFilter" name="condition[]"
                                            data-condition="{{ $can->name }}" type="checkbox" value="{{ $can->id }}"
                                            id="condition_{{ $key }}">
                                        <label class="form-check-label" for="condition_{{ $key }}">
                                            @if (App::isLocale('en'))
                                                {{ $can->name }}
                                            @else
                                                @if (!empty($can->ar_name))
                                                    {{ $can->ar_name }}
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="shop-by-price-wrapper m-30">
                            <h5 class="line">@lang('frontend-messages.categories.shop_by_price')</h5>
                            <form class="prices_filter" enctype="multipart/form-data">
                                <div><span style="color:#0AD188">SAR</span><br></div>
                                <div class="form-checkd">
                                    <div class="price-input">
                                        <div class="field">
                                            <input type="text" class="input-min" value="0">
                                        </div>
                                        <div class="field max-field">
                                            <input type="text" class="input-max" value="{{$maxprice}}">
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min userCateFilter" min="{{$minprice}}" max="{{$maxprice}}"
                                            value="0" step="100">
                                        <input type="range" class="range-max userCateFilter" min="{{$minprice}}" max="{{$maxprice}}"
                                            value="{{$maxprice}}" step="100">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="brands-wrapper m-30">
                            <h5 class="line">@lang('frontend-messages.categories.brands')</h5>
                            <form class="brand_filter" enctype="multipart/form-data">
                                @foreach ($brands as $key => $brand)
                                    <div class="form-check">
                                        <input class="form-check-input brandFilter1 userCateFilter" name="brands[]"
                                            data-brand="{{ $brand->name }}" type="checkbox" value="{{ $brand->id }}"
                                            id="brands{{ $key }}">

                                        <label class="form-check-label" for="brands{{ $key }}">
                                            @if (App::isLocale('en'))
                                                {{ $brand->name }}
                                            @else
                                                @if (!empty($brand->ar_name))
                                                    {{ $can->ar_name }}
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="location-wrapper m-30">
                            <h5 class="line">@lang('frontend-messages.categories.location')</h5>
                            <form class="location_filter" enctype="multipart/form-data" id="location_filter">
                                @foreach ($locations as $key => $city)
                                    <div class="form-check">
                                        <input class="form-check-input locationFilter1 userCateFilter" name='city[]'
                                            data-location="{{ $city->name }}" type="checkbox"
                                            value="{{ $city->id }}" id="location{{ $key }}">
                                        <label class="form-check-label" for="location{{ $key }}">
                                            @if (App::isLocale('en'))
                                                {{ $city->name }}
                                            @else
                                                @if (!empty($city->ar_name))
                                                    {{ $city->ar_name }}
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="sellers-rating-wrapper">
                            <h5 class="line">@lang('business_messages.categories.sellers_rating')</h5>
                            <ul class="rating_lists mb_35">
                                <li>
                                    <div class="ratings">
                                        <label class="form-check-label starFiveSpace cateFilter" for="">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<input class="form-check-input cateFilter rating_star" id="start_ratting' . $i . '" name="attr_value" type="checkbox">';
                                                for ($j = 5; $j >= $i; $j--) {
                                                    echo '<label for="start_ratting' . $i . '"><i class="fas fa-star"></i></label>';
                                                }
                                                echo '<span id="start_ratting' . $i . '"><label for="start_ratting' . $i . '">& UP</label></span><br>';
                                            }
                                            ?>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="products-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('frontend.users.site.index') }}">
                                                    <i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                @if (App::isLocale('en'))
                                                    {{ $cate_name->category_name }}
                                                @else
                                                    {{ $cate_name->ar_category_name }}
                                                @endif
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-md-5">
                                    <form>
                                        <div class="input-group custom-select">
                                            <input type="hidden" name="cateIds" class="cateIds" id="cateIds"
                                                value="{{ $id }}">
                                            <label>@lang('business_messages.categories.sort_by')</label>
                                            <select class="form-select userCateFilterPrice" id="featured_filter">
                                                <option value="">---- Select ---</option>
                                                <option value="asc"> <strong>@lang('frontend-messages.post_item.price')</strong> @lang('frontend-messages.post_item.low_to_high')</option>
                                                <option value="desc"><strong>@lang('frontend-messages.post_item.price')</strong> @lang('frontend-messages.post_item.high_to_low')</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="products-wrapper" id="sortingData">
                                <div class="row" id="pagingBox">
                                        @if (!empty($usedItemsArray) && count($usedItemsArray) > 0)
                                            @foreach ($usedItemsArray as $key => $item)
                                                <div class="col-md-4">
                                                    <div class="products-box">
                                                        @if ($item['condition']['name'] == NEW_ITEMS)
                                                        <div class="products-box-img">
                                                            <a href="{{ route('frontend.users.new-items.item_details', $item['id']) }}">
                                                            @if (!empty($item['boostItem']['item_id']))
                                                                @if ($item['id'] == $item['boostItem']['item_id'])
                                                                    <span class="featured">@lang('frontend-messages.categories.featured')</span>
                                                                @endif
                                                            @endif
                                                            @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                                                <img
                                                                    src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                                            @endif
                                                            </a>
                                                            @if(Auth::check())
                                                            <a href="javascript:void(0)">
                                                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart"
                                                                    @if (isset($item['wishlist']['wishlist_status']) &&
                                                                        !empty($item['wishlist']['wishlist_status']) &&
                                                                        $item['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                                            </a>
                                                            @else
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bx bxs-heart"></i></a>
                                                            @endif
                                                        </div>
                                                        @elseif($item['condition']['name'] == USED_ITEMS)
                                                        <div class="products-box-img">
                                                            <a href="{{ route('frontend.users.used-items.item_details', $item['id']) }}">
                                                            @if (!empty($item['boostItem']['item_id']))
                                                                @if ($item['id'] == $item['boostItem']['item_id'])
                                                                    <span class="featured">@lang('frontend-messages.categories.featured')</span>
                                                                @endif
                                                            @endif
                                                            @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                                                <img
                                                                    src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                                            @endif
                                                            </a>
                                                            <a href="javascript:void(0)">
                                                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart"
                                                                    @if (isset($item['wishlist']['wishlist_status']) &&
                                                                        !empty($item['wishlist']['wishlist_status']) &&
                                                                        $item['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                                            </a>
                                                        </div>
                                                        @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                                        <div class="products-box-img">
                                                            <a href="{{ route('frontend.users.unused-items.item_details', $item['id']) }}">
                                                            @if (!empty($item['boostItem']['item_id']))
                                                                @if ($item['id'] == $item['boostItem']['item_id'])
                                                                    <span class="featured">@lang('frontend-messages.categories.featured')</span>
                                                                @endif
                                                            @endif
                                                            @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                                                <img
                                                                    src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                                            @endif
                                                            </a>
                                                            <a href="javascript:void(0)">
                                                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart"
                                                                    @if (isset($item['wishlist']['wishlist_status']) &&
                                                                        !empty($item['wishlist']['wishlist_status']) &&
                                                                        $item['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="products-box-img">
                                                            <a href="javascript:void(0)">
                                                            @if (!empty($item['boostItem']['item_id']))
                                                                @if ($item['id'] == $item['boostItem']['item_id'])
                                                                    <span class="featured">@lang('frontend-messages.categories.featured')</span>
                                                                @endif
                                                            @endif
                                                            @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                                                <img
                                                                    src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                                            @endif
                                                            </a>
                                                            <a href="javascript:void(0)">
                                                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart"
                                                                    @if (isset($item['wishlist']['wishlist_status']) &&
                                                                        !empty($item['wishlist']['wishlist_status']) &&
                                                                        $item['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                                            </a>
                                                        </div>
                                                        @endif
                                                        <div class="products-box-content">
                                                            <a href="javascript::void(0)">
                                                                @if ($item['condition']['name'] == NEW_ITEMS)
                                                                    <a href="{{ route('frontend.users.new-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn new-btn">{{ $item['condition']['name'] }}</span>
                                                                @elseif($item['condition']['name'] == USED_ITEMS)
                                                                    <a href="{{ route('frontend.users.used-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn used-btn">{{ $item['condition']['name'] }}</span>
                                                                @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                                                    <a href="{{ route('frontend.users.unused-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn unused-btn">{{ $item['condition']['name'] }}</span>
                                                                 @else
                                                                    <span class="used-btn">{{ $item['condition']['name'] }}</span>
                                                                @endif
                                                                <h6><img
                                                                        src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}">
                                                                    {{ $item['price'] }} {{ env('CURRENCY_TAG') }}</h6>
                                                                <p>{{ $item['brand']['name'] }}</p>

                                                                @if (!empty($item['store']['store_name']))
                                                                    <p>{{ $item['store']['store_location'] }}</p>
                                                                @else
                                                                    <p>{{ $item['city']['name'] }}</p>
                                                                @endif

                                                                <div class="review_count mb-3">
                                                                    <a href="{{route('frontend.users.product-reviews.reviews_details',$item['id'])}}">
                                                                        <div class="cxeKyx">
                                                                            <div  color="#0AD188" class="kCxoGQ">
                                                                                <span class="bFgxSY">{{$item['totalReviewAvg']}}</span> 
                                                                                <label><i class="fas fa-star ratings_color_set"></i></label>
                                                                            </div>
                                                                            <div class="jWgYGv">
                                                                                <div underline-thickness="0.5px" class="hnUSvL">
                                                                                    <span>{{$item['reviewRatings']}} Ratings</span>
                                                                                    <div class="line_review_count"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="products-box-footer">
                                                                    @if ($item['user']['role'] == USER_ROLE)
                                                                        @if (isset($item['user']['profile_picture']) && !empty($item['user']['profile_picture']))
                                                                            <img src="{{ asset('assets/users/' . $item['user']['profile_picture']) }}"
                                                                                width="32" height="32">
                                                                        @else
                                                                            <img src="{{ asset('assets/images/user.png') }}"
                                                                                width="32" height="32">
                                                                        @endif
                                                                        @if (!empty($item['user']['username']))
                                                                            <p>{{ $item['user']['username'] }}</p>
                                                                        @else
                                                                            <p>{{ $item['user']['first_name'] }}</p>
                                                                        @endif
                                                                        @auth
                                                                            <i class='product-dots'></i>
                                                                        @else
                                                                            <i class="product-dots disable"></i>
                                                                        @endauth
                                                                    @else
                                                                        @if (isset($item['store']['store_logo_file']) && !empty($item['store']['store_logo_file']))
                                                                            <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $item['store']['store_logo_file']) }}"
                                                                                width="32" height="32">
                                                                        @else
                                                                            <img src="{{ asset('assets/images/user.png') }}"
                                                                                width="32" height="32">
                                                                        @endif
                                                                        @if (!empty($item['store']['store_name']))
                                                                            <p>{{ $item['store']['store_name'] }}</p>
                                                                        @else
                                                                            <p>{{ $item['user']['first_name'] }}</p>
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
                                            <div class="text-center mt-5">
                                                <h6>@lang('frontend-messages.categories.not_found') 
                                                    @if (App::isLocale('en'))
                                                    {{ $cate_name->category_name }}
                                                    @else
                                                        {{ $cate_name->ar_category_name }}
                                                    @endif
                                                     @lang('frontend-messages.categories.products')
                                                </h6>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="try-tejarg-app-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('assets/images/try-tejarg-app.png') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                        <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                        <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                        <ul>
                            <li>
                                <a href="#"><img src="{{ asset('assets/images/google-play.png') }}"> </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('assets/images/app-store.png') }}"> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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

    <link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
    <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>

@endsection

@section('script')

    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
    <link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/pagination.css') }}">
    <script src="{{ asset('fronted/slider_js/pagination.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.userCateFilter').click(function() {

                let cateIds = $('.userCateFilter').attr("data-categoryid");

                var subCateIds = [];
                $('input:checkbox[name="subCates[]"]').each(function() {
                    if (this.checked) {
                        subCateIds.push(this.value);
                    }
                });

                var conditions = [];
                $('input:checkbox[name="condition[]"]').each(function() {
                    if (this.checked) {
                        conditions.push(this.value);
                    }
                });

                var brands = [];
                $('input:checkbox[name="brands[]"]').each(function() {
                    if (this.checked) {
                        brands.push(this.value);
                    }
                });

                var cities = [];
                $('input:checkbox[name="city[]"]').each(function() {
                    if (this.checked) {
                        cities.push(this.value);
                    }
                });

                var sellerRatings = [];
                $('input:checkbox[name="attr_value"]').each(function() {
                    if (this.checked) {
                        sellerRatings.push(this.value);
                    }
                });

                let minPrice = parseInt(rangeInput[0].value),
                    maxPrice = parseInt(rangeInput[1].value);

                var sorting_data = $('.cateFilterPrice').find(":selected").val();
                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{ route('frontend.users.product_category.userSubCateFilter') }}",
                    data: {
                        'cateIds': cateIds,
                        'subCateIds': subCateIds,
                        'conditions': conditions,
                        'minPrice': minPrice,
                        'maxPrice': maxPrice,
                        'brands': brands,
                        'cities': cities,
                        'seller_ratings': sellerRatings,
                        'sorting_data': sorting_data,
                        _token: token
                    },
                    success: function(data) {
                        if (data) {
                            $('#sortingData').html(data);
                        } else {
                            location.reload();
                        }
                    },
                    timeout: 10000
                });
            });

            $(".userCateFilterPrice").on("change", function() {

                var sorting_data = $('.userCateFilterPrice').find(":selected").val();
                var cateIds = $("input[name='cateIds']").val();

                var subCateIds = [];
                $('input:checkbox[name="subCates[]"]').each(function() {
                    if (this.checked) {
                        subCateIds.push(this.value);
                    }
                });

                var conditions = [];
                $('input:checkbox[name="condition[]"]').each(function() {
                    if (this.checked) {
                        conditions.push(this.value);
                    }
                });

                var brands = [];
                $('input:checkbox[name="brands[]"]').each(function() {
                    if (this.checked) {
                        brands.push(this.value);
                    }
                });

                var cities = [];
                $('input:checkbox[name="city[]"]').each(function() {
                    if (this.checked) {
                        cities.push(this.value);
                    }
                });

                var sellerRatings = [];
                $('input:checkbox[name="attr_value"]').each(function() {
                    if (this.checked) {
                        sellerRatings.push(this.value);
                    }
                });

                let minPrice = parseInt(rangeInput[0].value),
                    maxPrice = parseInt(rangeInput[1].value);

                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{ route('frontend.users.product_category.userSubCateFilter') }}",
                    data: {
                        'sorting_data': sorting_data,
                        'cateIds': cateIds,
                        'subCateIds': subCateIds,
                        'conditions': conditions,
                        'minPrice': minPrice,
                        'maxPrice': maxPrice,
                        'brands': brands,
                        'cities': cities,
                        'seller_ratings':sellerRatings,
                        _token: token
                    },
                    success: function(data) {
                        if (data) {
                            $('#sortingData').html(data);

                        } else {
                            location.reload();
                        }
                    },
                    timeout: 10000
                });
            });
        });
    </script>
@endsection
