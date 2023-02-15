@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Edit-Store'}} 
@endsection
@section('content')
<div class="add-store-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.add_store.edit_store')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <form action="{{route('frontend.business.add-store.update')}}" enctype="multipart/form-data" method="post" id="add_store">
         @csrf
         <input type="hidden" name="id" value="{{$storeData->id}}">

            <div class="row">
                <div class="col-md-12">
                    <div class="input-group form-check">
                        <input class="form-check-input" type="checkbox" value="" id="same-as-business" checked>
                        <label class="form-check-label" for="same-as-business">
                            @lang('business_messages.add_store.same_as_business')
                        </label>
                    </div>                              
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="store_name" value="{{$storeData->store_name}}" placeholder="@lang('business_messages.add_store.validation.store_name')" class="form-control">
                        @if ($errors->has('store_name'))
                            <span class="text-danger">{{ $errors->first('store_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group location-icon">
                        <input type="text" name="store_location" value="{{$storeData->store_location}}" placeholder="@lang('business_messages.add_store.validation.location')" class="form-control">
                        @if ($errors->has('store_location'))
                        <span class="text-danger">{{ $errors->first('store_location') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" name="country_id" id="country-dropdown" data-selected="{{ $storeData->country_id }}">
                            <option value="" selected>@lang('business_messages.add_store.validation.country')</option>
                            @foreach (App\Models\Country::all() as $country) 
                            <option value="{{$country->id}}" {{$country->id == $storeData->country_id  ? 'selected' : ''}}>
                                {{$country->name}}
                            </option>
                            @endforeach
                        </select>      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">    
                        <select class="form-select state-dropdown" name="state_id" id="state-dropdown" data-selected="{{ $storeData->state_id }}">
                           @foreach (App\Models\State::all() as $state) 
                            <option value="{{$state->id}}" {{$state->id == $storeData->state_id  ? 'selected' : ''}}>
                                {{$state->name}}
                            </option>
                           @endforeach
                        </select>               
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group"> 
                        <select class="form-select city-dropdown" name="city_id" id="city-dropdown" data-selected="{{ $storeData->city_id }}"> 
                            @foreach (App\Models\City::all() as $city) 
                                <option value="{{$city->id}}" {{$city->id == $storeData->city_id  ? 'selected' : ''}}>
                                    {{$city->name}}
                                </option>
                           @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group file-upload-icon">
                        <input type="file" name="shop_sign_file" value="{{old('shop_sign_file')}}" placeholder="@lang('business_messages.add_store.validation.shop_sign')" class="form-control">
                        <h5>
                        @php 
                           $file1 = $storeData->shop_sign_file
                        @endphp 
                        @if(!empty($file1))
                            {{$storeData->shop_sign_file}}
                        @else 
                        @lang('business_messages.add_store.validation.shop_sign_file')
                        @endif
                        </h5>
                        @if ($errors->has('shop_sign_file'))
                            <span class="text-danger">{{ $errors->first('shop_sign_file') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group file-upload-icon">
                        <input type="file" name="store_logo_file" value="{{old('store_logo_file')}}" placeholder="@lang('business_messages.add_store.validation.store_logo')" class="form-control">
                       
                        <h5>
                        @php 
                           $file2 = $storeData->store_logo_file
                        @endphp 
                        @if(!empty($file2))
                            {{$storeData->store_logo_file}}
                        @else 
                        @lang('business_messages.add_store.validation.store_logo_file')
                        @endif
                        </h5>
                        @if ($errors->has('store_logo_file'))
                            <span class="text-danger">{{ $errors->first('store_logo_file') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mobile-number">
                        <div class="ph-code">
                            <select class="form-select" name="phone_code">
                                <option selected>+91</option>
                                <option value="1">+1</option>
                                <option value="2">+11</option>
                                <option value="3">+33</option>
                            </select>
                        </div>
                        <div class="ph-no">
                            <input type="tel" name="phone_number" value="{{$storeData->phone_number}}" placeholder="@lang('business_messages.add_store.validation.store_phone_number')" class="form-control">
                            @if ($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                        <label id="getPhoneNumber-error" class="error" for="getPhoneNumber"></label>
                    </div>
                </div>  

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="number"value="{{$storeData->working_hours}}" name="working_hours"  placeholder="@lang('business_messages.profile.edit.working_hours')" class="form-control">
                    </div>
                 </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="website" value="{{$storeData->website}}" placeholder="@lang('business_messages.add_store.validation.website')" class="form-control">
                        @if ($errors->has('website'))
                            <span class="text-danger">{{ $errors->first('website') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" name="branch_id">
                            <option value="" selected>@lang('business_messages.add_store.validation.branch')</option>
                            @if (!empty($branches)) 
                                @foreach($branches as $key => $branch)
                                <option value="{{$branch->id}}" {{$branch->id == $storeData->branch_id  ? 'selected' : ''}} >{{$branch->name}}</option>
                                @endforeach
                            @endif

                        </select>
                        <label id="branch_id-error" class="error" for="branch_id"></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" name="store_type_id">
                            <option value="">@lang('business_messages.add_store.validation.store_type_id')</option>
                            @if(!empty($storeTypes) && count($storeTypes))
                                @foreach($storeTypes as $key => $value)
                                    @if (old('store_type_id') == $value->id)
                                        <option value="{{ $value->id }}" selected>{{  $value->name }}</option>
                                    @else
                                        <option value="{{$value->id}}" {{$value->id == $storeData->store_type_id  ? 'selected' : ''}} >{{$value->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <label id="store_type_id-error" class="error" for="store_type_id"></label>
                        @if ($errors->has('store_type_id'))
                            <span class="text-danger">{{ $errors->first('store_type_id') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group submit col-md-4">
                        <input type="submit" class="btn btn-primary" value="@lang('business_messages.add_store.save')">
                    </div>
                </div>
            </div>
        </form>
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
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>

    <!-- get states by country Id -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="state_id"]').append('<option value="">@lang("business_messages.add_store.validation.state")</option>');
            $('select[name="state_id"]').niceSelect('update');
            $('select[name="country_id"]').on('change', function() {
                var country_id = this.value;
                if (country_id) {
                    $.ajax({
                        url: '{{ route("frontend.business.register.getState") }}',
                        type: "POST",
                        data: {
                            country_id: country_id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('select[name="state_id"]').empty();
                            $('select[name="state_id"]').append(
                                '<option value="">@lang("business_messages.add_store.validation.state")</option>');
                            $.each(response.states, function(key, value) {
                                $('select[name="state_id"]').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                            $('select[name="state_id"]').niceSelect('update');
                        }
                    });
                } else {
                    $('select[name="state_id"]').empty();
                }
            });
        });
    </script>
    <!-- get cities by state id -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="city_id"]').append('<option value="">@lang("business_messages.add_store.validation.city")</option>');
            $('select[name="city_id"]').niceSelect('update');
            $('select[name="state_id"]').on('change', function() {
                var state_id = this.value;
                if (state_id) {
                    $.ajax({
                        url: '{{ route("frontend.business.register.getCity") }}',
                        type: "POST",
                        data: {
                            state_id: state_id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append(
                                '<option value="">@lang("business_messages.add_store.validation.city")</option>');
                            $.each(response.cities, function(key, value) {
                                $('select[name="city_id"]').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                            $('select[name="city_id"]').niceSelect('update');
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                }
            });
        });
    </script>
@endsection
	