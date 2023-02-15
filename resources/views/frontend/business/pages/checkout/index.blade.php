@extends('frontend.business.includes.web')
@section('pageTitle','Tejarh - Business Reviews')
@section('content')

<div class="delivery-order-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.cart.cart')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @if (!empty($checkCart) && count($checkCart) > 0)
            <div class="col-md-12">
                <div class="shopping-cart">
                    <table class="carttable">
                        <thead>
                            <tr>
                                <th>@lang('frontend-messages.cart.image')</th>
                                <th>@lang('frontend-messages.cart.product')</th>
                                <th>@lang('frontend-messages.cart.price')</th>
                                <th>@lang('frontend-messages.cart.quantity')</th>
                                <th>@lang('frontend-messages.cart.total')</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($itemArray) && count($itemArray) > 0)
                            @foreach ($itemArray as $item)
                            <tr>
                                <td class="cart-pimg">
                                    @if ($item['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$item['item_pictures']['item_picture1'])))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                    @endif
                                </td>
                                <td><span class="protitle">{{ $item['what_are_you_selling'] }}</span> <span class="prodes">{{$item['describe_your_items'] }}</span></td>
                                <td>{{ numberFormat($item['price']) }} {{ env('CURRENCY_TAG') }}</td>
                                <td>
                                    <div class="product-quantity">
                                        <div id="qty_add_minus_section">
                                            <button type="button" data-item_price="{{ $item['price'] }}" data-item_id="{{ $item['id'] }}" class="minus_qty" id="minus_qty" data-cart_id="{{ $item['cartlist']['id'] }}">-</button>
                                            <input type="number" name="qty_add_minus" class="qty_add_minus qty_{{ $item['id'] }}" data-cart_id="{{ $item['cartlist']['id'] }}" id="qty_add_minus" data-item_id="{{ $item['id'] }}" data-user_id="{{ $item['user_id'] }}" value="1" min="1" max="10" />
                                            <button type="button" data-item_price="{{ $item['price'] }}" data-cart_id="{{ $item['cartlist']['id'] }}" data-item_id="{{ $item['id'] }}" class="add_qty" id="add_qty">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><span class="grand-total-values" id="price_plus_{{ $item['id'] }}">{{ numberFormat($item['price']) }}</span>
                                        {{ env('CURRENCY_TAG') }}
                                    </div>
                                </td>
                                <td> <a href="{{ route('frontend.business.order-details.removed-item',$item['id']) }}" style="color:#F05454;"><i class="fas fa-trash"></i></a></td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>

                    </table>


                    <div class="order-detail-content">
                        <h6>@lang('business_messages.order-details.delivery_address')</h6>
                        <h6>{{ $userAddressDetail->name }}</h6>
                        <address>{{ $userAddressDetail->address }} , {{ $userAddressDetail->pincode }} , {{ $userAddressDetail->city }}</address>
                        <p>Address Type : {{ $userAddressDetail->address_type }}</p>
                        <p>@lang('business_messages.order-details.phone') :<a href="tel:{{ $userAddressDetail->phone_number }}">{{ $userAddressDetail->phone_number }}</a></p>
                    </div>
                    @if (!empty($itemArray) && count($itemArray) > 0)
                    <?php

                    if (json_encode($json['deliveryCompany'] ?? " ") == "[]") {
                    ?>
                        <div class="totals">
                            <div class="totals-item">
                                <p>Delivery Not Available</p>
                            </div>
                        </div>
                    <?php
                    } elseif (($json['success']) == "0") {
                    ?>
                        <div class="totals">
                            <div class="totals-item">
                                <p>Delivery Not Available</p>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="check_qty">
                            <div class="totals">
                                <!-- <div class="totals-item">
                                        <label> @lang('business_messages.cart.subtotal')</label>
                                        <div class="totals-value" id="cart_subtotal">00.00 {{ env('CURRENCY_TAG') }}</div>
                                    </div>
                                    <div class="totals-item">
                                        <label> @lang('business_messages.cart.tax') ({{ env('BUY_ITEMS_TEXT') }}%)</label>
                                        <div class="totals-value" id="cart_tax">00.00 {{ env('CURRENCY_TAG') }}</div>
                                    </div> -->

                                <div class="totals-item">
                                    <label> @lang('business_messages.cart.shipping')</label>
                                    <input type="hidden" id="sumPrice" name="sumPrice"  value="{{$sumPrice}}">
                                    <div class="totals-value" id="cart_shipping">{{ numberFormat($sumPrice) }} {{ env('CURRENCY_TAG') }}</div>
                                </div>
                                <div class="totals-item totals-item-total">
                                    <label> @lang('business_messages.cart.grand_total')</label>
                                    <?php
                                    $total_amount = $grand_total + $sumPrice;
                                    ?>
                                    <div class="totals-value" id="grand_total">{{ numberFormat($total_amount) }} {{ env('CURRENCY_TAG') }}
                                    </div>
                                </div>
                                <div class="product-box-btn">
                                    <!-- <a id="cardForm" href="javascript:void(0)" class="btn"
                                        style="width:27em">@lang('business_messages.cart.checkout')</a> -->
                                    <a href="{{ route('frontend.business.order-details.orderPaymentChoose',$checkOutUserId['id']) }}" class="btn" style="width:27em">@lang('business_messages.cart.checkout')</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    @endif
                </div>
            </div>
            @else
            <div class="breadcrumb-item" style="text-align:center;">
                <h5 class="" style="color:gray">No Items in cart</h5>
            </div>
            @endif
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
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/checkout_assets/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/checkout_style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/checkout_assets/normalize.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/checkout_assets/style.css') }}" />
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
<script>
    $(document).on('click', '.add_qty', function() {

        if ($(this).prev().val() < 10) {
            $(this).prev().val(+$(this).prev().val() + 1);
            let price = $(this).attr('data-item_price');
            let item_id = $(this).attr("data-item_id");
            let cart_id = $(this).attr("data-cart_id");
            let quantity = $('.qty_' + item_id).val();
            let user_id = $('.qty_add_minus').attr("data-user_id");

            let status_check = true;
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('frontend.business.order-details.qtyAddMinus') }}",
                type: "POST",
                dataType: "json",
                data: {
                    'quantity': quantity,
                    'price': price,
                    'item_id': item_id,
                    'user_id': user_id,
                    'cart_id': cart_id,
                    'status_check': status_check,
                    _token: token
                },
                success: function(total_amount) {
                    if (total_amount['in_stock'] == 0) {
                        $('.check_qty').hide();
                        alert('out of stock');
                    } else {
                        document.getElementById("price_plus_" + item_id).innerHTML = total_amount['total_amount'];

                        var sum = 0;
                        $('.grand-total-values').each(function() {
                            sum += parseFloat($(this).text());
                        });
                        let sumPrice = $("#sumPrice").val(); 
                        let amount_sum = parseInt(sum) + parseInt(sumPrice);
                        let sum1 = amount_sum.toFixed(2);
                        document.getElementById("grand_total").innerHTML = sum1 + " {{env('CURRENCY_TAG')}}";
                    }
                }
            });
        }
    });

    $('.minus_qty').click(function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) {
                $(this).next().val(+$(this).next().val() - 1);
                let price = $(this).attr('data-item_price');
                let item_id = $(this).attr("data-item_id");
                let cart_id = $(this).attr("data-cart_id");
                let quantity = $('.qty_' + item_id).val();
                let user_id = $('.qty_add_minus').attr("data-user_id");
                let status_check = false;
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: "{{ route('frontend.business.order-details.qtyAddMinus') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'quantity': quantity,
                        'price': price,
                        'item_id': item_id,
                        'cart_id': cart_id,
                        'user_id': user_id,
                        'status_check': status_check,
                        _token: token
                    },
                    success: function(total_amount) {
                        if (total_amount['in_stock'] == 1) {
                            $('.check_qty').show();
                            document.getElementById("price_plus_" + item_id).innerHTML = total_amount[
                                'total_amount'];

                            var sum = 0;
                            $('.grand-total-values').each(function() {
                                sum += parseFloat($(this).text());
                            });
                            let sumPrice = $("#sumPrice").val(); 
                            let amount_sum = parseInt(sum) + parseInt(sumPrice);
                            let sum1 = amount_sum.toFixed(2);
                            document.getElementById("grand_total").innerHTML = sum1 + " {{env('CURRENCY_TAG')}}";

                            // document.getElementById("grand_total").innerHTML = total_amount[
                            //     'grand_total'];
                        }
                    }
                });
            }
        }
    });
</script>
<script>
    var payButton = document.getElementById("pay-button");
    var form = document.getElementById("payment-form");

    Frames.init({
        {
            env('CHECKOUT_PUBLIC_KEY')
        }
    });

    Frames.addEventHandler(
        Frames.Events.CARD_VALIDATION_CHANGED,
        function(event) {
            console.log("CARD_VALIDATION_CHANGED: %o", event);

            payButton.disabled = !Frames.isCardValid();
        }
    );
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        Frames.submitCard()
            .then(function(data) {
                Frames.addCardToken(form, data.token);
                form.submit();
            })
            .catch(function(error) {});
    });
    Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);

    function onCardTokenized(event) {
        var csrf_token = "{{ csrf_token() }}";
        var payment_token = event.token;

        $.ajax({
            type: "get",
            url: "{{ route('frontend.business.order-details.order_placed') }}",
            data: {
                'token': payment_token,
                _csrf_token: csrf_token
            },
            dataType: 'json',
            success: function(data) {
                console.log(data.success);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
@endsection