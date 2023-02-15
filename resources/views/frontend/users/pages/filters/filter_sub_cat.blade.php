<div class="products-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $cate_name->category_name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-5" style="display:none">
                <form>
                    <div class="input-group custom-select">
                        <label>@lang('frontend-messages.categories.sort_by')</label>
                        <select class="form-select">
                            <option selected>@lang('frontend-messages.categories.date_published')</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
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
        <div class="products-wrapper">
            <div class="row" id="pagingBox">
                @if (Auth::check())
                @if (!empty($usedItemsArray1) && count($usedItemsArray1) > 0)
                @foreach ($usedItemsArray1 as $key => $item)
                <div class="col-md-4">
                    <div class="products-box">
                        <div class="products-box-img">
                            <!-- <a href="{{ route('frontend.users.boost-items.item_details', base64_encode($item['id'])) }}"> -->
                                @if (!empty($item['boostItem']['item_id']))
                                @if ($item['id'] == $item['boostItem']['item_id'])
                                <span class="featured">@lang('frontend-messages.categories.featured')</span>
                                @endif
                                @endif
                                @if (isset($item['item_pictures']['item_picture1']) && !empty($item['item_pictures']['item_picture1']))
                                <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                @else
                                <img src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                @endif
                            </a>
                            <a href="javascript:void(0)">
                                <i data-id="{{ $item['id'] }}" class="bx bxs-heart" @if (isset($item['wishlist']['wishlist_status']) && !empty($item['wishlist']['wishlist_status']) && $item['wishlist']['wishlist_status'])==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a  href="javascript::void(0)">
                                @if ($item['condition']['name'] == NEW_ITEMS)
                                <a href="{{ route('frontend.users.new-items.item_details', ($item['id'])) }}">
                                <span class="used-btn new-btn">{{ $item['condition']['name'] }}</span>
                                @elseif($item['condition']['name'] == USED_ITEMS)
                                <a href="{{ route('frontend.users.used-items.item_details', ($item['id'])) }}">
                                <span class="used-btn used-btn">{{ $item['condition']['name'] }}</span>
                                @elseif($item['condition']['name'] == UNUSED_ITEMS)
                                <a href="{{ route('frontend.users.unused-items.item_details', ($item['id'])) }}">
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
                                <div class="products-box-footer">
                                    @if ($item['user']['role'] == USER_ROLE)

                                    @if (isset($item['user']['profile_picture']) && !empty($item['user']['profile_picture']))
                                    <img src="{{ asset('assets/users/'.$item['user']['profile_picture']) }}" width="32" height="32">
                                    @else
                                    <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $item['store']['store_logo_file']) }}" width="32" height="32">
                                    @else
                                    <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
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
                <h6>@lang('frontend-messages.categories.not_found') {{$cate_name->category_name}} @lang('frontend-messages.categories.products')</h6>
                </div>
                @endif
                @endif
            </div>
        </div>
        @if (!empty($usedItemsArray1) && count($usedItemsArray1) > 0)
        <div class="pagination-wrapper">
            <nav aria-label="Page navigation example">
                <ul class="pagination" id='page_navigation'></ul>
            </nav>
        </div>
        @endif
    </div>
</div>