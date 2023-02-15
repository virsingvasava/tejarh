
@if(Auth::check() && Auth::user()->role == BUSINESS_ROLE)
    @include('frontend.business.includes.footer') 
@else 
<footer class="footer-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                       
                    </div>
                    <div class="col-md-4">
                        <div class="footer-logo">
                            <a href="#">
                                <img src="{{asset('assets/images/tejarh-white-logo.png')}}" alt="Tejarh Logo">
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="social-media">
                                <h5>Follow us:</h5>
                                <ul>
                                    <li><a href="#"><img src="{{asset('assets/images/facebook.png')}}"></a></li>
                                    <li><a href="#"><img src="{{asset('assets/images/instagram.png')}}"></a></li>
                                    <li><a href="#"><img src="{{asset('assets/images/pinterest.png')}}"></a></li>
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
                <p>Copyright © 2020-21 <a href="#" target="_blank">Tejarh MarketPlace</a> All rights reserved.</p>
            </div>
        </div>
    </div>
    <!-- End Copyright -->

    <!-- Go Top -->
    <div class="go-top">
        <i class='bx bxs-up-arrow-circle'></i>
        <i class='bx bxs-up-arrow-circle'></i>
    </div>
    <!-- End Go Top -->

    <!-- Essential JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Form Validator JS -->
    <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <!-- Contact JS -->
    <script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
    <!-- Ajax Chip JS -->
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Mean Menu JS -->
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <!-- Revolution JS -->
    <script src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }} "></script>
    <script src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }} "></script>
    <!-- Mixitup JS -->
    <script src="{{ asset('assets/js/jquery.mixitup.min.js') }} "></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }} "></script>
    <!-- Modal Video JS -->
    <script src="{{ asset('assets/js/jquery-modal-video.min.js') }}"></script>    
    <!-- magnific-popup -->    
    <script src="https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>    
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
    }); 
</script>
@endif