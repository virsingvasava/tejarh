@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.slider.create.sliders_create')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="#">@lang('messages.slider.create.slider')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.slider.create.create')
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
                        <form  action="{{route('admin.slider.store')}}" enctype="multipart/form-data" method="post" id="slider_create">
                           @csrf
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <label for="banner_heading_title">@lang('messages.slider.create.eng_heading_title')</label>
                                 <input type="text" class="form-control @error('banner_heading_title') is-invalid @enderror" name="banner_heading_title" value="{{old('banner_heading_title')}}" id="banner_heading_title" placeholder="@lang('messages.slider.create.enter_heading_title')">
                                @error('banner_heading_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                <label for="ar_banner_heading_title">@lang('messages.slider.create.ar_heading_title')</label>
                                <input type="text" class="form-control @error('banner_heading_title') is-invalid @enderror" name="ar_banner_heading_title" value="{{old('ar_banner_heading_title')}}" id="banner_heading_title" placeholder="@lang('messages.slider.create.enter_heading_title')">
                               @error('ar_banner_heading_title')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                             </div>
                              <div class="col-md-6 mb-6">
                                 <label for="banner_sub_heading_title">@lang('messages.slider.create.eng_sub_heading_title')</label>
                                 <input type="text" class="form-control @error('banner_sub_heading_title') is-invalid @enderror" name="banner_sub_heading_title" value="{{old('banner_sub_heading_title')}}" id="banner_sub_heading_title" placeholder="@lang('messages.slider.create.enter_sub_heading_title')">
                                @error('banner_sub_heading_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                <label for="banner_sub_heading_title">@lang('messages.slider.create.ar_sub_heading_title')</label>
                                <input type="text" class="form-control @error('banner_sub_heading_title') is-invalid @enderror" name="banner_sub_heading_title" value="{{old('banner_sub_heading_title')}}" id="banner_sub_heading_title" placeholder="@lang('messages.slider.create.enter_sub_heading_title')">
                               @error('banner_sub_heading_title')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                             </div>
                              <div class="col-md-12 mb-12">
                                <label for="banner_description">@lang('messages.slider.create.eng_description')</label>
                                <textarea id="banner_description" class="form-control @error('banner_description') is-invalid @enderror" 
                                name="banner_description" value="{{old('banner_description')}}"  rows="5" maxlength="255"  placeholder="@lang('messages.slider.create.eng_description')"></textarea>
                                @error('banner_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-md-12 mb-12">
                               <label for="ar_banner_description">@lang('messages.slider.create.ar_description')</label>
                               <textarea id="ar_banner_description" class="form-control @error('ar_banner_description') is-invalid @enderror" 
                               name="ar_banner_description" value="{{old('ar_banner_description')}}"  rows="5" maxlength="255"  placeholder="@lang('messages.slider.create.ar_description')"></textarea>
                               @error('ar_banner_description')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                             </div> 
                              <div class="col-md-4 mb-3">
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
                              <div class="col-md-4 mb-3">
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
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                   <label>@lang('messages.slider.create.slider_picture')</label> <br>
                                   <input type="file" name="banner_picture" class="offerbannerImg" onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">@lang('messages.common.choose_file')</label>
                                   <img id="offer_banner_image_preview" style="display: none;" src="#" height="100" width="100" />
                                   <label id="upload-error" class="error" for="upload"></label>  
                                </div>
                             </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.slider.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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

    $("#slider_create").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "banner_heading_title":{
                required:true,
            },
            "banner_sub_heading_title":{
                required:true,
            },

            "banner_description":{
                required:true,
            },
            "banner_picture":{
                required:true,
            },
            
            "status":{
                required:true,
            },
        },
        messages: {
            "banner_heading_title":{
                required:'{{__("messages.slider.create.validation.banner_heading_title")}}',
            },
            
            "banner_sub_heading_title":{
                required:'{{__("messages.slider.create.validation.banner_sub_heading_title")}}',
            },

            "banner_description":{
                required:'{{__("messages.slider.create.validation.banner_description")}}',
            },
            
            "banner_picture":{
                required:'{{__("messages.slider.create.validation.banner_picture")}}',
            },

            "status":{
                required:'{{__("messages.slider.create.validation.status")}}',
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

    $(document).on('change','.offerbannerImg',function(){
        $('#offer_banner_image_preview').hide();
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#offer_banner_image_preview').attr('src', e.target.result);
                $('#offer_banner_image_preview').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function itemImageUpload() {
         document.getElementById("offerbannerImg").click();
    }
 </script>

@endsection

