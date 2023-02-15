@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User order summary payment' }}
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
                <div class="right-order-summary-payment pay-checkout">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form id="payment-form" method="POST" action="">
                        @csrf
                        <label for="card-number">Card number</label>
                        <div class="input-container card-number">
                            <div class="icon-container">
                                <img id="icon-card-number" src="{{asset('images/card-icons/card.svg')}}" alt="PAN" />
                            </div>
                            <div class="card-number-frame"></div>
                            <div class="icon-container payment-method">
                                <img id="logo-payment-method" />
                            </div>
                            <div class="icon-container">
                                <img id="icon-card-number-error" src="{{asset('images/card-icons/error.svg')}}" />
                            </div>
                        </div>

                        <div class="date-and-code">
                            <div>
                                <label for="expiry-date">Expiry date</label>
                                <div class="input-container expiry-date">
                                    <div class="icon-container">
                                        <img id="icon-expiry-date" src="{{asset('images/card-icons/exp-date.svg')}}" alt="Expiry date" />
                                    </div>
                                    <div class="expiry-date-frame"></div>
                                    <div class="icon-container">
                                        <img id="icon-expiry-date-error" src="{{asset('images/card-icons/error.svg')}}" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="cvv">Security code</label>
                                <div class="input-container cvv">
                                    <div class="icon-container">
                                        <img id="icon-cvv" src="{{asset('images/card-icons/cvv.svg')}}" alt="CVV" />
                                    </div>
                                    <div class="cvv-frame"></div>
                                    <div class="icon-container">
                                        <img id="icon-cvv-error" src="{{asset('images/card-icons/error.svg')}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group submit">
                            <button id="pay-button" disabled="" type="submit" class="btn btn-primary payButton">PAY 111</button>
                        </div>
                        <div>
                            <span class="error-message error-message__card-number"></span>
                            <span class="error-message error-message__expiry-date"></span>
                            <span class="error-message error-message__cvv"></span>
                        </div>

                        <p class="success-payment-message"></p>

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
        // var url = "{{ route('frontend.users.order-details.test') }}";
        var csrf_token = "{{ csrf_token() }}";
        var payment_token = event.token;
        
        $.ajax({
            type: "get",
            url: "{{ route('frontend.users.order-details.test') }}",
            data: {'token': payment_token, _csrf_token:csrf_token},
            dataType: 'json',
            success: function(data) {
                console.log(data.success);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
@endsection