@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Add Money'}} 
@endsection
@section('content')
    <div class="order-summary-payment-wrapper add-money-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item" aria-current="page">My Account</li>
                            <li class="breadcrumb-item" aria-current="page">My Wallet</li>
                            <li class="breadcrumb-item active" aria-current="page">Add Money</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="add-money-wrapper">
                        <form>
                            <div class="input-group add-money-input">
                                <label>Add Money</label>
                                <input type="text" placeholder="Add Money" class="form-control">
                            </div>
                            <div class="add-money-list">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefault" name="add-money">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        $1000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckChecked" name="add-money">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $1500
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckChecked" name="add-money">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $2000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefault" name="add-money">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        $2500
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckChecked" name="add-money">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $3000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckChecked" name="add-money">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $3500
                                    </label>
                                </div>
                            </div>
                            <div class="form-group submit">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="left-order-summary-payment">
                        <div class="summary-accordion">
                            <div class="set">
                                <a href="#">Credit Card</a>
                                <div class="content">
                                    <div class="payment-options">
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="add-card" data-bs-toggle="modal" data-bs-target="#add-card-payment">Add Card</a>
                                </div>
                            </div>
                            <div class="set">
                                <a href="#">Debit Card</a>
                                <div class="content">
                                    <div class="payment-options">
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="add-card" data-bs-toggle="modal" data-bs-target="#add-card-payment">Add Card</a>
                                </div>
                            </div>
                            <div class="set">
                                <a href="#">Net Banking</a>
                                <div class="content">
                                    <div class="payment-options">
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                </div>
                                                <div class="card-number">
                                                    <img src="assets/images/img/icon/visa-card.png">
                                                    <p>**** **** **** 5967</p>
                                                </div>
                                                <div class="card-holder-name">
                                                    <p>Bashar Qasem</p>
                                                </div>
                                                <div class="card-cvv">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="CVV" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="add-card" data-bs-toggle="modal" data-bs-target="#add-card-payment">Add Card</a>
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
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection