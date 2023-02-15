@extends('layouts.app_admin')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.user.app_users')</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">@lang('messages.user.app_users')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.role.create.create')
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
                                <form action="{{route('admin.admin_user.store')}}" enctype="multipart/form-data" method="post" id="role_create">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="role">@lang('messages.user.name')</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"  placeholder="Enter Name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="role">@lang('messages.user.phone_number')</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Enter Phone number">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="role">@lang('messages.user.email')</label>
                                                <input type="email" class="form-control @error('name') is-invalid @enderror" name="email" id="email"  placeholder="Enter Email">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="role">Password</label>
                                                <input type="password" class="form-control @error('name') is-invalid @enderror" name="password" id="password"  placeholder=" Enter Password">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label for="status">Select Role</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select @error('status') is-invalid @enderror" name="role">
                                                    <option value="">Select Role</option>
                                                    @foreach($role as $value)
                                                    <option value="{{$value->id}}">{{ucfirst($value->name)}}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <!-- <div class="col-md-6 mb-6">
                                 <div class="form-group">
                                    <label>@lang('messages.role.picture')</label> <br>
                                    <input type="file" name="role_picture" class="picture" onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">@lang('messages.role.create.choose_file')</label>
                                    <div class="d-block mt-1"><img id="role_image_preview" style="display: none;" src="#" height="100" width="100" /></div>
                                    <label id="upload-error" class="error" for="upload"></label> 
                                 </div>
                              </div> -->


                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.admin_index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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
@endsection