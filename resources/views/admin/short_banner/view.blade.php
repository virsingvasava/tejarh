@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Banner Details</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.short_banner.index')}}">Banner</a>
                            </li>
                            <li class="breadcrumb-item active">Details
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="menu_view">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration or-view">
                                        <tbody>
                                            <tr>
                                                <th>Banner Picture</th>
                                                <td>
                                                    @if($view_short_banner->short_banners_image != '' && file_exists(public_path('assets/short_banners/'.$view_short_banner->short_banners_image)))
                                                    <img src="{{asset('assets/short_banners/'.$view_short_banner->short_banners_image)}}" style="height: 70px; width: 70px;" alt="General Picture" class="img-profile rounded-circle" />
                                                    @else
                                                    <img src="{{asset('assets/short_banners/placeholder.svg')}}" alt="" style="height: 70px; width: auto;" class="img-profile rounded-circle" />
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ucfirst($view_short_banner->title)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if($view_short_banner->status == 1)
                                                    <span style="color:green;">Active</span> @else <span style="color:red;">InActive</span> @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->

<style type="text/css">
    .or-view td {
        border-top: 1px solid #DFE3E7;
    }
</style>
@endsection