jQuery(function ($) {

	setTimeout(function(){
		 $('.alert').fadeOut(2000).slideUp(200); 
	}, 2000);	

	
    'use strict';

    // Menu
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 150) {
            $('.main-nav').addClass('menu-shrink');
        } else {
            $('.main-nav').removeClass('menu-shrink');
        }
    });	

    // Mean Menu
	jQuery('.mean-menu').meanmenu({
		meanScreenWidth: '991'
	});

	// Modal JS
	$('.modal a').not ('.dropdown-toggle').on('click', function() {
		$('.modal').modal ('hide');
	});

    // Nice Select
    $('select').niceSelect();
	
	// Preloader 
	jQuery(window).on('load', function(){
		jQuery('.loader').fadeOut(500);
	});
	
	// Go Top 
	$(window).on('scroll', function(){
		var scrolled = $(window).scrollTop();
		if (scrolled > 100) $('.go-top').addClass('active');
		if (scrolled < 100) $('.go-top').removeClass('active');
	});  
	$('.go-top').on('click', function() {
		$('html, body').animate({ scrollTop: '0' },  500);
	});

}(jQuery));





$(document).ready(function() {
	$('.hero-slider').owlCarousel({		
		
		margin: 0,
		nav: false,
		dots: true,
		navText: [
			"<i class='bx bx-left-arrow-alt'></i>",
			"<i class='bx bx-right-arrow-alt'></i>"
		],
		items:1,
		smartSpeed:1000,
		autoplay:true,
    	autoplayTimeout:3000,
		loop:true
	});

	$('.hero-slider .owl-dots').wrap('<div class="dots-wrapper"></div>');
	var count_slide = $('.hero-slider .owl-dots .owl-dot').length;
	$('.hero-slider .dots-wrapper').append("<strong class='count-number'>0"+ count_slide +"</strong>")
		
	$('[data-bs-toggle="modal"]').click(function() {
		setTimeout(function () {			
			if ($('.modal').hasClass('show')){
				$('body').addClass('modal-open');
			} 
		}, 1000);
	});

	jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() > 130) {
			jQuery('.mobile-menu-wrapper').addClass('sticky');
			jQuery('.mobile-menu-wrapper').removeClass('non_sticky');
		}
		else {
			jQuery('.mobile-menu-wrapper').removeClass('sticky');
			jQuery('.mobile-menu-wrapper').addClass('non_sticky');
		}
	});


	$('#flexRadioDefault1').click(function(){
		$("#flexRadioDefault2").prop("checked", false);
		$("#flexRadioDefault1").prop("checked", true);
	})

	$(".password i").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
		  input.attr("type", "text");
		} else {
		  input.attr("type", "password");
		}
	});

	$("#user_acc").click(function(){
		setTimeout(function () {	
			$("#whatIsUserModal").modal('show');
		}, 500);		
	});

	$("#bussiness_acc").click(function(){
		setTimeout(function () {	
			$("#business_profileModal").modal('show');
		}, 500);		
	});

	$("#whatIsUserModal .cancle").click(function(){
		setTimeout(function () {	
			$("#signUpModal").modal('show');
		}, 500);		
	});

	$("#business_profileModal .cancle").click(function(){
		setTimeout(function () {	
			$("#signUpModal").modal('show');
		}, 500);		
	});

	$('.more-menu').click(function(){
		$('.mo-nav-menu').slideToggle();
	})

	if($(window).width() < 768){
		$('.footer-area .social-media').insertAfter('.footer-area .footer-menu-wrapper');
	}		

});



