        <!-- Footer -->
        <footer class="footer-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="footer-menu-wrapper" style="display:none">
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.site_links')</h5>
                                <ul>
                                    @foreach($sitelinksMenu as $menu)
                                        <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                    @endforeach 
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.popular_cities')</h5>
                                <ul>
                                    @foreach($popularcitiesMenu as $menu)
                                        <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                    @endforeach   
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.useful_links')</h5>
                                <ul>
                                    @if(!empty($usefullinksMenu) && count($usefullinksMenu) > 0)
                                        @foreach($usefullinksMenu as $key => $menu)
                                            @if($key < 6)
                                                <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                            @endif
                                        @endforeach
                                    @endif    
                                </ul>
                                <ul>
                                    @if(!empty($usefullinksMenu) && count($usefullinksMenu) > 0)
                                        @foreach($usefullinksMenu as $key => $menu)
                                            @if($key > 7)
                                                <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                            @endif
                                        @endforeach
                                    @endif  
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu-wrapper">
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.site_links')</h5>
                                <ul>
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.about-us.aboutUs') }}">@lang('business_messages.footer.site_links.about_us')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.about-us.aboutUs') }}">@lang('business_messages.footer.site_links.about_us')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.location.location') }}">@lang('business_messages.footer.site_links.locations')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.location.location') }}">@lang('business_messages.footer.site_links.locations')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.coupons-Offers.couponsOffers') }}">@lang('business_messages.footer.site_links.coupons_offers')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.coupons-Offers.couponsOffers') }}">@lang('business_messages.footer.site_links.coupons_offers')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.Contact-Us.contactUs') }}">@lang('business_messages.footer.site_links.contact_us')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.Contact-Us.contactUs') }}">@lang('business_messages.footer.site_links.contact_us')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.Careers.careers') }}">@lang('business_messages.footer.site_links.careers')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.Careers.careers') }}">@lang('business_messages.footer.site_links.careers')</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.popular_cities')</h5>
                                <ul>
                                    <li><a href="#">@lang('business_messages.footer.popular_cities.riyadh')</a></li>
                                    <li><a href="#">@lang('business_messages.footer.popular_cities.jeddah')</a></li>
                                    <li><a href="#">@lang('business_messages.footer.popular_cities.medina')</a></li>
                                    <li><a href="#">@lang('business_messages.footer.popular_cities.mecca')</a></li>
                                    <li><a href="#">@lang('business_messages.footer.popular_cities.tabuk')</a></li>
                                </ul>
                            </div>
                            <div class="footer-menu">
                                <h5>@lang('business_messages.footer_menu.useful_links')</h5>
                                <ul>
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.Contact-Us.contactUs') }}">@lang('business_messages.footer.useful_links.contact_us')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.Contact-Us.contactUs') }}">@lang('business_messages.footer.useful_links.contact_us')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.faq.faq') }}">@lang('business_messages.footer.useful_links.faq')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.faq.faq') }}">@lang('business_messages.footer.useful_links.faq')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.terms-condition.termsCondition') }}">@lang('business_messages.footer.useful_links.tc')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.terms-condition.termsCondition') }}">@lang('business_messages.footer.useful_links.tc')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.term-of-use.termsOfUse') }}">@lang('business_messages.footer.useful_links.term_of_use')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.term-of-use.termsOfUse') }}">@lang('business_messages.footer.useful_links.term_of_use')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.track-order.trackOrder') }}">@lang('business_messages.footer.useful_links.track_orders')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.track-order.trackOrder') }}">@lang('business_messages.footer.useful_links.track_orders')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.shipping.shipping') }}">@lang('business_messages.footer.useful_links.shipping')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.shipping.shipping') }}">@lang('business_messages.footer.useful_links.shipping')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.cancellation.cancellation') }}">@lang('business_messages.footer.useful_links.cancellation')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.cancellation.cancellation') }}">@lang('business_messages.footer.useful_links.cancellation')</a></li>
                                    @endif
                                </ul>
                                <ul>
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.return.returnOrder') }}">@lang('business_messages.footer.useful_links.returns')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.return.returnOrder') }}">@lang('business_messages.footer.useful_links.returns')</a></li>
                                    @endif
                                    <!-- <li><a href="{{ route('frontend.business.whitehat.whitehat') }}">@lang('business_messages.footer.useful_links.whitehat')</a></li> -->
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.blog.blog') }}">@lang('business_messages.footer.useful_links.blog')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.blog.blog') }}">@lang('business_messages.footer.useful_links.blog')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.Careers.careers') }}">@lang('business_messages.footer.useful_links.careers')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.Careers.careers') }}">@lang('business_messages.footer.useful_links.careers')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.privacy-policy.privacyPolicy') }}">@lang('business_messages.footer.useful_links.privacy_policy')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.privacy-policy.privacyPolicy') }}">@lang('business_messages.footer.useful_links.privacy_policy')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.site-map.siteMap') }}">@lang('business_messages.footer.useful_links.site_map')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.site-map.siteMap') }}">@lang('business_messages.footer.useful_links.site_map')</a></li>
                                    @endif
                                    @if(Auth::user()->role == STORE_ROLE)
                                    <li><a href="{{ route('frontend.store.support.supportPage') }}">@lang('business_messages.footer.useful_links.supports')</a></li>
                                    @else
                                    <li><a href="{{ route('frontend.business.support.index') }}">@lang('business_messages.footer.useful_links.supports')</a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/tejarh-white-logo.png')}}" alt="Tejarh Logo">
                            </a>
                            <p>@lang('business_messages.footer_menu.logo_text')</p>
                            <div class="social-media">
                                <h5>@lang('business_messages.footer_menu.follow_us')</h5>
                                <ul>
                                    <li><a target="_blank" href="https://www.facebook.com/"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/facebook.png')}}"></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/instagram.png')}}"></a></li>
                                    <!-- <li><a href="#"><img src="{{asset(BUSINESS_ASSETS_FOLDER.'/images/img/pinterest.png')}}"></a></li> -->
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
                    <p>@lang('business_messages.footer_menu.copyright') © <?php
                    use App\Models\StoryPrice; echo date("Y"); ?> <a href="#" target="_blank"> @lang('business_messages.footer_menu.tejarh_market_place')</a> @lang('business_messages.footer_menu.all_rights_reserved')</p>
                </div>
            </div>
        </div>
        <!-- End Copyright -->
        

        <div class="mobile-sell-now-btn">
            <a href="{{route('frontend.business.item-post.index')}}">@lang('business_messages.menu.sell_now')</a>
        </div>
        
        <!-- loginModal -->
        <div class="modal fade" id="loginModal" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-logo">
                            <a href="#">
                                <img src="{{ asset('fronted/business_flow/assets/images/img/tejarh-word-logo.png')}}" alt="tejarh-white-logo">
                            </a>
                        </div>
                        <h5>Welcome back!</h5>
                        <p>Please sign in to your account.</p>
                        <form>
                            <div class="input-group">
                                <input type="text" placeholder="Username/Email" class="form-control">
                            </div>
                            <div class="input-group password">
                                <input type="password" autocomplete="on" placeholder="Password" class="form-control" id="log_in_password"><i toggle="#log_in_password" class="fas fa-eye-slash"></i>
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
                            <img src="{{ asset('fronted/business_flow/assets/images/img/tejarh-word-logo.png')}}" alt="tejarh-white-logo">
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
                            <img src="{{ asset('fronted/business_flow/assets/images/img/tejarh-word-logo.png')}}" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Reset Password</h5>
                    <p>Your new password must be different from previous used passwords.</p>
                    <form>
                        <div class="input-group password">
                            <input type="password" autocomplete="on" placeholder="Enter New Password" class="form-control" id="reset_password">
                            <i toggle="#reset_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group password">
                            <input type="password" autocomplete="on" placeholder="Confirm New Password" class="form-control" id="confirm_reset_password">
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
                            <img src="{{ asset('fronted/business_flow/assets/images/img/tejarh-word-logo.png')}}" alt="tejarh-white-logo">
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
                            <img src="{{ asset('fronted/business_flow/assets/images/img/tejarh-word-logo.png')}}" alt="tejarh-white-logo">
                        </a>
                    </div>
                    <h5>Create Account,</h5>
                    <p>Please Sign up to get started!</p>
                    <form>
                        <div class="create_acc_wrapper">
                            <div class="form-check">
                                <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="user_acc">
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
                                <img id="blah" src="{{ asset('fronted/business_flow/assets/images/img/file-upload-icon.png')}}"> 
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
                            <input type="password" autocomplete="on" placeholder="Password" class="form-control" id="sign_up_password">
                            <i toggle="#sign_up_password" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group password">
                            <input type="password" autocomplete="on" placeholder="Confirm Password" class="form-control" id="confirm_sign_up_password2">
                            <i toggle="#confirm_sign_up_password2" class="fas fa-eye-slash"></i>
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
        <?php
        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
        $story_price = '';
        if(!empty($story_price_data[0])){
            $story_price = $story_price_data[0];
        }
        ?>
        <div class="modal fade" id="Uploading-Story" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5>Uploading Story</h5>
                    <div id="ajax-alert-error" class="alert" style="display: none;">
                    </div>
                    <div id="ajax-alert" class="alert" style="display: none;">
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <!-- <form> -->
                    <form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="b_add_story" name="b_add_story">
                    @csrf
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type="file" name="story_image_name" onchange="readURL031(this);" id="story_image_name">
                                <img id="blah031" src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Uploading-Story.png') }}"> 
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" name="product_name" placeholder="Product Name" class="form-control">
                        </div>
                        
                        <div class="input-group">
                            <select class="form-select" name="category_id">
                                <option selected>Choose Category</option>
                                @foreach($category as $key => $cate)
                                    <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="textarea" name="story_description" placeholder="Description" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="story_price" value="{{$story_price}}" readonly>
                        </div>
                        <div class="input-group location-icon">
                            <input type="text" name="store_location" placeholder="Store Location" class="form-control">
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="Add Story">
                        </div>                    
                    </form>
                    <!-- <a href="javascript:void(0)" data-bs-dismiss="modal">Cancel</a> -->
                </div>
            </div>
        </div>

        <!-- Uploading-Story Profile-->
        <div class="modal fade" id="bProfileUploadingStory" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5>@lang('business_messages.profile.story.uploading_story')</h5>
                    <div id="ajax-alert-error" class="alert" style="display: none;">
                    </div>
                    <div id="ajax-alert" class="alert" style="display: none;">
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <!-- <form> -->
                    <form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="business_add_story" name="business_add_story">
                        @csrf
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type="file" name="story_image_name" onchange="readURL03(this);" id="story_image_name1">
                                <img id="blah03" src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/Uploading-Story.png') }}"> 
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" name="product_name" placeholder="@lang('business_messages.profile.story.product_name')" class="form-control">
                        </div>

                        <div class="input-group">
                            <select class="form-select" name="category_id">
                                <option value="">@lang('business_messages.profile.story.choose_category')</option>
                                @foreach($category as $key => $cate)
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                            <label id="category_id-error" class="error" for="category_id"></label>
                        </div>
                        <div class="input-group">
                            <input type="textarea" name="story_description" placeholder="@lang('business_messages.profile.story.description')" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="story_price" value="{{$story_price}}" readonly>
                        </div>
                        <div class="input-group location-icon">
                            <input type="text" name="store_location" placeholder="@lang('business_messages.profile.story.store_location')" class="form-control">
                        </div>
                        <div class="form-group submit">
                            <input type="submit" class="btn btn-primary" value="@lang('business_messages.profile.story.add_story')">
                        </div>
                    </form>
                    <!-- <a href="javascript:void(0)" data-bs-dismiss="modal">@lang('business_messages.profile.story.cancel')</a> -->
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="business-sign-up" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL(this);" />
                                <!-- <img id="blah" src="http://placehold.it/180" alt="your image" /> -->
                                <img id="blah" src="{{ asset('fronted/business_flow/assets/images/img/file-upload-icon.png')}}"> 
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
                            <input type="password" autocomplete="on" placeholder="Password" class="form-control" id="sign_up_password1">
                            <i toggle="#sign_up_password1" class="fas fa-eye-slash"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" autocomplete="on" placeholder="Confirm Password" class="form-control" id="confirm_sign_up_password">
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
                    <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>                  
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

      
        
        <!-- Go Top -->
        <div class="go-top">
            <i class='bx bxs-up-arrow-circle'></i>
            <i class='bx bxs-up-arrow-circle'></i>
        </div>
        <!-- End Go Top -->
       
        <!-- Essential JS --> 
    
       
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
        <script type="module" src="{{ asset('fronted/business_flow/assets/js/constants.js') }}"></script>
        <script src="{{ asset('fronted/business_flow/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('fronted/business_flow/assets/js/bootstrap.min.js') }}"></script>
        <!-- Form Validator JS -->
        
        <script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
        <script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
        <!-- Contact JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/contact-form-script.js') }}"></script>
        <!-- Ajax Chip JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.ajaxchimp.min.js') }}"></script>
        <!-- Nice Select JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.nice-select.min.js') }}"></script>
        <!-- Mean Menu JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.meanmenu.js') }}"></script>
        <!-- Revolution JS -->
		<script src="{{ asset('fronted/business_flow/assets/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset('fronted/business_flow/assets/js/jquery.themepunch.revolution.min.js') }}"></script>
        <!-- Mixitup JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.mixitup.min.js') }}"></script>
        <!-- Owl Carousel JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/owl.carousel.min.js') }}"></script>
        <!-- Modal Video JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/jquery-modal-video.min.js') }}"></script>
        <script src="https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js"></script>

        <!-- magnific-popup -->
        
        <script type="text/javascript" src="{{ asset('fronted/business_flow/assets/js/jquery.cookie.min.js') }}"></script>
        <script src="{{ asset('fronted/business_flow/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('fronted/business_flow/assets/js/toastr/toastr.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <!-- Custom JS -->
        <script src="{{ asset('fronted/business_flow/assets/js/custom.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/cart_css.css') }}">

