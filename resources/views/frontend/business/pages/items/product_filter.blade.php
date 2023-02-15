<div class="products-wrapper" id="sortingData">
    <div class="row">
        <div class="wishlist-table">
            @if (!empty($cateFilterArray) && count($cateFilterArray) > 0)
            <table id="pagingBox">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th class="img">Image</th>
                        <th class="name">Name</th>
                        <th class="price">Price</th>
                        <th class="condi">condition</th>
                        <th class="city">City</th>
                        <th class="qty">Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if (!empty($cateFilterArray) && count($cateFilterArray) > 0)
                <?php $i = 1; ?>
                @foreach ($cateFilterArray as $key => $item)
                @php
                $item_pictures = App\Models\ItemsImages::where('item_id', $item->id)->first();
                $condition = App\Models\Condition::where('id', $item->condition_id)->first();
                $brand = App\Models\Brand::where('id', $item->brand_id)->first();
                $store = App\Models\Store::where('id', $item->store_id)->first();
                $user = App\Models\User::where('id', $item->user_id)->first();
                $userCity = $user->city_id;
                $city = App\Models\City::where('id', $userCity)->first();
                $inventory = App\Models\Inventory::where('item_id', $item->id)->first();
                @endphp
                <tbody>
                    <tr>
                        <td>{{$i}}</td>
                        @if ($item_pictures->item_picture1 != "" && file_exists(public_path('assets/post/'.$item_pictures->item_picture1)))
                        <td class="img"><img width="60px" height="60px" src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_pictures->item_picture1) }}"></td>
                        @else
                        <td class="img"><img width="60px" height="60px" src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}"></td>
                        @endif
                        <td>{{ $brand->name }}</td>
                        <td>{{ $item->price }} {{env('CURRENCY_TAG')}}</td>
                        @if ($condition->name == NEW_ITEMS)
                        <td class="condi"><span class="used-btn new-btn">{{ $condition->name }}</span></td>
                        @elseif ($condition->name == USED_ITEMS)
                        <td class="condi"><span class="used-btn used-btn">{{ $condition->name }}</span></td>
                        @elseif ($condition->name == UNUSED_ITEMS)
                        <td class="condi"><span class="used-btn unused-btn">{{ $condition->name }}</span></td>
                        @endif
                        @if (!empty($store->store_name))
                        <td class="city">{{ $store->store_location }}</td>
                        @else
                        <td class="city">{{ $city->name }}</td>
                        @endif
                        <td>{{ $inventory->stock_remaining }}</td>
                        @if(Auth::user()->role == STORE_ROLE)
                        @if ($condition->name == NEW_ITEMS)
                        <td><a href="{{ route('frontend.store.new-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @elseif ($condition->name == USED_ITEMS)
                        <td><a href="{{ route('frontend.store.used-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @elseif ($condition->name == UNUSED_ITEMS)
                        <td><a href="{{ route('frontend.store.unused-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @endif
                        @else
                        @if ($condition->name == NEW_ITEMS)
                        <td><a href="{{ route('frontend.business.new-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @elseif ($condition->name == USED_ITEMS)
                        <td><a href="{{ route('frontend.business.used-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @elseif ($condition->name == UNUSED_ITEMS)
                        <td><a href="{{ route('frontend.business.unused-items.myproduct_details', ($item->id)) }}"><i class="fas fa-eye"></i></a></td>
                        @endif
                        @endif
                    </tr>
                </tbody>
                <?php $i++; ?>
                @endforeach
                @endif
            </table>
            @else
            <div class="text-center mt-5">
                <h6>@lang('frontend-messages.categories.not_found')</h6>
            </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<script>
    $(document).ready(function() {

        var show_per_page = 20;
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
        $('#pagingBox').children().slice(0, show_per_page).css('display', 'table');
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
        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'table');
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass(
            'active_page');
        $('#current_page').val(page_num);
    }
</script>
<style>
    #pagingBox tbody {
        width: 100%;
    }

    #pagingBox tbody td,
    #pagingBox thead td {
        text-align: center;
    }

    #pagingBox thead {
        display: table !important;
        width: 100%;
    }

    table #pagingBox td,
    table #pagingBox th {
        padding: 10px 8px;
        text-align: center;
    }

    #pagingBox tbody td:first-child,
    #pagingBox thead th:first-child {
        width: 7%;
        text-align: center;
    }

    #pagingBox tbody td:last-child,
    #pagingBox thead th:last-child {
        width: 9%;
        text-align: center;
    }

    #pagingBox tbody td.img,
    #pagingBox thead th.img {
        width: 17%;
        text-align: center;
    }

    #pagingBox tbody td.name,
    #pagingBox thead th.name {
        width: 18%;
        text-align: center;
    }

    #pagingBox tbody td.price,
    #pagingBox thead th.price {
        width: 9%;
        text-align: center;
    }

    #pagingBox tbody td.condi,
    #pagingBox thead th.condi {
        width: 11%;
        text-align: center;
    }

    #pagingBox tbody td.city,
    #pagingBox thead th.city {
        width: 20%;
        text-align: center;
    }

    #pagingBox tbody td.qty,
    #pagingBox thead th.qty {
        width: 9%;
        text-align: center;
    }
</style>