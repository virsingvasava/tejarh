@extends('frontend.business.includes.web')

@section('pageTitle')
{{ 'Tejarh - Business Address' }}
@endsection


@section('content')
<div class="delivery-order-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Address</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">

            @foreach($userAddressDetail as $key => $detail)
            <div class="col-md-3">
                <div class="delivery-order-address">
                    <p>Shipping to <a href="javascript:void(0)" class="address_data" data-bs-toggle="modal" id="test" data-bs-target="#edit-delivery-order-summary{{$detail->id}}">Change</a></p>
                    <p>{{$detail->name}}</p>
                    <address>{{$detail->address}}</address>
                    <p>Phone: <a href="tel:{{$detail->phone_number}}">{{$detail->phone_number}}</a></p>
                    @if (!empty($params))
                        @if(Auth::user()->role == STORE_ROLE)
                            <a href="javascript:void(0)" data-uid="{{$detail->user_id}}" data-aid="{{$detail->id}}" data-id="{{$params}}"   class="btn generateOrderStore">@lang('frontend-messages.UserAddresses.addressbtn')</a>
                        @else
                            <a href="javascript:void(0)" data-uid="{{$detail->user_id}}" data-aid="{{$detail->id}}" data-id="{{$params}}"   class="btn generateOrder">@lang('frontend-messages.UserAddresses.addressbtn')</a>
                        @endif
                        @else
                        <a href="javascript:void(0)" class="btn">@lang('frontend-messages.UserAddresses.addressbtn')</a>
                    @endif
                </div>
            </div>
            @endforeach
            <div class="col-md-3">
                <div class="delivery-order-address-add" data-bs-toggle="modal" data-bs-target="#add-delivery-order-summary">
                    <img src="{{asset('assets/images/add-address-icon.png')}}">
                    <h5>Add address</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Delivery Order Address -->
@foreach($userAddressDetail as $key => $detail)
<div class="modal fade" id="edit-delivery-order-summary{{$detail->id}}" tabindex="-1" data_attr_id="{{$detail->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
        <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <h5>@lang('frontend-messages.UserAddresses.editaddress.title')</h5>
            <div id="ajax-alert-error-edit" class="alert ajax-alert-error-edit" style="display: none;">
            </div>
            <div id="ajax-alert-edit" class="alert ajax-alert-edit" style="display: none;">
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p class="success_address">{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger ">
                <p>{{ $message }}</p>
            </div>
            @endif

            <form action="javascript:void(0)" id="edit_delivery_address{{$detail->id}}">
                <div class="input-group">
                    <input type="hidden" name="id" value="{{$detail->id}}" class="address_id">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.name')" class="form-control name" name="name" id="name{{$detail->id}}" value="{{ old('name',$detail->name)}}">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.phonenumber')" class="form-control phone_number" name="phone_number" id="phone_number{{$detail->id}}" value="{{ old('phone_number',$detail->phone_number)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.pincode')" class="form-control pincode" name="pincode" id="pincode{{$detail->id}}" value="{{ old( 'pincode',$detail->pincode)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.locality')" class="form-control locality" name="locality" id="locality{{$detail->id}}" value="{{ old('locality',$detail->locality)}}">
                </div>
                <div class="input-group">
                    <textarea class="form-control address" placeholder="@lang('frontend-messages.UserAddresses.placeholder.address')" id="address{{$detail->id}}" name="address">{{ old('address',$detail->address)}}</textarea>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.city')" class="form-control city" id="city{{$detail->id}}" name="city" value="{{ old('city',$detail->city)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.landmark')" class="form-control landmark" id="landmark{{$detail->id}}" name="landmark" value="{{ old('landmark',$detail->landmark)}}">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.alternatephone')" class="form-control alternate_phone" id="alternate_phone{{$detail->id}}" name="alternate_phone" value="{{ old('alternate_phone',$detail->alternate_phone)}}">
                </div>
                <div class="select-address-type">
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type{{$detail->id}}" id="home{{$detail->id}}" value="home" {{ old('address_type', $detail->address_type) == 'home' ? 'checked' : '' }}>
                        <label class="form-check-label" for="home">
                            @lang('frontend-messages.UserAddresses.editaddress.radiobtn1')
                        </label>
                    </div>
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type{{$detail->id}}" id="home{{$detail->id}}" value="work" {{ old('address_type', $detail->address_type) == 'work' ? 'checked' : '' }}>
                        <label class="form-check-label" for="work">
                            @lang('frontend-messages.UserAddresses.editaddress.radiobtn2')
                        </label>
                    </div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn submit_address loader_class" onclick="AddressUpdate(<?php echo $detail->id; ?>)">@lang('frontend-messages.UserAddresses.editaddress.savebtn')</button>
                    <!-- <input type="submit" data_attr_id2="{{$detail->id}}" class="submit_address btn btn-primary" onclick="AddressUpdate(<?php echo $detail->id; ?>)"  value="@lang('frontend-messages.UserAddresses.editaddress.savebtn')"> -->
                </div>
            </form>
            <!-- <p><a href="javascript:void(0)" class="cancle">@lang('frontend-messages.UserAddresses.editaddress.cancelbtn')</a></p> -->
        </div>
    </div>
</div>
@endforeach

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{asset('assets/images/try-tejarg-app.png')}}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>TRY THE TEJARH APP</h2>
                    <p>Buy, sell and find just about anything using the app on your mobile.</p>
                    <ul>
                        <li>
                            <a href="#"><img src="{{asset('assets/images/google-play.png')}}"> </a>
                        </li>
                        <li>
                            <a href="#"><img src="{{asset('assets/images/app-store.png')}}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Delivery Order Address -->
<div class="modal fade" id="add-delivery-order-summary" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserAddresses.title')</h5>
            <div id="ajax-alert-error" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert" class="alert" style="display: none;">
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{route('frontend.business.profile.add_address')}}" enctype="multipart/form-data" method="post" id="business_delivery_address">
                @csrf
                <div class="input-group">
                    <input type="text"  value="{{$user->first_name}}" placeholder="@lang('frontend-messages.UserAddresses.placeholder.name')" class="form-control" name="name">
                </div>
                <div class="input-group">
                    <input type="tel"  value="{{$user->phone_number}}" placeholder="@lang('frontend-messages.UserAddresses.placeholder.phonenumber')" class="form-control" name="phone_number">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.pincode')" class="form-control" name="pincode" id="pincode" val="">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.locality')" class="form-control" name="locality">
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="@lang('frontend-messages.UserAddresses.placeholder.address')" name="address"></textarea>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.city')" class="form-control" name="city">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.landmark')" class="form-control" name="landmark">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.alternatephone')" class="form-control" name="alternate_phone">
                </div>
                <div class="select-address-type">
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type" id="home" value="home" checked>
                        <label class="form-check-label" for="home">
                            @lang('frontend-messages.UserAddresses.placeholder.radiobtn1')
                        </label>
                    </div>
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type" id="work" value="work">
                        <label class="form-check-label" for="work">
                            @lang('frontend-messages.UserAddresses.placeholder.radiobtn2')
                        </label>
                    </div>
                </div>
                <div class="form-group submit">
                    <button style="width:100%" type="submit" class="btn loader_class">@lang('frontend-messages.UserAddresses.savebtn')</button>
                </div>
            </form>
            <!-- <p><a href="javascript:void(0)" class="cancle">@lang('frontend-messages.UserAddresses.cancelbtn')</a></p> -->
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection