@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.support_admin.support')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('messages.common.dashboard')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.support_admin.support')
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
                        <form  action="{{route('admin.support.support_update')}}" enctype="multipart/form-data" method="post" id="change_password_form">
                           @csrf
                           <div class="form-row col-md-8 mb-8">
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                    <label for="support_mail">@lang('messages.support_admin.support_mail')</label>
                                    <input type="support_mail" class="form-control @error('support_mail') is-invalid @enderror" name="support_mail" id="support_mail" value="{{$support_mail}}" placeholder="@lang('messages.support_admin.support_mail')">
                                    @error('support_mail')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                    <label for="support_contact">@lang('messages.support_admin.support_contact_no')</label>
                                    <input type="text" class="form-control @error('support_contact') is-invalid @enderror" name="support_contact" value="{{$support_contact}}" placeholder="@lang('messages.support_admin.support_contact_no')">
                                    @error('support_contact')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mb-1">
                                       <div class="form-group">
                                   <label>@lang('messages.support_admin.logo_picture')</label><br>
                                      <input type="file" class="support_logo" onclick="logoImageUpload()" name="support_logo" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">@lang('messages.support_admin.choose_file')</label><br>
                                 </div>
                                 @if($support_logo != '' && file_exists(public_path('img/support_logo/'.$support_logo)))
                                 <div class="d-block mb-1"><img id="image_preview" src="{{asset('img/support_logo/'.$support_logo)}}" alt="@lang('messages.support_admin.logo')" height="100" width="100" /></div>
                                 @else
                                 <div class="d-block mb-1"> <img id="image_preview" style="display: none;" src="#" alt="@lang('messages.support_admin.logo')" height="100" width="100" />
                                 </div>
                                 @endif
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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

