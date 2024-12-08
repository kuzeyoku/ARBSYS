// FIXME: Satıra 2 vekil eklendiğinde ikisini birden çıkarıp ekleme yapılırsa biri silinmiyor

var sides = [];
var selectedApplicantType = "";
var lawyerIndex, authorizedIndex, employeeIndex, representativesIndex, commissionerIndex, expertsIndex;
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

        let lawyer = {
            identification: identification,
            name: name,
            address: address,
            phone: phone,
            fixed_phone: fixed_phone,
            baro: baro,
            registration_no: registration_no,
            email: email,
        };
        activeSide = getActiveSide(lawyerIndex);

        let activeSideLawyers = [];

        if (activeSide.lawyer != null) {
            for (var i = 0; i < activeSide.lawyer.length; i++) {
                let row = activeSide.lawyer[i];
                activeSideLawyers.push(row);
            }
        }

        activeSideLawyers.push(lawyer);

        activeSide.lawyer = activeSideLawyers;

        $("#lawyerBlock" + lawyerIndex).html(
            getLawyerBlock(activeSideLawyers, lawyerIndex)
        );
        $("#personModal").modal("hide");
        //console.log(activeSide.lawyer)
    });

    //$("#saveAuthorized").on("click", function (e) { 
    $(document).on("click", "#saveauthorized", function (e) { // saveOther -> saveAuthorized
        e.preventDefault();
        console.log("authorized")

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
            getAuthorizedsBlock(activeSideAuthorizeds, authorizedIndex)
        );
        // $("#authorizedModal").modal("hide");
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
            getEmployeesBlock(activeSideEmployees, employeeIndex)
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
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(representativesIndex);

        let activeSideRepresentatives = [];

        if (activeSide.representatives != null) {
            for (var i = 0; i < activeSide.representatives.length; i++) {
                let row = activeSide.representatives[i];
                activeSideRepresentatives.push(row);
            }
        }

        activeSideRepresentatives.push(representative);

        activeSide.representatives = activeSideRepresentatives;

        $("#representativeBlock" + representativesIndex).html(
            getRepresentativesBlock(activeSideRepresentatives, representativesIndex)
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
          getCommissionersBlock(activeSideCommissioners, commissionerIndex)
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
            tc: tcNo,
            name: nameSurname,
            address: address,
            phone: gsm,
            fixedPhone: fixedPhone,
            email: email,
        };

        activeSide = getActiveSide(expertsIndex);

        let activeSideExperts = [];

        if (activeSide.experts != null) {
            for (var i = 0; i < activeSide.experts.length; i++) {
                let row = activeSide.experts[i];
                activeSideExperts.push(row);
            }
        }

        activeSideExperts.push(experts);

        activeSide.experts = activeSideExperts;

        $("#expertBlock" + expertsIndex).html(
            getExpertsBlock(activeSideExperts, expertsIndex)
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
        e.preventDefault();
        getModalContent($(this).attr("personType"));
        switch ($(this).attr("personType")) {
            case "lawyer": //avukat
                lawyerIndex = $(this).attr("data-index");
                break;
            case "authorized": //yetkili
                authorizedIndex = $(this).attr("data-index");
                break;
            case "employee": //çalışan
                employeeIndex = $(this).attr("data-index");
                break;
            case "representative": //temsilci
                representativesIndex = $(this).attr("data-index");
                break;
            case "commissioner": //komisyon üyesi
                commissionerIndex = $(this).attr("data-index");
                break;
            case "expert": //Uzman kişi
                expertsIndex = $(this).attr("data-index");
                break;
        }
    });

    $(document).on("click", ".addLawyer", function (e) {
        e.preventDefault();
        console.log("add lawyer")
        lawyerIndex = $(this).attr("data-index");
        $("#lawyerModal").modal("show");
    });

    $(document).on("click", ".removeLawyer", function (e) {
        e.preventDefault();
        console.log("remove lawyer")
        lawyerIndex = $(this).attr("data-index");
        var lawyerId = $(this).attr("data-id");
        activeSide = getActiveSide(lawyerIndex);
        removeSideInLawyer(activeSide, lawyerId);
        $("#remove-lawyer-" + lawyerId + "-" + lawyerIndex).remove();
    });

    $(document).on("click", ".addAuthorized", function (e) {
        e.preventDefault();
        authorizedIndex = $(this).attr("data-index");
        $("#authorizedModal").modal("show");
    });

    $(document).on("click", ".removeAuthorized", function (e) {
      e.preventDefault();
      authorizedIndex = $(this).attr("data-index");
      var authorizedId = $(this).attr("data-id");
      activeSide = getActiveSide(authorizedIndex);
      removeSideInAuthorized(activeSide, authorizedId);
      $("#remove-authorized-" + authorizedId + "-" + authorizedIndex).remove();
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

    $(document).on("click", ".addEmployee", function (e) {
        e.preventDefault();
        employeeIndex = $(this).attr("data-index");
        $("#employeeBeforeModal").modal("hide"); // Bu kalkıcak muhtemelen
        $("#employeeModal").modal("show");
    });

    $(document).on("click", ".removeEmployee", function (e) {
        e.preventDefault();
        employeeIndex = $(this).attr("data-index");
        var employeeId = $(this).attr("data-id");
        activeSide = getActiveSide(employeeIndex);
        removeSideInEmployee(activeSide, employeeId);
        $("#remove-employee-" + employeeId + "-" + employeeIndex).remove();
    });

    $(document).on("click", ".addRepresentative", function (e) {
        e.preventDefault();
        representativesIndex = $(this).attr("data-index");
        $("#representativeModal").modal("show");
    });

    $(document).on("click", ".removeRepresentative", function (e) {
        e.preventDefault();
        representativesIndex = $(this).attr("data-index");
        var representativeId = $(this).attr("data-id");
        activeSide = getActiveSide(representativesIndex);
        removeSideInRepresentative(activeSide, representativeId);
        $(
            "#remove-representative-" + representativeId + "-" + representativesIndex
        ).remove();
    });

    $(document).on("click", ".addCommissioner", function (e) {
      e.preventDefault();
      commissionerIndex = $(this).attr("data-index");
      $("#commissionerModal").modal("show");
  });

  $(document).on("click", ".removeCommissioner", function (e) {
      e.preventDefault();
      commissionerIndex = $(this).attr("data-index");
      var commissionerId = $(this).attr("data-id");
      activeSide = getActiveSide(commissionerIndex);
      removeSideInCommissioner(activeSide, commissionerId);
      $("#remove-commissioner-" + commissionerId + "-" + commissionerIndex).remove();
  });

    $(document).on("click", ".addExpert", function (e) {
        e.preventDefault();
        expertsIndex = $(this).attr("data-index");
        $("#expertModal").modal("show");
    });

    $(document).on("click", ".removeExpert", function (e) {
        e.preventDefault();
        expertsIndex = $(this).attr("data-index");
        var expertId = $(this).attr("data-id");
        activeSide = getActiveSide(expertsIndex);
        removeSideInExpert(activeSide, expertId);
        $("#remove-expert-" + expertId + "-" + expertsIndex).remove();
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
    return false;

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

function removeSideInAuthorized(activeSide, authorizedId) { // addResponsible -> addAuthorized ?
    let activeSideAuthorizeds = [];

    if (activeSide.authorizeds != null) {
        for (var i = 0; i < activeSide.authorizeds.length; i++) {
            let row = activeSide.authorizeds[i];
            if (i != authorizedId) activeSideAuthorizeds.push(row);
        }
    }

    if (activeSideAuthorizeds.length == 0) {
        $(`#authorizedBlock${activeSide.index}`).empty();
        $(`#authorizedBlock${activeSide.index}`).append(`
        YETKİLİ<br /> <a href="javascript:;" class="btn btn-sm btn-danger addAuthorized addPersonToSide" personType="authorized" data-index="${activeSide.index}">Ekle</a>
        `);
    }

    activeSide.authorizeds = activeSideAuthorizeds;
}

function removeSideInEmployee(activeSide, employeeId) {
    let activeSideEmployees = [];

    if (activeSide.employees != null) {
        for (var i = 0; i < activeSide.employees.length; i++) {
            let row = activeSide.employees[i];
            if (i != employeeId) activeSideEmployees.push(row);
        }
    }

    if (activeSideEmployees.length == 0) {
      $(`#employeeBlock${activeSide.index}`).empty();
      $(`#employeeBlock${activeSide.index}`).append(`
      Çalışan<br /> <a href="javascript:;" class="btn btn-sm btn-danger addEmployee addPersonToSide" personType="employee" data-index="${activeSide.index}">Ekle</a>
      `);
  }

    activeSide.employees = activeSideEmployees;
}

function removeSideInRepresentative(activeSide, representativeId) {
    let activeSideRepresentatives = [];

    if (activeSide.representatives != null) {
        for (var i = 0; i < activeSide.representatives.length; i++) {
            let row = activeSide.representatives[i];
            if (i != representativeId) activeSideRepresentatives.push(row);
        }
    }

    if (activeSideRepresentatives.length == 0) {
        $(`#representativeBlock${activeSide.index}`).empty();
        $(`#representativeBlock${activeSide.index}`).append(`
        KANUNİ TEMSİLCİ<br /> <a href="javascript:;" class="btn btn-sm btn-danger addRepresentative addPersonToSide" personType="representative" data-index="${activeSide.index}">Ekle</a>
        `);
    }

    activeSide.representatives = activeSideRepresentatives;
}

function removeSideInCommissioner(activeSide, commissionerId) {
  let activeSideCommissioners = [];

  if (activeSide.commissioners != null) {
      for (var i = 0; i < activeSide.commissioners.length; i++) {
          let row = activeSide.commissioners[i];
          if (i != commissionerId) activeSideCommissioners.push(row);
      }
  }
  if (activeSideCommissioners.length == 0) {
      $(`#commissionerBlock${activeSide.index}`).empty();
      $(`#commissionerBlock${activeSide.index}`).append(`
      KOMİSYON ÜYESİ<br /> <a href="javascript:;" class="btn btn-sm btn-danger addCommissioner addPersonToSide" personType="commissioner" data-index="${activeSide.index}">Ekle</a>
      `);
  }
  activeSide.commissioners = activeSideCommissioners;
}

function removeSideInExpert(activeSide, expertId) {
    let activeSideExperts = [];

    if (activeSide.experts != null) {
        for (var i = 0; i < activeSide.experts.length; i++) {
            let row = activeSide.experts[i];
            if (i != expertId) activeSideExperts.push(row);
        }
    }
    if (activeSideExperts.length == 0) {
        $(`#expertBlock${activeSide.index}`).empty();
        $(`#expertBlock${activeSide.index}`).append(`
        UZMAN KİŞİ<br /> <a href="javascript:;" class="btn btn-sm btn-danger addExpert addPersonToSide" personType="expert" data-index="${activeSide.index}">Ekle</a>
        `);
    }
    activeSide.experts = activeSideExperts;
}

function getAuthorizedsBlock(authorizeds, authorizedIndex) {
    let text = "Yetkili";

    if (authorizeds.length > 1) text = "Yetkililer";

    var html =
        "<strong>" +
        text +
        '</strong> - <a class="addAuthorized addPersonToSide" personType="authorized" href="javascript:;"  style="color: #f27474;font-size: 14px;" data-index="' +
        authorizedIndex +
        '">Ekle</a> <br/>';
    for (var i = 0; i < authorizeds.length; i++) {
        let authorized = authorizeds[i];
        html +=
            '<p id="remove-authorized-' +
            i +
            "-" +
            authorizedIndex +
            '">' +
            authorized.name +
            "/" +
            ' - <a class="removeAuthorized" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
            authorizedIndex +
            '" data-id="' +
            i +
            '">Çıkar</a></p>';
    }
    return html;
}

function getEmployeesBlock(employees, employeeIndex) {
    let text = "Çalışan";

    if (employees.length > 1) text = "Çalışanlar";

    var html =
        "<strong>" +
        text +
        '</strong> - <a class="addEmployee addPersonToSide" personType="employee" href="javascript:;"  style="color: #f27474;font-size: 14px;" data-index="' +
        employeeIndex +
        '">Ekle</a> <br/>';
    for (var i = 0; i < employees.length; i++) {
        let employee = employees[i];
        html +=
            '<p id="remove-employee-' +
            i +
            "-" +
            employeeIndex +
            '">' +
            employee.name +
            "/" +
            ' - <a class="removeEmployee" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
            employeeIndex +
            '" data-id="' +
            i +
            '">Çıkar</a></p>';
    }
    return html;
}

function getRepresentativesBlock(representatives, representativesIndex) {
    let text = "Kanuni Temsilci";

    if (representatives.length > 1) text = "Kanuni Temsilciler";

    var html =
        "<strong>" +
        text +
        '</strong> - <a class="addRepresentative addPersonToSide" personType="representative" href="javascript:;"  style="color: #f27474;font-size: 14px;" data-index="' +
        representativesIndex +
        '">Ekle</a> <br/>';
    for (var i = 0; i < representatives.length; i++) {
        let representative = representatives[i];
        html +=
            '<p id="remove-representative-' +
            i +
            "-" +
            representativesIndex +
            '">' +
            representative.name +
            "/" +
            ' - <a class="removeRepresentative" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
            representativesIndex +
            '" data-id="' +
            i +
            '">Çıkar</a></p>';
    }
    return html;
}

function getCommissionersBlock(commissioners, commissionerIndex) {
  let text = "Komisyon Üyesi";

  if (commissioners.length > 1) text = "Komisyon Üyeleri";

  var html =
      "<strong>" +
      text +
      '</strong> - <a class="addCommissioner addPersonToSide" personType="commissioner" href="javascript:;"  style="color: #f27474;font-size: 14px;" data-index="' +
      commissionerIndex +
      '">Ekle</a> <br/>';
  for (var i = 0; i < commissioners.length; i++) {
      let commissioner = commissioners[i];
      html +=
          '<p id="remove-commissioner-' +
          i +
          "-" +
          commissionerIndex +
          '">' +
          commissioner.name +
          "/" +
          ' - <a class="removeCommissioner" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
          commissionerIndex +
          '" data-id="' +
          i +
          '">Çıkar</a></p>';
  }
  return html;
}

function getExpertsBlock(experts, expertsIndex) {
    let text = "Uzman Kişi";

    if (experts.length > 1) text = "Uzman Kişiler";

    var html =
        "<strong>" +
        text +
        '</strong> - <a class="addExpert addPersonToSide" personType="expert" href="javascript:;"  style="color: #f27474;font-size: 14px;" data-index="' +
        expertsIndex +
        '">Ekle</a> <br/>';
    for (var i = 0; i < experts.length; i++) {
        let expert = experts[i];
        html +=
            '<p id="remove-expert-' +
            i +
            "-" +
            expertsIndex +
            '">' +
            expert.name +
            "/" +
            ' - <a class="removeExpert" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
            expertsIndex +
            '" data-id="' +
            i +
            '">Çıkar</a></p>';
    }
    return html;
}

// ---------------------------------- lawyer operations ----------------------------------//

function getActiveSide(lawyerIndex) {
    for (var i = 0; i < sides.length; i++) {
        if (sides[i].index == lawyerIndex) {
            return sides[i];
        }
    }
}

function removeSideInLawyer(activeSide, lawyerId) {
    let activeSideLawyers = [];

    if (activeSide.lawyer != null) {
        for (var i = 0; i < activeSide.lawyer.length; i++) {
            let row = activeSide.lawyer[i];
            if (i != lawyerId) activeSideLawyers.push(row);
        }
    }
    if (activeSideLawyers.length == 0) {
        $(`#lawyerBlock${activeSide.index}`).empty();
        $(`#lawyerBlock${activeSide.index}`).append(`
         VEKİL<br /> <a href="javascript:;" class="btn btn-sm btn-danger addLawyer addPersonToSide" personType="lawyer" data-index="${activeSide.index}">Ekle</a>
        `);
    }

    activeSide.lawyer = activeSideLawyers;
}

function limitText(text, limit) {
    if (text.length > limit) {
        return text.substring(0, limit) + "...";
    } else {
        return text;
    }
}

function generateSideBlock(side) {
    var cardClass = "bg-light";
    if (side.applicantType != "BAŞVURUCU") {
        cardClass = "bg-secondary";
    }
    var tcOrTax =
        side.type == 1
            ? "TC Kimlik No: " + side.identification
            : "Mersis No : " + side.mersis_number;
    var html = '<div id="sideCard-' + side.index + '" class="w-100">';
    html += '<div class="card ' + cardClass + '">';
    html += '<div class="card-body" style="color: #000000;">';
    html +=
        '<div class="d-flex flex-row justify-content-between align-items-center">';
    html += "<div>";
    html += side.applicantType;
    html += "</div>";
    html += '<div style="width:220px">';
    html += limitText(side.name, 30) + "<br />" + tcOrTax;
    html += "</div>";
    html += '<div id="lawyerBlock' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-warning addPersonToSide" personType="lawyer" data-index="' +
        side.index +
        '"><i class="fas fa-plus"></i> Vekil Ekle</button>';
    html += "</div>";
    html += '<div id="authorizedBlock' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-warning addPersonToSide" personType="authorized" data-index="' +
        side.index +
        '"><i class="fas fa-plus"></i> Yetkili Ekle</button>';
    html += "</div>";
    html += '<div id="employeeBlock' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-warning addPersonToSide" personType="employee" data-index="' +
        side.index +
        '"><i class="fas fa-plus"></i> Çalışan Ekle</button>';
    html += "</div>";
    html += '<div id="representativeBlock' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-warning addPersonToSide" personType="representative" data-index="' +
        side.index +
        '"><i class="fas fa-plus"></i> Kanuni Temsilci Ekle</button>';
    html += "</div>";
    html += '<div id="commissionerBlock' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-warning addPersonToSide" personType="commissioner" data-index="' +
        side.index +
        '"><i class="fas fa-plus"></i> Komisyon Üyesi Ekle</button>';
    html += "</div>";
    html += '<div id="expertBlock' + side.index + '">';
    html += '<button class="btn btn-sm btn-warning addPersonToSide" personType="expert" data-index="' +
        side.index + '"><i class="fas fa-plus"></i> Uzman Kişi Ekle</button>';
    html += "</div>";
    html += '<div id="' + side.index + '">';
    html +=
        '<button class="btn btn-sm btn-danger deleteSide" data-index="' +
        side.index +
        '"><i class="fas fa-times"></i> Taraf Sil</button>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
    html += "</div>";

    if (side.applicantType == "BAŞVURUCU") {
        $(".sideBasvuranRow").append(html);
    } else if (side.applicantType == "DİĞER TARAF") {
        $(".sideKarsiTarafRow").append(html);
    }

    $("#applicant_add_button").show();
    $("#applicant_select").remove();
}

function getLawyerBlock(lawyers, lawyerIndex) {
    let text = "Vekil";

    if (lawyers.length > 1) text = "Vekiller";

    var html =
        "<strong>" +
        text +
        '</strong> - <a class="addLawyer addPersonToSide" personType="lawyer" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
        lawyerIndex +
        '">Ekle</a> <br />';
    for (var i = 0; i < lawyers.length; i++) {
        let lawyer = lawyers[i];
        html +=
            '<p id="remove-lawyer-' +
            i +
            "-" +
            lawyerIndex +
            '">' +
            lawyer.name +
            "/" +
            ' - <a class="removeLawyer" href="javascript:;" style="color: #f27474;font-size: 14px;" data-index="' +
            lawyerIndex +
            '" data-id="' +
            i +
            '">Çıkar</a></p>';
    }
    return html;
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

/* Fonksiyonlar */
