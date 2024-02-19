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
      if (validator.form() !== true) {
        wizardObj.stop(); // don't go to the next step
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
      if (wizard.getStep() == 4 && preview == 0) {
        formEl.ajaxSubmit({
          url: $("#preview-content").data("url"),
          success: function (data) {
            var preview_content = $("#preview-content");

            $.each(data, function (k, v) {
              var textarea = $("<textarea>").attr({
                id: "preview-" + v.id,
                name: "preview-" + v.id,
              });
              preview_content.append(
                "</br><p><strong>" +
                  v.label +
                  "</strong> için davet mektubu</p>"
              );
              preview_content.append(textarea);
              textarea.html(v.view);
              $("#preview-" + v.id).summernote();
            });
          },
        });
      }

      if (wizard.getStep() == 5) {
        $("#side_email_control").hide();
        formEl.ajaxSubmit({
          url: $("#side_email_control").data("url"),
          success: function (data) {
            email_count = Object.keys(data.notnull_emails).length;

            $("#send_email").show();
            $("#side_email_control").html(
              "<p>Seçtiğiniz aşağıdaki taraf(lar) için email adresi bulunmuyor. Taraf(lar) için davet mektubunu email olarak göndermek istiyorsanız lütfen email adreslerini girin.</p>"
            );
            $.each(data.null_emails, function (index, value) {
              $("#side_email_control").show();
              var html = "";
              html += '<div class="form-group">';
              html += "<label>" + value + "</label>";
              html +=
                '<input type="text" name="' +
                index +
                '" value="" class="form-control send_email_inputs" placeholder="E-Posta adresini yazınız">';
              html += "</div>";

              $("#side_email_control").append(html);
            });
          },
        });

        $("#cikti").html("");

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
        "side_ids[]": {
          required: true,
        },
        //= Step 2
        meeting_date: {
          required: true,
        },
        meeting_start_hour: {
          required: true,
        },
        mediation_center: {
          required: false,
        },
        meeting_address: {
          required: true,
        },
        //= Step 3
        want_write: {
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
            $.each($("input[name='side_ids[]']:checked"), function () {
              var id = $(this).val();
              var name = $(this).data("name");
              var html = "";
              html +=
                "<button class='btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u d-block mb-2 print' data-id='" +
                id +
                "'>";
              html += "<i class='fas fa-print'></i> " + name + " İÇİN ÇIKTI AL";
              html += "</button>";
              html +=
                "<div class='print_side' id='print-" +
                id +
                "'>" +
                data[id] +
                "</div>";

              $("#cikti").append(html);
            });

            KTApp.unprogress(btn);

            $("#saved").show();
            $("#before_saved").hide();
            btn.hide();
            back_btn.hide();

            swal.fire({
              title: "",
              text: "Davet mektubu başarıyla kaydedildi.",
              type: "success",
              confirmButtonText: "Tamam",
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
