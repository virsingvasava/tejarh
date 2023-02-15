@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Support Category</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.support-categories.index')}}">Support Categories</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.category.edit.edit')
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
                                <form action="{{route('admin.support-categories.update')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$edit_category->id}}">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">@lang('messages.common.eng_name')</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="@lang('messages.category.create.enter_name')" value="{{$edit_category->support_category_name}}">
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
                                                <input type="text" class="form-control @error('ar_name') is-invalid @enderror" name="ar_name" id="ar_name" placeholder="@lang('messages.category.create.enter_name')" value="{{$edit_category->ar_support_category_name}}">
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
                                                    <option value="">@lang('messages.common.eng_select_status')</option>
                                                    <option @if($edit_category->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                                    <option @if($edit_category->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
                                                </select>
                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                        </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.category.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('error'))
        toastr.error('{{ Session::get('error ') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success ') }}');
        @endif
    });
</script>

@endsection