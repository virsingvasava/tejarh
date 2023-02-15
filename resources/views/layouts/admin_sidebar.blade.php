<?php
$route_name = \Request::route()->getName();
$logged_user = \Auth::User();
?>
<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons" style="display:none">

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.google')"><i class="ficon bx bxl-google-plus-circle"></i></a></li>

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.linkedin')"><i class="ficon bx bxl-linkedin-square"></i></a></li>

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.twitter')"><i class="ficon bx bxl-twitter"></i></a></li>

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.facebook')"><i class="ficon bx bxl-facebook-square"></i></a></li>

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.apple_stor')"><i class="ficon bx bxl-apple"></i></a></li>

                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{URL::to('/')}}" data-toggle="tooltip" data-placement="top" title="@lang('messages.header.website')"><i class="ficon bx bx-globe"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">


                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link local_dropdown" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@if(\App::getLocale() == "en") <i class="flag-icon flag-icon-us"></i> @else <i class="flag-icon flag-icon-ar"></i> @endif<span class="selected-language"> @if(\App::getLocale() == "en") English @else عربى @endif </span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item lang" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a>
                            <a class="dropdown-item lang" href="javascript:void(0);" data-language="ar"><i class="flag-icon flag-icon-ar mr-50"></i>عربى</a>
                        </div>
                    </li>


                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                            <input class="input" type="text" placeholder="@lang('messages.header.search_bar')" tabindex="-1" data-search="template-search">
                            <div class="search-input-close"><i class="bx bx-x"></i></div>
                            <ul class="search-list"></ul>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name">{{$logged_user->name}}</span>
                            </div><span>
                                @if($logged_user->profile_picture != '' && file_exists(public_path('img/'.$logged_user->profile_picture)))
                                <img src="{{asset('img/'.$logged_user->profile_picture)}}" height="40" width="40" alt="" class="round img-profile rounded-circle" />
                                @else
                                <img src="{{asset('img/user.png')}}" alt="" height="40" width="40" class="img-profile rounded-circle" />
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0" >
                            <!-- <a class="dropdown-item" href="{{route('admin.profile.index')}}"><i class="bx bx-user mr-50"></i>@lang('messages.header.edit_profile')</a> -->
                            <!-- <a class="dropdown-item" href="#"><i class="bx bx-envelope mr-50"></i> @lang('messages.header.my_inbox')</a>
                            <a class="dropdown-item" href="#"><i class="bx bx-check-square mr-50"></i>@lang('messages.header.task')</a>
                            <a class="dropdown-item" href="#"><i class="bx bx-message mr-50"></i>  @lang('messages.header.chats')</a> -->
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#tejarhLogoutModal"><i class="bx bx-power-off mr-50"></i>
                                @lang('messages.header.logout')
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
<div class="main-menu 
   menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('admin.dashboard')}}">
                    <div class="brand-logo">
                        <img class="logo" width="26px" height="26px" src="{{asset('build/app-assets/images/logo.png')}}">
                    </div>
                    <h2 class="brand-text mb-0">{{env('APP_NAME')}}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">

            <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }} nav-item">
                <a href="{{route('admin.dashboard')}}"><i class="menu-livicon" data-icon="desktop">
                    </i><span class="menu-title text-truncate" data-i18n="Dashboard">@lang('messages.sidebar.dashboard')</span>
                </a>
            </li>
            <!-- user  -->
            @canany('users access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="users">
                    </i><span class="menu-title text-truncate" data-i18n="Menu Levels">@lang('messages.sidebar.users')</span>
                </a>
                <ul class="menu-content" >
                    <li class=" is-shown {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{route('admin.user.index')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.users')</span>
                        </a>
                    </li>
                    
                    <li class=" is-shown {{ request()->is('admin/business-user*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.business_users.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.business_users')</span></a>
                    </li>

                    <li class=" is-shown {{ request()->is('admin/role*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.role.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.roles')</span></a>
                    </li>
                </ul>
            </li>
            @endcanany

           
            <!-- end user -->

            <!--  -->
            @canany('users access')
            <li class="nav-item has-sub" style="display:none">
                <a href="#"><i class="menu-livicon" data-icon="morph-menu-arrow-bottom">
                    </i><span class="menu-title text-truncate" data-i18n="Menu Levels">@lang('messages.sidebar.menus')</span>
                </a>
                <ul class="menu-content">
                    <li class=" is-shown {{ request()->is('admin/site-links*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.menus.site_link.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.site_links')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/popular-city*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.menus.popular_city.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.popular_cities')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/useful-links*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.menus.useful_link.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.useful_links')</span></a>
                    </li>
                </ul>
            </li>
            @endcanany
            <!--  -->

            <!-- stories -->
            @canany('Stories access')
            <li class="nav-item {{ request()->is('admin/story*') ? 'active' : '' }}">
                <a href="{{route('admin.story.index')}}"><i class="menu-livicon" data-icon="idea">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.stories')</span>
                </a>
            </li>
            @endcanany
            <!-- end stories -->

            <!-- product -->
            @canany('Products access')
            <li class="nav-item {{ request()->is('admin/product*') ? 'active' : '' }}">
                <a href="{{route('admin.product.index')}}"><i class="menu-livicon" data-icon="shoppingcart-in">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.products')</span>
                </a>
            </li>
            @endcanany
            <!-- end product -->

            <!-- master -->
            @canany('Master access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="morph-menu-arrow-bottom">
                    </i><span class="menu-title text-truncate" data-i18n="Menu Levels">@lang('messages.sidebar.master')</span>
                </a>
                <ul class="menu-content">
                    <li class=" is-shown {{ request()->is('admin/category*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.category.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.categories')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/sub-category*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.sub_category.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.sub_categories')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/brand*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.brand.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.brands')</span></a>
                    </li>
                   
                    <li class=" is-shown {{ request()->is('admin/condition*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.condition.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.conditions')</span></a>
                    </li>
                    {{-- <li class=" is-shown {{ request()->is('admin/branch*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.branch.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.branches')</span></a>
                    </li> --}}
                    <li class=" is-shown {{ request()->is('admin/store-type*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.store_type.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.store_type')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/delivery-type*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.delivery_type.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.delivery_type')</span></a>
                    </li>
                    <!-- <li class=" is-shown {{ request()->is('admin/ship-mode*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.ship_mode.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.ship_mode')</span></a>
                    </li> -->
                    <li class=" is-shown {{ request()->is('admin/slider*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.slider.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.sliders')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/attribute*') ? 'active' : '' }}"><a class="d-flex align-item-center" href="{{route('admin.attribute.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">Attribute</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/items-attributes-variant*') ? 'active' : '' }}"><a class="d-flex align-item-center" href="{{route('admin.attribute_variant.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">Attribute Variant</span></a>
                    </li>

                    <li class=" is-shown {{ request()->is('admin/support-categories*') ? 'active' : '' }}"><a class="d-flex align-item-center" href="{{route('admin.support-categories.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.support_category')</span></a>
                    </li>

                    <li class="nav-item {{ request()->is('admin/why-use*') ? 'active' : '' }}">
                        <a href="{{route('admin.why_use.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.general')</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/wholesale_general*') ? 'active' : '' }}">
                        <a href="{{route('admin.wholesale_general.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.wholesale_general')</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/short_banner*') ? 'active' : '' }}">
                        <a href="{{route('admin.short_banner.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.short_banner')</span>
                        </a>
                    </li>
                    <!-- blog -->
                    @canany('Blogs access')
                    <li class="nav-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
                        <a href="{{route('admin.blog.index')}}"><i class="bx bx-right-arrow-alt">
                        </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.blog')</span>
                        </a>
                    </li>
                    @endcanany
                    <!-- end blog -->
                </ul>
            </li>
            @endcanany
            <!-- end master -->

            <!-- location -->
            @canany('Locations access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="location-alt">
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">@lang('messages.sidebar.locations')</span>
                </a>
                <ul class="menu-content" >
                    <li class=" is-shown {{ request()->is('admin/location/country*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.location.country.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.countries')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/location/state*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.location.state.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.states')</span></a>
                    </li>

                    <li class=" is-shown {{ request()->is('admin/location/city*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.location.city.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.cities')</span></a>
                    </li>

                </ul>
            </li>
            @endcanany
            <!-- end location -->

            <!-- faqs -->
            @canany('FAQs access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="question-alt">
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">@lang('messages.sidebar.faqs')</span>
                </a>
                <ul class="menu-content" >
                    <li class=" is-shown {{ request()->is('admin/faq*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.faqs.faq.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.faq')</span></a>
                    </li>
                    <li class=" is-shown {{ request()->is('admin/faqs-category*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.faqs.faqs_category.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.faq_category')</span></a>
                    </li>
                </ul>
            </li>
            @endcanany
            <!-- end faqs -->

            <!-- orders -->
            @canany('Orders access')
            <li class="nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <a href="{{route('admin.order.index')}}"><i class="menu-livicon" data-icon="shoppingcart">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.orders')</span>
                </a>
            </li>
            @endcanany
            <!-- end orders -->

            <!-- payment-history -->
            @canany('Payment History access')
            <li class="nav-item {{ request()->is('admin/payment-history*') ? 'active' : '' }}">
                <a href="{{route('admin.payment.index')}}"><i class="menu-livicon" data-icon="us-dollar">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.payment_history')</span>
                </a>
            </li>
            @endcanany
            <!-- end payment-history -->

            <!-- Ticket -->
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-icon tf-icons bx bx-support" >
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">@lang('messages.sidebar.tickets')</span>
                </a>
                <ul class="menu-content">
                    <li class=" is-shown {{ request()->is('admin/ticket*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.ticket.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">General Ticket</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/user-ticket*') ? 'active' : '' }}">
                        <a href="{{route('admin.user-ticket.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">User Ticket</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Ticket -->

            <!-- customer-support -->
            @canany('Customer Support access')
            <li class="nav-item {{ request()->is('admin/customer-support*') ? 'active' : '' }}">
                <a href="{{route('admin.customer_support.index')}}"><i class="menu-icon tf-icons bx bx-support"></i>
                    <span class="menu-title text-truncate" data-i18n="Menu">Customer Support</span>
                </a>
            </li>
            @endcanany
            <!-- end customer-support -->

            <!-- cms -->
            @canany('CMS Pages access')
            <li class="nav-item {{ request()->is('admin/cms*') ? 'active' : '' }}">
                <a href="{{route('admin.cms.index')}}"><i class="menu-livicon" data-icon="servers">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.cms_pages')</span>
                </a>
            </li>
            @endcanany
            <!-- end cms -->

              <!-- Subscription -->
              @canany('Subscription Users access')
              <li class="nav-item {{ request()->is('admin/subscription*') ? 'active' : '' }}">
                <a href="{{route('admin.subscription.index')}}"><i class="menu-livicon" data-icon="servers">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.subscription_users')</span>
                </a>
            </li>
            @endcanany
            <!-- end Subscription -->

            <!-- Subscription -->
           
            <li class="nav-item {{ request()->is('admin/email-logs*') ? 'active' : '' }}">
                <a href="{{route('admin.email_logs.index')}}"><i class="menu-livicon" data-icon="servers">
                    </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.email_logs')</span>
                </a>
            </li>
           
            <!-- end Subscription -->

            <!-- settings -->
            @canany('Account Settings access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="settings">
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">@lang('messages.sidebar.account_settings')</span>
                </a>
                <ul class="menu-content">
                    <!-- <li  class=" is-shown {{ request()->is('admin/profile*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.profile.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.edit_profile')</span></a>
                    </li> -->
                    <li class=" is-shown {{ request()->is('admin/change-password*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.change_password')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.change_password')</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/commission*') ? 'active' : '' }}">
                        <a href="{{route('admin.commission.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.prices')</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ request()->is('admin/story-price*') ? 'active' : '' }}">
                        <a href="{{route('admin.story-price.index')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.story_price')</span>
                        </a>
                    </li> --}}
                    <li class="nav-item {{ request()->is('admin/support*') ? 'active' : '' }}">
                        <a href="{{route('admin.support.settings')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">@lang('messages.sidebar.support')</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcanany
            <!-- end settings -->

            <!-- reports -->
            @canany('Reports access')
            <li class="nav-item has-sub">
                <a href="#"><i class="menu-livicon" data-icon="line-chart">
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">@lang('messages.sidebar.reports')</span>
                </a>
                <ul class="menu-content">
                    <li class=" is-shown {{ request()->is('admin/report*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.report.sales.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">@lang('messages.sidebar.sales')</span></a>
                    </li>
                </ul>
            </li>
            @endcanany
            <!-- end reports -->
            @canany('Role Setting access')
            <li class="nav-item has-sub">
                <a href="#">
                    <i class="menu-livicon" data-icon="line-chart"></i>
                    <span class="menu-title text-truncate" data-i18n="location-alt">Role Setting</span>
                </a>
                <ul class="menu-content">
                    <li class="is-shown {{ request()->is('admin/admin*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{route('admin.admin_index')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Menu">Admin User</span>
                        </a>
                    </li>
                    <li class="is-shown {{ request()->is('admin/admin-role*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{route('admin.admin_role.index')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Menu">Admin Role</span>
                        </a>
                    </li>
                    <li class="is-shown {{ request()->is('admin/permission*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{route('admin.permission.index')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Menu">Admin Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcanany

             <!-- Notification -->
             <li class="nav-item has-sub">
                <a href="#"><i class="menu-icon tf-icons bx bx-support" >
                    </i><span class="menu-title text-truncate" data-i18n="location-alt">App Notification</span>
                </a>
                <ul class="menu-content">
                    <li class=" is-shown {{ request()->is('admin/app-notification*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('admin.app-notification.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Second Level">Group Notification</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/app-notification*') ? 'active' : '' }}">
                        <a href="{{route('admin.app-notification.broad_cast_notification')}}"><i class="bx bx-right-arrow-alt">
                            </i><span class="menu-title text-truncate" data-i18n="Menu">Broadcast Notification</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Notification -->
        </ul>
    </div>
</div>
<!-- END: Main Menu-->