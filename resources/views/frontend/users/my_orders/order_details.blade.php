@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User order Details' }}
@endsection

@section('content')
<div class="order-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> @lang('frontend-messages.order-details.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.order-details.order_details')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6">
                <div id="ajax-alert-verify" class="alert" style="display: none;">
                    </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if($orderDetails['order_status'] == ORDER_DELIEVERED)
                <a href="{{ route('frontend.users.order-details.pdf_download_invoice', ($orderDetails['id'])) }}" class="btn tras_btn">Tax Invoice</a>
                @else
                <a href="{{ route('frontend.users.order-details.pdf_download_invoice', ($orderDetails['id'])) }}" class="btn tras_btn">Proforma Invoice</a>
                @endif
                <a id="returnbtn" class="btn checkbox_button" width="50px" height="25px" data-bs-toggle="modal" data-bs-target="#return_order" style="display:none;" data-id="">Return Order</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="order-detail">
                    <ul>
                        <li>@lang('frontend-messages.order-details.order_id') : #{{ $orderDetails['id'] }}</li>
                        @php
                        $create_date = date('d M Y', strtotime($orderDetails['created_at']));
                        @endphp
                        <li>@lang('frontend-messages.order-details.date') : {{$create_date}}</li>
                    </ul>
                    <div class="order-detail-content">
                        <div class="delivery-address">
                            <h6>@lang('frontend-messages.order-details.delivery_address')</h6>
                            <h6>{{ $orderAddress->name }}</h6>
                            <address>{{ $orderAddress->address }} , {{ $orderAddress->pincode }} , {{ $orderAddress->city }}</address>
                            <p>@lang('frontend-messages.order-details.phone'):<a href="tel:{{ $orderAddress->phone_number }}">{{ $orderAddress->phone_number }}</a></p>
                        </div>
                        <div class="payment-method">
                            <h6>@lang('frontend-messages.order-details.payment_method')</h6>
                            <?php
                            if (($orderDetails->payment_method == 'card')) {
                                $cardNumber = "CARD";
                            } elseif (($orderDetails->payment_method == 'cod')) {
                                $cardNumber = "COD";
                            } elseif (($orderDetails->payment_method == 'gpay')) {
                                $cardNumber = "GPAY";
                            } elseif (($orderDetails->payment_method == 'wallet')) {
                                $cardNumber = "WALLET";
                            } elseif (($orderDetails->payment_method == 'apple_pay')) {
                                $cardNumber = "APPLE PAY";
                            } else {
                                $cardNumber = "";
                            }

                            ?>
                            <p><?php echo ($cardNumber); ?></p>
                            <!-- <h6>@lang('business_messages.order-details.shipped_by')</h6>
                            <p>FedEX</p> -->
                        </div>
                        <div class="payment-details">
                            <h6>@lang('frontend-messages.order-details.payment_details')</h6>
                            <table>
                                <tr>
                                    <td>@lang('frontend-messages.order-details.item_price')</td>
                                    <td>{{ $orderAmount }} {{env('CURRENCY_TAG')}}</td>
                                </tr>
                                <!-- <tr>
                                    <td>@lang('frontend-messages.order-details.shipping_charge')</td>
                                    <td class="red-color">{{ $orderShippingPrice }} {{env('CURRENCY_TAG')}}</td>
                                </tr> -->
                                @if(!empty($orderDetails['sell_tax']))
                                <tr>
                                    <td>Vat (%)</td>
                                    <td class="red-color">{{ $orderDetails['sell_tax'] }} %</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>@lang('frontend-messages.order-details.total_amount')</td>
                                    <td><strong>{{ round($orderDetails['grand_total']) }} {{env('CURRENCY_TAG')}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if (!empty($itemArray) && count($itemArray) > 0)
                @foreach ($itemArray as $key => $value)
                <div class="order-select-wrapper">
                    <div class="order-product">
                        @if($value['status'] != 5 && $value['status'] == 4)
                        <div class="form-check order-checkbox"><input type="checkbox" class="form-check-input custom-checkbox order_checkbox checkbox" data-id="" type="checkbox" value="" id="flexCheckChecked" data-orderIds="{{ $value['orderItems']['id'] }}"></div>
                        @endif
                        @if (isset($value['itemImage']['item_picture1']) && !empty($value['itemImage']['item_picture1']))
                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['itemImage']['item_picture1']) }}">
                        @else
                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        @endif
                        <div class="order-product-content">
                            <p>{{ $value['itemDetails']['what_are_you_selling'] }}</p>
                            <p>{{ $value['itemDetails']['describe_your_items'] }}</p>
                            <p>SKU-NO : {{ $value['itemDetails']['sku'] }}</p>
                            <span>{{ $value['orderItems']['price'] }} x {{ $value['orderItems']['quantity'] }} + {{ $value['orderItems']['shipping_price'] }} : {{ $value['orderItems']['total_amount'] }} {{env('CURRENCY_TAG')}}</span>
                        </div>
                    </div>
                    <div class="order-buttons">
                        <a href="javascript:void(0)" class="btn btnReviewModel" width="50px" height="25px" @if (isset(Auth::user()->id)) data-userIds="{{ Auth::user()->id }}" @endif
                            data-itemsIds="{{ $value['itemDetails']['id'] }}"
                            data-itemsName="{{ $value['itemDetails']['what_are_you_selling'] }}"
                            data-itemsStoreAddress="{{ $value['itemDetails']['address'] }}"
                            data-bs-toggle="modal" data-bs-target="#review_ratings"
                            data-bs-dismiss="modal">
                            <span class="fas fa-star mr-sm-1"></span> Review\Rate Product</a>
                        <a href="javascript:void(0)" id="write_review_Ids" class="btn accept_order_btn" style="width:222px;height:49px" data-bs-toggle="modal" data-bs-target="#seller_review_writing_btton" data-bs-dismiss="modal"><img src="{{ asset('assets/images/edit-icon.png') }}">
                            Review\Rate Seller</a>

                    </div>
                </div>
                @endforeach
                @endif
                @if (!empty($itemArrayReturn) && count($itemArrayReturn) > 0)
                @foreach ($itemArrayReturn as $retunkey => $retunValue)
                <div class="order-select-wrapper">
                    <div class="order-product">

                        @if (isset($retunValue['itemImage']['item_picture1']) && !empty($retunValue['itemImage']['item_picture1']))
                        <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $retunValue['itemImage']['item_picture1']) }}">
                        @else
                        <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                        @endif
                        <div class="order-product-content">
                            <p>{{ $retunValue['itemDetails']['what_are_you_selling'] }}</p>
                            <p>{{ $retunValue['itemDetails']['describe_your_items'] }}</p>
                            <p>SKU-NO : {{ $retunValue['itemDetails']['sku'] }}</p>
                            <span>{{ $retunValue['itemDetails']['price'] }} {{env('CURRENCY_TAG')}}</span>
                        </div>
                    </div>
                    <div class="order-buttons">
                        <a href="javascript:void(0)" class="btn btnReviewModel" width="50px" height="25px" @if (isset(Auth::user()->id)) data-userIds="{{ Auth::user()->id }}" @endif
                            data-itemsIds="{{ $retunValue['itemDetails']['id'] }}"
                            data-itemsName="{{ $retunValue['itemDetails']['what_are_you_selling'] }}"
                            data-itemsStoreAddress="{{ $retunValue['itemDetails']['address'] }}"
                            data-bs-toggle="modal" data-bs-target="#review_ratings"
                            data-bs-dismiss="modal">
                            <span class="fas fa-star mr-sm-1"></span> Review\Rate Product</a>
                        <a href="javascript:void(0)" id="write_review_Ids" class="btn accept_order_btn" style="width:222px;height:49px" data-bs-toggle="modal" data-bs-target="#seller_review_writing_btton" data-bs-dismiss="modal"><img src="{{ asset('assets/images/edit-icon.png') }}">
                            Review\Rate Seller</a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
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
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
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
                        <h3 class="item_name"></h3>
                        <p class="items_store_address"></p>
                    </div>
                    <div class="rating-right-sec">
                        <button type="button" id="write_review_Ids" class="fetchUserDetails btn-review" data-bs-toggle="modal" data-bs-target="#review_writing_btton" data-bs-dismiss="modal"><span class="review-icon"><img src="{{ asset('assets/images/edit-icon.png') }}"></span>Write a review</button>
                    </div>
                </div>
                <div id="reviewMessageSection">
                    <div class="review-score-container">
                        <h3 class="reviewRatingAvg">0</h3>
                        <div class="rate mt-4">
                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                            <i class="fas fa-star star-light submit_star mr-1"></i>
                        </div>
                        <p class="reviewRatingCount">0 reviews</p>
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
                                <input type='file' onchange="readURL0022(this);" name="user_review_items_Image" id="user_review_items_Image">
                                <img id="blah0022" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                                Add photos
                                <video controls autoplay poster="/images/w3html5.gif" id="video10" style="display: none;"></video>
                            </div>
                            <label id="user_review_items_Image-error" class="error" for="user_review_items_Image"></label>
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

