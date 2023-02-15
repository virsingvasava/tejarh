@extends('frontend.business.includes.web')
@section('pageTitle','Tejarh - Business Story Payment') 
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
                            <form method="POST" action="{{ route('frontend.business.home.payment_successfull',$storyPriceId) }}"
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
                                    <input type="text" placeholder="@lang('frontend-messages.card.placeholder.enter_card_number')" name="card_number" class="form-control">
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
                                        </div>
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
            url: "{{ route('frontend.business.home.payment_successfull',$storyPriceId) }}",
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
</script>
@endsection