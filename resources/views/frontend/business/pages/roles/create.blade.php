@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Roles'}}
@endsection
@section('content')

<div class="role-listing-position-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item" aria-current="page">@lang('business_messages.menu.role')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="{{route('frontend.business.add-roles.store')}}" enctype="multipart/form-data" method="post" id="role_create">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-6">
                                <div class="d-block mb-1">
                                    <label for="role">Rloe</label>
                                    <input type="text" class="form-control" name="name" id="role" placeholder="Enter Role">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-6">
                            <div class="d-block mb-1">
                                <label for="role">Permissions</label>
                                <div class="row">
                                    @if(!empty($permission) && count($permission) > 0)
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
                                    @else
                                    <tr>
                                        <td colspan="6">
                                            <div>
                                                <p>@lang('business_messages.role.permission_is_empty')</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.submit')</button>
                            <a href="#" class="btn btn-light-secondary btn_loader">@lang('messages.common.reset')</a>
                        </div>
                    </form>
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