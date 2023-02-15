@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User Story Payment' }}
@endsection

@section('content')
<link rel="stylesheet" href="{{asset('assets/checkout_assets/normalize.css')}}" />
<link rel="stylesheet" href="{{asset('assets/checkout_assets/style.css')}}" />
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>

<div class="order-summary-payment-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.card.card_details')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="right-order-summary-payment pay-checkout rosp">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @elseif(Session::has('danger'))
                            <div class="alert alert-danger text-center">
                                <p>{{ Session::get('danger') }}</p>
                            </div>
                            @endif
                            <h5>@lang('frontend-messages.card.add_card')</h5>
                            <form method="POST" action="{{ route('frontend.users.site.payment_successfull',$storyPriceId) }}"
                             id="usersPaymentCardForm">
                                @csrf
                                <input type="hidden" name="id" value="{{$storyPriceId}}">
                                <div class="add-card-img">
                                    <!-- <img src="{{asset('assets/images/ATM-Card.png')}}"><br> -->
                                </div><br>
                                <div class="input-group">
                                    <input type="text" placeholder="@lang('frontend-messages.card.placeholder.card_holder_name')" name="holder_name" class="form-control">
                                </div>
                                <div class="input-group card-number-icon">
                                    <input type="text" placeholder="@lang('frontend-messages.card.placeholder.enter_card_number')" 
                                    name="card_number" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="input-group card-date">
                                            <select name="expiry_month" id="cc-exp-month" class="form-select cardMonth">
                                                <option value="" selected="selected">Month</option>
                                                @foreach ($monthArray as $monthKey => $month)
                                                    <option value="{{ $monthKey }}">{{ $monthKey }}</option>
                                                @endforeach
                                            </select>
                                            <select name="expiry_year" id="cc-exp-year" class="form-select cardYear">
                                                <option value="" selected="selected">Year</option>
                                                @for ($year = now()->year; $year <= env('FEATURE_YEARS'); $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            <label id="cc-exp-month-error" class="error" for="cc-exp-month" style="display: block;"></label>
                                            <label id="cc-exp-year-error" class="error" for="cc-exp-year" style="display: block;"></label>
                                        </div>
                                        <input style="display:none"  class="form-control" name="expiry_month_year1" placeholder="MM/YY" type="text" onkeyup="formatString(event);" maxlength='5'>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group cvv-card">
                                            <input type="text" placeholder="@lang('frontend-messages.card.placeholder.CVV')" name="cvv" maxlength="3" minimum="3" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button type="submit"  class="btn btn-primary"  value="Make Payment">@lang('frontend-messages.card.pay') {{$storyPriceIdDetails->product_price}}</button>
                                </div><br>
                            </form>
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
                <img src="{{ asset('assets/images/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('fronted/users_flow/assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset('fronted/users_flow/assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('assets/checkout_assets/app.js')}}"></script>
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/cart_css.css') }}">

<script>
    
        $("#usersPaymentCardForm").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {

                "holder_name": {
                    required: true,
                },

                "card_number": {
                    required: true,
                },
                "expiry_month": {
                    required: true,
                },
                "expiry_year": {
                    required: true,
                },
                "expiry_month_year": {
                    required: true,
                },
                
                "cvv": {
                    required: true,
                },
            },
            messages: {

                "holder_name": {
                    required: '{{ __('business_messages.bpay_now.enter_your_card_holder_name') }}',
                },

                "card_number": {
                    required: '{{ __('business_messages.bpay_now.enter_card_number') }}',
                },
                "expiry_month": {
                    required: '{{ __('business_messages.bpay_now.expiry_month') }}',
                },

                "expiry_year": {
                    required: '{{ __('business_messages.bpay_now.expiry_year') }}',
                },

                "expiry_month_year": {
                    required: '{{ __('business_messages.bpay_now.expiry_month_year') }}',
                },
                "cvv": {
                    required: '{{ __('business_messages.bpay_now.ccv') }}',
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
<script>
    var payButton = document.getElementById("pay-button");
    var form = document.getElementById("payment-form");

    Frames.init("pk_sbox_6g5ntgfzfqkgldpaeueipd6sli5");

    Frames.addEventHandler(
        Frames.Events.CARD_VALIDATION_CHANGED,
        function(event) {
            console.log("CARD_VALIDATION_CHANGED: %o", event);

            payButton.disabled = !Frames.isCardValid();
        }
    );
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        Frames.submitCard()
            .then(function(data) {
                Frames.addCardToken(form, data.token);
                // console.log(Frames.addCardToken(form, data.token))
                form.submit();
            })
            .catch(function(error) {
                // handle error
            });
    });
</script>

<script>
    Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);

    function onCardTokenized(event) {
        var csrf_token = "{{ csrf_token() }}";
        var payment_token = event.token;
        var storyPriceId = storyPriceId;
        alert(storyPriceId);
        $.ajax({
            type: "get",
            url: "{{ route('frontend.users.site.payment_successfull',$storyPriceId) }}",
            data: {
                'token': payment_token,
                _csrf_token: csrf_token,
                'storyPriceId' : storyPriceId,
            },
            dataType: 'json',
            success: function(data) {
                console.log(data.success);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function formatString(e) {
        var inputChar = String.fromCharCode(event.keyCode);
        var code = event.keyCode;
        var allowedKeys = [8];
        if (allowedKeys.indexOf(code) !== -1) {
            return;
        }
        event.target.value = event.target.value.replace(
            /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
        ).replace(
            /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
        ).replace(
            /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
        ).replace(
            /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
        ).replace(
            /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
        ).replace(
            /[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
        ).replace(
            /\/\//g, '/' // Prevent entering more than 1 `/`
        );
    }
</script>
@endsection