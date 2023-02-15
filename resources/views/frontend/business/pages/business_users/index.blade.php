@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Users'}}
@endsection
@section('content')

<div class="role-listing-position-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page">@lang('business_messages.menu.User')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3">
                <a href="javascript:void(0)" class="btn trans-btn" data-bs-toggle="modal" data-bs-target="#role-listing-position">@lang('business_messages.role.add_user')</a>
            </div>
            <div class="col-md-6">
                @if(Auth::user()->role == STORE_ROLE)
                <a href="{{ route('frontend.store.add-roles.index')}}" class="btn trans-btn">@lang('business_messages.role.role')</a>
                @else
                <a href="{{ route('frontend.business.add-roles.index')}}" class="btn trans-btn">@lang('business_messages.role.role')</a>
                @endif
                @if(Auth::user()->role == STORE_ROLE)
                <a href="{{route('frontend.store.permission.index')}}" class="btn trans-btn">@lang('business_messages.role.Permission')</a>
                @else
                <a href="{{route('frontend.business.permission.index')}}" class="btn trans-btn">@lang('business_messages.role.Permission')</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row grid">
                    @if(!empty($user) && count($user) > 0)
                    @foreach($user as $value)
                    <div class="col-md-4 element-item admin">
                        <div class="role-user">
                            <div class="edit">
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            @if($value['profile_picture'] != '')
                            <img src="{{ asset('assets/users/' . $value['profile_picture']) }}">
                            @else
                            <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/strory-img1.png') }}">
                            @endif
                            <h5>{{$value->name}}</h5>
                            <a href="tel:{{$value->phone_number}}">{{$value->phone_number}}</a>
                            <ul>
                                <li>name: {{$value->first_name}}</li>
                                <li>email: {{$value->email}}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @else

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
                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                    <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
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

<!-- Role-Listing-Position add-->
<div class="modal fade" id="role-listing-position" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('business_messages.role.add_user')</h5>
            <form action="{{route('frontend.business.business_user.store')}}" enctype="multipart/form-data" method="post" id="add_role">
                @csrf
                <input type="hidden" name="business_id" value="{{Auth::user()->id}}">
                <div class="input-group file-upload">
                    <div class="file-upload-div">
                        <input type="file" name="profile_image" onchange="readURL99(this);" id="user_role_profile_image">
                        <img id="blah99" src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/file-upload-icon.png')}}">
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" name="first_name" value="{{old('first_name')}}" placeholder="@lang('business_messages.role.placeholder.enter_first_name')" class="form-control">
                    @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="@lang('business_messages.role.placeholder.enter_last_name')" class="form-control">
                    @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="user_name" value="{{old('user_name')}}" placeholder="@lang('business_messages.role.placeholder.enter_user_name')" class="form-control">
                    @if ($errors->has('user_name'))
                    <span class="text-danger">{{ $errors->first('user_name') }}</span>
                    @endif
                </div>

                <div class="input-group">
                    <input type="text" name="reg_email" value="{{old('reg_email')}}" placeholder="@lang('business_messages.role.placeholder.enter_email')" class="form-control">
                    @if ($errors->has('reg_email'))
                    <span class="text-danger">{{ $errors->first('reg_email') }}</span>
                    @endif
                </div>

                <div class="input-group mobile-number">
                    <div class="ph-code">
                        <select class="form-select" name="phone_code" value="{{old('phone_code')}}">
                            <option selected value="+966">+966</option>
                        </select>
                    </div>
                    <div class="ph-no">
                        <input type="text" id="getPhoneNumber" name="phone_number" placeholder="@lang('business_messages.role.placeholder.enter_phone_number')" class="form-control">
                    </div>
                    <label id="getPhoneNumber-error" class="error" for="getPhoneNumber"></label>
                    @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
                @if(Auth::user()->role == STORE_ROLE)
                <div class="input-group">
                    <select class="form-select" name="role_id">
                        <option value="">@lang('business_messages.role.placeholder.select_role')</option>
                        @foreach (App\Models\Role::orderBy('name', 'ASC')->where('role_status','business_store_user')->get() as $role)
                        <option value="{{$role->id}}" {{$role->role == old('role_id')  ? 'selected' : ''}}>
                            {{$role->name}}
                        </option>
                        @endforeach
                    </select>
                    <label id="role_id-error" class="error" for="role_id"></label>
                    @if ($errors->has('role_id'))
                    <span class="text-danger">{{ $errors->first('role_id') }}</span>
                    @endif
                </div>
                @else
                <div class="input-group">
                    <select class="form-select" name="role_id">
                        <option value="">@lang('business_messages.role.placeholder.select_role')</option>
                        @foreach (App\Models\Role::orderBy('name', 'ASC')->where('role_status','business_user')->get() as $role)
                        <option value="{{$role->id}}" {{$role->role == old('role_id')  ? 'selected' : ''}}>
                            {{$role->name}}
                        </option>
                        @endforeach
                    </select>
                    <label id="role_id-error" class="error" for="role_id"></label>
                    @if ($errors->has('role_id'))
                    <span class="text-danger">{{ $errors->first('role_id') }}</span>
                    @endif
                </div>
                @endif

                <div class="input-group">
                    <select class="form-select" name="country_id" value="{{old('country_id')}}">
                        <option value="">@lang('business_messages.role.placeholder.select_country')</option>
                        @foreach (App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}">
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                    <label id="country_id-error" class="error" for="country_id"></label>
                    @if ($errors->has('country_id'))
                    <span class="text-danger">{{ $errors->first('country_id') }}</span>
                    @endif
                </div>

                <div class="input-group">
                    <select class="form-select" name="state_id" value="{{old('state_id')}}" id="state-dropdown">
                        <option value="" selected>Select State</option>
                    </select>
                    <label id="state_id-error" class="error" for="state_id"></label>
                    @if ($errors->has('state_id'))
                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                    @endif
                </div>

                <div class="input-group">
                    <select class="form-select" name="city_id" value="{{old('city_id')}}" id="city-dropdown">
                        <option value="" selected>Select City</option>
                    </select>
                    <label id="city_id-error" class="error" for="city_id"></label>
                    @if ($errors->has('city_id'))
                    <span class="text-danger">{{ $errors->first('city_id') }}</span>
                    @endif
                </div>
                <div class="input-group password">
                    <input type="password" placeholder="@lang('frontend-messages.Register.user.placeholder.password')" class="form-control" id="sign_up_password" name="password">
                    <i toggle="#sign_up_password" class="fas fa-eye-slash"></i>
                </div>
                <div class="input-group password">
                    <input type="password" placeholder="@lang('frontend-messages.Register.user.placeholder.c_password')" class="form-control" id="confirm_sign_up_password" name="password_confirmation">
                    <i toggle="#confirm_sign_up_password" class="fas fa-eye-slash"></i>
                </div>
                <div class="form-group submit">
                    <input type="submit" class="btn btn-primary" value="@lang('business_messages.role.save')">
                </div>
            </form>
            <!-- <p><a href="javascript:void(0)">@lang('business_messages.role.cancel')</a></p> -->
        </div>
    </div>
