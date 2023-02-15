@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User order summary payment' }}
@endsection

@section('content')

    <div class="order-summary-payment-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Delivery & Payment</li>
                        </ol>
                    </nav>
                </div>
              
                <div class="col-md-12">
                    <style>
                        .payment-ss-msg {
                            width: 400px;
                            margin: 0 auto;
                            border: 1px solid #EFEFEF;
                        }
                        .payment-ss-msg p{
                            margin: 0 0 15px 0;
                        }
                    </style>
                    <div class="payment-ss-msg">
                        <div class=""> <p>Payment Successfully Done.</p></div>
                       <div class="form-group submit">
                        <a href="{{ route('frontend.users.site.index') }}" class="btn btn-primary">Continue Shopping</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @elseif(Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('warning'))
            toastr.error('{{ Session::get('warning') }}');
        @elseif(Session::has('info'))
            toastr.error('{{ Session::get('info') }}');
        @endif
    });
</script>
@endsection



