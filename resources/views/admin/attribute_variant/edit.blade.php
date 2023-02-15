@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Attribute - Variant</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.attribute_variant.index')}}">Attribute - Variant</a>
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
                                <form action="{{route('admin.attribute_variant.update')}}" enctype="multipart/form-data" method="post" id="brand_create">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$edit_attribute_variant->id}}">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label for="status">SELECT Attribute</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select @error('attribute_id') is-invalid @enderror" name="attribute_id" id="attribute_id">
                                                    <option value="">Select Attribute</option>
                                                    @foreach($edit_attribute as $key => $cate)
                                                    <option value="{{$cate->id}}"{{$cate->id == $edit_attribute_variant->attribute_id  ? 'selected' : ''}}>{{$cate->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('attribute_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">NAME</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$edit_attribute_variant->name}}" placeholder="@lang('messages.brand.create.enter_name')">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label for="status">SELECT STATUS</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                                    <option value="">Select Status</option>
                                                    <option @if($edit_attribute_variant->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                                    <option @if($edit_attribute_variant->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
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
                                        <a href="{{route('admin.attribute_variant.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
@endsection