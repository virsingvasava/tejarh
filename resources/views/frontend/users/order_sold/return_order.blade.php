@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Return Order' }}
@endsection

@section('content')

<div class="wishlist-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Return Order's</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12" id="pagingBox">
                <div class="wishlist_deleted_message"></div>
                <div class="wishlist-table return-order-table">
                    <table>
                        <tr>
                            <th>@lang('business_messages.wishlist.products')</th>
                            <th>Return By</th>
                            <th>@lang('business_messages.wishlist.price')</th>
                            <th>Quantity</th>
                            <th>Shipping Price</th>
                            <th>Total Amount</th>
                            <th width="120px"> Action</th>
                        </tr>
                        @if (!empty($itemArray) && count($itemArray) > 0)
                        @foreach ($itemArray as $key => $value)
                        <tr>
                            <td>
                                <div class="wishlist-item return-order-item">
                                    @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                    @else
                                    <img src="{{ asset('img/category/placeholder.svg') }}">
                                    @endif
                                    <div class="wishlist-item-content">
                                        <h5>{{ $value['item']['what_are_you_selling'] }}</h5>
                                        <p class="product-description">{{ $value['userAddress']['address'] }} , {{ $value['userAddress']['city'] }} , {{ $value['userAddress']['phone_number'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $value['userAddress']['name'] }}
                            </td>
                            <td>
                                {{ $value['price'] }} {{env('CURRENCY_TAG')}}
                            </td>
                            <td>
                                {{ $value['quantity'] }}
                            </td>
                            <td>
                                {{ $value['shipping_price'] }}
                            </td>
                            <td>
                                {{ $value['total_amount'] }} {{env('CURRENCY_TAG')}}
                            </td>
                            <td>
                                @if( $value['status'] == '0')
                                <a class="return_order_accept" data-bs-toggle="modal" data-bs-target="#return_order_accept{{ $value['id'] }}" href="javascript:void(0)" data-id="{{ $value['id'] }}" data-order-accept-id="{{ $value['main_order_id'] }}"><i class="fas fa-check check-icon" title="Approve"></i></a> |
                                <a class="return_order_decline" data-bs-toggle="modal" data-bs-target="#return_order_decline{{ $value['id'] }}" href="javascript:void(0)" data-id="{{ $value['id'] }}" data-order-id="{{ $value['main_order_id'] }}" title="Decline"><i class="fas fa-times-circle close-icon"></i></a>
                                @elseif( $value['status'] === 'approve')
                                <!-- <a href="{{ route('frontend.users.my-orders.track_orders', ($value['order_id'])) }}">Track Order</a></p> -->
                                <a href="javascript:void(0)">Track Order</a></p>
                                @elseif( $value['status'] === 'decline')
                                <p>Decline Order</p>
                                @endif
                            </td>
                        </tr>
                        <div class="modal fade" id="return_order_accept{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" id="items_delete_popup">
                                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p style="text-align: left"> <strong>Are you sure you want to accept this return Order for OrderID - {{ $value['main_order_id'] }} ?</strong></p>
                                    </div>
                                    <form action="{{ route('frontend.users.orders-sold.return_order_accept') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" class="id" value="{{ $value['id'] }}">
                                        <input type="hidden" name="main_order_id_accept" class="main_order_id_accept" value="{{ $value['main_order_id'] }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block"><strong>No</strong></span></button>
                                            <button type="submit" class="btn delete_post ml-1 post_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block"><strong>Yes</strong></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="return_order_decline{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" id="items_delete_popup">
                                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p style="text-align: left"> <strong>Are you sure you want to decline this return Order for OrderID - {{ $value['main_order_id'] }} ?</strong></p>
                                    </div>
                                    <form action="{{ route('frontend.users.orders-sold.return_order_decline') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" class="id" value="{{ $value['id'] }}">
                                        <input type="hidden" name="main_order_id" class="main_order_id" value="{{ $value['main_order_id'] }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block"><strong>No</strong></span></button>
                                            <button type="submit" class="btn delete_post ml-1 post_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block"><strong>Yes</strong></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">
                                <div>
                                    <p>No Return Order's</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            @if (!empty($itemArray) && count($itemArray) > 10)
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='page_navigation'></ul>
                </nav>
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

@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
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