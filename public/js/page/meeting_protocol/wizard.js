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
  var lawsuit_subject_id = 0;

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

      if (wizardObj.currentStep === 3) {
        // if (previewRequiredControl() === 1)
        // {
        //     wizardObj.stop();
        //     swal.fire({
        //         "title": "",
        //         "text": "Lütfen gerekli alanları boş geçmeyiniz",
        //         "type": "error",
        //         "confirmButtonClass": "btn btn-secondary"
        //     });
        // }
      }

      /*if (issetLawyerOrOtherInSide())
            {
                wizardObj.stop();  // don't go to the next step
                swal.fire({
                    "title": "",
                    "text": "Kurum tarafı için en az bir Vekil veya Yetkili bilgisi girmek ve seçmek zorunludur!",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            }*/
    });

    wizard.on("beforePrev", function (wizardObj) {
      // if (validator.form() !== true) {
      // 	wizardObj.stop();  // don't go to the next step
      // }
    });

    // Change event
    wizard.on("change", function (wizard) {
      KTUtil.scrollTop();

      if (wizard.getStep() == 3 && preview == 0) {
        formEl.ajaxSubmit({
          data: { sides: sides },
          url: $("#preview-area").data("url"),
          success: function (data) {
            if (
              data.lawsuit_subject_id == 1 &&
              saved != 1 &&
              $("input[name='matters_discussed']").val() == ""
            ) {
              $("#select_subject_modal").modal("show");
            }

            if (saved != 1) {
              $("#preview-area").val(data);
              $("#preview-area").summernote();
            }

            preview = 1;
            lawsuit_subject_id = data.lawsuit_subject_id;
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
      // Validate only visible fields
      ignore: ":hidden",

      // Validation rules
      rules: {
        //= Step 1
        meeting_date: {
          required: true,
        },
        meeting_hour: {
          required: true,
        },
        soother_center_name: {
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

        if (lawsuit_subject_id == 1) {
          $("input[name='matters_discussed']").val(
            document.querySelector(".MuzakereEdilenHususlar").innerHTML
          );
        }
        // See: http://malsup.com/jquery/form/#ajaxSubmit
        formEl.ajaxSubmit({
          data: { sides: sides },
          success: function (data) {
            KTApp.unprogress(btn);
            //KTApp.unblock(formEl);

            $(".print_side").html(data);

            back_btn.hide();
            btn.hide();

            $("#saved").show();
            $("#before_saved").hide();

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
