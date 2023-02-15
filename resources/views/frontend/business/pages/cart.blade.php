@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business - Cart Item'}}
@endsection


@section('content')
<div class="delivery-order-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.cart.cart')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="column-labels">
                        <label class="product-image">@lang('business_messages.cart.image')</label>
                        <label class="product-details">@lang('business_messages.cart.product')</label>
                        <label class="product-price"> @lang('business_messages.cart.price')</label>
                        <label class="product-quantity"> @lang('business_messages.cart.quantity')</label>
                        <label class="product-line-price"> @lang('business_messages.cart.total')</label>
                    </div>

                    @if (!empty($itemArray) && count($itemArray) > 0)

                    @foreach ($itemArray as $item)
                    <div class="product">
                        <div class="product-image">
                            @if ($item['item_pictures']['item_picture1'])
                            <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item['item_pictures']['item_picture1']) }}">
                            @endif
                        </div>
                        <div class="product-details">
                            <div class="product-title">{{$item['what_are_you_selling']}}</div>
                            <p class="product-description">{{$item['describe_your_items']}}</p>
                        </div>
                        <div class="product-price">{{$item['price']}} {{env('CURRENCY_TAG')}}</div>
                        <div class="product-quantity">
                            <div id="qty_add_minus_section">
                                <button type="button" class="minus_qty" id="minus_qty">-</button>
                                <input type="number" name="qty_add_minus" class="qty_add_minus" id="qty_add_minus" data-item_id="{{$item['id']}}" data-user_id="{{$item['user_id']}}" value="1" min="1" max="10" />
                                <button type="button" class="add_qty" id="add_qty">+</button>
                            </div>
                        </div>

                        <input type="hidden" name="session_price1" class="session_price" value="{{$item['price']}}">
                        <div class="product-line-price"><span id="price_plus">{{ $item['price'] }}</span> {{env('CURRENCY_TAG')}}</div>
                    </div>

                    @endforeach
                    @else
                    <div class="order-place">
                        <p>@lang('business_messages.cart.no_items')</p>
                    </div>
                    @endif

                    <div class="totals">
                        <div class="totals-item">
                            <label> @lang('business_messages.cart.subtotal')</label>
                            <div class="totals-value" id="cart_subtotal">00.00 {{env('CURRENCY_TAG')}}</div>
                        </div>
                        <div class="totals-item">
                            <label> @lang('business_messages.cart.tax') (5%)</label>
                            <div class="totals-value" id="cart_tax">00.00 {{env('CURRENCY_TAG')}}</div>
                        </div>
                        <div class="totals-item">
                            <label> @lang('business_messages.cart.shipping')</label>
                            <div class="totals-value" id="cart_shipping">00.00 {{env('CURRENCY_TAG')}}</div>
                        </div>
                        <div class="totals-item totals-item-total">
                            <label> @lang('business_messages.cart.grand_total')</label>
                            <div class="totals-value" id="grand_total">{{ $item['price'] }} {{env('CURRENCY_TAG')}}</div>
                        </div>
                    </div>

                    <div class="product-box-btn">
                        <a href="{{ route('frontend.business.order-details.card_details',($itemId->id)) }}" class="btn">@lang('business_messages.cart.pay_now')</a>
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

