@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User Wishlist' }}
@endsection

@section('content')
<!DOCTYPE html >
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css?ver=0.0.1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Flat Icon CSS -->
        <link rel="stylesheet" href="assets/fonts/flaticon.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="assets/css/nice-select.min.css">
        <!-- Box Icon CSS -->
        <link rel="stylesheet" href="assets/css/boxicons.min.css">
        <!-- Mean Menu CSS -->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <!-- Modal Video CSS -->
        <link rel="stylesheet" href="assets/css/modal-video.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- magnific-popup -->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        

        <link rel="stylesheet" href="assets/css/project-custom.css">
        <link rel="stylesheet" href="assets/css/business-custom.css">
        <link rel="stylesheet" href="assets/css/rtl-mode.css">
        
        <title>Tejarh</title>

        <link rel="icon" type="image/png" href="assets/images/favicon.png">
    </head>
    <body>
        <!-- Preloader -->
        <div class="loader">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="pre-load">
                        <div class="inner one"></div>
                        <div class="inner two"></div>
                        <div class="inner three"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Preloader -->

        <!-- Header -->
        <div class="header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="left">
                                <h6>Download App:</h6>
                                <a href="#"><img src="assets/images/img/mac-icon.png" alt="mac-icon"></a>
                                <a href="#"><img src="assets/images/img/play-strore.png" alt="play strore icon"></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="center">
                            <h6>FREE SHIPPING ON ORDERS OVER 20 SAR</h6>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="right language">
                            <ul style="display: inline-block;">
                                <li><a href="javascript:void(0)" class="us-lan"><img src="assets/images/img/Flag_of_the_United_States.png"></a></li>
                                <li><a href="javascript:void(0)" class="arabic-lan"><img src="assets/images/img/Arabic-Language-Flag.png"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Nav Top -->
        <div class="navbar-area sticky-top">
            <div class="nav-top-area main-nav">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-md-1">
                            <div class="left">
                                <a href="index.html">
                                    <img src="assets/images/img/tejarh-logo.png" alt="Logo">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="middle header-form">
                                <form>
                                    <div class="form-group">
                                        <div class="location">
                                            <select>
                                                <option>All Location</option>
                                                <option>Saudi Arabia</option>
                                                <option>Saudi</option>
                                                <option>Arabia</option>
                                                <option>India</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group">
                                        <div class="header-serach">
                                            <input type="text" class="form-control" placeholder="Find Cars, Mobile Phones and more...">
                                            <button type="submit" class="btn">
                                                <img src="assets/images/img/search-icon.png" alt="Search Icon">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="right">
                                <ul>
                                    <li>
                                        <a href="chat-board.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                                                <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                                  <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                                                <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419"/>
                                            </svg>  
                                        </a>
                                    </li>
                                    <li>
                                        <div class="login">
                                            <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                                            <div class="login-option">
                                                <ul>
                                                    <li><a href="profile-current-login.html"><img src="assets/images/img/icon/user.png">Profile</a></li>
                                                    <li><a href="my-orders.html"><img src="assets/images/img/icon/My-Orders.png">My Orders</a></li>
                                                    <li><a href="my-items.html"><img src="assets/images/img/icon/product.png">My Items</a></li>
                                                    <li><a href="wallet.html"><img src="assets/images/img/icon/wallet.png">Wallet</a></li>
                                                    <li><a href="#"><img src="assets/images/img/icon/Hold-an-offer.png">Hold an offer</a></li>
                                                    <li><a href="wishlist.html"><img src="assets/images/img/icon/Wishlist.png">Wishlist</a></li>
                                                    <li><a href="#"><img src="assets/images/img/icon/settings.png">Settings</a></li>
                                                    <li><a href="index.html"><img src="assets/images/img/icon/logout.png">Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="login logout" style="display: none;">                                            
                                            <a href="javascript:void(0)" id="logout"><img src="assets/images/img/profile-pic.png" alt="Profile Pic"> John Doe</a>
                                            <div class="login-option">
                                                <ul>
                                                    <li><a href="profile-current-login.html"><img src="assets/images/img/icon/user.png">Profile</a></li>
                                                    <li><a href="my-orders.html"><img src="assets/images/img/icon/My-Orders.png">My Orders</a></li>
                                                    <li><a href="my-items.html"><img src="assets/images/img/icon/product.png">My Items</a></li>
                                                    <li><a href="wallet.html"><img src="assets/images/img/icon/wallet.png">Wallet</a></li>
                                                    <li><a href="#"><img src="assets/images/img/icon/Hold-an-offer.png">Hold an offer</a></li>
                                                    <li><a href="wishlist.html"><img src="assets/images/img/icon/Wishlist.png">Wishlist</a></li>
                                                    <li><a href="#"><img src="assets/images/img/icon/settings.png">Settings</a></li>
                                                    <li><a href="index.html"><img src="assets/images/img/icon/logout.png">Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="join" href="post-an-item.html">
                                            Sell Now
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Nav Top -->

         <!-- Navbar -->
         <div class="mobile-menu-wrapper navbar-area sticky-top"> 
            <div class="container">
                <ul>
                    <li>
                        <div class="mobile-logo">
                            <a href="index.html" class="logo">
                                <img src="assets/images/img/tejarh-logo.png" alt="Logo">
                            </a>
                        </div>
                    </li>
                    <li>
                        <form>
                            <div class="form-group">
                                <div class="location">
                                    <select style="display: none;">
                                        <option>All Location</option>
                                        <option>Saudi Arabia</option>
                                        <option>Saudi</option>
                                        <option>Arabia</option>
                                        <option>India</option>
                                    </select><div class="nice-select" tabindex="0"><span class="current">All Location</span><ul class="list"><li data-value="All Location" class="option selected">All Location</li><li data-value="Saudi Arabia" class="option">Saudi Arabia</li><li data-value="Saudi" class="option">Saudi</li><li data-value="Arabia" class="option">Arabia</li><li data-value="India" class="option">India</li></ul></div>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="more-menu">
                            <i class="bx bx-bar-chart"></i>
                        </a>
                    </li>
                    <li>
                        <form class="header-search-form">
                            <div class="form-group">
                                <div class="header-serach">
                                    <input type="text" class="form-control" placeholder="Find Cars, Mobile Phones and more...">
                                    <button type="submit" class="btn">
                                        <img src="assets/images/img/search-icon.png" alt="Search Icon">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>

            </div>
            <div class="mo-nav-menu">
                <ul>
                    <li>
                        <div class="mo-profile">
                            <img src="assets/images/img/strory-img1.png">
                            <h5>Welcome to Tejarh!</h5>
                            <p>Take charge of your buying and selling journey.</p>
                        </div>
                    </li>
                    <li>
                        <a href="chat-board.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                                <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                  <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419"></path>
                                </g>
                            </svg>
                            Chat
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                                <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419"></path>
                            </svg>  
                            Notification
                        </a>
                    </li>
                    <li><a href="profile-current-login.html"><img src="assets/images/img/icon/user.png">Profile</a></li>
                    <li><a href="my-orders.html"><img src="assets/images/img/icon/My-Orders.png">My Orders</a></li>
                    <li><a href="my-items.html"><img src="assets/images/img/icon/product.png">My Items</a></li>
                    <li><a href="wallet.html"><img src="assets/images/img/icon/wallet.png">Wallet</a></li>
                    <li><a href="#"><img src="assets/images/img/icon/Hold-an-offer.png">Hold an offer</a></li>
                    <li><a href="wishlist.html"><img src="assets/images/img/icon/Wishlist.png">Wishlist</a></li>
                    <li><a href="#"><img src="assets/images/img/icon/settings.png">Settings</a></li>
                    <li><a href="index.html"><img src="assets/images/img/icon/logout.png">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- End Navbar -->

        <div class="mini-banner">
            <img src="assets/images/img/Profile-Seller-banner.png">
        </div>


        <div class="profile-seller">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-seller-sidebar">
                            <div class="profile-seller-img-content">
                                <div class="profile-seller-img">
                                    <img src="assets/images/img/okta-logo.png">
                                </div>
                                <div class="profile-seller-content">
                                    <h5>Okta Market <img src="assets/images/img/best-seller.png"></h5>
                                    <p>Member since jan 2020</p>
                                    <p><a href="www.oktamarket.com">www.oktamarket.com</a></p>
                                    <p><a href="tel:+971 55 520 5882">+971 55 520 5882</a></p>
                                    <p>CR No. : 43454-4</p>
                                    <address>
                                        <img src="assets/images/img/map-icon.png">Riyadh, Saudi Arabia
                                    </address>
                                    <div class="rating">
                                        <img src="assets/images/img/fill-star.png">
                                        <img src="assets/images/img/fill-star.png">
                                        <img src="assets/images/img/grey-star.png">
                                        <img src="assets/images/img/grey-star.png">
                                        <img src="assets/images/img/grey-star.png">
                                    </div>
                                    <div class="location">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#googlemap-Modal">
                                            <img src="assets/images/img/location-img.png">
                                        </a>
                                    </div>
                                    <div class="selling-number">
                                        <ul>
                                            <li>10<strong>Bought</strong></li>
                                            <li>20<strong>Sold</strong></li>
                                            <li>5<strong>Followers</strong></li>
                                            <li>20<strong>Following</strong></li>
                                        </ul>
                                    </div>
                                    <div class="verified-your-account">
                                        <h6>Verified your account</h6>
                                        <ul>
                                            <li><a href="#"><i class="fas fa-envelope"></i><strong>Email Verified</strong></a></li>
                                            <li><a href="#"><i class="fas fa-phone"></i><strong>Phone Verified</strong></a></li>
                                            <li><a href="#"><i class="fas fa-address-card"></i><strong>Government Verified</strong></a></li>
                                            <li><a href="#"><img src="assets/images/img/ministry-of-commerce-and-industry.png"></a></li>
                                            <li><a href="#"><img src="assets/images/img/Maroof-logo.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="verified-your-account">
                                        <h6>Verified seller badge</h6>
                                        <ul>
                                            <li><a href="#"><img src="assets/images/img/weekly-calendar-page-symbol.png"><strong>Member Since 1 year</strong></a></li>
                                            <li><a href="#"><i class="fas fa-truck"></i><strong>Quick Shipper</strong></a></li>
                                            <li><a href="#"><img src="assets/images/img/security-on-icon.png"><strong>Reliable</strong></a></li>
                                        </ul>
                                    </div>
                                    <p><a href="#">*Return policy</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="story-wrapper">
                            <div class="container">
                                <div class="add-story">
                                    <i class='bx bx-plus' data-bs-toggle="modal" data-bs-target="#Uploading-Story"></i>
                                    <span>My Story</span>
                                </div>
                                <div class="story-slider-wrapper">
                                    <strong class="close-story-btn">+</strong>
                                    <div id="sync1" class="slider1 owl-carousel">
                                        <div class="multi-story-slider owl-carousel">
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious1
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <!-- <img src="assets/images/img/mitzie-organics-1.png"> -->
                                                        <video controls="" autoplay="true" src="assets/videos/dummyvideo.mp4"></video>
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious2
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious3
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious4
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious5
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious6
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="multi-story-slider owl-carousel">
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious1
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <!-- <img src="assets/images/img/mitzie-organics-1.png"> -->
                                                        <video controls="" autoplay="true" src="assets/videos/dummyvideo.mp4"></video>
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious2
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious3
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious4
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious5
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious6
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="multi-story-slider owl-carousel">
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious1
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious2
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="story-slide-box">
                                                    <div class="story-slide-img">
                                                        <h6>
                                                            <img src="assets/images/img/strory-img4.png">
                                                            Handmade & Precious3
                                                            <i class='bx bx-info-circle'></i>
                                                        </h6>
                                                        
                                                        <img src="assets/images/img/mitzie-organics-1.png">
                                                    </div>
                                                    <div class="story-slide-content">
                                                        <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                        <p>Riyadh, Saudi Arabia</p>
                                                        <a href="#" class="btn">Make an offer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="story-slider-box">
                                            <div class="story-slide-box">
                                                <div class="story-slide-img">
                                                    <h6>
                                                        <img src="assets/images/img/strory-img4.png">
                                                        Handmade & Precious
                                                        <i class='bx bx-info-circle'></i>
                                                    </h6>
                                                    
                                                    <img src="assets/images/img/mitzie-organics-1.png">
                                                </div>
                                                <div class="story-slide-content">
                                                    <h5>Mitzie Oil<strong>500 SAR</strong></h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="#">More</a></p>
                                                    <p>Riyadh, Saudi Arabia</p>
                                                    <a href="#" class="btn">Make an offer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sync2" class="story-slider navigation-thumbs1 owl-carousel">
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img4.png" alt="Shape"></div>
                                            <span>Jessy314</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img1.png" alt="Shape"></div>
                                            <span>Maddy42</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img2.png" alt="Shape"></div>
                                            <span>ChandM23</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img3.png" alt="Shape"></div>
                                            <span>Zowi98</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img1.png" alt="Shape"></div>
                                            <span>Kitty87</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img4.png" alt="Shape"></div>
                                            <span>Brutal12</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img1.png" alt="Shape"></div>
                                            <span>Melody54</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img2.png" alt="Shape"></div>
                                            <span>Buckshot1</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img3.png" alt="Shape"></div>
                                            <span>Zesty87</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img4.png" alt="Shape"></div>
                                            <span>Happy65</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img1.png" alt="Shape"></div>
                                            <span>Tulip23</span>
                                        </a>
                                    </div>
                                    <div class="story-slider-box">
                                        <a href="#">
                                            <div class="story-img"><img src="assets/images/img/strory-img2.png" alt="Shape"></div>
                                            <span>Jelly12</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>            
                        <!-- end story-wrapper -->
                        
                        <div class="products-wrapper">             
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <span class="featured">Featured</span>
                                            <img src="assets/images/img/product-img1.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn">Used</span>
                                            <h6>7,000 SAR</h6>
                                            <p>Apple airpods</p>
                                            <p>Jeddah, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>The Full Cart</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img2.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn unused-btn">UnUsed</span>
                                            <h6>58,000 SAR</h6>
                                            <p>Bottle for salon </p>
                                            <p>Dammam, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Heaven Space</p>
                                                <i class='product-dots disable'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img3.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn new-btn">New</span>
                                            <h6>2,900 SAR</h6>
                                            <p>Apple red combo</p>
                                            <p>Riyadh, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Handmade & Precious</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <span class="featured">Featured</span>
                                            <img src="assets/images/img/product-img1.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn">Used</span>
                                            <h6>7,000 SAR</h6>
                                            <p>Apple airpods</p>
                                            <p>Jeddah, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>The Full Cart</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img2.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn unused-btn">UnUsed</span>
                                            <h6>58,000 SAR</h6>
                                            <p>Bottle for salon </p>
                                            <p>Dammam, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Heaven Space</p>
                                                <i class='product-dots disable'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img3.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn new-btn">New</span>
                                            <h6>2,900 SAR</h6>
                                            <p>Apple red combo</p>
                                            <p>Riyadh, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Handmade & Precious</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <span class="featured">Featured</span>
                                            <img src="assets/images/img/product-img1.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn">Used</span>
                                            <h6>7,000 SAR</h6>
                                            <p>Apple airpods</p>
                                            <p>Jeddah, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>The Full Cart</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img2.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn unused-btn">UnUsed</span>
                                            <h6>58,000 SAR</h6>
                                            <p>Bottle for salon </p>
                                            <p>Dammam, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Heaven Space</p>
                                                <i class='product-dots disable'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="products-box">
                                        <div class="products-box-img">
                                            <img src="assets/images/img/product-img3.png">
                                            <a href="#" class="wish-list-icon">                                    
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                        </div>
                                        <div class="products-box-content">
                                            <span class="used-btn new-btn">New</span>
                                            <h6>2,900 SAR</h6>
                                            <p>Apple red combo</p>
                                            <p>Riyadh, Saudi Arabia</p>
                                            <div class="products-box-footer">
                                                <img src="assets/images/img/product-profile-img.png">
                                                <p>Handmade & Precious</p>
                                                <i class='product-dots'></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- products-wrapper -->

                        <div class="pagination-wrapper">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                  <li class="page-item"><a class="page-link" href="#">&lt;</a></li>
                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                                </ul>
                              </nav>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <div class="try-tejarg-app-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="assets/images/img/try-tejarg-app.png">
                    </div>
                    <div class="col-md-7">
                        <div class="mo-application">
                            <h2>TRY THE TEJARH APP</h2>
                            <p>Buy, sell and find just about anything using the app on your mobile.</p>                        
                            <ul>
                                <li>
                                    <a href="#"><img src="assets/images/img/google-play.png"> </a>
                                </li>
                                <li>
                                    <a href="#"><img src="assets/images/img/app-store.png"> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



      
        <!-- Footer -->
        <footer class="footer-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="footer-menu-wrapper">
                            <div class="footer-menu">
                                <h5>SITE LINKS</h5>
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Locations</a></li>
                                    <li><a href="#">Coupons & Offers</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>POPULAR CITIES</h5>
                                <ul>
                                    <li><a href="#">Riyadh</a></li>
                                    <li><a href="#">Jeddah</a></li>
                                    <li><a href="#">Medina</a></li>
                                    <li><a href="#">Mecca</a></li>
                                    <li><a href="#">Tabuk</a></li>
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>USEFUL LINKS</h5>
                                <ul>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">T&C</a></li>
                                    <li><a href="#">Terms Of Use</a></li>
                                    <li><a href="#">Track Orders</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Cancellation</a></li>
                                </ul>
                                <ul>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Whitehat</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="assets/images/img/tejarh-white-logo.png" alt="Tejarh Logo">
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="social-media">
                                <h5>Follow us:</h5>
                                <ul>
                                    <li><a href="#"><img src="assets/images/img/facebook.png"></a></li>
                                    <li><a href="#"><img src="assets/images/img/instagram.png"></a></li>
                                    <li><a href="#"><img src="assets/images/img/pinterest.png"></a></li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- Copyright -->
        <div class="copyright-area">
            <div class="container">
                <div class="copyright-item">
                    <p>Copyright © 2020-21 <a href="#" target="_blank">Tejarh MarketPlace</a> All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- End Copyright -->
        
        <!-- loginModal -->
        <div class="modal fade" id="loginModal" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-logo">
                            <a href="#">
                                <img src="assets/images/img/tejarh-word-logo.png" alt="tejarh-white-logo">
                            </a>
                        </div>
                        <h5>Welcome back!</h5>
                        <p>Please sign in to your account.</p>
                        <form>
                            <div class="input-group">
                                <input type="text" placeholder="Username/Email" class="form-control">
                            </div>
                            <div class="input-group password">
                                <input type="password" placeholder="Password" class="form-control" id="log_in_password">
                                <i toggle="#log_in_password" class="fas fa-eye-slash"></i>
                            </div>
                            
                            <div class="forgot-password-div">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Remember Me
                                    </label>
                                </div>
                                <div class="input-group">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="form-group submit">
                                <input type="submit" class="btn btn-primary" value="Sign In">
                            </div>                    
                        </form>
                        <div class="sign-in-with">
                            <p>Don't have an account? <a href="javascript:void(0)" id="sign-up"  data-bs-toggle="modal" data-bs-target="#signUpModal" data-bs-dismiss="modal">Sign Up</a></p>
                        </div>
                    </div>
                </div>
        </div>

        <!-- forgotPasswordModal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-logo">
                        <a href="#">
                            <img src="assets/images/img/tejarh-word-logo.png" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Forgot Password</h5>
                    <p>Enter your registered email below to receive password reset instruction</p>
                    <form>
                        <div class="input-group">
                            <input type="text" placeholder="Username/Email" class="form-control">
                        </div>
                        <div class="form-group submit">
                            <button type="button" class="input-btn" data-bs-toggle="modal" data-bs-target="#otpScreenModal" data-bs-dismiss="modal">Reset Password</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>

        <!-- resetPasswordModal -->
        <div class="modal fade" id="resetPasswordModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-logo">
                        <a href="#">
                            <img src="assets/images/img/tejarh-word-logo.png" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Reset Password</h5>
                    <p>Your new password must be different from previous used passwords.</p>
                    <form>
                        <div class="input-group password">
                            <input type="password" placeholder="Enter New Password" class="form-control" id="reset_password">
                            <i toggle="#reset_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group password">
                            <input type="password" placeholder="Confirm New Password" class="form-control" id="confirm_reset_password">
                            <i toggle="#confirm_reset_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Reset Password">
                        </div>                    
                    </form>
                </div>
            </div>
        </div>

        <!-- otpScreenModal -->
        <div class="modal fade" id="otpScreenModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-logo">
                        <a href="#">
                            <img src="assets/images/img/tejarh-word-logo.png" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Verification</h5>
                    <p>You will get OPT via SMS</p>
                    <form>
                        <div class="otpScreenList">
                            <input class="form-control" maxlength="1" type="text" />
                            <input class="form-control" maxlength="1" type="text" />
                            <input class="form-control" maxlength="1" type="text" />
                            <input class="form-control" maxlength="1" type="text" />
                            <input class="form-control" maxlength="1" type="text" />
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Verify">
                        </div>                   
                    </form>
                    <p>Didn't receive the verification OTP?</p>
                    <a href="#">Resend again</a>
                </div>
            </div>
        </div>

        <!-- signUpModal -->
        <div class="modal fade" id="signUpModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-logo">
                        <a href="#">
                            <img src="assets/images/img/tejarh-word-logo.png" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Create Account,</h5>
                    <p>Please Sign up to get started!</p>
                    <form>
                        <div class="create_acc_wrapper">
                            <div class="form-check">
                                <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="user_acc" >
                                <label class="form-check-label">
                                    <i class="fas fa-user"></i>User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bussiness_acc">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <i class="fas fa-briefcase"></i>Business
                                </label>
                            </div>
                        </div>
                        <p>Please Sign up to get started!</p>
                        <div class="form-group submit">
                            <button type="button" class="input-btn signupstep2-btn" data-bs-toggle="modal" data-bs-target="#SignUpStep2" data-bs-dismiss="modal">Sign In</button>
                            <button type="button" class="input-btn business-sign-up-btn" data-bs-toggle="modal" data-bs-target="#business-sign-up" data-bs-dismiss="modal">Sign In</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>

        <!-- What is User Modal -->
        <div class="modal fade" id="whatIsUserModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">                    
                    <h5>What is User</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Id porta nibh venenatis cras sed. Mattis vulputate enim nulla aliquet. Dignissim convallis aenean et tortor at risus. Nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit. Enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra. Egestas tellus rutrum tellus pellentesque. Morbi tristique senectus et netus. Scelerisque purus semper eget duis at tellus. Nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum. Morbi tristique senectus et netus et malesuada fames ac turpis. Lectus arcu bibendum at varius vel pharetra vel turpis.</p>
                    <a href="javascript:void(0)" class="cancle">Cancel</a>
                </div>
            </div>
        </div>


        <!-- What is Business Profile Modal -->
        <div class="modal fade" id="business_profileModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">                    
                    <h5>What is Business Profile</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Id porta nibh venenatis cras sed. Mattis vulputate enim nulla aliquet. Dignissim convallis aenean et tortor at risus. Nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit. Enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra. Egestas tellus rutrum tellus pellentesque. Morbi tristique senectus et netus. Scelerisque purus semper eget duis at tellus. Nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum. Morbi tristique senectus et netus et malesuada fames ac turpis. Lectus arcu bibendum at varius vel pharetra vel turpis.</p>
                    <a href="#signUpModal"  class="cancle">Cancel</a>
                </div>
            </div>
        </div>

        <!-- SignUp-Step-2(User) -->
        <div class="modal fade" id="SignUpStep2" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL(this);" />
                                <!-- <img id="blah" src="http://placehold.it/180" alt="your image" /> -->
                                <img id="blah" src="assets/images/img/file-upload-icon.png"> 
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="First Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Last Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Username" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="input-group mobile-number">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>+91</option>
                                    <option value="1">+1</option>
                                    <option value="2">+11</option>
                                    <option value="3">+33</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="tel" placeholder="Enter Phone Number" class="form-control">
                            </div>
                        </div>
                        <div class="input-group password">
                            <input type="password" placeholder="Password" class="form-control" id="sign_up_password">
                            <i toggle="#sign_up_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group password">
                            <input type="password" placeholder="Confirm Password" class="form-control" id="confirm_sign_up_password">
                            <i toggle="#confirm_sign_up_password" class="fas fa-eye-slash"></i>
                        </div>
                        
                        <p>
                            By creating an account. You agree to the <a href="#">Term of Service</a> and acknowledge our <a href="#">Privacy Policy</a>.
                        </p>
                        
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Sign Up">
                        </div>                    
                    </form>
                    <p>Already have a account?<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a></p>
                </div>
            </div>
        </div>  

        <!-- Uploading-Story -->
        <div class="modal fade" id="Uploading-Story" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <h5>Uploading Story</h5>
                    <form>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type="file">
                                <img src="assets/images/img/Uploading-Story.png"> 
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Product Name" class="form-control">
                        </div>
                        
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Choose Category</option>
                                <option value="1">Option1</option>
                                <option value="2">Option2</option>
                                <option value="3">Option3</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="textarea" placeholder="Description" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Product Price" class="form-control">
                        </div>
                        <div class="input-group location-icon">
                            <input type="text" placeholder="Store Location" class="form-control">
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Add Story">
                        </div>                    
                    </form>
                    <a href="javascript:void(0)" data-bs-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>  

        <div class="modal fade" id="business-sign-up" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL(this);" />
                                <!-- <img id="blah" src="http://placehold.it/180" alt="your image" /> -->
                                <img id="blah" src="assets/images/img/file-upload-icon.png"> 
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Company Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Company Legal Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Owner / Manager Name" class="form-control">
                        </div>

                        <div class="input-group">
                            <input type="text" placeholder="Enter CR Number" class="form-control">
                        </div>
                        <div class="input-group file-upload-icon">
                            <input type="file" placeholder="Upload CR" class="form-control">
                            <h5>Upload CR</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Enter Maroof Number" class="form-control">
                        </div>

                        <div class="input-group file-upload-icon">
                            <input type="file" placeholder="Upload Maroof" class="form-control">
                            <h5>Upload Maroof</h5>
                        </div>
                        <div class="input-group">
                            <input type="date" placeholder="Date of expiry" class="form-control">
                        </div>
                        <div class="input-group file-upload-icon">
                            <input type="file" placeholder="VAT Number" class="form-control">
                            <h5>VAT Number</h5>
                        </div>
                        <div class="input-group file-upload-icon">
                            <input type="file" placeholder="Return Policy" class="form-control">
                            <h5>Return Policy</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Bank Name" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Bank Account Number" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="IBAN number" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Business email" class="form-control">
                        </div>
                        <div class="input-group mobile-number">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>+91</option>
                                    <option value="1">+1</option>
                                    <option value="2">+11</option>
                                    <option value="3">+33</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="tel" placeholder="Enter Phone Number" class="form-control">
                            </div>
                        </div>
                        <div class="input-group location-icon">
                            <input type="text" placeholder="Location" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="District" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Country" class="form-control">
                        </div>
                        <div class="input-group password">
                            <input type="password" placeholder="Password" class="form-control" id="sign_up_password">
                            <i toggle="#sign_up_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" placeholder="Confirm Password" class="form-control" id="confirm_sign_up_password">
                        </div>
                        
                        <p>
                            By creating an account. You agree to the <a href="#">Term of Service</a> and acknowledge our <a href="#">Privacy Policy</a>.
                        </p>
                        
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Sign Up">
                        </div>                    
                    </form>
                    <p>Already have a account?<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a></p>
                </div>
            </div>
        </div> 
        <!-- business-sign-up -->

        <!-- What is Business Profile Modal -->
        <div class="modal fade" id="sla-certificate" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">                    
                    <p>The agreement has been valid from <strong>Wednesday</strong> and the date 
                    </strong>10/2021</strong> between each of the</p>
                    <p>The Tejarh Company for Information and Technology, under Commercial Registration No. (Xxxxxxx), dated x/x/xxxx, issued by Riyadh, and its head office is located in Riyadh, Kingdom of Saudi 
                        Arabia, and its address is Xxxxx Road, XXXX District , Telephone No. (xxxxx) and address Email Agreement@tejarh.co (hereinafter referred to as (the first party, Tejarh or the platform,</p>
                    <p>Then the details of the vendor that he entered in his registration Name of the owner / manager / company name / store name / commercial registration  / address / phone number /  then the 
                        agreements </p>
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="agree-to-continue" checked>
                            <label class="form-check-label" for="agree-to-continue">
                                I read all details and agree to continue.
                            </label>
                          </div>
                          <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Done">
                        </div> 
                    </form>
                </div>
            </div>
        </div>

        <!-- Google map Modal -->
        <div class="modal fade" id="googlemap-Modal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">                
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463876.93971317937!2d46.542342999060686!3d24.725555344757552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sin!4v1644318644387!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>                
            </div>
        </div>


        


        <!-- Go Top -->
        <div class="go-top">
            <i class='bx bxs-up-arrow-circle'></i>
            <i class='bx bxs-up-arrow-circle'></i>
        </div>
        <!-- End Go Top -->


        <!-- Essential JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Form Validator JS -->
        <script src="assets/js/form-validator.min.js"></script>
        <!-- Contact JS -->
        <script src="assets/js/contact-form-script.js"></script>
        <!-- Ajax Chip JS -->
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>
        <!-- Nice Select JS -->
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <!-- Mean Menu JS -->
        <script src="assets/js/jquery.meanmenu.js"></script>
        <!-- Revolution JS -->
		<script src="assets/js/jquery.themepunch.tools.min.js"></script>
		<script src="assets/js/jquery.themepunch.revolution.min.js"></script>
        <!-- Mixitup JS -->
        <script src="assets/js/jquery.mixitup.min.js"></script>
        <!-- Owl Carousel JS -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <!-- Modal Video JS -->
        <script src="assets/js/jquery-modal-video.min.js"></script>
        
        <!-- magnific-popup -->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!-- Custom JS -->
        <script src="assets/js/custom.js"></script>

        <script>
            // product details slider 
            $(document).ready(function() {
                var sync1 = $(".slider1");
                var sync2 = $(".navigation-thumbs1");	
                var thumbnailItemClass = '.owl-item';	
                var slides = sync1.owlCarousel({
                    video:true,
                    startPosition: 12,
                    responsive:{
                        0:{
                            items:1,				
                            margin:10,
                        },
                        767:{
                            items:3, 
                            margin:15,
                        },
                        1200:{
                            items:5,
                            margin:20,
                        }
                    },
                    loop:false,
                    touchDrag:false,
                    mouseDrag:false,
                    nav: true,
                    dots: false,
                    video:true,
                    lazyLoad:true,
                    center:true
                }).on('changed.owl.carousel', syncPosition);
                
                
                function syncPosition(el) {
                    $owl_slider = $(this).data('owl.carousel');
                    var loop = $owl_slider.options.loop;
                    
                    if(loop){
                        var count = el.item.count-1;
                        var current = Math.round(el.item.index - (el.item.count/2) - .5);
                        if(current < 0) {
                            current = count;
                        }
                        if(current > count) {
                            current = 0;
                        }
                    }else{
                        var current = el.item.index;		
                    }
                    
                    var owl_thumbnail = sync2.data('owl.carousel');
                    var itemClass = "." + owl_thumbnail.options.itemClass;
                    
                    
                    var thumbnailCurrentItem = sync2
                    .find(itemClass)
                    .removeClass("synced")
                    .eq(current);
                    
                    thumbnailCurrentItem.addClass('synced');
                    thumbnailCurrentItem.addClass('see-this-story');	
                    
                    if (!thumbnailCurrentItem.hasClass('active')) {
                        var duration = 300;
                        sync2.trigger('to.owl.carousel',[current, duration, true]);
                        
                    }   
                }
                var thumbs = sync2.owlCarousel({
                    startPosition: 1,
                    items:12,
                    responsive:{
                        1200:{
                            margin:20,
                        },
                        767:{
                            margin:15,			
                        },
                        0:{
                            margin:10,                           
                        }		
                    },
                    autoWidth:true,
                    loop:false,
                    margin:0,
                    autoplay:false,
                    nav: false,
                    dots: false,
                    onInitialized: function (e) {
                        var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
                        thumbnailCurrentItem.addClass('synced');
                        thumbnailCurrentItem.addClass('see-this-story');
                        
                    },
                })
                .on('click', thumbnailItemClass, function(e) {
                    e.preventDefault();
                    var duration = 300;
                    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
                    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
                }).on("changed.owl.carousel", function (el) {
                        var number = el.item.index;
                        $owl_slider = sync1.data('owl.carousel');
                        $owl_slider.to(number, 100, true);
                });	

                $('.story-slider-wrapper').hide();	
                $('#sync2 .owl-item').click(function(){
                    $('.story-slider-wrapper').show();
                    $('body').css('overflow','hidden');
                })

                $('.close-story-btn').click(function(){
                    $('.story-slider-wrapper').hide();
                    $('body').css('overflow','unset');
                });

                var videoSlider = $('.multi-story-slider.owl-carousel');
                videoSlider.owlCarousel({
                    margin: 0,
                    nav: false,
                    dots: true,
                    animateOut: 'fadeOut',
                    navText: [
                        "<i class='bx bx-left-arrow-alt'></i>",
                        "<i class='bx bx-right-arrow-alt'></i>"
                    ],
                    items:1,
                    smartSpeed:1000,		
                    loop:false
                });

                
                
                
                $('#sync2 .owl-item').click(function(){
                    setTimeout(function () {			
                        if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {
                            $('.owl-item.active .item video').get(0).play();
                            $(this).get(0).currentTime = 0;
                        }
                        else{
                            $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).pause();				
                            $(this).get(0).currentTime = 0;
                        }
                    }, 1000);
                })

                $('.close-story-btn').click(function(){
                    $('.item video').get(0).pause();
                })
                
                
                sync1.on('translate.owl.carousel', function (e) {	
                        setTimeout(function () {	
                            $('.multi-story-slider .owl-item .item video').each(function () {
                                $(this).get(0).pause();
                                $(this).get(0).currentTime = 0;
                            });
                        },1000);
                        setTimeout(function () {	
                            if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {			
                                $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).play();
                                $(this).get(0).currentTime = 0;
                            }
                        },1000);		
                });
                $('.owl-item.active.see-this-story').removeClass('see-this-story');
            });
        </script>
    </body>
</html>

@endsection

@section('script')

@endsection

