@extends('layouts.app_admin')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Group Notification</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.app-notification.index')}}">Group Notification</a>
                            </li>
                            <li class="breadcrumb-item active">Create Group Notification
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Tooltip validations start -->
            <section id="tooltip-validation" class="group-nf">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div> -->
                            <div class="card-body">
                                <form action="{{route('admin.app-notification.store')}}" enctype="multipart/form-data" method="post" id="category_create">
                                    @csrf
                                    <div class="control-group">
                                        <label class="control-label asterisk" for="firstname">Select Users:</label>
                                        <div class="custom-multiple-select">
                                            <select class="js-example-basic-multiple" name="names[]" multiple="multiple">
                                                @foreach($getUsers as $key => $value)
                                                <option value="{{$value->id}}">{{$value->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-start mt-2">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                                        <a href="{{route('admin.app-notification.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
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
<style>
    .group-nf .select2-container {
        width: 100% !important;
    }

    .group-nf .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        left: 3px;
        padding: 0 3px 0 0px;
        margin: 0 3px 0 0;
    }

    .group-nf .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
    .group-nf .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
        background-color: #5A8DEE !important;
    }
</style>
@endsection