$(document).ready(function() {

	var sync1 = $("#product-slider1");
	var sync2 = $("#product-slider2");
	
	var syncedSecondary = true;

	sync1.owlCarousel({
		items: 1,
		slideSpeed: 2000,
		nav: false,
		autoplay: false, 
		dots: false,
		loop: true,
		responsiveRefreshRate: 200,
		navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
	}).on('changed.owl.carousel', syncPosition);

	sync2
		.on('initialized.owl.carousel', function() {
			sync2.find(".owl-item").eq(0).addClass("current");
		})
		.owlCarousel({
			responsive:{
				0:{
					items: 4,
				},
				768:{
					items: 4,
				},
				992:{
					items: 6,
				}
			},
			dots:false,
			nav: false,
			margin:15,
			smartSpeed: 200,
			slideSpeed: 500,
			responsiveRefreshRate: 100
		}).on('changed.owl.carousel', syncPosition2);

	function syncPosition(el) {
		var count = el.item.count - 1;
		var current = Math.round(el.item.index - (el.item.count / 2) - .5);

		if (current < 0) {
			current = count;
		}
		if (current > count) {
			current = 0;
		}

		//end block

		sync2
			.find(".owl-item")
			.removeClass("current")
			.eq(current)
			.addClass("current");
		var onscreen = sync2.find('.owl-item.active').length - 1;
		var start = sync2.find('.owl-item.active').first().index();
		var end = sync2.find('.owl-item.active').last().index();

		if (current > end) {
			sync2.data('owl.carousel').to(current, 100, true);
		}
		if (current < start) {
			sync2.data('owl.carousel').to(current - onscreen, 100, true);
		}
	}

	function syncPosition2(el) {
		if (syncedSecondary) {
			var number = el.item.index;
			sync1.data('owl.carousel').to(number, 100, true);
		}
	}

	sync2.on("click", ".owl-item", function(e) {
		e.preventDefault();
		var number = $(this).index();
		sync1.data('owl.carousel').to(number, 300, true);
	});
});


	$(document).ready(function() {
	
	var $inputs = $("#otpScreenModal .form-control");
	var intRegex = /^\d+$/;

	$inputs.on("input.fromManual", function(){
		if(!intRegex.test($(this).val())){
			$(this).val("");
		}
	});

	$inputs.on("paste", function() {
		var $this = $(this);
		var originalValue = $this.val();		
		$this.val("");
		$this.one("input.fromPaste", function(){
			$currentInputBox = $(this);			
			var pastedValue = $currentInputBox.val();			
			if (pastedValue.length == 5 && intRegex.test(pastedValue)) {
				pasteValues(pastedValue);
			}
			else {
				$this.val(originalValue);
			}
			$inputs.attr("maxlength", 1);
		});		
		$inputs.attr("maxlength", 5);
	});
	function pasteValues(element) {
		var values = element.split("");

		$(values).each(function(index) {
			var $inputBox = $('#otpScreenModal .form-control[id="chars[' + (index + 1) + ']"]');
			$inputBox.val(values[index])
		});
	};

	var totalCheckboxes = $('.wishlist-wrapper input:checkbox').length;

	$(".wishlist-table input.parent").on('click',function(){
		var _parent=$(this);
		var nextli=$(this).parent().parent().parent();
		console.log(nextli);
		
		if(_parent.prop('checked')){		   
			   $( ".child" ).prop('checked',true);
		}
		else{
			$( ".child" ).prop('checked',false);
		}
	});
	$(".child").change(function(){
		var numberOfChecked = $('.wishlist-wrapper input:checkbox:checked.child').length;
		if($('.child').prop('checked')){		   
			$( ".parent" ).prop('checked',true);
		}
		else{
			$( ".parent" ).prop('checked',false);
		}	
		
		if((totalCheckboxes-1) == numberOfChecked){
			$( ".parent" ).prop('checked',true);
		}
		else{
			$( ".parent" ).prop('checked',false);
		}			
	});



	$('#resetPasswordModal button').click(function(){
		$.cookie('resetPasswordModal', '1', { expires: 1 });
	})
	
	if ($.cookie('resetPasswordModal') == '1'){
		$("#loginModal").modal('show');
		$.cookie('resetPasswordModal', null);
	}

	
});


