 <!-- Header -->
 <div class="header-area">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-md-4">
                 <div class="left">
                     <h6>@lang('business_messages.header.download_app')</h6>
                     <a href="{{asset('https://www.google.co.in/')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/mac-icon.png')}}" alt="mac-icon"></a>
                     <a href="{{asset('https://www.google.co.in/')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/play-strore.png')}}" alt="play strore icon"></a>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="center">
                     <h6>@lang('business_messages.header.free_shipping')</h6>
                 </div>
             </div>

             <div class="col-md-4">
                 <div class="right language">
                     <ul style="display: inline-block;">
                         <li><a href="{{asset('https://www.google.co.in/')}}" data-langauge12="en" class="us-lan"><img src="{{asset('assets/images/Flag_of_the_United_States.png')}}"></a></li>
                         <li><a href="{{asset('https://www.google.co.in/')}}" data-langauge12="ar" class="arabic-lan"><img src="{{asset('fronted/business_flow/assets/images/img/Arabic-Language-Flag.jpg')}}"></a></li>
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
                         @if(Auth::user()->role == BUSINESS_ROLE)
                         <a href="{{ route('frontend.business.home.index')}}">
                             @else
                             <a href="{{ route('frontend.store.home.index')}}">
                                 @endif
                                 <img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/tejarh-logo.png')}}" alt="Logo">
                             </a>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="middle header-form">
                         <form>
                             <div class="form-group">
                                 <div class="location">
                                     @php
                                     $countries = App\Models\Country::get();
                                     @endphp
                                     <select>
                                         <option>@lang('business_messages.country_dropdown.all_location')</option>
                                         @foreach ($countries as $con)
                                         <option value="{{ $con->id }}">{{ $con->name}}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </form>
                         <form>
                             <div class="form-group">
                                 <div class="header-serach">
                                     <input type="text" class="form-control" placeholder="@lang('business_messages.header.header_serach_text')">
                                     <button type="submit" class="btn">
                                         <img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/search-icon.png')}}" alt="Search Icon">
                                     </button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>

                 <div class="col-md-5">
                     <div class="right">
                         <ul>
                             @if (Auth::check())
                             <li>
                                 <a href="{{route('frontend.business.chat')}}">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                                         <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                             <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419" />
                                         </g>
                                     </svg>
                                 </a>
                             </li>
                             <li>
                                 <a href="javascript:void(0)">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                                         <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419" />
                                     </svg>
                                 </a>
                             </li>
                             <?php
                                $checkOut = \App\Models\CheckOutUserDetails::where('user_id', \Auth::User()->id)->orderBy('id', 'DESC')->first();
                                $checkOutId = \Auth::User()->id;
                                if (!empty($checkOut)) {
                                    $checkOutId = $checkOut->id;
                                ?>
                                 <li>
                                     <a href="{{ route('frontend.business.order-details.checkout',$checkOutId) }}">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="21.067" viewBox="0 0 25 21.067">
                                             <g id="noun-cart-1058525" transform="translate(-97.098 -67.186)">
                                                 <path id="Path_17289" data-name="Path 17289" d="M97.887,67.186a.833.833,0,1,0,.087,1.663h2.685L104.1,81.54a.832.832,0,0,0,.806.615h13.583a.832.832,0,1,0,0-1.663H105.545l-.3-1.109h13.8a.832.832,0,0,0,.806-.606l2.218-8.039a.837.837,0,1,0-1.611-.45L118.4,77.72H104.791l-1.724-6.376h15.419a.832.832,0,1,0,0-1.663H102.617l-.511-1.88a.832.832,0,0,0-.806-.615H97.974a.808.808,0,0,0-.087,0Zm9.234,16.077a2.495,2.495,0,1,0,2.495,2.495A2.508,2.508,0,0,0,107.121,83.264Zm9.425,0a2.495,2.495,0,1,0,2.495,2.495A2.507,2.507,0,0,0,116.546,83.264Zm-9.425,1.663a.832.832,0,1,1-.832.831A.819.819,0,0,1,107.121,84.927Zm9.425,0a.832.832,0,1,1-.832.831A.819.819,0,0,1,116.546,84.927Z" fill="#111419" />
                                             </g>
                                         </svg>
                                     </a>
                                 </li>
                             <?php
                                } else {
                                ?>
                                 <li>
                                     <a href="{{ route('frontend.business.order-details.checkout_empty') }}">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="21.067" viewBox="0 0 25 21.067">
                                             <g id="noun-cart-1058525" transform="translate(-97.098 -67.186)">
                                                 <path id="Path_17289" data-name="Path 17289" d="M97.887,67.186a.833.833,0,1,0,.087,1.663h2.685L104.1,81.54a.832.832,0,0,0,.806.615h13.583a.832.832,0,1,0,0-1.663H105.545l-.3-1.109h13.8a.832.832,0,0,0,.806-.606l2.218-8.039a.837.837,0,1,0-1.611-.45L118.4,77.72H104.791l-1.724-6.376h15.419a.832.832,0,1,0,0-1.663H102.617l-.511-1.88a.832.832,0,0,0-.806-.615H97.974a.808.808,0,0,0-.087,0Zm9.234,16.077a2.495,2.495,0,1,0,2.495,2.495A2.508,2.508,0,0,0,107.121,83.264Zm9.425,0a2.495,2.495,0,1,0,2.495,2.495A2.507,2.507,0,0,0,116.546,83.264Zm-9.425,1.663a.832.832,0,1,1-.832.831A.819.819,0,0,1,107.121,84.927Zm9.425,0a.832.832,0,1,1-.832.831A.819.819,0,0,1,116.546,84.927Z" fill="#111419" />
                                             </g>
                                         </svg>
                                     </a>
                                 </li>
                             <?php
                                }
                                ?>
                             @endif
                             <li>
                                 @if(Auth::check() && Auth::user()->role == BUSINESS_ROLE)
                                 <div class="login logout">
                                     <a href="javascript:void(0)" id="logout">
                                         @if(isset(Auth::user()->profile_picture))
                                         <img src="{{asset(BUSINESS_PROFILE_FOLDER.'/'.Auth::user()->profile_picture)}}" alt="Profile Pic">
                                         @else
                                         <img src="{{asset('assets/images/user.png')}}" alt="Profile Pic">
                                         @endif
                                         {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                     </a>
                                     <div class="login-option">
                                         <ul>
                                             @canany('dashboard access')
                                             <li>
                                                 <a href="{{ route('frontend.business.business-dashboard.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/dashboard.png')}}">@lang('business_messages.menu.dashboard')</a>
                                             </li>
                                             @endcanany

                                             <li><a href="{{ route('frontend.business.business-profile.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/user.png')}}">@lang('business_messages.menu.profile')</a></li>

                                             @canany('my orders access')
                                             <li><a href="{{ route('frontend.business.my-orders.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/My-Orders.png')}}">@lang('business_messages.menu.orders')</a></li>
                                             @endcanany

                                             @canany('Order Management access')
                                             <li><a href="{{ route('frontend.business.orders-sold.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">Order Management</a></li>
                                             @endcanany

                                             @canany('My Product access')
                                             <li><a href="{{ route('frontend.business.my-items.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/product.png')}}">My Product</a></li>
                                             @endcanany

                                             @canany('My Images access')
                                             <li><a href="{{ route('frontend.business.pages.import_images')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/product.png')}}">My Images</a></li>
                                             @endcanany
                                             @canany('My Basket access')
                                             <?php
                                                $checkOut = \App\Models\CheckOutUserDetails::where('user_id', \Auth::User()->id)->orderBy('id', 'DESC')->first();
                                                $checkOutId = \Auth::User()->id;
                                                if (!empty($checkOut)) {
                                                    $checkOutId = $checkOut->id;
                                                ?>
                                                 <li><a href="{{ route('frontend.business.order-details.checkout',$checkOutId) }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/basket.png') }}">@lang('frontend-messages.header.My Basket')</a></li>
                                             <?php
                                                } else {
                                                ?>
                                                 <li><a href="{{ route('frontend.business.order-details.checkout_empty') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/basket.png') }}">@lang('frontend-messages.header.My Basket')</a>
                                                 </li>
                                             <?php
                                                }
                                                ?>
                                             @endcanany
                                             @canany('MakeAnOffer access')
                                             <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/Hold-an-offer.png') }}">@lang('business_messages.menu.MakeAnOffer')</a></li>
                                             @endcanany

                                             @canany('wishlist access')
                                             <li><a href="{{ route('frontend.business.wishlist.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/Wishlist.png')}}">@lang('business_messages.menu.wishlist')</a></li>
                                             @endcanany

                                             @canany('Likelist access')
                                             <li><a href="{{ route('frontend.business.likelist.index') }}"><img src="{{ asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/thumb.png') }}">@lang('business_messages.menu.Likelist')</a></li>
                                             @endcanany

                                             @canany('wallet access')
                                             <li><a href="{{ route('frontend.business.business-wallet.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/wallet.png')}}">@lang('business_messages.menu.wallet')</a></li>
                                             @endcanany

                                             @canany('store access')
                                             <li><a href="{{ route('frontend.business.add-store.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/store.png')}}">@lang('business_messages.menu.store')</a></li>
                                             @endcanany

                                             @canany('role access')
                                             <li><a href="{{ route('frontend.business.add-roles.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/roll.png')}}">@lang('business_messages.menu.role')</a></li>
                                             @endcanany

                                             @canany('shipping access')
                                             <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/fast-delivery.png')}}">@lang('business_messages.menu.shipping')</a></li>
                                             @endcanany

                                             @canany('business_reports access')
                                             <li><a href="{{ route('frontend.business.business-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/pie-chart.png')}}">@lang('business_messages.menu.business_reports')</a></li>
                                             @endcanany


                                             <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/morning-routine.png')}}">@lang('business_messages.menu.daily_activities')</a></li> -->

                                             @canany('sales_report access')
                                             <li><a href="{{ route('frontend.business.sales-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/profit-report.png')}}">@lang('business_messages.menu.sales_report')</a></li>
                                             @endcanany

                                             <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/coupon.png')}}">@lang('business_messages.menu.add_coupon')</a></li> -->

                                             @canany('settings access')
                                             <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/icons-settings.png')}}">@lang('business_messages.menu.settings')</a></li>
                                             @endcanany

                                             <li><a class="last-menu" href="{{ route('frontend.business.user-support.index')}}"><img src="{{asset('assets/images/icon/Icon-support.png')}}">User Support</a></li>

                                             <li><a class="last-menu" href="{{ route('frontend.business.home.logout')}}"><img src="{{asset('assets/images/icon/logout.png')}}">@lang('business_messages.menu.logout')</a></li>

                                         </ul>
                                     </div>
                                 </div>
                                 @elseif(Auth::check() && Auth::user()->role == STORE_ROLE)
                                 <div class="login logout">
                                     <a href="javascript:void(0)" id="logout">
                                         @if(isset(Auth::user()->profile_picture))
                                         <img src="{{asset(BUSINESS_PROFILE_FOLDER.'/'.Auth::user()->profile_picture)}}" alt="Profile Pic">
                                         @else
                                         <img src="{{asset('assets/images/user.png')}}" alt="Profile Pic">
                                         @endif
                                         {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                     </a>
                                     <div class="login-option">
                                         <ul>
                                             @canany('Dashboard-Access')
                                             <li>
                                                 <a href="{{ route('frontend.store.store-dashboard.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/dashboard.png')}}">@lang('business_messages.menu.dashboard')</a>
                                             </li>
                                             @endcanany
                                             <li><a href="{{ route('frontend.store.store-profile.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/user.png')}}">@lang('business_messages.menu.profile')</a></li>
                                             @canany('MyOrders-Access')
                                             <li><a href="{{ route('frontend.store.my-orders.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/My-Orders.png')}}">@lang('business_messages.menu.orders')</a></li>
                                             @endcanany
                                             @canany('OrderManagement-Access')
                                             <li><a href="{{ route('frontend.store.orders-sold.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">Order Management</a></li>
                                             @endcanany
                                             @canany('MyProduct-Access')
                                             <li><a href="{{ route('frontend.store.my-items.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/product.png')}}">My Product</a></li>
                                             @endcanany
                                             @canany('MyImages-Access')
                                             <li><a href="{{ route('frontend.store.pages.import_images')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/product.png')}}">My Images</a></li>
                                             @endcanany

                                             <?php
                                                $checkOut = \App\Models\CheckOutUserDetails::where('user_id', \Auth::User()->id)->orderBy('id', 'DESC')->first();
                                                $checkOutId = \Auth::User()->id;
                                                if (!empty($checkOut)) {
                                                    $checkOutId = $checkOut->id;
                                                ?>
                                                 @canany('MyBasket-Access')
                                                 <li><a href="{{ route('frontend.business.order-details.checkout',$checkOutId) }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/basket.png') }}">@lang('frontend-messages.header.My Basket')</a></li>
                                                 @endcanany
                                             <?php
                                                }
                                                ?>
                                             @canany('MakeAnOffer-Access')
                                             <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/Hold-an-offer.png') }}">@lang('business_messages.menu.MakeAnOffer')</a></li>
                                             @endcanany
                                             @canany('Wishlist-Access')
                                             <li><a href="{{ route('frontend.store.wishlist.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/Wishlist.png')}}">@lang('business_messages.menu.wishlist')</a></li>
                                             @endcanany
                                             @canany('Likelist-Access')
                                             <li><a href="{{ route('frontend.store.likelist.index') }}"><img src="{{ asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/thumb.png') }}">@lang('business_messages.menu.Likelist')</a></li>
                                             @endcanany
                                             @canany('Wallet-Access')
                                             <li><a href="{{ route('frontend.store.store-wallet.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/wallet.png')}}">@lang('business_messages.menu.wallet')</a></li>
                                             @endcanany
                                             @canany('Role-Access')
                                             <li><a href="{{ route('frontend.store.add-roles.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/roll.png')}}">@lang('business_messages.menu.role')</a></li>
                                             @endcanany
                                             @canany('Shipping-Access')
                                             <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/fast-delivery.png')}}">@lang('business_messages.menu.shipping')</a></li>
                                             @endcanany
                                             @canany('BusinessReports-Access')
                                             <li><a href="{{ route('frontend.store.store-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/pie-chart.png')}}">@lang('business_messages.menu.business_reports')</a></li>
                                             @endcanany



                                             <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/morning-routine.png')}}">@lang('business_messages.menu.daily_activities')</a></li> -->

                                             @canany('SalesReport-Access')
                                             <li><a href="{{ route('frontend.store.sales-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/profit-report.png')}}">@lang('business_messages.menu.sales_report')</a></li>
                                             @endcanany


                                             <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/coupon.png')}}">@lang('business_messages.menu.add_coupon')</a></li> -->

                                             {{-- @canany('Settings-Access')
                                             <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/icons-settings.png')}}">@lang('business_messages.menu.settings')</a>
                             </li>
                             @endcanany --}}


                             <li><a class="last-menu" href="{{ route('frontend.business.home.logout')}}"><img src="{{asset('assets/images/icon/logout.png')}}">@lang('business_messages.menu.logout')</a></li>

                         </ul>
                     </div>
                 </div>
                 @else
                 <div class="login">
                     <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('business_messages.menu.login')</a>
                 </div>
                 @endif
                 </li>
                 <li>
                     <!-- frontend.store.item-post.index -->
                     @if(Auth::user()->role == STORE_ROLE)
                     <a class="join" href="{{route('frontend.store.item-post.index')}}">

                         @lang('business_messages.menu.sell_now')
                     </a>
                     @else
                     <a class="join" href="{{route('frontend.business.item-post.index')}}">

                         @lang('business_messages.menu.sell_now')
                     </a>
                     @endif

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
                     <a href="{{ route('frontend.business.home.index')}}">
                         <img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/tejarh-logo.png')}}" alt="Logo">
                     </a>
                 </div>
             </li>
             <li>
                 <form>
                     <div class="form-group">
                         <div class="location">
                             <div class="nice-select" tabindex="0">
                                 <span class="current">All Location</span>
                                 <ul class="list">
                                     <li data-value="All Location" class="option selected">All Location11</li>
                                     <li data-value="Kuwait" class="option">Kuwait</li>
                                     <li data-value="Bahrain" class="option">Bahrain</li>
                                     <li data-value="UAE" class="option">UAE</li>
                                     <li data-value="Qatar" class="option">Qatar</li>
                                     <li data-value="Oman" class="option">Oman</li>
                                     <li data-value="Jordan" class="option">Jordan</li>
                                     <li data-value="Egypt" class="option">Egypt</li>
                                 </ul>
                             </div>
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
                                 <img src="{{ asset('fronted/business_flow/assets/images/img/search-icon.png')}}" alt="Search Icon">
                             </button>
                         </div>
                     </div>
                 </form>
             </li>
         </ul>

     </div>
     <div class="mo-nav-menu">
         {{-- <ul> --}}
         {{-- <li>
                        <div class="mo-profile">
                            <img src="{{ asset('fronted/business_flow/assets/images/img/strory-img1.png') }}">
         <h5>Welcome to Tejarh!</h5>
         <p>Take charge of your buying and selling journey.</p>
     </div>
     </li> --}}
     {{-- <li>
                        <a href="chat-board.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                                <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                  <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419"></path>
                                </g>
                            </svg>
                            Comment
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                                <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419"></path>
                            </svg>  
                            Notification
                        </a>
                    </li> --}}

     {{-- <li><a href="b-dashborad.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/dashboard.png')}}">Dashboard</a></li>
     <li><a href="b-profile-current-login.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/user.png')}}">Profile</a></li>
     <li><a href="my-orders.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/My-Orders.png')}}">Orders</a></li>
     <li><a href="b-my-items.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/product.png')}}">My Items</a></li>
     <li><a href="wallet.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/wallet.png')}}">Wallet</a></li>
     <li><a href="b-add-store.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/store.png')}}">Store</a></li>
     <li><a href="b-role-listing-position.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/roll.png')}}">Role</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/fast-delivery.png')}}">Shipping</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/pie-chart.png')}}">Business reports</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/morning-routine.png')}}">Daily activities</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/profit-report.png')}}">Sales report</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/coupon.png')}}">Add Coupon</a></li>
     <li><a href="#"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/icons-settings.png')}}">Settings</a></li>
     <li><a href="index.html"><img src="{{ asset('fronted/business_flow/assets/images/img/icon/logout.png')}}">Logout</a></li> --}}

     {{-- <li> --}}
     @if(Auth::check() && Auth::user()->role == BUSINESS_ROLE)

     <div class="login logout">
         <a href="javascript:void(0)" id="logout">
             @if(isset(Auth::user()->profile_picture))
             <img src="{{asset(BUSINESS_PROFILE_FOLDER.'/'.Auth::user()->profile_picture)}}" alt="Profile Pic">
             @else
             <img src="{{asset('assets/images/user.png')}}" alt="Profile Pic">
             @endif
             {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
         <div class="login-option">
             <ul>
                 <li>
                     <a href="chat-board.html">
                         <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                             <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                 <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419" />
                             </g>
                         </svg>
                         Chat Board
                     </a>
                 </li>
                 <li>
                     <a href="#">
                         <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                             <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419" />
                         </svg>
                         Notification
                     </a>
                 </li>
                 <li><a href="{{ route('frontend.business.business-dashboard.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/dashboard.png')}}">@lang('business_messages.menu.dashboard')</a></li>
                 <li><a href="{{ route('frontend.business.business-profile.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/user.png')}}">@lang('business_messages.menu.profile')</a></li>
                 <li><a href="{{ route('frontend.business.my-orders.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/My-Orders.png')}}">@lang('business_messages.menu.orders')</a></li>
                 <li><a href="{{ route('frontend.business.my-items.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/product.png')}}">@lang('business_messages.menu.my_items')</a></li>
                 <li><a href="{{ route('frontend.business.wishlist.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/Wishlist.png')}}">@lang('business_messages.menu.wishlist')</a></li>
                 <li><a href="{{ route('frontend.business.business-wallet.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/wallet.png')}}">@lang('business_messages.menu.wallet')</a></li>
                 <li><a href="{{ route('frontend.business.add-store.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/store.png')}}">@lang('business_messages.menu.store')</a></li>
                 <li><a href="{{ route('frontend.business.add-roles.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/roll.png')}}">@lang('business_messages.menu.role')</a></li>
                 <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/fast-delivery.png')}}">@lang('business_messages.menu.shipping')</a></li>
                 <li><a href="{{ route('frontend.business.business-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/pie-chart.png')}}">@lang('business_messages.menu.business_reports')</a></li>
                 <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/morning-routine.png')}}">@lang('business_messages.menu.daily_activities')</a></li> -->
                 <li><a href="{{ route('frontend.business.sales-report.index')}}"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/profit-report.png')}}">@lang('business_messages.menu.sales_report')</a></li>
                 <!-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/coupon.png')}}">@lang('business_messages.menu.add_coupon')</a></li> -->
                 {{-- <li><a href="javascript:void(0)"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/icon/icons-settings.png')}}">@lang('business_messages.menu.settings')</a></li> --}}
                 <li><a class="last-menu" href="{{ route('frontend.business.home.logout')}}"><img src="{{asset('assets/images/icon/logout.png')}}">@lang('business_messages.menu.logout')</a></li>

             </ul>
         </div>
     </div>
     @else
     <div class="login">
         <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('business_messages.menu.login')</a>
     </div>
     @endif
     {{-- </li> --}}
     {{-- </ul> --}}
 </div>
 </div>
 <!-- End Navbar -->