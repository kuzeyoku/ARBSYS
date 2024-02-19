var form;
var form_url;
var side_modal;
var side_id;
var type;
var action;
var table = false;

function modalGenerator() {
    $.ajax({
        url: form_url,
        type: "GET",
        success: function (data) {
            if ($("#formNewSide").length > 0) {
                $("input[name='lawsuit_id']").val($("#formNewSide").data('lawsuitid'));
            }

            if (type === "Şahıs") {
                form = $('#personForm');
                side_modal = $("#personModalSideManagement");
                form.find("#reelSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#reelId").val(data.data.id);
                    form.find("#reelTcNo").val(data.data.identification);
                    form.find("#reelName").val(data.data.name);
                    form.find("#reelAddress").val(data.data.address);
                    form.find("#reelPhone").val(data.data.phone);
                    form.find("#reelFixedPhone").val(data.data.fixed_phone);
                    form.find("#reelEmail").val(data.data.email);
                }
            }
            else if (type === "Şirket") {
                form = $('#companyForm');
                side_modal = $("#companyModalSideManagement");
                form.find("#companySideId").val(side_id);

                if (data.status === 200) {
                    form.find("#companyId").val(data.data.id);
                    form.find("#companyTaxNo").val(data.data.tax_number);
                    form.find("#companyName").val(data.data.name);
                    form.find("#companyTax").val(data.data.tax_office);
                    form.find("#companyMersis").val(data.data.mersis_number);
                    form.find("#companyDetsis").val(data.data.detsis_number);
                    form.find("#companyAddress").val(data.data.address);
                    form.find("#companyFixedPhone").val(data.data.fixed_phone);
                    form.find("#companyEmail").val(data.data.email);
                }
            }
            else if (type === "Avukat") {
                form = $('#lawyerForm');
                side_modal = $("#lawyerModalSideManagement");
                form.find("#lawyerSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#lawyerId").val(data.data.id);
                    form.find("#lawyerTcNo").val(data.data.identification);
                    form.find("#lawyerName").val(data.data.name);
                    form.find("#lawyerAddress").val(data.data.address);
                    form.find("#lawyerPhone").val(data.data.phone);
                    form.find("#lawyerFixedPhone").val(data.data.fixed_phone);
                    form.find("#lawyerBaroName").val(data.data.baro_name);
                    form.find("#lawyerBaroId").val(data.data.baro_id);
                    form.find("#lawyerRegistrationNo").val(data.data.registration_no);
                }
            }
            else if (type === "Yetkili") {
                form = $('#otherForm');
                side_modal = $("#otherModalSideManagement");
                form.find("#otherSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#otherId").val(data.data.id);
                    form.find("#otherTcNo").val(data.data.identification);
                    form.find("#otherName").val(data.data.name);
                    form.find("#otherAddress").val(data.data.address);
                    form.find("#otherPhone").val(data.data.phone);
                    form.find("#otherFixedPhone").val(data.data.fixed_phone);
                    form.find("#otherEmail").val(data.data.email);
                }

            }
            else if (type === "Çalışan") {
                form = $('#workerForm');
                side_modal = $("#workerModalSideManagement");
                form.find("#workerSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#workerId").val(data.data.id);
                    form.find("#workerTcNo").val(data.data.identification);
                    form.find("#workerName").val(data.data.name);
                    form.find("#workerAddress").val(data.data.address);
                    form.find("#workerPhone").val(data.data.phone);
                    form.find("#workerFixedPhone").val(data.data.fixed_phone);
                    form.find("#workerEmail").val(data.data.email);
                }
            }
            else if (type === "Kanuni Temsilci") {
                form = $('#representativeForm');
                side_modal = $("#representativeModalSideManagement");
                form.find("#representativeSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#representativeId").val(data.data.id);
                    form.find("#representativeTcNo").val(data.data.identification);
                    form.find("#representativeName").val(data.data.name);
                    form.find("#representativeAddress").val(data.data.address);
                    form.find("#representativePhone").val(data.data.phone);
                    form.find("#representativeFixedPhone").val(data.data.fixed_phone);
                    form.find("#representativeEmail").val(data.data.email);
                }
            }
            else if (type === "Uzman Kişi") {
                form = $('#expertForm');
                side_modal = $("#expertModalSideManagement");
                form.find("#expertSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#expertId").val(data.data.id);
                    form.find("#expertTcNo").val(data.data.identification);
                    form.find("#expertName").val(data.data.name);
                    form.find("#expertAddress").val(data.data.address);
                    form.find("#expertPhone").val(data.data.phone);
                    form.find("#expertFixedPhone").val(data.data.fixed_phone);
                    form.find("#expertEmail").val(data.data.email);
                }
            }
            side_modal.modal("show");
            // $(`#myModal`).modal("show");

        }
    });
}

