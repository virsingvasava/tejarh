@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - User-Support' }}
@endsection

@section('content')

<div class="wishlist-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User-Support</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 justify-content-end d-flex">
                    <a href="{{ route('frontend.business.user-support.reaquested_list') }}" class="btn return-order-list">Received Ticket</a>
                </div>
            </div>
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <h5>My Tickets Listing</h5>
            <div class="col-md-12">
                <div class="wishlist_deleted_message"></div>
                <div class="wishlist-table">
                    @if (!empty($itemArray) && count($itemArray) > 0)
                    <table id="pagingBox">
                        <thead>
                            <tr>
                                <th>Ticket-ID</th>
                                <th class="subject">Subject</th>
                                <th class="view">View Details</th>
                                <th class="remove" width="120px">Status</th>
                            </tr>
                        </thead>
                        @if (!empty($itemArray) && count($itemArray) > 0)
                        <?php $i = 1; ?>
                        @foreach ($itemArray as $key => $value)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="wishlist-item">
                                        <div class="wishlist-item-content">
                                            <h5>{{ $value['sku_id'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="subject">
                                    <div class="wishlist-item">
                                        <div class="wishlist-item-content">
                                            <h5>{{ $value['subject'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="view">
                                    <a href="{{ route('frontend.business.user-support.ticket_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a>
                                </td>
                                <td class="remove">
                                    @if($value['status'] == '0')
                                    <h5>Open</h5>
                                    @else
                                    <h5>Close</h5>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                    </table>
                    @if (!empty($itemArray) && count($itemArray) > 10)
                    <div class="pagination-wrapper">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" id='page_navigation'></ul>
                        </nav>
                    </div>
                    @endif
                    @else
                    <div class="breadcrumb-item" style="text-align:center;">
                        <h5 class="" style="color:gray">No Ticket Raise</h5>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

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
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {

        var show_per_page = 10;
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
        $('#pagingBox').children().slice(0, show_per_page).css('display', 'table');
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
        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'table');
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass(
            'active_page');
        $('#current_page').val(page_num);
    }
</script>
<style>
    #pagingBox tbody {
        width: 100%;
    }

    #pagingBox tbody td,
    #pagingBox thead td {
        text-align: center;
    }

    #pagingBox thead {
        display: table !important;
        width: 100%;
    }

    table #pagingBox td,
    table #pagingBox th {
        padding: 10px 8px;
        text-align: center;
    }

    #pagingBox tbody td:first-child,
    #pagingBox thead th:first-child {
        width: 5%;
        text-align: center;
    }

    #pagingBox tbody td:last-child,
    #pagingBox thead th:last-child {
        width: 4%;
        text-align: center;
    }

    #pagingBox tbody td.subject,
    #pagingBox thead th.subject {
        width: 25%;
        text-align: center;
    }

    #pagingBox tbody td.category,
    #pagingBox thead th.category {
        width: 25%;
        text-align: center;
    }

    #pagingBox tbody td.view,
    #pagingBox thead th.view {
        width: 25%;
        text-align: center;
    }

    #pagingBox tbody td.remove,
    #pagingBox thead th.remove {
        width: 25%;
        text-align: center;
    }
</style>
@endsection