@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Rloe</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.permission.index')}}">Rloe</a>
                            </li>
                            <li class="breadcrumb-item active">create
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
                                <form action="{{route('admin.admin_role.update')}}" enctype="multipart/form-data" method="post" id="role_create">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12 mb-6">
                                            <div class="d-block mb-1">
                                            <input type="hidden" name="Roleid" value="{{$role->id}}">
                                                <label for="role">Role</label>
                                                <input type="text" class="form-control" name="name" id="role" placeholder="Enter Role" value="{{$role->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="d-block mb-1">
                                            <label for="role">Permissions</label>
                                            @foreach($permission as $value)
                                            <div class="flex flex-col justify-cente">
                                                <div class="flex flex-col">
                                                    <label class="inline-flex items-center mt-3">
                                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="permissions[]" value="{{$value->id}}">
                                                        <span class="ml-2 text-gray-700">{{ $value->name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">Update</button>
                                        <a href="{{route('admin.admin_role.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
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