@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Follow Unfollow List' }}
@endsection
@section('content')
    <div class="my-items-wrapper">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Follow Unfollow</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-7">
                    <div class="my-items-filter">
                        <ul class="itemFilters">
                            <li><a href="javascript:void(0)" data-value="on_sell"
                                    class="btnf followUnfollowFilter follow_status_filter getIds active"  
                                    data-items="follow"
                                    data-following_id="{{$followingId}}"
                                    data-follower_id="{{$followerId}}" 
                                    >Follow</a></li>

                            <li><a href="javascript:void(0)" data-value="sold"
                                    class="btnf tran_btn followUnfollowFilter follow_status_filter" data-items="unfollow">Unfollow</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- pagination-hidden-section  start-->
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <!-- pagination-hidden-section  end-->

            <div class="row" id="followUnfollow">
                @if (!empty($followerArr) && count($followerArr) > 0)
                    <div class="col-md-12">
                        <div class="row grid">
                            @foreach ($followerArr as $key => $value)
                                <div class="col-md-3 element-item admin">
                                    <div class="role-user">
                                        @if ($value['user']['role_user_profile_picture'] != '')
                                            <img
                                                src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['user']['role_user_profile_picture']) }}">
                                        @else
                                            <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/strory-img1.png') }}">
                                        @endif

                                        <h5>{{ $value['user']['first_name'] }}</h5>
                                        <ul>
                                            <li>Name : {{ $value['user']['first_name'] }}</li>
                                            <li>phone_number : {{ $value['user']['phone_number'] }}</li>
                                            <li>Address : {{ $value['user']['address'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="breadcrumb-item" style="text-align:center;">
                        <h5 class="" style="color:gray"">Not Found Follow Unfollow</h5>
                    </div>
                @endif
            </div>
            <!-- pagination  start-->
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
            </div>
            <!-- pagination end-->
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
    <style>
        a.btnf.active,
        a.btnf:hover {
            background-color: #0AD188;
            color: #fff;
            border-color: #0AD188;

        }

        .btnf {
            background-color: transparent;
            display: inline-block;
            border: 1px solid #0AD188;
            padding: 7px 17px;
            color: #0AD188;
            font-size: 16px;
            line-height: 24px;
            color: #0AD188;
            border-radius: 5px;
            transition: all 0.5s ease 0s;
        }
    </style>
    <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.followUnfollowFilter').click(function() {

                var sorting_data = $(this).attr("data-items");
                let followingId = $('.getIds').attr("data-following_id");
                let followerId = $('.getIds').attr("data-follower_id");

                $('.follow_status_filter').removeClass('active');
                $(this).addClass('active');

                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: '{{ route("frontend.business.follow-unfollow.followUnfollowFilter") }}',
                    data: {
                        'sorting_data': sorting_data,
                        'followingId':followingId,
                        'followerId':followerId,
                        _token: token
                    },
                    success: function(data) {
                        if (data) {
                            $('#followUnfollow').html(data);

                        } else {
                            location.reload();
                        }
                    },
                    timeout: 10000
                });
            });
        });
    </script>
@endsection
