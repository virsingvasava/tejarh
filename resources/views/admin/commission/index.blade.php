@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.commission.prices')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.commission.prices_details')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Tooltip validations start -->
         <!-- Navigation -->
         <section id="card-navigation">
            <h5 class="mt-3 mb-2"></h5>
            <div class="col-md-8">
               <div class="card mb-3">
                  <div class="card-body">
                     <div class="tab-menu">
                        <ul>
                           <li><a class="tab-a active-a" data-id="home-tab">@lang('messages.commission.users_commission')</a></li>
                           <li><a class="tab-a" data-id="profile-tab">@lang('messages.commission.business_users_commission')</a></li>
                           <li><a class="tab-a" data-id="story-tab">Story Price</a></li>
                           <li><a class="tab-a" data-id="boost-tab">Boost Item Price</a></li>
                           <li><a class="tab-a" data-id="vat-tab">Vat Price</a></li>
                        </ul>
                     </div>
                     <!--end of tab-menu-->
                     <form action="{{route('admin.commission.commission_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                        @csrf
                        <div class="tab tab-active" data-id="home-tab">
                           <div class="card shadow-none bg-transparent border border-primary mb-3">
                              <div class="card-body">
                                 <label>@lang('messages.commission.percentage') ( % )</label>
                                 <input type="text" value="{{$commission_user}}" class="form-control" name="commission_user" placeholder="@lang('messages.commission.enter_user_percentage')">
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </div>
                     <form>
                     <form action="{{route('admin.commission.commission_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                        @csrf
                        <div class="tab " data-id="profile-tab">
                           <div class="card shadow-none bg-transparent border border-primary mb-3">
                              <div class="card-body">
                                 <label>@lang('messages.commission.percentage') ( % )</label>
                                 <input type="text" value="{{$commission_business_user}}" class="form-control" name="commission_business_user" placeholder="@lang('messages.commission.enter_business_user_percentage')">
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </div>
                     <form>
                     <form action="{{route('admin.commission.commission_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                        @csrf
                        <div class="tab " data-id="story-tab">
                           <div class="card shadow-none bg-transparent border border-primary mb-3">
                              <div class="card-body">
                                 <label>Story Price</label>
                                 <input type="text" value="{{$story_price}}" class="form-control" name="story_price" placeholder="Story Price">
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </div>
                     <form>
                     <form action="{{route('admin.commission.commission_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                        @csrf
                        <div class="tab " data-id="boost-tab">
                           <div class="card shadow-none bg-transparent border border-primary mb-3">
                              <div class="card-body">
                                 <label>Boost Item Price</label>
                                 <input type="text" value="{{$boost_price}}" class="form-control" name="boost_price" placeholder="Boost Item Price">
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </div>
                     <form>
                     <form action="{{route('admin.commission.commission_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                        @csrf
                        <div class="tab " data-id="vat-tab">
                           <div class="card shadow-none bg-transparent border border-primary mb-3">
                              <div class="card-body">
                                 <label>Vat Price</label>
                                 <input type="text" value="{{$vat_price}}" class="form-control" name="vat_price" placeholder="Vat Price">
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </div>
                     <form>
                  </div>
               </div>
            </div>
            <!--end of container-->
         </section>
         <!--/ Navigation -->
         <!-- Tooltip validations end -->
      </div>
   </div>
</div>
<!-- END: Content-->
<style type="text/css">
   .nav-tabs .nav-link {
      font-size: 13px;
      background-color: rgba(90, 141, 238, 0.17);
   }

   .tab-container {
      margin: 5% 10%;
      background-color: #c1e3d9;
      padding: 3%;
      border-radius: 4px;
   }

   .tab-menu {
      margin: 0 0 30px;
   }

   .tab-menu ul {
      margin: 0;
      padding: 0;
   }

   .tab-menu ul li {
      list-style-type: none;
      display: inline-block;
      margin: 0 10px 0 0;
   }

   .tab-menu ul li a {
      text-decoration: none;
      color: #5A8DEE;
      background-color: #b4cbc4;
      padding: 7px 25px;
      border-radius: 4px;
      font-size: 13px;
      background-color: rgba(90, 141, 238, 0.17);
      cursor: pointer;
   }

   .tab-menu ul li a.active-a,
   .tab-menu ul li a:hover {
      color: #FFFFFF;
      background-color: #5A8DEE;
   }

   .tab {
      display: none;
   }

   .tab h2 {
      color: rgba(0, 0, 0, .7);
   }

   .tab p {
      color: rgba(0, 0, 0, 0.6);
      text-align: justify;
   }

   .tab-active {
      display: block;
   }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<script type="text/javascript">
   jQuery(document).ready(function() {
      jQuery('.tab-a').click(function() {
         jQuery(".tab").removeClass('tab-active');
         jQuery(".tab[data-id='" + jQuery(this).attr('data-id') + "']").addClass("tab-active");
         jQuery(".tab-a").removeClass('active-a');
         jQuery(this).parent().find(".tab-a").addClass('active-a');
      });
   });




   $("#category_create").validate({
      ignore: "not:hidden",
      onfocusout: function(element) {
         this.element(element);
      },
      rules: {

         "category_name": {
            required: true,
         },

         "slug": {
            required: true,
         },

         "cate_picture": {
            required: true,
         },
         "status": {
            required: true,
         },
      },
      messages: {

         "category_name": {
            required: 'Please enter category name.',
         },

         "slug": {
            required: 'Please enter slug.',
         },
         "cate_picture": {
            required: 'Please choose category picture.',
         },
         "status": {
            required: 'Please select status',
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
   $(document).on('change', '.cate_picture', function() {
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