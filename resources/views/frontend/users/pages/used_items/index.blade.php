@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User Used Items' }}
@endsection

@section('content')
    <div class="my-items-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.conditions.used_items')</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-7">
                    <div class="my-items-filter">
                        <h5>@lang('frontend-messages.conditions.used_items')</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <div class="products-wrapper">
                <div class="row" id="pagingBox">
                    @if (Auth::check())
                        @if (!empty($usedItemsArray) && count($usedItemsArray) > 0)
                            @foreach ($usedItemsArray as $key => $item)
                                <div class="col-md-3">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <a
                                                href="{{ route('frontend.users.used-items.item_details', ($item['id'])) }}">
                                                @if (!empty($item['boostItem']['item_id']))
                                                    @if ($item['id'] == $item['boostItem']['item_id'])
                                                        <span class="featured">@lang('frontend-messages.conditions.featured')</span>
                                                    @endif
                                                @endif
                                                @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                                    <img
                                                        src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                                @else
                                                    <img src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                                @endif
                                            </a>
                                            <a href="javascript:void(0)">
                                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart"
                                                    @if (isset($item['wishlist']['wishlist_status']) &&
                                                        !empty($item['wishlist']['wishlist_status']) &&
                                                        $item['wishlist']['wishlist_status']) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            @if ($item['condition']['name'] == NEW_ITEMS)
                                                <span class="used-btn new-btn">{{ $item['condition']['name'] }}</span>
                                            @elseif($item['condition']['name'] == USED_ITEMS)
                                                <span class="used-btn used-btn">{{ $item['condition']['name'] }}</span>
                                            @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                                <span class="used-btn unused-btn">{{ $item['condition']['name'] }}</span>
                                            @else
                                                <span class="used-btn">{{ $item['condition']['name'] }}</span>
                                            @endif
                                            <h6><img src="{{ asset(USERS_ASSETS_FOLDER . '/images/sar-tag.png') }}"> {{ $item['price'] }} {{env('CURRENCY_TAG')}}</h6>
                                            <p>{{ $item['brand']['name'] }}</p>

                                            @if (!empty($item['store']['store_name']))
                                                <p>{{ $item['store']['store_location'] }}</p>
                                            @else
                                                <p>{{ $item['city']['name'] }}</p>
                                            @endif

                                            <div class="products-box-footer" style="display:none">

                                                @if (isset($item['store']['store_logo_file']) && !empty($item['store']['store_logo_file']))
                                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $item['store']['store_logo_file']) }}"
                                                        width="32" height="32">
                                                @else
                                                    <img src="{{ asset(USERS_PROFILE_FOLDER . '/profile-pic.png') }}"
                                                        width="32" height="32">
                                                @endif
                                                @if (!empty($item['store']['store_name']))
                                                    <p>{{ $item['store']['store_name'] }}</p>
                                                @else
                                                    <p>Lorem text</p>
                                                @endif
                                                <i class='product-dots'></i>
                                            </div>
                                            <div class="products-box-footer">
                                                @if ($item['user']['role'] == USER_ROLE)
                                                      
                                                      @if (isset($item['user']['profile_picture']) && !empty($item['user']['profile_picture']))
                                                          <img src="{{ asset('assets/users/'.$item['user']['profile_picture']) }}" width="32" height="32">
                                                      @else
                                                          <img src="{{ asset('assets/images/user.png') }}"  width="32" height="32">
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='page_navigation'></ul>
                </nav>
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
                                <a target="_blank" href="https://www.google.com/"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .pagination a.page_link {
            margin: 0 7px;
        }

        .pagination a.page_link:hover {
            color: #0AD188 !important;
            border-color: #0AD188;
        }

        a.page_link.page-link {
            height: 46px;
            width: 46px;
            border-radius: 100% !important;
            font-size: 18px;
            color: #111419;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            border: 1px solid #E9E9E9;
            transition: all 0.5s ease 0s;
        }

        .active_page {
            color: #0AD188 !important;
            border-color: #0AD188 !important;
        }
    </style>
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
