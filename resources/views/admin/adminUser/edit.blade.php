@extends('layouts.app_admin')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">User Edit</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">User</a>
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
                                    <form  action="{{route('admin.user.update')}}" enctype="multipart/form-data" method="post" id="menu_edit">
                                          @csrf
                                        <input type="hidden" name="id" value="{{$edit_user->id}}">

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
                                                <input type="text" class="form-control" name="name" id="name" value="{{$edit_user->name}}" placeholder="Enter Username">
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="{{$edit_user->email}}" placeholder="Enter Email" disabled>
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

                                             <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>User Picture</label>
                                                    <br>
                                                    <div id="logobtn" class="btn btn-secondary" onclick="imageUpload()">Upload Picture</div>
                                                    <input type="file" id="image" style="display: none;" name="profile_picture" class="image" accept="image/*">
                                                </div>
                                                @if($edit_user->profile_picture != '' && file_exists(public_path('img/users/'.$edit_user->profile_picture)))
                                                <img id="image_preview" src="{{asset('img/users/'.$edit_user->profile_picture)}}" alt="Profile Picture" height="100" width="100" />
                                                @else
                                                <img id="image_preview" style="display: none;" src="#" alt="Profile Picture" height="100" width="100" />
                                                @endif

                                            </div>

                                        </div>
                                        <a href="{{route('admin.user.index')}}" class="btn btn-danger btn_loader">Cancel</a>
                                        <button type="submit" class="btn btn-primary loader_class">Update</button>
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
        let switchery = new Switchery(html,  { size: 'small' });
});
$(document).ready(function(){
    $('.js-switch').change(function () {

        let status = $(this).prop('checked') === true ? 1 : 0;
        let menu_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('admin.menus.site_link.menu_status_update') }}',
            data: {'status': status, 'menu_id': menu_id, _token:token},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).on('change','.image',function(){
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
</script>
@endsection