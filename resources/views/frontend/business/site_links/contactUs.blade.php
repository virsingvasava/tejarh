@extends('frontend.business.includes.web')

@section('pageTitle')
    {{ 'Tejarh - Contact Us' }}
@endsection

@section('content')
    <div class="wallet-wrapper cms-bredcrum">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="contact-main-sec">
                    <div class="container">
                        <div class="row inner-contact-sec">
                            <div class="col-md-6">
                                <h2>Have a Query?<br />Talk to Our Experts</h2>
                                <p>This is the first item's accordion body. It is shown by default, until the collapse
                                    plugin adds
                                    the
                                    appropriate classes that we use to style each element.</p>

                                <div class="row address-sec">
                                    <div class="col-md-6">
                                        <div class="inner-address-sec">
                                            <div>
                                                <img src="{{asset('assets/images/add-address-icon.png')}}" alt="" />

                                            </div>
                                            <div>
                                                <h3>Saudi Arabia</h3>
                                                <p>Olaya Mall, Riyadh Olaya Mall, <br />Riyadh, Saudi Arabia</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-address-sec align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/Icon-phone.png')}}" alt="" />
                                            </div>
                                            <div>
                                                <h4><a href="tel:00966 1 4193732">00966 1 4193732</a></h4>
                                            </div>
                                        </div>
                                        <div class="inner-address-sec align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/Icon-mail.png')}}" alt="" />
                                            </div>
                                            <div>
                                                <h4><a href="mailto: contact@tejarh.com">contact@tejarh.com</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="support-form-sec">
                                    <form action="{{ route('frontend.business.contact-us.seedMessageForContactUs') }}"
                                        method="post" enctype="multipart/form-data" id="contactUsBusiness">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                                class="form-control" placeholder="First Name" id="first">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" placeholder="Last Name" id="last">
                                        </div>

                                        <div class="input-group">
                                            <input type="tel" name="phoneNumber" value="{{ old('phoneNumber') }}"
                                                class="form-control" id="phone" placeholder="Phone Number">
                                        </div>

                                        <div class="input-group">
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" id="email" placeholder="Email">
                                        </div>

                                        <div class="input-group">
                                            <input type="text" name="subject" value="{{ old('subject') }}"
                                                class="form-control" id="subject" placeholder="Subject">
                                        </div>

                                        <div class="input-group">
                                            <textarea class="form-control" name="message" value="{{ old('message') }}" id="exampleFormControlTextarea1"
                                                rows="3" placeholder="Message"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>
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
        $("#contactUsBusiness").validate({
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
