
@include('layouts.login_header')
@yield('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- login page start -->
            <section id="auth-login" class="row flexbox-container">
                <div class="col-xl-8 col-11">
                    <div class="card bg-authentication mb-0">
                        <div class="row m-0">
                            <!-- left section-login -->
                            <div class="col-md-6 col-12 px-0">
                                <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="text-center mb-2">Welcome to tejarh</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-md-row flex-column justify-content-around">

                                     <!--        <a href="javascript:void(0);" class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                                                <i class="bx bxl-google font-medium-3"></i><span class="pl-50 d-block text-center">Google</span></a>
                                            <a href="javascript:void(0);" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                                <i class="bx bxl-facebook-square font-medium-3"></i><span class="pl-50 d-block text-center">Facebook</span></a> -->

                                            <img class="logo" width="40px" height="40px" src="{{asset('build/app-assets/images/logo.png')}}">

                                        </div>
                                        <div class="divider">
                                            <div class="divider-text text-uppercase text-muted"><small>login with
                                                    email</small>
                                            </div>
                                        </div>
                                        
                                         @if (Session::has('danger'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('danger') }}
                                        </div>
                                        @endif
                                        @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                        @endif

                                        <form action="{{route('login.submit')}}" id="login_form" method="post">
                                            
                                            @csrf
                                            <div class="form-group mb-50">
                                                <label class="text-bold-600" for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" class="form-control" tabindex="1" placeholder="Email address"></div>
                                            <div class="form-group">
                                                <label class="text-bold-600" for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" name="password"  placeholder="Password">
                                            </div>
                                            <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                <div class="text-left">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="checkboxsmall" for="exampleCheck1"><small>Keep me logged
                                                                in</small></label>
                                                    </div>
                                                </div>
                                                <div class="text-right"><a href="{{route('forgot_password')}}" class="card-link"><small>Forgot Password?</small></a></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary glow w-100 position-relative">Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                        </form>
                                        <hr>
                                       <!--  <div class="text-center"><small class="mr-25">Don't have an account?</small><a href="{{route('register')}}"><small>Sign up</small></a></div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- right section image -->
                            <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                <img class="img-fluid" src="{{asset('build/app-assets/images/pages/login.png')}}" alt="branding logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- login page ends -->

        </div>
    </div>
</div>
<!-- END: Content-->

@include('layouts.login_footer')

<script type="text/javascript">

    $("#login_form").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "email":{
                required:true,
                email:true,
                // emailCheck:true,
            },
            "password":{
                required:true,
                minlength:6,
            },
        },
        messages: {
            "email":{
                required:'Please enter e-mail address',
                email:'Please enter valid e-mail address',
                emailCheck:'Please enter valid e-mail address',
            },
            "password":{
                required:'Please enter password',
                minlength:'Password must be more then six characters',
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