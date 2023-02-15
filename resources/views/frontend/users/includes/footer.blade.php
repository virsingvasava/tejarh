
    <footer class="footer-area">
        <div class="container">    
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="footer-menu-wrapper" style="display:none">
                        <div class="footer-menu">
                            <h5>SITE LINKS</h5>
                            <ul>
                                @if(!empty($sitelinksMenu) && count($sitelinksMenu) > 0)
                                    @foreach($sitelinksMenu as $menu)
                                        <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                    @endforeach 
                                @endif
                            </ul>
                        </div>
                        <div class="footer-menu">
                            <h5>POPULAR CITIES</h5>
                            <ul>
                            @if(!empty($popularcitiesMenu) && count($popularcitiesMenu) > 0)
                                @foreach($popularcitiesMenu as $menu)
                                    <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                @endforeach 
                            @endif   
                            </ul>
                        </div>
                        <div class="footer-menu two-listing">
                            <h5>USEFUL LINKS</h5>
                            <ul>
                            @if(!empty($usefullinksMenu) && count($usefullinksMenu) > 0)
                                @foreach($usefullinksMenu as $menu)
                                    <li><a href="{{$menu['url']}}">{{$menu['name']}}</a></li>
                                @endforeach 
                            @endif       
                            </ul>
                        </div>
                    </div>
                    <div class="footer-menu-wrapper">
                        <div class="footer-menu">
                            <h5>@lang('business_messages.footer_menu.site_links')</h5>
                            <ul>
                                <li><a href="{{ route('frontend.users.about-us.aboutUs') }}">@lang('business_messages.footer.site_links.about_us')</a></li>
                                <li><a href="{{ route('frontend.users.location.location') }}">@lang('business_messages.footer.site_links.locations')</a></li>
                                <li><a href="{{ route('frontend.users.coupons-Offers.couponsOffers') }}">@lang('business_messages.footer.site_links.coupons_offers')</a></li>
                                <li><a href="{{ route('frontend.users.Contact-Us.contactUs') }}">@lang('business_messages.footer.site_links.contact_us')</a></li>
                                <li><a href="{{ route('frontend.users.Careers.careers') }}">@lang('business_messages.footer.site_links.careers')</a></li>
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
                                {{-- <li><a href="{{ route('frontend.users.Contact-Us.contactUs') }}">@lang('business_messages.footer.useful_links.contact_us')</a></li> --}}
                                <li><a href="{{ route('frontend.users.faq.faq') }}">@lang('business_messages.footer.useful_links.faq')</a></li>
                                <li><a href="{{ route('frontend.users.terms-condition.termsCondition') }}">@lang('business_messages.footer.useful_links.tc')</a></li>
                                <li><a href="{{ route('frontend.users.term-of-use.termsOfUse') }}">@lang('business_messages.footer.useful_links.term_of_use')</a></li>
                                <li><a href="{{ route('frontend.users.track-order.trackOrder') }}">@lang('business_messages.footer.useful_links.track_orders')</a></li>
                                <li><a href="{{ route('frontend.users.shipping.shipping') }}">@lang('business_messages.footer.useful_links.shipping')</a></li>
                                <li><a href="{{ route('frontend.users.cancellation.cancellation') }}">@lang('business_messages.footer.useful_links.cancellation')</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('frontend.users.return.returnOrder') }}">@lang('business_messages.footer.useful_links.returns')</a></li>
                                <!-- <li><a href="#">@lang('business_messages.footer.useful_links.whitehat')</a></li> -->
                                <li><a href="{{ route('frontend.users.blogs.index') }}">@lang('business_messages.footer.useful_links.blog')</a></li>
                                {{-- <li><a href="{{ route('frontend.users.Careers.careers') }}">@lang('business_messages.footer.useful_links.careers')</a></li> --}}
                                <li><a href="{{ route('frontend.users.privacy-policy.privacyPolicy') }}">@lang('business_messages.footer.useful_links.privacy_policy')</a></li>
                                <li><a href="{{ route('frontend.users.site-map.siteMap') }}">@lang('business_messages.footer.useful_links.site_map')</a></li>
                                <li>
                                    @if (Auth::check())
                                    <a href="{{ route('frontend.users.support.index') }}">@lang('business_messages.footer.useful_links.supports')</a>
                                    @else
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="wish-list-icon">                                    
                                    @lang('business_messages.footer.useful_links.supports')
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-logo">
                        <a href="{{route('frontend.users.site.index')}}">
                            <img src="{{asset('assets/images/tejarh-white-logo.png')}}" alt="Tejarh Logo">
                        </a>
                        <p>@lang('business_messages.footer_menu.logo_text')</p>
                        <div class="social-media">
                            <h5>@lang('business_messages.footer_menu.follow_us')</h5>
                            <ul>
                                <li><a target="_blank" href="https://www.facebook.com/"><img src="{{asset('assets/images/facebook.png')}}"></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/"><img src="{{asset('assets/images/instagram.png')}}"></a></li>
                                <!-- <li><a href="#"><img src="{{asset('assets/images/pinterest.png')}}"></a></li> -->
                            </ul>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright -->
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-item">
                <p>@lang('business_messages.footer_menu.copyright') © <?php echo date("Y"); ?> <a href="#" target="_blank"> @lang('business_messages.footer_menu.tejarh_market_place')</a> @lang('business_messages.footer_menu.all_rights_reserved')</p>
            </div>
        </div>
    </div>
    <!-- End Copyright -->

    <div class="mobile-sell-now-btn">
        <a href="{{route('frontend.users.post-items.index')}}">@lang('business_messages.menu.sell_now')</a>
    </div>
        
    <!-- Go Top -->
    <div class="go-top">
        <i class='bx bxs-up-arrow-circle'></i>
        <i class='bx bxs-up-arrow-circle'></i>
    </div>
    <!-- End Go Top -->

    <!-- Essential JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronted/users_flow/assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('fronted/users_flow/assets/js/bootstrap.min.js') }}"></script>
    <!-- Form Validator JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/form-validator.min.js') }}"></script>
    <!-- Contact JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/contact-form-script.js') }}"></script>
    <!-- Ajax Chip JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Mean Menu JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.meanmenu.js') }}"></script>
    <!-- Revolution JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.themepunch.tools.min.js') }} "></script>
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.themepunch.revolution.min.js') }} "></script>
    <!-- Mixitup JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.mixitup.min.js') }} "></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/owl.carousel.min.js') }} "></script>
    <!-- Modal Video JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/jquery-modal-video.min.js') }}"></script>    
    <!-- magnific-popup -->    
    <script src="https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{ asset('fronted/users_flow/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('fronted/users_flow/assets/js/custom.js') }}"></script>
    <script src="{{ asset('fronted/users_flow/assets/toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('fronted/users_flow/assets/js/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/custom.js') }}"></script>  -->
    @php 
        $route_name = \Request::route()->getName(); 
    @endphp 
 <script>
    $( document ).ready(function() {
        if (window.location.href.indexOf("resetpassword") > -1) {
        $('#otpScreenModal').addClass('show');
        $('#otpScreenModal').css('display','block');
        $('body').addClass('modal-open');
        $('body').append('<div class="modal-backdrop fade show"></div>');
    }
    $('.us-lan').click(function() {
        $.cookie('india', 'english', { expires: 1 });
        $.cookie('arabic', null);

        var lang =  $(this).data("langauge12");
        var token = "{{csrf_token()}}";
        var currentUrl = "{{\URL::current()}}";
        $.ajax({
            url: '{{route("lang.post")}}',
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
            url: '{{route("lang.post")}}',
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
    }); 
</script>
  

@if(in_array($route_name, [
    'frontend.users.site.index',
    'frontend.users.profile.index',
    'frontend.users.promoted-items.item_details',
    'frontend.users.new-items.item_details',
    'frontend.users.used-items.item_details',
    'frontend.users.unused-items.item_details',
    'frontend.users.boost-items.item_details',
    'frontend.users.my-items.index',
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
                url: '{{ route("frontend.users.wishlist.add_to_wishlist") }}',
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

        
        $(document).ready(function() {
            $("#b_add_story").validate({
                ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    // "story_image_name": {
                    //     required: true,
                    // },
                    "product_name": {
                        required: true,
                    },
                    "category_id": {
                        required: true,
                    },
                    "story_description": {
                        required: true,
                    },
                    "product_price": {
                        required: true,
                    },
                    "store_location": {
                        required: true,
                    },
                },
                messages: {

                    // "story_image_name": {
                    //     required: "{{ __('business_messages.story.validation.video_or_image')}}",
                    // },
                    "product_name": {
                        required: "{{ __('business_messages.story.validation.productname')}}",
                    },
                    "category_id": {
                        required: "{{ __('business_messages.story.validation.category_id')}}",
                    },
                    "story_description": {
                        required: "{{ __('business_messages.story.validation.description')}}",
                    },
                    "product_price": {
                        required: "{{ __('business_messages.story.validation.productprice')}}",
                    },
                    "store_location": {
                        required: "{{ __('business_messages.story.validation.storelocation')}}",
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
    'frontend.users.promoted-items.item_details',
    'frontend.users.new-items.item_details',
    'frontend.users.used-items.item_details',
    'frontend.users.unused-items.item_details',
    'frontend.users.boost-items.item_details',
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
                url: "{{ route('frontend.users.userlike.add_to_like') }}",
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
    'frontend.users.likelist.index',
    ]))
    <script type="text/javascript">
        $(document).ready(function() {
            $('.likelist_delete').click(function() {
                var likelist_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.users.likelist.likelist_removed') }}",
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
                toastr.success("{{ Session::get('success') }}");
            @elseif(Session::has('error'))
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
    'frontend.users.wishlist.index',
    ]))
    <script type="text/javascript">
        $(document).ready(function() {
            $('.wishlist_delete').click(function() {
                var wishlist_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.users.wishlist.wishlist_removed') }}",
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
@if(in_array($route_name, [
    'frontend.users.profile.index',
    'frontend.users.pages.import_images'
    ]))
    <script type="text/javascript">

        $(document).on('click','.post_delete_user',function(){
            $('#profile_post_delete_user').modal('show');
            $('.post_id').val($(this).attr('data-id'));
        })

        $(document).on('click','.import_img_delete',function(){
            $('#import_images_post_delete').modal('show');
            $('.image_id').val($(this).attr('data-id'));
        })

        


        // $(document).ready(function() {
        //     $('.post_delete').click(function() {
        //         var post_id = $(this).data('id');
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ route('frontend.users.profile.post_removed') }}",
        //             data: {
        //                 post_id:post_id,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'JSON',
        //             success: function (result) {
        //                 toastr.success(result.success);
        //                 setTimeout(function(){ location.reload(); }, 1000);
        //             },
        //             error: function(err){
        //                 toastr.error(result.error);
        //             }
        //         });
        //     });
        //     toastr.options.timeOut = 10000;
        //     @if (Session::has('success'))
        //         toastr.success('{{ Session::get('success') }}');
        //     @elseif(Session::has('error'))
        //         toastr.error('{{ Session::get('error') }}');
        //     @elseif(Session::has('warning'))
        //         toastr.error('{{ Session::get('warning') }}');
        //     @elseif(Session::has('info'))
        //         toastr.error('{{ Session::get('info') }}');
        //     @endif
        // });
    </script>
@endif

@php 
$boost_items_url = request()->segments(); 
@endphp
@if(!empty($boost_items_url['0']))
    @if ($boost_items_url['0'] == 'boost-items')
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
                        url: "{{ route('frontend.users.boost-items.boost_items_payment_details')}}",
                        data: {
                            itemId : itemId,
                            itemBoostPrice: itemBoostPrice, 
                            payment_id: payment_id, 
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function(result) {
                            toastr.success(result.success);
                            window.location.href = "{{ url('boost-items/boost_items_payment/') }}" + '/' + itemId;
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

@php 
$productAuthor_profile = request()->segments();
@endphp

@if(!empty($productAuthor_profile['0']))
    @if ($productAuthor_profile['0'] == 'profile-seller')
 
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
    </style>


<script src="{{ asset('fronted/business_flow/assets/js/profille_slider/b_seller_profile_slider.js') }}"></script>
    @endif
@endif

<script type="text/javascript">
    // $("#b_make_an_offer1").validate({
    //     ignore: "not:hidden",
    //     onfocusout: function(element) {
    //         this.element(element);
    //     },
    //     rules: {
    //         "offer_price": {
    //             required: true,
    //         },
    //         "offer_message": {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         "offer_price": {
    //             required: '{{__("business_messages.make_an_offer.validation.enter_offer_price")}}',
    //         },
    //         "offer_message": {
    //             required: '{{__("business_messages.make_an_offer.validation.write_your_message")}}',
    //         },
    //     },
    //     submitHandler: function(form) {
    //         var $this = $('.loader_class');
    //         var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
    //         $('.loader_class').prop("disabled", true);
    //         $this.html(loadingText);
    //         form.submit();
    //     }
    // });

    // $('.or_make_an_offer1').click(function() {
    //     var make_an_offer_itemIt = $(this).data('id'); 
    //     $.ajax({
    //         type: "POST",
    //         url: '{{ route("frontend.users.make-an-offer.make_an_offer") }}',
    //         data: {
    //             item_Id:make_an_offer_itemIt,
    //             _token: '{{ csrf_token() }}'
    //         },
    //         dataType: 'JSON',
    //         success: function (response) {
    //             $.each(response, function (key, makeAnOffer) { 
    //                 /*Profile Image*/
    //                 var authProfileUrl = "{{ URL::asset(USERS_SELLER_PROFILE_FOLDER)}}";
    //                 $("#product-author-profile").attr('src', authProfileUrl + '/' + makeAnOffer['user']['profile_picture']);

    //                 var itemImgUrl = "{{ URL::asset(USERS_ITEMS_POST_FOLDER)}}";
    //                 $("#item-picture-7000").attr('src', itemImgUrl + '/' + makeAnOffer['item_pictures']['item_picture1']);
                    
    //                 var itemPrice = $('#get_item_price').val();
    //                 $('#make_an_offer_item_price').text(itemPrice);

    //                 $('#product-author-name').text(makeAnOffer['user']['first_name']);

    //                 var membershipDate = $('#get-item-user-membership').val();
    //                 $('#product-author-member-date').text(membershipDate);
    //                 $('#setProductAuthorId_make_an_offer').val(makeAnOffer['user_id']);
    //                 $('#setProductId_make_an_offer').val(makeAnOffer['id']);
    //                 $('#setProductPrice_make_an_offer').val(makeAnOffer['price']);
                    
    //             });
    //         },
    //     });
    // });

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

    $('.us-lan').click(function() {
		$.cookie('india', 'english', { expires: 1 });
		$.cookie('arabic', null);
        var lang =  $(this).data("langauge12");
        var token = "{{csrf_token()}}";
        var currentUrl = "{{\URL::current()}}";
        $.ajax({
            url: '{{route("lang.post")}}',
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
            url: "{{route('lang.post')}}",
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
