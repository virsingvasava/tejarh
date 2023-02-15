@extends('frontend.users.layouts.master')
@section('title')
{{ 'Tejarh - My Images' }}
@endsection
@section('content')

<div class="my-orders-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Images</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-5">
                <ul class="import-btn text-r">
                    <li><a href="javascript:void(0)" id="bulkproductf" class="btnf" data-bs-toggle="modal" data-bs-target="#uploadimagesModal">Upload Images</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="pagination-hidden-section">
                <input type='hidden' id='current_page' />
                <input type='hidden' id='show_per_page' />
            </div>
        </div>
        @if(!empty($images) && count($images) > 0)
        <div class="col-md-12">
            <div class="products-wrapper">
                <div class="row" id="pagingBox">
                    @if (!empty($images) && count($images) > 0)
                    @foreach ($images as $key => $value)
                    <div class="col-md-3">
                        <div class="products-box">
                            <div class="products-box-img">
                                <a>
                                    @if (!empty($value['name']))
                                    <img src="{{ asset('assets/post'. '/' . $value['name']) }}">
                                    @else
                                    <img src="{{ asset('assets/images/user.png') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="products-box-content">
                                <p>{{$value['name']}}</p>
                                <div class="products-box-footer">
                                    <a class="import_img_delete" href="javascript:void(0)" data-id="{{$value['id']}}"><i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                </div>
            </div>
            <div class="order-place">
                <p>No Images..</p>
            </div>
            @endif
        </div>
    </div>
    @if (!empty($images) && count($images) > 12)
    <div class="pagination-wrapper">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id='page_navigation'></ul>
        </nav>
    </div>
    @endif
    @else
    <div class="breadcrumb-item" style="text-align:center;">
        <h5 class="" style="color:gray">No Images</h5>
    </div>
    @endif
</div>
</div>
</div>
<div class="modal fade" id="import_images_post_delete" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="items_delete_popup">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
            </div>
            <div class="modal-body">
                <p style="text-align: left"> <strong>Are you sure to Delete Image?</strong></p>
            </div>
            <form action="{{ route('frontend.users.pages.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="image_id" class="image_id">
                <div class="modal-footer">
                    <button type="button" class="btn delete_post" data-bs-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>
                    <button type="submit" class="btn delete_post ml-1 post_delete_business_func"> <i class="bx bx-check d-block d-sm-none"></i>
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
                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/">
                                <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">

<script>
    $(document).ready(function() {

        var show_per_page = 12;
        var number_of_items = $('#pagingBox').children().length;
        var number_of_pages = Math.ceil(number_of_items / show_per_page);
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);
        var navigation_html =
            '<li class="page-item"><a class="previous_link page-link" href="javascript:previous();"><</a></li>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link page-link" href="javascript:go_to_page(' + current_link +
                ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html +=
            '<li class="page-item"><a class="next_link page-link" href="javascript:next();">></a></li>';
        $('#page_navigation').html(navigation_html);
        $('#page_navigation .page_link:first').addClass('active_page');
        $('#pagingBox').children().css('display', 'none');
        $('#pagingBox').children().slice(0, show_per_page).css('display', 'block');
    });

    function previous() {
        new_page = parseInt($('#current_page').val()) - 1;
        if ($('.active_page').prev('.page_link').length == true) {
            go_to_page(new_page);
        }
    }

    function next() {
        new_page = parseInt($('#current_page').val()) + 1;
        if ($('.active_page').next('.page_link').length == true) {
            go_to_page(new_page);
        }
    }

    function go_to_page(page_num) {
        var show_per_page = parseInt($('#show_per_page').val());
        start_from = page_num * show_per_page;
        end_on = start_from + show_per_page;
        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass(
            'active_page');
        $('#current_page').val(page_num);
    }
</script>
@endsection