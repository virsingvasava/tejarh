@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User order summary payment' }}
@endsection

@section('content')
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>

<div class="order-summary-payment-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="right-order-summary-payment pay-checkout">
                    <table>
                        <tr>
                            <td colspan="2"><strong>Payment Details</strong></td>
                        </tr>
                        <tr>
                            <td>Item price</td>
                            <td> @if(!empty($items->price))

                                {{$items->price}}

                                @else
                                7000
                                @endif

                                {{env('CURRENCY_TAG')}}
                            </td>
                        </tr>
                        <tr>
                            <td>Sell tax</td>
                            <td>0 {{env('CURRENCY_TAG')}}</td>
                        </tr>
                        <tr>
                            <td>Shipping Charge</td>
                            <td>0 {{env('CURRENCY_TAG')}}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>-0 {{env('CURRENCY_TAG')}}</td>
                        </tr>
                        <tr>
                            <td><strong>Amount Payable</strong></td>

                            <td><strong>
                                    @if(!empty($items->price))

                                    {{$items->price}}

                                    @else
                                    7000
                                    @endif

                                    {{env('CURRENCY_TAG')}}</strong></td>
                        </tr>
                    </table>
                    <div class="form-group submit">
                        <a href="{{ route('frontend.users.order-details.card_details',($itemId->id)) }}" class="btn btn-primary">Pay Now</a>
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
<div class="modal fade" id="add-card-payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Add Card</h5>
            <form method="POST" id="payment-form">
                <div class="add-card-img">
                    <img src="{{asset('assets/images/ATM-Card.png')}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Card Holder Name" name="holder_name" class="form-control">
                </div>
                <div class="input-group card-number-icon">
                    <input type="text" placeholder="Enter Card Number" name="card_number" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="input-group card-date">
                            <input type="text" placeholder="MM" name="month" class="form-control">
                            <input type="text" placeholder="YY" name="year" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group cvv-card">
                            <input type="text" placeholder="CVV" name="cvv" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group submit">
                    <input type="submit" id="pay-button" class="btn btn-primary" value="Add card">
                </div>
            </form>
            <p><a href="javascript:void(0)" class="cancle">Cancel</a></p>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/checkout_assets/app.js')}}"></script>
<script>
    Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);

    function onCardTokenized(event) {
        var csrf_token = "{{ csrf_token() }}";
        var payment_token = event.token;

        $.ajax({
            type: "get",
            url: "{{ route('frontend.users.order-details.order_placed') }}",
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
<script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @elseif(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('warning'))
        toastr.error('{{ Session::get('
            warning ') }}');
        @elseif(Session::has('info'))
        toastr.error('{{ Session::get('
            info ') }}');
        @endif
    });
</script>
@endsection