@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.location.city.city')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.location.city.index')}}">@lang('messages.location.city.city_list')</a>
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
                        <form  action="{{route('admin.location.city.update_city')}}" enctype="multipart/form-data" method="post" id="edit_city">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_city->id}}">
                           <div class="form-row">

                              <div class="col-md-12 mb-12">
                                 <label for="status">@lang('messages.location.city.create.select_country')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('country_id') is-invalid @enderror" name="country_id">
                                       <option value="">@lang('messages.location.city.create.select_country')</option>
                                       @if(!empty($countries) && count($countries) > 0)
                                       @foreach($countries as $key => $coun)
                                       <option value="{{$coun->id}}" {{$coun->id == $edit_city->country_id  ? 'selected' : ''}} >{{$coun->name}}
                                       </option>
                                       @endforeach
                                       @else
                                       @endif
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                 </fieldset>
                              </div>

                              <div class="col-md-12 mb-12">
                                 <label for="status">@lang('messages.location.city.create.select_state')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('state_id') is-invalid @enderror" name="state_id" id="statesList">

                                      <!--  <option value="">@lang('messages.location.city.create.select_state')</option>
                                       @if(!empty($states) && count($states) > 0)
                                       @foreach($states as $key => $state)
                                       <option value="{{$state->id}}" {{$state->id == $edit_city->state_id  ? 'selected' : ''}} >{{$state->name}}
                                       </option>
                                       @endforeach
                                       @else
                                       @endif -->

                                    </select>
                                     @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                              </div>

                              <div class="col-md-6 mb-6">
                                 <label for="name">@lang('messages.location.city.name')</label>
                                 <input type="text" class="form-control" name="name" id="name" value="{{$edit_city->name}}" placeholder="@lang('messages.location.city.create.enter_name')">
                                 @error('name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="slug">@lang('messages.location.city.slug')</label>
                                 <input type="text" class="form-control" name="slug" id="slug" value="{{$edit_city->slug}}" placeholder="@lang('messages.location.city.create.enter_slug')">
                                 @error('slug')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>
                              <div class="col-md-12 mb-12">
                                 <div class="d-block mt-1">
                                    <label for="status">@lang('messages.common.select_status')</label>
                                    <fieldset class="form-group">
                                       <select class="custom-select" id="customSelect" name="status">
                                          <option value="">@lang('messages.common.select_status')</option>
                                          <option @if($edit_city->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                          <option @if($edit_city->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                           <a href="{{route('admin.location.city.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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

$("#city_edit").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        "country_id":{
            required:true,
        },
        "state_id":{
            required:true,
        },
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

        "country_id":{
            required:'{{__("messages.location.city.create.validation.please_select_country")}}',
        },
        "state_id":{
            required:'{{__("messages.location.city.create.validation.please_select_state")}}',
        },
        "slug":{
            required:'{{__("messages.location.city.create.validation.please_enter_name")}}',
        },
        "status":{
            required:'{{__("messages.location.city.create.validation.please_enter_slug")}}',
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


$(document).ready(function(){
   $('#countryArr').change(function() {
   var country_id = $(this).val();
   var token = "{{csrf_token()}}";
   $('#state').html('');
    $.ajax({            
        url:"{{ route('admin.location.city.state_listing') }}",
        type:"POST",
        data: {country_id: country_id,_token:token},
        success:function (res) {
         $('#statesList').html('<option value="">Select State</option>');
         $.each(res, function (key, value) {
             $('#statesList').append('<option value="' + value
                 .id + '">' + value.name + '</option>');
         });
        }
    })
               
  });  
});

</script>
@endsection
