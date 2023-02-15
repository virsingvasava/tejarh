@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.faq.faq')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.faqs.faq.index')}}">@lang('messages.faq.faqs')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.faq.edit.edit')
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
                        <form action="{{route('admin.faqs.faq.update')}}" enctype="multipart/form-data" method="post" id="faq_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_faq->id}}">

                           <div class="form-row">

                              <div class="col-md-12 mb-12">
                                 <label for="status">@lang('messages.faq.create.select_category')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select" name="category_id">
                                       <option value="">@lang('messages.faq.create.select_category')</option>
                                       @if(!empty($category) && count($category) > 0)
                                       @foreach($category as $key => $cate)
                                       <option value="{{$cate->id}}" {{$cate->id == $edit_faq->category_id  ? 'selected' : ''}}>{{ $cate->name }}
                                       </option>
                                       @endforeach
                                       @else
                                       @endif
                                    </select>
                                 </fieldset>
                              </div>

                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="name">@lang('messages.faq.create.title')</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$edit_faq->title}}" name="title" id="title" placeholder="@lang('messages.faq.create.enter_title')">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="subtitle">@lang('messages.faq.create.sub_title')</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" value="{{$edit_faq->subtitle}}" name="subtitle" id="subtitle" placeholder="@lang('messages.faq.create.enter_sub_title')">
                                    @error('subtitle')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                           </div>

                           <div class="row">
                              <div class="col-12">
                                 <label for="label-textarea">@lang('messages.faq.create.short_description')</label>
                                 <fieldset class="form-label-group">
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="label-textarea" rows="3" placeholder="@lang('messages.faq.create.short_description')">{{$edit_faq->description}}</textarea>
                                    @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="slug">@lang('messages.faq.create.slug')</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{$edit_faq->slug}}" name="slug" id="slug" placeholder="@lang('messages.faq.create.enter_slug')">
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
                                    <select class="custom-select" name="status">
                                       <option value="">@lang('messages.common.select_status')</option>
                                       <option @if($edit_faq->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_faq->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                              <a href="{{route('admin.faqs.faq.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
   $("#faq_edit2").validate({
      ignore: "not:hidden",
      onfocusout: function(element) {
         this.element(element);
      },
      rules: {

         "category_id": {
            required: true,
         },

         "title": {
            required: true,
         },

         "subtitle": {
            required: true,
         },

         "slug": {
            required: true,
         },

         "short_description": {
            required: true,
         },

         "status": {
            required: true,
         },
      },
      messages: {

         "category_id": {

            required: '{{__("messages.faq.create.validation.please_select_category")}}',
         },

         "title": {
            required: '{{__("messages.faq.create.validation.please_enter_title")}}',
         },
         "subtitle": {
            required: '{{__("messages.faq.create.validation.please_enter_sub_title")}}',
         },

         "slug": {
            required: '{{__("messages.faq.create.validation.please_enter_slug")}}',
         },

         "short_description": {
            required: '{{__("messages.faq.create.validation.please_enter_description")}}',
         },

         "status": {
            required: '{{__("messages.faq.create.validation.please_select_status")}}',
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

   $(document).on('change', '.image', function() {
      readURL(this);
   });

   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
            $('#image_preview').attr('src', e.target.result);
         }
         reader.readAsDataURL(input.files[0]);
      }
   }

   function imageUpload() {
      document.getElementById("image").click();
   }
</script>
@endsection