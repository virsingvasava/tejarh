@extends('frontend.business.includes.web')

@section('pageTitle')
{{ 'Tejarh - Business - Boost Item Payment'}} 
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
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Card Details</li>
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
                            <h5>Add Card</h5>
                            <form method="POST" action="{{ route('frontend.business.boost-items.boost_items_payment_info') }}" 
                            id="usersPaymentCardForm">
                                @csrf
                                <div class="add-card-img">
                                    <!-- <img src="{{asset('assets/images/ATM-Card.png')}}"><br> -->
                                </div><br>
                                <div class="input-group">
                                    <input type="text" placeholder="Card Holder Name" name="holder_name" class="form-control">
                                </div>
                                <div class="input-group card-number-icon">
                                    <input type="text" placeholder="Enter Card Number" name="card_number" class="form-control">
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
                                            <input type="text" placeholder="CVV" name="cvv" maxlength="3" minimum="3" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button type="submit"  class="btn btn-primary"  value="Make Payment">Pay {{$boostData->boost_amount}}</button>
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
                    <h2>TRY THE TEJARH APP</h2>
                    <p>Buy, sell and find just about anything using the app on your mobile.</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/app-store.png') }}"> </a>
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
                form.submit();
            })
            .catch(function(error) {
            });
    });
</script>
<script>
    Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);

    function onCardTokenized(event) {
        var csrf_token = "{{ csrf_token() }}";
        var payment_token = event.token;

        $.ajax({
            type: "get",
            url: "{{ route('frontend.business.boost-items.boost_items_payment_info') }}",
            data: {
                'token': payment_token,
                _csrf_token: csrf_token
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