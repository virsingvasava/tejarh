@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.short_banner.create.short_banner')</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.short_banner.index')}}">@lang('messages.short_banner.short_banner')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.short_banner.edit.edit')
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
                                <form action="{{route('admin.short_banner.update')}}" enctype="multipart/form-data" method="post" id="short_banner_create">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$edit_short_banner->id}}">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="title">@lang('messages.short_banner.create.eng_title')</label>
                                                <input type="text" class="form-control @error('title') 
                                                is-invalid @enderror" name="title" id="title" placeholder="@lang('messages.short_banner.create.enter_name')" 
                                                value="{{$edit_short_banner->title}}">
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="ar_title">@lang('messages.short_banner.create.ar_title')</label>
                                                <input type="text" class="form-control @error('ar_title') 
                                                is-invalid @enderror" name="ar_title" id="ar_title" placeholder="@lang('messages.short_banner.create.enter_name')" 
                                                value="{{$edit_short_banner->ar_title}}">
                                                @error('ar_title')
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
                                                  <option @if($edit_short_banner->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                                  <option @if($edit_short_banner->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                                                  <option @if($edit_short_banner->ar_status == 1) selected="selected" @endif value="1">@lang('messages.common.ar_active')</option>
                                                  <option @if($edit_short_banner->ar_status == 0) selected="selected" @endif value="0">@lang('messages.common.ar_In_active')</option>
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
                                                <label>@lang('messages.short_banner.create.short_banner_picture')</label>
                                                <br>
                                                <div id="logobtn" class="btn btn-light-secondary" 
                                                style="width: 100%;" onclick="imageUpload()"
                                                >@lang('messages.short_banner.edit.upload_short_banner_picture')</div>
                                                <input type="file" id="image" style="display: none;" name="short_banners_image" 
                                                class="image" accept="image/*">
                                            </div>
                                            @if($edit_short_banner->short_banners_image != '' && file_exists(public_path('assets/short_banners/'.$edit_short_banner->short_banners_image)))
                                            <div class="d-block mb-1"><img id="image_preview" src="{{asset('assets/short_banners/'.$edit_short_banner->short_banners_image)}}" alt="Profile Picture" height="100" width="100" /></div>
                                            @else
                                            <div class="d-block mb-1"> <img id="image_preview" 
                                            style="display: none;" src="#" alt="Profile Picture" height="100" width="100" />
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.wholesale_general.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<script type="text/javascript">
    $("#wholesale_general_create").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {

            "title": {
                required: true,
            },
            
            "status": {
                required: true,
            },
        },
        messages: {

            "title": {
                required: '{{__("messages.short_banner.create.validation.please_enter_name")}}',
            },

            "status": {
                required: '{{__("messages.short_banner.create.validation.please_select_status")}}',
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
    $(document).on('change', '.image', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function imageUpload() {
        document.getElementById("image").click();
    }
</script>
@endsection