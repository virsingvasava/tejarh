@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Attribute</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.attribute.index')}}">Attribute</a>
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
                                <form action="{{route('admin.attribute.store')}}" enctype="multipart/form-data" method="post" id="brand_create">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label for="status">SELECT CATEGORY</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select  @error('category_id') is-invalid @enderror" name="category_id" id="categoryArr">
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $cate)
                                                    <option value="{{ $cate->id }}">{{ $cate->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12 mb-12">
                                            <label for="status">SELECT SUB CATEGORY</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select @error('sub_category_id') is-invalid @enderror" name="sub_category_id" id="subcategoryList">
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                                @error('sub_category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">NAME</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="@lang('messages.brand.create.enter_name')">
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
                                        <a href="{{route('admin.attribute.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
    $(document).ready(function() {
        $('#categoryArr').change(function() {
            var category_id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: "{{ route('admin.product.sub_category_listing') }}",
                type: "POST",
                data: {
                    category_id: category_id,
                    _token: token
                },
                success: function(res) {
                    $('#subcategoryList').html('<option value=""> --- Select --- </option>');
                    $.each(res, function(key, value) {
                        $('#subcategoryList').append('<option value="' + value
                            .id + '">' + value.sub_cate_name + '</option>');
                    });
                }
            })
        });

        $('#subcategoryList').change(function() {
            var sub_category_id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: "{{ route('admin.product.brand_listing') }}",
                type: "POST",
                data: {
                    sub_category_id: sub_category_id,
                    _token: token
                },
                success: function(res) {
                    $('#brandList').html('<option value=""> --- Select --- </option>');
                    $.each(res, function(key, value) {
                        $('#brandList').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            })
        });
    });
</script>

<script type="text/javascript">
    $(document).on('change', '.cate_picture', function() {
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

@endsection