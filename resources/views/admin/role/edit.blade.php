@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.role.role')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">@lang('messages.role.roles')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.common.edit')
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
                        <form  action="{{route('admin.role.update')}}" enctype="multipart/form-data" method="post" id="role_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_role->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="name">@lang('messages.role.name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$edit_role->name }}" placeholder="@lang('messages.role.create.enter_name')">
                                    @error('name')
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
                                       <option @if($edit_role->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_role->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="form-group">
                                    <label>@lang('messages.role.picture')</label> <br>
                                    <input type="file" name="role_picture" class="picture" onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">@lang('messages.role.create.choose_file')</label>
                                    <div class="d-block mt-1"><img id="role_image_preview" style="display: none;" src="#" height="100" width="100" /></div>
                                    <label id="upload-error" class="error" for="upload"></label> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.role.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
$("#role_edit").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
    
        "user_type":{
            required:true,
        },

        "role":{
            required:true,
        },

        "name":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: {

        "user_type":{
            required:'{{__("messages.role.create.validation.please_select_user_type")}}',
         },
         
        "role":{
            required:'{{__("messages.role.create.validation.please_enter_role")}}',
        },

        "name":{
            required:'{{__("messages.role.create.validation.please_enter_name")}}',
        },

        "status":{
               required:'{{__("messages.role.create.validation.please_select_status")}}',
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
@endsection


