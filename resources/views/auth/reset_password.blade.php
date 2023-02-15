

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
                                 <h4 class="text-center mb-2">Recover your password</h4>
                              </div>
                           </div>
                           <div class="text-center">
                              <p> <small>Recover your password</small>
                              </p>
                           </div>
                           <div class="card-body">
                              <form action="{{route('password.submit')}}" method="post" id="reset_password_form">
                                 @csrf
                                 <div class="form-group paddlr-30">
                                    <input type="text" class="form-control" value="{{$user->email}}" placeholder="E-mail" readonly="readonly">
                                 </div>
                                 <input type="hidden" name="user_id" value="{{$user->id}}">
                                 <input type="hidden" name="email" value="{{$user->email}}">
                                 <div class="form-group paddlr-30">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                 </div>
                                 <div class="form-group paddlr-30">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                 </div>
                                 <div class="checkbox-group mb-4">
                                    <a href="{{route('login')}}" class="forgot-password" tabindex="5">Login?</a> 
                                 </div>
                                 <div class="btn-grp text-center">
                                    <button type="submit" class="btn btn-primary bg-blue w200">Change password</button>
                                    <!-- <a href="about.php" class="btn btn-primary bg-blue w200" tabindex="3">Log In</a> -->
                                 </div>
                              </form>
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
   $("#reset_password_form").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "password":{
                required:true,
                minlength:6,
            },
            "confirm_password":{
                equalTo:'#password',
            },
        },
        messages:{
            "password":{
                required:'Please Enter Password',
                minlength:'Please Password must be 6 character',
            },
            "confirm_password":'Password and Re-type Password must match',
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
        },
    });

</script>