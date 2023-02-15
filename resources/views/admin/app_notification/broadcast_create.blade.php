@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Broad-Cast Notification</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Broad-Cast Notification
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Tooltip validations start -->
            <!-- Navigation -->
            <section id="card-navigation">
                <h5 class="mt-3 mb-2"></h5>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="tab-menu">
                                <ul>
                                    <li><a class="tab-a active-a" data-id="group-tab">Group Notification</a></li>
                                    <li><a class="tab-a" data-id="individual-tab">Individual Notification</a></li>
                                    <li><a class="tab-a" data-id="all-tab">All User's</a></li>
                                </ul>
                            </div>
                            <!--end of tab-menu-->
                            <form action="{{route('admin.app-notification.broad_cast_group_store')}}" enctype="multipart/form-data" method="post" id="category_create">
                                @csrf
                                <div class="tab tab-active" data-id="group-tab">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Title <small>(not more than 50 character)</small></label>
                                                <input type="text" class="form-control @error('notification_title') is-invalid @enderror" name="notification_title_group" id="notification_title" value="{{old('notification_title')}}" placeholder="Notification Title" maxlength="50">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="group-select">Select Group</label>
                                                @foreach($getGroup as $group)
                                                <select name="group_id" id="" class="form-control">
                                                    <option value="">Groups</option>
                                                    <option value="{{$group->id}}">GRP - {{$group->id}}</option>
                                                </select>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Message <small>(not more than 160 character)</small></label>
                                                <textarea name="notification_message_group" id="" cols="5" rows="5" class="form-control @error('name') is-invalid @enderror" placeholder="Notification Message" maxlength="160"></textarea>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-start">
                                            <button type="submit" class="btn btn-primary mr-1 loader_class">Send</button>
                                            <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('admin.app-notification.broad_cast_individual_store')}}" enctype="multipart/form-data" method="post" id="category_create">
                                @csrf
                                <div class="tab " data-id="individual-tab">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Title <small>(not more than 50 character)</small></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="notification_title" id="notification_title" value="{{old('notification_title')}}" placeholder="Notification Title" maxlength="50">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6 group-nf">
                                            <div class="d-block mb-1">
                                                <label for="name" class="control-label asterisk" for="firstname">Select Users:</label>
                                                <div class="custom-multiple-select">
                                                    <select class="js-example-basic-multiple" name="user_id[]" multiple="multiple">
                                                        @foreach($getUsers as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->first_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Message <small>(not more than 160 character)</small></label>
                                                <textarea name="notification_message" id="" cols="5" rows="5" class="form-control @error('notification_message') is-invalid @enderror" placeholder="Notification Message" maxlength="160"></textarea>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 loader_class">Send</button>
                                        <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('admin.app-notification.broad_cast_all_store')}}" enctype="multipart/form-data" method="post" id="category_create">
                                @csrf
                                <div class="tab " data-id="all-tab">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Title <small>(not more than 50 character)</small></label>
                                                <input type="text" class="form-control @error('notification_title') is-invalid @enderror" name="notification_title_all" id="notification_title" value="{{old('notification_title')}}" placeholder="Notification Title" maxlength="50">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <div class="d-block mb-1">
                                                <label for="name">Notification Message <small>(not more than 160 character)</small></label>
                                                <textarea name="notification_message_all" id="" cols="5" rows="5" class="form-control @error('notification_message') is-invalid @enderror" placeholder="Notification Message" maxlength="160"></textarea>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-start">
                                            <button type="submit" class="btn btn-primary mr-1 loader_class">Send</button>
                                            <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--end of container-->
            </section>
            <!--/ Navigation -->
            <!-- Tooltip validations end -->
        </div>
    </div>
</div>
<!-- END: Content-->
<style type="text/css">
    .nav-tabs .nav-link {
        font-size: 13px;
        background-color: rgba(90, 141, 238, 0.17);
    }

    .tab-container {
        margin: 5% 10%;
        background-color: #c1e3d9;
        padding: 3%;
        border-radius: 4px;
    }

    .tab-menu {
        margin: 0 0 30px;
    }

    .tab-menu ul {
        margin: 0;
        padding: 0;
    }

    .tab-menu ul li {
        list-style-type: none;
        display: inline-block;
        margin: 0 10px 0 0;
    }

    .tab-menu ul li a {
        text-decoration: none;
        color: #5A8DEE;
        background-color: #b4cbc4;
        padding: 7px 25px;
        border-radius: 4px;
        font-size: 13px;
        background-color: rgba(90, 141, 238, 0.17);
        cursor: pointer;
    }

    .tab-menu ul li a.active-a,
    .tab-menu ul li a:hover {
        color: #FFFFFF;
        background-color: #5A8DEE;
    }

    .tab {
        display: none;
    }

    .tab h2 {
        color: rgba(0, 0, 0, .7);
    }

    .tab p {
        color: rgba(0, 0, 0, 0.6);
        text-align: justify;
    }

    .tab-active {
        display: block;
    }
</style>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.tab-a').click(function() {
            jQuery(".tab").removeClass('tab-active');
            jQuery(".tab[data-id='" + jQuery(this).attr('data-id') + "']").addClass("tab-active");
            jQuery(".tab-a").removeClass('active-a');
            jQuery(this).parent().find(".tab-a").addClass('active-a');
        });
    });
</script>
@endsection