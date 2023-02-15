<div class="products-wrapper">
    <div class="row" id="pagingBox">
        @if (Auth::check())
            @if (!empty($cateFilterArray) && count($cateFilterArray) > 0)
                @foreach ($cateFilterArray as $key => $item)
                @php    
                    $item_pictures = App\Models\ItemsImages::where('item_id', $item->id)->first();
                    $boostItem = App\Models\BoostItem::where('item_id',  $item->id)->where('is_paid', '1')->first();
                    $wishlist = App\Models\Wishlist::where('user_id', $item->user_id)->where('item_id', $item->id)->first();
                    $condition = App\Models\Condition::where('id', $item->condition_id)->first();
                    $brand = App\Models\Brand::where('id', $item->brand_id)->first();
                    $store = App\Models\Store::where('id', $item->store_id)->first();
                    $boostItem = App\Models\BoostItem::where('item_id', $item->id)->where('is_paid', '1')->first();
                    $user = App\Models\User::where('id', $item->user_id)->first();
                    $userCity = $user->city_id;
                    $city = App\Models\City::where('id', $userCity)->first();

                    $avg = App\Models\ReviewRatings::where('item_id', $item->id);
                    $totalReviewAvg = $avg->avg('rating_star');
                    $totalReviewAvg =  number_format($totalReviewAvg, 2);
                    $reviewRatingsCount = App\Models\ReviewRatings::where('item_id', $item->id)->count();
            

                @endphp
                    <div class="col-md-4">
                        <div class="products-box">
                            <div class="products-box-img">
                            @if ($condition->name == NEW_ITEMS)
                                <a href="{{ route('frontend.business.new-items.item_details', $item->id) }}">
                                    @if (!empty($boostItem->item_id))
                                        @if ($item->id == $boostItem->item_id)
                                            <span class="featured">@lang('business_messages.categories.featured')</span>
                                        @endif
                                    @endif
                                    @if (isset($item_pictures->item_picture1) && !empty($item_pictures->item_picture1))
                                        <img
                                            src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_pictures->item_picture1) }}">
                                    @else
                                        <img src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                    @endif
                                </a>
                            @elseif($condition->name == USED_ITEMS)
                            <a href="{{ route('frontend.business.used-items.item_details', $item->id) }}">
                                @if (!empty($boostItem->item_id))
                                    @if ($item->id == $boostItem->item_id)
                                        <span class="featured">@lang('business_messages.categories.featured')</span>
                                    @endif
                                @endif
                                @if (isset($item_pictures->item_picture1) && !empty($item_pictures->item_picture1))
                                    <img
                                        src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_pictures->item_picture1) }}">
                                @else
                                    <img src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                @endif
                            </a>
                            @elseif($condition->name == UNUSED_ITEMS)
                            <a href="{{ route('frontend.business.unused-items.item_details', $item->id) }}">
                                @if (!empty($boostItem->item_id))
                                    @if ($item->id == $boostItem->item_id)
                                        <span class="featured">@lang('business_messages.categories.featured')</span>
                                    @endif
                                @endif
                                @if (isset($item_pictures->item_picture1) && !empty($item_pictures->item_picture1))
                                    <img
                                        src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_pictures->item_picture1) }}">
                                @else
                                    <img src="{{ asset(USERS_PROFILE_FOLDER . '/user.png') }}">
                                @endif
                            </a>
                            @endif
                            <a href="javascript:void(0)">
                                <i data-id="{{ $item->id }}" class="bx bxs-heart"
                                    @if (isset($wishlist->wishlist_status) &&
                                        !empty($wishlist->wishlist_status) &&
                                        $wishlist->wishlist_status) ==1 att="0" style="color:red;" @else att="0" style="color:grey;" @endif></i>
                            </a>
                            </div>
                            <div class="products-box-content">
                                <a href="javascript:void(0)">
                                    @if ($condition->name == NEW_ITEMS)
                                        <a
                                            href="{{ route('frontend.business.new-items.item_details', $item->id) }}">
                                            <span class="used-btn new-btn">{{ $condition->name }}</span>
                                        @elseif($condition->name == USED_ITEMS)
                                            <a
                                                href="{{ route('frontend.business.used-items.item_details', $item->id) }}">
                                                <span class="used-btn used-btn">{{ $condition->name }}</span>
                                            @elseif($condition->name == UNUSED_ITEMS)
                                                <a
                                                    href="{{ route('frontend.business.unused-items.item_details', $item->id) }}">
                                                    <span
                                                        class="used-btn unused-btn">{{ $condition->name }}</span>
                                                @else
                                                    <span class="used-btn">{{ $condition->name }}</span>
                                    @endif
                                    <h6><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/sar-tag.png') }}">
                                        {{ $item->price }} {{ env('CURRENCY_TAG') }}</h6>
                                    <p>{{ $brand->name }}</p>
                                    
                                    @if (!empty($store->store_name))
                                        <p>{{ $store->store_location }}</p>
                                    @else
                                        <p>{{ $city->name }}</p>
                                    @endif
                                    
                                    <div class="review_count mb-3">
                                        <a href="{{route('frontend.business.product-reviews.reviews_details',$item->id)}}">
                                            <div class="cxeKyx">
                                                <div  color="#0AD188" class="kCxoGQ">
                                                    <span class="bFgxSY">{{$totalReviewAvg}}</span> 
                                                    <label><i class="fas fa-star ratings_color_set"></i></label>
                                                </div>
                                                <div class="jWgYGv">
                                                    <div underline-thickness="0.5px" class="hnUSvL">
                                                        <span>{{$reviewRatingsCount}} Ratings</span>
                                                        <div class="line_review_count"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="products-box-footer">
                                        @if ($user->role == USER_ROLE) 
                                            @if (isset($user->profile_picture) && !empty($user->profile_picture))
                                                <img src="{{ asset('assets/users/' . $user->profile_picture) }}"
                                                    width="32" height="32">
                                            @else
                                                <img src="{{ asset('assets/images/user.png') }}" width="32"
                                                    height="32">
                                            @endif
                                            
                                            @if (!empty($user->username))
                                                <p>{{ $user->username }}</p>
                                            @else
                                                <p>{{ $user->first_name }}</p>
                                            @endif
                                            @auth
                                                <i class='product-dots'></i>
                                            @else
                                                <i class="product-dots disable"></i>
                                            @endauth
                                        @else
                                            @if (isset($store->store_logo_file) && !empty($store->store_logo_file))
                                                <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $store->store_logo_file) }}"
                                                    width="32" height="32">
                                            @else
                                                <img src="{{ asset('assets/images/user.png') }}" width="32"
                                                    height="32">
                                            @endif
                                            @if (!empty($store->store_name))
                                                <p>{{ $store->store_name }}</p>
                                            @else
                                            
                                                <p>{{ $user->first_name }}</p>
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
                        <span>{{  $category_name->category_name }}</span>
                        @else
                        <span>{{  $category_name->ar_category_name }}</span>
                        @endif

                        @lang('business_messages.categories.products')</h6>
                </div>
            @endif
        @endif
    </div>
</div>
@if (!empty($cateFilterArray) && count($cateFilterArray) > 0)
    <div class="pagination-wrapper">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id='page_navigation'></ul>
        </nav>
    </div>
@endif
