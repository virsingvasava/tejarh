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
                     <li class="breadcrumb-item active">@lang('messages.sub_category.edit.edit')
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
                        <form  action="{{route('admin.sub_category.update')}}" enctype="multipart/form-data" method="post" id="sub_cate_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_sub_category->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <label for="status">@lang('messages.sub_category.create.eng_select_category')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id">
                                       <option value="">@lang('messages.sub_category.create.eng_select_category')</option>
                                       @if(!empty($category) && count($category) > 0)
                                       @foreach($category as $key => $cate)
                                       <option value="{{$cate->id}}" {{$cate->id == $edit_sub_category->category_id  ? 'selected' : ''}} >{{ $cate->category_name }}
                                       </option>
                                       @endforeach
                                       @else
                                       @endif
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
                                    <select class="custom-select @error('ar_category_id') is-invalid @enderror" name="ar_category_id">
                                       <option value="">@lang('messages.sub_category.create.ar_select_category')</option>
                                       @if(!empty($category) && count($category) > 0)
                                       @foreach($category as $key => $cate)
                                       <option value="{{$cate->id}}" {{$cate->id == $edit_sub_category->ar_category_id  ? 'selected' : ''}} >{{ $cate->ar_category_name }}
                                       </option>
                                       @endforeach
                                       @else
                                       @endif
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
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="@lang('messages.sub_category.create.enter_name')" value="{{$edit_sub_category->sub_cate_name}}">
                                   @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>

                              <div class="col-md-6 mb-6">
                                 <label for="ar_name">@lang('messages.common.ar_name')</label>
                                 <input type="text" class="form-control @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" placeholder="@lang('messages.sub_category.create.enter_name')" value="{{$edit_sub_category->ar_sub_cate_name}}">
                                   @error('ar_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>

                               <div class="col-md-6 mb-6">
                                 <label for="slug">@lang('messages.sub_category.create.slug')</label>
                                 <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="@lang('messages.sub_category.create.enter_slug')" value="{{$edit_sub_category->slug}}">
                                 @error('slug')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                              </div>

                              <div class="col-md-6 mb-6">
                                 <label for="ar_slug">@lang('messages.common.ar_slug')</label>
                                 <input type="text" class="form-control @error('ar_slug') is-invalid @enderror" name="ar_slug" id="ar_slug" placeholder="@lang('messages.sub_category.create.enter_slug')" value="{{$edit_sub_category->ar_slug}}">
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
                                       <option @if($edit_sub_category->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_sub_category->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                                       <option @if($edit_sub_category->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_sub_category->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                                    <label>@lang('messages.sub_category.create.sub_category_picture')</label>
                                    <br>
                                    <div id="logobtn" class="btn btn-light-secondary" style="width: 100%;" onclick="imageUpload()">@lang('messages.sub_category.edit.upload_sub_category_picture')</div>
                                    <input type="file" id="image" style="display: none;" name="sub_cate_picture" class="image" accept="image/*">
                                 </div>
                                 @if($edit_sub_category->sub_cate_picture != '' && file_exists(public_path('img/sub_category/'.$edit_sub_category->sub_cate_picture)))
                                 <div class="d-block mb-1"><img id="image_preview" src="{{asset('img/sub_category/'.$edit_sub_category->sub_cate_picture)}}" alt="Profile Picture" height="100" width="100"/></div>
                                 @else
                                 <img id="image_preview" style="display: none;" src="#" alt="Profile Picture" height="100" width="100" />
                                 @endif
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
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
$("#sub_cate_edit22").validate({
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

