@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.delivery_type.delivery_type')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.delivery_type.index')}}">@lang('messages.delivery_type.delivery_types')</a>
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
                        <form  action="{{route('admin.delivery_type.update')}}" enctype="multipart/form-data" method="post" id="delivery_type_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_deliveryType->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="name">@lang('messages.delivery_type.eng_name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="@lang('messages.delivery_type.create.eng_enter_name')" value="{{$edit_deliveryType->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                   <label for="ar_name">@lang('messages.delivery_type.ar_name')</label>
                                   <input type="text" class="form-control @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" placeholder="@lang('messages.delivery_type.create.ar_enter_name')" value="{{$edit_deliveryType->ar_name}}">
                                   @error('ar_name')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                                 </div>
                             </div>
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="slug">@lang('messages.delivery_type.eng_slug')</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="@lang('messages.delivery_type.create.eng_enter_slug')" value="{{$edit_deliveryType->slug}}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                   <label for="ar_slug">@lang('messages.delivery_type.ar_slug')</label>
                                   <input type="text" class="form-control @error('ar_slug') is-invalid @enderror" name="ar_slug" id="ar_slug" placeholder="@lang('messages.delivery_type.create.ar_enter_slug')" value="{{$edit_deliveryType->ar_slug}}">
                                   @error('ar_slug')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                                 </div>
                             </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">@lang('messages.common.eng_select_status')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                       <option value="">@lang('messages.common.eng_select_status')</option>
                                       <option @if($edit_deliveryType->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_deliveryType->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                                       <option value="">@lang('messages.common.ar_select_status')</option>
                                       <option @if($edit_deliveryType->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_deliveryType->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                    @error('ar_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.delivery_type.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
$("#delivery_type_edit").validate({
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
            required:'{{__("messages.delivery_type.create.validation.please_enter_name")}}',
         },

        "slug":{
            required:'{{__("messages.delivery_type.create.validation.please_enter_slug")}}',
         },
        "status":{
               required:'{{__("messages.delivery_type.create.validation.please_select_status")}}',
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