<script>
    $(document).ready(function(){
			//after load will check the checkbox is checked or not
			var check = $("#samplecsv").prop("checked");
			if(check){
				$("#scsv").addClass("activeTab");
			}
			
			//click on yes
			$("#samplecsv").on("click", function(){
				check = $(this).prop("checked");
				$("#bcsv").removeClass("activeTab");
				$("#scsv").addClass("activeTab");
				
			})
			//click on No
			$("#bulkproductcsv").on("click", function(){
				check = $(this).prop("checked");
				$("#scsv").removeClass("activeTab");
				$("#bcsv").addClass("activeTab");
				console.log(check);
			})
            
		});
</script>

<script>
    

$(document).ready(function() {    
  
  $("#price").keyup(function(){
      var price = $("#price").val(); 
      var commision_data = $("#commision_data").val(); 
      var comissionPrice = ((price/100) * commision_data);
      var totalPrice = price - comissionPrice;
      $("#total_price").val(totalPrice);         
      $("#total_price_td").text(totalPrice);         
  });
 
});
</script>

@php $route_name = \Request::route()->getName(); @endphp 
@if(in_array($route_name, [
    'frontend.business.home.story_payment',
    'frontend.business.business-profile.story_payment',
    'frontend.business.boost-items.boost_items_payment'
    ]))
    <script>
    
        $("#usersPaymentCardForm").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {

                "holder_name": {
                    required: true,
                },

                "card_number": {
                    required: true,
                },
                "expiry_month": {
                    required: true,
                },
                "expiry_year": {
                    required: true,
                },
                "cvv": {
                    required: true,
                },
            },
            messages: {

                "holder_name": {
                    required: '{{ __('business_messages.bpay_now.enter_your_card_holder_name') }}',
                },

                "card_number": {
                    required: '{{ __('business_messages.bpay_now.enter_card_number') }}',
                },
                "expiry_month": {
                    required: '{{ __('business_messages.bpay_now.expiry_month') }}',
                },

                "expiry_year": {
                    required: '{{ __('business_messages.bpay_now.expiry_year') }}',
                },
                "cvv": {
                    required: '{{ __('business_messages.bpay_now.ccv') }}',
                },
            },
            submitHandler: function(form) {
                var $this = $('.loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('.loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
            }
        });
</script>
@endif
@if(in_array($route_name, [
    'frontend.business.business-profile.index',
    ]))
    <script type="text/javascript">

        $(document).on('click','.post_delete_business',function(){
            $('#profile_post_delete').modal('show');
            $('.post_id').val($(this).attr('data-id'));
        })
        $(document).ready(function() {
            $('.post_delete_business_func').click(function() {
                var post_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.business.business-profile.post_removed') }}",
                    data: {
                        post_id:post_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (result) {
                        toastr.success(result.success);
                        setTimeout(function(){ location.reload(); }, 1000);
                    },
                    error: function(err){
                        toastr.error(result.error);
                    }
                });
            });
            toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>
@endif

@if(in_array($route_name, [
    'frontend.business.add-store.index',
    ]))
    <script type="text/javascript">

        $(document).on('click','.post_delete_business',function(){
            $('#store_post_delete').modal('show');
            $('.store_id').val($(this).attr('data-id'));
        })
        $(document).ready(function() {
            $('.store_delete_business_func').click(function() {
                var store_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.business.business.add-store.store_removed') }}",
                    data: {
                        store_id:store_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (result) {
                        toastr.success(result.success);
                        setTimeout(function(){ location.reload(); }, 1000);
                    },
                    error: function(err){
                        toastr.error(result.error);
                    }
                });
            });
            toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>
@endif

@if(in_array($route_name, [
    'frontend.business.home.index',
    ]))
    <!-- home page slider -->
    <script type="text/javascript">
        $(document).ready(function() {
            var sync1 = $(".slider");
            var sync2 = $(".navigation-thumbs");
            var thumbnailItemClass = '.owl-item';
            var slides = sync1.owlCarousel({
                video: true,
                startPosition: 12,
                responsive: {
                    0: {
                        items: 1,
                        margin: 10,
                    },
                    767: {
                        items: 3,
                        margin: 15,
                    },
                    1200: {
                        items: 5,
                        margin: 20,
                    }
                },
                loop: false,
                touchDrag: false,
                mouseDrag: false,
                nav: true,
                dots: false,
                video: true,
                lazyLoad: true,
                center: true
            }).on('changed.owl.carousel', syncPosition);

            function syncPosition(el) {
                $owl_slider = $(this).data('owl.carousel');
                var loop = $owl_slider.options.loop;

                if (loop) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }
                } else {
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
                    sync2.trigger('to.owl.carousel', [current, duration, true]);

                }
            }
            var thumbs = sync2.owlCarousel({
                    startPosition: 1,
                    items: 12,
                    responsive: {
                        1200: {
                            items: 12,
                            margin: 20,
                        },
                        767: {
                            items: 7,
                            margin: 15,
                        },
                        0: {
                            items: 3,
                            margin: 10,
                            autoWidth: true
                        }
                    },
                    loop: false,
                    margin: 0,
                    autoplay: false,
                    nav: false,
                    dots: false,
                    onInitialized: function(e) {
                        var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                        thumbnailCurrentItem.addClass('synced');
                        thumbnailCurrentItem.addClass('see-this-story');

                    },
                })
                .on('click', thumbnailItemClass, function(e) {
                    e.preventDefault();
                    var duration = 300;
                    var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                    sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
                }).on("changed.owl.carousel", function(el) {
                    var number = el.item.index;
                    $owl_slider = sync1.data('owl.carousel');
                    $owl_slider.to(number, 100, true);
                });

            $('.story-slider-wrapper').hide();
            $('#sync2 .owl-item').click(function() {
                $('.story-slider-wrapper').show();
                $('body').css('overflow', 'hidden');
            })

            $('.close-story-btn').click(function() {
                $('.story-slider-wrapper').hide();
                $('body').css('overflow', 'unset');
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
                items: 1,
                smartSpeed: 1000,
                loop: false
            });

            $('#sync2 .owl-item').click(function() {
                setTimeout(function() {
                    if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {
                        $('.owl-item.active .item video').get(0).play();
                        $(this).get(0).currentTime = 0;
                    } else {
                        $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).pause();
                        $(this).get(0).currentTime = 0;
                    }
                }, 1000);
            })

            $('.close-story-btn').click(function() {
                $('.item video').get(0).pause();
            })

            sync1.on('translate.owl.carousel', function(e) {
                setTimeout(function() {
                    $('.multi-story-slider .owl-item .item video').each(function() {
                        $(this).get(0).pause();
                        $(this).get(0).currentTime = 0;
                    });
                }, 1000);
                setTimeout(function() {
                    if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find('video').length !== 0) {
                        $('.owl-item.active.center .multi-story-slider .owl-item.active .item video').get(0).play();
                        $(this).get(0).currentTime = 0;
                    }
                }, 1000);
            });
            $('.owl-item.active.see-this-story').removeClass('see-this-story');
        });
    </script>
    <script type="text/javascript">
        $('.bxs-heart').click(function() {
            if ($(this).attr('att') == 0) {
                $(this).css('color', 'red');
                $(this).attr('att', 1);
            } else {
                $(this).css('color', 'grey');
                $(this).attr('att', 0);
            }
            var link_data = $(this).data('id');
            let wishlist_status = $(this).attr('att');
            $.ajax({
                type: "POST",
                url: '{{ route('frontend.business.wishlist.add_to_wishlist') }}',
                data: {
                    item_id: link_data,
                    wishlist_status: wishlist_status,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (result) {
                    toastr.success(result.success);
                },
                error: function(err){
                    toastr.error(result.error);
                }
            });
        });
        
    </script>
@endif
@if(in_array($route_name, [
    'frontend.business.home.index',
    'frontend.business.home.story_payment',
    'frontend.business.home.payment_successfull'
    ]))
    <script type="text/javascript">
        if ($("#b_add_story").length > 0) {
            $("#b_add_story").validate({
                ignore: [],
                rules: {
                    "story_image_name": {
                        required: true,
                    },
                    "product_name": {
                        required: true,
                    },
                    "category_id": {
                        required: true,
                    },
                    "story_description": {
                        required: true,
                    },
                    "store_location": {
                        required: true,
                    },
                    select: {
                        required: true,
                    }
                },
                messages: {
                    select: {
                        required: "Value required"
                    },
                    "story_image_name": {
                        required: "@lang('frontend-messages.UserStory.validation.video_or_image')",
                    },
                    "product_name": {
                        required: "@lang('frontend-messages.UserStory.validation.productname')",
                    },
                    "story_description": {
                        required: "@lang('frontend-messages.UserStory.validation.description')",
                    },
                    "store_location": {
                        required: "@lang('frontend-messages.UserStory.validation.storelocation')",
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.is('select:hidden')) {
                        error.insertAfter(element.next('.nice-select'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                var $this = $('#b_add_story .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#b_add_story .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("b_add_story"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.business.business-profile.addStory') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code == 200) {
                            $('#ajax-alert').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 3000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.UserStory.button")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                let id =  data.response.id
                                window.location.href = "{{ url('/business/home/story_payment') }}/" + id;
                            });
                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('@lang('frontend-messages.UserStory.error.msg')');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = '@lang('frontend-messages.UserStory.button')';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });
                }
            });
			toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        }
    </script>
