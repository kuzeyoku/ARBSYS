"use strict";

var KTWizard4 = (function () {
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
  var preview = 0;
  var isSingleDocument;
  var isEditLawsuitWizardPage;
  // Bu kısım ne olacak ona bir bak
  // $("#davet-mektubu-olustur").on("click", function (e) {
  var isLawsuitWizardPage; 

  var getPageName = function () {
    return $('[page-name]').attr('page-name') || null;
  }

  var getLastStep = function () {
    return parseInt(
      $(".kt-wizard-v4__nav-item[data-ktwizard-type='step']").last().find("div.kt-wizard-v4__nav-number").text()
    );
  }

  // Belge türüne göre kuralları çekmek için:
  var getDynamicRule = function (documentType) {
    return dynamicRulesConfig[documentType] || {};
  }

  var initWizard = function () {

    const pageName = getPageName();
    isEditLawsuitWizardPage = pageName == "edit_lawsuit";
    isLawsuitWizardPage = pageName == "lawsuit";

    wizard = new KTWizard("kt_wizard_v4", {
      startStep: 1,
      clickableSteps: false
    });

    console.log("wizard obj: ", wizard);

    // Validation before going to next page
    wizard.on("beforeNext", function (wizardObj) {
      if (validator.form() !== true) {
        wizardObj.stop();
      }

      if (isLawsuitWizardPage) {
        lawsuitWizardBeforeLastPageControl();
        issetApplicantTypeInSide(wizardObj);
      };
    });

    // Validation before going to before page
    wizard.on("beforePrev", function (wizardObj) { });

    // Change event
    wizard.on("change", function (wizard) {
      KTUtil.scrollTop();
      if (!isLawsuitWizardPage) {
        if (wizard.getStep() == (getLastStep() - 1) && preview == 0) {
          formEl.ajaxSubmit({
            url: $("#preview-area").data("url"),
            success: function (data) {
              var preview_content = $("#preview-area");
              if (typeof (data) == "string") {
                preview_content.val(data)
                createEditor("#preview-area");
                $(".print_side").html(data);
                preview = 1;
                isSingleDocument = true;
              } else {
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
      }
    });
  };

  // lawsuit -> wizard.js için rules altında messages da var
  var initValidation = function () {

    const pageName = getPageName();
    const dynamicRules = getDynamicRule(pageName);

    validator = formEl.validate({
      // Validate only visible fields
      ignore: ":hidden",

      // Validation rules
      rules: dynamicRules,

      messages: getLawsuitWizardInitValidationMessage(),

      // Display error
      // Text'ler localization dosyası içine alınacak
      invalidHandler: function (event, validator) {
        KTUtil.scrollTop();
        if (isLawsuitWizardPage) { lawSuitWizardPreInvalidHandler() };
        if (isEditLawsuitWizardPage) { lawSuitEditWizardPreInvalidHandler() };
        swal.fire({
          title: "",
          text: "Lütfen gerekli alanları boş geçmeyiniz",
          type: "error",
          confirmButtonClass: "btn btn-secondary",
        });
      },

      // Submit valid form
      submitHandler: function (form) { },
    });
  };

  // Burasının direkt içeriği değiştirilebilir
  var initSubmit = function () {
    if (isLawsuitWizardPage) {
      lawsuitWizardInitSubmit();
    } else {
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
              if (isSingleDocument) {
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

              const pageName = getPageName();
              if (isEditLawsuitWizardPage) { lawsuitEditWizardRouteToMyFolders() }
            },
          });
        }
      });
    }
  };

  // Lawsuit Wizard Functions
  var lawsuitWizardBeforeLastPageControl = function () {
    let html = "<ul>";

    sides.forEach(side => {
      html += `<li>${side.applicantType} - ${side.name}</li>`;

      const subSections = [
        { title: "Kanuni Temsilciler", key: "representatives" },
        { title: "Çalışanlar", key: "workers" },
        { title: "Vekiller", key: "lawyer" },
        { title: "Yetkililer", key: "others" }
      ];

      subSections.forEach(({ title, key }) => {
        if (side[key] && side[key].length > 0) {
          html += `<ul><li style='list-style:none;'><strong>${title}</strong></li>`;
          side[key].forEach(item => {
            html += `<li>${item.tc} - ${item.name}</li>`;
          });
          html += "</ul>";
        }
      });
    });

    html += "</ul>";
    $("#step1_details").html(html);

    // Step 2 details
    html = "";
    const disputeType = $("#lawsuit_subject_types option:selected").text();
    const disputeSubject = $("#lawsuit_subjects option:selected").text();

    if (disputeType) html += `<p><strong>Uyuşmazlık Türü : </strong>${disputeType}</p>`;
    if (disputeSubject) html += `<p><strong>Uyuşmazlık Konusu : </strong>${disputeSubject}</p>`;

    $("#step2_details").html(html);

    // Step 3 details
    html = "";
    const lawsuitTypeId = parseInt($("#delivery_by option:selected").val());
    const mediationOffice = $("[name='mediation_office']").val();
    const mediationCenter = $("[name='mediation_center']").val();

    if (lawsuitTypeId === 1 || lawsuitTypeId === 3) {
      if (mediationOffice) html += `<p><strong>Arabuluculuk Bürosu : </strong>${mediationOffice}</p>`;
    } else if ([4, 5, 6].includes(lawsuitTypeId)) {
      if (mediationCenter) html += `<p><strong>Arabuluculuk Merkezi : </strong>${mediationCenter}</p>`;
    }

    const fields = [
      { label: "Başvuru Dosya No", name: "application_document_no" },
      { label: "Arabuluculuk Dosya No", name: "mediation_document_no" },
      { label: "Başvuru Tarihi", name: "application_date" },
      { label: "Görevi Kabul Tarihi", name: "job_date" },
      { label: "Süreci Başlangıç Tarihi", name: "process_start_date" }
    ];

    fields.forEach(({ label, name }) => {
      const value = $(`[name='${name}']`).val();
      if (value) html += `<p><strong>${label} : </strong>${value}</p>`;
    });

    const processType = $("#process_type_id option:selected").text();
    if (processType) html += `<p><strong>Süreç Bilgisi : </strong>${processType}</p>`;

    $("#step3_details").html(html);
  }

  var lawSuitWizardPreInvalidHandler = function () {
    if ($("input[name='mediation_office']").val() == "") {
      $("input[name='mediation_office']").addClass("is-invalid");
    } else {
      $("input[name='mediation_office']").removeClass("is-invalid");
    }
  }

  $("#arbiter_define_protocol_create").on("click", function () {
    $("#arbiter_define_protocol_form").ajaxSubmit({
      success: function (data) {
        $("#arbiter_define_protocol_print_content").html(data.preview);
        $("#arbiter_define_protocol_print_content").printThis({
          importCSS: false,
          loadCSS: "/css/print.css",
        });
        $("#arbiter_define_protocol_modal").modal("hide");
      },
    });
  });

  var lawsuitWizardInitSubmit = function (data) {
    var btn = document.getElementById("");
    var back_btn = formEl.find('[data-ktwizard-type="action-prev"]');

    $("#dosya-olustur").on("click", function (e) {
      e.preventDefault();
      $("#exampleModal").modal("hide");

      if (validator.form()) {
        // See: src\js\framework\base\app.js
        KTApp.progress(btn);
        //KTApp.block(formEl);

        // See: http://malsup.com/jquery/form/#ajaxSubmit
        formEl.ajaxSubmit({
          data: { sides: sides },
          success: function (data) {
            // KTApp.unprogress(btn);
            // KTApp.block(formEl);
            swal
              .fire({
                title: "",
                text: "Dosya başarıyla oluşturuldu",
                type: "success",
                confirmButtonClass: "btn btn-secondary",
              })
              .then(function () {
                window.location = "/dosyalarim?tutanak=" + data.lawsuit.id;
              });

            back_btn.hide();

            $("#saved").show();

            if (
              $("#delivery_by").children("option:selected").data("delivery") ==
              "Tarafların Başvurusu"
            ) {
              $("#arbiter_define_protocol").show();
              $("#arbiter_define_protocol_form_lawsuit_id").val(
                data.lawsuit.id
              );
            }

            $("#next_button").attr(
              "href",
              "/dosya/" + data.lawsuit.id + "/davet-mektubu-olustur"
            );

            $("#sides_result").html(data.sides);
            $("#lawsuit_print_content").html(data.print_content);
          },
        });
      }
    });

    $("#davet-mektubu-olustur").on("click", function (e) {
      e.preventDefault();
      $("#exampleModal").modal("hide");

      if (validator.form()) {
        // See: src\js\framework\base\app.js
        KTApp.progress(btn);
        //KTApp.block(formEl);

        // See: http://malsup.com/jquery/form/#ajaxSubmit
        formEl.ajaxSubmit({
          data: { sides: sides },
          success: function (data) {
            // KTApp.unprogress(btn);
            // KTApp.block(formEl);
            swal
              .fire({
                title: "",
                text: "Dosya başarıyla oluşturuldu",
                type: "success",
                confirmButtonClass: "btn btn-secondary",
              })
              .then(function () {
                window.location =
                  "/dosya/" + data.lawsuit.id + "/davet-mektubu-olustur";
              });

            back_btn.hide();

            $("#saved").show();

            if (
              $("#delivery_by").children("option:selected").data("delivery") ==
              "Tarafların Başvurusu"
            ) {
              $("#arbiter_define_protocol").show();
              $("#arbiter_define_protocol_form_lawsuit_id").val(
                data.lawsuit.id
              );
            }

            $("#next_button").attr(
              "href",
              "/dosya/" + data.lawsuit.id + "/davet-mektubu-olustur"
            );

            $("#sides_result").html(data.sides);
            $("#lawsuit_print_content").html(data.print_content);
          },
        });
      }
    });
  };

  var lawsuitWizardApplicantTypeSideCheck = function (wizardObj) {
    if (issetApplicantTypeInSide()) {
      wizardObj.stop();
      swal.fire({
        text: "En az bir Başvurucu ve  bir Diğer Taraf bilgisi girmek zorunludur!",
        icon: "error",
        confirmButtonText: "Tamam",
      });
    }
  };

  var getLawsuitWizardInitValidationMessage = function () {
    return isLawsuitWizardPage 
    ? {
      "job_date": {
        "application_date_required":
          "Görevi kabul tarihi , başvuru tarihinden önce olamaz!",
      },
    }
    : {};
  };

  // Lawsuit Edit Wizard Functions
  var lawSuitEditWizardPreInvalidHandler = function () {
    if ($("input[name='firm']").val() == "") {
      $("input[name='firm']").addClass("is-invalid");
    } else {
      $("input[name='firm']").removeClass("is-invalid");
    }
  }

  var lawsuitEditWizardRouteToMyFolders = function () {
    window.location.href = "/dosyalarim";
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
