@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Product Reviews' }}
@endsection
@section('content')

    <div class="wallet-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">Reviews</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">{{ $category_name->category_name }}</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $item_name->what_are_you_selling }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4">
                    @if (!empty($itemImage) && count($itemImage) > 0)
                        @foreach ($itemImage as $key => $value)
                            <div class="product-slider">
                                <div id="product-slider1" class="owl-carousel owl-theme">
                                    @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                                        </div>
                                    @endif
                                </div>

                                <div id="product-slider2" class="owl-carousel owl-theme">
                                    @if (isset($value['item_pictures']['item_picture1']) && !empty($value['item_pictures']['item_picture1']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture2']) && !empty($value['item_pictures']['item_picture2']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture2']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture3']) && !empty($value['item_pictures']['item_picture3']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture3']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture4']) && !empty($value['item_pictures']['item_picture4']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture4']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture5']) && !empty($value['item_pictures']['item_picture5']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture5']) }}">
                                        </div>
                                    @endif

                                    @if (isset($value['item_pictures']['item_picture6']) && !empty($value['item_pictures']['item_picture6']))
                                        <div class="item">
                                            <img src="{{ asset(BUSINESS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture6']) }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="user_review_message_section">
                        @if (!empty($itemArray) && count($itemArray) > 0)
                            @foreach ($itemArray as $key => $value)
                                <div class="review-dialog-list">
                                    <div class="review-block-listing">
                                        <div class="reviews-listing">
                                            <div class="customer-review">
                                                <div class="review-img">I
                                                    @if (!empty($value['user']['profile_picture']))
                                                        <img
                                                            src="@if (isset($value['user']['profile_picture'])) {{ asset('assets/users/' . $value['user']['profile_picture']) }} @endif">
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
                        @else
                            <div class="text-center mt-5">
                                <h6>Not Found Reviews</h6>
                            </div>
                        @endif
                    </div>
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
                        <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                        <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                        <ul>
                            <li>
                                <a href="javascript:void(0)"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
    <style>
        .review-block-listing {
            border-bottom: 1px solid #ecedef;
            padding: 28px 0;
        }
    </style>

@endsection
@section('script')
@endsection