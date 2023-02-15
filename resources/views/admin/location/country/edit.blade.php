@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.location.country.create.country')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.location.country.index')}}">@lang('messages.location.country.countries')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.location.country.edit.edit')
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
                        <form  action="{{route('admin.location.country.update')}}" enctype="multipart/form-data" method="post" id="country_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_country->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <label for="name">@lang('messages.location.country.create.name')</label>
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$edit_country->name}}" placeholder="@lang('messages.location.country.create.enter_name')">
                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="code">@lang('messages.location.country.create.name')</label>
                                 <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{$edit_country->code}}" placeholder="@lang('messages.location.country.create.enter_code')">
                                  @error('code')
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
                                       <option selected="">@lang('messages.common.select_status')</option>
                                       <option @if($edit_country->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_country->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                   @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                             </div>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                           <a href="{{route('admin.menus.popular_city.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
$("#country_edit").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        "name":{
            required:true,
        },
        "code":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: { 
        
        "name":{
            required:'{{__("messages.location.country.create.validation.please_enter_name")}}',
         },
         
        "code":{
            required:'{{__("messages.location.country.create.validation.please_enter_code")}}',
        },
        "status":{
               required:'{{__("messages.location.country.create.validation.please_select_status")}}',
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