function readURL101(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah101')
				.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah')
				.attr('src', e.target.result);
		};

		reader.onload = function (e) {
			$('#blah1')
				.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
function readURL1(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img1')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL2(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img2')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL3(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img3')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL4(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img4')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL5(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img5')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL6(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-img6')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}
function readURL7(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#uploading-story-img')			
				.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function readURL9(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah9')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}

function readURL10(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			
			let fileName, fileExtension;
			fileName = e.target.result;
			var res = fileName.substring(0, 10);
			
			fileExtension = fileName.split('.').pop();
			

			if(res === "data:image"){
				$('#blah10')			
				.attr('src', e.target.result);
				
				$('#video10')			
				.attr('src', '');
				$('#video10').css('display','none');
				$('#blah10').css('display','block');
				
			}
			else{				
				$('#video10')			
				.attr('src', e.target.result);
				$('#blah10')			
				.attr('src', '');

				$('#blah10').css('display','none');
				$('#video10').css('display','block');

				
						
			}
			
		};
		reader.readAsDataURL(input.files[0]);
	}
}


function readURL13(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah13')			
				.attr('src', e.target.result);
				

				let fileName;
				fileName = e.target.result;
				var res = fileName.substring(0, 10);
			
				if(res === "data:image"){
					setTimeout(function () {
						$('#banner_submit_btn').trigger("click");
					},1000);
				}				
		};
		reader.readAsDataURL(input.files[0]);
		
	}
}
function readURL14(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah14')
				.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function readURL100(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah100')
				.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function readURL101(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#post-item-imgEdit')
				.attr('src', e.target.result);
		};


		reader.readAsDataURL(input.files[0]);
	}
}

function fileValidation() {
	var fileInput = 
		document.getElementById('file');
	  
	var filePath = fileInput.value;
  
	// Allowing file type
	var allowedExtensions = 
			/(\.jpg|\.jpeg|\.png|\.gif)$/i;
	  
	if (!allowedExtensions.exec(filePath)) {
		alert('Invalid file type');
		fileInput.value = '';
		return false;
	} 
	else 
	{
	  
		// Image preview
		if (fileInput.files && fileInput.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById(
					'imagePreview').innerHTML = 
					'<img src="' + e.target.result
					+ '"/>';
			};
			  
			reader.readAsDataURL(fileInput.files[0]);
		}
	}
}









  $(document).ready(function(){

	$('.us-lan').click(function() {
		$.cookie('india', 'english', { expires: 1 });
		$.cookie('arabic', null);
	});
	$('.arabic-lan').click(function() {
	  $.cookie('arabic', 'arabic', { expires: 1 });
	  $.cookie('india', null);
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

	$('.business-sign-up-btn').css('display','none');
	$('#user_acc').click(function(){
		$('.signupstep2-btn').css('display','block');
		$('.business-sign-up-btn').css('display','none');
	})
	$('#bussiness_acc').click(function(){
		$('.signupstep2-btn').css('display','none');
		$('.business-sign-up-btn').css('display','block');
	})
	$('input[type="file"]').change(function() {
		var i = $(this).next('h5').clone();
		var file = $(this)[0].files[0].name;
		$(this).next('h5').text(file);
	});
	$('.role-user .edit i').click(function(){
		$(this).siblings("ul").slideToggle();
	})

	

})




	// external js: isotope.pkgd.js
	// init Isotope
	var $grid = $('.grid').isotope({
		itemSelector: '.element-item',
		layoutMode: 'fitRows'
	});
	// filter functions
	var filterFns = {
		// show if number is greater than 50
		numberGreaterThan50: function() {
		var number = $(this).find('.number').text();
		return parseInt( number, 10 ) > 50;
		},
		// show if name ends with -ium
		ium: function() {
		var name = $(this).find('.name').text();
		return name.match( /ium$/ );
		}
	};
	// bind filter button click
	$('.filters-button-group').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		filterValue = filterFns[ filterValue ] || filterValue;
		$grid.isotope({ filter: filterValue });
	});
	// change is-checked class on buttons
	$('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
		$buttonGroup.find('.is-checked').removeClass('is-checked');
		$( this ).addClass('is-checked');
		});
	});

	//new pages

	$(document).ready(function(){
		// Accoridian
	$(".set > a").on("click", function() {
		if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			$(this)
				.siblings(".set .content")
				.slideUp(200);
			$(".set > a i")
				.removeClass("fa-minus")
				.addClass("fa-plus");
			} else {
			$(".set > a i")
				.removeClass("fa-minus")
				.addClass("fa-plus");
			$(this)
				.find("i")
				.removeClass("fa-plus")
				.addClass("fa-minus");
			$(".set > a").removeClass("active");
			$(this).addClass("active");
			$(".set .content").slideUp(200);
			$(this)
				.siblings(".set .content")
				.slideDown(200);
			}
		});
	})

