@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.subscription.create_email_message')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.subscription.index')}}">@lang('messages.subscription.create_email_messages')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.subscription.create_email_message')
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
                        <form  action="{{route('admin.subscription.store')}}" enctype="multipart/form-data" method="post" id="create_email_message">
                           @csrf
                           <div class="form-row">

                              <div class="col-md-6 mb-6">
                                 <label for="heading_title">@lang('messages.subscription.heading_title')</label>
                                 <input type="text" class="form-control  @error('heading_title') is-invalid @enderror" name="heading_title" id="heading_title" value="{{old('heading_title')}}" placeholder="@lang('messages.subscription.enter_title')">
                                 @error('heading_title')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>

                              <div class="col-md-6 mb-6">
                                 <label for="subject">@lang('messages.subscription.subject')</label>
                                 <input type="text" class="form-control  @error('subject') is-invalid @enderror" name="subject" id="subject" value="{{old('subject')}}" placeholder="@lang('messages.subscription.enter_subject')">
                                 @error('subject')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-row mt-2 mb-2">
                              <div class="col-md-12 mb-12">
                                 <label for="message">@lang('messages.subscription.message')</label>
                                 <textarea class="ckeditor form-control" name="message"></textarea>

                                 @error('message')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                                 <label id="message-error" class="error" for="message"></label>
                              </div> 
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.subscription.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
$("#create_email_message").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        "heading_title":{
            required:true,
        },
        "subject":{
            required:true,
        },

      //   "send_message_description":{
      //       required:true,
      //   },

        "status":{
            required:true,
        },
    },
    messages: {
     
      "heading_title":{
            required:'{{__("messages.subscription.validation.heading_title_is_required")}}',
         },

       "subject":{
            required:'{{__("messages.subscription.validation.subject_is_required")}}',
         },

      //   "send_message_description":{
      //       required:'{{__("messages.subscription.validation.message_is_required")}}',
      //    },
         
        "status":{
               required:'{{__("messages.category.create.validation.please_select_status")}}',
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

<script type="text/javascript">
    $(document).on('change','.sub_cate_picture',function(){
        $('#sub_cate_image_preview').hide();
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#sub_cate_image_preview').attr('src', e.target.result);
                $('#sub_cate_image_preview').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function itemImageUpload() {
         document.getElementById("sub_cate_picture").click();
    }
 </script>

<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.ckeditor').ckeditor();
});
</script>
<script type="text/javascript">
$("#policy_create")({
    submitHandler: function(form) {
        var $this = $('.loader_class');
        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
        $('.loader_class').prop("disabled", true);
        $this.html(loadingText);
        form.submit();
    }
});
</script>
@endsection

