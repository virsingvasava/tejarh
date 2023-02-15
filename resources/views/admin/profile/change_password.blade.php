@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.change_password.change_password')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="/admin">@lang('messages.common.dashboard')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.change_password.change_password')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Tooltip validations start -->
         <section id="tooltip-validation">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title"></h4>
                     </div>
                     <div class="card-body">
                        <form  action="{{route('admin.branch.store')}}" enctype="multipart/form-data" method="post" id="change_password_form">
                           @csrf
                           <div class="form-row col-md-8 mb-8">
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                    <label for="current_password">@lang('messages.change_password.current_password')</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" value="{{old('current_password')}}" placeholder="@lang('messages.change_password.current_password')">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                    <label for="new_password">@lang('messages.change_password.new_password')</label>
                                    <input type="text" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" value="{{old('new_password')}}" placeholder="@lang('messages.change_password.new_password')">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                    <label for="confirm_password">@lang('messages.change_password.confirm_password')</label>
                                    <input type="text" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" value="{{old('confirm_password')}}" placeholder="@lang('messages.change_password.confirm_password')">
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.branch.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- Tooltip validations end -->
      </div>
   </div>
</div>
<!-- END: Content-->

<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('build/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

<script type="text/javascript">

    $("#change_password_form").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "current_password":{
                required:true,
                minlength:6,
            },
            "new_password":{
                required:true,
                minlength:6,
            },
            "confirm_password":{
                required:true,
                minlength:6,
                equalTo:'#new_password'
            },
        },
        messages:{
            "current_password":{
                required:'{{__("messages.change_password.validation.please_enter_current_password")}}',
            },
            "new_password":{
                required:'{{__("messages.change_password.validation.please_enter_new_password")}}',
                minlength:'{{__("messages.change_password.validation.please_password_must_be_6_characte")}}',
            },
            "confirm_password":{
                required:'{{__("messages.change_password.validation.please_enter_confirm_password")}}',
                equalTo:'{{__("messages.change_password.validation.new_password_and_confirm_password_new_password_are_not_match")}}',
                minlength:'{{__("messages.change_password.validation.please_password_must_be_6_characte")}}',
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i>Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
        },
    });

</script>
@endsection

