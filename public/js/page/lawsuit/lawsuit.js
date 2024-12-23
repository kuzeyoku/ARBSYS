var sides = [];
var selectedApplicantType = "";
var lawyerIndex, authorizedIndex, employeeIndex, representativeIndex, commissionerIndex, expertIndex;
var index = 0;
var activeSide, personType;

function getModalContent(url, type) {
    $.ajax({
        url: $(".personTypeSelect").data("url"),
        type: "POST",
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            type: type,
        },
        success: function (response) {
            $("#personModal .modal-header h5").text(response.personType.name);
            $("#personModal form .modal-body").html(response.formContent);
            $("#personModal form .modal-body  #person_type").prop("disabled", true);
            $("#personModal form .modal-footer .personAddButton").attr(
                "id",
                "save" + response.saveId
            );
            $("#personModal").modal("show");
            $(".selectSearch").select2({
                theme: "bootstrap4",
            });
        },
    });
}

$(document).ready(function () {
    //Görev Kabul Tarihi Kontrol İşlemi
    $(".custom-next-button-date-logic").on("click", function () {
        var applicationDate = new Date($('input[name="application_date"]').val());
        var jobDate = new Date($('input[name="job_date"]').val());
        if (applicationDate && jobDate) {
            if (jobDate < applicationDate) {
                $(".custom-save-button").prop("disabled", true);
                swal.fire({
                    text: "Görevi Kabul Tarihi Başvuru Tarihinden Eski Olamaz!",
                    confirmButtonText: "Tamam",
                });
            }
        }
    });

    //Kişi Tipi Seçme ve Form İçeriğini Çekme İşlemi
    $(document).on("click", ".personTypeSelect", function () {
        if ($("#applicant_type").val() == 0) {
            notification("Taraf sıfatı seçilmeden işleme devam edilemez", "error");
            return false;
        }
        $("#applicantModal").modal("hide");
        getModalContent($(this).data("url"), $(this).data("type"));
    });

    //Taraf Tanımlama İşlemi
    $(document).on("change", "#applicant_type", function () {
        if ($(this).val() == 1) {
            selectedApplicantType = Enums.Sides.APPLICANT;
        } else if ($(this).val() == 2) {
            selectedApplicantType = Enums.Sides.OTHER_SIDE;
        }
    });

    //Gerçek Kişi Ekleme İşlemi
    $(document).on("click", "#saveperson", function (e) {
        e.preventDefault();
        let formData = $(this).closest("form").serializeArray();
        let side = formData.reduce((acc, item) => {
            acc[item.name] = item.value;
            return acc;
        }, {});
        side.index = index;
        side.applicantType = selectedApplicantType;
        side.type = 1;
        sides.push(side);
        $("#personModal").modal("hide");
        generateSideBlock(side);
        index++;
    });

    //Tüzel Kişi Ekleme İşlemi
    $(document).on("click", "#savecompany", function (e) {
        e.preventDefault();
        let formData = $(this).closest("form").serializeArray();
        let side = formData.reduce((acc, item) => {
            acc[item.name] = item.value;
            return acc;
        }, {});
        side.index = index;
        side.applicantType = selectedApplicantType;
        side.type = 2;
        sides.push(side);
        $("#personModal").modal("hide");
        generateSideBlock(side);
        index++;
    });

    $(document).on("click", "#savelawyer", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.LAWYER.toLowerCase(), lawyerIndex);
    });

    $(document).on("click", "#saveauthorized", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.AUTHORIZED.toLowerCase(), authorizedIndex);
    });

    $(document).on("click", "#saveemployee", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.EMPLOYEE.toLowerCase(), employeeIndex);
    });

    $(document).on("click", "#saverepresentative", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.REPRESENTATIVE.toLowerCase(), representativeIndex);
    });

    $(document).on("click", "#savecommissioner", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.COMMISSIONER.toLowerCase(), commissionerIndex);
    });

    $(document).on("click", "#saveexpert", function (e) {
        e.preventDefault();
        saveMember(this, Enums.Members.EXPERT.toLowerCase(), expertIndex);
    });

    //Tutanakta Gösterilecek Verilerin İzin Kontrolü
    function getCheckElements() {
        var checkElements = $('[name^="check"]');
        var selectedCheckElements = checkElements.filter(":checked");
        if (selectedCheckElements.length > 0) {
            var selectedValues = selectedCheckElements
                .map(function () {
                    var nameValue = $(this).attr("name");
                    var elementName = nameValue.substring(
                        nameValue.indexOf("[") + 1,
                        nameValue.indexOf("]")
                    );
                    return '"' + elementName + '"';
                })
                .get();
            return "[" + selectedValues.join(",") + "]";
        }
        return null;
    }

    // Modal Events
    $("#personModal").on("hide.bs.modal", function () {
        $(".prq").val("");
        $(".pempty").val("");
        $(".prq").closest("form").resetForm();
    });
    $("#lawyerModal").on("hide.bs.modal", function () {
        $(".lrq").val("");
        $(".lempty").val("");
        $(".lrq").closest("form").resetForm();
    });
    $("#companyModal").on("hide.bs.modal", function () {
        $(".crq").val("");
        $(".cempty").val("");
        $(".crq").closest("form").resetForm();
    });
    $("#authorizedModal").on("hide.bs.modal", function () {
        $(".orq").val("");
        $(".oempty").val("");
        $(".orq").closest("form").resetForm();
    });
    $("#employeeModal").on("hide.bs.modal", function () {
        $(".wrq").val("");
        $(".wempty").val("");
        $(".wrq").closest("form").resetForm();
    });
    $("#representativeModal").on("hide.bs.modal", function () {
        $(".rrq").val("");
        $(".rempty").val("");
        $(".rrq").closest("form").resetForm();
    });
    $("#expertModal").on("hide.bs.modal", function () {
        $(".erq").val("");
        $(".eempty").val("");
        $(".erq").closest("form").resetForm();
    });
    // ----------------------------------  modal events  ----------------------------------//

    // ---------------------------------- lawyer operations ----------------------------------//
    $(document).on("click", ".addPersonToSide", function (e) {
        e.preventDefault();
        const personType = $(this).attr("personType");
        const url = $(this).attr("data-url");
        getModalContent(url, personType);
        window[personType + "Index"] = $(this).attr("data-index");
    });

    $(document).on("click", ".addMember", function (e) {
        e.preventDefault();
        const personType = $(this).attr("personType");
        const memberIndex = $(this).attr("data-index");
        window[personType + "Index"] = memberIndex;
        $(`#${personType}Modal`).modal("show");
    });

    function removeSideInMember(activeSide, memberId, memberType) {
        let activeSideMembers = [];
        let activeSideArray = activeSide[`${memberType}s`];
        let title = Localization[memberType].tr;
        if (activeSideArray != null) {
            for (let i = 0; i < activeSideArray.length; i++) {
                let row = activeSideArray[i];
                if (row.id != memberId) activeSideMembers.push(row);
            }
        }
        if (activeSideMembers.length == 0) {
            $(`#${memberType.toLowerCase()}Block${activeSide.index}`).empty();
            $(`#${memberType.toLowerCase()}Block${activeSide.index}`).append(`
           ${title}<br /> <a href="javascript:;" class="btn btn-sm btn-danger addMember add${capitalizeFirstLetter(memberType)} addPersonToSide" personType="${memberType.toLowerCase()}" data-index="${activeSide.index}">Ekle</a>
          `);
        }
        activeSide[`${memberType}s`] = activeSideMembers;
    }

    $(document).on("click", ".removeMember", function (e) {
        e.preventDefault();
        const memberIndex = $(this).attr("data-index");
        const memberType = $(this).attr("personType");
        var memberId = $(this).attr("data-id");
        activeSide = getActiveSide(memberIndex);

        removeSideInMember(activeSide, memberId, memberType);
        $('[data-id="' + memberId + '"]').parent().remove();
    });

    // Taraf silme scripti
    $(document).on("click", ".deleteSide", function (e) {
        e.preventDefault();
        let deleteSideDataIndex = $(this).attr("data-index");
        sides.forEach(function (tempSide, tempIndex) {
            if (tempSide.index == deleteSideDataIndex) {
                sides.splice(tempIndex, 1);
            }
        });

        $(`#sideCard-${deleteSideDataIndex}`).remove();

        console.log(sides);
    });
    $("select[name='lawsuit_type_id']").on("change", function () {
        $("#lawsuit-subject-types").removeClass("d-none");
        $("select[name='lawsuit_subject_type_id']").on("change", function () {
            const url = $(this).data("url");
            const lawsuit_subject_type_id = $(this).val();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    lawsuit_subject_type_id: lawsuit_subject_type_id,
                },
            }).done(function (response) {
                let options = "";
                response.forEach(function (item) {
                    options += `<option value="` + item.id + `">` + item.name + `</option>`;
                });
                $("select[name='lawsuit_subject_id']").html(options);
                $("#lawsuit-subjects").removeClass("d-none");
            });
        });

    });
    /*
        $("#delivery_by").on("change", function () {
            var delivery_by = $("#delivery_by")
                .children("option:selected")
                .data("delivery");
            var lawsuit_type_id = $("#delivery_by").children("option:selected").val();
            var firm_text = $(".firm_text");

            $("input[name='delivery_by']").val(delivery_by);

            $("#lawsuit_subjects_select").hide();
            $("#lawsuit_subject_types_select").hide();
            $("#lawsuit_subject_types").html("");
            $("#lawsuit_subjects").html("");

            $("#firm").show();
            $("#firm_document_no").show();

            if (delivery_by == "Sistem Üzerinden") {
                $("#firm").show();
                $("#firm_document_no").show();
            } else {
                $("#firm").hide();
                $("#firm_document_no").hide();
            }

            if (lawsuit_type_id == 1 || lawsuit_type_id == 3) {
                firm_text.html("&nbsp;Bürosu");
            } else if (
                lawsuit_type_id == 4 ||
                lawsuit_type_id == 5 ||
                lawsuit_type_id == 6
            ) {
                firm_text.html("&nbsp;Merkezi");
            }

            if (lawsuit_type_id == 2) {
                $("#process_start_date").show();
            } else {
                $("#process_start_date").hide();
            }

            if (lawsuit_type_id == 2) {
                $("#job_date").hide();
                $("#application_date").hide();
            } else if (lawsuit_type_id == 6) {
                $("#job_date").show();
                $("#application_date").hide();
            } else {
                $("#job_date").show();
                $("#application_date").show();
            }

            $("#lawsuit_subject_types_select").show();
            $.ajax({
                url: "/lawsuit_subject_types/1",
                type: "GET",
                data: "",
                success: function (data) {
                    $("#lawsuit_subject_types").html("");
                    $("#lawsuit_subject_types").append(
                        '<option value="" disabled selected>Seçin</option>'
                    );
                    $.each(data, function (index, value) {
                        $("#lawsuit_subject_types").append(
                            '<option value="' + value.id + '">' + value.name + "</option>"
                        );
                    });
                },
            });
        });
    */

    $("input[name='arbiter_define_protocol_answer']").on("change", function () {
        if ($(this).val() == 0) {
            $(".answer_yes").show();
        } else {
            $(".answer_yes").hide();
        }
    });

    $("#lawsuit_types").on("change", function () {
        //
    });

    $("#lawsuit_subject_types").on("change", function () {
        if (parseInt($(this).val()) > 0) {
            $("#lawsuit_subjects_select").show();
            $.ajax({
                url: "/lawsuit_subjects/" + $(this).val(),
                type: "GET",
                data: "",
                success: function (data) {
                    $("#lawsuit_subjects").html("");
                    $("#lawsuit_subjects").append(
                        '<option value="" disabled selected>Seçin</option>'
                    );
                    $.each(data, function (index, value) {
                        $("#lawsuit_subjects").append(
                            '<option value="' + value.id + '">' + value.name + "</option>"
                        );
                    });
                },
            });
        } else {
            $("#lawsuit_subjects").html("");
            $("#lawsuit_subjects_select").hide();
        }
    });

    $("#process_type_id").on("change", function () {
        if ($(this).val() == 4 || $(this).val() == 5) {
            $("#result_type").show();
            $("#result_date").show();
        } else {
            $("#result_type").hide();
            $("[name='result_type_id']").val($("#result_type option:first").val());
            $("#result_date").hide();
            $("[name='result_date']").val($("#result_date option:first").val());
        }
    });

    $(document).on("click", ".addEmployeeBefore", function (e) {
        e.preventDefault();
        $("#employeeBeforeButton").attr(
            "data-index",
            $(".addEmployeeBefore").data("index")
        );
        $("#employeeBeforeModal").modal("show");
    });
});

