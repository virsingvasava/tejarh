@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - Support' }}
@endsection

@section('content')

<div class="my-items-wrapper">
    <div class="container">
        <div class="support-main-sec">
            <div class="container">
                <div class="inner-support-sec">
                    <h2>How can we help you today?</h2>
                    <p>This is the first item's accordion body. It is shown by default, until the collapse plugin adds the
                        appropriate classes that we use to style each element.</p>
                </div>
                <div class="support-form-sec">
                    <form action="{{route('frontend.users.site.storeSupportsMessage')}}" method="POST" id="supportsForm">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name" id="first">
                        </div>
                        {{-- <div class="input-group">
                            <input type="text" name="last_name" value="" class="form-control" placeholder="Last Name" id="last">
                        </div>
    
                        <div class="input-group">
                            <input type="tel" name="phone_no" value="" class="form-control" id="phone" placeholder="Phone Number">
                        </div>
    
                        <div class="input-group">
                            <input type="email" name="email" value="" class="form-control" id="email" placeholder="Email">
                        </div> --}}

                        <div class="input-group">
                            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="Subject" id="subject">
                        </div>

                        <div class="input-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Message" name="query_message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
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
 <link rel="stylesheet" href="{{ asset('assets/css/supports.css')}}">
@endsection
@section('script')
<script>
    $("#supportsForm").validate({
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
