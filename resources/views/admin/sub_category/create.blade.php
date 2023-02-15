@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.sub_category.create.sub_category')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.sub_category.index')}}">@lang('messages.sub_category.create.sub_categories')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.sub_category.create.create')
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
                        <p>
                           <!--  Menu edit -->
                        </p>
                        <form  action="{{route('admin.sub_category.store')}}" enctype="multipart/form-data" method="post" id="sub_cate_create">
                           @csrf
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <label for="category_id">@lang('messages.sub_category.create.eng_select_category')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select  @error('category_id') is-invalid @enderror" name="category_id">
                                       <option value="">@lang('messages.sub_category.create.eng_select_category')</option>
                                       @foreach ($category as $cate)
                                       <option value="{{ $cate->id }}">{{ $cate->category_name}}</option>
                                       @endforeach
                                    </select>

                                     @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="ar_category_id">@lang('messages.sub_category.create.ar_select_category')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select  @error('ar_category_id') is-invalid @enderror" name="ar_category_id">
                                       <option value="">@lang('messages.sub_category.create.ar_select_category')</option>
                                       @foreach ($category as $cate)
                                       <option value="{{ $cate->id }}">{{ $cate->category_name}}</option>
                                       @endforeach
                                    </select>

                                     @error('ar_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="name">@lang('messages.common.eng_name')</label>
                                 <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.sub_category.create.enter_name')">
                                 @error('name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="ar_name">@lang('messages.common.ar_name')</label>
                                 <input type="text" class="form-control  @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" value="{{old('ar_name')}}" placeholder="@lang('messages.sub_category.create.enter_name')">
                                 @error('ar_name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                               <div class="col-md-6 mb-6">
                                 <label for="slug">@lang('messages.common.eng_slug')</label>
                                 <input type="text" class="form-control  @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{old('slug')}}" placeholder="@lang('messages.sub_category.create.enter_name')">
                                 @error('slug')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="ar_slug">@lang('messages.common.ar_slug')</label>
                                 <input type="text" class="form-control  @error('slug') is-invalid @enderror" name="ar_slug" id="ar_slug" value="{{old('ar_slug')}}" placeholder="@lang('messages.sub_category.create.enter_name')">
                                 @error('ar_slug')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">@lang('messages.common.eng_select_status')</label>
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
                              <div class="col-md-6 mb-6">
                                 <label for="ar_status">@lang('messages.common.ar_select_status')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('ar_status') is-invalid @enderror" name="ar_status">
                                       <option value="">@lang('messages.common.select_status')</option>
                                       <option value="1">@lang('messages.common.active')</option>
                                       <option value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                    @error('ar_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="form-group">
                                    <label>@lang('messages.sub_category.create.sub_category_picture')</label> <br>
                                    <input type="file" name="sub_cate_picture" class="sub_cate_picture" onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">@lang('messages.sub_category.create.choose_file')</label>
                                    <div class="d-block mt-1"><img id="sub_cate_image_preview" style="display:none;" src="#" height="100" width="100" /></div>
                                    <label id="upload-error" class="error" for="upload"></label>  
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.sub_category.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
$("#sub_cate_create11").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        "category_id":{
            required:true,
        },
        "name":{
            required:true,
        },

        "slug":{
            required:true,
        },

        "sub_cate_picture":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: {
     
      "category_id":{
            required:'{{__("messages.sub_category.create.validation.please_select_category")}}',
         },

       "name":{
            required:'{{__("messages.category.create.validation.please_enter_name")}}',
         },

        "slug":{
            required:'{{__("messages.category.create.validation.please_enter_slug")}}',
         },
         
        "sub_cate_picture":{
            required:'{{__("messages.category.create.validation.please_choose_picture")}}',
        },

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
@endsection

