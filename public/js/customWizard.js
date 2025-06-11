"use strict";

var KTWizard4 = (function () {
    var wizardEl, formEl, validator, wizard, preview = 0, isSingleDocument, isEditLawsuitWizardPage,
        isLawsuitWizardPage;

    var getPageName = () => $('[page-name]').attr('page-name') || null;

    var getLastStep = () => parseInt($(".kt-wizard-v4__nav-item[data-ktwizard-type='step']").last().find("div.kt-wizard-v4__nav-number").text());

    var getDynamicRule = (documentType) => dynamicRulesConfig[documentType] || {};

    var initWizard = function () {
        const pageName = getPageName();
        isEditLawsuitWizardPage = pageName == "edit_lawsuit";
        isLawsuitWizardPage = pageName == "lawsuit";

        wizard = new KTWizard("kt_wizard_v4", {startStep: 1, clickableSteps: false});

        wizard.on("beforeNext", function (wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();
                notification("", "Lütfen Gerekli Alanları Doldurun", "error");
            }


            if (isLawsuitWizardPage) {
                lawsuitWizardBeforeLastPageControl();
                lawsuitWizardApplicantTypeSideCheck(wizardObj);
                lawsuitWizardJobDateControl(wizardObj);
            }

            $.each(validator.errorList, function (index, error) {
                $(error.element).css({'border': '2px solid red', 'background-color': '#ffe6e6'});
                $(error.element).parent().css('color', $(error.element).is(':checked') ? '' : 'red');
            });
        });

        wizard.on("change", function (wizard) {
            KTUtil.scrollTop();
            if (!isLawsuitWizardPage) {
                handleWizardChange(wizard);
            }
        });
    };

    var lawsuitWizardJobDateControl = function (wizardObj) {
        var jobDate = $("input[name='job_date']").val();
        var applicationDate = $("input[name='application_date']").val();
        if (jobDate && applicationDate && jobDate < applicationDate) {
            wizardObj.stop();
            notification("", "Görevi Kabul Tarihi Başvuru Tarihinden Önce Olamaz!", "error");
        }
    }

    var handleWizardChange = function (wizard) {
        if (wizard.getStep() == (getLastStep() - 1) && preview == 0) {
            formEl.ajaxSubmit({
                url: $("#preview-area").data("url"),
                success: function (data) {
                    handlePreviewData(data);
                },
            });
        }

        if (!isSingleDocument && wizard.getStep() == getLastStep()) {
            handleEmailControl();
        }
        $('[data-ktwizard-type="action-submit"]').click();
    };

    var handlePreviewData = function (data) {
        var preview_content = $("#preview-area");
        if (Array.isArray(data)) {
            $.each(data, function (k, v) {
                var textarea = $("<textarea>").attr({id: "preview-" + v.id, name: "preview-" + v.id});
                preview_content.append("</br><p><strong>" + v.label + "</strong> için davet mektubu</p>");
                preview_content.append(textarea);
                textarea.html(v.view);
                $("#preview-" + v.id).summernote();
            });
            isSingleDocument = false;
        } else {
            preview_content.val(data.view);
            createEditor("#preview-area");
            $(".print_side").html(data.view);
            var pdf_container = $("#print-preview");
            var pdf_url = pdf_container.data("url");
            var iframe_url = pdf_url + "?token=" + data.token;
            var iframe = $("<iframe>", {
                "src": iframe_url + "#view=FitH",
                "id": "pdf-preview-iframe",
                "style": "width: 100%; height: 765px; border: none;",
                "frameborder": "0"
            });
            pdf_container.append(iframe);
            preview = 1;
            isSingleDocument = true;
        }
    };

    var handleEmailControl = function () {
        $("#side_email_control").hide();
        formEl.ajaxSubmit({
            url: $("#side_email_control").data("url"),
            success: function (data) {
                $("#send_email").show();
                $("#side_email_control").html("<p>Seçtiğiniz aşağıdaki taraf(lar) için email adresi bulunmuyor. Taraf(lar) için davet mektubunu email olarak göndermek istiyorsanız lütfen email adreslerini girin.</p>");
                $.each(data.null_emails, function (index, value) {
                    $("#side_email_control").show();
                    $("#side_email_control").append('<div class="form-group"><label>' + value + '</label><input type="text" name="' + index + '" value="" class="form-control send_email_inputs" placeholder="E-Posta adresini yazınız"></div>');
                });
            },
        });
        $("#cikti").html("");
    };

    var initValidation = function () {
        const pageName = getPageName();
        const dynamicRules = getDynamicRule(pageName);

        validator = formEl.validate({
            ignore: ":hidden",
            rules: dynamicRules,
            messages: getLawsuitWizardInitValidationMessage(),
            unhighlight: function (element) {
                $(element).css({'border': '', 'background-color': ''});
                $(element).parent().css('color', '');
            },
            errorPlacement: function (error, element) {
                //error.insertAfter(element);
            },
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();
                if (isLawsuitWizardPage) lawSuitWizardPreInvalidHandler();
                if (isEditLawsuitWizardPage) lawSuitEditWizardPreInvalidHandler();
            },
            submitHandler: function (form) {
            },
        });
    };

    var initSubmit = function () {
        if (isLawsuitWizardPage) {
            lawsuitWizardInitSubmit();
        } else {
            var btn = formEl.find('[data-ktwizard-type="action-submit"]');
            var back_btn = formEl.find('[data-ktwizard-type="action-prev"]');

            btn.on("click", function (e) {
                e.preventDefault();
                if (validator.form()) {
                    KTApp.progress(btn);
                    formEl.ajaxSubmit({
                        success: function (data) {
                            handleFormSubmitSuccess(data, btn, back_btn);
                        },
                    });
                }
            });
        }
    };

    var handleFormSubmitSuccess = function (data, btn, back_btn) {
        $.each($("input[name='side_ids[]']:checked"), function () {
            var id = $(this).val();
            var name = $(this).data("name");
            $("#cikti").append("<button class='btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u d-block mb-2 print' data-id='" + id + "'><i class='fas fa-print'></i> " + name + " İÇİN ÇIKTI AL</button><div class='print_side' id='print-" + id + "'>" + data[id] + "</div>");
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
            text: "Evrak başarıyla kaydedildi.",
            type: "success",
            confirmButtonText: "Tamam",
            confirmButtonClass: "btn btn-secondary",
        });

        if (isEditLawsuitWizardPage) {
            lawsuitEditWizardRouteToMyFolders();
        }
    };

    var lawsuitWizardBeforeLastPageControl = function () {
        let html = "<ul>";
        sides.forEach(side => {
            html += `<li>${side.applicantType} - ${side.name}</li>`;
            const subSections = [
                {title: "Kanuni Temsilciler", key: "representatives"},
                {title: "Çalışanlar", key: "workers"},
                {title: "Vekiller", key: "lawyer"},
                {title: "Yetkililer", key: "others"}
            ];
            subSections.forEach(({title, key}) => {
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
        updateStepDetails();
    };

    var updateStepDetails = function () {
        let html = "";
        const disputeType = $("#lawsuit_subject_types option:selected").text();
        const disputeSubject = $("#lawsuit_subjects option:selected").text();
        if (disputeType) html += `<p><strong>Uyuşmazlık Türü : </strong>${disputeType}</p>`;
        if (disputeSubject) html += `<p><strong>Uyuşmazlık Konusu : </strong>${disputeSubject}</p>`;
        $("#step2_details").html(html);

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
            {label: "Başvuru Dosya No", name: "application_document_no"},
            {label: "Arabuluculuk Dosya No", name: "mediation_document_no"},
            {label: "Başvuru Tarihi", name: "application_date"},
            {label: "Görevi Kabul Tarihi", name: "job_date"},
            {label: "Süreci Başlangıç Tarihi", name: "process_start_date"}
        ];

        fields.forEach(({label, name}) => {
            const value = $(`[name='${name}']`).val();
            if (value) html += `<p><strong>${label} : </strong>${value}</p>`;
        });

        const processType = $("#process_type_id option:selected").text();
        if (processType) html += `<p><strong>Süreç Bilgisi : </strong>${processType}</p>`;
        $("#step3_details").html(html);
    };

    var lawSuitWizardPreInvalidHandler = function () {
        $("input[name='mediation_office']").toggleClass("is-invalid", $("input[name='mediation_office']").val() == "");
    };

    $("#arbiter_define_protocol_create").on("click", function () {
        $("#arbiter_define_protocol_form").ajaxSubmit({
            success: function (data) {
                $("#arbiter_define_protocol_print_content").html(data.preview);
                $("#arbiter_define_protocol_print_content").printThis({importCSS: false, loadCSS: "/css/print.css"});
                $("#arbiter_define_protocol_modal").modal("hide");
            },
        });
    });

    var lawsuitWizardInitSubmit = function () {
        var btn = document.getElementById("");
        var back_btn = formEl.find('[data-ktwizard-type="action-prev"]');

        $("#dosya-olustur").on("click", function (e) {
            e.preventDefault();
            $("#exampleModal").modal("hide");
            if (validator.form()) {
                KTApp.progress(btn);
                formEl.ajaxSubmit({
                    data: {sides: sides},
                    success: function (data) {
                        handleFileCreationSuccess(data, back_btn);
                    },
                });
            }
        });

        $("#davet-mektubu-olustur").on("click", function (e) {
            e.preventDefault();
            $("#exampleModal").modal("hide");
            if (validator.form()) {
                KTApp.progress(btn);
                formEl.ajaxSubmit({
                    data: {sides: sides},
                    success: function (data) {
                        handleFileCreationSuccess(data, back_btn);
                    },
                });
            }
        });
    };

    var handleFileCreationSuccess = function (data, back_btn) {
        swal.fire({
            title: "",
            text: "Dosya başarıyla oluşturuldu",
            type: "success",
            confirmButtonClass: "btn btn-secondary",
        }).then(function () {
            window.location = "/dosyalarim?tutanak=" + data.lawsuit.id;
        });

        back_btn.hide();
        $("#saved").show();

        if ($("#delivery_by").children("option:selected").data("delivery") == "Tarafların Başvurusu") {
            $("#arbiter_define_protocol").show();
            $("#arbiter_define_protocol_form_lawsuit_id").val(data.lawsuit.id);
        }

        $("#next_button").attr("href", "/dosya/" + data.lawsuit.id + "/davet-mektubu-olustur");
        $("#sides_result").html(data.sides);
        $("#lawsuit_print_content").html(data.print_content);
    };

    var lawsuitWizardApplicantTypeSideCheck = function (wizardObj) {
        if (issetApplicantTypeInSide()) {
            wizardObj.stop();
            notification("", "En az bir Başvurucu ve  bir Diğer Taraf bilgisi girmek zorunludur!", "error");
        }
    };

    var getLawsuitWizardInitValidationMessage = function () {
        return isLawsuitWizardPage;
    };

    var lawSuitEditWizardPreInvalidHandler = function () {
        $("input[name='firm']").toggleClass("is-invalid", $("input[name='firm']").val() == "");
    };

    var lawsuitEditWizardRouteToMyFolders = function () {
        window.location.href = "/dosyalarim";
    };

    return {
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
                var bufferText = (e.originalEvent || e).clipboardData.getData("Text");
                e.preventDefault();
                setTimeout(function () {
                    document.execCommand("insertText", false, bufferText);
                }, 10);
            },
        },
    });
}