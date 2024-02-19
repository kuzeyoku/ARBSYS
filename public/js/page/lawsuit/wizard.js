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
    wizard = new KTWizard("kt_wizard_lawsuit_v4", {
      startStep: 1, // initial active step number
      clickableSteps: false, // allow step clicking
    });

    // Validation before going to next page
    wizard.on("beforeNext", function (wizardObj) {
      if (validator.form() !== true) {
        wizardObj.stop(); // don't go to the next step
      }
      if (issetApplicantTypeInSide()) {
        wizardObj.stop(); // don't go to the next step
        swal.fire({
          title: "",
          text: "En az bir Başvurucu ve  bir Diğer Taraf bilgisi girmek zorunludur!",
          type: "error",
          confirmButtonClass: "btn btn-secondary",
        });
      }
      if (wizard.getStep() === 3) {
        var html = "<ul>";
        for (var i = 0; i < sides.length; i++) {
          html += "<li>";
          html += sides[i].applicantType + " - " + sides[i].name;
          html += "</li>";

          if (
            typeof sides[i].representatives != "undefined" &&
            sides[i].representatives.length > 0
          ) {
            html += "<ul>";
            html +=
              "<li style='list-style:none;'><strong>Kanuni Temsilciler</strong></li>";
            for (var h = 0; h < sides[i].representatives.length; h++) {
              html += "<li>";
              html +=
                sides[i].representatives[h].tc +
                " - " +
                sides[i].representatives[h].name;
              html += "</li>";
            }
            html += "</ul>";
          }

          if (
            typeof sides[i].workers != "undefined" &&
            sides[i].workers.length > 0
          ) {
            html += "<ul>";
            html +=
              "<li style='list-style:none;'><strong>Çalışanlar</strong></li>";
            for (var g = 0; g < sides[i].workers.length; g++) {
              html += "<li>";
              html += sides[i].workers[g].tc + " - " + sides[i].workers[g].name;
              html += "</li>";
            }
            html += "</ul>";
          }

          if (
            typeof sides[i].lawyer != "undefined" &&
            sides[i].lawyer.length > 0
          ) {
            html += "<ul>";
            html +=
              "<li style='list-style:none;'><strong>Vekiller</strong></li>";
            for (var j = 0; j < sides[i].lawyer.length; j++) {
              html += "<li>";
              html += sides[i].lawyer[j].tc + " - " + sides[i].lawyer[j].name;
              html += "</li>";
            }
            html += "</ul>";
          }

          if (
            typeof sides[i].others != "undefined" &&
            sides[i].others.length > 0
          ) {
            html += "<ul>";
            html +=
              "<li style='list-style:none;'><strong>Yetkililer</strong></li>";
            for (var h = 0; h < sides[i].others.length; h++) {
              html += "<li>";
              html += sides[i].others[h].tc + " - " + sides[i].others[h].name;
              html += "</li>";
            }
            html += "</ul>";
          }
        }
        html += "</ul>";
        $("#step1_details").html(html);

        html = "";
        if ($("#lawsuit_subject_types option:selected").text() !== "") {
          html +=
            "<p><strong>Uyuşmazlık Türü : </strong>" +
            $("#lawsuit_subject_types option:selected").text() +
            "</p>";
        }
        if ($("#lawsuit_subjects option:selected").text() !== "") {
          html +=
            "<p><strong>Uyuşmazlık Konusu : </strong>" +
            $("#lawsuit_subjects option:selected").text() +
            "</p>";
        }
        $("#step2_details").html(html);

        html = "";
        if ($("[name='mediation_office']").val() !== "") {
          var lawsuit_type_id = parseInt(
            $("#delivery_by option:selected").val()
          );
          if (lawsuit_type_id === 1 || lawsuit_type_id === 3) {
            html +=
              "<p><strong>Arabuluculuk Bürosu : </strong>" +
              $("[name='mediation_office']").val() +
              "</p>";
          } else if (
            lawsuit_type_id === 4 ||
            lawsuit_type_id === 5 ||
            lawsuit_type_id === 6
          ) {
            html +=
              "<p><strong>Arabuluculuk Merkezi : </strong>" +
              $("[name='mediation_center']").val() +
              "</p>";
          }
        }
        if ($("[name='application_document_no']").val() !== "") {
          html +=
            "<p><strong>Başvuru Dosya No : </strong>" +
            $("[name='application_document_no']").val() +
            "</p>";
        }
        if ($("[name='mediation_document_no']").val() !== "") {
          html +=
            "<p><strong>Arabuluculuk Dosya No : </strong>" +
            $("[name='mediation_document_no']").val() +
            "</p>";
        }
        if ($("[name='application_date']").val() !== "") {
          html +=
            "<p><strong>Başvuru Tarihi : </strong>" +
            $("[name='application_date']").val() +
            "</p>";
        }
        if ($("[name='job_date']").val() !== "") {
          html +=
            "<p><strong>Görevi Kabul Tarihi : </strong>" +
            $("[name='job_date']").val() +
            "</p>";
        }
        if ($("[name='process_start_date']").val() !== "") {
          html +=
            "<p><strong>Süreci Başlangıc Tarihi : </strong>" +
            $("[name='process_start_date']").val() +
            "</p>";
        }
        if ($("#process_type_id option:selected").text() !== "") {
          html +=
            "<p><strong>Süreç Bilgisi : </strong>" +
            $("#process_type_id option:selected").text() +
            "</p>";
        }
        $("#step3_details").html(html);
      }
      /*if (issetLawyerOrOtherInSide()) {
                wizardObj.stop();  // don't go to the next step
                swal.fire({
                    "title": "",
                    "text": "Eklenen Kurum tarafı için en az bir Vekil veya Yetkili bilgisi girmek zorunludur!",
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
    });

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
  };

  var initValidation = function () {
    validator = formEl.validate({
      // Validate only visible fields
      ignore: ":hidden",

      // Validation rules
      rules: {
        // Step 1
        // Step 2
        delivery_by: {
          required: true,
        },
        lawsuit_type_id: {
          required: true,
        },
        lawsuit_subject_id: {
          required: true,
        },
        lawsuit_subject_type_id: {
          required: true,
        },

        //= Step 3
        application_document_no: {
          required: true,
        },
        mediation_document_no: {
          required: true,
        },
        job_date: {
          required: true,
          application_date_required: true,
        },
        application_date: {
          required: true,
        },
        process_start_date: {
          required: true,
        },
        result_type_id: {
          required: true,
        },
        result_date: {
          required: true,
        },
        mediation_office: {
          required: true,
        },
      },
      // Specify validation error messages
      messages: {
        job_date: {
          application_date_required:
            "Görevi kabul tarihi , başvuru tarihinden önce olamaz!",
        },
      },

      // Display error
      invalidHandler: function (event, validator) {
        KTUtil.scrollTop();

        if ($("input[name='mediation_office']").val() == "") {
          $("input[name='mediation_office']").addClass("is-invalid");
        } else {
          $("input[name='mediation_office']").removeClass("is-invalid");
        }

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
