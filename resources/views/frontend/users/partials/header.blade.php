 <!-- Header -->
 <div class="header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="left">               
                        <h6>@lang('frontend-messages.header.Download App')</h6>                      
                        <a href="#"><img src="{{asset('assets/images/mac-icon.png')}}" alt="mac-icon"></a>
                        <a href="#"><img src="{{asset('assets/images/play-strore.png')}}" alt="play strore icon"></a>
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
                        <li><a href="javascript:void(0)" data-langauge12 ="en" class="us-lan"><img src="{{asset('assets/images/Flag_of_the_United_States.png')}}"></a></li>
                        <li><a href="javascript:void(0)" data-langauge12 ="ar" class="arabic-lan"><img src="{{asset('assets/images/Arabic-Language-Flag.png')}}"></a></li>
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
                        <a href="{{route('front.home')}}">
                            <img src="{{asset('assets/images/tejarh-logo.png')}}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="middle header-form">
                        <form>
                            <div class="form-group">
                                <div class="location">
                                    <select>
                                        <option>@lang('frontend-messages.header.All Location')</option>
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
                                    <input type="text" class="form-control" placeholder='@lang("frontend-messages.header.Placeholder")'>
                                    <button type="submit" class="btn">
                                        <img src="{{asset('assets/images/search-icon.png')}}" alt="Search Icon">
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
                                <a href="#">
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
                            @if(Auth::check() && Auth::user()->role == USER_ROLE)
                                <div class="login logout">                                            
                                    <a href="javascript:void(0)" id="logout">
                                        @if(isset(Auth::user()->profile_picture))
                                        <img src="{{asset('assets/users/'.Auth::user()->profile_picture)}}" alt="Profile Pic">
                                        @else
                                        <img src="{{asset('assets/images/user.png')}}" alt="Profile Pic">
                                        @endif
                                        {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
 
                                    <div class="login-option">
                                        <ul>
                                            <li><a href="{{ route('user.profile')}}"><img src="{{asset('assets/images/icon/user.png')}}">@lang('frontend-messages.header.Profile')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/My-Orders.png')}}">@lang('frontend-messages.header.Orders')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/product.png')}}">@lang('frontend-messages.header.My Items')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/wallet.png')}}">@lang('frontend-messages.header.Wallet')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/Hold-an-offer.png')}}">@lang('frontend-messages.header.Offer')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/Wishlist.png')}}">@lang('frontend-messages.header.Wishlist')</a></li>
                                            <li><a href="#"><img src="{{asset('assets/images/icon/settings.png')}}">@lang('frontend-messages.header.Setting')</a></li>
                                            <li><a href="{{ route('user.logout')}}"><img src="{{asset('assets/images/icon/logout.png')}}">@lang('frontend-messages.header.LogOut')</a></li>
                                        </ul>
                                    </div>
                                </div>                              
                            @else                                
                                <div class="login">
                                    <a href="javascript:void(0)" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('frontend-messages.header.login')</a>                                    
                                </div>
                            @endif
                            </li>
                            <li>                            
                                <a class="join" @if(Auth::check()) href="{{route('user.postitem')}}" @else href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
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
                    <a href="index.html" class="logo">
                        <img src="{{asset('assets/images/tejarh-logo.png')}}" alt="Logo">
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
                            <input type="text" class="form-control" placeholder="@lang('frontend-messages.header.placeholder')">
                            <button type="submit" class="btn">
                                <img src="{{asset('assets/images/search-icon.png')}}" alt="Search Icon">
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
                    <img src="{{asset('assets/images/strory-img1.png')}}">
                    <h5>Welcome to Tejarh!</h5>
                    <p>Take charge of your buying and selling journey.</p>
                </div>
            </li>
            <li>
                <a href="#">
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
            </li>
            <li><a href="#"><img src="{{asset('assets/images/icon/user.png')}}">Profile</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/My-Orders.png')}}">My Orders</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/product.png')}}">My Items</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/wallet.png')}}">Wallet</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/Hold-an-offer.png')}}">Hold an offer</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/Wishlist.png')}}">Wishlist</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/settings.png')}}">Settings</a></li>
            <li><a href="#"><img src="{{asset('assets/images/icon/logout.png')}}">Logout</a></li>
        </ul>
    </div>
</div>
<!-- End Navbar -->