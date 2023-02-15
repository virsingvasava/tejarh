@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Roles Permission'}}
@endsection
@section('content')

<div class="role-listing-position-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page">@lang('business_messages.menu.Permission')</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3">
            @if(Auth::user()->role == STORE_ROLE)
            <a href="{{route('frontend.store.permission.create')}}" class="btn trans-btn">@lang('business_messages.role.add_permission')</a>
            @else
            <a href="{{route('frontend.business.permission.create')}}" class="btn trans-btn">@lang('business_messages.role.add_permission')</a>
            @endif
            </div>
            <div class="col-md-6">
                @if(Auth::user()->role == STORE_ROLE)
                <a href="{{route('frontend.store.store_user.index')}}" class="btn trans-btn">@lang('business_messages.role.add_user')</a>
                @else
                <a href="{{route('frontend.business.business_user.index')}}" class="btn trans-btn">@lang('business_messages.role.add_user')</a>
                @endif
                @if(Auth::user()->role == STORE_ROLE)
                <a href="{{ route('frontend.store.add-roles.index')}}" class="btn trans-btn">@lang('business_messages.role.role')</a>
                @else
                <a href="{{ route('frontend.business.add-roles.index')}}" class="btn trans-btn">@lang('business_messages.role.role')</a>
                @endif
                <!-- <a href="{{route('frontend.business.permission.index')}}" class="btn trans-btn">@lang('business_messages.role.Permission')</a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="wishlist-table">
                    <table>
                        <tr>
                            <th>sr_no</th>
                            <th>Permission Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        @if(!empty($permission) && count($permission) > 0)
                        <?php $i = 1; ?>
                        @foreach($permission as $value)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->slug}}</td>
                            <td><a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id=""><i class="bx bx-trash mr-1"></i></a></td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">
                                <div>
                                    <p>@lang('business_messages.role.permission_is_empty')</p>
                                </div>
                            </td>
                        </tr>
                        @endif

                    </table>
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