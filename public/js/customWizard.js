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
    var getDynamicRule = function (documentType) {
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
        wizard.on("beforePrev", function (wizardObj) {
        });

        // Change event
        wizard.on("change", function (wizard) {
            KTUtil.scrollTop();
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
                                createEditor("#preview-" + v.id);
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
        ;

        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: dynamicRules,

            errorPlacement: function (error, element) {
                if (element.attr("type") === "checkbox" || element.attr("type") === "radio") {
                    notification("", "Lütfen Seçim Yapın", "error");
                } else if (element.attr("type") === "text") {
                    notification("", "Lütfen Gerekli Alanları Doldurun", "error");
                }
            },

            // Display error
            // Text'ler localization dosyası içine alınacak
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();
            },
            // Submit valid form
            submitHandler: function (form) {
            },
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
                        if (isSingleDocument) {
                            $(".print_side").html(data);
                        }
                        $("#saved").show();
                        $("#before_saved").hide();
                        btn.hide();
                        back_btn.hide();

                        swal.fire({
                            title: "",
                            icon: "success",
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
            //Hata Mesajlarını Buradan Özelleştireceğiz.
            /*jQuery.extend(jQuery.validator.messages, {
                            required: "Zorunlu Alan.",
                            remote: "Please fix this field.",
                            email: "Please enter a valid email address.",
                            url: "Please enter a valid URL.",
                            date: "Please enter a valid date.",
                            dateISO: "Please enter a valid date (ISO).",
                            number: "Please enter a valid number.",
                            digits: "Please enter only digits.",
                            creditcard: "Please enter a valid credit card number.",
                            equalTo: "Please enter the same value again.",
                            accept: "Please enter a value with a valid extension.",
                            maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                            minlength: jQuery.validator.format("Please enter at least {0} characters."),
                            rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });*/
        },
    };
})();

jQuery(document).ready(function () {
    KTWizard4.init();
});

function createEditor(selector) {
    $(selector).summernote("destroy");
    $(selector).summernote({
        lang: "tr-TR",
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