@endif
@if(in_array($route_name, [
    'frontend.business.business-profile.index',
    'frontend.business.business-profile.story_payment',
    'frontend.business.business-profile.payment_successfull'
    ]))
    <script type="text/javascript">
        if ($("#business_add_story").length > 0) {
            $("#business_add_story").validate({
                ignore: [],
                rules: {
                    "story_image_name1": {
                        required: true,
                    },
                    "product_name": {
                        required: true,
                    },
                    "category_id": {
                        required: true,
                    },
                    "story_description": {
                        required: true,
                    },
                    "store_location": {
                        required: true,
                    },
                    select: {
                        required: true,
                    }
                },
                messages: {
                    select: {
                        required: "Value required"
                    },
                    "story_image_name1": {
                        required: "@lang('frontend-messages.UserStory.validation.video_or_image')",
                    },
                    "product_name": {
                        required: "@lang('frontend-messages.UserStory.validation.productname')",
                    },
                    "story_description": {
                        required: "@lang('frontend-messages.UserStory.validation.description')",
                    },
                    "store_location": {
                        required: "@lang('frontend-messages.UserStory.validation.storelocation')",
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.is('select:hidden')) {
                        error.insertAfter(element.next('.nice-select'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                var $this = $('#business_add_story .loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('#business_add_story .loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("business_add_story"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.business.business-profile.addBusinessStory') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code == 200) {
                            $('#ajax-alert').addClass('alert-success').show(function() {
                                $(this).html(data.success);
                                setTimeout(function() {
                                    $('body').removeClass('modal-open');
                                    $('.modal').removeClass('show');
                                    $('body').css('overflow', 'visible');
                                    $('.modal-backdrop').removeClass('show');
                                }, 3000)
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("frontend-messages.UserStory.button")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                                let id =  data.response.id
                                window.location.href = "{{ url('/business/story_payment') }}/" + id;
                            });
                        }
                    },
                    error: function(data) {
                        $('#ajax-alert-error').addClass('alert-danger').show(function() {
                            $(this).html('@lang('frontend-messages.UserStory.error.msg')');
                            $('.loader_class').prop("disabled", false);
                            var loadingText = '@lang('frontend-messages.UserStory.button')';
                            $('.loader_class').prop("disabled", false);
                            $this.html(loadingText);
                        });
                    }
                });
                }
            });
			toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        }
    </script>
@endif
@if(in_array($route_name, [
    'frontend.business.item-post.index',
    'frontend.business.item-post.edit',
    ]))
 

 <script type="text/javascript">    
    $(document).ready(function() {
        // $('select[name="brand_id"]').append('<option value="">{{__("business_messages.post_an_item.select_brand")}}</option>');
        // $('select[name="brand_id"]').niceSelect('update');
        // $('select[name="subcat_id"]').on('change', function() {
        //     var subCatID = $(this).val();
        //     if (subCatID) {
        //         $.ajax({
        //             url: "{{url('/brand')}}/" + subCatID,
        //             type: "POST",
        //             dataType: "json",
        //             success: function(data) {
        //                 $('select[name="brand_id"]').empty();
        //                 $('select[name="brand_id"]').append('<option value="">{{__("business_messages.post_an_item.select_brand")}}</option>');
        //                 $.each(data, function(key, value) {
        //                     $('select[name="brand_id"]').append('<option value="' + key + '">' + value + '</option>');
        //                 });
        //                 $('select[name="brand_id"]').niceSelect('update');
        //             }
        //         });
        //     } else {
        //         $('select[name="brand_id"]').empty();
        //     }
        // });
        $("#b_item_an_post").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "item_picture1": {
                    required: true,
                },
                "sku":{
                    required: true,
                },
                "item_description": {
                    required: true,
                },
                "describe_your_items": {
                    required: true,
                },
                "category_id": {
                    required: true,
                },
                "sub_category_id": {
                    required: true,
                },
                "brand_id": {
                    required: true,
                },
                "condition_id": {
                    required: true,
                },
                "enter_weight": {
                    required: true,
                },
                "width": {
                    required: true,
                },
                "length": {
                    required: true,
                },
                "height": {
                    required: true,
                },
                "qty_id": {
                    required: true,
                },
                "ship_from": {
                    required: true,
                },
                // "store_id": {
                //     required: true,
                // },
                // "ship_mode_id": {
                //     required: true,
                // },
                "delivery_type": {
                    required: true,
                },
                "pay_for_shipping": {
                    required: true,
                },
                "price_type": {
                    required: true,
                },
                "pricing": {
                    required: true,
                },
            },
            messages: {

                "item_picture1": {
                    required: '{{__("business_messages.post_an_item.validation.item_picture1")}}',
                },
                "sku": {
                    required: '{{ __("business_messages.post_an_item.validation.sku") }}',
                },
                "item_description": {
                    required: '{{__("business_messages.post_an_item.validation.item_description")}}',
                },
                "describe_your_items": {
                    required: '{{__("business_messages.post_an_item.validation.describe_your_items")}}',
                },
                "category_id": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_category")}}',
                },
                "sub_category_id": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_sub_category")}}',
                },
                "brand_id": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_brand")}}',
                },
                "condition_id": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_condition")}}',
                },
                "enter_weight": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_weight")}}',
                },
                "width": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_width")}}',
                },
                "length": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_length")}}',
                },
                "height": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_height")}}',
                },
                "qty_id": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_qty")}}',
                },
                "ship_from": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_input_zip_code")}}',
                },
                // "store_id": {
                //     required: '{{__("business_messages.post_an_item.validation.please_select_store")}}',
                // },
                // "ship_mode_id": {
                //     required: '{{__("business_messages.post_an_item.validation.please_select_ship_mode")}}',
                // },
                "delivery_type": {
                    required: '{{__("business_messages.post_an_item.validation.please_select_delivery_type")}}',
                },
                "pay_for_shipping": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_pay_for_shipping")}}',
                },
                "price_type": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_price_type")}}',
                },
                "pricing": {
                    required: '{{__("business_messages.post_an_item.validation.please_enter_pricing")}}',
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
    });