function modalEditGenerator() {
    $.ajax({
        url: form_url,
        type: "GET",
        success: function (data) {
            if ($("#formNewSide").length > 0) {
                $("input[name='lawsuit_id']").val($("#formNewSide").data('lawsuitid'));
            }

            if (type === "Şahıs") {
                $(`#taraf-gercek-tab`).addClass("active");
                $(`#taraf-gercek`).addClass("show active");
                $(`#taraf-tuzel-tab`).removeClass("active");
                $(`#taraf-tuzel`).removeClass("show active");
                $(`#taraf-vekil-tab`).removeClass("active");
                $(`#taraf-vekil`).removeClass("show active");

                $('#personEditForm').find("#sideApplicantOldType").val(1);
                $('#companyEditForm').find("#sideApplicantOldType").val(1);
                $('#lawyerEditForm').find("#sideApplicantOldType").val(1);

                form = $('#personEditForm');
                form.find("#reelSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#reelId").val(data.data.id);
                    form.find("#reelTcNo").val(data.data.identification);
                    form.find("#reelName").val(data.data.name);
                    form.find("#reelAddress").val(data.data.address);
                    form.find("#reelPhone").val(data.data.phone);
                    form.find("#reelFixedPhone").val(data.data.fixed_phone);
                    form.find("#reelEmail").val(data.data.email);
                }
            }
            else if (type === "Şirket") {
                $(`#taraf-gercek-tab`).removeClass("active");
                $(`#taraf-gercek`).removeClass("show active");
                $(`#taraf-tuzel-tab`).addClass("active");
                $(`#taraf-tuzel`).addClass("show active");
                $(`#taraf-vekil-tab`).removeClass("active");
                $(`#taraf-vekil`).removeClass("show active");

                $('#personEditForm').find("#sideApplicantOldType").val(2);
                $('#companyEditForm').find("#sideApplicantOldType").val(2);
                $('#lawyerEditForm').find("#sideApplicantOldType").val(2);

                form = $('#companyEditForm');
                form.find("#companySideId").val(side_id);

                if (data.status === 200) {
                    form.find("#companyId").val(data.data.id);
                    form.find("#companyTaxNo").val(data.data.tax_number);
                    form.find("#companyName").val(data.data.name);
                    form.find("#companyTax").val(data.data.tax_office);
                    form.find("#companyMersis").val(data.data.mersis_number);
                    form.find("#companyDetsis").val(data.data.detsis_number);
                    form.find("#companyAddress").val(data.data.address);
                    form.find("#companyFixedPhone").val(data.data.fixed_phone);
                    form.find("#companyEmail").val(data.data.email);
                }
            }
            else if (type === "Avukat") {
                $(`#taraf-gercek-tab`).removeClass("active");
                $(`#taraf-gercek`).removeClass("show active");
                $(`#taraf-tuzel-tab`).removeClass("active");
                $(`#taraf-tuzel`).removeClass("show active");
                $(`#taraf-vekil-tab`).addClass("active");
                $(`#taraf-vekil`).addClass("show active");

                $('#personEditForm').find("#sideApplicantOldType").val(3);
                $('#companyEditForm').find("#sideApplicantOldType").val(3);
                $('#lawyerEditForm').find("#sideApplicantOldType").val(3);

                form = $('#lawyerEditForm');
                form.find("#lawyerSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#lawyerId").val(data.data.id);
                    form.find("#lawyerTcNo").val(data.data.identification);
                    form.find("#lawyerName").val(data.data.name);
                    form.find("#lawyerAddress").val(data.data.address);
                    form.find("#lawyerPhone").val(data.data.phone);
                    form.find("#lawyerFixedPhone").val(data.data.fixed_phone);
                    form.find("#lawyerBaroName").val(data.data.baro_name);
                    form.find("#lawyerBaroId").val(data.data.baro_id);
                    form.find("#lawyerRegistrationNo").val(data.data.registration_no);
                }
            }
            else if (type === "Yetkili") {
                form = $('#otherForm');
                side_modal = $("#otherModalSideManagement");
                form.find("#otherSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#otherId").val(data.data.id);
                    form.find("#otherTcNo").val(data.data.identification);
                    form.find("#otherName").val(data.data.name);
                    form.find("#otherAddress").val(data.data.address);
                    form.find("#otherPhone").val(data.data.phone);
                    form.find("#otherFixedPhone").val(data.data.fixed_phone);
                    form.find("#otherEmail").val(data.data.email);
                }

            }
            else if (type === "Çalışan") {
                form = $('#workerForm');
                side_modal = $("#workerModalSideManagement");
                form.find("#workerSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#workerId").val(data.data.id);
                    form.find("#workerTcNo").val(data.data.identification);
                    form.find("#workerName").val(data.data.name);
                    form.find("#workerAddress").val(data.data.address);
                    form.find("#workerPhone").val(data.data.phone);
                    form.find("#workerFixedPhone").val(data.data.fixed_phone);
                    form.find("#workerEmail").val(data.data.email);
                }
            }
            else if (type === "Kanuni Temsilci") {
                form = $('#representativeForm');
                side_modal = $("#representativeModalSideManagement");
                form.find("#representativeSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#representativeId").val(data.data.id);
                    form.find("#representativeTcNo").val(data.data.identification);
                    form.find("#representativeName").val(data.data.name);
                    form.find("#representativeAddress").val(data.data.address);
                    form.find("#representativePhone").val(data.data.phone);
                    form.find("#representativeFixedPhone").val(data.data.fixed_phone);
                    form.find("#representativeEmail").val(data.data.email);
                }
            }
            else if (type === "Uzman Kişi") {
                form = $('#expertForm');
                side_modal = $("#expertModalSideManagement");
                form.find("#expertSideId").val(side_id);

                if (data.status === 200) {
                    form.find("#expertId").val(data.data.id);
                    form.find("#expertTcNo").val(data.data.identification);
                    form.find("#expertName").val(data.data.name);
                    form.find("#expertAddress").val(data.data.address);
                    form.find("#expertPhone").val(data.data.phone);
                    form.find("#expertFixedPhone").val(data.data.fixed_phone);
                    form.find("#expertEmail").val(data.data.email);
                }
            }
            $(`#editModalSideManagement`).modal("show");
        }
    });
}
$(document).ready(function () {

    $("body").delegate(".save-side-btn", "click", function (e) {
        form.attr('action', action === "update" ? "/side/" + side_id : "/side");
        form.ajaxSubmit({
            type: action === "update" ? "PUT" : "POST",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.status === true) {
                    if ($("#kt_table_1").length > 0) {
                        window.location.reload();
                        return false;
                    }
                    toastr['success'](data.message);
                    if (type === "Şahıs" || type === "Şirket") {
                        $("#title-" + side_id + " span").text(data.data.name);
                        $("#checkbox-" + side_id).html('<input type="checkbox" name="claimant_ids[]" value="' + side_id + '" data-name="' + data.data.name + '"><span></span>' + data.data.name);
                    } else if (type === "Avukat") {
                        $("#checkbox-" + side_id).html('' +
                            '<input type="checkbox" name="claimant_ids[]" value="' + side_id + '" data-name="' + data.data.name + '"><span></span>Vekili - ' + data.data.name + '' +
                            '<a href="javascript:;" data-id="' + side_id + '" data-type="' + type + '" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-side-button"><i class="la la-edit"></i></a>'
                        );
                    } else if (type === "Yetkili") {
                        $("#checkbox-" + side_id).html('' +
                            '<input type="checkbox" name="claimant_ids[]" value="' + side_id + '" data-name="' + data.data.name + '"><span></span>Yetkilisi - ' + data.data.name + '' +
                            '<a href="javascript:;" data-id="' + side_id + '" data-type="' + type + '" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-side-button"><i class="la la-edit"></i></a>'
                        );
                    } else {
                        $("#checkbox-" + side_id).html('' +
                            '<input type="checkbox" name="claimant_ids[]" value="' + side_id + '" data-name="' + data.data.name + '"><span></span>' + type + ' - ' + data.data.name + '' +
                            '<a href="javascript:;" data-id="' + side_id + '" data-type="' + type + '" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-side-button"><i class="la la-edit"></i></a>'
                        );
                    }
                } else {
                    toastr['success']('İşlem başarısız oldu!');
                }
            }
        });
        side_modal.modal("hide");
        form[0].reset();
    });

    $("body").delegate(".delete-side-button", "click", function (e) {
        if ($(this).data('side') == "Başvuran" && ($(this).data('type') === "Şahıs" || $(this).data('type') === "Şirket") && (applicant / 2) <= 1) {
            swal.fire(
                'Hata!',
                'En az bir Başvuran olması gerekiyor. Öncelikle bir başvuran ekleyip daha sonra silmeniz gerekiyor!',
                'error'
            );
            return false;
        } else if ($(this).data('side') == "Karşı Taraf" && ($(this).data('type') === "Şahıs" || $(this).data('type') === "Şirket") && (opponent / 2) <= 1) {
            swal.fire(
                'Hata!',
                'En az bir Karşı Taraf olması gerekiyor. Öncelikle bir Karşı Taraf ekleyip daha sonra silmeniz gerekiyor!',
                'error'
            );
            return false;
        }

        form_url = "/side/" + $(this).data('id');

        swal.fire({
            title: 'Taraf Silme',
            text: "Silmek istediğinizden emin mininiz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.value == true) {
                swal.fire(
                    'Silindi!',
                    'Silmek istediğiniz taraf silindi!',
                    'success'
                );

                $.ajax({
                    url: form_url,
                    type: "DELETE",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                window.location.reload();
            }
        });
    });

    $(".new-side-button").on("click", function () {
        var hasError = false;
        if ($('#side_type_id option:selected').val() == "") {
            $('#side_type_id').addClass("errorClass");
            hasError = true;
        }

        if ($('#side_applicant_type_id option:selected').val() == "") {
            $('#side_applicant_type_id').addClass("errorClass");
            hasError = true;
        }

        if (hasError == true) {
            toastr['error']('Lütfen işaretli alanı seçiniz.');
            return false;
        }
        else {
            side_id = $('#side_type_id option:selected').val();
            type = $('#side_applicant_type_id option:selected').val();
            action = "store";
            form_url = "/side/new";

            $("#newSideModal").modal("hide");
            modalGenerator();
        }
    });

    $("#taraf-gercek-tab").on("click", function () {
        form = $('#personEditForm');
    });

    $("#taraf-tuzel-tab").on("click", function () {
        form = $('#companyEditForm');
    });

    // $("#taraf-vekil-tab").on("click", function () {
    //     form = $('#lawyerEditForm');
    // });

    $("body").delegate(".edit-side-button", "click", function (e) {
        side_id = $(this).data('id');
        type = $(this).data('type');
        action = "update";
        form_url = "/side/" + side_id;

        modalEditGenerator();
    });

    $("#side_type_id").on("change", function () {
        if ($(this).find(':selected').data('type') == "BAŞVURAN" || $(this).find(':selected').data('type') == "KARŞI TARAF") {
            $("#side_applicant_type_id").html("<option>Şahıs</option><option>Şirket</option><option>Avukat</option>");
        }
        else if ($(this).find(':selected').data('type') == 1) {
            $("#side_applicant_type_id").html("<option value='Avukat'>Avukat</option><option value='Kanuni Temsilci'>Kanuni Temsilci</option><option value='Uzman Kişi'>Uzman Kişi</option>");
        }
        else {
            $("#side_applicant_type_id").html("<option value='Avukat'>Avukat</option><option value='Yetkili'>Yetkili</option><option value='Çalışan'>Çalışan</option><option value='Kanuni Temsilci'>Kanuni Temsilci</option><option value='Uzman Kişi'>Uzman Kişi</option>");
        }
    });
});
