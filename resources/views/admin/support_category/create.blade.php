@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.support_category.support_category')</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.support-categories.index')}}">@lang('messages.support_category.support_categories')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.support_category.create.create')
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
                                <form action="{{route('admin.support-categories.store')}}" enctype="multipart/form-data" method="post" id="support_category_create">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">@lang('messages.support_category.create.eng_name')</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.category.create.enter_name')">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="ar_name">@lang('messages.support_category.create.ar_name')</label>
                                                <input type="text" class="form-control @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" value="{{old('ar_name')}}" placeholder="@lang('messages.category.create.enter_name')">
                                                @error('ar_name')
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
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.support-categories.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
    $("#support_category_create").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {

            "name": {
                required: true,
            },
            "status": {
                required: true,
            },
        },
        messages: {

            "name": {
                required: '{{__("messages.support_category.create.please_enter_name")}}',
            },
            "status": {
                required: '{{__("messages.support_category.create.please_select_status")}}',
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