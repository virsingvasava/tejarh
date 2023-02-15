@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User Wallet' }}
@endsection

@section('content')
<div class="wallet-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <!-- <li class="breadcrumb-item" aria-current="page">My Account</li> -->
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.header2.my_wallet')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4">
                <div class="current-balance">
                    <p>@lang('business_messages.wallet.current_balance')</p>
                    <h2>{{ $totalMoney }} {{ env('CURRENCY_TAG') }}</h2>
                </div>
                <form>
                    <div class="input-group add-money-input" style="justify-content: end;">
                        <input type="text" placeholder="Add Money" name="amount" id="amountID" class="form-control" require>
                        <button type="submit" class="btn btn-primary clickable" style="margin-top: 20px;">Add Money</button>
                    </div>
                </form>
                <div class="credit-debit-sec">
                    <p><a href="javascript:void(0)" class="add-money" data-bs-toggle="modal" data-bs-target="#add-card-payment">Credit/Debit Card</a></p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="payment-transition">
                    <h6>August 2021</h6>
                    @if (!empty($getData) && count($getData) > 0)
                    @foreach ($getData as $key => $value)
                    <ul>
                        @if($value['is_paid'] == 1 && $value['status'] == 0)
                        <li class="debit">
                            <h5>Debit-Text</h5>
                            @php
                            $create_date = date('d M Y 00:00:00', strtotime($value['created_at']));
                            @endphp
                            <p>{{ $create_date }}</p>
                            <p class="price">- {{ $value['amount'] }} {{ env('CURRENCY_TAG') }}</p>
                        </li>
                        @elseif($value['is_paid'] == 1)
                        <li class="credit">
                            <h5>Credit-Text</h5>
                            @php
                            $create_date = date('d M Y 00:00:00', strtotime($value['updated_at']));
                            @endphp
                            <p>{{ $create_date }}</p>
                            <p class="price">+ {{ $value['amount'] }} {{ env('CURRENCY_TAG') }}</p>
                        </li>
                        @endif
                    </ul>
                    @endforeach
                    @else
                    <ul>
                        <li>
                            <p>No Records</p>
                        </li>
                    </ul>
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


<!--  Add Card Payment Modal -->
<div class="modal fade" id="add-card-payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Enter Card Details</h5>
            <form action="{{ route('frontend.users.wallet.wallet_paid') }}" method="POST" id="paymentCardForm">
                @csrf
                <div class="add-card-img" id="add-card-img">
                    <input type="hidden" id="amount" name="amount" value="{{$amount}}">
                    <input type="text" id="{{$amount}}" value="{{ $amount }} {{ env('CURRENCY_TAG') }}" class="form-control" readonly>
                </div>
                <br>
                <div class="input-group">
                    <input type="text" placeholder="Card Holder Name" name="holder_name" class="form-control">
                </div>
                <div class="input-group card-number-icon">
                    <input type="text" placeholder="Enter Card Number" name="card_number" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="input-group card-date">
                            <select name="cardExpMonth" id="cardExpYear" class="form-select cardMonth">
                                <option value="" selected="selected">Month</option>
                                @foreach ($monthArray as $monthKey => $month)
                                <option value="{{ $monthKey }}">{{ $monthKey }}</option>
                                @endforeach
                            </select>
                            <select name="cardExpYear" id="cardExpYear" class="form-select cardYear">
                                <option value="" selected="selected">Year</option>
                                @for ($year = now()->year; $year <= env('FEATURE_YEARS'); $year++) <option value="{{ $year }}">{{ $year }}</option>
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
                    <button style="width:100%" type="submit" class="btn" id="getTotalAmount" value="Make Payment">Pay Now</button><br>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() { //run when the DOM is ready
        $(".clickable").click(function() { //use a class, since your ID gets mangled
            $(".credit-debit-sec").addClass("active"); //add the class to the clicked element
        });
    });
</script>
<script type="text/javascript">
    $(".clickable").click(function(e) {
        e.preventDefault();
        var amount = $("#amountID").val();
        var token = "{{csrf_token()}}";
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.users.wallet.store') }}",
            data: {
                amount: amount,
                _token: token
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $('#add-card-img').load(document.URL + ' #add-card-img');
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
    });
</script>
<script>
    $("#paymentCardForm").validate({
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
                creditcard: true,
                minlength: 13,
                maxlength: 16
            },
            "cvv": {
                required: true,
            },
        },
        messages: {

            "holder_name": {
                required: '{{ __("business_messages.bpay_now.enter_your_card_holder_name") }}',
            },

            "card_number": {
                required: '{{ __("business_messages.bpay_now.enter_card_number") }}',
            },
            "cvv": {
                required: '{{ __("business_messages.bpay_now.ccv") }}',
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