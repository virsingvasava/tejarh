@include('frontend.users.includes.head')

<body>
    <!-- Preloader -->
    <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="pre-load">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    @include('frontend.users.includes.header')
    <!-- end header -->

    @yield('content')

    <!-- loginModal -->
    <div class="modal fade" id="loginModal_old" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#"><img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.LoginUser.heading')</h5>
                <p>@lang('frontend-messages.LoginUser.text')</p>
                <div id="ajax-alert-error-login" class="alert" style="display: none;">
                </div>
                <div id="ajax-alert-login" class="alert" style="display: none;">
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
                <form id="login_form" action="javascript:void(0)" name="login_form">
                    <div class="input-group">
                        <input type="text" name="username" placeholder="@lang('frontend-messages.LoginUser.pleaceholdername')" id="username" class="form-control">
                    </div>
                    <div class="input-group password">
                        <input type="password"  autocomplete="on" placeholder="@lang('frontend-messages.LoginUser.pleaceholderpassword')" name="password" class="form-control" id="log_in_password"><i toggle="#log_in_password" class="fas fa-eye-slash"></i>
                    </div>
                    <div class="forgot-password-div">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked>
                            <label class="form-check-label" for="flexCheckChecked1">
                                @lang('frontend-messages.LoginUser.remember')
                            </label>
                        </div>
                        <span class="text-danger" id="nameError"></span>
                        <div class="input-group">
                            <a href="javascript:void(0)" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">@lang('frontend-messages.LoginUser.passwordforgot')</a>
                        </div>
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.LoginUser.buttontext')</button>
                    </div>
                </form>
                <div class="sign-in-with">
                    <p>@lang('frontend-messages.LoginUser.dectext') <a href="#" id="sign-up" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signUpModal">@lang('frontend-messages.LoginUser.buttonreg')</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- loginModal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#"><img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" id="clearLoginForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.LoginUser.heading')</h5>
                <p>@lang('frontend-messages.LoginUser.text')</p>

                <form action="{{ route('frontend.users.site.users_login') }}" method="post" id="login_form_or">
                    @csrf
                    <div class="input-group">
                        {{-- <input type="text" name="username" placeholder="@lang('frontend-messages.LoginUser.pleaceholdername')" id="username" class="form-control"> --}}
                        {{-- <input id="username" 
                               type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               name="username" 
                               value="{{ old('username') }}" 
                               placeholder="@lang('frontend-messages.LoginUser.pleaceholdername')"
                               id="checkUsernameEmail">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                        <input id="checkUsernameEmail2" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="@lang('frontend-messages.LoginUser.pleaceholdername')" value="{{ old('username') }}">

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group password">
                        <div class="pwd">
                            {{-- <input type="password" placeholder="@lang('frontend-messages.LoginUser.pleaceholderpassword')" name="password" class="form-control" id="log_in_password"><i toggle="#log_in_password" class="fas fa-eye-slash"></i> --}}
                            <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.LoginUser.pleaceholderpassword')" name="password" class="form-control" id="log_in_password_news"><i toggle="#log_in_password_news" class="fa fa-fw fa-eye field_icon toggle-password"></i>
                        </div>
                        <label id="log_in_password-error" class="error" for="log_in_password_news"></label>
                    </div>
                    <div class="forgot-password-div">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">@lang('frontend-messages.LoginUser.remember')
                            </label>
                        </div>
                        <span class="text-danger" id="nameError"></span>
                        <div class="input-group">
                            <a href="javascript:void(0)" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">@lang('frontend-messages.LoginUser.passwordforgot')</a>
                        </div>
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.LoginUser.buttontext')</button>
                    </div>
                </form>
                <div class="sign-in-with">
                    <p>@lang('frontend-messages.LoginUser.dectext') <a href="#" id="sign-up" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signUpModal">@lang('frontend-messages.LoginUser.buttonreg')</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- forgotPasswordModal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" id="clearForgotPasswordForm"  class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.Forgot.title')</h5>
                <p>@lang('frontend-messages.Forgot.content')</p>
                {{-- <div id="ajax-alert-error-forgot" class="alert" style="display: none;">
                </div>
                <div id="ajax-alert-forgot" class="alert" style="display: none;">
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
                @endif --}}
                <form id="forgotpassword_form" name="forgotpassword_form" action="javascript:void(0)">
                    @csrf
                    <div class="input-group">
                        <input type="email" id="forgot_email" placeholder="@lang('frontend-messages.Forgot.placeholder.user/email')" class="form-control" name="forgot_email">
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.Forgot.button')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- resetPasswordModal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.ResetPassword.title')</h5>
                <p>@lang('frontend-messages.ResetPassword.content')</p>
                {{-- <div id="ajax-alert-error-resetpassword" class="alert" style="display: none;">
                </div>
                <div id="ajax-alert-resetpassword" class="alert" style="display: none;">
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
                @endif --}}
                <form action="javascript:void(0)" id="reset_password_form" name="reset_password_form" class="">
                    @if (!empty($_REQUEST['reset_password/?token']))
                    <input type="hidden" id="token" name="token" value="@php print_r($_REQUEST['reset_password/?token']);  @endphp">
                    @endif
                    <div class="input-group">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.ResetPassword.placeholder.password')" id="reset_password1" class="form-control" name="reset_password">
                    </div>
                    <div class="input-group">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.ResetPassword.placeholder.c_password')" class="form-control" id="reset_password_confirm1" name="reset_password_confirm">
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.ResetPassword.button')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- resetPasswordModal New-->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" id="clearResetPasswordForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.ResetPassword.title')</h5>
                <p>@lang('frontend-messages.ResetPassword.content')</p>
                <form action="{{route('frontend.users.site.resetPassword')}}" id="resetPassword_form" method="post">
                    @csrf
                    @if (!empty($_REQUEST['reset_password/?token']))
                    <input type="hidden" id="token" name="token" value="@php print_r($_REQUEST['reset_password/?token']);  @endphp">
                    @endif
                    <div class="input-group">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.ResetPassword.placeholder.password')" id="reset_password" class="form-control" name="reset_password">
                    </div>
                    <div class="input-group">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.ResetPassword.placeholder.c_password')" class="form-control" id="reset_password_confirm" name="reset_password_confirm">
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.ResetPassword.button')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- otpScreenModal -->
    <div class="modal fade" id="otpScreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" id="popupCloseReload" class="btn-close popup-close popupCloseReload" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.Verification.title')</h5>
                <p>@lang('frontend-messages.Verification.content')</p>
                {{-- <div id="ajax-alert-error-verify" class="alert" style="display: none;">
                </div>
                <div id="ajax-alert-verify" class="alert" style="display: none;">
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
                @endif --}}
                <form id="verifyotp_form" action="javascript:void(0)" name="verifyotp_form">
                    <div class="otpScreenList" name="otpinput">

                        @if (!empty($_REQUEST['resetpassword/?token']))
                        <input type="hidden" id="token" name="token" value="@php print_r($_REQUEST['resetpassword/?token']);  @endphp">
                        @endif
                        <input class="form-control" maxlength="1" id="chars[1]" type="text" name="otp1" id="otp1" />
                        <input class="form-control" maxlength="1" id="chars[2]" type="text" name="otp2" id="otp2" />
                        <input class="form-control" maxlength="1" id="chars[3]" type="text" name="otp3" id="otp3" />
                        <input class="form-control" maxlength="1" id="chars[4]" type="text" name="otp4" id="otp4" />
                        <input class="form-control" maxlength="1" id="chars[5]" type="text" name="otp5" id="otp5" />
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="btn loader_class">@lang('frontend-messages.Verification.button')</button>
                        <!-- <input type="submit" class="btn btn-primary" value="@lang('frontend-messages.Verification.button')"> -->
                        <button type="button" class="input-btn hidden-btn" data-bs-toggle="modal" data-bs-target="#resetPasswordModal" data-bs-dismiss="modal">Reset Passord</button>
                    </div>
                </form>
                <p>@lang('frontend-messages.Verification.bottomtext')</p>
                <form id="resetotp_form" action="javascript:void(0)" name="verifyotp_form">
                    @if (!empty($_REQUEST['resetpassword/?token']))
                    <input type="hidden" id="token" name="token" value="@php print_r($_REQUEST['resetpassword/?token']);  @endphp">
                    @endif
                    <a href="javascript:void(0)">@lang('frontend-messages.Verification.resend')</a>
                </form>
            </div>
        </div>
    </div>

    <!-- signUpModal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="javascript:void(0)">
                        <img src="{{ asset('assets/images/tejarh-word-logo.png') }}" alt="tejarh-white-logo">
                    </a>
                    <button type="button" id="popupCloseReload" class="btn-close popup-close popupCloseReload" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5>@lang('frontend-messages.Register.heading')</h5>
                <p>@lang('frontend-messages.Register.text')</p>
                <form>
                    <div class="create_acc_wrapper">
                        <div class="form-check" id="userClickmodel">
                            <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="user_acc">
                            <label class="form-check-label">
                                <i class="fas fa-user"></i>@lang('frontend-messages.Register.user.user')
                            </label>
                        </div>
                        <div class="form-check" id="businessUserClickmodel">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="bussiness_acc">
                            <label class="form-check-label" for="flexRadioDefault2">
                                <i class="fas fa-briefcase"></i>Business
                            </label>
                        </div>
                    </div>
                    <p>@lang('frontend-messages.Register.text')</p>
                    <div class="form-group submit">
                        <button type="button" class="input-btn signupstep2-btn" data-bs-toggle="modal" data-bs-target="#SignUpStep2" data-bs-dismiss="modal" style="display: none;">@lang('frontend-messages.Register.buttontext')</button>
                        <button type="button" class="input-btn business-sign-up-btn" data-bs-toggle="modal" data-bs-target="#business-sign-up" data-bs-dismiss="modal" style="display: block;">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- What is User Modal -->
    <div class="modal fade" id="whatIsUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close" class="btn-close popup-close cancle"></a>
                <h5>@lang('frontend-messages.Register.user.title')</h5>
                <p>@lang('frontend-messages.Register.user.content')</p>
                <a href="javascript:void(0)" class="cancle">@lang('frontend-messages.Register.user.cancel')</a>
            </div>
        </div>
    </div>

    <!-- What is Business Profile Modal -->
    <div class="modal fade" id="business_profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close" class="btn-close popup-close cancle"></a>
                <h5>What is Business Profile</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Id porta nibh venenatis cras sed. Mattis vulputate enim nulla aliquet.
                    Dignissim convallis aenean et tortor at risus. Nisl suscipit adipiscing bibendum est ultricies
                    integer quis auctor elit. Enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra.
                    Egestas tellus rutrum tellus pellentesque. Morbi tristique senectus et netus. Scelerisque purus
                    semper eget duis at tellus. Nulla facilisi etiam dignissim diam quis enim lobortis scelerisque
                    fermentum. Morbi tristique senectus et netus et malesuada fames ac turpis. Lectus arcu bibendum at
                    varius vel pharetra vel turpis.</p>
                <a href="javascript:void(0)" class="cancle">Cancel</a>
            </div>
        </div>
    </div>

    <!-- SignUp-Step-2(User) Register-->
    <div class="modal fade" id="SignUpStep2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" id="clearUsersSignForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
         
                <form action="javascript:void(0)" id="register_form" name="register_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group file-upload">
                        <div class="file-upload-div">
                            <input type="file" name="profile_image" onchange="readURL9(this);" id="profile_image">
                            <img src="{{ asset('assets/images/file-upload-icon.png') }}" id="blah9" class="imageClear">
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" name="first_name" placeholder="@lang('frontend-messages.Register.user.placeholder.firstname')" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="last_name" placeholder="@lang('frontend-messages.Register.user.placeholder.lastname')" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="user_name" placeholder="@lang('frontend-messages.Register.user.placeholder.username')" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="email" name="reg_email" placeholder="@lang('frontend-messages.Register.user.placeholder.email')" class="form-control">
                    </div>
                    <div class="input-group mobile-number">
                        <div class="ph-code">
                            <select class="form-select" aria-label="Default select example" name="phone_code">
                                <option value="+966" selected>+966</option>
                            </select>
                            <label id="phone_code-error" class="error" for="phone_code"></label>
                        </div>
                        <div class="ph-no">
                            <input type="text" id="getPhoneNumber" name="phone_number" placeholder="Enter Phone Number" class="form-control">
                        </div>
                        <label id="getPhoneNumber-error" class="error" for="getPhoneNumber"></label>
                    </div>
                    <div class="input-group country-dropdown">
                        <select class="form-select" name="country_id">
                            <option value="" selected>Select Country</option>
                            @foreach (App\Models\Country::all() as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        <label id="country_id-error" class="error" for="country_id"></label>
                    </div>
                    <div class="input-group">
                        <select class="form-select state-dropdown" name="state_id" id="state-dropdown">
                        </select>
                        <label id="state-dropdown-error" class="error" for="state-dropdown"></label>
                    </div>
                    <div class="input-group">
                        <select class="form-select city-dropdown" name="city_id" id="city-dropdown">
                        </select>
                        <label id="city-dropdown-error" class="error" for="city-dropdown"></label>
                    </div>
                    <div class="input-group password">
                        <div class="pwd">

                        <input id="pass_user_reg_id" type="password" autocomplete="on" name="password" class="form-control" placeholder="@lang('frontend-messages.LoginUser.pleaceholderpassword')" ><i toggle="#pass_user_reg_id" class="fa fa-fw fa-eye field_icon toggle-password sinupPwd"></i>

                        </div>
                        <label id="pass_user_reg_id-error" class="error" for="pass_user_reg_id"></label>
                    </div>
                    <div class="input-group password">
                        <div class="pwd">

                        <input id="con_pass_user_reg_id" type="password" autocomplete="on" name="password_confirmation" class="form-control" placeholder="@lang('frontend-messages.Register.user.placeholder.c_password')"><i toggle="#con_pass_user_reg_id" class="fa fa-fw fa-eye field_icon toggle-password sinupPwdConfi"></i>

                        </div>
                        <label id="confirm_sign_up_password-error" class="error" for="con_pass_user_reg_id"></label>
                    </div>
                    <p>
                        @lang('frontend-messages.Register.user.bottom_p1') 
                        <a href="{{route('frontend.users.terms-condition.termsCondition')}}" target="_blank">@lang('frontend-messages.Register.user.link1') </a>
                        @lang('frontend-messages.Register.user.bottom_p2') 
                        <a href="{{route('frontend.users.privacy-policy.privacyPolicy')}}" target="_blank">@lang('frontend-messages.Register.user.link2')</a>.
                    </p>
                    <div class="form-group submit">
                        <button type="submit" class="btn submit-reg loader_class">@lang('frontend-messages.Register.user.button')</button>
                    </div>
                </form>
                <p>@lang('frontend-messages.Register.user.bottom_p3')
                    <a href="javascript:void(0)" class="submit" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('frontend-messages.Register.user.link3')</a></p>
            </div>
        </div>
    </div>

    <!-- Business users register -->
    <div class="modal fade" id="business-sign-up" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" id="clearBusinessUserRegisterForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                {{-- <div id="success_message" class="alert" style="display:none;">
                </div>
                <div id="error_message" class="alert" style="display:none;">
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
                @endif --}}
                <form id="businessRegiModal" name="businessRegiModal" method="post" enctype="multipart/form-data" action="javascript:void(0)">
                    @csrf
                    <div class="input-group file-upload">
                        <div class="file-upload-div">
                            <input type="file" name="profile_picture" onchange="readURL14(this);" id="profile_picture">
                            <img src="{{ asset('assets/images/file-upload-icon.png') }}" id="blah14" class="imageClear">
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" name="company_name" placeholder="Company Name" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="company_legal_name" placeholder="Company Legal Name" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="owner_manager_name" placeholder="Owner / Manager Name" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="cr_number" placeholder="CR Number" class="form-control">
                    </div>
                    <div class="input-group file-upload-icon">
                        <input type="file" name="upload_cr_file" placeholder="Upload CR" class="form-control">
                        <h5 class="label_UploadCR">Upload CR</h5>
                    </div>
                    <div class="input-group">
                        <input type="text" name="enter_maroof_number" placeholder="Maroof Number" class="form-control">
                    </div>
                    <div class="input-group file-upload-icon">
                        <input type="file" name="upload_maroof_file" placeholder="Upload Maroof" class="form-control">
                        <h5 class="label_UploadMaroof">Upload Maroof</h5>
                    </div>
                    <div class="input-group">
                        <input type="date" name="date_of_expiry" id="date_of_expiry" placeholder="Date Of Expiry" class="form-control date_of_expiry">
                    </div>

                    <div class="input-group">
                        <input type="text" name="vat_number" placeholder="VAT Number" class="form-control">
                    </div>

                    <div class="input-group file-upload-icon">
                        <input type="file" name="vat_certificate_file" placeholder="VAT Certificate" class="form-control">
                        <h5 class="label_VATNumber">Upload VAT Number Certificate</h5>
                    </div>

                    <div class="input-group file-upload-icon">
                        <input type="file" name="return_policy" placeholder="Return Policy" class="form-control">
                        <h5 class="label_ReturnPolicy">Return Policy</h5>
                    </div>
                    <div class="input-group">
                        <input type="text" name="bank_name" placeholder="Bank Name" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="bank_account_number" placeholder="Bank Account Number" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="iban_number" placeholder="IBAN number" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="business_email" placeholder="Business email" class="form-control">
                    </div>
                    <div class="input-group mobile-number">
                        <div class="ph-code">
                            <select class="form-select" aria-label="Default select example" name="phone_code">
                                <option selected>+966</option>
                                <!-- <option value="1">+1</option>
                                <option value="2">+11</option>
                                <option value="3">+33</option> -->
                            </select>
                        </div>
                        <div class="ph-no">
                            <input type="text" id="getPhoneNumber1" name="phone_number" placeholder="Enter Phone Number" class="form-control">
                        </div>
                        <label id="getPhoneNumber-error" class="error" for="getPhoneNumber1"></label>
                    </div>

                    <div class="input-group country-dropdown">
                        <select  name="country_id" size='1' class="form-select selectpicker">
                            <option value="" selected>Select Country</option>
                           
                            @foreach (App\Models\Country::all() as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        <label id="country_id-error" class="error" for="country_id"></label>
                    </div>
                    <div class="input-group">
                        <select class="form-select state-dropdown" name="state_id" id="state-dropdown1">
                        </select>
                        <label id="state-dropdown-error" class="error" for="state-dropdown1"></label>
                    </div>
                    <div class="input-group">
                        <select class="form-select city-dropdown" name="city_id" id="city-dropdown1">
                        </select>
                        <label id="city-dropdown-error" class="error" for="city-dropdown1"></label>
                    </div>
                    <div class="input-group password">
                        <div class="pwd">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.Register.user.placeholder.password')" class="form-control" id="sign_up_password_business_user" name="password">
                        {{-- <i toggle="#sign_up_password_business_user" class="fas fa-eye-slash"></i> --}}
                        <i toggle="#sign_up_password_business_user" class="fa fa-fw fa-eye field_icon toggle-password business_sinupPwd"></i>
                        </div>
                        <label id="sign_up_password_business_user-error"  class="error" for="sign_up_password_business_user"></label>
                    </div>
                    <div class="input-group password">
                        <div class="pwd">
                        <input type="password" autocomplete="on" placeholder="@lang('frontend-messages.Register.user.placeholder.c_password')" class="form-control" id="confirm_sign_up_password_business_user" name="password_confirmation">
                        {{-- <i toggle="#confirm_sign_up_password_business_user" class="fas fa-eye-slash"></i> --}}
                        <i toggle="#confirm_sign_up_password_business_user" class="fa fa-fw fa-eye field_icon toggle-password business_sinupPwd_confim"></i>
                        </div>
                        <label id="confirm_sign_up_password_business_user-error" class="error" for="confirm_sign_up_password_business_user"></label>
                    </div>
                    <p>
                        @lang('frontend-messages.Register.user.bottom_p1') 
                        <a href="{{route('frontend.users.terms-condition.termsCondition')}}" target="_blank">@lang('frontend-messages.Register.user.link1') </a>
                        @lang('frontend-messages.Register.user.bottom_p2') 
                        <a href="{{route('frontend.users.privacy-policy.privacyPolicy')}}" target="_blank">@lang('frontend-messages.Register.user.link2')</a>.
                    </p>
                    <div class="form-group submit">

                        <button type="submit" class="btn btn-primary slaCertificateWithSignup" value=""> Sign
                            Up</button>
                    </div>
                </form>
                <p>Already have an account? 
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                </p>
            </div>
        </div>
    </div>

    <!-- What is Business Profile Modal -->
    <div class="modal fade" id="sla-certificate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" id="clearSlaCertificateForm" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p>The agreement has been valid from <strong>{{ date('l') }}</strong> and the date
                    </strong>
                    <{{ date('d/m/Y') }}></strong> between each of the
                </p>
                <p>The Tejarh Company for Information and Technology, under Commercial Registration No. (Xxxxxxx), dated
                    x/x/xxxx, issued by Riyadh, and its head office is located in Riyadh, Kingdom of Saudi
                    Arabia, and its address is Xxxxx Road, XXXX District , Telephone No. (xxxxx) and address Email
                    Agreement@tejarh.co (hereinafter referred to as (the first party, Tejarh or the platform,</p>
                <p>Then the details of the vendor that he entered in his registration Name of the
                    <span><strong id="owner">owner</strong></span> /
                    <span><strong id="manager">manager</strong></span>/
                    <span><strong id="companyName">company name</strong></span>
                    {{-- /<span><strong id="storeName">store name</strong></span> /
                    <span><strong id="cr_number">commercial registration</strong></span> / <span><strong id="city_id_as_address">address</strong></span>/  --}}
                    {{-- <span><strong id="setPhoneNumber">phone number</strong></span>  --}}
                    then the agreements
                </p>

                <form id="slaCertificateVerify" class="slaCertificate" name="slaCertificate" method="post" enctype="multipart/form-data" action="javascript:void(0)">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input orCheckUncheck" type="checkbox" value="" id="agree-to-continue">
                        <label class="form-check-label" for="agree-to-continue">
                            I read all details and agree to continue.
                        </label>
                    </div>
                    <div class="form-group submit">
                        <input type="submit" id="slaCertificateVerifyBtn" class="btn btn-primary slaCertificateBtn orCheckUncheckBtn" value="Done">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- upload Images -->
    <div class="modal fade" id="uploadimagesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h5>Bulk Images</h5>
                <form action="{{route('frontend.users.pages.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="sample-pro-store">
                        <div class="input-group file-upload-icon">
                            <input type="file" name="imageFile[]" placeholder="Upload CR" class="form-control" id="images" multiple="multiple">
                            <h5>Choose File</h5>
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- BulkproductModal -->
    <div class="modal fade" id="bulkproductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h5>Bulk Product</h5>

                <div class="form-check redio-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="samplecsv" checked>
                    <label class="form-check-label" for="samplecsv">
                        Sample CSV Download
                    </label>
                </div>
                <div class="form-check redio-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bulkproductcsv">
                    <label class="form-check-label" for="bulkproductcsv">
                        Bulk Product CSV Upload
                    </label>
                </div>

                <div class="sample-pro-store store-commman activeTab" id="scsv">
                    <!-- <h5>Store</h5>
                    <div class="input-group">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Choose Category</option>
                            <option value="1">Option1</option>
                            <option value="2">Option2</option>
                            <option value="3">Option3</option>
                            <option value="4">Option4</option>
                        </select>
                    </div> -->
                    <div class="form-group submit">
                        <form action="{{route('frontend.users.pages.importproduct.export')}}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-primary" name="download" value="Download">
                        </form>
                    </div>
                    <p><span style="color: red;"> <b>*</b> Click in on download will download a sample CSV product file.</span></p>
                </div>
                <div class="bulk-pro-store store-commman" id="bcsv">
                    <form action="{{route('frontend.users.pages.importproduct.import_parse')}}" method="POST" enctype="multipart/form-data" id="import_products">
                        @csrf

                        <div class="input-group file-upload-icon">
                            <input type="file" name="csv_file" placeholder="Upload CR" class="form-control">
                            <h5>Choose File</h5>
                        </div>
                        <input id="header" class="ml-1" type="checkbox" name="header" checked />

                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                    <div class="sign-in-with"></div>
                </div>

            </div>
        </div>
    </div>

    
    <!-- Footer -->
    @include('frontend.users.includes.footer')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript">

               
        $(document).ready(function() {

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            var token = $("#token").val();


            var startTimer;
            $('#checkUsernameEmail').on('keyup', function () {
                clearTimeout(startTimer);
                let email = $(this).val();
                startTimer = setTimeout(checkEmail, 500, email);
            });
    
            $('#checkUsernameEmail').on('keydown', function () {
                clearTimeout(startTimer);
            });
    
            function checkEmail(email) {
                $('#checkUsernameEmail-error').remove();
                if (email.length > 1) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('frontend.users.site.checkUsernameEmail') }}",
                        data: {
                            email: email,
                            _token: token
                        },
                        success: function(data) {
                            if (data.success == false) {
                                $('#checkUsernameEmail').after('<div id="email-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                            } else {
                                $('#checkUsernameEmail').after('<div id="email-error" class="text-success" <strong>'+data.message+'<strong></div>');
                            }
    
                        }
                    });
                } else {
                    $('#checkUsernameEmail').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
                }
            }
        });
    </script>
    <script>
        if ($("#resetPassword_form").length > 0) {
            $("#resetPassword_form").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "reset_password": {
                        required: true,
                        minlength: 6,
                    },
                    "reset_password_confirm": {
                        required: true,
                        minlength: 6,
                        equalTo: "#reset_password"
                    },
                },
                messages: {
                    "reset_password": {
                        required: '@lang("frontend-messages.ResetPassword.validation.password")',
                        minlength: '@lang("frontend-messages.ResetPassword.validation.minlength")',
                    },
                    "reset_password_confirm": {
                        required: '@lang("frontend-messages.ResetPassword.validation.c_password")',
                        minlength: '@lang("frontend-messages.ResetPassword.validation.minlength")',
                        equalTo: '@lang("frontend-messages.ResetPassword.validation.equal")',
                    }
                },
                submitHandler: function(form) {
                    var $this = $('#reset_password_form .loader_class');
                    var loadingText ='<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('#reset_password_form .loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                }
            });
        }

        if ($("#reset_password_form").length > 0) {
            $("#reset_password_form").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "reset_password": {
                        required: true,
                        minlength: 6,
                    },
                    "reset_password_confirm": {
                        required: true,
                        minlength: 6,
                        equalTo: "#reset_password"
                    },
                },
                messages: {
                    "reset_password": {
                        required: '@lang("frontend-messages.ResetPassword.validation.password")',
                        minlength: '@lang("frontend-messages.ResetPassword.validation.minlength")',
                    },
                    "reset_password_confirm": {
                        required: '@lang("frontend-messages.ResetPassword.validation.c_password")',
                        minlength: '@lang("frontend-messages.ResetPassword.validation.minlength")',
                        equalTo: '@lang("frontend-messages.ResetPassword.validation.equal")',
                    }
                },
                submitHandler: function(form) {
                    var $this = $('#reset_password_form .loader_class');
                    var loadingText ='<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('#reset_password_form .loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var token = $("#token").val();
                    var reset_password = $("#reset_password").val();
                    var reset_password_confirm = $("#reset_password_confirm").val();
                    $.ajax({
                        type: 'POST',
                        //url: "{{ url('user-resetpassword') }}",
                        url: "{{ route('frontend.users.site.reset_password') }}",
                        data: {
                            token: token,
                            reset_password: reset_password,
                            reset_password_confirm: reset_password_confirm,
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                    console.log(data)
                                    $('#ajax-alert-resetpassword').addClass('alert-success').show(
                                    function() {
                                        $(this).html(data.success);
                                        setTimeout(function() {
                                            $('body').removeClass('modal-open');
                                            $('.modal').removeClass('show');
                                            $('body').css('overflow', 'visible');
                                            $('.modal-backdrop').removeClass('show');
                                        }, 7000)
                                        $('.loader_class').prop("disabled", false);
                                        var loadingText = '@lang("frontend-messages.ResetPassword.button")';
                                        $('.loader_class').prop("disabled", false);
                                        $this.html(loadingText);
                                        window.location.href ="{{ URL::route('frontend.users.site.index') }}";
                                   });
                            } else {
                                    $('#ajax-alert-error-resetpassword').addClass('alert-danger').show(
                                    function() {
                                        $(this).html('@lang("frontend-messages.ResetPassword.errormsg.msg")');
                                        $('.loader_class').prop("disabled", false);
                                        var loadingText = '@lang("frontend-messages.ResetPassword.button")';
                                        $('.loader_class').prop("disabled", false);
                                        $this.html(loadingText);
                                    });
                            }
                        },
                    });
                }
            });
        }

        $('#resetPasswordModal input[type="submit"]').click(function() {
            $.cookie('resetPasswordModal', '1', {
                expires: 1
            });
        })

        if ($.cookie('resetPasswordModal') == '1') {
            $("#loginModal").modal('show');
            $.cookie('resetPasswordModal', null);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#userClickmodel").click(function() {
                $("#signUpModal").hide();
            });

            $("#businessUserClickmodel").click(function() {
                $("#signUpModal").hide();
            });
        });

        
        /* Import file validation */
        $("#import_products").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {

                "import_products": {
                    required: true,
                },
            },
            messages: {

                "import_products": {
                    required: '{{__("messages.product.create.validation.please_choose_file")}}',
                },
            },
            submitHandler: function(form) {
                var $this = $('.loader_class');
                var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('.loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
            }
        });
    </script>

    <script>
        $("#resetotp_form").click(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var token = $("#token").val();
            $.ajax({
                type: 'POST',
                cache: false,
                //url: "{{ url('user-resendotp') }}",
                url: "{{ route('frontend.users.site.resend_otp') }}",

                data: {
                    token: token,
                },
                success: function(data) {
                    if (data.code === 200) {
                        $('#ajax-alert-verify').addClass('alert-success').show(function() {
                            $(this).html(data.success);
                        });
                    } else {
                        $('#ajax-alert-error-verify').addClass('alert-danger').show(function() {
                            $(this).html('@lang("frontend-messages.ResendOtp.error.msg")');
                        });
                    }

                },
            });
        });
    </script>
    <script type="text/javascript">
        if ($("#verifyotp_form").length > 0) {
            $("#verifyotp_form").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "otp1": {
                        required: true,
                    },
                    "otp2": {
                        required: true,
                    },
                    "otp3": {
                        required: true,
                    },
                    "otp4": {
                        required: true,
                    },
                    "otp5": {
                        required: true,
                    },
                },
                messages: {

                },
                submitHandler: function(form) {
                    var $this = $('#verifyotp_form .loader_class');
                    var loadingText =
                        '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('#verifyotp_form .loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var formdata = new FormData(document.getElementById("verifyotp_form"));
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('frontend.users.site.verify_user_otp') }}",
                        processData: false,
                        contentType: false,

                        data: formdata,

                        success: function(data) {
                            if (data.code === 200) {

                                //$('#ajax-alert-verify').addClass('alert-success').show(function() {
                                    //$(this).html(data.success);
                                    toastr.success(data.success);
                                    document.getElementById("login_form").reset();
                                    setTimeout(function() {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                        $('#otpScreenModal').css('display', 'none');

                                    }, 2000)
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.Verification.button")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);

                                    setTimeout(function() {
                                        $("#otpScreenModal .input-btn.hidden-btn")
                                            .trigger("click");
                                    }, 2000)

                                //});
                            } else {
                                $('#ajax-alert-error-verify').addClass('alert-danger').show(
                                function() {
                                    $(this).html(data.error);
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.Verification.button")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                            }

                        },
                    });

                }
            });
        }
    </script>
    <script type="text/javascript">
        if ($("#forgotpassword_form").length > 0) {
            $("#forgotpassword_form").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "forgot_email": {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    "forgot_email": {
                        required: '@lang("frontend-messages.Forgot.validation.user/email")',
                        email: '@lang("frontend-messages.Register.user.validation.validemail")',
                    }
                },
                submitHandler: function(form) {
                    var $this = $('#forgotpassword_form .loader_class');
                    var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('#forgotpassword_form .loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var email = $("#forgot_email").val();
                    $.ajax({
                        type: 'POST',                    
                        url: "{{route('frontend.users.site.forgot_password')}}",
                        data: {
                            'email':email,
                        },
                        success: function(data) {

                            if (data.code === 200) {
                                // $('#ajax-alert-forgot').addClass('alert-success').show(function() {
                                    //toastr.success(data.success);
                                    setTimeout(function() {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                    }, 4000)
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.Forgot.button")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);                                 
                                // });
                            } else {
                                /*
                                $('#ajax-alert-error-forgot').addClass('alert-danger').show(function() {
                                    $(this).html('@lang("frontend-messages.Forgot.errormsg.msg")');
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.Forgot.button")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                                */
                                toastr.error('Please enter valid credentials');
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                    location.reload(); 
                                }, 3000)
                            }
                        },

                    });

                }
            });
        }
    </script>

    <script type="text/javascript">
        if ($("#register_form").length > 0) {
            $("#register_form").validate({
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
                    "phone_code": {
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
                        equalTo: "#pass_user_reg_id"
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
                    "phone_code": {
                        required: 'Please select country code',
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
                            if (data.code = 200) {
                                toastr.success('Your Registration Successfully!');
                                document.getElementById("register_form").reset();
                                setTimeout(function() {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                        $("#loginModal").modal('show');
                                        $('#SignUpStep2').modal('hide');
                                }, 900)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.Register.buttontext")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                            }
                            else
                            {
                                toastr.danger('Registration Unsuccessfull!');
                                document.getElementById("register_form").reset();
                            }
                        },
                    });
                }
            });
        }
    </script>
    <script type="text/javascript">
        if ($("#login_form").length > 0) {
            $("#login_form").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "username": {
                        required: true,
                        email: true,
                       
                    },
                    "password": {
                        required: true,
                        minlength: 6,
                    },
                },
                messages: {
                    "username": {
                        required: '@lang("frontend-messages.LoginUser.validation.user/email")',
                        email: '@lang("frontend-messages.Register.user.validation.validemail")',

                    },
                    "password": {
                        required: '@lang("frontend-messages.LoginUser.validation.password")',
                        minlength: '@lang("frontend-messages.LoginUser.validation.minlengthpassword")',
                    },
                },
                submitHandler: function(form) {
                    var $this = $('.loader_class');
                    var loadingText =
                        '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('.loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var password = $("#log_in_password").val();
                    var username = $("#username").val();

                    var check_current_route = $('.details_page').attr('data-text');
                    var itemId = $('.details_page').attr('data-item_id');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('frontend.users.site.login') }}",
                        data: {
                            username: username,
                            password: password,
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                $('#ajax-alert-login').addClass('alert-success').show(function() {
                                    $(this).html(data.success);
                                    document.getElementById("login_form").reset();
                                    setTimeout(function() {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                    }, 2000)
                                    if (data.auth === 4) {
                                        window.location.href = "{{ url('business/home/index') }}";
                                    }else if(data.auth === 8) {
                                        window.location.href = "{{ url('store/home/store-index') }}";
                                    } else {

                                        if (check_current_route == 'details_page') {
                                            window.location.href = "{{ url('/promoted-items/item-details') }}/" + itemId;
                                        } else {
                                            window.location.href = "{{ url('/') }}";
                                        }
                                    }
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("frontend-messages.LoginUser.buttontext")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);

                                });
                            } else {
                                $('#ajax-alert-error-login').addClass('alert-danger').show(
                                    function() {
                                        $(this).html('@lang("frontend-messages.LoginUser.errormsg.msg")');
                                        $('.loader_class').prop("disabled", false);
                                        var loadingText = '@lang("frontend-messages.LoginUser.buttontext")';
                                        $('.loader_class').prop("disabled", false);
                                        $this.html(loadingText);
                                    });
                            }
                        }
                    })

                }
            });
        }
    </script>

    <script type="text/javascript">
        /* Business user registration validation */
        if ($("#businessRegiModal").length > 0) {
            $("#businessRegiModal").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "company_name": {
                        required: true,
                    },
                    "company_legal_name": {
                        required: true,
                    },
                    "owner_manager_name": {
                        required: true,
                    },
                    "cr_number": {
                        required: true,
                    },
                    // "upload_cr_file": {
                    // 	required: true,
                    // },
                    "enter_maroof_number": {
                        required: true,
                    },
                    // "upload_maroof_file": {
                    // 	required: true,
                    // },
                    "date_of_expiry": {
                        required: true,
                    },
                    "vat_number": {
                        required: true,
                        number: true,
                    },
                    // "vat_certificate_file": {
                    // 	required: true,
                    // },
                    // "return_policy": {
                    // 	required: true,
                    // },
                    "bank_name": {
                        required: true,
                    },
                    "bank_account_number": {
                        required: true,
                    },
                    "iban_number": {
                        required: true,
                    },
                    "business_email": {
                        required: true,
                        email: true,
                    },
                    "phone_number": {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    // "location": {
                    //     required: true,
                    // },
                    // "district": {
                    //     required: true,
                    // },
                    // "country": {
                    //     required: true,
                    // },
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
                        equalTo: "#sign_up_password_business_user"
                    }
                },
                messages: {
                    "company_name": {
                        required: '@lang("business_messages.register.business_user.validation.company_name")',
                    },
                    "company_legal_name": {
                        required: '@lang("business_messages.register.business_user.validation.company_legal_name")',
                    },
                    "owner_manager_name": {
                        required: '@lang("business_messages.register.business_user.validation.owner_manager_name")',
                    },
                    "cr_number": {
                        required: '@lang("business_messages.register.business_user.validation.cr_number")',
                    },
                    // "upload_cr_file": {
                    // 	required: '@lang('business_messages.register.business_user.validation.upload_cr_file')',
                    // },
                    "enter_maroof_number": {
                        required: '@lang("business_messages.register.business_user.validation.enter_maroof_number")',
                    },
                    // "upload_maroof_file": {
                    // 	required: '@lang('business_messages.register.business_user.validation.upload_maroof_file')',
                    // },
                    "date_of_expiry": {
                        required: '@lang("business_messages.register.business_user.validation.date_of_expiry")',
                    },
                    "vat_number": {
                        required: '@lang("business_messages.register.business_user.validation.enter_vat_number")',
                    },
                    // "vat_certificate_file": {
                    // 	required: '@lang('business_messages.register.business_user.validation.vat_certificate_file')',
                    // },
                    "return_policy": {
                        required: '@lang("business_messages.register.business_user.validation.return_policy")',
                    },
                    "bank_name": {
                        required: '@lang("business_messages.register.business_user.validation.bank_name")',
                    },
                    "bank_account_number": {
                        required: '@lang("business_messages.register.business_user.validation.bank_account_number")',
                    },
                    "iban_number": {
                        required: '@lang("business_messages.register.business_user.validation.iban_number")',
                    },
                    "business_email": {
                        // required: '@lang("business_messages.register.business_user.validation.business_email")',
                        required: '@lang("frontend-messages.Register.user.validation.email")',
                        email: '@lang("frontend-messages.Register.user.validation.validemail")',
                    },
                    "phone_number": {
                        required: '@lang("business_messages.register.business_user.validation.phone_number")',
                        number: '@lang("business_messages.register.business_user.validation.validnumber")',
                        minlength: '@lang("business_messages.register.business_user.validation.minlengthnumber")',
                        maxlength: '@lang("business_messages.register.business_user.validation.maxlengthnumber")'
                    },
                    // "location": {
                    //     required: '@lang("business_messages.register.business_user.validation.location")',
                    // },
                    // "district": {
                    //     required: '@lang("business_messages.register.business_user.validation.district")',
                    // },
                    // "country": {
                    //     required: '@lang("business_messages.register.business_user.validation.country")',
                    // },

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
                        required: '@lang("business_messages.register.business_user.validation.password")',
                        minlength: '@lang("business_messages.register.business_user.validation.minlengthpassword")',
                    },
                    "password_confirmation": {
                        required: '@lang("business_messages.register.business_user.validation.c_password")',
                        minlength: '@lang("business_messages.register.business_user.validation.minlengthc_password")',
                        equalTo: '@lang("business_messages.register.business_user.validation.passwordequal")',
                    }
                },
                submitHandler: function(form) {
                    var $this = $('#businessRegiModal .loader_class');
                    var loadingText =
                        '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('#businessRegiModal .loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formdata = new FormData(document.getElementById("businessRegiModal"));

                   
                    let owner = $("[name='owner_manager_name']").val();
                    let manager = $("[name='owner_manager_name']").val();
                    let companyName = $("[name='company_name']").val();
                    let storeName = $("[name='owner_manager_name']").val();
                    let cr_number = $("[name='cr_number']").val();
                    let city_id_as_address = $("#city-dropdown1 option:selected").text();
                    let phoneNumber = document.getElementById("getPhoneNumber1").value;

                    $("#owner").html(owner);
                    $("#manager").html(manager);
                    $("#companyName").html(companyName);
                    $("#storeName").html('store name');
                    $("#setPhoneNumber").html(phoneNumber);
                    $("#cr_number").html(cr_number);
                    $("#city_id_as_address").html(city_id_as_address);

                    $("#sla-certificate").modal('show');
                    $('#business-sign-up').modal('hide')
                    $('.slaCertificateBtn').prop("disabled", true);
                    $('.orCheckUncheck').click(function() {
                        if ($(this).is(':checked')) {
                            $('.slaCertificateBtn').prop("disabled", false);
                        } else {
                        if ($('.checks').filter(':checked').length < 1){
                            $('.slaCertificateBtn').attr('disabled',true);}
                        }
                    });
                    $('#slaCertificateVerifyBtn').click(function(e) {
                        $.ajax({
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            url: '{{ route("frontend.business.register.store") }}',
                            data: formdata,
                            success: function(data) {
                                //console.log(data)
                                if (data.code === 200) {
                                            //console.log(data.success)
                                    // $('#success_message').addClass('alert-success').show(
                                    //     function() {
                                            // $(this).html(data.success);
                                            toastr.success('Your Registration Successfully!');
                                            document.getElementById("businessRegiModal").reset();
                                            setTimeout(function() {
                                                $('body').removeClass('modal-open');
                                                $('.modal').removeClass('show');
                                                $('body').css('overflow','visible');
                                                $('.modal-backdrop').removeClass('show');
                                            }, 2000)
                                            $('.loader_class').prop("disabled", false);
                                            var loadingText = '@lang("frontend-messages.Register.buttontext")';
                                            $('.loader_class').prop("disabled", false);
                                            $this.html(loadingText);
                                        //});
                                }
                            },
                            error: function(data) {
                                $('#error_message').addClass('alert-danger').show(
                                function() {
                                    $(this).html('@lang("business_user_message.register.errormsg.msg")');
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("business_user_message.register.buttontext")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                            }
                        });
                    });
                }
            });
        }
    </script>
    <!-- <script src="{{ asset('assets/js/front-master.js') }}"></script> -->

    <!-- get states by country Id -->
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

    <script type="text/javascript">
        if ($("#login_form_or").length > 0) {
            $("#login_form_or").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "username": {
                        required: true,
                    },
                    "password": {
                        required: true,
                        minlength: 6,
                    },
                },
                messages: {
                    "username": {
                        required: '@lang("frontend-messages.LoginUser.validation.user/email")',
                    },
                    "password": {
                        required: '@lang("frontend-messages.LoginUser.validation.password")',
                        minlength: '@lang("frontend-messages.LoginUser.validation.minlengthpassword")',
                    },
                },
                submitHandler: function(form) {
                    var $this = $('.loader_class');
                    var loadingText ='<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                    $('.loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                }
            });
        }
        $('select').change(function(){
            if ($(this).val()!="")
            {
                $(this).valid();
            }
        });
    </script>
    @yield('script')
    <!-- End Footer -->
</body>

</html>