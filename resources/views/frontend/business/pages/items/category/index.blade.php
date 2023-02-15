@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Product Category' }}
@endsection
@section('content')

    <div class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product-sidebar">
                        <div class="categories-wrapper">
                            <h5 class="line">@lang('business_messages.categories.categories')</h5>
                            <h6>@lang('business_messages.categories.all_categories')</h6>

                            <div class="categories_acc" id="categories_acc">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            @if (App::isLocale('en'))
                                                <span>{{ $cate_name->category_name }}</span>
                                            @else
                                                <span>{{ $cate_name->ar_category_name }}</span>
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach ($sub_categories as $key => $sub_cate)
                                                <div class="form-check">
                                                    <input class="form-check-input businessCateFilter" type="checkbox"
                                                        name="subCates[]" data-categoryId="{{ $sub_cate->category_id }}"
                                                        value="{{ $sub_cate->id }}" id="electronics_sub{{ $key }}">
                                                    <label class="form-check-label"
                                                        for="electronics_sub{{ $key }}">
                                                        @if (App::isLocale('en'))
                                                            <span>{{ $sub_cate->sub_cate_name }}</span>
                                                        @else
                                                            <span>{{ $sub_cate->ar_sub_cate_name }}</span>
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
                            <h5 class="line">@lang('business_messages.categories.condition')</h5>
                            <form class="condition_filter" enctype="multipart/form-data">
                                @foreach ($conditions as $key => $can)
                                    <div class="form-check">
                                        <input class="form-check-input conditionFilter1 businessCateFilter" name="condition[]"
                                            data-condition="{{ $can->name }}" type="checkbox" value="{{ $can->id }}"
                                            id="condition_{{ $key }}">
                                        <label class="form-check-label" for="condition_{{ $key }}">
                                            @if (App::isLocale('en'))
                                                <span>{{ $can->name }}</span>
                                            @else
                                                <span>{{ $can->ar_name }}</span>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="shop-by-price-wrapper m-30">
                            <h5 class="line">@lang('business_messages.categories.shop_by_price')</h5>
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
                                        <input type="range" class="range-min businessCateFilter" min="{{$minprice}}" max="{{$maxprice}}"
                                            value="0" step="100">
                                        <input type="range" class="range-max businessCateFilter" min="{{$minprice}}" max="{{$maxprice}}"
                                            value="{{$maxprice}}" step="100">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="brands-wrapper m-30">
                            <h5 class="line">@lang('business_messages.categories.brands')</h5>
                            <form class="brand_filter" enctype="multipart/form-data">
                                @foreach ($brands as $key => $brand)
                                    <div class="form-check">
                                        <input class="form-check-input brandFilter1 businessCateFilter" name="brands[]"
                                            data-brand="{{ $brand->name }}" type="checkbox" value="{{ $brand->id }}"
                                            id="brands{{ $key }}">
                                        <label class="form-check-label" for="brands{{ $key }}">
                                            @if (App::isLocale('en'))
                                                <span>{{ $brand->name }}</span>
                                            @else
                                              <span>{{ $brand->ar_name }}</span>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="location-wrapper m-30">
                            <h5 class="line">@lang('business_messages.categories.location')</h5>
                            <form class="location_filter" enctype="multipart/form-data" id="location_filter">
                                @foreach ($locations as $key => $city)
                                    <div class="form-check">
                                        <input class="form-check-input locationFilter1 businessCateFilter" name='city[]'
                                            data-location="{{ $city->name }}" type="checkbox"
                                            value="{{ $city->id }}" id="location{{ $key }}">
                                        <label class="form-check-label" for="location{{ $key }}">
                                            @if (App::isLocale('en'))
                                                <span>{{ $city->name }}</span>
                                            @else
                                              <span>{{ $city->ar_name }}</span>
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
                                        <label class="form-check-label starFiveSpace businessCateFilter" for="">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<input class="form-check-input businessCateFilter rating_star" id="start_ratting' . $i . '" name="attr_value" type="checkbox">';
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
                <div class="col-md-9" id="updateDiv">
                    <div class="products-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('frontend.business.home.index') }}"><i
                                                        class="fas fa-home"></i> @lang('business_messages.categories.categories')</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                @if (App::isLocale('en'))
                                                <span>{{  $cate_name->category_name }}</span>
                                                @else
                                                <span>{{  $cate_name->ar_category_name }}</span>
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
                                            <select class="form-select businessCateFilterPrice" id="featured_filter">
                                                {{-- <option value="featured">Featured</option> --}}
                                                <option value="asc"> <strong>Price:</strong> Low to High</option>
                                                <option value="desc"><strong>Price:</strong> High to Low</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="pagination-hidden-section">
                                    <input type='hidden' id='current_page' />
                                    <input type='hidden' id='show_per_page' />
                                </div>
                            </div>
                            <div class="products-wrapper" id="sortingData">
                                <div class="row" id="pagingBox">
                                    @if (Auth::check())
                                        @if (!empty($usedItemsArray) && count($usedItemsArray) > 0)
                                            @foreach ($usedItemsArray as $key => $item)
                                                <div class="col-md-4">
                                                    <div class="products-box">
                                                        @if ($item['condition']['name'] == NEW_ITEMS)
                                                        <div class="products-box-img">
                                                            <a href="{{ route('frontend.business.new-items.item_details', $item['id']) }}">
                                                                @if (!empty($item['boostItem']['item_id']))
                                                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                                                        <span class="featured">@lang('business_messages.categories.featured')</span>
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
                                                        @elseif($item['condition']['name'] == USED_ITEMS)
                                                        <div class="products-box-img">
                                                            <a href="{{ route('frontend.business.used-items.item_details', $item['id']) }}">
                                                                @if (!empty($item['boostItem']['item_id']))
                                                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                                                        <span class="featured">@lang('business_messages.categories.featured')</span>
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
                                                            <a href="{{ route('frontend.business.unused-items.item_details', $item['id']) }}">
                                                                @if (!empty($item['boostItem']['item_id']))
                                                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                                                        <span class="featured">@lang('business_messages.categories.featured')</span>
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
                                                                        <span class="featured">@lang('business_messages.categories.featured')</span>
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
                                                                    <a href="{{ route('frontend.business.new-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn new-btn">{{ $item['condition']['name'] }}</span>
                                                                @elseif($item['condition']['name'] == USED_ITEMS)
                                                                    <a href="{{ route('frontend.business.used-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn used-btn">{{ $item['condition']['name'] }}</span>
                                                                @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                                                    <a href="{{ route('frontend.business.unused-items.item_details', $item['id']) }}">
                                                                    <span class="used-btn unused-btn">{{ $item['condition']['name'] }}</span>
                                                                @else
                                                                    <span class="used-btn">{{ $item['condition']['name'] }}</span>
                                                                @endif
                                                                <h6><img
                                                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}">
                                                                    {{ $item['price'] }} {{ env('CURRENCY_TAG') }}</h6>
                                                                <p>{{ $item['brand']['name'] }}</p>

                                                                @if (!empty($item['store']['store_name']))
                                                                    <p>{{ $item['store']['store_location'] }}</p>
                                                                @else
                                                                    <p>{{ $item['city']['name'] }}</p>
                                                                @endif
                                                                <div class="review_count mb-3">
                                                                    <a href="{{route('frontend.business.product-reviews.reviews_details',$item['id'])}}">
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
                                                <h6>@lang('business_messages.categories.not_found')
                                                    @if (App::isLocale('en'))
                                                    <span>{{  $cate_name->category_name }}</span>
                                                    @else
                                                    <span>{{  $cate_name->ar_category_name }}</span>
                                                    @endif
                                                    @lang('business_messages.categories.products')
                                                </h6>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @if (!empty($usedItemsArray) && count($usedItemsArray) > 0)
                                <div class="pagination-wrapper">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination" id='page_navigation'></ul>
                                    </nav>
                                </div>
                            @endif
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
                        <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                        <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                        <ul>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('assets/images/google-play.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('assets/images/app-store.png') }}"> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
    <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
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

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var show_per_page = 12;
            var number_of_items = $('#pagingBox').children().length;
            var number_of_pages = Math.ceil(number_of_items / show_per_page);
            $('#current_page').val(0);
            $('#show_per_page').val(show_per_page);
            var navigation_html =
                '<li class="page-item"><a class="previous_link page-link" href="javascript:previous();"><</a></li>';
            var current_link = 0;
            while (number_of_pages > current_link) {
                navigation_html += '<a class="page_link page-link" href="javascript:go_to_page(' + current_link +
                    ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
                current_link++;
            }
            navigation_html +=
                '<li class="page-item"><a class="next_link page-link" href="javascript:next();">></a></li>';
            $('#page_navigation').html(navigation_html);
            $('#page_navigation .page_link:first').addClass('active_page');
            $('#pagingBox').children().css('display', 'none');
            $('#pagingBox').children().slice(0, show_per_page).css('display', 'block');
        });

        function previous() {
            new_page = parseInt($('#current_page').val()) - 1;
            if ($('.active_page').prev('.page_link').length == true) {
                go_to_page(new_page);
            }
        }

        function next() {
            new_page = parseInt($('#current_page').val()) + 1;
            if ($('.active_page').next('.page_link').length == true) {
                go_to_page(new_page);
            }
        }

        function go_to_page(page_num) {
            var show_per_page = parseInt($('#show_per_page').val());
            start_from = page_num * show_per_page;
            end_on = start_from + show_per_page;
            $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
            $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass(
                'active_page');
            $('#current_page').val(page_num);
        }
    </script>
@endsection