</script>
<script type="text/javascript">    
    $(document).ready(function() {
        $('select[name="subcat_id"]').append('<option value="">{{__("business_messages.post_an_item.select_subcategory")}}</option>'); 
        $('select[name="subcat_id"]').niceSelect('update'); 
        $('select[name="category_id"]').on('change', function() {
            var categoryID = $(this).val();
            var token = "{{csrf_token()}}";
            if(categoryID) {
                $.ajax({
                    // url: "{{url('/subcat')}}/"+categoryID,
                    url: '{{ route("frontend.business.item-post.getSubCat") }}',
                    type: "POST",
                    data: {'categoryId': categoryID, _token:token},
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="subcat_id"]').empty();
                        $('select[name="subcat_id"]').append('<option value="">{{__("business_messages.post_an_item.select_subcategory")}}</option>');        
                        $.each(data, function(key, value) {
                            $('select[name="subcat_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="subcat_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="subcat_id"]').empty();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="subcat_id"]').append('<option value="">{{__("business_messages.post_an_item.select_subcategory")}}</option>'); 
        $('select[name="subcat_id"]').niceSelect('update'); 
        $('select[name="category_id"]').on('change', function() {
            var categoryID = $(this).val();
            var token = "{{csrf_token()}}";
            if(categoryID) {
                $.ajax({
                    // url: "{{url('/subcat')}}/"+categoryID,
                    url: '{{ route("frontend.store.item-post.getSubCat") }}',
                    type: "POST",
                    data: {'categoryId': categoryID, _token:token},
                    dataType: "json",
                    success:function(data) {                       
                        $('select[name="subcat_id"]').empty();
                        $('select[name="subcat_id"]').append('<option value="">{{__("business_messages.post_an_item.select_subcategory")}}</option>');        
                        $.each(data, function(key, value) {
                            $('select[name="subcat_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="subcat_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="subcat_id"]').empty();
            }
        });
    });
</script>
<script type="text/javascript">    
    $(document).ready(function() {
        $('select[name="brand_id"]').append('<option value="">{{__("business_messages.post_an_item.select_brand")}}</option>'); 
        $('select[name="brand_id"]').niceSelect('update'); 
        $('select[name="subcat_id"]').on('change', function() {
            var subCatID = $(this).val();
            var token = "{{csrf_token()}}";
            if(subCatID) {
                $.ajax({
                    // url: "{{url('/brand')}}/"+subCatID,
                    url: '{{ route("frontend.business.item-post.getBrand") }}',
                    type: "POST",
                    dataType: "json",
                    data: {'subCategoryId': subCatID, _token:token},
                    success:function(data) {                       
                        $('select[name="brand_id"]').empty();
                        $('select[name="brand_id"]').append('<option value="">{{__("business_messages.post_an_item.select_brand")}}</option>');        
                        $.each(data, function(key, value) {
                            $('select[name="brand_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="brand_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="brand_id"]').empty();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="attribute_id"]').append('<option value="">{{__("select Attribute")}}</option>');
        $('select[name="attribute_id"]').niceSelect('update');
        $('select[name="subcat_id"]').on('change', function() {
                    var subCatID = $(this).val();
                    var token = "{{csrf_token()}}";
                    if(subCatID) {
                        $.ajax({ 
                            url: '{{route("forntend.business.item-post.getAttribute")}}',
                            type: "POST",
                            dataType: "json",
                            data: {'subCategoryId': subCatID, _token:token},
                            success:function(data) {  
                                               
                                $('select[name="attribute_id"]').empty();
                                $('select[name="attribute_id"]').append('<option value="">{{__("Select Attribute")}}</option>');
                                $.each(data, function(key, value) {
                                    $('select[name="attribute_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                                $('select[name="attribute_id"]').niceSelect('update'); 
                            }
                        });
                    }else{
                        $('select[name="attribute_id"]').empty();
                    }

                });
    });
</script>
<script type="text/javascript">
     $(document).ready(function() {
        $('select[name="attribute_variants_id"]').append('<option value="">{{__("select Attribute Variants")}}</option>');
        $('select[name="attribute_variants_id"]').niceSelect('update');
        $('select[name="attribute_id"]').on('change', function() {
            var attribute_id = $(this).val();
            var token = "{{csrf_token()}}";
            if(attribute_id) {
                $.ajax({ 
                    url: '{{route("forntend.business.item-post.getAttributevariants")}}',
                    type: "POST",
                    dataType: "json",
                    data: {'attribute_id': attribute_id, _token:token},
                    success:function(data) {      
                        $('select[name="attribute_variants_id"]').empty();
                        $('select[name="attribute_variants_id"]').append('<option value="">{{__("Select Attribute Variants")}}</option>');
                        $.each(data, function(key, value) {
                            $('select[name="attribute_variants_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                         });
                        $('select[name="attribute_variants_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="attribute_variants_id"]').empty();
            }
        });
     });
</script>

@endif

@if(in_array($route_name, [
    'frontend.business.business-profile.index',
    ]))
    <script type="text/javascript">
        $(document).ready(function() {
            $("#business_banner_replace").submit(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData(document.getElementById("business_banner_replace"));
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    url: "{{ route('frontend.business.business-profile.businessReplaceBanner') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.code === 200) {
                            toastr.success(data.success);
                        }
                    },
                    error: function(data) {}
                });
            });
            $("#business_pwd_change").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "current_password": {
                        required: true,
                        minlength: 6,
                    },
                    "new_password": {
                        required: true,
                        minlength: 6,
                    },
                    "confirm_new_password": {
                        required: true,
                        //minlength:6,
                        equalTo: '#new_password_business'
                    },
                },
                messages: {
                    "current_password": {
                        required: '{{__("business_messages.change_password.validation.enter_current_password")}}',
                        
                    },
                    "new_password": {

                        required: '{{__("business_messages.change_password.validation.enter_new_password")}}',
                        minlength: '{{__("business_messages.change_password.validation.password_must_be_6")}}',
    
                    },
                    "confirm_new_password": {

                        required: '{{__("business_messages.change_password.validation.enter_confirm_new_password")}}',
                        equalTo: '{{__("business_messages.change_password.validation.password_not_match")}}',
                        // minlength:'Please Password must be 6 character',
                    },
                },
                submitHandler: function(form) {
                    var $this = $('.loader_class');
                    var loadingText =
                        '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i>Loading...';
                    $('.loader_class').prop("disabled", true);
                    $this.html(loadingText);
                    form.submit();
                },
            });
            
            $('.bxs-heart').click(function() {
                if ($(this).attr('att') == 0) {
                    $(this).css('color', 'red');
                    $(this).attr('att', 1);
                } else {
                    $(this).css('color', 'grey');
                    $(this).attr('att', 0);
                }
                var link_data = $(this).data('id');
                let wishlist_status = $(this).attr('att');
                let csrf_token  = '{{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.business.wishlist.add_to_wishlist') }}",
                    data: {
                        item_id: link_data,
                        wishlist_status: wishlist_status,
                        _token: csrf_token,
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        toastr.success(result.success);
                    },
                });
            });
        });

        $(document).ready(function() {
             /* Success and fail toaster message */
            toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>
    <script src="{{ asset('fronted/business_flow/assets/js/profille_slider/b_story_slider.js') }}"></script>
@endif

@if(in_array($route_name, [
    'frontend.business.wishlist.index',
    ]))
    <script type="text/javascript">
        $(document).ready(function() {
            $('.wishlist_delete').click(function() {
                var wishlist_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.business.wishlist.wishlist_removed') }}",
                    data: {
                        wishlist_id:wishlist_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (result) {
                        toastr.success(result.success);
                        setTimeout(function(){ location.reload(); }, 1000);
                    },
                    error: function(err){
                        toastr.error(result.error);
                    }
                });
            });
            toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>
@endif

@php $boost_items_url = request()->segments(); @endphp
@if(!empty($boost_items_url['1']))
    @if ($boost_items_url['1'] == 'boost-items')
        <script type="text/javascript">
            $('.get_items_id').click(function() {
                var itemId = $(this).attr('data-id');
                var itemBoostPrice = $('#get_item_price').val();
                $('#set_item_id').attr('data-id', itemId);
                $('#set_item_price').text(itemBoostPrice);
            });
            $(document).ready(function() {
                $('.make_payment').click(function() {
                    var payment_id = $(this).data('id');
                    var itemBoostPrice = $('#get_item_price').val();
                    var itemId = $(this).attr('data-id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('frontend.business.boost-items.boost_items_payment_details')}}",
                        data: {
                            itemId : itemId,
                            itemBoostPrice: itemBoostPrice, 
                            payment_id: payment_id, 
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.success);
                            window.location.href = "{{ url('business/boost-items/boost_items_payment/') }}" + '/' + itemId;
                        },
                        error: function(err) {
                            toastr.error(result.error);
                        }
                    });
                });
                /* Success and fail toaster message */
                toastr.options.timeOut = 10000;
                @if (Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @elseif(Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('warning'))
                    toastr.error('{{ Session::get('warning') }}');
                @elseif(Session::has('info'))
                    toastr.error('{{ Session::get('info') }}');
                @endif
            });
        </script>
    @endif
@endif

@php $promoted_items_url = request()->segments();@endphp
@if(!empty($promoted_items_url['1']))
    @if ($promoted_items_url['1'] == 'promoted-items')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.get_items_details').click(function() {
                    var itemId = $(this).attr('data-id'); 
                    var itemPrice = $('#get_item_price').val();
                    $('#set_item_id').attr('data-id' , itemId); 
                    $('#set_item_price').text(itemPrice);
                });
                $('.make_payment').click(function() {
                    var payment_id = $(this).data('id');       
                    $.ajax({
                        type: "POST",
                        url: '{{ route('frontend.business.order-summary-payment.payment_details') }}',
                        data: {
                            payment_id:payment_id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function (result) {
                            toastr.success(result.success);
                        },
                        error: function(err){
                            toastr.error(result.error);
                        }
                    });
                });
                /* Success and fail toaster message */
                toastr.options.timeOut = 10000;
                @if (Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @elseif(Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('warning'))
                    toastr.error('{{ Session::get('warning') }}');
                @elseif(Session::has('info'))
                    toastr.error('{{ Session::get('info') }}');
                @endif
            });
        </script>
    @endif
@endif


@if(in_array($route_name, [
    'frontend.business.add-roles.index',
    ]))

    <script type="text/javascript">    
        $(document).ready(function() {
            $("#add_role").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    "user_name": {
                        required: true,
                    },
                    "store_name": {
                        required: true,
                    },
                    "branch_id": {
                        required: true,
                    },
                    "phone_number": {
                        required: true,
                    },
                    "gender": {
                        required: true,
                    },
                    "role_id": {
                        required: true,
                    },
                },
                messages: {
                    "user_name": {
                        required: '{{__("business_messages.role.validation.enter_user_name")}}',
                    },
                    "store_name": {
                        required: '{{__("business_messages.role.validation.enter_store_name")}}',
                    },
                    "branch_id": {
                        required: '{{__("business_messages.role.validation.select_branch")}}',
                    },
                    "phone_number": {
                        required: '{{__("business_messages.role.validation.phone_number")}}',
                    },
                    "gender": {
                        required: '{{__("business_messages.role.validation.please_select_gender")}}',
                    },
                    "role_id": {
                        required: '{{__("business_messages.role.validation.please_select_role")}}',
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

             /* Success and fail toaster message */
             toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>

    <style>
        .modal-content .form-group.submit a {background-color: #0AD188 !important;
        border: 1px solid #0AD188 !important;
        width: 100%;
        color: #fff !important;
        padding: 16px 30px;
        font-weight: 400;
        line-height: 22px;}
    </style>
@endif

@if(in_array($route_name, [ 
    'frontend.business.business-dashboard.index',
    'frontend.business.promoted-items.item_details',
    'frontend.business.new-items.item_details',
    'frontend.business.used-items.item_details',
    'frontend.business.unused-items.item_details',
    'frontend.business.boost-items.item_details',
    'frontend.business.my-items.index',
    'frontend.store.my-items.index',

    ]))
    
    <script type="text/javascript">
        $('.bxs-heart').click(function() {
            if ($(this).attr('att') == 0) {
                $(this).css('color', 'red');
                $(this).attr('att', 1);
            } else {
                $(this).css('color', 'grey');
                $(this).attr('att', 0);
            }
            var link_data = $(this).data('id');
            let wishlist_status = $(this).attr('att');
            $.ajax({
                type: "POST",
                url: '{{ route('frontend.business.wishlist.add_to_wishlist') }}',
                data: {
                    item_id: link_data,
                    wishlist_status: wishlist_status,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (result) {
                    toastr.success(result.success);
                },
                error: function(err){
                    toastr.error(result.error);
                }
            });
        });
    </script>
   
   
@endif


@if(in_array($route_name, [
        'frontend.business.my-items.index',
        'frontend.business.business-profile.index',
        'frontend.store.my-items.index',
]))
    <style>
        .pagination a.page_link {
            margin: 0 7px;
        }
        .pagination a.page_link:hover {
            color: #0AD188 !important;
            border-color: #0AD188;
        }
        a.page_link.page-link {
            height: 46px;
            width: 46px;
            border-radius: 100% !important;
            font-size: 18px;
            color: #111419;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            border: 1px solid #E9E9E9;
            transition: all 0.5s ease 0s;
        }
        .active_page{
            color: #0AD188 !important;
            border-color: #0AD188 !important;
        }
    </style>

    <script type="text/javascript">   

        $(document).ready(function() {

            @if($route_name = 'frontend.business.b-profile.index')
                var show_per_page = 6;
            @else
                var show_per_page = 12;
            @endif
            
            var number_of_items = $('#pagingBox').children().length;
            var number_of_pages = Math.ceil(number_of_items / show_per_page);
            $('#current_page').val(0);
            $('#show_per_page').val(show_per_page);
            var navigation_html = '<li class="page-item"><a class="previous_link page-link" href="javascript:previous();"><</a></li>';
            var current_link = 0;
            while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link page-link" href="javascript:go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
            }
            navigation_html += '<li class="page-item"><a class="next_link page-link" href="javascript:next();">></a></li>';
            $('#page_navigation').html(navigation_html);
            $('#page_navigation .page_link:first').addClass('active_page');
            $('#pagingBox').children().css('display', 'none');
            $('#pagingBox').children().slice(0, show_per_page).css('display', 'block');
        });

        function previous() {
            new_page = parseInt($('#current_page').val()) - 1;
            if ($('.active_page').prev('.page_link').length == true) {
            go_to_page(new_page);
            }
        }

        function next() {
            new_page = parseInt($('#current_page').val()) + 1;
            if ($('.active_page').next('.page_link').length == true) {
            go_to_page(new_page);
            }
        }

        function go_to_page(page_num) {
            var show_per_page = parseInt($('#show_per_page').val());
            start_from = page_num * show_per_page;
            end_on = start_from + show_per_page;
            $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
            $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass('active_page');
            $('#current_page').val(page_num);
        }
    </script>
    <link rel="stylesheet" href="{{asset('fronted/business_flow/assets/css/hummingbird-treeview.css')}}">
<script src="{{ asset('fronted/business_flow/assets/js/hummingbird-treeview.js')}}"></script>
<script type="text/javascript">
    jQuery ("#treeview").hummingbird();
    jQuery ("#checkAll").click(function() {
        jQuery ("#treeview").hummingbird("checkAll");
    });
    jQuery ("#uncheckAll").click(function() {
        jQuery ("#treeview").hummingbird("uncheckAll");
    });
    jQuery ("#collapseAll").click(function() {
        jQuery ("#treeview").hummingbird("collapseAll");
    });
</script>
<script>
    $(document).ready(function() {
        $('.userCateFilter').click(function() {
            let userIds = $('.userCateFilter').attr("data-categoryid");

            var categorieIds = [];
            $('input:checkbox[name="categories[]"]').each(function() {
                if (this.checked) {
                    categorieIds.push(this.value);
                }
            });

            var subCateIds = [];
            $('input:checkbox[name="subCates[]"]').each(function() {
                if (this.checked) {
                    subCateIds.push(this.value);
                }
            });

            var conditions = [];
            $('input:checkbox[name="condition[]"]').each(function() {
                if (this.checked) {
                    conditions.push(this.value);
                }
            });

            var brands = [];
            $('input:checkbox[name="brands[]"]').each(function() {
                if (this.checked) {
                    brands.push(this.value);
                }
            });

            var less = [];
            $('input:checkbox[name="less[]"]').each(function() {
                if (this.checked) {
                    less.push(this.value);
                }
            });

            var outoffstock = [];
            $('input:checkbox[name="outoffstock[]"]').each(function() {
                if (this.checked) {
                    outoffstock.push(this.value);
                }
            });

            var cities = [];
            $('input:checkbox[name="city[]"]').each(function() {
                if (this.checked) {
                    cities.push(this.value);
                }
            });

            var sellerRatings = [];
            $('input:checkbox[name="attr_value"]').each(function() {
                if (this.checked) {
                    sellerRatings.push(this.value);
                }
            });


            var sorting_data = $('.cateFilterPrice').find(":selected").val();
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('frontend.business.my-items.userSubCateFilter') }}",
                data: {
                    'userIds': userIds,
                    'categorieIds': categorieIds,
                    'subCateIds': subCateIds,
                    'conditions': conditions,
                    'brands': brands,
                    'less': less,
                    'outoffstock': outoffstock,
                    'sorting_data': sorting_data,
                    _token: token
                },
                success: function(data) {
                    if (data) {
                        $('#sortingData').html(data);
                    } else {
                        location.reload();
                    }
                },
                timeout: 10000
            });
        });

        $(".userCateFilterPrice").on("change", function() {

            var sorting_data = $('.userCateFilterPrice').find(":selected").val();
            var cateIds = $("input[name='cateIds']").val();

            var subCateIds = [];
            $('input:checkbox[name="subCates[]"]').each(function() {
                if (this.checked) {
                    subCateIds.push(this.value);
                }
            });

            var conditions = [];
            $('input:checkbox[name="condition[]"]').each(function() {
                if (this.checked) {
                    conditions.push(this.value);
                }
            });

            var brands = [];
            $('input:checkbox[name="brands[]"]').each(function() {
                if (this.checked) {
                    brands.push(this.value);
                }
            });

            var cities = [];
            $('input:checkbox[name="city[]"]').each(function() {
                if (this.checked) {
                    cities.push(this.value);
                }
            });

            var sellerRatings = [];
            $('input:checkbox[name="attr_value"]').each(function() {
                if (this.checked) {
                    sellerRatings.push(this.value);
                }
            });

            let minPrice = parseInt(rangeInput[0].value),
                maxPrice = parseInt(rangeInput[1].value);

            var token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('frontend.users.product_category.userSubCateFilter') }}",
                data: {
                    'sorting_data': sorting_data,
                    'cateIds': cateIds,
                    'subCateIds': subCateIds,
                    'conditions': conditions,
                    'minPrice': minPrice,
                    'maxPrice': maxPrice,
                    'brands': brands,
                    'cities': cities,
                    'seller_ratings': sellerRatings,
                    _token: token
                },
                success: function(data) {
                    if (data) {
                        $('#sortingData').html(data);

                    } else {
                        location.reload();
                    }
                },
                timeout: 10000
            });
        });
    });
</script>
    
@endif

@if(in_array($route_name, [
        'frontend.business.my-orders.index',
]))
<script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif(Session::has("error"))
            toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('warning'))
            toastr.error("{{ Session::get('warning') }}");
        @elseif(Session::has('info'))
            toastr.error("{{ Session::get('info') }}");
        @endif
    });
</script>
@endif

@if(in_array($route_name, [
        'frontend.business.order-details.index',
]))

    <script type="text/javascript">
        $('.accept_order_btn').click(function() {
            var roleId = $(this).data('id'); 
            $.ajax({
                type: "POST",
                url: '',
                data: {
                    roleId:roleId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (res) {
                 
                },
            });
        });
    </script>
@endif


@php 
$productAuthor_profile = request()->segments();
@endphp

@if(!empty($productAuthor_profile['1']))
    @if ($productAuthor_profile['1'] == 'profile-seller')
 
    <style>
        a#follow_btn {
            width: 100%;
        }
        a#follow_btn .msg-follow,
        a#follow_btn .msg-following,
        a#follow_btn .msg-unfollow{
        display: none;
        }

        a#follow_btn .msg-follow{
        display: inline;
        }

        a#follow_btn.following .msg-follow{
        display: none;
        }

        a#follow_btn.following .msg-following{
        display: inline;
        }

        /* a#follow_btn.following:not(.wait):hover .msg-following{
        display: none;
        }

        a#follow_btn.following:not(.wait):hover .msg-unfollow{
        display: inline;
        } */
    </style>

<script type="text/javascript">
    $(document).ready(function() {     

        $('#follow_btn111').click(function(){
            var $this = $(this);
            $this.toggleClass('following')

            if($this.is('.following')){
                $this.addClass('wait');
                /* Call Ajax start*/
                let followerId = $('#follow_user').attr('data-followerId');
                let followingId = $('#follow_user').attr('data-followingId');
                let follow_unfollow_status = $('#follow_btn').attr('att');
                $.ajax({
                    type: "POST",
                    url: '{{ route("frontend.business.profile-seller.followers") }}',
                    data: {
                        follower_id:followerId,
                        following_id:followingId,
                        follow_unfollow_status:follow_unfollow_status,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (res) {
                        document.getElementById("orFollowers").innerHTML = data.data;   
                        //toastr.success(res.success);
                        //setTimeout(function(){ location.reload(); }, 50);
                    },
                });
                /* Call Ajax end*/
            }
            }).on('mouseleave',function(){
                $(this).removeClass('wait');
            })        
    }); 
</script>


<style>
    .pagination a.page_link {
        margin: 0 7px;
    }
    .pagination a.page_link:hover {
        color: #0AD188 !important;
        border-color: #0AD188;
    }
    a.page_link.page-link {
        height: 46px;
        width: 46px;
        border-radius: 100% !important;
        font-size: 18px;
        color: #111419;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        border: 1px solid #E9E9E9;
        transition: all 0.5s ease 0s;
    }
    .active_page{
        color: #0AD188 !important;
        border-color: #0AD188 !important;
    }
</style>

<script type="text/javascript">   

    $(document).ready(function() {

        @if($route_name = 'frontend.business.b-profile.index')
            var show_per_page = 6;
        @else
            var show_per_page = 12;
        @endif
        
        var number_of_items = $('#pagingBox').children().length;
        var number_of_pages = Math.ceil(number_of_items / show_per_page);
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);
        var navigation_html = '<li class="page-item"><a class="previous_link page-link" href="javascript:previous();"><</a></li>';
        var current_link = 0;
        while (number_of_pages > current_link) {
        navigation_html += '<a class="page_link page-link" href="javascript:go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
        current_link++;
        }
        navigation_html += '<li class="page-item"><a class="next_link page-link" href="javascript:next();">></a></li>';
        $('#page_navigation').html(navigation_html);
        $('#page_navigation .page_link:first').addClass('active_page');
        $('#pagingBox').children().css('display', 'none');
        $('#pagingBox').children().slice(0, show_per_page).css('display', 'block');
    });

    function previous() {
        new_page = parseInt($('#current_page').val()) - 1;
        if ($('.active_page').prev('.page_link').length == true) {
        go_to_page(new_page);
        }
    }

    function next() {
        new_page = parseInt($('#current_page').val()) + 1;
        if ($('.active_page').next('.page_link').length == true) {
        go_to_page(new_page);
        }
    }

    function go_to_page(page_num) {
        var show_per_page = parseInt($('#show_per_page').val());
        start_from = page_num * show_per_page;
        end_on = start_from + show_per_page;
        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass('active_page');
        $('#current_page').val(page_num);
    }
</script>

<script src="{{ asset('fronted/business_flow/assets/js/profille_slider/b_seller_profile_slider.js') }}"></script>
    @endif
@endif



@if(in_array($route_name, [
        'frontend.business.add-store.index',
]))

    <style>
        .nice-select.form-select.open ul.list {
            max-height: 200px;
            overflow: auto;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            if($('#same-as-business').not(":checked")) {
            //$("#add_store").trigger("reset");
            //    $("#add_store")[0].reset();
            //     //faster version:
            //     $("#add_store")[0].reset();

            $("#add_store").trigger("reset");

            }
        });

        $("#add_store").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);  
            },
        rules: {
            "store_name": {
                required: true,
            },
            "store_location": {
                required: true,
            },
            "city_area": {
                required: true,
            },
            "country": {
                required: true,
            },
            "city_id": {
                required: true,
            },
            //   "shop_sign_file": {
            //      required: true,
            //   },
            //   "store_logo_file": {
            //      required: true,
            //   },
            "phone_number": {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            "working_hours": {
                required: true,
            },
            "website": {
                required: true,
            },
            "store_type_id": {
                required: true,
            },
        },
        messages: {

            "store_name": {
                required:'{{__("business_messages.add_store.validation.store_name")}}',
            },
            "store_location": {
                required:'{{__("business_messages.add_store.validation.location")}}',
            },
            "city_area": {
                required:'{{__("business_messages.add_store.validation.city_area")}}',
            },
            "country": {
                required:'{{__("business_messages.add_store.validation.country")}}',
            },
            "city_id": {
                required:'{{__("business_messages.add_store.validation.city_id")}}',
            },
            //   "shop_sign_file": {
            //      required:'{{__("business_messages.add_store.validation.shop_sign_file")}}',
            //   },
            //   "store_logo_file": {
            //      required:'{{__("business_messages.add_store.validation.store_logo_file")}}',
            //   },
            "phone_number": {
                required:'{{__("business_messages.add_store.validation.store_phone_number")}}',
                number: '@lang("business_messages.add_store.validation.validnumber")}}',
                minlength: '@lang("business_messages.add_store.validation.minlengthnumber")}}',
                maxlength: '@lang("business_messages.add_store.validation.maxlengthnumber")'
            },
            "working_hours": {
                required:'{{__("business_messages.add_store.validation.working_hours")}}',
            },
            "website": {
                required:'{{__("business_messages.add_store.validation.website")}}',
            },
            "store_type_id": {
                required:'{{__("business_messages.add_store.validation.store_type_id")}}',
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


    <!-- get states by country Id -->
    <script type="text/javascript">    
    $(document).ready(function() {
        $('select[name="state_id"]').append('<option value="">Select State</option>'); 
        $('select[name="state_id"]').niceSelect('update'); 
        $('select[name="country_id"]').on('change', function() {
            var country_id = this.value;
            if(country_id) {
                $.ajax({
                    url: '{{route('frontend.business.add-store.state_list')}}',
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success:function(response) {                       
                        $('select[name="state_id"]').empty();
                        $('select[name="state_id"]').append('<option value="">Select State</option>');        
                        $.each(response.states, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('select[name="state_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="state_id"]').empty();
            }
        });
    });
    </script>
    <!-- get cities by state id -->
    <script type="text/javascript">    
    $(document).ready(function() {
        $('select[name="city_id"]').append('<option value="">Select City</option>'); 
        $('select[name="city_id"]').niceSelect('update'); 
        $('select[name="state_id"]').on('change', function() {
            var state_id = this.value;
            if(state_id) {
                $.ajax({
                    url: '{{route('frontend.business.add-store.city_list')}}',
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success:function(response) {                       
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="">Select City</option>');        
                        $.each(response.cities, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('select[name="city_id"]').niceSelect('update'); 
                    }
                });
            }else{
                $('select[name="city_id"]').empty();
            }
        });
    });
    </script>
@endif


@if(in_array($route_name, [
        'frontend.business.business-report.index',
        'frontend.business.sales-report.index',
]))
<script src="{{ asset('fronted/business_flow/assets/js/chart/Chart.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/apexcharts.min.js') }}"></script>


<script>

$(function () {
 
    var getBraChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label               : 'Weekly',
            backgroundColor     : 'rgba(255,193,7,0.9)',
            borderColor         : 'rgba(255,193,7,0.8)',
            pointRadius          : false,
            pointColor          : '#ffc107',
            pointStrokeColor    : 'rgba(255,193,7,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(255,193,7,1)',
            data                : [66, 10, 40, 51, 56, 5, 40, 52, 45, 77, 55, 15, 37]
        },{
            label               : 'Monthly',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [
                                    80, 22, 40, 91, 86, 27, 90, 20, 33, 60,19, 57
                                  ]

        },{
            label               : 'Yearly',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [
                                    80, 22, 40, 91, 86, 27, 90, 35, 55, 64, 10, 70
                                  ]
        }]
    }

    var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines : {
                    display : false,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : false,
                }
            }]
        }
    }

     //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, getBraChartData)
    var temp0 = getBraChartData.datasets[0]
    var temp1 = getBraChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })


})
</script>

