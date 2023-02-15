@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.menus.popular_city.create.popular_city')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.menus.popular_city.index')}}">@lang('messages.menus.popular_city.create.popular_cities')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.menus.popular_city.create.create')
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
                        <form  action="{{route('admin.menus.popular_city.store')}}" enctype="multipart/form-data" method="post" id="popular_city_create">
                           @csrf
                           <div class="form-row">
                              <input type="hidden" name="type" value="2">
                              <div class="col-md-6 mb-6">
                                 <label for="name">@lang('messages.menus.popular_city.name')</label>
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.menus.popular_city.create.enter_name')">
                                 @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="url">@lang('messages.menus.popular_city.name')</label>
                                 <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{old('url')}}" id="url" placeholder="@lang('messages.menus.popular_city.create.enter_url')">

                                 @error('url')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                <div class="d-block mt-1">
                                     <label for="status">@lang('messages.common.select_status')</label>
                                     <fieldset class="form-group">
                                        <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                           <option value="">@lang('messages.common.select_status')</option>
                                           <option value="1">@lang('messages.common.active')</option>
                                           <option value="0">@lang('messages.common.In_active')</option>
                                        </select>
                                        @error('name')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                     </fieldset>
                                </div>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                           <a href="{{route('admin.menus.popular_city.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
$("#popular_city_create22").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        "name":{
            required:true,
        },
        "url":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: {
        "name":{
            required:'{{__("messages.menus.popular_city.create.validation.please_enter_name")}}',
        },
        
        "url":{
            required:'{{__("messages.menus.popular_city.create.validation.please_enter_url")}}',
        },
        "status":{
            required:'{{__("messages.menus.popular_city.create.validation.please_select_status")}}',
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