</div>

<!-- Role-Listing-Position  edit-->

<!-- Role-Listing-Position view-->
<!-- get states by country Id -->
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/checkout_assets/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>


<!-- get states by country Id -->
<script type="text/javascript">
    if ($("#add_role").length > 0) {
        $("#add_role").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "first_name": {
                    required: true,
                },
                "last_name": {
                    required: true,
                },
                "user_name": {
                    required: true,
                },
                "reg_email": {
                    required: true,
                    email: true,
                    // emailCheck:true,
                },
                "country_code": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                    number: true, // <-- no such method called "matches"!
                    minlength: 10,
                    maxlength: 10
                },
                "city_id": {
                    required: true,
                },
                "state_id": {
                    required: true,
                },
                "country_id": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength: 6,
                },
                "password_confirmation": {
                    required: true,
                    minlength: 6,
                    equalTo: "#sign_up_password"
                }
            },
            messages: {
                "first_name": {
                    required: '@lang("frontend-messages.Register.user.validation.firstname")',
                },
                "last_name": {
                    required: '@lang("frontend-messages.Register.user.validation.lastname")',
                },
                "user_name": {
                    required: '@lang("frontend-messages.Register.user.validation.username")',
                },
                "reg_email": {
                    required: '@lang("frontend-messages.Register.user.validation.email")',
                    email: '@lang("frontend-messages.Register.user.validation.validemail")',
                    // emailCheck:'Please enter valid e-mail address',
                },
                "phone_number": {
                    required: '@lang("frontend-messages.Register.user.validation.phone")',
                    number: '@lang("frontend-messages.Register.user.validation.validnumber")',
                    minlength: '@lang("frontend-messages.Register.user.validation.minlengthnumber")',
                    maxlength: '@lang("frontend-messages.Register.user.validation.maxlengthnumber")'
                },
                "city_id": {
                    required: '@lang("business_messages.register.business_user.validation.location")',
                },
                "state_id": {
                    required: '@lang("business_messages.register.business_user.validation.district")',
                },
                "country_id": {
                    required: '@lang("business_messages.register.business_user.validation.country")',
                },
                "password": {
                    required: '@lang("frontend-messages.Register.user.validation.password")',
                    minlength: '@lang("frontend-messages.Register.user.validation.minlengthpassword")',
                },
                "password_confirmation": {
                    required: '@lang("frontend-messages.Register.user.validation.c_password")',
                    minlength: '@lang("frontend-messages.Register.user.validation.minlengthc_password")',
                    equalTo: '@lang("frontend-messages.Register.user.validation.passwordequal")',
                }
            },
            submitHandler: function(form) {
                var $this = $('#register_form .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#register_form .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formdata = new FormData(document.getElementById("register_form"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.users.site.register') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            $('#ajax-alert-reg').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                document.getElementById("register_form").reset();
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 2000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.Register.buttontext")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                            });

                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('@lang("frontend-messages.Register.errormsg.msg")');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = '@lang("frontend-messages.Register.buttontext")';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="state_id"]').append('<option value="">Select State</option>');
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
                            '<option value="">Select State</option>');
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
        $('select[name="city_id"]').append('<option value="">Select City</option>');
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
                            '<option value="">Select City</option>');
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


    /* Business store expired date validation */
    function date_of_expiry() {
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var minDate = year + '-' + month + '-' + day;

            $('.date_of_expiry').attr('min', minDate);
        });
    }
</script>
@endsection