<script type="text/javascript">
        var options = {
            series: [{
                name: "Ative",
                data: [65, 125, 150, 50, 110]
            }, {
                name: "Dispatched",
                data: [35, 41, 62, 42, 13]
            }, {
                name: 'Return',
                data: [87, 57, 74, 99, 75]
            }],
            chart: {
                height: 180,
                type: 'line',
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [3, 3, 3],
                curve: 'straight',
                colors: ['#6754E1', '#07B093', '#CC95E5']
            },
            legend: {
                tooltipHoverFormatter: function(val, opts) {
                    return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                }
            },
            markers: {
                size: 0,
                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: ['Jan 6', 'Jan 12', 'Jan 18', 'Jan 24', 'Jan 30'],
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function(val) {
                            return val + " (mins)"
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val + " per session"
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                }]
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };

        var chart = new ApexCharts(document.querySelector("#orderstatus"), options);
        chart.render();
    
        var options = {
            series: [81, 19],
            chart: {
                width: 380,
                height: 200,
                type: 'pie'
            },
            legend: {
                show: false,
                position: 'bottom'
            },
            colors: ['#06B093', '#6956E5'],
            labels: ['Followers', 'Following'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#followers"), options);
        chart.render();

        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 55, 57, 56, 61, 44, 55, 57, 56, 61, 58, 63, 60, 66, 55, 57, 56, 61, 55, 57, 56, 61]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded',
                    colors: {
                        ranges: [{
                            from: 0,
                            to: 100,
                            color: '#06B093',
                        }],
                        backgroundBarColors: ['#ffffff'],
                        backgroundBarOpacity: 1,
                        backgroundBarRadius: 0,
                    },
                },

            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 0,
                colors: ['#06B093'],
            },
            xaxis: {
                categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18',
                    'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30'
                ],
            },
            yaxis: {

            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#itemschart"), options);
        chart.render();

        var options = {
            series: [{
                name: 'Cash Flow',
                data: [1.45, 5.42, 5.9, 0.42, 12.6, 18.1, 18.2, 14.16, 11.1, 6.09, 0.34, 3.88, 13.07,
                    5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, 27.03, 54.4, 47.2, 43.3, 18.6, 48.6, 41.1, 39.6, 37.6, 29.4, 21.4, 2.4
                ]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    colors: {
                        color: '#cccccc'
                    },
                    columnWidth: '40%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            yaxis: {

                labels: {
                    formatter: function(y) {
                        return y.toFixed(0) + "%";
                    }
                }
            },
            xaxis: {

                labels: {
                    datetimeFormatter: {
                        format: 'dd/MM',
                    }
                },

                type: 'date',
                categories: [
                    'Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18',
                    'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30'
                ],
                labels: {
                    rotate: -90
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#itemschartqq"), options);
        chart.render();

</script>
<script type="text/javascript">
        $("#opt_level").on('change', function() {
         var filter_value = $(this).val();

        $.ajax({

            url: '{{route("frontend.business.business-report.business_report_filter")}}',
            type: "POST",
            data: {
                filter_value: filter_value,
                _token: '{{csrf_token()}}'
            },
            dataType: 'JSON',
            success: function (response) {
                $.each(response, function (key, roleData) { 
                    
                    /*Profile Image*/
                    var ImgUrl = "{{ URL::asset(BUSINESS_PROFILE_FOLDER)}}";
                    $("#blah88").attr('src', ImgUrl + '/' + roleData['role_user_profile_picture']);
                    
                    $('#addUserRoleId').val(roleData['id']);
                    $('#first_name').val(roleData['user_name']);
                    $('#store_name').val(roleData['store_name']);
                    $('#phoneNumber').val(roleData['phone_number']);
                    $('#user_auto_generate_id').val(roleData['user_auto_generate_id']);

                    /*Branch Drop Down*/
                    $("#branch_id_select").val(roleData['branch']['id']);
                    $('#branch_id_select').niceSelect('destroy'); 
                    $('#branch_id_select').niceSelect(); 

                    /*Gender Drop Down*/
                    $("#gender_select").val(roleData['gender']);
                    $('#gender_select').niceSelect('destroy'); 
                    $('#gender_select').niceSelect(); 

                    /*Role Drop Down*/
                    $("#role_id_select").val(roleData['role']['id']);
                    $('#role_id_select').niceSelect('destroy'); 
                    $('#role_id_select').niceSelect();   
                });
            },
        });
    });
</script>

@endif

@if(in_array($route_name, [
    'frontend.business.sales-report.index',
]))

<script type="text/javascript">

        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded',
                    colors: {
                        ranges: [{
                            color: ['#A4A4A4']

                        }],
                        backgroundBarColors: ['#ffffff'],
                        backgroundBarOpacity: 1,
                        backgroundBarRadius: 0,
                    },

                },

            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {

                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#salsechart"), options);
        chart.render();


        var options = {
            series: [50, 30, 20],
            chart: {
                type: 'donut',
                width: 360,

            },
            colors: ['#06B093', '#6956E5', '#B4B7B6'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 150,
                        height: 150,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chartcategories"), options);
        chart.render();

</script>

@endif

<script type="text/javascript">
    $("#b_make_an_offer").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            "offer_price": {
                required: true,
            },
            "offer_message": {
                required: true,
            },
        },
        messages: {
            "offer_price": {
                required: '{{__("business_messages.make_an_offer.validation.enter_offer_price")}}',
            },
            "offer_message": {
                required: '{{__("business_messages.make_an_offer.validation.write_your_message")}}',
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

    $('.or_make_an_offer').click(function() {
        var make_an_offer_itemIt = $(this).data('id'); 
        $.ajax({
            type: "POST",
            url: '{{ route("frontend.business.promoted-items.make_an_offer") }}',
            data: {
                item_Id:make_an_offer_itemIt,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success: function (response) {
                $.each(response, function (key, makeAnOffer) { 
                    /*Profile Image*/
                    var authProfileUrl = "{{ URL::asset(BUSINESS_PROFILE_FOLDER)}}";
                    $("#product-author-profile").attr('src', authProfileUrl + '/' + makeAnOffer['user']['profile_picture']);

                    var itemImgUrl = "{{ URL::asset(BUSINESS_ITEMS_POST_FOLDER)}}";
                    $("#item-picture-7000").attr('src', itemImgUrl + '/' + makeAnOffer['item_pictures']['item_picture1']);
                    
                    var itemPrice = $('#get_item_price').val();
                    $('#make_an_offer_item_price').text(itemPrice);

                    $('#product-author-name').text(makeAnOffer['user']['first_name']);

                    var membershipDate = $('#get-item-user-membership').val();
                    $('#product-author-member-date').text(membershipDate);
                    $('#setProductAuthorId_make_an_offer').val(makeAnOffer['user_id']);
                    $('#setProductId_make_an_offer').val(makeAnOffer['id']);
                    $('#setProductPrice_make_an_offer').val(makeAnOffer['price']);
                    
                });
            },
        });
    });

    $('.or_hold_an_offer').click(function() {
        var hold_an_offer_itemIt = $(this).data('id'); 
        $.ajax({
            type: "POST",
            url: '{{ route("frontend.business.promoted-items.hold_an_offer") }}',
            data: {
                item_Id:hold_an_offer_itemIt,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success: function (response) {
                $.each(response, function (key, holdAnOffer) { 
                    /*Profile Image*/
                    var ImgUrl = "{{ URL::asset(BUSINESS_ITEMS_POST_FOLDER)}}";
                    $("#item-picture-8000").attr('src', ImgUrl + '/' + holdAnOffer['item_pictures']['item_picture1']);

                    $('#product-name-hold-an-offer').text(holdAnOffer['what_are_you_selling']);
                    var itemPrice = $('#get_item_price').val();
                    $('#product-price-hold-an-offer').text(itemPrice);

                    let holdAnOffer_item_price = holdAnOffer['price'];
                    let discountPercentage = 10;
                    let payableAmount = holdAnOffer_item_price - (holdAnOffer_item_price * discountPercentage / 100);
                    let bookingPrice = (holdAnOffer_item_price - payableAmount);
                    $('#bookingPrice').text(bookingPrice);
                    $('#payableAmountItems').text(payableAmount);

                    $('#setProductAuthorId').val(holdAnOffer['user_id']);
                    $('#setProductId').val(holdAnOffer['id']);
                    $('#setProductPrice_hold_an_offer').val(holdAnOffer['price']);
                    $('#setBookingPrice').val(bookingPrice);
                    $('#setPayableAmountForItem').val(payableAmount);

                });
            },
        });
    });

    $('#addtoCard').click(function() {
        let item_id = $('.add_to_cart').attr("data-item_id");
        let user_id = $('.add_to_cart').attr("data-user_id");
        let attribute_id = $('.category-h').val();
        var token = "{{csrf_token()}}";
    
        $.ajax({
            url: '{{route("frontend.business.order-details.addToCart")}}',
            type: "POST",
            dataType: "json",
            data: {
                'item_id': item_id,
                'user_id': user_id,
                'attribute_id': attribute_id,
                _token: token
            },
            success: function(data) {

                console.log(data.data.count);

                if(data.data.count > 1)
                {
                    window.location.href = "{{ url('business/order-details/checkout')}}/" + data.data.id;
                }
                else
                {
                    window.location.href = "{{ url('business/address/shipping-address')}}/" + item_id;
                }
            }
        });
    });

    $('#addtoCardStore').click(function() {
        let item_id = $('.add_to_cart_store').attr("data-item_id");
        let user_id = $('.add_to_cart_store').attr("data-user_id");
        let attribute_id = $('.category-h').val();
        var token = "{{csrf_token()}}";
    
        $.ajax({
            url: '{{route("frontend.store.order-details.addToCart")}}',
            type: "POST",
            dataType: "json",
            data: {
                'item_id': item_id,
                'user_id': user_id,
                'attribute_id': attribute_id,
                _token: token
            },
            success: function(data) {

                console.log(data.data.count);

                if(data.data.count > 1)
                {
                    window.location.href = "{{ url('store/order-details/checkout')}}/" + data.data.id;
                }
                else
                {
                    window.location.href = "{{ url('store/address/shipping-address')}}/" + item_id;
                }
            }
        });
    });

    $('.us-lan').click(function() {
		$.cookie('india', 'english', { expires: 1 });
		$.cookie('arabic', null);
        var lang =  $(this).data("langauge12");
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
    
	$('.arabic-lan').click(function() {
	  $.cookie('arabic', 'arabic', { expires: 1 });
	  $.cookie('india', null);

      var lang =  $(this).data("langauge12");
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
  	setInterval(function() {
		if ($.cookie('arabic') == 'arabic' ){
			$('html').addClass('rtl-mode');
			$('html').removeClass('ltr-mode');
		}
		else{
			$('html').addClass('ltr-mode');		
			$('html').removeClass('rtl-mode');
		}
	}, 100);
</script>

@if(in_array($route_name, [
    'frontend.business.address.index',
    'frontend.business.address.shipping_address',
    'frontend.store.address.shipping_address',
    'frontend.store.address.index'
]))

<script type="text/javascript">
    $('.generateOrder').click(function() {
        var itemaId = $(this).data('id');
        var userId = $(this).data('uid');
        var addressId = $(this).data('aid');

        $.ajax({

            type: "POST",
            url: "{{ route('mycheckout.index') }}",
            data: {
                item_id: itemaId,
                user_id: userId,
                address_id: addressId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success: function(result) {


                let id = result.response.id
                let invoiceURL = result.response.invoiceURL

                // let encode_ids = btoa(id);

                window.location.href = "{{ url('/business/order-details/checkout') }}/" + id;
                // toastr.success(result.message);
            },
            error: function(err) {
                toastr.error("Failed");
            }
        });
    });
</script>
<script type="text/javascript">
    $('.generateOrderStore').click(function() {
        var itemaId = $(this).data('id');
        var userId = $(this).data('uid');
        var addressId = $(this).data('aid');

        $.ajax({

            type: "POST",
            url: "{{ route('mycheckout.index') }}",
            data: {
                item_id: itemaId,
                user_id: userId,
                address_id: addressId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success: function(result) {


                let id = result.response.id
                let invoiceURL = result.response.invoiceURL

                // let encode_ids = btoa(id);

                window.location.href = "{{ url('/store/order-details/checkout') }}/" + id;
                toastr.success(result.message);
            },
            error: function(err) {
                toastr.error(result.message);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#business_delivery_address").validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "name": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                "pincode": {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 6
                },
                "locality": {
                    required: true,
                },
                "address": {
                    required: true,
                },
                "city": {
                    required: true,
                },
                "address_type": {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: '@lang("frontend-messages.UserAddresses.validation.name")',
                },
                "phone_number": {
                    required: '@lang("frontend-messages.UserAddresses.validation.phonenumber")',
                    number: '@lang("frontend-messages.UserAddresses.validation.validnumber")',
                    minlength: '@lang("frontend-messages.UserAddresses.validation.minlengthnumber")',
                    maxlength: '@lang("frontend-messages.UserAddresses.validation.maxlengthnumber")'
                },
                "pincode": {
                    required: '@lang("frontend-messages.UserAddresses.validation.pincode")',
                    number: '@lang("frontend-messages.UserAddresses.validation.pincodenumber")',
                    minlength: '@lang("frontend-messages.UserAddresses.validation.pincodeminlength")',
                    maxlength: '@lang("frontend-messages.UserAddresses.validation.pinmaxlength")'
                },
                "locality": {
                    required: '@lang("frontend-messages.UserAddresses.validation.locality")',
                },
                "address": {
                    required: '@lang("frontend-messages.UserAddresses.validation.address")',
                },
                "city": {
                    required: '@lang("frontend-messages.UserAddresses.validation.city")',
                },
                "address_type": {
                    required: '@lang("frontend-messages.UserAddresses.validation.addresstype")',
                },
            },
            submitHandler: function(form) {
                var $this = $('.loader_class');
                var loadingText =
                    '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
                $('.loader_class').prop("disabled", true);
                $this.html(loadingText);
                form.submit();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        });
        toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
    });
</script>
<script>
    
</script>
<script>
    function AddressUpdate(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $('#name' + id).val();
        var phone_number = $('#phone_number' + id).val();
        var pincode = $('#pincode' + id).val();
        var locality = $('#locality' + id).val();
        var address = $('#address' + id).val();
        var city = $('#city' + id).val();
        var landmark = $('#landmark' + id).val();
        var alternate_phone = $('#alternate_phone' + id).val();
        var address_type = $("#home" + id + ":checked").val();
        // var formdata = new FormData(document.getElementById("edit_delivery_address"));  
        $.ajax({
            type: 'POST',
            url: "{{ url('/profile/update_address')}}/" + id,
            data: {
                id: id,
                name: name,
                phone_number: phone_number,
                pincode: pincode,
                locality: locality,
                address: address,
                city: city,
                landmark: landmark,
                alternate_phone: alternate_phone,
                address_type: address_type,
            },
            success: function(data) {
                if (data.code === 200) {
                    $('.ajax-alert-edit').addClass('alert-success').show(function() {
                        $(this).html(data.success);
                        setTimeout(function() {
                            $('body').removeClass('modal-open');
                            $('.modal').removeClass('show');
                            $('body').css('overflow', 'visible');
                            $('.modal-backdrop').removeClass('show');
                        }, 10000)
                        $('.loader_class').prop("disabled", false);
                        var loadingText = '@lang("frontend-messages.UserAddresses.editaddress.savebtn")';
                        $('.loader_class').prop("disabled", false);
                        $this.html(loadingText);
                        window.location.href = "{{ URL::route('frontend.users.profile.add_address') }}";
                    });
                }
            },
            error: function(data) {
                $('.ajax-alert-error-edit').addClass('alert-danger').show(function() {
                    // alert('hello');
                    $(this).html('@lang("frontend-messages.UserAddresses.editaddress.error.msg")');
                    $('.loader_class').prop("disabled", false);
                    var loadingText = '@lang("frontend-messages.UserAddresses.editaddress.savebtn")';
                    $('.loader_class').prop("disabled", false);
                    $this.html(loadingText);
                });
                // setTimeout(function() {
                //         $('.ajax-alert-error-edit').css('display','none');
                //         $('.ajax-alert-error-edit').removeClass('alert-danger');
                // },3000);            
            }
        });

        //Add User Address validation
        $("#edit_delivery_address" + id).validate({
            ignore: "not:hidden",
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                "name": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                },
                "pincode": {
                    required: true,
                },
                "locality": {
                    required: true,
                },
                "address": {
                    required: true,
                },
                "city": {
                    required: true,
                },
                "address_type": {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.name")',
                },
                "phone_number": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.phonenumber")',
                },
                "pincode": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.pincode")',
                },
                "locality": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.locality")',
                },
                "address": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.address")',
                },
                "city": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.city")',
                },
                "address_type": {
                    required: '@lang("frontend-messages.UserAddresses.editaddress.validation.addresstype")',
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
    }
</script>
@endif

@if(in_array($route_name, [
    'frontend.business.promoted-items.item_details',
    'frontend.business.new-items.item_details',
    'frontend.business.used-items.item_details',
    'frontend.business.unused-items.item_details',
    'frontend.business.boost-items.item_details',
    ]))
    <script type="text/javascript">
        $('#add-like').click(function() {
            if ($(this).attr('att') == 0) {
                $(this).css('color', 'blue');
                $(this).attr('att', 1);
            } else {
                $(this).css('color', 'black');
                $(this).attr('att', 0);
            }
            var link_data = $(this).data('id');
            let like_status = $(this).attr('att');
            $.ajax({
                type: "POST",
                url: "{{ route('frontend.business.userlike.add_to_like') }}",
                data: {
                    item_id: link_data,
                    like_status: like_status,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: function (result) {
                    toastr.success(result.success);
                },
                error: function(err){
                    toastr.error(result.error);
                }
            });
        });
    </script>
@endif
@if(in_array($route_name, [
    'frontend.business.likelist.index',
    ]))
    <script type="text/javascript">
        $(document).ready(function() {
            $('.likelist_delete').click(function() {
                var likelist_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.business.likelist.likelist_removed') }}",
                    data: {
                        likelist_id:likelist_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function (result) {
                        toastr.success(result.success);
                        setTimeout(function(){ location.reload(); }, 1000);
                    },
                    error: function(err){
                        toastr.error(result.error);
                    }
                });
            });
            toastr.options.timeOut = 10000;
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('warning'))
                toastr.error('{{ Session::get('warning') }}');
            @elseif(Session::has('info'))
                toastr.error('{{ Session::get('info') }}');
            @endif
        });
    </script>
@endif


@if(in_array($route_name, [
    'frontend.business.product_category.index',
    'frontend.business.product_category.subCateFilter',
    ]))
<script>
       $(document).ready(function() {
            $('.businessCateFilter').click(function() {

                let cateIds = $('.businessCateFilter').attr("data-categoryid");

                var subCateIds = [];
                $('input:checkbox[name="subCates[]"]').each(function() {
                    if (this.checked) {
                        subCateIds.push(this.value);
                    }
                });

                var conditions = [];
                $('input:checkbox[name="condition[]"]').each(function() {
                    if (this.checked) {
                        conditions.push(this.value);
                    }
                });

                var brands = [];
                $('input:checkbox[name="brands[]"]').each(function() {
                    if (this.checked) {
                        brands.push(this.value);
                    }
                });

                var cities = [];
                $('input:checkbox[name="city[]"]').each(function() {
                    if (this.checked) {
                        cities.push(this.value);
                    }
                });

                var sellerRatings = [];
                $('input:checkbox[name="attr_value"]').each(function() {
                    if (this.checked) {
                        sellerRatings.push(this.value);
                    }
                });
                var sorting_data = $('.businessCateFilterPrice').find(":selected").val();

                let minPrice = parseInt(rangeInput[0].value),
                    maxPrice = parseInt(rangeInput[1].value);

                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: '{{ route("frontend.business.product_category.subCateFilter") }}',
                    data: {
                        'cateIds': cateIds,
                        'subCateIds': subCateIds,
                        'conditions': conditions,
                        'minPrice': minPrice,
                        'maxPrice': maxPrice,
                        'brands': brands,
                        'cities': cities,
                        'sorting_data': sorting_data,
                        'seller_ratings': sellerRatings,
                        _token: token
                    },
                    success: function(data) {
                        if (data) {
                            $('#sortingData').html(data);
                        } else {
                            location.reload();
                        }
                    },
                    timeout: 10000
                });
            });
            $(".businessCateFilterPrice").on("change", function() {

                var sorting_data = $('.businessCateFilterPrice').find(":selected").val();
                var cateIds = $("input[name='cateIds']").val();

                var subCateIds = [];
                $('input:checkbox[name="subCates[]"]').each(function() {
                    if (this.checked) {
                        subCateIds.push(this.value);
                    }
                });

                var conditions = [];
                $('input:checkbox[name="condition[]"]').each(function() {
                    if (this.checked) {
                        conditions.push(this.value);
                    }
                });

                var brands = [];
                $('input:checkbox[name="brands[]"]').each(function() {
                    if (this.checked) {
                        brands.push(this.value);
                    }
                });

                var cities = [];
                $('input:checkbox[name="city[]"]').each(function() {
                    if (this.checked) {
                        cities.push(this.value);
                    }
                });

                var sellerRatings = [];
                $('input:checkbox[name="attr_value"]').each(function() {
                    if (this.checked) {
                        sellerRatings.push(this.value);
                    }
                });

                let minPrice = parseInt(rangeInput[0].value),
                    maxPrice = parseInt(rangeInput[1].value);

                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{ route('frontend.business.product_category.subCateFilter') }}",
                    data: {
                        'sorting_data': sorting_data,
                        'cateIds': cateIds,
                        'subCateIds': subCateIds,
                        'conditions': conditions,
                        'minPrice': minPrice,
                        'maxPrice': maxPrice,
                        'brands': brands,
                        'cities': cities,
                        'seller_ratings': sellerRatings,
                        _token: token
                    },
                    success: function(data) {
                        if (data) {
                            $('#sortingData').html(data);

                        } else {
                            location.reload();
                        }
                    },
                    timeout: 10000
                });
            });
        });
</script>
@endif

@if(in_array($route_name, [
    'frontend.business.profile-seller.index',
    'frontend.business.profile-seller.followers',
    ]))
    <script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @elseif(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('warning'))
        toastr.error('{{ Session::get('
            warning ') }}');
        @elseif(Session::has('info'))
        toastr.error('{{ Session::get('
            info ') }}');
        @endif
    });

    $('#followbutton').click(function() {


        $(this).text(function(_, text) {
            return text === "Follow" ? "Unfollow" : "Follow";
        });
        if($(this).text() == "Follow") {
            
            $(this).removeClass('unfollow');

        } else if($(this).text() == "Unfollow") {

            $(this).addClass('unfollow');
        }
        let following_id = $('.getIds').attr("data-following_id");
        let follower_id = $('.getIds').attr("data-follower_id");
        let follow_unfollow_status = $('#followbutton').text();
        let token = "{{csrf_token()}}";
        $.ajax({
            url:'{{route("frontend.business.profile-seller.followers")}}',
            type: "post",
            dataType: "json",
            data: {'following_id': following_id,'follower_id': follower_id,'follow_unfollow_status': follow_unfollow_status, _token:token},
            success: function (data) {
                document.getElementById("following_user").innerHTML = data.data;   
            }
        });
    });
    
</script>

<style>
    
    .follow {
      flex: 1;
      margin: 10px;
      align-self: center;
    }
    button {
      background: #0AD188;
      border: none;
      padding: 10px 10px;
      color: whitesmoke;
      width: 100%;
      border-radius: 5px;
      transition: all .3s ease-in;
    }
    button:active {
      outline: none;
    }
    button:visited {
      outline: none;
    }
    .unfollow {
      background: #455bc0;
      color: white;
    }
</style>
@endif
<script type="text/javascript">


    var rating_data = 0;
    $('.add_review_start5').click(function() {
        $('#submit_star_' + count).addClass('btn_mute');
        $('#submit_star_' + count).removeClass('btn_mute');
    });

    $(document).on('mouseenter', '.submit_star', function() { 
        var rating = $(this).data('rating');
        reset_background();
        for (var count = 1; count <= rating; count++) {
            $('#submit_star_' + count).addClass('text-warning');

        }
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' + count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function() {
        reset_background();
        for (var count = 1; count <= rating_data; count++) {
            $('#submit_star_' + count).removeClass('star-light');
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
        $('#rating_data').val(rating_data);
        if ($('.rating_data_check').val() != '')
        {
            $('button#save_review').prop('disabled', false).removeClass('review_submit_btn_mute');
        }
    });
    
    $("#customer_review_post_seller").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            "user_name": {
                required: true,
            },
            "user_review_description": {
                required: true,
            },
            "user_review_items_Image": {
                required: true,
            },
        },
        messages: {
            "user_name": {
                required: "{{ __('frontend-messages.review_post.validation.user_name') }}",
            },
            "user_review_description": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_description') }}",
            },
            "user_review_items_Image": {
                required: "{{ __('frontend-messages.review_post.validation.user_review_items_Image') }}",
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText =
                '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formdata = new FormData(document.getElementById("customer_review_post_seller"));
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: "{{ route('frontend.business.seller-reviews.seller_review_post_store') }}",
                data: formdata,
                success: function(data) {
                    $('#seller_review_writing_btton').modal('hide');
                    // $('#seller_review_writing_btton').modal('show');
                    window.location.reload();

                    //load_rating_data();
                }
            })
        }
    });

    $("#subscribe_business_users").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "email":{
                required:true,
                email:true,
                // emailCheck:true,
            },
        },
        messages: {
            "email":{
                required:'Please enter email address',
                email:'Please enter valid email address',
                // emailCheck:'Please enter valid email address',
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
<script>
jQuery(".cate-read-more").click(function () {
        if(jQuery(".hummingbird-base").hasClass("show-more-height")) {
            jQuery(this).text("Show Less");
        } else {
            jQuery(this).text("Show More");
        }

        jQuery(".hummingbird-base").toggleClass("show-more-height");
    });
</script>

</body>
</html>