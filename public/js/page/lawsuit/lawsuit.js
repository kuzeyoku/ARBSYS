var sides = [];
var selectedApplicantType = "";
var lawyerIndex, authorizedIndex, employeeIndex, representativeIndex, commissionerIndex, expertIndex;
var index = 0;
var activeSide, personType;

function getModalContent(type) {
    $.ajax({
        url: $(".modalContentUrl").data("url"),
        type: "post",
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            type: type,
        },
        success: function (response) {
            $("#personModal .modal-header h5").text(response.type.name);
            $("#personModal .modal-body form").html(response.data);
            $("#personModal .modal-body form #person_type").prop("disabled", true);
            $("#personModal .modal-footer .personAddButton").attr(
                "id",
                "save" + response.personType
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
        getModalContent($(this).data("type"));
    });

    //Taraf Tanımlama İşlemi
    $(document).on("change", "#applicant_type", function () {
        if ($(this).val() == 1) {
            selectedApplicantType = "BAŞVURUCU";
        } else if ($(this).val() == 2) {
            selectedApplicantType = "DİĞER TARAF";
        }
    });

    //Gerçek Kişi Ekleme İşlemi
    $(document).on("click", "#saveperson", function (e) {
        e.preventDefault();
        var hasError = false;
        let name = $("input[name='name']").val();
        let identification = $("input[name='identification']").val();
        let tax_office = $("input[name='tax_office']").val();
        let tax_number = $("input[name='tax_number']").val();
        let address = $("textarea[name='address']").val();
        let phone = $("input[name='phone']").val();
        let fixed_phone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();
        let kep_address = $("input[name='kep_address']").val();
        let check = getCheckElements();

        $("input[required]").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("errorClass");
                hasError = true;
            } else {
                $(this).removeClass("errorClass");
            }
        });

        if (hasError) {
            notification("Lütfen Tüm Zorunlu Alanları Doldurun.", "error");
        }

        if (hasError) {
            return false;
        }

        let side = {
            index: index,
            name: name,
            identification: identification,
            tax_office: tax_office,
            tax_number: tax_number,
            address: address,
            phone: phone,
            fixed_phone: fixed_phone,
            email: email,
            kep_address: kep_address,
            check: check,
            applicantType: selectedApplicantType,
            type: 1,
        };

        sides.push(side);
        $("#personModal").modal("hide");
        generateSideBlock(side);
        index++;
    });

    //Tüzel Kişi Ekleme İşlemi
    $(document).on("click", "#savecompany", function (e) {
        e.preventDefault();
        var hasError = false;
        let name = $("input[name='name']").val();
        let detsis_number = $("input[name='detsis_number']").val();
        let mersis_number = $("input[name='mersis_number']").val();
        let tax_office = $("input[name='tax_office']").val();
        let tax_number = $("input[name='tax_number']").val();
        let address = $("textarea[name='address']").val();
        let phone = $("input[name='phone']").val();
        let fixed_phone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();
        let kep_address = $("input[name='kep_address']").val();
        let check = getCheckElements();

        $("input[required]").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("errorClass");
                hasError = true;
            } else {
                $(this).removeClass("errorClass");
            }
        });
        if (hasError) {
            notification("Lütfen Tüm Zorunlu Alanları Doldurun", "error");
        }
        if (hasError) {
            return false;
        }
        let side = {
            index: index,
            name: name,
            detsis_number: detsis_number,
            mersis_number: mersis_number,
            tax_office: tax_office,
            tax_number: tax_number,
            address: address,
            phone: phone,
            fixed_phone: fixed_phone,
            email: email,
            kep_address: kep_address,
            check: check,
            applicantType: selectedApplicantType,
            type: 2,
        };
        sides.push(side);
        $("#personModal").modal("hide");
        generateSideBlock(side);
        index++;
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

    //Avukat Ekleme İşlemi
    $(document).on("click", "#savelawyer", function (e) {
        e.preventDefault();

        var hasError = false;

        let identification = $("input[name='identification']").val();
        let name = $("input[name='name']").val();
        let address = $("input[name='address']").val();
        let phone = $("input[name='phone']").val();
        let fixed_phone = $("input[name='fixed_phone']").val();
        let baro = $("input[name='baro']").val();
        let registration_no = $("input[name='registration_no']").val();
        let email = $("input[name='email']").val();

        $("input[required]").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("errorClass");
                hasError = true;
            } else {
                $(this).removeClass("errorClass");
            }
        });

        if (hasError) {
            notification("Lütfen Tüm Zorunlu Alanları Doldurun", "error");
        }

        if (hasError) {
            return false;
        }

        activeSide = getActiveSide(lawyerIndex);
        var lawyerArrLength = 0
        if (activeSide.lawyers != null) { lawyerArrLength = activeSide.lawyers.length }
        let lawyer = {
            id: generateUniqueId(),
            identification: identification,
            name: name,
            address: address,
            phone: phone,
            fixed_phone: fixed_phone,
            baro: baro,
            registration_no: registration_no,
            email: email,
        };

        let activeSideLawyers = [];

        if (activeSide.lawyers != null) {
            for (var i = 0; i < activeSide.lawyers.length; i++) {
                let row = activeSide.lawyers[i];
                activeSideLawyers.push(row);
            }
        }

        activeSideLawyers.push(lawyer);

        activeSide.lawyers = activeSideLawyers;

        $("#lawyerBlock" + lawyerIndex).html(
            getMemberBlock(activeSideLawyers, lawyerIndex, Members.LAWYER.toLowerCase())
        );
        $("#personModal").modal("hide");
    });

    //$("#saveAuthorized").on("click", function (e) { 
    $(document).on("click", "#saveauthorized", function (e) { // saveOther -> saveAuthorized
        e.preventDefault();

        var hasError = false;

        let tcNo = $("input[name='identification']").val();
        let nameSurname = $("input[name='name']").val();
        let address = $("input[name='address']").val();
        let gsm = $("input[name='phone']").val();
        let fixedPhone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();

        $("input[required]").each(function () {
          if ($(this).val() == "") {
              $(this).addClass("errorClass");
              hasError = true;
          } else {
              $(this).removeClass("errorClass");
          }
      });

      var hasErrorTc = tcValidate($("input[name='identification']"));

      if (hasErrorTc) {
          notification("HATA", "T.C. No 11 hane olmalıdır", "error");
      }

      if (hasError) {
        notification("Lütfen Tüm Zorunlu Alanları Doldurun", "error");
      }

      if (hasErrorTc || hasError) {
          return false;
      }

        let authorized = {
            id: generateUniqueId(),
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(authorizedIndex);

        let activeSideAuthorizeds = [];

        if (activeSide.authorizeds != null) {
            for (var i = 0; i < activeSide.authorizeds.length; i++) {
                let row = activeSide.authorizeds[i];
                activeSideAuthorizeds.push(row);
            }
        }

        activeSideAuthorizeds.push(authorized);

        activeSide.authorizeds = activeSideAuthorizeds;

        $("#authorizedBlock" + authorizedIndex).html(
            getMemberBlock(activeSideAuthorizeds, authorizedIndex, Members.AUTHORIZED.toLowerCase())
        );
        $("#personModal").modal("hide");
    });

    // Çalışan ekle,
    $(document).on("click", "#saveemployee", function (e) {
        
        e.preventDefault();
        var hasError = false;

        let tcNo = $("input[name='identification']").val();
        let nameSurname = $("input[name='name']").val();
        let address = $("input[name='address']").val();
        let gsm = $("input[name='phone']").val();
        let fixedPhone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();

        $("input[required]").each(function () {
          if ($(this).val() == "") {
              $(this).addClass("errorClass");
              hasError = true;
          } else {
              $(this).removeClass("errorClass");
          }
      });

        var hasErrorTc = tcValidate($("input[name='identification']"));

        if (hasErrorTc) {
            notification("HATA", "T.C. No 11 hane olmalıdır", "error");
        }

        if (hasError) {
          notification("Lütfen Tüm Zorunlu Alanları Doldurun", "error");
        }

        if (hasErrorTc || hasError) {
            return false;
        }

        let employees = {
            id: generateUniqueId(),
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(employeeIndex);

        let activeSideEmployees = [];

        if (activeSide.employees != null) {
            for (var i = 0; i < activeSide.employees.length; i++) {
                let row = activeSide.employees[i];
                activeSideEmployees.push(row);
            }
        }

        activeSideEmployees.push(employees);

        activeSide.employees = activeSideEmployees;

        $("#employeeBlock" + employeeIndex).html(
            getMemberBlock(activeSideEmployees, employeeIndex, Members.EMPLOYEE.toLowerCase())
        );
        $("#personModal").modal("hide");
    });

    // $("#saverepresentative").on("click", function (e) {
    $(document).on("click", "#saverepresentative", function (e) {
        e.preventDefault();

        var hasError = false;

        let tcNo = $("input[name='identification']").val();
        let nameSurname = $("input[name='name']").val();
        let address = $("input[name='address']").val();
        let gsm = $("input[name='phone']").val();
        let fixedPhone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();

        $(".rrq").each(function () {
            if ($(this).val() == "" && $(this).attr("id")) {
                $(this).addClass("errorClass");
                hasError = true;
            } else {
                $(this).removeClass("errorClass");
            }
        });

        var hasErrorTc = tcValidate($("input[name='identification']").val());

        if (hasErrorTc) {
            notification("HATA", "T.C. No 11 hane olmalıdır", "error");
        }

        if (hasError) {
            notification("HATA", "İşaretli alanlar boş bırakılamaz", "error");
        }

        if (hasErrorTc || hasError) {
            return false;
        }

        let representative = {
            id: generateUniqueId(),
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(representativeIndex);

        let activeSideRepresentatives = [];

        if (activeSide.representatives != null) {
            for (var i = 0; i < activeSide.representatives.length; i++) {
                let row = activeSide.representatives[i];
                activeSideRepresentatives.push(row);
            }
        }

        activeSideRepresentatives.push(representative);

        activeSide.representatives = activeSideRepresentatives;

        $("#representativeBlock" + representativeIndex).html(
            getMemberBlock(activeSideRepresentatives, representativeIndex, Members.REPRESENTATIVE.toLowerCase())
        );
        $("#personModal").modal("hide");
    });

    $(document).on("click", "#savecommissioner", function (e) {
      e.preventDefault();

      var hasError = false;

      let tcNo = $("input[name='identification']").val();
      let nameSurname = $("input[name='name']").val();
      let address = $("input[name='address']").val();
      let gsm = $("input[name='phone']").val();
      let fixedPhone = $("input[name='fixed_phone']").val();
      let email = $("input[name='email']").val();

      $(".erq").each(function () {
          if ($(this).val() == "" && $(this).attr("id")) {
              $(this).addClass("errorClass");
              hasError = true;
          } else {
              $(this).removeClass("errorClass");
          }
      });

      var hasErrorTc = tcValidate($("input[name='identification']").val());

      if (hasErrorTc) {
          notification("HATA", "T.C. No 11 hane olmalıdır", "error");
      }

      if (hasError) {
          notification("HATA", "İşaretli alanlar boş bırakılamaz", "error");
      }

      if (hasErrorTc || hasError) {
          return false;
      }

      let commissioner = {
          id: generateUniqueId(),
          tc: tcNo,
          name: nameSurname,
          address: address,
          phone: gsm,
          fixedPhone: fixedPhone,
          email: email,
      };

      activeSide = getActiveSide(commissionerIndex);

      let activeSideCommissioners = [];

      if (activeSide.commissioners != null) {
          for (var i = 0; i < activeSide.commissioners.length; i++) {
              let row = activeSide.commissioners[i];
              activeSideCommissioners.push(row);
          }
      }

      activeSideCommissioners.push(commissioner);

      activeSide.commissioners = activeSideCommissioners;

      $("#commissionerBlock" + commissionerIndex).html(
          getMemberBlock(activeSideCommissioners, commissionerIndex, Members.COMMISSIONER.toLowerCase())
      );
      $("#personModal").modal("hide");
  });

    // $("#saveExpert").on("click", function (e) {
    $(document).on("click", "#saveexpert", function (e) {
        e.preventDefault();

        var hasError = false;

        let tcNo = $("input[name='identification']").val();
        let nameSurname = $("input[name='name']").val();
        let address = $("input[name='address']").val();
        let gsm = $("input[name='phone']").val();
        let fixedPhone = $("input[name='fixed_phone']").val();
        let email = $("input[name='email']").val();

        $(".erq").each(function () {
            if ($(this).val() == "" && $(this).attr("id")) {
                $(this).addClass("errorClass");
                hasError = true;
            } else {
                $(this).removeClass("errorClass");
            }
        });

        var hasErrorTc = tcValidate($("input[name='identification']").val());

        if (hasErrorTc) {
            notification("HATA", "T.C. No 11 hane olmalıdır", "error");
        }

        if (hasError) {
            notification("HATA", "İşaretli alanlar boş bırakılamaz", "error");
        }

        if (hasErrorTc || hasError) {
            return false;
        }

        let experts = {
            id: generateUniqueId(),
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(expertIndex);

        let activeSideExperts = [];

        if (activeSide.experts != null) {
            for (var i = 0; i < activeSide.experts.length; i++) {
                let row = activeSide.experts[i];
                activeSideExperts.push(row);
            }
        }

        activeSideExperts.push(experts);

        activeSide.experts = activeSideExperts;

        $("#expertBlock" + expertIndex).html(
            getMemberBlock(activeSideExperts, expertIndex, Members.EXPERT.toLowerCase())
        );
        $("#personModal").modal("hide");
    });
    // ---------------------------------- save modals  ----------------------------------//

    // ----------------------------------  modal events  ----------------------------------//
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
      console.log("add Person To Side", Date().toString())
        e.preventDefault();
        getModalContent($(this).attr("personType"));
        const personType = $(this).attr("personType");
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
    return false; // Kaldırılacak

    var tcNo = input.val();

    tcNo = tcNo.replace(/_/g, "");

    console.log(tcNo);

    if (tcNo.trim().length !== 11) {
        input.addClass("errorClass");

        return true;
    } else {
        input.removeClass("errorClass");

        return false;
    }
}

function mersisValidate(input) {
    var mersisNo = input.val();

    mersisNo = mersisNo.replace(/_/g, "");
    mersisNo = mersisNo.replace(/ /g, "");

    console.log(mersisNo);

    if (mersisNo.trim().length !== 16) {
        input.addClass("errorClass");

        return true;
    } else {
        input.removeClass("errorClass");

        return false;
    }
}

function taxValidate(input) {
    var taxNo = input.val();

    taxNo = taxNo.replace(/_/g, "");

    console.log(taxNo);

    if (taxNo.trim().length !== 10) {
        input.addClass("errorClass");

        return true;
    } else {
        input.removeClass("errorClass");

        return false;
    }
}

function issetApplicantTypeInSide() {
    var b = 0;
    var d = 0;

    for (var i = 0; i < sides.length; i++) {
        if (sides[i].applicantType == "BAŞVURUCU") {
            b = 1;
        }
        if (sides[i].applicantType == "DİĞER TARAF") {
            d = 1;
        }
    }

    return b == 0 || d == 0 ? 1 : 0;
}

function issetLawyerOrAuthorizedInSide() {
    for (var i = 0; i < sides.length; i++) {
        var a = 0;
        var b = 0;

        if (
            sides[i].type == 2 &&
            (sides[i].lawyer == undefined || sides[i].lawyer.length == 0)
        ) {
            a = 1;
        }

        if (
            sides[i].type == 2 &&
            (sides[i].authorizeds == undefined || sides[i].authorizeds.length == 0)
        ) {
            b = 1;
        }

        if (a == 1 && b == 1) {
            return 1;
        }
    }

    return 0;
}

function getStep() {
    return parseInt(
        $(
            "[data-ktwizard-type='step'][data-ktwizard-state='current'] div div.kt-wizard-v4__nav-number"
        ).text()
    );
}

function notification(message, template) {
    toastr[template](message);

    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
}

// ---------------------------------- lawyer operations ----------------------------------//

function getActiveSide(lawyerIndex) {
    for (var i = 0; i < sides.length; i++) {
        if (sides[i].index == lawyerIndex) {
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

function generateSideBlock(side) {
  const cardClass = side.applicantType === "BAŞVURUCU" ? "bg-light" : "bg-secondary";
  const tcOrTax = side.type === 1
      ? `TC Kimlik No: ${side.identification}`
      : `Mersis No: ${side.mersis_number}`;

  const createButton = (blockId, personType, label) => {
      return `
          <div id="${blockId}${side.index}">
              <button class="btn btn-sm btn-warning addPersonToSide" 
                      personType="${personType}" 
                      data-index="${side.index}">
                  <i class="fas fa-plus"></i> ${label}
              </button>
          </div>`;
  };

  const deleteButton = `
      <div id="${side.index}">
          <button class="btn btn-sm btn-danger deleteSide" data-index="${side.index}">
              <i class="fas fa-times"></i> Taraf Sil
          </button>
      </div>`;

  const html = `
      <div id="sideCard-${side.index}" class="w-100">
          <div class="card ${cardClass}">
              <div class="card-body" style="color: #000000;">
                  <div class="d-flex flex-row justify-content-between align-items-center">
                      <div>${side.applicantType}</div>
                      <div style="width:220px">${limitText(side.name, 30)}<br />${tcOrTax}</div>
                      ${createButton("lawyerBlock", "lawyer", "Vekil Ekle")}
                      ${createButton("authorizedBlock", "authorized", "Yetkili Ekle")}
                      ${createButton("employeeBlock", "employee", "Çalışan Ekle")}
                      ${createButton("representativeBlock", "representative", "Kanuni Temsilci Ekle")}
                      ${createButton("commissionerBlock", "commissioner", "Komisyon Üyesi Ekle")}
                      ${createButton("expertBlock", "expert", "Uzman Kişi Ekle")}
                      ${deleteButton}
                  </div>
              </div>
          </div>
      </div>`;

  if (side.applicantType === "BAŞVURUCU") {
      $(".sideBasvuranRow").append(html);
  } else if (side.applicantType === "DİĞER TARAF") {
      $(".sideKarsiTarafRow").append(html);
  }

  $("#applicant_add_button").show();
  $("#applicant_select").remove();
}

function generateUniqueId() {
  return (
      Math.random().toString(36).substr(2, 9) +
      Math.random().toString(36).substr(2, 9)
  );
}

function getMemberBlock(members, memberIndex, memberType){
  let text = members.length > 1 ? Localization[`${memberType}s`].tr : Localization[memberType].tr;
  const addButtonHtml = `
        <strong class="member-block-title">${text}</strong> - 
        <a 
            class="add${capitalizeFirstLetter(memberType)} addPersonToSide" 
            personType="${memberType}" 
            href="javascript:;" 
            style="color: #f27474; font-size: 14px;" 
            data-index="${memberIndex}"
        >
            Ekle
        </a>
        <br />
    `;
    // ${capitalizeFirstLetter(memberType)}
    const membersHtml = members
        .map((member, i) => `
            <p id="remove-${memberType}-${i}-${memberIndex}">
                ${member.name} /
                <a 
                    class="removeMember"
                    personType="${memberType}" 
                    href="javascript:;" 
                    style="color: #f27474; font-size: 14px;" 
                    data-index="${memberIndex}" 
                    data-id="${member.id}" 
                >
                    Çıkar
                </a>
            </p>
        `)
        .join("");

    return addButtonHtml + membersHtml;
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

function capitalizeFirstLetter(input) {
  return input
      .toLowerCase()
      .replace(/(^\w|\s\w)/g, match => match.toUpperCase());
}

/* Fonksiyonlar */

/* ENUMS */
const Members = Object.freeze({
  LAWYER:   "LAWYER",
  AUTHORIZED:  "AUTHORIZED",
  EMPLOYEE: "EMPLOYEE",
  REPRESENTATIVE: "REPRESENTATIVE",
  COMMISSIONER: "COMMISSIONER",
  EXPERT: "EXPERT"
});

/* Strings */
const Localization = {
  "lawyer": {
    "tr": "Vekil",
    "en": "Lawyer"
  },
  "lawyers": {
    "tr": "Vekiller",
    "en": "Lawyers"
  },
  "authorized": {
    "tr": "Yetkili",
    "en": "Authorized"
  },
  "authorizeds": {
    "tr": "Yetkililer",
    "en": "Authorizeds"
  },
  "employee": {
    "tr": "Çalışan",
    "en": "Employee"
  },
  "employees": {
    "tr": "Çalışanlar",
    "en": "Employees"
  },
  "representative": {
    "tr": "Kanuni Temsilci",
    "en": "Representative"
  },
  "representatives": {
    "tr": "Kanuni Temsilciler",
    "en": "Representatives"
  },
  "commissioner": {
    "tr": "Komisyon Üyesi",
    "en": "Commissioner"
  },
  "commissioners": {
    "tr": "Komisyon Üyeleri",
    "en": "Commissioners"
  },
  "expert": {
    "tr": "Uzman Kişi",
    "en": "Expert"
  },
  "experts": {
    "tr": "Uzman Kişiler",
    "en": "Experts"
  }
}