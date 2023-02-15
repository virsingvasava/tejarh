
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
                                                <h4 class="text-center mb-2">You forgot your password?</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                           
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
                                            <form action="{{route('forgot_password.submit')}}" method="post" id="forgot_password_form">
                                                        @csrf
                                                      <div class="form-group paddlr-30">
                                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="E-mail" tabindex="1">
                                                      </div>
                                                      <div class="checkbox-group mb-4">
                                                        <div class="btn-grp text-center">
                                                           <button type="submit" class="btn btn-primary glow w-100 position-relative">Submit<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                            <!-- <a href="about.php" class="btn btn-primary bg-blue w200" tabindex="3">Log In</a> -->
                                                        </div>
                                                      <!--   <a href="{{route('login')}}" class="forgot-password" tabindex="5">Login</a>  -->
                                                        </div>
                                             </form>
                                              <div class="text-center"><small class="mr-25">If you have an Password?</small><a href="{{route('login')}}"><small>Login</small></a></div>
                                            
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
var SITE_URL = '{{URL::to('/')}}'
</script>

<script type="text/javascript">

    $("#forgot_password_form").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "email":{
                required:true,
                email:true,
                emailCheck:true,
            },
          
        },
        messages: {
            "email":{
                required:'Please enter e-mail address',
                email:'Please enter valid e-mail address',
                emailCheck:'Please enter valid e-mail address',
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