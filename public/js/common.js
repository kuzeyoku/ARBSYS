var wizard = new KTWizard('kt_wizard_v4', {
    startStep: 1, // initial active step number
    clickableSteps: true  // allow step clicking
});

function meetingResult(element) {
    if (element.textContent.trim() === "") {
        $("#meeting_result_question_modal").modal("show");
    }
}

function meetingResultWrite(meeting_count, text, lawsuit_id) {
    if (typeof text !== 'undefined' && text !== "") {
        $("#meeting_result_modal").modal("hide");
    }
    else if(meeting_count) {
        $("#meeting_result_next_modal").modal("hide");
        var date = moment($("#next_meeting_date").val(), 'DD.MM.YYYY').locale("tr").format('DD.MM.YYYY dddd');
        var today = moment().locale("tr").format('DD.MM.YYYY');
        text = "Taraflarca uyuşmazlık konusu müzakere edildikten sonra, yeniden değerlendirilmek üzere, "+ date.toLocaleString() +" günü saat "+ $("#next_meeting_hour").val()+addAdditional($("#next_meeting_hour").val()) +" "+ meeting_count +" bir toplantı yapılması kararlaştırılmıştır. "+today;
    }
    $('input[name="agreement_type_id"]').val($('input[name="subject_answer"]:checked').val());
    document.querySelector('.meetingResultField').innerHTML = text;
    $('.note-editable').trigger('input');
    setTimeout(function () {
        if (!meeting_count && text === "-") {
            $('[data-ktwizard-type="action-submit"]').click();
            window.location.href = "/dosya/"+lawsuit_id+"/son-tutanak";
        } else if (!meeting_count) {
            $('[data-ktwizard-type="action-submit"]').click();
            window.location.href = "/dosya/"+lawsuit_id+"/anlasma-belgesi";
        }
    }, 500);
}

function addAdditional(time) {
    var text;
    var myArray = time.split(":");
    switch (myArray[1]) {
        case "00":
            text = "‘da";
            break;
        case "10":
            text = "‘da";
            break;
        case "20":
            text = "‘de";
            break;
        case "30":
            text = "‘da";
            break;
        case "40":
            text = "‘ta";
            break;
        case "50":
            text = "‘de";
            break;
        default:
            text = "‘da";
            break;
    }
    return text;
}

function issetLawyerOrOtherInSide()
{
    var status = false;

    $(".required_sub_side").each(function()
    {
        if (($(this).html().trim().length == 0 || $(this).find("input").is(":checked") == false) && $(this).data('type') == 2)
        {
            status = true;
            $("#"+$(this).data('title')).addClass("errorClass");
        }
        else
        {
            $("#"+$(this).data('title')).removeClass("errorClass");
        }
    });

    return status;
}

function previewRequiredControl()
{
    var required = 0;
    var required_fields = document.querySelectorAll('.requiredField');
    for(var i=0;i<required_fields.length;i++)
    {
        if (required_fields[i] != null)
        {
            if (required_fields[i].innerHTML === '')
            {

                required = 1;

                required_fields[i].classList.add("errorClass");
            }
            else
            {
                required_fields[i].classList.remove("errorClass");
            }
        }
    }

    return required;
}

function replaceSubject()
{
    var subjects = document.querySelectorAll('input[name=subject_radio]:checked');
    var text = document.querySelector('.MuzakereEdilenHususlar');
    var subject_text = " ";

    for(var i=0;i<subjects.length;i++)
    {
        subject_text += subjects[i].value;
        if ((subjects.length-1) != i) {
            subject_text += ", ";
        } else {
            subject_text += " ";
        }
    }

    // text.innerHTML = text.innerHTML.replace("@konu_popup", subject_text.toLowerCase());
    text.innerHTML = subject_text.toLowerCase();
    $("input[name='matters_discussed']").val(text.innerHTML);
    $("#select_subject_modal").modal("hide");
}

function replaceAnlasilan()
{
    var subjects = document.querySelectorAll('input[name=anlasilan_radio]:checked');
    var text = document.querySelector('.AnlasilanHususlar');
    var subject_text = " ";

    for(var i=0;i<subjects.length;i++)
    {
        subject_text += subjects[i].value;
        if ((subjects.length-1) != i) {
            subject_text += ", ";
        } else {
            subject_text +=" ";
        }
    }

    if (subjects.length > 0) {
        text.innerHTML = text.innerHTML.replace("@AnlasilanHususlar", subject_text.toLowerCase());
    } else {
        text.innerHTML = " - ";
    }

    $("#select_anlasilan_modal").modal("hide");
}

function replaceAnlasilmayan()
{
    var subjects = document.querySelectorAll('input[name=anlasilmayan_radio]:checked');
    var text = document.querySelector('.AnlasilmayanHususlar');
    var subject_text = " ";

    for(var i=0;i<subjects.length;i++)
    {
        subject_text += subjects[i].value;
        if ((subjects.length-1) != i) {
            subject_text +=", ";
        } else {
            subject_text += " ";
        }
    }
    if (subjects.length > 0) {
        text.innerHTML = text.innerHTML.replace("@AnlasilmayanHususlar",subject_text.toLowerCase());
    } else {
        text.innerHTML = " - ";
    }
    $("#select_anlasilmayan_modal").modal("hide");
}

function replaceSignatureMethod()
{
    var signature_method = document.querySelector('input[name=signature_method]:checked');
    var text = document.querySelector('.resultField');

    text.innerHTML = text.innerHTML.replace("@İmzaYöntemi", signature_method.value);
}

$("#select_subject_button").on('click', function ()
{
    replaceSubject();
});

$("#select_anlasilan_button").on('click', function ()
{
    replaceAnlasilan();
});

$("#select_anlasilmayan_button").on('click', function ()
{
    replaceAnlasilmayan();
});

$("#select_signature_method_button").on('click', function ()
{
    replaceSignatureMethod();

    $("#select_signature_method_modal").modal("hide");
});

$(function() {
    $('.one_word').on('keypress', function(e) {
        if (e.which == 32){
            toastr["error"]("Bu alana sadece bir şehir yazabilirsiniz. Şehir adını birleşik yazınız.");
            return false;
        }
    });
});

function createEditor(selector) {
    $(selector).summernote('destroy');
    $(selector).summernote({
        callbacks: {
            onChange: function(contents) {
                $(selector).html(contents);
            },
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                e.preventDefault();

                // Firefox fix
                setTimeout(function () {
                    document.execCommand('insertText', false, bufferText);
                }, 10);
            }
        }
    });
}