/* Fonksiyonlar */

function tcValidate(input) {
    return false; // kaldırılacak
    const tcNo = input.val().replace(/_/g, "").trim();
    const isValid = tcNo.length === 11;
    input.toggleClass("errorClass", !isValid);
    return !isValid;
}

function mersisValidate(input) {
    const mersisNo = input.val().replace(/[_ ]/g, "").trim();
    const isValid = mersisNo.length === 16;
    input.toggleClass("errorClass", !isValid);
    return !isValid;
}

function taxValidate(input) {
    const taxNo = input.val().replace(/_/g, "").trim();
    const isValid = taxNo.length === 10;
    input.toggleClass("errorClass", !isValid);
    return !isValid;
}

function issetApplicantTypeInSide() {
    const hasApplicant = sides.some(side => side.applicantType === Enums.Sides.APPLICANT);
    const hasOtherSide = sides.some(side => side.applicantType === Enums.Sides.OTHER_SIDE);
    return !(hasApplicant && hasOtherSide) ? 1 : 0;
}

function getStep() {
    return parseInt(
        $("[data-ktwizard-type='step'][data-ktwizard-state='current'] div div.kt-wizard-v4__nav-number").text()
    );
}

// Lawyer Operations
function getActiveSide(memberIndex) {
    for (var i = 0; i < sides.length; i++) {
        if (sides[i].index == memberIndex) {
            return sides[i];
        }
    }
}

function limitText(text, limit) {
    if (text.length > limit) {
        return text.substring(0, limit) + "...";
    } else {
        return text;
    }
}

$.validator.addMethod("application_date_required", function (value) {
    var application_date = moment(
        $("#application_date input").val(),
        "DD.MM.YYYY"
    );
    var job_date = moment($("#job_date input").val(), "DD.MM.YYYY");
    var diff_day = parseInt(application_date.diff(job_date, "days"));

    if (diff_day > 0 && delivery_by == "Sistem Üzerinden") {
        return false;
    }

    return true;
});
