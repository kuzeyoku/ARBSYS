//Form Maskeleme
$("#checkAll").on("click", function () {
    $("input:checkbox").not(this).prop("checked", this.checked);
});

$(document).on("focus", ".datemask", function () {
    $(this).inputmask("99/99/9999", {
        placeholder: "mm/dd/yyyy",
        autoUnmask: true,
    });
});

$(document).on("focus", ".registrationmask", function () {
    $(this).inputmask("99999", {placeholder: "0"});
});

$(document).on("focus", ".datedotmask", function () {
    $(this).inputmask("99.99.9999");
});

$(document).on("focus", ".taxmask", function () {
    $(this).inputmask("9999999999");
});

$(document).on("focus", ".mersismask", function () {
    $(this).inputmask("9999 9999 9999 9999");
});

$(document).on("focus", ".detsismask", function () {
    $(this).inputmask("99999999");
});

$(document).on("focus", ".traderegistrymask", function () {
    $(this).inputmask("9999 9999 9999 9999");
});

$(document).on("focus", ".tcmask", function () {
    $(this).inputmask("99999999999");
});

$(document).on("focus", ".phonemask", function () {
    $(this).inputmask("(0999) 999 99 99");
});

$(document).on("focus", ".ibanmask", function () {
    $(this).inputmask("TR99 9999 9999 9999 9999 9999 99");
});

$(document).on("focus", ".emailmask", function () {
    $(this).inputmask("email", {
        showMaskOnHover: true,
        mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",
    });
});

$(document).on("focus", ".kepmask", function () {
    $(this).inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@hs01.kep.tr",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            "*": {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                cardinality: 1,
                casing: "lower",
            },
        },
    });
});

$(document).on("change", ".mersismask", function () {
    let mersis = $(this).val();
    let tax = mersis.substring(1, 13);
    if (mersis.length > 0) {
        $(".taxmask").val(tax.replace(/\s/g, ""));
    }
});

$(".selectSearch").select2({
    theme: "bootstrap4",
});

$(".summernote").summernote({});

$("#mediation_center").on("change", function () {
    url = $(this).data("url");
    id = $(this).val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id,
        },
    }).done(function (response) {
        $("#meeting_address").val(response.address);
    });
});

//DataTable Ayarı
if ($("#dataTable").length > 0) {
    $("#dataTable").dataTable({
        responsive: true,
        order: [[0, "desc"]],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json",
        },
        searching: true,
        lengthChange: true,
    });
}

$(document).on("change", ".personSelect", function () {
    let url = $(this).data("url");
    let id = $(this).val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id,
        },
    }).done(function (response) {
        $("input[name=name]").val(response.name);
        $("input[name=identification]").val(response.identification);
        $("input[name=phone]").val(response.phone);
        $("input[name=email]").val(response.email);
        $("textarea[name=address]").val(response.address);
    });
});

$(document).on("change", ".companySelect", function () {
    let url = $(this).data("url");
    let id = $(this).val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id,
        },
    }).done(function (response) {
        $("input[name=name]").val(response.name);
        $("input[name=tax_number]").val(response.tax_number);
        $("input[name=mersis]").val(response.mersis);
        $("input[name=phone]").val(response.phone);
        $("input[name=email]").val(response.email);
        $("textarea[name=address]").val(response.address);
    });
});

//Genel Silme Butonu Aksiyonu
$(".delete-btn").on("click", function () {
    let deleteBtn = $(this);
    swal
        .fire({
            title: "Emin misiniz?",
            icon: "warning",
            text: "Bu kayıt kalıcı olarak silinecektir!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Evet, sil!",
            cancelButtonText: "Hayır, vazgeç!",
        })
        .then(function (result) {
            if (result.value) deleteBtn.closest("form").submit();
        });
});

//Kişilerim Sayfası Kişi Ekle Butonu Aksiyonları
$(".new-person-button").on("click", function () {
    var data = $(this).closest("form").serialize();
    let url = $(this).closest("form").attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            $("#newSideModal").modal("hide");
            $("#personModal").modal("show");
            $("#personModal #formContent").html(response.data);
            $("#personModal .modal-title").html(response.type.name);
            $(".selectSearch").select2({
                theme: "bootstrap4",
            });
        },
    });
});

$(document).on("change", "#personModal #person_type", function () {
    var url = $(this).data("url");
    var type = $(this).val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            type: type,
        },
        success: function (response) {
            $("#personModal #formContent").html(response.formData);
            $("#personModal .modal-title").html(response.personType.name);
            $(".selectSearch").select2({
                theme: "bootstrap4",
            });
        },
    });
});

