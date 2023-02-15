<div class="my-orders-products" id="pagingBox">
    @if (!empty($arrayFilter) && count($arrayFilter) > 0)
    <?php $i = 1; ?>
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
                    @if($value['order_status'] == ORDER_CANCELED)
                    @else
                    <p><a href="{{ route('frontend.business.order-details.index', base64_encode($value['id'])) }}">
                            @lang('business_messages.order.order_details')</a></p>
                    @endif
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
                    @if(!empty($value['userAddress']))
                    <h6>@lang('business_messages.order.ship_to') : {{ $value['userAddress']['address'] }} ,{{ $value['userAddress']['pincode'] }} , {{ $value['userAddress']['city'] }} </h6>
                    @endif
                    @elseif($value['order_status'] == "5")
                    @if(!empty($value['userAddressReturn']))
                    <h6>Ship From : {{ $value['userAddressReturn']['address'] }} ,{{ $value['userAddressReturn']['pincode'] }} , {{ $value['userAddressReturn']['city'] }} </h6>
                    @endif
                    @endif
                </div>
            </div>
            <?php $i++; ?>
            <div class="inner-product-box">
                @if($value['order_status'] == ORDER_CANCELED)

                @elseif($value['order_status'] == ORDER_RETURN)
                <div class="product-box-btn">
                    <a href="javascript:void(0)" id="ticket{{$i}}" data-id-submit="{{$i}}" data-bs-toggle="modal" data-bs-target="#raise-ticket{{ $value['id'] }}" data-bs-dismiss="modal" data-id="{{ $value['id'] }}" style="display: block;" class="btn return-order-list ticket_click">Add Ticket</a>
                </div>

                @elseif($value['order_status'] == ORDER_DELIEVERED )
                <div class="product-box-btn">
                    <a href="javascript:void(0)" id="ticket{{$i}}" data-id-submit="{{$i}}" data-bs-toggle="modal" data-bs-target="#raise-ticket{{ $value['id'] }}" data-bs-dismiss="modal" data-id="{{ $value['id'] }}" style="display: block;" class="btn return-order-list ticket_click">Add Ticket</a>
                </div>

                @else
                <div class="product-box-btn">
                    <a href="javascript:void(0)" id="ticket{{$i}}" data-id-submit="{{$i}}" data-bs-toggle="modal" data-bs-target="#raise-ticket{{ $value['id'] }}" data-bs-dismiss="modal" data-id="{{ $value['id'] }}" style="display: block;" class="btn return-order-list ticket_click">Add Ticket</a>
                </div>&nbsp;
                <div class="product-box-btn">
                    <a href="javascript:void(0)" class="btn post_delete_user" data-bs-toggle="modal" data-bs-target="#post_delete_user" data-id="{{ $value['id'] }}">@lang('business_messages.order.cancel_order')</a>
                </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="raise-ticket{{ $value['id'] }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5>Add Ticket</h5>
                    <div id="ajax-alert-error" class="alert" style="display:none;">
                    </div>
                    <div id="ajax-alert" class="alert" style="display:none;">
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <form id="ticketModal{{$i}}" name="ticketModal" method="post" enctype="multipart/form-data" action="javascript:void(0)" class="order_checkbox">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $value['user_id'] }}">
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" name="subject" placeholder="Enter Subject" class="form-control" value="ORDER-ID #{{ $value['id'] }}" readonly>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" placeholder="Enter Message" name="message"></textarea>
                        </div>
                        <div class="input-group">
                            <span style="color:red;">* Image should be 1MB</span>
                            <div class="input-group file-upload">
                                <div class="file-upload-div review">
                                    <input type='file' name="image" id="image" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    <img id="blah0022" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                                    Add photo/file
                                </div>
                                <label id="image-error" class="error" for="image"></label>
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                                {!!$errors->first('image', '<span class="text-danger">:message</span>')!!}
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" name="sku_id" placeholder="" class="form-control" value="#{{$randomNumber}}" readonly>
                        </div>
                        <div class="form-group submit">
                            <button type="submit" data-id="{{$i}}" id="returnbtn{{$i}}" class="btn btn-primary loader_class" value=""> Add Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="post_delete_user{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" id="items_delete_popup">
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">
                        <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: left"> <strong>Are you sure to Cancel your Order ?</strong></p>
                    </div>
                    <form action="{{ route('frontend.business.my-orders.order_cancel') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" class="order_id" value="{{ $value['id'] }}">
                        <div class="modal-footer">
                            <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block"><strong>NO</strong></span></button>
                            <button type="submit" class="btn delete_post ml-1 post_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block"><strong>YES</strong></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="estimated-delivery">
            <p>@lang('business_messages.order.estimated_delivery') <strong>{{ $create_date }}</strong> &nbsp;
                @if($value['order_status'] == ORDER_CANCELED)
                @else
                <a href="{{ route('frontend.business.my-orders.track_orders', ($value['id'])) }}">Track Order</a>
            </p>
            @endif
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