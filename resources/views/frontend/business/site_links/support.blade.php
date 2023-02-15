@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Business Orders' }}
@endsection
@section('content')
    <div class="my-orders-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item" aria-current="page">Support</li>
                        </ol>
                    </nav>
                </div>
                <div class="support-main-sec">
                    <div class="container">
                        <div class="inner-support-sec">
                            <h2>How can we help you today?</h2>
                            <p>This is the first item's accordion body. It is shown by default, until the collapse plugin
                                adds the
                                appropriate classes that we use to style each element.</p>
                        </div>
                        <div class="support-form-sec">
                            <form action="{{ route('frontend.business.home.storeSupportsMessage') }}" method="POST"
                                id="supportsFormBusiness">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        class="form-control" placeholder="First Name" id="first">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                        placeholder="Subject" id="subject">
                                </div>

                                <div class="input-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message"
                                        name="query_message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
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

    <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/supports.css') }}">
    <script>
        $("#supportsFormBusiness").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "first_name": {
                    required: true,
                },
                "subject": {
                    required: true,
                },
                "query_message": {
                    required: true,
                },
            },
            messages: {

                "first_name": {
                    required: '{{ __("messages.support.validation.first_name_is_required") }}',
                },
                "subject": {
                    required: '{{ __("messages.support.validation.subject_is_required") }}',
                },
                "query_message": {
                    required: '{{ __("messages.support.validation.message_is_required") }}',
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
