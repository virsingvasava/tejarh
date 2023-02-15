@extends('layouts.app_admin')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Attribute-Variant</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Attribute-Variant_list
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
                            <a href="{{route('admin.attribute_variant.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                                <i class="bx bx-plus"></i>
                                <span class="invoice-repeat-btn">add_attribute_variant</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero configuration table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    @if (App::isLocale('en'))
                                    <table class="table zero-configuration" id="brand_english_table">
                                        @else
                                        <table class="table zero-configuration" id="brand_arabic_table">
                                            @endif
                                            <thead>
                                                <tr>
                                                    <th>Sr_no</th>
                                                    <th>English Name</th>
                                                    <th>Arabic Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @if(!empty($attribute_variant) && count($attribute_variant) > 0)
                                            <?php $i = 1; ?>
                                            @foreach($attribute_variant as $key => $value)
                                            <tr>
                                                <td>#{{$i}}</td>
                                                <td>{{ucfirst($value->name)}}</td>
                                                <td>{{ucfirst($value->ar_name)}}</td>

                                                <td>
                                                    <div class="d-flex justify-content-between py-50">
                                                        <div class="custom-control custom-switch custom-switch-glow">
                                                            <input type="checkbox" data-id="{{ $value->id }}" name="status" class="js-switch" {{ $value->status == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right">

                                                            <a class="dropdown-item" href="{{route('admin.attribute_variant.edit',base64_encode($value->id))}}"><i class="bx bx-edit-alt mr-1"></i> @lang('messages.common.edit')</a>

                                                            <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id=""><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10">Not Found Attribute Variant</td>
                                            </tr>
                                            @endif
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
</div>
<!-- END: Content-->
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
                    <strong>@lang('messages.brand.are_you_sure_delete_brand')</strong>
                </p>
            </div>
            <form action="{{route('admin.brand.destroy')}}" method="POST">
                @csrf
                <input type="hidden" name="brand_id" class="brand_id">
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
<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('js/switchery/switchery.min.css')}}">
<script src="{{asset('js/switchery/switchery.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

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
            let attribute_variant_id = $(this).data('id');
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('admin.attribute.attribute_variant_status_update')}}",
                data: {
                    'status': status,
                    'attribute_variant_id': attribute_variant_id,
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
        $('.brand_id').val($(this).attr('data-id'));
    })

    /* Success and error message toastr */
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif
    });
</script>
@endsection