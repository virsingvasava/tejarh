@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.brand.create.brand')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.brand.index')}}">@lang('messages.brand.brands')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.brand.create.create')
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
                        <form  action="{{route('admin.brand.store')}}" enctype="multipart/form-data" method="post" id="brand_create">
                           @csrf
                           <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="status">@lang('messages.brand.eng_select_category')</label>
                                    <fieldset class="form-group">
                                        <select id="categoryArr" class="custom-select @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            <option value="">@lang('messages.brand.eng_select_category')</option>
                                            @foreach ($category as $cate)
                                                <option value="{{ $cate->id }}">{{ $cate->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-md-6 mb-6" style="display:none">
                                    <label for="ar_sub_category_id">@lang('messages.brand.ar_select_category')</label>
                                    <fieldset class="form-group">
                                        <select
                                            class="custom-select @error('ar_sub_category_id') is-invalid @enderror"
                                            name="ar_sub_category_id">
                                            <option value="">@lang('messages.brand.ar_select_category')</option>
                                            @foreach ($category as $cate)
                                                <option value="{{ $cate->id }}">
                                                    {{ $cate->ar_category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ar_sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">@lang('messages.brand.eng_select_sub_category')</label>
                                 <fieldset class="form-group">
                                    <select class="select2 custom-select subCategory @error('subCate[]') is-invalid @enderror" name="subCate[]" multiple="multiple">
                                       <option value="">@lang('messages.brand.eng_select_sub_category')</option>
                                        @foreach ($sub_category as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->sub_cate_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subCate[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6" style="display:none">
                                 <label for="ar_sub_category_id">@lang('messages.brand.ar_select_sub_category')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('ar_sub_category_id') is-invalid @enderror" name="ar_sub_category_id">
                                       <option value="">@lang('messages.brand.ar_select_sub_category')</option>
                                       @foreach ($sub_category as $cate)
                                       <option value="{{ $cate->id }}">{{ $cate->ar_sub_cate_name}}</option>
                                       @endforeach
                                    </select>
                                    @error('ar_sub_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="name">@lang('messages.common.eng_name')</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.brand.create.enter_name')">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="ar_name">@lang('messages.common.ar_name')</label>
                                    <input type="text" class="form-control @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" value="{{old('ar_name')}}" placeholder="@lang('messages.brand.create.enter_name')">
                                    @error('ar_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="model">@lang('messages.common.eng_model')</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" id="model" value="{{old('model')}}" placeholder="@lang('messages.brand.create.enter_model')">
                                    @error('model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="ar_model">@lang('messages.common.ar_model')</label>
                                    <input type="text" class="form-control @error('ar_model') is-invalid @enderror" name="ar_model" id="ar_model" value="{{old('ar_model')}}" placeholder="@lang('messages.brand.create.enter_model')">
                                    @error('ar_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="slug">@lang('messages.common.eng_slug')</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{old('slug')}}" placeholder="@lang('messages.brand.create.enter_slug')">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="ar_slug">@lang('messages.common.ar_slug')</label>
                                    <input type="text" class="form-control @error('ar_slug') is-invalid @enderror" name="ar_slug" id="ar_slug" value="{{old('ar_slug')}}" placeholder="@lang('messages.brand.create.enter_slug')">
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
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.brand.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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

<script src="{{ asset('build/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('build/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>


<script type="text/javascript">
$("#brand_create").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        
        "sub_category_id":{
            required:true,
        },
        "name":{
            required:true,
        },

        "model":{
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

        "sub_category_id":{
            required:'{{__("messages.brand.create.validation.please_select_sub_category")}}',
         },

        "name":{
            required:'{{__("messages.brand.create.validation.please_enter_name")}}',
         },
         
        "model":{
            required:'{{__("messages.brand.create.validation.please_enter_model")}}',
        },

        "slug":{
            required:'{{__("messages.brand.create.validation.please_enter_slug")}}',
        },
        "status":{
               required:'{{__("messages.brand.create.validation.please_select_status")}}',
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#categoryArr').change(function(e) {
            var cat_id = e.target.value;
            var token = "{{ csrf_token() }}";
            if (cat_id) {
                $.ajax({
                    url: "{{ route('admin.brand.subCategories') }}",
                    data: {
                        cat_id: cat_id,
                        _token: token
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subCate[]"]').empty();
                        $('select[name="subCate[]"]').append('<option value="">@lang('messages.brand.eng_select_sub_category')</option>');
                        $.each(data, function(key, value) {
                            $('select[name="subCate[]"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                        $('select[name="subCate[]"]').niceSelect('update');
                    }
                });
            } else {
                $('select[name="subCate[]"]').empty();
            }

        });
    });
</script>
@endsection

