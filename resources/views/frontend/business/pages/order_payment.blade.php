@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - Business - Payment Type' }}
@endsection
@section('content')
<div class="order-summary-payment-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delivery & Payment</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-9">
                <div class="left-order-summary-payment">
                    <div class="summary-accordion">
                        @if(!empty($checkPaymentMode))
                        <form id="my_form" action="" method="POST">
                            @csrf
                            <div class="set">
                                <input type="radio" data-value="debit/credit" class="cardSelect form-check-input" data-card="debit/credit" onclick="submit_form()" id="1" {{ ($checkPaymentMode->payment_mode=="debit/credit")? "checked" : "" }}> <label for="1">Credit/Debit Card</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="cod" class="cardSelect form-check-input" data-card="cod" onclick="submit_form()" id="2" {{ ($checkPaymentMode->payment_mode=="cod")? "checked" : "" }}> <label for="2">Cash on delivery</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="google_pay" class="cardSelect form-check-input" data-card="google_pay" onclick="submit_form()" id="3" {{ ($checkPaymentMode->payment_mode=="google_pay")? "checked" : "" }}><label for="3">Google Pay</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="apple_pay" class="cardSelect form-check-input" data-card="apple_pay" onclick="submit_form()" id="4" {{ ($checkPaymentMode->payment_mode=="apple_pay")? "checked" : "" }}><label for="4">Apple Pay</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="wallet" class="cardSelect form-check-input" data-card="wallet" onclick="submit_form()" id="5" {{ ($checkPaymentMode->payment_mode=="wallet")? "checked" : "" }}><label for="5">Wallet</label>
                            </div>
                        </form>
                        @else
                        <form id="my_form" action="" method="POST">
                            @csrf
                            <div class="set">
                                <input type="radio" data-value="debit/credit" class="cardSelect form-check-input" data-card="debit/credit" onclick="submit_form()" id="1"><label for="1">Credit/Debit Card</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="cod" class="cardSelect form-check-input" data-card="cod" onclick="submit_form()" id="2"><label for="2">Cash on delivery</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="google_pay" class="cardSelect form-check-input" data-card="google_pay" onclick="submit_form()" id="3"><label for="3">Google Pay</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="apple_pay" class="cardSelect form-check-input" data-card="apple_pay" onclick="submit_form()" id="4"><label for="4">Apple Pay</label>
                            </div>
                            <div class="set">
                                <input type="radio" data-value="wallet" class="cardSelect form-check-input" data-card="wallet" onclick="submit_form()" id="5"><label for="5">Wallet</label>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="right-order-summary-payment">
                    <table>
                        <tr>
                            <td colspan="2"><strong>Product Details</strong></td>
                        </tr>
                        @foreach($itemsArray as $key => $value)
                        <tr>
                            <td>Name</td>
                            <td>{{ $value['itemsList']['what_are_you_selling'] }} </td>
                        </tr>
                        <tr>
                            <td>Product SKU</td>
                            <td>{{ $value['itemsList']['sku'] }} </td>
                        </tr>
                        <tr>
                            <td>Item price</td>
                            <td>{{ $value['cartList']['price'] }} {{ env('CURRENCY_TAG') }} x {{ $value['cartList']['quantity'] }}</td>
                        </tr>

                        <tr class="bdr-op">
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        @endforeach
                        <tr>
                            <td>Shipping Charge</td>
                            <td>+ {{ $total_shipping }} {{env('CURRENCY_TAG')}} </td>
                        </tr>
                        <?php
                            $getVat = App\Models\VatPrice::first();
                            $vatPrice = $getVat->vat_price;
                            $vat = (($total_amount/100) * $vatPrice);
                            $totalPrice = $total_amount + $vat;
                            $total_amount_result = $totalPrice;
                            $roundAmount = round($total_amount_result);
                        ?>
                        <tr>
                            <td>Vat Charge (%)</td>
                            <td>+ {{ $vatPrice }}</td>
                        </tr>
                        <tr>
                            <td><strong>Amount Payable</strong></td>
                            <td><strong>{{ round($total_amount_result) }} {{ env('CURRENCY_TAG') }}</strong></td>
                        </tr>
                    </table>
                    <div class="form-group submit">
                        @if(!empty($checkPaymentMode))
                        @if($checkPaymentMode['payment_mode'] === 'debit/credit')
                        <input type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-card-payment" value="Pay Now">
                        @elseif($checkPaymentMode['payment_mode'] === 'google_pay')
                        <div id="container-google"></div>
                        @elseif($checkPaymentMode['payment_mode'] === 'cod')
                        <a href="{{ route('frontend.business.order-details.orderPaymentCOD') }}" class="btn btn-primary">Placed Order</a>
                        @elseif($checkPaymentMode['payment_mode'] === 'apple_pay')
                        <input type="submit" class="btn btn-primary" value="Pay Now">
                        @elseif($checkPaymentMode['payment_mode'] === 'wallet')
                            @if($walletTotal < $roundAmount)
                            <input type="submit" class="btn btn-primary" value="Insuffient Amount">
                            @else
                            <a href="{{ route('frontend.business.order-details.order_wallet') }}" class="btn btn-primary">Pay Now</a>
                            @endif
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-card-payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Enter Card Details</h5>
            <form action="{{ route('frontend.business.order-details.order_placed') }}" method="POST" id="paymentCardForm">
                @csrf
                <div class="add-card-img">
                    <?php
                        $getVat = App\Models\VatPrice::first();
                        $vatPrice = $getVat->vat_price;
                        $vat = (($total_amount/100) * $vatPrice);
                        $totalPrice = $total_amount + $vat;
                        $total_amount_result = $totalPrice;
                    ?>
                    <input type="hidden" id="vatPrice" name="vatPrice" value="{{$vatPrice}}">
                    <input type="hidden" id="total_amount" name="total_amount" value="{{round($total_amount_result)}}">
                    <input type="text" id="grand_total_of_form" value="{{round($total_amount_result)}} {{ env('CURRENCY_TAG') }}" class="form-control" readonly>
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
                    <button style="width:100%" type="submit" class="btn" id="getTotalAmount" value="Make Payment">Pay Now</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/cart_css.css') }}">
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
<script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
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
<script>
    $(document).ready(function() {
        $('.cardSelect').on('click', function() {
            var card_types = $(this).attr('data-card');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route("frontend.business.order-details.orderPaymentSelect") }}',
                data: {
                    'card_types': card_types,
                    _token: token
                },
                success: function(data) {
                    submit_form();
                },
            });
        });
    });

    function submit_form() {
        var form = document.getElementById("my_form");
        form.submit();
        location.reload();
    }