/* Business store expired date validation */
function date_of_expiry(){
	$(function(){
		var dtToday = new Date();
		
		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10)
			month = '0' + month.toString();
		if(day < 10)
			day = '0' + day.toString();
		
		var minDate= year + '-' + month + '-' + day;
		
		$('.date_of_expiry').attr('min', minDate);
	});
}
/* Business user registration validation */

function businessUsersValidation(){
	
	if ($("#businessRegiModal").length > 0) {
		$("#businessRegiModal").validate({
			ignore: "not:hidden",
			onfocusout: function (element) {
				this.element(element);
			},
			rules: {
				"company_name": {
					required: true,
				},
				"company_legal_name": {
					required: true,
				},
				"owner_manager_name": {
					required: true,
				},
				"cr_number": {
					required: true,
				},
				// "upload_cr_file": {
				// 	required: true,
				// },
				"enter_maroof_number": {
					required: true,
				},
				// "upload_maroof_file": {
				// 	required: true,
				// },
				"date_of_expiry": {
					required: true,
				},
                "vat_number": {
					required: true,
                    number: true,
				},
				// "vat_certificate_file": {
				// 	required: true,
				// },
				// "return_policy": {
				// 	required: true,
				// },
				"bank_name": {
					required: true,
				},
				"bank_account_number": {
					required: true,
				},
				"iban_number": {
					required: true,
				},
				"business_email": {
					required: true,
				},
				"phone_number": {
				    required: true,
					number: true,
					minlength: 10,
					maxlength: 10
				},
				"location": {
					required: true,
				},
				"district": {
					required: true,
				},
				"country": {
					required: true,
				},
				"password":{
                    required:true,
                    minlength:6,    
                },
                "password_confirmation": {
                    required: true,
                    minlength: 6,
                    equalTo: "#sign_up_password_business_user"
                }
			},
			messages: {
				"company_name": {
					
					required: '<?php echo lang("business_messages.register.business_user.validation.company_name") ?>',
				},
				"company_legal_name": {
					required: '@lang("business_messages.register.business_user.validation.company_legal_name")',
				},
				"owner_manager_name": {
					required: '@lang("business_messages.register.business_user.validation.owner_manager_name")',
				},
				"cr_number": {
					required: '@lang("business_messages.register.business_user.validation.cr_number")',
				},
				// "upload_cr_file": {
				// 	required: '@lang("business_messages.register.business_user.validation.upload_cr_file")',
				// },
				"enter_maroof_number": {
					required: '@lang("business_messages.register.business_user.validation.enter_maroof_number")',
				},
				// "upload_maroof_file": {
				// 	required: '@lang("business_messages.register.business_user.validation.upload_maroof_file")',
				// },
				"date_of_expiry": {
					required: '@lang("business_messages.register.business_user.validation.date_of_expiry")',
				},
                "vat_number": {
                    required: '@lang("business_messages.register.business_user.validation.enter_vat_number")',
				},
				// "vat_certificate_file": {
				// 	required: '@lang("business_messages.register.business_user.validation.vat_certificate_file")',
				// },
				"return_policy": {
					required: '@lang("business_messages.register.business_user.validation.return_policy")',
				},
				"bank_name": {
					required: '@lang("business_messages.register.business_user.validation.bank_name")',
				},
				"bank_account_number": {
					required: '@lang("business_messages.register.business_user.validation.bank_account_number")',
				},
				"iban_number": {
					required: '@lang("business_messages.register.business_user.validation.iban_number")',
				},
				"business_email": {
					required: '@lang("business_messages.register.business_user.validation.business_email")',
				},
				"phone_number": {
					required: '@lang("business_messages.register.business_user.validation.phone_number")',
					number: '@lang("business_messages.register.business_user.validation.validnumber")',
					minlength: '@lang("business_messages.register.business_user.validation.minlengthnumber")',
					maxlength: '@lang("business_messages.register.business_user.validation.maxlengthnumber")'
				},
				"location": {
					required: '@lang("business_messages.register.business_user.validation.location")',
				},
				"district": {
					required: '@lang("business_messages.register.business_user.validation.district")',
				},
				"country": {
					required: '@lang("business_messages.register.business_user.validation.country")',
				},
                "password":{
                    required:'@lang("business_messages.register.business_user.validation.password")',
                    minlength: '@lang("business_messages.register.business_user.validation.minlengthpassword")',
                },
                "password_confirmation":{
                    required: '@lang("business_messages.register.business_user.validation.c_password")',
                    minlength: '@lang("business_messages.register.business_user.validation.minlengthc_password")',
                    equalTo: '@lang("business_messages.register.business_user.validation.passwordequal")',
                }
			},
			submitHandler: function (form) {
				var $this = $('#businessRegiModal .loader_class');
				var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
				$('#businessRegiModal .loader_class').prop("disabled", true);
				$this.html(loadingText);
				form.submit();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				var formdata = new FormData(document.getElementById("businessRegiModal"));

                $("#sla-certificate").modal('show');
                $('#business-sign-up').modal('hide')

                $('#agree-to-continue').click(function() {
                    if ($('#acceptAgreeSubmit').is(':disabled')) {
                        $('#acceptAgreeSubmit').removeAttr('disabled');
                    } else {
                        $('#acceptAgreeSubmit').attr('disabled', 'disabled');
                    }
                });

                let owner = $("[name='owner_manager_name']").val();
                let manager = $("[name='owner_manager_name']").val();
                let companyName = $("[name='company_name']").val();
                let storeName = $("[name='owner_manager_name']").val();
                let cr_number = $("[name='cr_number']").val();
                let city_id_as_address = $( "#city-dropdown option:selected" ).text();
                let phoneNumber = document.getElementById("getPhoneNumber").value;
    
                $("#owner").html(owner);
                $("#manager").html(manager);
                $("#companyName").html(companyName);
                $("#storeName").html('store name');
                $("#setPhoneNumber").html(phoneNumber);
                $("#cr_number").html(cr_number);
                $("#city_id_as_address").html(city_id_as_address);

                $('.slaCertificateBtn').click(function(e) {
                    $.ajax({
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        url: '<?php {{route("frontend.business.register.store")}} ?>',
                        data: formdata,
                        success: function (data) {
                            if (data.code === 200) {
                                $('#success_message').addClass('alert-success').show(function () {
                                    $(this).html(data.success);
                                    document.getElementById("businessRegiModal").reset();
                                    setTimeout(function () {
                                        $('body').removeClass('modal-open');
                                        $('.modal').removeClass('show');
                                        $('body').css('overflow', 'visible');
                                        $('.modal-backdrop').removeClass('show');
                                    }, 2000)
                                    $('.loader_class').prop("disabled", false);
                                    var loadingText = '@lang("business_user_message.register.buttontext")';
                                    $('.loader_class').prop("disabled", false);
                                    $this.html(loadingText);
                                });
                            }
                        },
                        error: function (data) {
                            $('#error_message').addClass('alert-danger').show(function () {
                                $(this).html('@lang("business_user_message.register.errormsg.msg")');
                                $('.loader_class').prop("disabled", false);
                                var loadingText = '@lang("business_user_message.register.buttontext")';
                                $('.loader_class').prop("disabled", false);
                                $this.html(loadingText);
                            });
                        }
                    });
                });
			}
		});
	} 
}