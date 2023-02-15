<div class="my-orders-products" id="pagingBox">
    @if (!empty($arrayFilter) && count($arrayFilter) > 0)
        @foreach ($arrayFilter as $key => $value)
            <div class="my-orders-products-box">
                <div class="order-place">
                    <ul>
                        <li>
                            @php
                                $create_date = date('d M Y', strtotime($value['created_at']));
                            @endphp
                            @if($value['order_status'] == 5)
                            <h6>Order Return</h6>
                            @else
                            <h6>@lang('business_messages.order.order_placed')</h6>
                            @endif
                            <p>{{ $create_date }}</p>
                        </li>
                        <li>
                            <p>@lang('business_messages.order.order') #{{ $value['id'] }}</p>
                            <!-- @if($value['order_status'] == ORDER_CANCELED)
                            @else
                            <p><a href="{{ route('frontend.users.order-details.order_details', base64_encode($value['id'])) }}">
                                    @lang('business_messages.order.order_details')</a></p>
                            @endif -->
                        </li>
                    </ul>
                </div>
                <div class="product-box">
                    <div class="product-box-content">
                        <div class="product-box-content-text">
                            @if($value['order_status'] == 3)
                            <h6 class="order-cancle">Order Cancelled</h6>
                            @elseif($value['order_status'] == 4)
                            <h6 class="order-deliver">Order Delivered</h6>
                            @elseif($value['order_status'] == 5)
                            <h6 class="order-cancle">Order Return</h6>
                            @else
                            <h6 class="order-confirm">Order Placed</h6>
                            @endif
                            <h6>@lang('business_messages.order.total') : {{ $value['grand_total'] }} {{ env('CURRENCY_TAG') }} </h6>
                            @if($value['order_status'] != 5)
                            <h6>@lang('business_messages.order.ship_to') : {{ $value['userAddress']['address'] }} ,{{ $value['userAddress']['pincode'] }} , {{ $value['userAddress']['city'] }} </h6>
                            @else
                            <h6>Ship From : {{ $value['userAddressReturn']['address'] }} ,{{ $value['userAddressReturn']['pincode'] }} , {{ $value['userAddressReturn']['city'] }} </h6>
                            @endif
                        </div>
                    </div>
                    <div class="product-box-btn orderFilter">
                    <a id="CreateShipping" data-order_id="{{ $value['id'] }}" data-delivery_option_id="{{ $value['shippingDetails']['deliveryOptionId'] }}" data-item_id="{{ $value['shippingDetails']['item_id'] }}"  data-shipping_id="{{ $value['shippingDetails']['id'] }}" data-customer_user_id="{{$value['shippingDetails']['customer_id']}}"  data-user_id="{{$value['shippingDetails']['user_id']}}" class="btn cancel_orders_redirect create_shipping">Create Shippment</a>

                    </div>
                </div>
                <div class="estimated-delivery">
                    <p>@lang('business_messages.order.estimated_delivery') <strong>{{ $create_date }}</strong>
                    @if($value['order_status'] == ORDER_CANCELED)
                    @else
                    <a href="{{ route('frontend.users.my-orders.track_orders', ($value['id'])) }}">Track Order</a></p>
                    @endif
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <div class="order-place">
            <p>No Orders..</p>
        </div>
    @endif
</div>
<script>
    $(document).ready(function() {

        var show_per_page = 10;
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
