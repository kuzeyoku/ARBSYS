"use strict";

var KTWizard4 = (function () {
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
  var preview = 0;
  var isSingleDocument;

  var getPageName = function () {
    return $('[page-name]').attr('page-name') || null;
  }
  
  var getLastStep = function () {
    return parseInt(
      $(".kt-wizard-v4__nav-item[data-ktwizard-type='step']").last().find("div.kt-wizard-v4__nav-number").text()
    );
  }

   // Belge türüne göre kuralları çekmek için:
   var getDynamicRule = function(documentType) {
    return dynamicRulesConfig[documentType] || {};
  }

  var initWizard = function () {
    wizard = new KTWizard("kt_wizard_v4", {
      startStep: 1,
      clickableSteps: false
    });

    // Validation before going to next page
    wizard.on("beforeNext", function (wizardObj) {
      if (validator.form() !== true) {
        wizardObj.stop();
      }
    });

    // Validation before going to before page
    wizard.on("beforePrev", function (wizardObj) {});

    // Change event
    wizard.on("change", function (wizard) {
      KTUtil.scrollTop();
      if (wizard.getStep() == (getLastStep() -1) && preview == 0) {
        formEl.ajaxSubmit({
          url: $("#preview-area").data("url"),
          success: function (data) {
            console.log(typeof(data))
            var preview_content = $("#preview-area");
            if (typeof(data) == "string") {
              preview_content.val(data)
              createEditor("#preview-area");
              $(".print_side").html(data);
              preview = 1;
              isSingleDocument = true;
            } else{
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
              isSingleDocument = false;
            } 
          },
        });
      }

      if (wizard.getStep() == getLastStep()) {
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
    
    const pageName = getPageName();
    const dynamicRules = getDynamicRule(pageName);

    validator = formEl.validate({
      // Validate only visible fields
      ignore: ":hidden",

      // Validation rules
      rules: dynamicRules,

      // Display error
      // Text'ler localization dosyası içine alınacak
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
        // burası da dinamik değişebilmeli
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
            if (isSingleDocument){
              $(".print_side").html(data);
            }
            $("#saved").show();
            $("#before_saved").hide();
            btn.hide();
            back_btn.hide();

            swal.fire({
              title: "",
              text: "Evrak başarıyla kaydedildi.", //"Davet mektubu başarıyla kaydedildi.",
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
