"use strict";

// Class definition
var KTWizard4 = (function () {
  // Base elements
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
  var saved = 0;
  var preview = 0;

  // Private functions
  var initWizard = function () {
    // Initialize form wizard
    wizard = new KTWizard("kt_wizard_v4", {
      startStep: 1, // initial active step number
      clickableSteps: true, // allow step clicking
    });

    // Validation before going to next page
    wizard.on("beforeNext", function (wizardObj) {
      if (validator.form() !== true) {
        wizardObj.stop(); // don't go to the next step
      }
      console.log(wizardObj.currentStep);

      if (wizardObj.getStep() === 4) {
        if (previewRequiredControl() === 1) {
          wizardObj.stop();

          swal.fire({
            title: "",
            text: "Lütfen gerekli alanları boş geçmeyiniz",
            type: "error",
            confirmButtonClass: "btn btn-secondary",
          });
        }
      }
    });

    wizard.on("beforePrev", function (wizardObj) {
      // if (validator.form() !== true) {
      // 	wizardObj.stop();  // don't go to the next step
      // }
    });

    // Change event
    wizard.on("change", function (wizard) {
      KTUtil.scrollTop();
      if (wizard.getStep() === 3 && preview == 0) {
        formEl.ajaxSubmit({
          url: $("#preview-area").data("url"),
          success: function (data) {
            if (saved !== 1) {
              $("#preview-area").val(data);
              $("#preview-area").summernote({});
            }
            preview = 1;
          },
        });
      }

      if (wizard.getStep() == 4) {
        $('[data-ktwizard-type="action-submit"]').click();
      }
    });
  };
  var initValidation = function () {
    validator = formEl.validate({
      lang: "tr",
      // Validate only visible fields
      ignore: ":hidden",

      // Validation rules
      rules: {
        //= Step 1
        work_name: {
          required: true,
        },
        work_time: {
          required: true,
        },
        chamber_of_commerce: {
          required: true,
        },
        date: {
          required: true,
        },
        number: {
          required: true,
        },
        page: {
          required: true,
        },
      },

      // Display error
      invalidHandler: function (event, validator) {
        KTUtil.scrollTop();

        swal.fire({
          title: "",
          text: "Lütfen gerekli alanları boş geçmeyiniz",
          type: "error",
          confirmButtonClass: "btn btn-secondary",
        });
      },

      // Submit valid form
      submitHandler: function (form) {},
    });
  };

  var initSubmit = function () {
    var btn = formEl.find('[data-ktwizard-type="action-submit"]');
    var back_btn = formEl.find('[data-ktwizard-type="action-prev"]');

    btn.on("click", function (e) {
      e.preventDefault();

      if (validator.form()) {
        // See: src\js\framework\base\app.js
        KTApp.progress(btn);
        //KTApp.block(formEl);
        // See: http://malsup.com/jquery/form/#ajaxSubmit
        formEl.ajaxSubmit({
          success: function (data) {
            KTApp.unprogress(btn);
            //KTApp.unblock(formEl);

            btn.hide();
            back_btn.hide();

            $("#saved").show();
            $("#before_saved").hide();

            $(".print_side").html(data);

            saved = 1;

            swal.fire({
              title: "",
              text: "Evrak başarıyla kaydedildi.",
              type: "success",
              confirmButtonClass: "btn btn-secondary",
            });
          },
        });
      }
    });
  };

  return {
    // public functions
    init: function () {
      wizardEl = KTUtil.get("kt_wizard_v4");
      formEl = $("#kt_form");

      initWizard();
      initValidation();
      initSubmit();
    },
  };
})();

jQuery(document).ready(function () {
  KTWizard4.init();
});
