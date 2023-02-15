@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - Contact Us' }}
@endsection

@section('content')
    <div class="wallet-wrapper cms-bredcrum">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i
                                        class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="blog-main-sec">
                    <div class="container">
                        <div class="row inner-blog-sec">
                            <div class="col-md-4">
                                <a href="blog-detail.html">
                                    <img class="w-100 mb-3" src="{{asset('assets/images/product-img1.png')}}"
                                        alt="" />
                                    <h3>From its medieval origins to the digital era, learn everything</h3>
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                        print,
                                        graphic or web designs...</p>
                                    <button class="btn-read-more" href="#">Read More</button>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="blog-detail.html">
                                    <img class="w-100 mb-3" src="{{asset('assets/images/product-img2.png')}}"
                                        alt="" />
                                    <h3>From its medieval origins to the digital era, learn everything</h3>
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                        print,
                                        graphic or web designs...</p>
                                    <button class="btn-read-more" href="#">Read More</button>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="blog-detail.html">
                                    <img class="w-100 mb-3" src="{{asset('assets/images/product-img3.png')}}"
                                        alt="" />
                                    <h3>From its medieval origins to the digital era, learn everything</h3>
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                        print,
                                        graphic or web designs...</p>
                                    <button class="btn-read-more" href="#">Read More</button>
                                </a>
                            </div>
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
<link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <script>
        $("#contactUsUsers").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "first_name": {
                    required: true,
                },
                "last_name": {
                    required: true,
                },
                "phoneNumber": {
                    required: true,
                },
                "email": {
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

                "first_name": {
                    required: "{{ __('business_messages.contactUs.validation.enter_first_name') }}",
                },
                "last_name": {
                    required: "{{ __('business_messages.contactUs.validation.enter_last_name') }}",
                },
                "phoneNumber": {
                    required: "{{ __('business_messages.contactUs.validation.enter_phone_number') }}",
                },
                "email": {
                    required: "{{ __('business_messages.contactUs.validation.enter_email') }}",
                },
                "subject": {
                    required: "{{ __('business_messages.contactUs.validation.enter_subjects') }}",
                },
                "message": {
                    required: "{{ __('business_messages.contactUs.validation.write_message') }}",
                },
            },
            submitHandler: function(form) {
                var $this = $('.loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('.loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
            }
        });
    </script>
@endsection
