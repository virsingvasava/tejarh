
<!DOCTYPE html>

@if(\App::getLocale() == "en")
  <html class="loading" lang="en" data-textdirection="ltr">
@else
  <html class="loading" lang="ar" data-textdirection="rtl">
@endif

<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Tejarh</title>
    <link rel="apple-touch-icon" href="{{asset('build/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('build/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    

    <!-- BEGIN: Vendor CSS-->
    @if(\App::getLocale() == "en")
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/forms/select/select2.min.css')}}">

    @else
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/vendors-rtl.min.css')}}">
    @endif

      <!-- Start Dashboard -->
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/extensions/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/extensions/toastr.css')}}">
    <!-- End Dashboard -->


    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->

    @if(\App::getLocale() == "en")
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/themes/semi-dark-layout.css')}}">
    @else

    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/custom-rtl.css')}}">
    @endif
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->


    @if(\App::getLocale() == "en")
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/pages/page-user-profile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/pages/app-users.css')}}">


    @else
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/pages/page-knowledge-base.css')}}">
    @endif


    <!-- Start Dashboard -->
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <!-- End Dashboard -->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    @if(\App::getLocale() == "en")
    <link rel="stylesheet" type="text/css" href="{{asset('build/assets/css/style.css')}}">
    @else
    <link rel="stylesheet" type="text/css" href="{{asset('build/assets/css/style-rtl.css')}}">
    @endif
    <!-- END: Custom CSS-->

    @if(\App::getLocale() == "en")
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    @else
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/css-rtl/custom-rtl.css')}}">
    @endif

<!-- testing -->
<!-- end testing -->

    <script type="text/javascript">
         var SITE_URL = '{{URL::to('/')}}'
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

@include('layouts.admin_sidebar')