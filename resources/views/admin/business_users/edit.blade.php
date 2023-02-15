@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">Business-User Edit</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Business-User</a>
                            </li>
                            <li class="breadcrumb-item active">Edit
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Tooltip validations start -->
            <section id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.business_users.update')}}" enctype="multipart/form-data" method="post" id="menu_edit">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$edit_user->id}}">

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Business-User Picture</label>
                                                <br>
                                                <div id="logobtn" class="btn btn-secondary" onclick="imageUpload()">Upload Picture</div>
                                                <input type="file" id="image" style="display: none;" name="profile_picture" class="image" accept="image/*">
                                            </div>
                                            @if($edit_user->profile_picture != '' && file_exists(public_path('assets/users/'.$edit_user->profile_picture)))
                                            <img id="image_preview" src="{{asset('assets/users/'.$edit_user->profile_picture)}}" alt="Profile Picture" height="100" width="100" />
                                            @else
                                            <img id="image_preview" style="display: none;" src="#" alt="Profile Picture" height="100" width="100" />
                                            @endif
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Store Logo</label>
                                                <br>
                                                <div id="logobtn" class="btn btn-secondary" onclick="imageUpload1()">Upload Picture</div>
                                                <input type="file" id="image1" style="display: none;" name="store_logo_file" class="image1" accept="image/*">
                                            </div>
                                            @if($user_business_edit->store_logo_file != '' && file_exists(public_path('assets/users/'.$user_business_edit->store_logo_file)))
                                            <img id="image_preview1" src="{{asset('assets/users/'.$user_business_edit->store_logo_file)}}" alt="Store Logo" height="100" width="100" />
                                            @else
                                            <img id="image_preview1" style="display: none;" src="#" alt="Store Logo" height="100" width="100" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{$edit_user->first_name}}" placeholder="Enter first name">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{$edit_user->last_name}}" placeholder="Enter last name">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="name">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="{{$edit_user->username}}" placeholder="Enter Username">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{$edit_user->email}}" placeholder="Enter Email" disabled>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{$edit_user->phone_number}}" placeholder="Enter Phone Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyname">Company Name</label>
                                            <input type="text" class="form-control" name="company_name" id="company_name" value="{{$user_business_edit->company_name}}" placeholder="Enter Company Name" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Company Legal Name</label>
                                            <input type="text" class="form-control" name="company_legal_name" id="company_legal_name" value="{{$user_business_edit->company_legal_name}}" placeholder="Enter Company Legal Name" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Owner/Manager Name</label>
                                            <input type="text" class="form-control" name="owner_or_manager_name" id="owner_or_manager_name" value="{{$user_business_edit->owner_or_manager_name}}" placeholder="Enter Owner/Manager Name" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">CR Number</label>
                                            <input type="text" class="form-control" name="enter_cr_number" id="enter_cr_number" value="{{$user_business_edit->enter_cr_number}}" placeholder="Enter CR Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">CR Maroof Number</label>
                                            <input type="text" class="form-control" name="enter_cr_maroof_namber" id="enter_cr_maroof_namber" value="{{$user_business_edit->enter_cr_maroof_namber}}" placeholder="Enter CR Maroof Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Expiry Date</label>
                                            <input type="text" class="form-control" name="date_of_expiry" id="date_of_expiry" value="{{$user_business_edit->date_of_expiry}}"  >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">VAT Number</label>
                                            <input type="text" class="form-control" name="vat_number" id="vat_number" value="{{$user_business_edit->vat_number}}"  placeholder="Enter VAT Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{$user_business_edit->bank_name}}"  placeholder="Enter Bank Name" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Bank A/C Number</label>
                                            <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="{{$user_business_edit->bank_account_number}}"  placeholder="Enter Bank A/C Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Iban Number</label>
                                            <input type="text" class="form-control" name="Iban_number" id="Iban_number" value="{{$user_business_edit->Iban_number}}"  placeholder="Enter Iban Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Store Name</label>
                                            <input type="text" class="form-control" name="store_name" id="store_name" value="{{$user_business_edit->store_name}}"  placeholder="Enter Store Name" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Store Location</label>
                                            <input type="text" class="form-control" name="store_location" id="store_location" value="{{$user_business_edit->store_location}}"  placeholder="Enter Store Location" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Store Phone Number</label>
                                            <input type="text" class="form-control" name="store_phone_number" id="store_phone_number" value="{{$user_business_edit->store_phone_number}}"  placeholder="Enter Store Phone Number" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="companyLegalName">Website</label>
                                            <input type="text" class="form-control" name="website" id="website" value="{{$user_business_edit->website}}"  placeholder="Enter Website" >
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="status">Select Status</label>
                                            <fieldset class="form-group">
                                                <select class="custom-select" id="customSelect" name="status">
                                                    <option selected="">Select Status</option>
                                                    <option @if($edit_user->status == 1) selected="selected" @endif value="1">Active</option>
                                                    <option @if($edit_user->status == 0) selected="selected" @endif value="0">Inactive</option>
                                                </select>
                                                @error('status')
                                                <span class="error">{{$message}}</span>
                                                @endif
                                            </fieldset>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary loader_class">Update</button>
                                    <a href="{{route('admin.business_users.index')}}" class="btn btn-danger btn_loader">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Tooltip validations end -->
        </div>
    </div>
</div>
<!-- END: Content-->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script type="text/javascript">
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html, {
            size: 'small'
        });
    });
    $(document).ready(function() {
        $('.js-switch').change(function() {

            let status = $(this).prop('checked') === true ? 1 : 0;
            let menu_id = $(this).data('id');
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route("admin.menus.site_link.menu_status_update") }}',
                data: {
                    'status': status,
                    'menu_id': menu_id,
                    _token: token
                },
                success: function(data) {
                    console.log(data.message);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).on('change', '.image', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function imageUpload() {
        document.getElementById("image").click();
    }

    $(document).on('change', '.image1', function() {
        readURL1(this);
    });

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function imageUpload1() {
        document.getElementById("image1").click();
    }
</script>
@endsection