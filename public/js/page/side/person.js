var type = "";
var form = "";
var id = "";
var person_modal = "";
var find_person_url = $("#kt_table_1").data("personget");
var delete_person_url = $("#kt_table_1").data("persondelete");

$(document).ready(function () {
    $(".new-person-button").on("click", function () {
        $("#newSideModal").modal('hide');
        type = $("#type option:selected").val();
        setFields();
    });

    $("body").delegate(".edit-person-button", "click", function (e) {
        id = $(this).data('id');
        type = $(this).data("type");
        setFields();
        getPerson();
    });

    $("body").delegate(".delete-person-button", "click", function (e) {
        id = $(this).data('id');
        type = $(this).data("type");

        swal.fire({
            title: 'Kişi Silme',
            text: "Silmek istediğinizden emin mininiz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.value === true) {
                $.ajax({
                    url: delete_person_url,
                    type: "POST",
                    data: {
                        'id': id,
                        'type': type,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.status) {
                            notification('Bilgi', data.message, 'success');
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            notification('Hata', data.message, 'error');

                        }
                    }
                });
            }
        });
    });

    $(".save-person-btn").on("click", function () {
        if (validate()) {
            return false;
        }
        form.ajaxSubmit({
            type: "POST",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.status) {
                    notification('Bilgi', 'Kaydetme işlemi başarılı bir şekilde gerçekleştirildi.', 'success');
                } else {
                    notification('Hata', 'Kişi mevcut lütfen yeni bir kayıt girin!', 'error');
                }
                person_modal.modal("hide");
                form[0].reset();
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            }
        });
    });

    $(".close").on('click', function () {
        $("#" + form.attr('id') + " input[name='id']").val("");
        form[0].reset();
        $("#" + form.attr('id') + " .rq").each(function () {
            $(this).removeClass("errorClass");
        });
    });
});

function setFields() {
    if (type === "person") {
        form = $("#formPerson");
        person_modal = $("#savePersonModal");
    } else if (type === "company") {
        form = $("#formCompany");
        person_modal = $("#saveCompanyModal");
    } else if (type === "lawyer") {
        form = $("#formLawyer");
        person_modal = $("#saveLawyerModal");
    }
    person_modal.modal("show");
}

function getPerson() {
    $.ajax({
        url: find_person_url,
        type: "POST",
        data: {
            'id': id,
            'type': type,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#" + form.attr('id') + " input[name='id']").val(data.id);
            if (type === "person") {
                person_modal = $("#savePersonModal");

                $("#saveReelTcNo").val(data.identification);
                $("#saveReelName").val(data.name);
                $("#saveReelAddress").val(data.address);
                $("#saveReelPhone").val(data.phone);
                $("#saveReelFixedPhone").val(data.fixed_phone);
                $("#saveReelEmail").val(data.email);
            }
            else if (type === "company") {
                person_modal = $("#saveCompanyModal");

                $("#saveCompanyTaxNo").val(data.tax_number);
                $("#saveCompanyName").val(data.name);
                $("#saveCompanyTax").val(data.tax_office);
                $("#saveCompanyMersis").val(data.mersis_number);
                $("#saveCompanyDetsis").val(data.detsis_number);
                $("#saveCompanyAddress").val(data.address);
                $("#saveCompanyFixedPhone").val(data.fixed_phone);
                $("#saveCompanyEmail").val(data.email);
            }
            else if (type === "lawyer") {
                person_modal = $("#saveLawyerModal");

                $("#saveLawyerTcNo").val(data.identification);
                $("#saveLawyerName").val(data.name);
                $("#saveLawyerAddress").val(data.address);
                $("#saveLawyerPhone").val(data.phone);
                $("#saveLawyerFixedPhone").val(data.fixed_phone);
                $("#lawyerEmail").val(data.email);
                $("#lawyerBaroName").val(data.baro_name);
                $("#lawyerBaroId").val(data.baro_id);
                $("#saveLawyerRegistrationNo").val(data.registration_no);
            }
            person_modal.modal("show");
        }
    });
}

function validate() {
    var hasError = false;
    $("#" + form.attr('id') + " .rq").each(function () {
        if ($(this).val() === "") {
            $(this).addClass("errorClass");
            hasError = true;
        } else {
            hasError = false;
            $(this).removeClass("errorClass");
        }
    });
    /*
    if (type === "company") {
        if (mersisValidate($("#saveCompanyMersis"))) {
            notification('HATA', 'Mersis Numarası 16 hane olmalıdır', 'error');
            hasError = true;
        }
        if (taxValidate($("#saveCompanyTax"))) {
            notification('HATA', 'Vergi Numarası 10 hane olmalıdır', 'error');
            hasError = true;
        }
    } else {
        if (tcValidate($("#"+form.attr('id')+" .tc"))) {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
            hasError = true;
        }
    }
    */
    if (hasError) {
        notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
    }
    return hasError;
}

function tcValidate(input) {
    var tcNo = input.val();
    tcNo = tcNo.replace(/_/g, '');

    if (tcNo.trim().length !== 11) {
        input.addClass("errorClass");
        return true
    } else {
        input.removeClass("errorClass");
        return false;
    }
}

function mersisValidate(input) {
    var mersisNo = input.val();

    mersisNo = mersisNo.replace(/_/g, '');

    if (mersisNo.trim().length !== 16) {
        input.addClass("errorClass");
        return true
    } else {
        input.removeClass("errorClass");
        return false;
    }
}

function taxValidate(input) {
    var taxNo = input.val();
    taxNo = taxNo.replace(/_/g, '');

    if (taxNo.trim().length !== 10) {
        input.addClass("errorClass");
        return true
    } else {
        input.removeClass("errorClass");
        return false;
    }
}

function notification(title, message, template) {

    toastr[template](message, title);

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}
