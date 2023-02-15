@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Roles Permission'}}
@endsection
@section('content')

<div class="role-listing-position-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page">@lang('business_messages.menu.Permission')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="wishlist-table">
                    <div class="card-body">
                        @php
                        $user = \App\Models\User::where('role',8)->first();
                        @endphp
                        @if(!empty($user))
                        <form action="{{route('frontend.business.permission.store')}}" enctype="multipart/form-data" method="post" id="role_create">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <div class="d-block mb-1">
                                        <label for="role">Permission</label>
                                        <input type="text" class="form-control" name="Permission_name" id="Permission" placeholder="Enter Permission">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit" class="btn trans-btn">@lang('messages.common.submit')</button>
                                <a href="{{route('frontend.business.permission.index')}}" class="btn trans-btn">@lang('messages.common.reset')</a>
                            </div>
                        </form>
                        @else
                        <form action="{{route('frontend.store.permission.store')}}" enctype="multipart/form-data" method="post" id="role_create">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <div class="d-block mb-1">
                                        <label for="role">Permission</label>
                                        <input type="text" class="form-control" name="Permission_name" id="Permission" placeholder="Enter Permission">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-start">
                                <button type="submit" class="btn trans-btn">@lang('messages.common.submit')</button>
                                <a href="{{route('frontend.store.permission.index')}}" class="btn trans-btn">@lang('messages.common.reset')</a>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                    <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection