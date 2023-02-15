

@include('layouts.login_header')
@yield('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Sign Up</h4>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p> <small> Please enter your details to sign up and be part of our great community</small>
                                            </p>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('register.post')}}">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-50">
                                                        <label for="inputfirstname4">first name</label>
                                                        <input type="text" class="form-control" id="inputfirstname4" placeholder="First name">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-50">
                                                        <label for="inputlastname4">last name</label>
                                                        <input type="text" class="form-control" id="inputlastname4" placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-50">
                                                    <label class="text-bold-600" for="exampleInputUsername1">username</label>
                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username"></div>
                                                <div class="form-group mb-50">
                                                    <label class="text-bold-600" for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email address"></div>
                                                <div class="form-group mb-2">
                                                    <label class="text-bold-600" for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <button type="submit" class="btn btn-primary glow position-relative w-100">SIGN UP<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </form>
                                            <hr>
                                            <div class="text-center"><small class="mr-25">Already have an account?</small><a href="{{route('login')}}"><small>Sign in</small> </a></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                     <img class="img-fluid" src="{{asset('build/app-assets/images/pages/register.png')}}" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->

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
                emailCheck:true,
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