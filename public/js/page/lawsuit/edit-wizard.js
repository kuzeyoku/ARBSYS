"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

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
        });

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });

    };

    var initValidation = function() {
    validator = formEl.validate({
    // Validate only visible fields
    ignore: ":hidden",

    // Validation rules
    rules: {
        delivery_by: {
            required: true
        },
        lawsuit_type_id: {
            required: true
        },
        lawsuit_subject_id: {
            required: true
        },
        lawsuit_subject_type_id: {
            required: true
        },

        //= Step 3
        firm_document_no: {
            required: true
        },
        soother_document_no: {
            required: true
        },
        job_date: {
            required: true,
            application_date_required : true
        },
        application_date: {
            required: true
        },
        process_start_date: {
            required: true
        },
        result_type_id: {
            required: true
        },
        result_date: {
            required: true
        },
        firm: {
            required: true
        }
    },
    // Specify validation error messages
    messages: {
        job_date: {
            application_date_required: "Görevi kabul tarihi , başvuru tarihinden önce olamaz!",
        }
    },

    // Display error
    invalidHandler: function(event, validator) {
        KTUtil.scrollTop();

        if ($("input[name='firm']").val() == "")
        {
            $("input[name='firm']").addClass("is-invalid");
        }
        else
        {
            $("input[name='firm']").removeClass("is-invalid");
        }

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
            // KTApp.unprogress(btn);
            // KTApp.block(formEl);
            if (data.status == true)
            {
                btn.hide();
                back_btn.hide();

                toastr["success"]("Dosya güncellendi. Dosya listesine yönlendiriliyorsunuz...");

                window.location.href = "/dosyalarim";
            }
            else
            {
                toastr["error"]("Dosya günceme işleminde hata oluştu.");
            }
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
