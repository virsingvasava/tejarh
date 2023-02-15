@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Support'}}
@endsection

@section('content')

<div class="wishlist-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Support</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 justify-content-end d-flex">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#raise-ticket" data-bs-dismiss="modal" style="display: block;" class="btn return-order-list">Add Ticket</a>
                </div>
            </div>
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <div class="col-md-12">
                <div class="wishlist_deleted_message"></div>
                <div class="wishlist-table">
                    @if (!empty($itemArray) && count($itemArray) > 0)
                    <table id="pagingBox">
                        <thead>
                            <tr>
                                <th>Ticket-ID</th>
                                <th class="subject">Subject</th>
                                <th class="category">Category</th>
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
                                <td class="category">
                                    <div class="wishlist-item">
                                        <div class="wishlist-item-content">
                                            <h5>{{ $value['supportCategory']['support_category_name'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="view">
                                    <a href="{{ route('frontend.business.support.ticket_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a>
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
<div class="modal fade" id="raise-ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>Add Ticket</h5>
            <div id="ajax-alert-error" class="alert" style="display:none;">
            </div>
            <div id="ajax-alert" class="alert" style="display:none;">
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form id="ticketModal" name="ticketModal" method="post" enctype="multipart/form-data" action="javascript:void(0)">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name" class="form-control">
                </div>
                <div class="input-group">
                    <input type="text" name="subject" placeholder="Enter Subject" class="form-control">
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="Enter Message" name="message"></textarea>
                </div>
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="support_cat_id" id="support_cat_id">
                        <option value="">Suppoert Category</option>
                        @foreach ($getsupportCategory as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->support_category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <span style="color:red;">* Image should be 1MB</span>
                    <div class="input-group file-upload">
                        <div class="file-upload-div review">
                            <input type='file'  name="image" id="image" accept="application/pdf,image/png,image/jpg,image/jpeg">
                            <img id="blah0022" src="{{ asset('assets/images/add_a_photo_gm_blue_24dp.png') }}">
                            Add photo/file
                        </div>
                        <label id="image-error" class="error" for="image"></label>
                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        {!!$errors->first('image', '<span class="text-danger">:message</span>')!!}
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" name="sku_id" placeholder="" class="form-control" value="#{{$randomNumber}}" readonly>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn btn-primary loader_class" value=""> Add Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<link rel="stylesheet" href="{{ asset('fronted/users_flow/assets/css/review_ratings.css') }}" />
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    if ($("#ticketModal").length > 0) {
        $("#ticketModal").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "name": {
                    required: true,
                },
                "subject": {
                    required: true,
                },
                "message": {
                    required: true,
                },
                "support_cat_id": {
                    required: true,
                },
            },
            messages: {
                "name": {
                    required: 'Please Enter Name',
                },
                "subject": {
                    required: 'Please Enter Subject',
                },
                "message": {
                    required: 'Please Enter Message',
                },
                "support_cat_id": {
                    required: 'Please Select Category',
                },
            },
            submitHandler: function(form) {
                var $this = $('#ticketModal .loader_class');
                var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#ticketModal .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("ticketModal"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: '{{ route("frontend.business.support.store") }}',
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            $('#ajax-alert').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 2000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = 'Ticket Added';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                window.location.href = "";
                            });
                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('Please check all the details');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = 'Error in Adding Ticket';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });
            }
        });
    }
</script>
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