<!-- User Review Rating -->

<div class="modal fade" id="seller_review_writing_btton" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content new-review">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="m-25">Write a Review</h5>

            <form id="customer_review_post_seller" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="reviewer_userId" value="{{Auth::id()}}">
                <input type="hidden" name="sellerId" value="{{$orderDetails['user_id']}}">
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

                                    @if (isset(Auth::user()->first_name))
                                    <span class="first_name" id="first_name">{{Auth::user()->first_name}}</span>
                                    <span class="last_name" id="last_name">{{Auth::user()->last_name}}</span>
                                    @endif

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
                    <div class="form-group mb-2">
                        <div class="new-user-review">
                            <textarea name="user_review_description" id="user_review_description" rows="4" cols="50" placeholder="Share details of your own experience at this place"></textarea>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="input-group file-upload">
                            <div class="file-upload-div review">
                                <input type='file' onchange="readURL0022(this);" name="user_review_items_Image"
                                    id="user_review_items_Image">
                                <img id="blah0022" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                    Add photos
                    <video controls autoplay poster="/images/w3html5.gif" id="video10" style="display: none;"></video>
                </div>
                <label id="user_review_items_Image-error" class="error" for="user_review_items_Image"></label>
        </div>
    </div> --}}
    <div class="review-btn-sec">
        <button type="button" style="width:100px" class="btn-cancle" data-bs-dismiss="modal" aria-label="Close">Cancle</button>
        <button type="submit" style="width:100px" class="btn-post review_submit_btn_mute" id="save_review" disabled>Post</button>
    </div>
