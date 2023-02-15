@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.story_price.story_price')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.story_price.story_price_details')
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
            <div class="row">
               <div class="col-md-8">
                  <div class="card mb-3">
                     <div class="card-body">
                        <form action="{{route('admin.story-price.story_price_update')}}" enctype="multipart/form-data" method="post" id="category_create">
                           @csrf
                           {{-- <ul class="nav nav-tabs" id="nav-tabs" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link btn btn-light-primary btn-sm active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('messages.story_price.story_price')</a>
                              </li>
                           </ul> --}}
                           <div class="col-md-12 col-xl-12">
                              <div class="card shadow-none bg-transparent border border-primary mb-3">
                                 <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="tab-content" id="myTabContent">
                                       <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>@lang('messages.story_price.story_price') </label>
                                                <input type="number" value="{{ $story_price ?: 0}}" class="form-control" name="story_price" placeholder="@lang('messages.story_price.enter_story_price')">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1 loader_class">@lang('messages.common.update')</button>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
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
</style>


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.js')}}"></script>

<script type="text/javascript">
   $("#category_create").validate({
      ignore: "not:hidden",
      onfocusout: function(element) {
         this.element(element);
      },
      submitHandler: function(form) {
         var $this = $('.loader_class');
         var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
         $('.loader_class').prop("disabled", true);
         $this.html(loadingText);
         form.submit();
      }
   });
   /* Success and error message toastr */
$(document).ready(function() {
   toastr.options.timeOut = 10000;
   @if (Session::has('error'))
       toastr.error('{{ Session::get('error') }}');
   @elseif(Session::has('success'))
       toastr.success('{{ Session::get('success') }}');
   @endif
});
</script>
@endsection