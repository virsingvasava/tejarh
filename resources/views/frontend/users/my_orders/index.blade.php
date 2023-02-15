@extends('frontend.users.layouts.master')
@section('title')
{{ 'Tejarh - User My Orders' }}
@endsection

@section('content')

<div class="my-orders-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.order.my_orders')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            @if(!empty($orders_list) && count($orders_list) > 0)
            <div class="col-md-3">
                <div class="my-orders-filter">
                    <h5 class="line">@lang('business_messages.order.filters')</h5>

                    <div class="my-orders-filter-box">
                        <h6>Order Status</h6>
                        @foreach ($orders_list->unique('order_status') as $order)
                        <div class="form-check">
                            <input class="form-check-input order_status" type="checkbox" value="{{ $order->order_status }}" name="order_status">
                            <label class="form-check-label" for="electronics_sub1">
                                @if ($order->order_status === '0')
                                Order Placed
                                @elseif($order->order_status === '1')
                                On the Way
                                @elseif($order->order_status === '2')
                                Dispatched
                                @elseif($order->order_status === '3')
                                Cancelled
                                @elseif($order->order_status === '4')
                                Delivered
                                @elseif($order->order_status === '5')
                                Returned
                                @endif
                            </label>
                        </div>
                        @endforeach
                    </div>
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
                                <input class="form-check-input orderFilter" name="filterYear[]" data-condition="{{ $filterYear }}" type="checkbox" value="{{ $filterYear }}" id="condition_{{ $filterYear }}">
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
                    <?php $i = 1; ?>
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
                                    @if($value['order_status'] == ORDER_CANCELED)
                                    @else
                                    <p><a href="{{ route('frontend.users.order-details.order_details', base64_encode($value['id'])) }}">
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
                                    @if($value['order_status'] != 5 )
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
                                @elseif($value['order_status'] == ORDER_DELIEVERED)
                                <div class="product-box-btn">
                                    <a href="javascript:void(0)" id="ticket{{$i}}" data-id-submit="{{$i}}" data-bs-toggle="modal" data-bs-target="#raise-ticket{{ $value['id'] }}" data-bs-dismiss="modal" data-id="{{ $value['id'] }}" style="display: block;" class="btn return-order-list ticket_click">Add Ticket</a>
                                </div>
                                @else
                                <div class="product-box-btn">
                                    <a href="javascript:void(0)" id="ticket{{$i}}" data-id-submit="{{$i}}" data-bs-toggle="modal" data-bs-target="#raise-ticket{{ $value['id'] }}" data-bs-dismiss="modal" data-id="{{ $value['id'] }}" style="display: block;" class="btn return-order-list ticket_click">Add Ticket</a>
                                </div>
                                <div class="product-box-btn">
                                    <a href="javascript:void(0)" class="btn post_delete_user" data-bs-toggle="modal" data-bs-target="#post_delete_user{{ $value['id'] }}" data-id="{{ $value['id'] }}">@lang('business_messages.order.cancel_order')</a>
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
                                                    <input type='file' onchange="readURL0022(this);" name="image" id="image" accept="application/pdf,image/png,image/jpg,image/jpeg">
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
                                    <form action="{{ route('frontend.users.my-orders.order_cancel') }}" method="POST">
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
            @if (!empty($itemArray) && count($itemArray) > 9)
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

@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">

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
            url: '{{ route("frontend.users.my-orders.orderFilter") }}',
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
            url: '{{ route("frontend.users.my-orders.last_30_DaysOrderFilter") }}',
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
    $('.order_status').click(function() {
        // alert('hi');
        var order = [];
        $('.order_status').each(function() {
            if ($(this).is(":checked")) {
                order.push($(this).val());
            }
        });
        var token = "{{ csrf_token() }}";
        Finalresult = order.toString();
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ route("frontend.users.my-orders.filter_ajax") }}',
            data: {
                'order_status': Finalresult,
                _token: token
            },
            success: function(data) {
                if (data)

                {
                    console.log(data);
                    console.log(data.message);
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
    $('.order_date_list1').click(function() {

        var order = [];
        $('.order_date_list1').each(function() {
            if ($(this).is(":checked")) {
                order.push($(this).val());
            }
        });
        var token = "{{ csrf_token() }}";
        Finalresult = order.toString();
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ route("frontend.users.my-orders.filter_date_ajax") }}',
            data: {
                'order_date_list1': Finalresult,
                _token: token
            },
            success: function(data) {
                if (data) {
                    console.log(data.message);
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

<style>
    button.btn.delete_post {
        padding: 5px 15px;
    }
</style>

<script type="text/javascript">
    var i = 2;
    $(document).on('click', '.ticket_click', function() {
        var id = $(this).attr('data-id-submit');
        $(document).on('click', '#returnbtn'+id, function() {
            if ($("#ticketModal"+id).length > 0) {
                $("#ticketModal"+id).validate({
                    ignore: "not:hidden",
                    onfocusout: function(element) {
                        this.element(element);
                    },
                    rules: {
                        "name": {
                            required: true,
                        },
                        "subject": {
                            required: true,
                        },
                        "message": {
                            required: true,
                        },
                    },
                    messages: {
                        "name": {
                            required: 'Please Enter Name',
                        },
                        "subject": {
                            required: 'Please Enter Subject',
                        },
                        "message": {
                            required: 'Please Enter Message',
                        },
                    },
                    submitHandler: function(form) {
                        var $this = $('#ticketModal.loader_class');
                        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                        $('#ticketModal .loader_class').prop("disabled", true);
                        $this.html(loadingText);
                        form.submit();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var formdata = new FormData(document.getElementById("ticketModal"+id));
                        $.ajax({
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            url: '{{ route("frontend.users.my-orders.store") }}',
                            data: formdata,
                            success: function(data) {
                                if (data.code === 200) {
                                    $('#ajax-alert').addClass('alert-success').show(function() {
                                        $(this).html(data.success);
                                        setTimeout(function() {
                                            $('body').removeClass('modal-open');
                                            $('.modal').removeClass('show');
                                            $('body').css('overflow', 'visible');
                                            $('.modal-backdrop').removeClass('show');
                                        }, 2000)
                                        $('.loader_class').prop("disabled", false);
                                        var loadingText = 'Ticket Added';
                                        $('.loader_class').prop("disabled", false);
                                        $this.html(loadingText);
                                        window.location.href = "";
                                    });
                                }
                            },
                            error: function(data) {
                                $('#ajax-alert-error').addClass('alert-danger').show(function() {
                                    $(this).html('Please check all the details');
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = 'Error in Adding Ticket';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                            }
                        });
                    }
                });
            }
            i++;
        });
    });
</script>
@endsection