<style>
    #removedItems {
        display: inline-block;
        cursor: pointer;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .minus_qty,
    .add_qty {
        background: #fff;
        border: 2px solid #0AD188;
    }

    label.product-image {
        float: left;
        width: 20%;
        text-align: center;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;
    }

    label.product-details {
        float: left;
        width: 37%;
        text-align: center;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;
    }

    label.product-price {
        float: left;
        width: 15%;
        text-align: center;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;
    }

    label.product-quantity {
        float: left;
        width: 10%;
        text-align: center;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;
    }

    label.product-removal {
        float: left;
        width: 9%;
        text-align: center;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;
    }

    label.product-line-price {
        float: left;
        width: 18%;
        text-align: right;
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
        color: #111419;

    }

    .product-image {
        float: left;
        width: 20%;
        text-align: center;
    }

    .product-details {
        float: left;
        width: 37%;
        text-align: center;
    }

    .product-price {
        float: left;
        width: 15%;
        text-align: center;
        font-size: 17px;
        line-height: 20px;
        font-weight: 500;
        color: #111419;
    }

    .product-quantity {
        float: left;
        width: 10%;
        text-align: center;
    }

    .product-removal {
        float: left;
        width: 9%;
        text-align: center;
    }

    .product-line-price {
        float: left;
        width: 18%;
        text-align: right;
        font-size: 18px;
        line-height: 26px;
        font-weight: 700;
        color: #111419;
    }

    .group:before,
    .shopping-cart:before,
    .column-labels:before,
    .product:before,
    .totals-item:before,
    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        content: '';
        display: table;
    }

    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        clear: both;
    }

    .group,
    .shopping-cart,
    .column-labels,
    .product,
    .totals-item {
        zoom: 1;
    }

    .product .product-price:before,
    .product .product-line-price:before,
    .totals-value:before {
        content: '';
    }

    .shopping-cart {
        margin: 0;
    }

    .column-labels label {
        padding-bottom: 15px;
        margin-bottom: 15px;
        color: #111419;
        border-bottom: 1px solid #eee;
    }

    /* .column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
      text-indent: -9999px;
    } */

    .product {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        float: left;
        width: 100%;
    }

    .product .product-image {
        text-align: center;
    }

    .product .product-image img {
        width: 100px;
    }

    .product .product-details .product-title {
        margin-right: 20px;
        font-size: 22px;
        line-height: 25px;
        font-weight: 700;
        color: #111419;
    }

    .product .product-details .product-description {
        margin: 5px 20px 5px 0;
        line-height: 1.4em;
    }

    .product .product-quantity input {
        width: 40px;
        text-align: center;
    }

    .product .remove-product {
        border: 0;
        padding: 4px 8px;
        background-color: #c66;
        color: #fff;
        font-size: 12px;
        border-radius: 3px;
    }

    .product .remove-product:hover {
        background-color: #a44;
    }

    .totals {
        width: 100%;
        float: left;
    }

    .totals .totals-item {
        float: right;
        clear: both;
        width: 30%;
        margin-bottom: 10px;
    }

    .totals .totals-item label {
        float: left;
        clear: both;
        width: 40%;
        text-align: right;
        font-size: 17px;
        line-height: 20px;
        font-weight: 400;
        color: #111419;
    }

    .totals .totals-item .totals-value {
        float: right;
        width: 60%;
        text-align: right;
        font-size: 20px;
        line-height: 23px;
        font-weight: 500;
        color: #111419;
    }

    .totals .totals-item-total {
        padding: 10px 0 0 0;
        border-top: 1px solid #ccc;
    }

    .product-box-btn {
        float: left;
        width: 100%;
        text-align: right;
        margin: 30px 0 0 0
    }

    .checkout {
        float: right;
        border: 0;
        margin-top: 20px;
        padding: 6px 25px;
        background-color: #6b6;
        color: #fff;
        font-size: 25px;
        border-radius: 3px;
    }

    .checkout:hover {
        background-color: #494;
    }

    @media screen and (max-width: 650px) {
        .shopping-cart {
            margin: 0;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .column-labels {
            display: none;
        }

        .product-image {
            float: right;
            width: auto;
        }

        .product-image img {
            margin: 0 0 10px 10px;
        }

        .product-details {
            float: none;
            margin-bottom: 10px;
            width: auto;
        }

        .product-price {
            clear: both;
            width: 70px;
        }

        .product-quantity {
            width: 100px;
        }

        .product-quantity input {
            margin-left: 20px;
        }

        .product-quantity:before {
            content: 'x';
        }

        .product-removal {
            width: auto;
        }

        .product-line-price {
            float: right;
            width: 70px;
        }
    }

    @media screen and (max-width: 350px) {
        .product-removal {
            float: right;
        }

        .product-line-price {
            float: right;
            clear: left;
            width: auto;
            margin-top: 10px;
        }

        .product .product-line-price:before {
            content: 'Item Total: $';
        }

        .totals .totals-item label {
            width: 60%;
        }

        .totals .totals-item .totals-value {
            width: 40%;
        }
    }

    .btn {
        /*background-color: ;
         display: none;
    padding: none;
    font-size: none;
    line-height: none;
    color: #fff;
    border-radius: none;
    transition:none; */
    }
</style>
@endsection
@section('script')


<script>
    $('#add_qty').click(function() {
        if ($(this).prev().val() < 10) {
            $(this).prev().val(+$(this).prev().val() + 1);
            let quantity = $('#qty_add_minus').val();
            let price = $('.session_price').val();
            let item_id = $('#qty_add_minus').attr("data-item_id");
            let user_id = $('.qty_add_minus').attr("data-user_id");
            let status_check = true;
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{route("frontend.users.order-details.qty_add_minus")}}',
                type: "POST",
                dataType: "json",
                data: {
                    'quantity': quantity,
                    'price': price,
                    'item_id': item_id,
                    'user_id': user_id,
                    'status_check': status_check,
                    _token: token
                },
                success: function(total_amount) {
                    document.getElementById("price_plus").innerHTML = total_amount['total_amount'];
                    document.getElementById("grand_total").innerHTML = total_amount['grand_total'];

                }
            });
        }
    });

    $('#minus_qty').click(function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) {
                $(this).next().val(+$(this).next().val() - 1);
                let quantity = $('#qty_add_minus').val();
                let price = $('.session_price').val();
                let item_id = $('#qty_add_minus').attr("data-item_id");
                let user_id = $('.qty_add_minus').attr("data-user_id");
                let status_check = false;
                var token = "{{csrf_token()}}";
                $.ajax({
                    url: '{{route("frontend.users.order-details.qty_add_minus")}}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'quantity': quantity,
                        'price': price,
                        'item_id': item_id,
                        'user_id': user_id,
                        'status_check': status_check,
                        _token: token
                    },
                    success: function(total_amount) {
                        document.getElementById("price_plus").innerHTML = total_amount['total_amount'];
                        document.getElementById("grand_total").innerHTML = total_amount['grand_total'];
                    }
                });
            }
        }
    });

    $('#removedItems').click(function() {

        let item_id = $('#qty_add_minus').attr("data-item_id");
        let user_id = $('.qty_add_minus').attr("data-user_id");
        let status_check = false;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: '{{route("frontend.users.order-details.removedItems")}}',
            type: "POST",
            dataType: "json",
            data: {
                'item_id': item_id,
                'user_id': user_id,
                'status_check': status_check,
                _token: token
            },
            success: function(data) {

            }
        });
    });
</script>
@endsection