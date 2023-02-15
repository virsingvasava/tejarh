@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Category Create</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Category</a>
                     </li>
                     <li class="breadcrumb-item active">Create
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
                        <form  action="{{route('admin.category.store')}}" enctype="multipart/form-data" method="post" id="category_create">
                           @csrf
                           <div class="form-row">
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="category_name">Category name</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name">
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="d-block mb-1">
                                    <label for="slug">Category Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug">
                                 </div>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <label for="status">Select Status</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select" name="status">
                                       <option value="">Select Status</option>
                                       <option value="1">Active</option>
                                       <option value="0">InActive</option>
                                    </select>
                                 </fieldset>
                              </div>
                              <div class="col-md-6 mb-6">
                                 <div class="form-group">
                                    <label> Category Picture</label> <br>
                                    <input type="file" name="cate_picture" class="cate_picture" onclick="offerBannerImageUpload()" accept="image/*" id="upload" hidden/><label class="image_upload_btn" for="upload">Choose file</label>
                                    <div class="d-block mt-1"><img id="category_image_preview" style="display: none;" src="#" height="100" width="100" /></div>
                                    <label id="upload-error" class="error" for="upload"></label> 
                                 </div>
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
$("#category_create").validate({
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

        "cate_picture":{
            required:true,
        },
        "status":{
            required:true,
        },
    },
    messages: {
       
        "category_name":{
            required:'Please enter category name.',
        },

        "slug":{
            required:'Please enter slug.',
        },
        "cate_picture":{
            required:'Please choose category picture.',
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
    $(document).on('change','.cate_picture',function(){
        $('#category_image_preview').hide();
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#category_image_preview').attr('src', e.target.result);
                $('#category_image_preview').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function itemImageUpload() {
         document.getElementById("cate_picture").click();
    }
 </script>
@endsection

