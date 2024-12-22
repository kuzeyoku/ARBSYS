"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var preview = 0;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v4', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}

			if (wizardObj.currentStep === 3)
			{
                if (previewRequiredControl() === 1)
                {
                    wizardObj.stop();

                    swal.fire({
                        "title": "",
                        "text": "Lütfen gerekli alanları boş geçmeyiniz",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
			}
			else if (wizardObj.currentStep === 2)
            {
                $(".side_payment_price").each(function () {
                    console.log($(this).val());
                    console.log($(this).data('id'));
                    if ($(this).val() !== 0) {
                        $("#side_payment_date_"+$(this).data('id')).rules("add", {
                            required: true
                        });

                        // $("#side_payment_date_"+$(this).data('id')).rules("add", {
                        //     required: true,
                        //     minlength:3
                        // });
                    }
                });

                var total_price = 0;
                var paid_price = parseFloat($('input[name="price"]').maskMoney('unmasked')[0]);

                $(".side_payment_price").each(function () {
                    total_price += parseFloat($(this).maskMoney('unmasked')[0]);
                });

                console.log(paid_price);
                console.log(total_price);

                if (paid_price !== total_price)
                {
                    wizardObj.stop();

                    swal.fire({
                        "title": "",
                        "text": "Toplam arabuluculuk ücreti ile taraflara yansıtılan ücret eşit olmadılır!",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }

            }
		});

		wizard.on('beforePrev', function(wizardObj) {
			// if (validator.form() !== true) {
			// 	wizardObj.stop();  // don't go to the next step
			// }
		});

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();
            if (wizard.getStep() === 3 && preview == 0)
            {
                formEl.ajaxSubmit({
                    url:$("#preview-area").data('url'),
                    success: function(data) {
                        $("#preview-area").val(data.preview);
                        createEditor("#preview-area");
                        preview = 1;
                    }
                });
            }
            if (wizard.getStep() == 4)
            {
                $('[data-ktwizard-type="action-submit"]').click();
            }
		});
	};
	var initValidation = function() {
        validator = formEl.validate({
            lang: "tr",
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                //= Step 1
                wage_type:{
                    required:true
                },
                money:{
                    required:true
                },
                //= Step 2
                hour:{
                    required:true
                },
                price:{
                    required:true
                }

            },

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "Lütfen gerekli alanları boş geçmeyiniz",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});
	}

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');
		var back_btn = formEl.find('[data-ktwizard-type="action-prev"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
                    success: function(data) {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

                        $('.print_side').html(data.preview);

                        btn.hide();
                        back_btn.hide();

                        $("#saved").show();
                        $("#before_saved").hide();

                        swal.fire({
                            "title": "",
                            "text": "Evrak başarıyla kaydedildi.",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        });
					}
				});
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#kt_form');

			initWizard();
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard4.init();
});
