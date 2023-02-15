@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.cms.cms_page')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.cms.index')}}">@lang('messages.cms.cms_pages')</a>
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
                        <form  action="{{route('admin.cms.update')}}" enctype="multipart/form-data" method="post" id="cms_page_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$page->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="title">@lang('messages.cms.title')</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"  value="{{$page->title}}" placeholder="@lang('messages.cms.create.enter_name')">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="slug">@lang('messages.cms.short_description')</label>
                                    <input type="text" class="form-control @error('short_description') is-invalid @enderror" value="{{$page->short_description}}" name="short_description" placeholder="Short Description">
                                    @error('short_description')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                  </div>
                              </div>

                              <div class="col-md-12 mb-12">
                                  <div class="d-block mb-1">
                                       <label for="slug">@lang('messages.cms.description')</label>
                                       <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Description">{{$page->description}}</textarea>
                                       @error('description')
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
                                       <option @if($page->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($page->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                              <a href="{{route('admin.cms.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
$("#cms_page_edit").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        
        "title":{
            required:true,
        },

        "short_description":{
            required:true,
        },
        "description":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: {

        "title":{
            required:'{{__("messages.cms.create.validation.please_enter_title")}}',
         },
         
        "short_description":{
            required:'{{__("messages.cms.create.validation.please_enter_short_description")}}',
        },
        "description":{
            required:'{{__("messages.cms.create.validation.please_enter_description")}}',
        },
        "status":{
               required:'{{__("messages.cms.create.validation.please_select_status")}}',
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


