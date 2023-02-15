    /* Business user registration validation */
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
					required: json( __('business_messages.register.business_user.validation.company_name') ),
				},
				"company_legal_name": {
					required: '{{__("business_messages.register.business_user.validation.company_legal_name")}}',
				},
				"owner_manager_name": {
					required: '{{__("business_messages.register.business_user.validation.owner_manager_name")}}',
				},
				"cr_number": {
					required: '{{__("business_messages.register.business_user.validation.cr_number")}}',
				},
				// "upload_cr_file": {
				// 	required: '{{__("business_messages.register.business_user.validation.upload_cr_file")}}',
				// },
				"enter_maroof_number": {
					required: '{{__("business_messages.register.business_user.validation.enter_maroof_number")}}',
				},
				// "upload_maroof_file": {
				// 	required: '{{__("business_messages.register.business_user.validation.upload_maroof_file")}}',
				// },
				"date_of_expiry": {
					required: '{{__("business_messages.register.business_user.validation.date_of_expiry")}}',
				},
				// "vat_certificate_file": {
				// 	required: '{{__("business_messages.register.business_user.validation.vat_number")}}',
				// },
				// "return_policy": {
				// 	required: '{{__("business_messages.register.business_user.validation.return_policy")}}',
				// },
				"bank_name": {
					required: '{{__("business_messages.register.business_user.validation.bank_name")}}',
				},
				"bank_account_number": {
					required: '{{__("business_messages.register.business_user.validation.bank_account_number")}}',
				},
				"iban_number": {
					required: '{{__("business_messages.register.business_user.validation.iban_number")}}',
				},
				"business_email": {
					required: '{{__("business_messages.register.business_user.validation.business_email")}}',
				},
				"phone_number": {
					required: '{{__("business_messages.register.business_user.validation.phone_number")}}',
					number: '{{__("business_messages.register.business_user.validation.validnumber")}}',
					minlength: '{{__("business_messages.register.business_user.validation.minlengthnumber")}}',
					maxlength: '{{__("business_messages.register.business_user.validation.maxlengthnumber")'
				},
				"location": {
					required: '{{__("business_messages.register.business_user.validation.location")}}',
				},
				"district": {
					required: '{{__("business_messages.register.business_user.validation.district")}}',
				},
				"country": {
					required: '{{__("business_messages.register.business_user.validation.country")}}',
				},
                "password":{
                    required:'{{__("business_messages.register.business_user.validation.password")}}',
                    minlength: '{{__("business_messages.register.business_user.validation.minlengthpassword")}}',
                },
                "password_confirmation":{
                    required: '{{__("business_messages.register.business_user.validation.c_password")}}',
                    minlength: '{{__("business_messages.register.business_user.validation.minlengthc_password")}}',
                    equalTo: '{{__("business_messages.register.business_user.validation.passwordequal")}}',
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
				$.ajax({
					type: 'POST',
					processData: false,
					contentType: false,
                    //url: '{{route('frontend.business.register.store')}}',
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
								var loadingText = '{{__("business_user_message.register.buttontext")}}';
								$('.loader_class').prop("disabled", false);
								$this.html(loadingText);
							});

						}
					},
					error: function (data) {
						$('#error_message').addClass('alert-danger').show(function () {
							$(this).html('{{__("business_user_message.register.errormsg.msg")}}');
							$('.loader_class').prop("disabled", false);
							var loadingText = '{{__("business_user_message.register.buttontext")}}';
							$('.loader_class').prop("disabled", false);
							$this.html(loadingText);
						});
					}
				});
			}
		});
	} 