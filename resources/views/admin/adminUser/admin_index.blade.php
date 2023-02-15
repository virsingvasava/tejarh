@extends('layouts.app_admin')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.user.all_users')</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.user.all_users_list')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="col p-0">
                            <a href="{{route('admin.admin_user.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                                <i class="bx bx-plus"></i>
                                <span class="invoice-repeat-btn">add_user</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="users-list-wrapper">
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (App::isLocale('en'))
                                <table class="table zero-configuration" id="user_english_table">
                                    @else
                                    <table class="table zero-configuration" id="user_arabic_table">
                                        @endif
                                        <thead>
                                            <tr>
                                                <th>@lang('messages.common.sr_no')</th>
                                                <th>@lang('messages.user.image')</th>
                                                <th>@lang('messages.user.name')</th>
                                                <th>@lang('messages.user.email')</th>
                                                <th>@lang('messages.user.last_activity')</th>
                                                <th>@lang('messages.common.status')</th>
                                                <th>@lang('messages.common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($users) && count($users) > 0)
                                            @foreach ($users as $key => $value)
                                            <tr>
                                                <td>#{{ $key + 1 }}</td>
                                                <td class="text-center">
                                                    @if ($value->profile_picture != '' && file_exists(public_path('assets/users/' . $value->profile_picture)))
                                                    <img src="{{ asset('assets/users/' . $value->profile_picture) }}" style="height: 70px; width: 70px;" alt="" class="img-profile rounded-circle" />
                                                    @else
                                                    <img src="{{ asset('img/user.png') }}" alt="" style="height: 40px; width: auto;" class="img-profile rounded-circle" />
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst($value->first_name) }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($value->updated_at)->format('d/m/Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" data-id="{{ $value->id }}" name="status" class="js-switch" {{ $value->status == 1 ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <!-- <a class="dropdown-item" href="{{ route('admin.user.view', base64_encode($value->id)) }}"><i class="bx bx-show-alt mr-1"></i>
                                                                @lang('messages.common.view')</a> -->

                                                            <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{ $value->id }}"><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10">@lang('messages.user.not_found_user')</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- delete modal Modal start-->
<div class="modal fade" id="tejarhDeleteModel" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    <strong>@lang('messages.user.are_you_sure_to_delete_user')</strong>
                </p>
            </div>
            <form action="{{ route('admin.admin_user.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" class="user_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>
                    <button type="submit" class="btn btn-light-primary ml-1"> <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.delete')</strong></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal Modal start-->


<script src="{{ asset('build/app-assets/vendors/js/jquery/jquery.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('js/switchery/switchery.min.css') }}">
<script src="{{ asset('js/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script type="text/javascript">
    /* Toggole button for status make active and inactive */
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html, {
            size: 'small'
        });
    });
    $(document).ready(function() {
        $('.js-switch').change(function() {

            let status = $(this).prop('checked') === true ? 1 : 0;
            let user_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.user.user_status_update')}}",
                data: {
                    'status': status,
                    'user_id': user_id,
                    _token: token
                },
                success: function(data) {
                    console.log(data.message);
                }
            });
        });
    });

    /* Delete Site links menu */
    $(document).on('click', '.tejarh_delete_button', function() {
        $('#tejarhDeleteModel').modal('show');
        $('.user_id').val($(this).attr('data-id'));
    })

    /* Success and error message toastr */
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @endif
    });
</script>


@endsection