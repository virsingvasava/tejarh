@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Support-Details' }}
@endsection

@section('content')

<div class="wishlist-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Support-Details</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="support-sec">
                    @foreach($itemArray as $key => $value)
                    <div class="support-main">
                        <div class="support-left">
                            <div class="support-date-time">
                                <span class="date">{{ \Carbon\Carbon::parse($value['created_at'])->format('d/m/Y')}}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($value['created_at'])->format('H:i:s A')}}</span>
                            </div>
                            <div class="sup-profile">
                                <figure><img src="{{ asset('assets/images/user.png') }}"></figure>
                                <div class="sup-profile-name">{{ $value['User']['first_name'] }}</div>
                            </div>
                        </div>
                        <div class="support-right">
                            <div class="">
                                <p>{{ $value['message'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($value['ticketMaster']['status'] == '0')
                <div class="reply-btn-sec">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#raise-ticket" data-bs-dismiss="modal" class="btn-reply"><img src="{{ asset('assets/images/icon-reply.png') }}">Reply</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="raise-ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>Reply</h5>
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
                <input type="hidden" value="{{ $value['ticket_master_id'] }}" name="ticket_master_id">
                <div class="reply-sec-m">
                    <div class="reply-sec">
                        <textarea class="form-control" rows="5" placeholder="Enter Message" name="message"></textarea>
                        <div class="reply-input-group">
                            <div class="reply-file-upload-g">
                                <div class="reply-file-upload">
                                    <input type="file" onchange="readURL0022(this);" name="image" id="image" accept="application/pdf,image/png,image/jpg,image/jpeg" class="valid" aria-invalid="false">
                                    Add Attachment
                                </div>
                            </div>
                            <span style="color:red;">* Image should be 1MB</span>
                        </div>
                        <div class="form-group submit">
                            <button type="submit" value="Submit" class="btn btn-primary loader_class">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
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
@endsection

@section('script')
<style>
    /* .support-sec{height: 400px; overflow-y: scroll;} */
    .support-main {
        display: flex;
    }

    .support-left {
        display: flex;
        width: 30%;
        flex-direction: column;
        border: 1px solid #D3D4D4;
        padding: 35px;
    }

    .support-left .support-date-time {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .support-left span.date {
        background: #ccc;
        padding: 5px 15px;
        color: #000;
        font-size: 15px;
        font-weight: 400;
        border-radius: 5px;
    }

    .support-left span.time {
        color: #000;
        font-size: 15px;
        font-weight: 400;
    }

    .support-left .sup-profile {
        display: flex;
        width: 100%;
        align-items: center;
        margin: 20px 0 0 0;
    }

    .support-left .sup-profile figure {
        display: flex;
        width: 35px;
        margin: 0;
    }

    .support-left .sup-profile .sup-profile-name {
        color: #000;
        font-size: 15px;
        line-height: 17px;
        font-weight: 400;
        margin: 0 0 0 10px;
    }

    .support-right {
        display: flex;
        width: 70%;
        flex-direction: column;
        border: 1px solid #D3D4D4;
        border-left: 0;
        padding: 35px;
    }

    .reply-btn-sec {
        display: flex;
        width: 100%;
        padding: 35px;
        justify-content: flex-end;
    }

    .reply-btn-sec .btn-reply {
        width: 150px;
        height: 50px;
        padding: 10px 15px;
        border: 1px solid #55d287;
        color: #0AD188;
        background: transparent;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .reply-btn-sec .btn-reply:hover {
        color: #000;
        border: 1px solid #000;
    }

    .reply-btn-sec .btn-reply img {
        margin: 0 5px 0 0;
        width: 15px;
        height: 14px;
    }

    .reply-sec-m {
        display: flex;
        width: 100%;
        margin: 20px 0 0 0;
    }

    .reply-sec {
        display: flex;
        width: 100%;
        flex-direction: column;

    }

    .reply-input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }

    .reply-file-upload-g {
        border: none;
        width: 100%;
        border-radius: 10px !important;
        justify-content: center;
        border: 2px solid #dadce0;
        padding: 10px;
        margin: 15px 0;
    }

    .reply-file-upload {
        position: relative;
        text-align: center;
    }

    .reply-file-upload input {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
    }
</style>
<script type="text/javascript">
    if ($("#ticketModal").length > 0) {
        $("#ticketModal").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "message": {
                    required: true,
                },
            },
            messages: {
                "message": {
                    required: 'Please Enter Message',
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
                    url: '{{ route("frontend.users.support.add_reply") }}',
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
                                var loadingText = 'Reply Given Successfully';
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
                            var loadingText = 'Error in replying';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });
            }
        });
    }
</script>
@endsection