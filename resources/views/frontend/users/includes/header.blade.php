<!-- Header -->
<div class="header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="left">
                    <h6>@lang('frontend-messages.header.Download App')</h6>
                    <a href="{{asset('https://www.google.co.in/')}}"><img src="{{ asset('fronted/users_flow/assets/images/mac-icon.png') }}" alt="mac-icon"></a>
                    <a href="{{asset('https://www.google.co.in/')}}"><img src="{{ asset('fronted/users_flow/assets/images/play-strore.png') }}" alt="play strore icon"></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="center">
                    <h6>@lang('frontend-messages.header.Head Text')</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="right language">
                    <ul style="display: inline-block;">
                        <li><a href="javascript:void(0)" data-langauge12="en" title="English" class="us-lan"><img src="{{ asset('assets/images/Flag_of_the_United_States.png') }}"></a></li>
                        <li><a href="javascript:void(0)" data-langauge12="ar" title="Arabic" class="arabic-lan"><img src="{{ asset('fronted/users_flow/assets/images/Arabic-Language-Flag.jpg') }}"></a>
                        </li>
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
                        <a href="{{ route('frontend.users.site.index') }}">
                            <img src="{{ asset('fronted/users_flow/assets/images/tejarh-logo.png') }}" alt="Logo">
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
                                    <select class="no-scroll" id="removedClasssTest">
                                        <option>@lang('frontend-messages.header.All Location')</option>
                                        @foreach ($countries as $con)
                                        <option value="{{ $con->id }}">{{ $con->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <form class="search_filter" id="search_bar_filter">
                            @csrf
                            <div class="form-group">
                                <div class="header-serach">
                                    <input type="text" name="search_data" class="form-control" placeholder='@lang("frontend-messages.header.placeholder")'>
                                    <button type="submit" class="btn">
                                        <img src="{{ asset('fronted/users_flow/assets/images/search-icon.png') }}" alt="Search Icon">
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
                                <a href="{{route('frontend.users.chat')}}">
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
                                    <a href="{{ route('frontend.users.order-details.checkout',$checkOutId) }}">
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
                                    <a href="{{ route('frontend.users.order-details.checkout_empty') }}">
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
                                @if (Auth::check() && Auth::user()->role == USER_ROLE)
                                <div class="login logout">
                                    <a href="javascript:void(0)" id="logout">
                                        @if (isset(Auth::user()->profile_picture))
                                        <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}" alt="Profile Pic">
                                        @else
                                        <img src="{{ asset('assets/images/user.png') }}" alt="Profile Pic">
                                        @endif
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </a>

                                    <div class="login-option">
                                        <ul>
                                            <li><a href="{{ route('frontend.users.profile.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/user.png') }}">@lang('frontend-messages.header.Profile')</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.my-orders.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">@lang('frontend-messages.header.Orders')</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.orders-sold.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">Order Management</a></li>

                                            <li><a href="{{ route('frontend.users.my-items.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/product.png') }}">My Product</a>
                                            </li>
                                            <li><a href="{{route('frontend.users.pages.import_images')}}"><img src="{{ asset('fronted/users_flow/assets/images/icon/product.png') }}">My Images</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.wallet.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/wallet.png') }}">@lang('frontend-messages.header.Wallet')</a>
                                            </li>
                                            <?php
                                            $checkOut = \App\Models\CheckOutUserDetails::where('user_id', \Auth::User()->id)->orderBy('id', 'DESC')->first();
                                            $checkOutId = \Auth::User()->id;
                                            if (!empty($checkOut)) {
                                                $checkOutId = $checkOut->id;
                                            ?>
                                                <li><a href="{{ route('frontend.users.order-details.checkout',$checkOutId) }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/basket.png') }}">@lang('frontend-messages.header.My Basket')</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li><a href="{{ route('frontend.users.order-details.checkout_empty') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/basket.png') }}">@lang('frontend-messages.header.My Basket')</a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <!-- <li><a href="javascript:void(0)"><img
                                            <div class="login-option">
                                            <ul>
                                                <li><a href="{{ route('frontend.users.profile.index') }}"><img
                                                            src="{{ asset('fronted/users_flow/assets/images/icon/user.png') }}">@lang('frontend-messages.header.Profile')</a>
                                                </li>
                                                <li><a href="{{ route('frontend.users.my-orders.index') }}"><img
                                                            src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">@lang('frontend-messages.header.Orders')</a>
                                                </li>
                                                <li><a href="{{ route('frontend.users.orders-sold.index') }}"><img
                                                            src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">Order Sold</a>
                                                </li>
                                                <li><a href="{{ route('frontend.users.my-items.index') }}"><img
                                                            src="{{ asset('fronted/users_flow/assets/images/icon/product.png') }}">@lang('frontend-messages.header.My Items')</a>
                                                </li>
                                            
                                            
                                                <li><a href="{{ route('frontend.users.wallet.index') }}"><img
                                                            src="{{ asset('fronted/users_flow/assets/images/icon/wallet.png') }}">@lang('frontend-messages.header.Wallet')</a>
                                                </li>

                                                <li><a href="javascript:void(0)"><img

                                                <li><a href="javascript:void(0)"><img

                                                            src="{{ asset('fronted/users_flow/assets/images/icon/Hold-an-offer.png') }}">@lang('frontend-messages.header.Offer')</a>
                                                </li>   -->
                                            <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/Hold-an-offer.png') }}">@lang('frontend-messages.header.MakeAnOffer')</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.wishlist.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/Wishlist.png') }}">@lang('frontend-messages.header.Wishlist')</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.likelist.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/thumb.png') }}">@lang('frontend-messages.header.Likelist')</a>
                                            </li>
                                            <li><a href="{{ route('frontend.users.user-support.index') }}"><img src="{{asset('assets/images/icon/Icon-support.png')}}">User Support</a>
                                            </li>
                                            {{-- <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/settings.png') }}">@lang('frontend-messages.header.Setting')</a>
                            </li> --}}
                            <li><a href="{{ route('frontend.users.site.logout') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/logout.png') }}">@lang('frontend-messages.header.LogOut')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                            <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419" />
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                            <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.users.order-details.checkout_empty') }}">

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="21.067" viewBox="0 0 25 21.067">
                            <g id="noun-cart-1058525" transform="translate(-97.098 -67.186)">
                                <path id="Path_17289" data-name="Path 17289" d="M97.887,67.186a.833.833,0,1,0,.087,1.663h2.685L104.1,81.54a.832.832,0,0,0,.806.615h13.583a.832.832,0,1,0,0-1.663H105.545l-.3-1.109h13.8a.832.832,0,0,0,.806-.606l2.218-8.039a.837.837,0,1,0-1.611-.45L118.4,77.72H104.791l-1.724-6.376h15.419a.832.832,0,1,0,0-1.663H102.617l-.511-1.88a.832.832,0,0,0-.806-.615H97.974a.808.808,0,0,0-.087,0Zm9.234,16.077a2.495,2.495,0,1,0,2.495,2.495A2.508,2.508,0,0,0,107.121,83.264Zm9.425,0a2.495,2.495,0,1,0,2.495,2.495A2.507,2.507,0,0,0,116.546,83.264Zm-9.425,1.663a.832.832,0,1,1-.832.831A.819.819,0,0,1,107.121,84.927Zm9.425,0a.832.832,0,1,1-.832.831A.819.819,0,0,1,116.546,84.927Z" fill="#111419" />
                            </g>
                        </svg>


                    </a>
                </li>
                <li>
                    <div class="login">
                        <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('frontend-messages.header.login')</a>
                    </div>
                </li>
                @endif
                </li>
                <li>
                    <a class="join" 
                    @if (Auth::check()) 
                    href="{{ route('frontend.users.post-items.index') }}" 
                    @else 
                    href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" 
                    @endif>
                        @lang('frontend-messages.header.Sell Now Button')
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
                    <a href="{{ route('frontend.users.site.index') }}">
                        <img src="{{ asset('fronted/users_flow/assets/images/tejarh-logo.png') }}" alt="Logo">
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
                                    <li data-value="All Location" class="option selected">All Location</li>
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
                            <input type="text" class="form-control" placeholder="@lang('frontend-messages.header.placeholder')">
                            <button type="submit" class="btn">
                                <img src="{{ asset('fronted/users_flow/assets/images/search-icon.png') }}" alt="Search Icon">
                            </button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>

    </div>
    <div class="mo-nav-menu">
        @if (Auth::check() && Auth::user()->role == USER_ROLE)
        <div class="login logout">
            <a href="javascript:void(0)" id="logout">
                @if (isset(Auth::user()->profile_picture))
                <img src="{{ asset('assets/users/' . Auth::user()->profile_picture) }}" alt="Profile Pic">
                @else
                <img src="{{ asset('assets/images/user.png') }}" alt="Profile Pic">
                @endif
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </a>
            <div class="login-option">
                <ul>
                    @if (Auth::check())
                    <li>
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.025" height="27.024" viewBox="0 0 27.025 27.024">
                                <g id="Group_13092" data-name="Group 13092" transform="translate(-1367 -3375.717)">
                                    <path id="chat" d="M7.121,19.619a.676.676,0,0,1,.531.069,8.779,8.779,0,1,0-3.072-3.072.675.675,0,0,1,.069.531l-.989,3.461ZM21.833,9.19a10.14,10.14,0,0,1,5.919,14.616L29,28.162a.676.676,0,0,1-.835.835l-4.356-1.245A10.14,10.14,0,0,1,9.19,21.833,10.07,10.07,0,0,1,7.217,21L2.861,22.241a.676.676,0,0,1-.835-.835L3.271,17.05A10.136,10.136,0,1,1,21.833,9.19Zm.339,1.55A10.141,10.141,0,0,1,10.741,22.172a8.789,8.789,0,0,0,12.631,4.272.676.676,0,0,1,.531-.069l3.461.989L26.375,23.9a.676.676,0,0,1,.069-.531A8.789,8.789,0,0,0,22.173,10.74Z" transform="translate(1365.001 3373.717)" fill="#111419" />
                                </g>
                            </svg>
                            Chat
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21.028" height="27.338" viewBox="0 0 21.028 27.338">
                                <path id="bell_1_" data-name="bell (1)" d="M19.888,27.3a4.558,4.558,0,0,1-8.594,0H8.874A3.8,3.8,0,0,1,5.4,21.961l1.074-2.416v-4.4a9.116,9.116,0,0,1,6.075-8.594V6.038a3.038,3.038,0,0,1,6.075,0v.519A9.116,9.116,0,0,1,24.7,15.15v4.4l1.074,2.416a3.8,3.8,0,0,1-3.47,5.339Zm-1.665,0H12.959a3.04,3.04,0,0,0,5.264,0ZM17.11,6.164V6.038a1.519,1.519,0,1,0-3.038,0v.126a9.217,9.217,0,0,1,3.038,0ZM15.591,7.556A7.594,7.594,0,0,0,8,15.15v4.556l-.065.308L6.793,22.578a2.278,2.278,0,0,0,2.082,3.2H22.308a2.278,2.278,0,0,0,2.082-3.2L23.25,20.015l-.065-.308V15.15A7.594,7.594,0,0,0,15.591,7.556Z" transform="translate(-5.078 -3)" fill="#111419" />
                            </svg>
                            Notification
                        </a>
                    </li>
                    @endif

                    <li><a href="{{ route('frontend.users.profile.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/user.png') }}">@lang('frontend-messages.header.Profile')</a>
                    </li>
                    <li><a href="{{ route('frontend.users.my-orders.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/My-Orders.png') }}">@lang('frontend-messages.header.Orders')</a>
                    </li>
                    <li><a href="{{ route('frontend.users.my-items.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/product.png') }}">@lang('frontend-messages.header.My Items')</a>
                    </li>
                    <li><a href="{{ route('frontend.users.wallet.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/wallet.png') }}">@lang('frontend-messages.header.Wallet')</a>
                    </li>
                    <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/Hold-an-offer.png') }}">@lang('frontend-messages.header.Offer')</a>
                    </li>
                    <li><a href="{{ route('frontend.users.wishlist.index') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/Wishlist.png') }}">@lang('frontend-messages.header.Wishlist')</a>
                    </li>
                    {{-- <li><a href="javascript:void(0)"><img src="{{ asset('fronted/users_flow/assets/images/icon/settings.png') }}">@lang('frontend-messages.header.Setting')</a>
                    </li> --}}
                    <li><a href="{{ route('frontend.users.site.logout') }}"><img src="{{ asset('fronted/users_flow/assets/images/icon/logout.png') }}">@lang('frontend-messages.header.LogOut')</a>
                    </li>

                </ul>
            </div>
        </div>
        @else
        <div class="login">
            <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('frontend-messages.header.login')</a>
        </div>
        @endif

        <a class="join" @if (Auth::check()) href="{{ route('frontend.users.post-items.index') }}" @else href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
            @lang('frontend-messages.header.Sell Now Button')
        </a>
    </div>
</div>
<!-- End Navbar -->