</script>
<script type="text/javascript">
    /**
     * Define the version of the Google Pay API referenced when creating your
     * configuration
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
     */
    const baseRequest = {
        apiVersion: 2,
        apiVersionMinor: 0
    };

    /**
     * Card networks supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm card networks supported by your site and gateway
     */
    const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "VISA"];

    /**
     * Card authentication methods supported by your site and your gateway
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     * @todo confirm your processor supports Android device tokens for your
     * supported card networks
     */
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

    /**
     * Identify your gateway and your site's gateway merchant identifier
     *
     * The Google Pay API response will return an encrypted payment method capable
     * of being charged by a supported gateway after payer authorization
     *
     * @todo check with your gateway on the parameters to pass
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
     */
    const tokenizationSpecification = {
        type: 'PAYMENT_GATEWAY',
        parameters: {
            // 'gateway': 'example',
            // 'gatewayMerchantId': 'exampleGatewayMerchantId'

            'gateway': 'checkoutltd',
            'gatewayMerchantId': 'BCR2DN4TQTPLFDA5'
        }
    };

    /**
     * Describe your site's support for the CARD payment method and its required
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const baseCardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: allowedCardAuthMethods,
            allowedCardNetworks: allowedCardNetworks
        }
    };

    /**
     * Describe your site's support for the CARD payment method including optional
     * fields
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
     */
    const cardPaymentMethod = Object.assign({},
        baseCardPaymentMethod, {
            tokenizationSpecification: tokenizationSpecification
        }
    );

    /**
     * An initialized google.payments.api.PaymentsClient object or null if not yet set
     *
     * @see {@link getGooglePaymentsClient}
     */
    let paymentsClient = null;

    /**
     * Configure your site's support for payment methods supported by the Google Pay
     * API.
     *
     * Each member of allowedPaymentMethods should contain only the required fields,
     * allowing reuse of this base request when determining a viewer's ability
     * to pay and later requesting a supported payment method
     *
     * @returns {object} Google Pay API version, payment methods supported by the site
     */
    function getGoogleIsReadyToPayRequest() {
        return Object.assign({},
            baseRequest, {
                allowedPaymentMethods: [baseCardPaymentMethod]
            }
        );
    }

    /**
     * Configure support for the Google Pay API
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
     * @returns {object} PaymentDataRequest fields
     */
    function getGooglePaymentDataRequest() {
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
        paymentDataRequest.merchantInfo = {
            // @todo a merchant ID is available for a production environment after approval by Google
            // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
            // merchantId: '01234567890123456789',
            merchantName: 'Example Merchant'
        };

        paymentDataRequest.callbackIntents = ["SHIPPING_ADDRESS", "SHIPPING_OPTION", "PAYMENT_AUTHORIZATION"];
        paymentDataRequest.shippingAddressRequired = true;
        paymentDataRequest.shippingAddressParameters = getGoogleShippingAddressParameters();
        paymentDataRequest.shippingOptionRequired = true;

        return paymentDataRequest;
    }

    /**
     * Return an active PaymentsClient or initialize
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
     * @returns {google.payments.api.PaymentsClient} Google Pay API client
     */
    function getGooglePaymentsClient() {
        if (paymentsClient === null) {
            paymentsClient = new google.payments.api.PaymentsClient({
                environment: "TEST",
                merchantInfo: {
                    merchantName: "Example Merchant",
                    merchantId: "01234567890123456789"
                },
                paymentDataCallbacks: {
                    onPaymentAuthorized: onPaymentAuthorized,
                    onPaymentDataChanged: onPaymentDataChanged
                }
            });
        }
        return paymentsClient;
    }


    function onPaymentAuthorized(paymentData) {
        return new Promise(function(resolve, reject) {

            // handle the response
            processPayment(paymentData)
                .then(function() {
                    resolve({
                        transactionState: 'SUCCESS'
                    });
                    window.location.href = "{{ url('/business/order-details/order-successfull') }}";
                })
                .catch(function() {
                    resolve({
                        transactionState: 'ERROR',
                        error: {
                            intent: 'PAYMENT_AUTHORIZATION',
                            message: 'Insufficient funds',
                            reason: 'PAYMENT_DATA_INVALID'
                        }
                    });
                });

        });
    }

    /**
     * Handles dynamic buy flow shipping address and shipping options callback intents.
     *
     * @param {object} itermediatePaymentData response from Google Pay API a shipping address or shipping option is selected in the payment sheet.
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#IntermediatePaymentData|IntermediatePaymentData object reference}
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentDataRequestUpdate|PaymentDataRequestUpdate}
     * @returns Promise<{object}> Promise of PaymentDataRequestUpdate object to update the payment sheet.
     */
    function onPaymentDataChanged(intermediatePaymentData) {
        return new Promise(function(resolve, reject) {

            let shippingAddress = intermediatePaymentData.shippingAddress;
            let shippingOptionData = intermediatePaymentData.shippingOptionData;
            let paymentDataRequestUpdate = {};

            if (intermediatePaymentData.callbackTrigger == "INITIALIZE" || intermediatePaymentData.callbackTrigger == "SHIPPING_ADDRESS") {
                if (shippingAddress.administrativeArea == "NJ") {
                    paymentDataRequestUpdate.error = getGoogleUnserviceableAddressError();
                } else {
                    paymentDataRequestUpdate.newShippingOptionParameters = getGoogleDefaultShippingOptions();
                    let selectedShippingOptionId = paymentDataRequestUpdate.newShippingOptionParameters.defaultSelectedOptionId;
                    paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(selectedShippingOptionId);
                }
            } else if (intermediatePaymentData.callbackTrigger == "SHIPPING_OPTION") {
                paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(shippingOptionData.id);
            }

            resolve(paymentDataRequestUpdate);
        });
    }

    /**
     * Helper function to create a new TransactionInfo object.

     * @param string shippingOptionId respresenting the selected shipping option in the payment sheet.
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
     * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
     */
    function calculateNewTransactionInfo(shippingOptionId) {
        let newTransactionInfo = getGoogleTransactionInfo();

        let shippingCost = getShippingCosts()[shippingOptionId];
        newTransactionInfo.displayItems.push({
            type: "LINE_ITEM",
            label: "Shipping cost",
            price: shippingCost,
            status: "FINAL"
        });

        let totalPrice = 0.00;
        newTransactionInfo.displayItems.forEach(displayItem => totalPrice += parseFloat(displayItem.price));
        newTransactionInfo.totalPrice = totalPrice.toString();

        return newTransactionInfo;
    }

    /**
     * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
     *
     * Display a Google Pay payment button after confirmation of the viewer's
     * ability to pay.
     */
    function onGooglePayLoaded() {
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
            .then(function(response) {
                if (response.result) {
                    addGooglePayButton();
                    // @todo prefetch payment data to improve performance after confirming site functionality
                    // prefetchGooglePaymentData();
                }
            })
            .catch(function(err) {
                // show error in developer console for debugging
                console.error(err);
            });
    }

    /**
     * Add a Google Pay purchase button alongside an existing checkout button
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
     * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
     */
    function addGooglePayButton() {
        const paymentsClient = getGooglePaymentsClient();
        const button = paymentsClient.createButton({
            onClick: onGooglePaymentButtonClicked
        });
        document.getElementById('container-google').appendChild(button);
    }

    /**
     * Provide Google Pay API with a payment amount, currency, and amount status
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
     * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
     */
    function getGoogleTransactionInfo() {
        return {
            displayItems: [{
                    label: "Subtotal",
                    type: "SUBTOTAL",
                    price: <?php echo (json_encode((string)$roundAmount)); ?>
                },
                {
                    label: "Tax",
                    type: "TAX",
                    price: "0.00",
                }
            ],
            countryCode: 'SA',
            currencyCode: "SAR",
            totalPriceStatus: "FINAL",
            totalPrice: <?php echo (json_encode((string)$roundAmount)); ?>,
            totalPriceLabel: "Total"
        };
    }

    /**
     * Provide a key value store for shippping options.
     */
    function getShippingCosts() {
        return {
            "shipping-001": "0.00",
            "shipping-002": "1.99",
            "shipping-003": "10.00"
        }
    }

    /**
     * Provide Google Pay API with shipping address parameters when using dynamic buy flow.
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ShippingAddressParameters|ShippingAddressParameters}
     * @returns {object} shipping address details, suitable for use as shippingAddressParameters property of PaymentDataRequest
     */
    function getGoogleShippingAddressParameters() {
        return {
            phoneNumberRequired: true
        };
    }

    /**
     * Provide Google Pay API with shipping options and a default selected shipping option.
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ShippingOptionParameters|ShippingOptionParameters}
     * @returns {object} shipping option parameters, suitable for use as shippingOptionParameters property of PaymentDataRequest
     */
    function getGoogleDefaultShippingOptions() {
        return {
            defaultSelectedOptionId: "shipping-001",
            shippingOptions: [{
                    "id": "shipping-001",
                    "label": "Free: Standard shipping",
                    "description": "Free Shipping delivered in 5 business days."
                },
                {
                    "id": "shipping-002",
                    "label": "$1.99: Standard shipping",
                    "description": "Standard shipping delivered in 3 business days."
                },
                {
                    "id": "shipping-003",
                    "label": "$10: Express shipping",
                    "description": "Express shipping delivered in 1 business day."
                },
            ]
        };
    }

    /**
     * Provide Google Pay API with a payment data error.
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentDataError|PaymentDataError}
     * @returns {object} payment data error, suitable for use as error property of PaymentDataRequestUpdate
     */
    function getGoogleUnserviceableAddressError() {
        return {
            reason: "SHIPPING_ADDRESS_UNSERVICEABLE",
            message: "Cannot ship to the selected address",
            intent: "SHIPPING_ADDRESS"
        };
    }

    /**
     * Prefetch payment data to improve performance
     *
     * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
     */
    function prefetchGooglePaymentData() {
        const paymentDataRequest = getGooglePaymentDataRequest();
        // transactionInfo must be set but does not affect cache
        paymentDataRequest.transactionInfo = {
            totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
            currencyCode: 'SAR'
        };
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.prefetchPaymentData(paymentDataRequest);
    }



    /**
     * Show Google Pay payment sheet when Google Pay payment button is clicked
     */
    function onGooglePaymentButtonClicked() {
        const paymentDataRequest = getGooglePaymentDataRequest();
        paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.loadPaymentData(paymentDataRequest);
    }

    /**
     * Process payment data returned by the Google Pay API
     *
     * @param {object} paymentData response from Google Pay API after user approves payment
     * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
     */
    function processPayment(paymentData) {
        return new Promise(function(resolve, reject) {
            setTimeout(function() {
                // show returned data in developer console for debugging
                console.log(paymentData);
                // @todo pass payment token to your gateway to process payment
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;
                var token = "{{ csrf_token() }}";
                var total_amount = <?php echo (json_encode((string)$total_amount)); ?>;
                $.ajax({
                    url: "{{ route('frontend.business.order-details.orderPaymentgpay') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'paymentData': paymentData,
                        _token: token,
                        total_amount: total_amount
                    },
                    success: function(data) {
                        console.log(data.data.count);
                        if (data.data.count > 1) {
                            window.location.href = "{{ url('/business/order-details/order-successfull') }}";
                        }
                    },
                });
                resolve({});
            }, 3000);
        });
    }
</script>
@endsection