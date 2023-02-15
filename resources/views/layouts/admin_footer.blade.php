
 <!-- BEGIN: Footer-->
     <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <strong> @lang('messages.common.copyright') {{date('Y')}} <a href="javascript::void(0)">@lang('messages.common.app_name')</a></strong>
            @lang('messages.common.all_rights_reserved').
         <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>

    <!-- END: Footer-->
   <!-- Popup modal for logout start -->
    <div class="modal fade" id="tejarhLogoutModal" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-top modal-dialog-top modal-dialog-scrollable">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
                </button>
             </div>
             <div class="modal-body">
                <p class="mb-0">
                   <strong>@lang('messages.header.are_you_sure_to_logout')</strong>
                </p>
             </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light-secondary" data-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
               <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>
               <a href="{{route('admin.logout')}}" class="btn btn-light-danger ms-1 btn_loader"> 
               <!--  <i class="bx bx-power-off mr-50"></i> -->
               <span class="d-none d-sm-block"><strong>@lang('messages.header.logout')</strong></span></a>
            </div>
          </div>
       </div>
    </div>
   <!-- Popup modal for logout end -->

<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">

 $(document).on('click','.lang',function(){

    var lang =  $(this).data("language");
    var token = "{{csrf_token()}}";
    var currentUrl = "{{\URL::current()}}";
    $.ajax({
        url: '{{route('lang.post')}}',
        type: 'POST',
        dataType: "json",
        data: {lang:lang, _token:token},  
        success :function (data){
            window.location.href = currentUrl;
        }
    });
});

</script>
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('build/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('build/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{asset('build/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{asset('build/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->


    <!-- BEGIN: Page Vendor JS-->
    <!-- Start Dashboard -->

   @if(request()->is('admin/dashboard'))
    <script src="{{asset('build/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/extensions/swiper.min.js')}}"></script>
   @endif
    <!-- Dashboard Ed-->

    
    <script src="{{asset('build/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('build/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
   <script src="{{asset('build/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('build/app-assets/js/scripts/configs/vertical-menu-dark.js')}}"></script>
    <script src="{{asset('build/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('build/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/components.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/footer.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- Start Dashboard -->
    
    @if(request()->is('admin/dashboard'))
    <script src="{{asset('build/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> 
    @endif

    <!-- Dashboard -->
    <script src="{{asset('build/app-assets/js/scripts/extensions/sweet-alerts.min.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/datatables/datatable.js')}}"></script>

    <script src="{{asset('build/app-assets/js/scripts/modal/components-modal.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/pages/page-user-profile.js')}}"></script>
    <script src="{{asset('build/app-assets/js/scripts/pages/app-users.js')}}"></script>
   
    <!-- END: Page JS-->
    <!-- <script src="{{asset('build/app-assets/js/scripts/pages/jquerymultiselect.js')}}"></script> -->

   <script src="{{asset('build/app-assets/js/scripts/datatables/datatable.js')}}"></script>
   <script src="{{asset('build/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    jQuery(function() {

        jQuery(document).ready(function() {
            jQuery('.js-example-basic-multiple').select2();
      });
    });
</script>
</body>
<!-- END: Body-->

</html>