"use strict";

// Class definition
var KTWizard4 = (function () {
  // Base elements
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
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
      if (wizard.getStep() == 1) {
        var checkbox = $("#kt_form input[type='checkbox']:checked");
        if (checkbox.length == 0) {
          swal.fire({
            title: "",
            text: "Lütfen en az bir katılımcı seçiniz!",
            type: "error",
            confirmButtonClass: "btn btn-secondary",
          });
          wizardObj.stop(); // don't go to the next step
        }
      }
      if (validator.form() !== true) {
        wizardObj.stop(); // don't go to the next step
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
      if (wizard.getStep() == 2 && preview == 0) {
        formEl.ajaxSubmit({
          url: $("#preview-area").data("url"),
          success: function (data) {
            $("#preview-area").val(data);
            createEditor("#preview-area");
            preview = 1;
          },
        });
      }

      if (wizard.getStep() == 3) {
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
        //= Step 2
        meeting_date: {
          required: true,
        },
        meeting_address: {
          required: true,
        },
        mediation_center_id: {
          required: true,
        },
        //= Step 3
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
          data: { sides: sides },
          success: function (data) {
            KTApp.unprogress(btn);
            //KTApp.unblock(formEl);
            $(".print_side").html(data);
            btn.hide();
            back_btn.hide();
            $("#saved").show();
            $("#before_saved").hide();

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

function createEditor(selector) {
  $(selector).summernote("destroy");
  $(selector).summernote({
    callbacks: {
      onChange: function (contents) {
        $(selector).html(contents);
      },
      onPaste: function (e) {
        var bufferText = (
          (e.originalEvent || e).clipboardData || window.clipboardData
        ).getData("Text");

        e.preventDefault();

        // Firefox fix
        setTimeout(function () {
          document.execCommand("insertText", false, bufferText);
        }, 10);
      },
    },
  });
}
