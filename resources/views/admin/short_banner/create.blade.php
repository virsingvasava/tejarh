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
                            <li class="breadcrumb-item active">@lang('messages.short_banner.create.create')
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
                                <form action="{{route('admin.short_banner.store')}}" enctype="multipart/form-data" method="post" id="short_banner_create">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="title">@lang('messages.short_banner.create.eng_title')</label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}" placeholder="@lang('messages.short_banner.create.enter_name')">
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="ar_title">@lang('messages.short_banner.create.ar_ar_title')</label>
                                                <input type="text" class="form-control @error('ar_title') is-invalid @enderror" name="ar_title" id="ar_title" value="{{old('ar_title')}}" placeholder="@lang('messages.short_banner.create.enter_name')">
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
                                                  <option value="1">@lang('messages.common.ar_active')</option>
                                                  <option value="0">@lang('messages.common.ar_In_active')</option>
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
                                                <label>@lang('messages.short_banner.create.short_banner_picture')</label> <br>
                                                <input type="file" name="short_banners_image" class="short_banners_image" 
                                                onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden />
                                                <label class="image_upload_btn" for="upload">@lang('messages.short_banner.create.choose_file')</label>
                                                <div class="d-block mt-1"><img id="short_banners_image_preview"
                                                 style="display: none;" src="#" height="100" width="100" /></div>
                                                <label id="upload-error" class="error" for="upload"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.short_banner.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
    $("#short_banner_create").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {

            "title": {
                required: true,
            },

            "short_banners_image": {
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

            "short_banners_image": {
                required: '{{__("messages.short_banner.create.validation.please_choose_picture")}}',
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
    $(document).on('change', '.short_banners_image', function() {
        $('#short_banners_image_preview').hide();
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#short_banners_image_preview').attr('src', e.target.result);
                $('#short_banners_image_preview').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function itemImageUpload() {
        document.getElementById("short_banners_image").click();
    }
</script>
@endsection