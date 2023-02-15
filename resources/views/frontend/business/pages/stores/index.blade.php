@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business Store'}}
@endsection

@section('content')
<br><br>
<div class="profile-seller business-profile-seller">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.add_store.store_list')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <!-- end story-wrapper -->
                <!-- pagination-hidden-section  start-->
                <div class="row">
                    <div class="pagination-hidden-section">
                        <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                    </div>
                </div>
                <!-- pagination-hidden-section  end-->
                <div class="products-wrapper">
                    <div class="row" id="pagingBox">
                        <div class="col-md-4">
                            <div class="products-box add-items">
                                <a href="{{ route('frontend.business.add-store.create_store') }}">
                                    <img src="{{ asset('assets/images/add-items-icon.png')}}">
                                    <h5>@lang('business_messages.add_store.add_store')</h5>
                                </a>
                            </div>
                        </div>
                        @if (!empty($store) && count($store) > 0)
                        @foreach ($store as $key => $value)
                        <div class="col-md-4">
                            <div class="products-box">
                                <div class="products-box-img">
                                    <a href="">
                                        @if (!empty($value['store_logo_file']))
                                        <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['store_logo_file']) }}">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="products-box-content">
                                    @if (isset($value['shop_sign_file']) && !empty($value['shop_sign_file']))
                                    <img src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['shop_sign_file']) }}" width="32" height="32">
                                    @else
                                    <img src="{{ asset('assets/images/user.png') }}" width="32" height="32">
                                    @endif
                                    <h6>{{ $value->store_name }}</h6>
                                    <p>{{ $value->store_location }}</p>
                                    <p>{{ $value->phone_code }} - {{ $value->phone_number }}</p>

                                    <div class="products-box-footer">
                                        <a class="" href="{{route('frontend.business.add-store.edit',$value['id'])}}" style="margin-right:10px;">
                                            <i class="fas fa-edit"></i></a>
                                        <a class="post_delete_business" href="javascript:void(0)" data-id="{{ $value['id'] }}"><i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- products-wrapper -->

                <!-- pagination  start-->
                <div class="pagination-wrapper">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
                <!-- pagination end-->
            </div>
        </div>
    </div>
</div>
<!-- delete modal Modal start-->
<div class="modal fade" id="store_post_delete" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="items_delete_popup">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
            </div>
            <div class="modal-body">
                <p style="text-align: left"> <strong>@lang('business_messages.add_store.are_you_sure')</strong></p>
            </div>
            <form action="{{route('frontend.business.business.add-store.store_removed')}}" method="POST">
                @csrf
                <input type="hidden" name="store_id" class="store_id">
                <div class="modal-footer">
                    <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>

                    <button type="submit" class="btn delete_post ml-1 store_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.delete')</strong></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal Modal start-->
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



<style>
    button.btn.delete_post {
        padding: 5px 15px;
    }
</style>
@endsection