$(document).on("change", "#personModalEdit #person_type", function () {
    var id = $("#person_id").val();
    var current_type = $("input[name=current_type]").val();
    var type = $(this).val();
    var url = $(this).data("url");
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id,
            type: type,
            current_type: current_type,
        },
        success: function (response) {
            $("#personModalEdit #formContent").html(response.data);
            $("#personModalEdit .modal-title").html(response.type);
            $("#personModalEdit #person_type").val(type);
            $(".selectSearch").select2({
                theme: "bootstrap4",
            });
        },
    });
});

$(document).on("click", ".edit-person-btn", function () {
    $.ajax({
        url: $(this).data("url"),
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: $(this).data("id"),
            type: $(this).data("type"),
        },
        success: function (response) {
            $("#personModalEdit").modal("show");
            $("#personModalEdit .modal-title").html(response.type);
            $("#personModalEdit #formContent").html(response.data);
            $(".selectSearch").select2();
        },
    });
});

//Dosya Aç İşlemi Modal Aksiyonları
$(document).ready(function () {
    $(".dosyac").on("click", function () {
        $("#documentModal").modal("show");
    });

    $("#udfModalButton").on("click", function () {
        $("#documentModal").modal("hide");
        $("#udfModal").modal("show");
    });

    const $fileInput = $(".file-input");
    const $droparea = $(".file-drop-area");
    const $delete = $(".item-delete");

    $fileInput.on("dragenter focus click", function () {
        $droparea.addClass("is-active");
    });

    $fileInput.on("dragleave blur drop", function () {
        $droparea.removeClass("is-active");
    });

    $fileInput.on("change", function () {
        let filesCount = $(this)[0].files.length;
        let $textContainer = $(this).prev();

        if (filesCount === 1) {
            let fileName = $(this).val().split("\\").pop();
            $textContainer.text(fileName);
            $(".item-delete").css("display", "inline-block");
        } else if (filesCount === 0) {
            $textContainer.text("yada dosyayı buraya sürükleyin.");
            $(".item-delete").css("display", "none");
        } else {
            $textContainer.text(filesCount + " files selected");
            $(".item-delete").css("display", "inline-block");
        }
    });

    $delete.on("click", function () {
        $(".file-input").val(null);
        $(".file-msg").text("yada dosyayı buraya sürükleyin.");
        $(".item-delete").css("display", "none");
    });
});

$("#meeting_address_check").on("change", function () {
    if ($(this).is(":checked")) {
        $("#meeting_address").show();
    } else {
        $("input[name='meeting_address']").val("");
        $("#meeting_address").hide();
    }
});

$(document).on("dblclick", ".matters-discussed", function () {
    $("#matters-discussed-modal").modal("show");
});

$(document).on("change", "#matters-discussed-modal input[type='checkbox']", function () {
    var matters_discussed = "";
    $('input[name="matters_discussed[]"]:checked').each(function () {
        matters_discussed += $(this).parent().text().trim() + ", ";
    });
    $("#matters-discussed-textarea").val(matters_discussed.toLowerCase());
});

$(document).on("click", "#matters-discussed-save", function () {
    var matters_discussed = $("#matters-discussed-textarea").val();
    $(".matters-discussed").each(function () {
        $(this).html(matters_discussed.toLowerCase());
    });
    const inputValue = $(".matters-discussed").html();
    if (inputValue) {
        $.each($("input[name='side_ids[]']:checked"), function () {
            if ($("#disagreement-" + $(this).val()).length > 0) {
                const disagreement = $("#disagreement-" + $(this).val()).summernote("code");
                const replaceContent = disagreement.replace(`<span class="matters_discussed"></span>`, `<span class="matters_discussed">${inputValue}</span>`);
                $('#disagreement-' + $(this).val()).summernote('code', replaceContent);
            }
            if ($("#preview-" + $(this).val()).length > 0) {
                const preview = $("#preview-" + $(this).val()).summernote("code");
                const replaceContent = preview.replace(`<span class="matters_discussed"></span>`, `<span class="matters_discussed">${inputValue}</span>`);
                $('#preview-' + $(this).val()).summernote('code', replaceContent);
            }
        });
        $("#matters-discussed-modal").modal("hide");
    }
});

function result_modal() {
    $("#result-modal").modal("show");
}

function result_save() {
    var result = $('textarea[name="result"]').val();
    $('[id="result"]').each(function () {
        $(this).html(result);
    });
}

$("#cikti_btn").on("click", function () {
    $(".print_side").printThis({
        importCSS: false,
        loadCSS: "/css/print.css",
    });
});