</div>
</form>
</div>
</div>
</div>
<!-- User Review Rating End-->
@endsection

@section('script')

<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
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
            url: "{{ route('frontend.users.my-orders.users_retrive_reviews') }}",
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
            url: '{{ route("frontend.users.my-orders.users_retrive_reviews") }}',
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
            url: "{{ route('frontend.users.my-orders.users_review_post_user_details') }}",
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
                required: "{{ __('frontend-messages.review_post.validation.user_name') }}",
            },
            "user_review_description": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_description') }}",
            },
            "user_review_items_Image": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_items_Image') }}",
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText =
                '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
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
                url: "{{ route('frontend.users.my-orders.users_review_post_store') }}",
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

<script type="text/javascript">
    function load_rating_data() {

        var userIds = $('#userOfReviewId').val();
        var itemsIds = $('#itemOfId').val();
        var token = "{{ csrf_token() }}";

        $.ajax({
            type: "POST",
            dataType: "html",
            url: '{{ route("frontend.users.my-orders.users_retrive_reviews") }}',
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

    $("#customer_review_post_seller").validate({
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
                required: "{{ __('frontend-messages.review_post.validation.user_name') }}",
            },
            "user_review_description": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_description') }}",
            },
            "user_review_items_Image": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_items_Image') }}",
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText =
                '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formdata = new FormData(document.getElementById("customer_review_post_seller"));
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: "{{ route('frontend.users.seller-reviews.seller_review_post_store') }}",
                data: formdata,
                success: function(data) {
                    $('#seller_review_writing_btton').modal('hide');
                    // $('#seller_review_writing_btton').modal('show');
                    window.location.reload();

                    //load_rating_data();
                }
            })
        }
    });

    $(document).on('click', '.order_checkbox', function() {
        if ($(this).is(":checked")) {
            var id = $(this).attr('data-id');
            $('.checkbox_button' + id).show();
        } else {
            var id = $(this).attr('data-id');
            $('.checkbox_button' + id).hide();
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".checkbox_button").on("click", function(e) {
            var idsArr = [];
            $(".checkbox:checked").each(function() {
                idsArr.push($(this).attr("data-orderIds"));
            });
            if (
                confirm("Are you sure, you want to retun the selected product ?")
            )
            {
            var strIds = idsArr.join(",");
            $.ajax({
              url: "{{ route('frontend.users.order-details.order_return') }}",
              type: "POST",
              headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              data: "ids=" + strIds,
              success: function (data) {
                if (data["status"] == true) {
                  $(".checkbox:checked").each(function () {
                  });
                  $('#ajax-alert-verify').addClass('alert-success').show(function() {
                        $(this).html('Product return successfull').delay(1000).fadeOut();
                    });
                    location.reload();
                } else {
                  alert("Whoops Something went wrong!!");
                }
              },
              error: function (data) {
                alert(data.responseText);
              },
            });
          }
        });
    });
</script>

@endsection