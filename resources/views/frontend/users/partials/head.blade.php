
@if(Auth::check() && Auth::user()->role == BUSINESS_ROLE)
    @include('frontend.business.includes.head')
@else 
<!DOCTYPE html >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css?ver=0.0.1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Flat Icon CSS -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">
        <!-- Box Icon CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }} ">
        <!-- Mean Menu CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }} ">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }} ">
        <!-- Modal Video CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/modal-video.min.css') }} ">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}"> 
        <!-- RTL mode -->
        <!-- magnific-popup -->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/project-custom.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/rtl-mode.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/business-custom.css') }}">

        
        <title>@yield('title')</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/images/tejarh-word-logo.png') }}">
    </head>
@endif