@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.faq_category.create.faq_category')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.faqs.faqs_category.index')}}">@lang('messages.faq_category.create.faqs_categories')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.faq_category.create.create')
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
                        <form  action="{{route('admin.faqs.faqs_category.store')}}" enctype="multipart/form-data" method="post" id="faqs_category_create">
                           @csrf
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="name">@lang('messages.faq_category.name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.faq_category.create.enter_name')">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="slug">@lang('messages.faq_category.create.slug')</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{old('slug')}}" id="slug" placeholder="@lang('messages.faq_category.create.enter_slug')">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">@lang('messages.common.select_status')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                       <option value="">@lang('messages.common.select_status')</option>
                                       <option value="1">@lang('messages.common.active')</option>
                                       <option value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.faqs.faqs_category.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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

$("#faqs_category_create22").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        
        "name":{
            required:true,
        },

        "slug":{
            required:true,
        },

        "status":{
            required:true,
        },
    },
    messages: {
       
        "name":{
            required:'{{__("messages.faq_category.create.validation.please_enter_name")}}',
        },

        "slug":{
            required:'{{__("messages.faq_category.create.validation.please_enter_slug")}}',
        },

        "status":{
            required:'{{__("messages.faq_category.create.validation.please_select_status")}}',
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

$(document).on('change','.cate_picture',function(){
  $('#category_image_preview').hide();
  readURL(this);
});
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
          $('#category_image_preview').attr('src', e.target.result);
          $('#category_image_preview').show();
      }
      reader.readAsDataURL(input.files[0]);
  }
}
function itemImageUpload() {
   document.getElementById("cate_picture").click();
}
</script>
@endsection

