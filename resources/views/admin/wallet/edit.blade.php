@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Category Edit</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categories</a>
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
                        <form  action="{{route('admin.category.update')}}" enctype="multipart/form-data" method="post" id="category_edit">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_category->id}}">
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="category_name">Name</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name" value="{{$edit_category->category_name}}">
                                  </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                  <div class="d-block mb-1">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug" value="{{$edit_category->slug}}">
                                  </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">Select Status</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select" id="customSelect" name="status">
                                       <option value="">Select Status</option>
                                       <option @if($edit_category->status == 1) selected="selected" @endif value="1">Active</option>
                                       <option @if($edit_category->status == 0) selected="selected" @endif value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="error">{{$message}}</span>
                                    @endif
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="form-group">
                                    <label>Category Picture</label>
                                    <br>
                                    <div id="logobtn" class="btn btn-light-secondary" style="width: 100%;" onclick="imageUpload()">Upload Category Picture</div>
                                    <input type="file" id="image" style="display: none;" name="cate_picture" class="image" accept="image/*">
                                 </div>
                                 @if($edit_category->cate_picture != '' && file_exists(public_path('img/category/'.$edit_category->cate_picture)))
                                 <div class="d-block mb-1"><img id="image_preview" src="{{asset('img/category/'.$edit_category->cate_picture)}}" alt="Profile Picture" height="100" width="100" /></div>
                                 @else
                                 <div class="d-block mb-1"> <img id="image_preview" style="display: none;" src="#" alt="Profile Picture" height="100" width="100" />
                                 </div>
                                 @endif
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">Submit</button>
                              <a href="{{route('admin.category.index')}}" class="btn btn-light-secondary btn_loader">Reset</a>
                           </div>
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

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<script type="text/javascript">
$("#category_edit").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        
        "category_name":{
            required:true,
        },

        "slug":{
            required:true,
        },
    
        "status":{
            required:true,
        },
    },
    messages: {
       
        "category_name":{
            required:'Please enter name.',
        },

        "slug":{
            required:'Please enter slug.',
        },
     
        "status":{
            required:'Please select status',
        },

    },
    submitHandler: function(form) {
        var $this = $('.loader_class');
        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
        $('.loader_class').prop("disabled", true);
        $this.html(loadingText);
        form.submit();
    }
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


