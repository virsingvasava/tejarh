@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Order Management'}}
@endsection

@section('content')
@php
$years = request()->query('years');
$yearsArr = explode(',', $years);

@endphp
<div class="my-orders-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders Management</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 justify-content-end d-flex">
                    <a href="{{ route('frontend.business.orders-sold.return_order') }}" class="btn return-order-list">Return Order List</a>
                </div>
            </div>

            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            @if(!empty($itemArray) && count($itemArray) > 0)
            <div class="col-md-3">
                <div class="my-orders-filter">
                    <h5 class="line">@lang('business_messages.order.filters')</h5>

                    <!-- <div class="my-orders-filter-box">
                            <h6>@lang('business_messages.order.order_status')</h6>
                            <div class="form-check">
                                <input class="form-check-input order_status" type="checkbox"
                                    value="">
                                <label class="form-check-label" for="electronics_sub1">
                                        Order Placed
                                </label>
                            </div>
                        </div> -->
                    <div class="my-orders-filter-box">
                        <h6> @lang('business_messages.order.order_time')</h6>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input last_30_DaysOrderFilter" name="last_30_days[]" type="checkbox" value="last_30_days" id="last_30_days">
                                <label class="form-check-label" for="last_30_days">
                                    Last 30 days
                                </label>
                            </div>
                            @php
                            $startYear = date('Y');
                            $endYear = date('Y') - env('HOW_MANY_YEARS_SHOW_ORDERS');
                            @endphp
                            @for ($filterYear = $startYear; $filterYear > $endYear; $filterYear--)
                            <div class="form-check">
                                <input class="form-check-input orderFilter" name="filterYear[]" data-condition="{{ $filterYear }}" type="checkbox" value="{{ $filterYear }}" id="condition_{{ $filterYear }}" {{ in_array($filterYear, $yearsArr) ? 'checked' : '' }}>
                                <label class="form-check-label" for="condition_{{ $filterYear }}">
                                    {{ $filterYear }}
                                </label>
                            </div>
                            @endfor
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9" id="myOrders">
                <div class="my-orders-products" id="pagingBox">
                    @if (!empty($itemArray) && count($itemArray) > 0)
                    @foreach ($itemArray as $key => $value)
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
                            <div class="inner-product-box">
                                <div class="product-box-btn">
                                    <a id="CreateShipping" data-order_id="{{  $value['id'] }}" data-delivery_option_id="{{ $value['shippingDetails']['deliveryOptionId'] }}" data-item_id="{{ $value['shippingDetails']['item_id'] }}" data-shipping_id="{{ $value['shippingDetails']['id'] }}" data-customer_user_id="{{$value['shippingDetails']['customer_id']}}" data-user_id="{{$value['shippingDetails']['user_id']}}" class="btn cancel_orders_redirect create_shipping">Create Shippment</a>
                                </div>

                            </div>
                        </div>
                        <div class="estimated-delivery">
                            <p>@lang('business_messages.order.estimated_delivery') <strong>{{ $create_date }}</strong>
                                @if($value['order_status'] == ORDER_CANCELED)
                                @else
                                <a href="{{ route('frontend.users.my-orders.track_orders', ($value['id'])) }}">Track Order</a>
                            </p>
                            @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="breadcrumb-item" style="text-align:center;">
                        <h5 class="" style="color:gray">Not Orders Found</h5>
                    </div>
                    @endif
                </div>
            </div>
            @if (!empty($itemArray) && count($itemArray) > 10)
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='page_navigation'></ul>
                </nav>
            </div>
            @endif
            @else
            <div class="breadcrumb-item" style="text-align:center;">
                <h5 class="" style="color:gray">Not Orders Found</h5>
            </div>
            @endif
        </div>

    </div>
</div>

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/checkout_assets/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.create_shipping').click(function() {

            let item_id = $(this).attr("data-item_id");
            let user_id = $(this).attr("data-user_id");
            let customer_user_id = $(this).attr("data-customer_user_id");
            let shipping_id = $(this).attr("data-shipping_id");
            let delivery_option_id = $(this).attr("data-delivery_option_id");
            let order_id = $(this).attr("data-order_id");
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{route("frontend.business.orders-sold.create_shipping")}}',
                type: "POST",
                dataType: "json",
                data: {
                    'item_id': item_id,
                    'user_id': user_id,
                    'customer_user_id': customer_user_id,
                    'shipping_id': shipping_id,
                    'delivery_option_id': delivery_option_id,
                    'order_id': order_id,
                    _token: token
                },
                success: function(data) {
                    console.log(data.message);
                }
            });
        });
    });

    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @endif
    });
</script>
<script>
    $('.orderFilter').click(function() {
        var orderFilter = [];
        $('input:checkbox[name="filterYear[]"]').each(function() {
            if (this.checked) {
                orderFilter.push(this.value);
            }
        });

        var last_30_days = $("input[name='last_30_days']").val();

        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{ route("frontend.business.orders-sold.orderFilter") }}',
            data: {
                'last_30_days_orders': last_30_days,
                'orderFilter': orderFilter,
                _token: token
            },
            success: function(data) {
                if (data) {
                    $('#myOrders').html(data);
                } else {
                    location.reload();
                }
            },
            timeout: 10000
        });
    });
</script>
<script>
    $('.last_30_DaysOrderFilter').click(function() {
        var last_30_days = [];
        $('input:checkbox[name="last_30_days[]"]').each(function() {
            if (this.checked) {
                last_30_days.push(this.value);
            }
        });
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{ route("frontend.business.orders-sold.last_30_DaysOrderFilter") }}',
            data: {
                'last_30_days_orders': last_30_days,
                _token: token
            },
            success: function(data) {
                if (data) {
                    $('#myOrders').html(data);
                } else {
                    location.reload();
                }
            },
            timeout: 10000
        });
    });
</script>
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
@endsection