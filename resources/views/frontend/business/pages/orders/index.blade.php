@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - Business Orders' }}
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
                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page">@lang('business_messages.order.my_account')</li>
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
            @if(!empty($itemArray) && count($itemArray) > 0)
            <div class="col-md-3">
                <div class="my-orders-filter">
                    <h5 class="line">@lang('business_messages.order.filters')</h5>

                    <div class="my-orders-filter-box">
                        <h6>@lang('business_messages.order.order_status')</h6>
                        @foreach ($orders_list->unique('order_status') as $order)
                        <div class="form-check">
                            <input class="form-check-input order_status" type="checkbox" value="{{ $order->order_status }}">
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

                                @elseif($value['order_status'] == ORDER_RETURN )
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
                                </div> &nbsp;
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
                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                    <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Rating -->
<div class="modal fade" id="review_ratings" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog review modal-dialog-centered">
        <div class="modal-content review">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">Review</h5>
            <div id="ajax-alert-error-password" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert-password" class="alert" style="display: none;">
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
            <form id="review_ratings_form" action="javascript:void(0)" method="POST">
                <div class="rating-sec">
                    <div class="rating-left-sec">
                        <h3 class="item_name">EmbedSocial</h3>
                        <p class="items_store_address">St. 1732 nb.4 Skopje MK, North Macedonia</p>
                    </div>
                    <div class="rating-right-sec">
                        <button type="button" id="write_review_Ids" class="fetchUserDetails btn-review" data-bs-toggle="modal" data-bs-target="#review_writing_btton" data-bs-dismiss="modal"><span class="review-icon"><img src="{{ asset('assets/images/edit-icon.png') }}"></span>Write a review</button>
                    </div>
                </div>
                <div id="reviewMessageSection">
                    <div class="review-score-container">
                        <h3 class="reviewRatingAvg">1.0</h3>
                        <div class="rate mt-4">
                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                        </div>
                        <p class="reviewRatingCount">4 reviews</p>
                    </div>
                    <div class="user_review_message_section">
                        @if (!empty($reviewRatingArray) && count($reviewRatingArray) > 0)
                        @foreach ($reviewRatingArray as $key => $value)
                        <div class="review-dialog-list">
                            <div class="review-block">
                                <div class="responseData">
                                    <div class="customer-review">
                                        <div class="review-img">I
                                            @if (!empty($value['user']['profile_picture']))
                                            <img src="@if (isset($value['user']['profile_picture'])) {{ asset('assets/users/' . $value['user']['profile_picture']) }} @endif">
                                            @else
                                            <img src="{{ asset('assets/images/user.png') }}">
                                            @endif
                                        </div>
                                        <div class="review-sec">
                                            <div class="review-content">
                                                <h5>{{ $value['user']['first_name'] }}{{ $value['user']['last_name'] }}
                                                </h5>
                                            </div>
                                            <div class="dots"><img src="{{ asset('assets/images/dots-icon.png') }}" /></div>
                                        </div>
                                    </div>
                                    <div class="review-time-sec">
                                        <div class="rate inner">
                                            @if ($value['rating_star'] == 5)
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            @elseif($value['rating_star'] == 4)
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            @elseif($value['rating_star'] == 3)
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            @elseif($value['rating_star'] == 2)
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            @else
                                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            <i class="fas fa-star star-light submit_star mr-1"></i>
                                            @endif
                                        </div>
                                        <span>{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</span>
                                    </div>
                                    <div class="customer-review-content mt-1">
                                        <p>{{ $value['review_description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="review_writing_btton" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content new-review">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">Write a Review</h5>
            <div id="ajax-alert-error-password" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert-password" class="alert" style="display: none;">
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
            <form id="customer_review_post" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="reviewer_userId" id="userOfReviewId" value="">
                <input type="hidden" name="item_Ids" id="itemOfId" value="">
                <input type="hidden" name="rating_data" id="rating_data" class="rating_data_check" value="">

                <div class="review-dialog-list">
                    <div class="customer-review">
                        <div class="review-img">
                            <a href="javascript:void(0)" id="review_profile" class="review_profile">
                                @if (isset(Auth::user()->profile_picture))
                                <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}">
                                @else
                                <img src="{{ asset('assets/images/user.png') }}">
                                @endif
                            </a>
                        </div>
                        <div class="review-sec">
                            <div class="review-content">
                                <h5>
                                    <span class="first_name" id="first_name"></span>
                                    <span class="last_name" id="last_name"></span>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h4 class="text-center mt-2 mb-4 star_ratting">
                            <i class="fas fa-star star-light submit_star mr-1 add_review_start5" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                    </div>
                    <div class="form-group">
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <div class="new-user-review">
                            <textarea name="user_review_description" id="user_review_description" rows="4" cols="50" placeholder="Share details of your own experience at this place"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group file-upload">
                            <div class="file-upload-div review">
                                <input type='file' onchange="readURL0033(this);" name="business_review_items_Image" id="business_review_items_Image">
                                <img id="blah0033" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                                Add photos
                                <video controls autoplay poster="/images/w3html5.gif" id="video10" style="display: none;"></video>
                            </div>
                            <label id="business_review_items_Image-error" class="error" for="business_review_items_Image"></label>
                        </div>
                    </div>
                    <div class="review-btn-sec">
                        <button type="button" class="btn-cancle" data-bs-dismiss="modal" aria-label="Close">Cancle</button>
                        <button type="submit" class="btn-post review_submit_btn_mute" id="save_review" disabled>Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Review Rating End-->
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
    var i = 2;
    $(document).on('click', '.ticket_click', function() {
        var id = $(this).attr('data-id-submit');
        $(document).on('click', '#returnbtn' + id, function() {
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
                        var $this = $('#ticketModal .loader_class');
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
                            url: '{{ route("frontend.business.my-orders.store") }}',
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
            url: '{{ route("frontend.business.my-orders.orderFilter") }}',
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
            url: '{{ route("frontend.business.my-orders.last_30_DaysOrderFilter") }}',
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

<script type="text/javascript">
    $(".btnReviewModel").click(function() {

        var userIds = $(this).attr("data-userIds");
        var itemsIds = $(this).attr("data-itemsIds");
        var itemsName = $(this).attr("data-itemsName");
        var itemsStoreAddress = $(this).attr("data-itemsStoreAddress");

        $('#userOfReviewId').val(userIds);
        $('#itemOfId').val(itemsIds);
        $('h3.item_name').html(itemsName);
        $('p.items_store_address').html(itemsStoreAddress);

        var token = "{{ csrf_token() }}";

        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{ route("frontend.business.my-orders.busines_retrive_reviews") }}',
            data: {
                'userId': userIds,
                'itemId': itemsIds,
                _token: token
            },
            success: function(data) {
                if (data) {
                    $('#reviewMessageSection').html(data);
                } else {
                    location.reload();
                }
            },
            timeout: 10000
        });
    });

    function load_rating_data() {

        var userIds = $('#userOfReviewId').val();
        var itemsIds = $('#itemOfId').val();
        var token = "{{ csrf_token() }}";

        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{route("frontend.business.my-orders.busines_retrive_reviews") }}',
            data: {
                'userId': userIds,
                'itemId': itemsIds,
                _token: token
            },
            success: function(data) {
                if (data) {
                    $('#reviewMessageSection').html(data);
                } else {
                    location.reload();
                }
            },
            timeout: 10000
        });
    }

    $(".fetchUserDetails").click(function() {
        let userIds = $('#userOfReviewId').val();
        let itemIds = $('#itemOfId').val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route("frontend.business.my-orders.busines_review_post_user_details")}}',
            data: {
                'userId': userIds,
                'itemId': itemIds,
                _token: token
            },
            success: function(response) {
                $.each(response, function(key, userData) {
                    /*Profile Image*/
                    var ImgUrl = "{{ URL::asset('assets/users') }}";
                    $("#blah0011").attr('src', ImgUrl + '/' + userData['profile_picture']);
                    $('#first_name').html(userData['first_name']);
                    $('#last_name').html(userData['last_name']);
                });
            },
        });
    });

    var rating_data = 0;
    $('.add_review_start5').click(function() {
        $('#submit_star_' + count).addClass('btn_mute');
        $('#submit_star_' + count).removeClass('btn_mute');
    });

    $(document).on('mouseenter', '.submit_star', function() {
        var rating = $(this).data('rating');
        reset_background();
        for (var count = 1; count <= rating; count++) {
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' + count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function() {
        reset_background();
        for (var count = 1; count <= rating_data; count++) {
            $('#submit_star_' + count).removeClass('star-light');
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
        $('#rating_data').val(rating_data);

        if ($('.rating_data_check').val() != '') {
            $('button#save_review').prop('disabled', false).removeClass('review_submit_btn_mute');
        }
    });

    $("#customer_review_post").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            "user_name": {
                required: true,
            },
            "user_review_description": {
                required: true,
            },
            "user_review_items_Image": {
                required: true,
            },
        },
        messages: {
            "user_name": {
                required: '{{ __("frontend-messages.review_post.validation.user_name")}}',
            },
            "user_review_description": {
                required: '{{ __("frontend-messages.review_post.validation.user_review_description")}}',
            },
            "user_review_items_Image": {
                required: '{{ __("frontend-messages.review_post.validation.user_review_items_Image")}}',
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formdata = new FormData(document.getElementById("customer_review_post"));
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: '{{ route("frontend.business.my-orders.busines_review_post_store")}}',
                data: formdata,
                success: function(data) {
                    $('#review_writing_btton').modal('hide');
                    $('#review_ratings').modal('show');
                    load_rating_data();
                }
            })
        }
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

<script>
    $('.order_status').click(function() {
        var order = [];
        $('.order_status').each(function() {
            if ($(this).is(":checked")) {
                order.push($(this).val());
            }
        });
        var token = "{{csrf_token()}}";
        Finalresult = order.toString();
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ route("frontend.business.my-orders.filter_ajax") }}',
            data: {
                'order_status': Finalresult,
                _token: token
            },
            success: function(data) {
                if (data) {
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
@endsection
@section('script')
@endsection