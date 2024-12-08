var sides = [];
var side_id = "";
var side_type_id = "";
var side_applicant_type_id = "";
var if_udf = 0;
var index = 0;

function notification(title, message, template) {

    toastr[template](message, title)

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

    //alert(message)
}

function tcValidate(input)
{
    return false;

    var tcNo = input.val();

    tcNo = tcNo.replace(/_/g, '');

    console.log(tcNo);

    if (tcNo.trim().length !== 11)
    {
        input.addClass("errorClass");

        return true;
    }
    else
    {
        input.removeClass("errorClass");

        return false;
    }
}

function removeSide(remove_index)
{
    for(var i=0 ; i < sides.length ; i++)
    {
        if (i == remove_index)
        {
            sides.splice(i, 1);
            $("#remove-"+remove_index).remove();
            index--;
        }
    }
}

$(document).ready(function ()
{
    $("#lawyerModal").on('hide.bs.modal', function()
    {
        $('.subside_lrq').val('');
        $('.subside_lrq').closest("form").resetForm();
    });

    $("#otherModal").on('hide.bs.modal', function()
    {
        $('.subside_orq').val('');
        $('.subside_orq').closest("form").resetForm();
    });

    $("#workerModal").on('hide.bs.modal', function()
    {
        $('.subside_wrq').val('');
        $('.subside_wrq').closest("form").resetForm();
    });

    $("#representativeModal").on('hide.bs.modal', function()
    {
        $('.subside_rrq').val('');
        $('.subside_rrq').closest("form").resetForm();
    });

    $("#commissionerModal").on('hide.bs.modal', function()
    {
        $('.subside_rrq').val('');
        $('.subside_rrq').closest("form").resetForm();
    });

    $("#expertModal").on('hide.bs.modal', function()
    {
        $('.subside_erq').val('');
        $('.subside_erq').closest("form").resetForm();
    });

    $(document).on('click', ".addAuthorized" , function ()
    {
        $("#otherModal").modal('show');

        side_id = $(this).data('sideid');
        side_type_id = $(this).data('sidetypeid');
        side_applicant_type_id = $(this).data('applicanttypeid');
        if_udf = $(this).data('udf');
    });

    $(document).on('click', ".addLawyer", function ()
    {
        $("#lawyerModal").modal('show');

        side_id = $(this).data('sideid');
        side_type_id = $(this).data('sidetypeid');
        side_applicant_type_id = $(this).data('applicanttypeid');
        if_udf = $(this).data('udf');
    });

    $(document).on('click', ".addEmployee", function ()
    {
        $("#employeeModal").modal('show');

        side_id = $(this).data('sideid');
        side_type_id = $(this).data('sidetypeid');
        side_applicant_type_id = $(this).data('applicanttypeid');
        if_udf = $(this).data('udf');
    });

    $(document).on('click', ".addRepresentative", function ()
    {
        $("#representativeModal").modal('show');

        side_id = $(this).data('sideid');
        side_type_id = $(this).data('sidetypeid');
        side_applicant_type_id = $(this).data('applicanttypeid');
        if_udf = $(this).data('udf');
    });

    $(document).on('click', ".addExpert", function ()
    {
        $("#expertModal").modal('show');

        side_id = $(this).data('sideid');
        side_type_id = $(this).data('sidetypeid');
        side_applicant_type_id = $(this).data('applicanttypeid');
        if_udf = $(this).data('udf');
    });

    $(document).on('click', "#saveLawyer" , function(e)
    {
        e.preventDefault();

        var hasError = false;
        var html = '';

        let Id = $("#lawyerId").val();
        let tcNo = $("#lawyerTcNo").val();
        let nameSurname = $("#lawyerName").val();
        let address = $("#lawyerAddress").val();
        let gsm = $("#lawyerPhone").val();
        let baro = $("#lawyerBaroId").val();
        let regNo = $("#registrationNo").val();
        let fixedPhone = $("#lawyerFixedPhone").val();
        let email = $("#lawyerEmail").val();
        // index degeri 0 1 den buyukse 
        $(".subside_lrq").each(function(index)
        {
            if (index < 3) {
                if($(this).val() == "")
                {
                    $(this).addClass("errorClass");
                    hasError = true;
                }
                else
                {
                    $(this).removeClass("errorClass");
                    hasError = false;
                }
            }
        });

        var hasErrorTc = tcValidate($("#lawyerTcNo"));

        if (hasErrorTc)
        {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
        }

        if(hasError)
        {
            notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
        }

        if (hasErrorTc || hasError)
        {
            return false;
        }

        let lawyer = {
            "index":index,
            "id": Id,
            "tc": tcNo,
            "name": nameSurname,
            "address": address,
            "phone": gsm,
            "baro": baro,
            "regNo": regNo,
            "fixedPhone": fixedPhone,
            "email": email,
            "side_applicant_type_id": side_applicant_type_id,
            "side_type_id": side_type_id,
            "side_id": side_id,
            "title": "Vekili",
        };

        sides.push(lawyer);

        if (if_udf === 1)
        {
            html = '<p class="px-4 py-2 bg-primary text-white" style="border-radius:5px; display:inline-block" id="remove-'+index+'">Vekili  - ' + nameSurname + ' <a href="javascript:;" class="text-white remove_side ml-2" data-index="'+index+'"> <strong>X</strong> </a></p><br/>';

            if (side_type_id === 1)
            {
                $("#sub_sides-claimant-"+side_id).append(html);
            }
            else
            {
                $("#sub_sides-defendant-"+side_id).append(html);
            }
        }
        else
        {
            html += '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
            html += '<input type="checkbox" name="new_side_ids[]" value="'+tcNo+'">Vekili  - ' + nameSurname;
            html += '<a href="javascript:;" data-sideid="' + side_id + '" data-sidetypeid="' + type + ' class="btn btn-sm btn-clean btn-icon btn-icon-md updateLawyear"><i class="la la-edit"></i></a>';
            html += '<span></span>';
            html += '</label>';
            $("#sub_sides-"+side_id).append(html);
        }

        $("#lawyerModal").modal('hide');

        index++;
    });

    $("#saveOther").on('click', function(e)
    {
        e.preventDefault();

        var hasError = false;
        var html = "";

        let Id = $("#otherId").val();
        let tcNo = $("#otherTcNo").val();
        let nameSurname = $("#otherName").val();
        let address = $("#otherAddress").val();
        let gsm = $("#otherPhone").val();
        let fixedPhone = $("#otherFixedPhone").val();
        let email = $("#otherEmail").val();

        $(".subside_orq").each(function()
        {
            if($(this).val() == "")
            {
                $(this).addClass("errorClass");
                hasError = true;
            }
            else
            {
                $(this).removeClass("errorClass");
                hasError = false;
            }
        });

        var hasErrorTc = tcValidate($("#otherTcNo"));

        if (hasErrorTc)
        {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
        }

        if(hasError)
        {
            notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
        }

        if (hasErrorTc || hasError)
        {
            return false;
        }

        let others = {
            "index": index,
            "id": Id,
            "tc": tcNo,
            "name": nameSurname,
            "address": address,
            "phone": gsm,
            "fixedPhone": fixedPhone,
            "email": email,
            "side_applicant_type_id": side_applicant_type_id,
            "side_type_id": side_type_id,
            "side_id": side_id,
            "title": "Yetkili",
        };

        sides.push(others);

        if (if_udf === 1)
        {
            html = '<p class="px-4 py-2 bg-primary text-white" style="border-radius:5px; display:inline-block" id="remove-'+index+'">Yetkili  - ' + nameSurname + ' <a href="javascript:;" class="text-white remove_side ml-2" data-index="'+index+'">X</a></p><br/>';
            
            if (side_type_id === 1)
            {
                $("#sub_sides-claimant-"+side_id).append(html);
            }
            else
            {
                $("#sub_sides-defendant-"+side_id).append(html);
            }
        }
        else
        {
            html += '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
            html += '<input type="checkbox" name="new_side_ids[]" value="'+tcNo+'">Yetkili - ' + nameSurname;
            html += '<span></span>';
            html += '</label>';

            $("#sub_sides-"+side_id).append(html);
        }


        $("#otherModal").modal('hide');

        index++;
    });

    $("#saveWorker").on('click', function(e)
    {
        e.preventDefault();

        var hasError = false;
        var html = "";

        let Id = $("#workerId").val();
        let tcNo = $("#workerTcNo").val();
        let nameSurname = $("#workerName").val();
        let address = $("#workerAddress").val();
        let gsm = $("#workerPhone").val();
        let fixedPhone = $("#workerFixedPhone").val();
        let email = $("#workerEmail").val();

        $(".subside_wrq").each(function()
        {
            if($(this).val() == "")
            {
                $(this).addClass("errorClass");
                hasError = true;
            }
            else
            {
                $(this).removeClass("errorClass");
                hasError = false;
            }
        });

        var hasErrorTc = tcValidate($("#workerTcNo"));

        if (hasErrorTc)
        {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
        }

        if(hasError)
        {
            notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
        }

        if (hasErrorTc || hasError)
        {
            return false;
        }

        let workers = {
            "index": index,
            "id": Id,
            "tc": tcNo,
            "name": nameSurname,
            "address": address,
            "phone": gsm,
            "fixedPhone": fixedPhone,
            "email": email,
            "side_applicant_type_id": side_applicant_type_id,
            "side_type_id": side_type_id,
            "side_id": side_id,
            "title": "Yetkili",
        };

        sides.push(workers);


        if (if_udf === 1)
        {
            html = '<p class="px-4 py-2 bg-primary text-white" style="border-radius:5px; display:inline-block" id="remove-'+index+'">Çalışan  - ' + nameSurname + ' <a href="javascript:;" class="text-white remove_side ml-2" data-index="'+index+'">X</a></p><br/>';


            if (side_type_id === 1)
            {
                $("#sub_sides-claimant-"+side_id).append(html);
            }
            else
            {
                $("#sub_sides-defendant-"+side_id).append(html);
            }
        }
        else
        {
            html += '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
            html += '<input type="checkbox" name="new_side_ids[]" value="'+tcNo+'">Çalışan - ' + nameSurname;
            html += '<span></span>';
            html += '</label>';

            $("#sub_sides-"+side_id).append(html);
        }

        $("#workerModal").modal('hide');

        index++;
    });

    $("#saveRepresentative").on('click', function(e)
    {
        e.preventDefault();

        var hasError = false;
        var html = "";

        let Id = $("#representativeId").val();
        let tcNo = $("#representativeTcNo").val();
        let nameSurname = $("#representativeName").val();
        let address = $("#representativeAddress").val();
        let gsm = $("#representativePhone").val();
        let fixedPhone = $("#representativeFixedPhone").val();
        let email = $("#representativeEmail").val();

        $(".subside_rrq").each(function()
        {
            if($(this).val() == "")
            {
                $(this).addClass("errorClass");
                hasError = true;
            }
            else
            {
                $(this).removeClass("errorClass");
                hasError = false;
            }
        });

        var hasErrorTc = tcValidate($("#representativeTcNo"));

        if (hasErrorTc)
        {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
        }

        if(hasError)
        {
            notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
        }

        if (hasErrorTc || hasError)
        {
            return false;
        }

        let representatives = {
            "index": index,
            "id": Id,
            "tc": tcNo,
            "name": nameSurname,
            "address": address,
            "phone": gsm,
            "fixedPhone": fixedPhone,
            "email": email,
            "side_applicant_type_id": side_applicant_type_id,
            "side_type_id": side_type_id,
            "side_id": side_id,
            "title": "Kanuni Temsilci",
        };

        sides.push(representatives);


        if (if_udf === 1)
        {
            html = '<p class="px-4 py-2 bg-primary text-white" style="border-radius:5px; display:inline-block" id="remove-'+index+'">Kanuni Temsilci  - ' + nameSurname + ' <a href="javascript:;" class="text-white remove_side ml-2" data-index="'+index+'">X</a></p><br/>';


            if (side_type_id === 1)
            {
                $("#sub_sides-claimant-"+side_id).append(html);
            }
            else
            {
                $("#sub_sides-defendant-"+side_id).append(html);
            }
        }
        else
        {
            html += '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
            html += '<input type="checkbox" name="new_side_ids[]" value="'+tcNo+'">Kanuni Temsilci - ' + nameSurname;
            html += '<span></span>';
            html += '</label>';

            $("#sub_sides-"+side_id).append(html);
        }

        $("#representativeModal").modal('hide');

        index++;
    });

    $("#saveExpert").on('click', function(e)
    {
        e.preventDefault();

        var hasError = false;
        var html = "";

        let Id = $("#expertId").val();
        let tcNo = $("#expertTcNo").val();
        let nameSurname = $("#expertName").val();
        let address = $("#expertAddress").val();
        let gsm = $("#expertPhone").val();
        let fixedPhone = $("#expertFixedPhone").val();
        let email = $("#expertEmail").val();

        $(".subside_erq").each(function()
        {
            if($(this).val() == "")
            {
                $(this).addClass("errorClass");
                hasError = true;
            }
            else
            {
                $(this).removeClass("errorClass");
                hasError = false;
            }
        });

        var hasErrorTc = tcValidate($("#expertTcNo"));

        if (hasErrorTc)
        {
            notification('HATA', 'T.C. No 11 hane olmalıdır', 'error');
        }

        if(hasError)
        {
            notification('HATA', 'İşaretli alanlar boş bırakılamaz', 'error');
        }

        if (hasErrorTc || hasError)
        {
            return false;
        }

        let experts = {
            "index": index,
            "id": Id,
            "tc": tcNo,
            "name": nameSurname,
            "address": address,
            "phone": gsm,
            "fixedPhone": fixedPhone,
            "email": email,
            "side_applicant_type_id": side_applicant_type_id,
            "side_type_id": side_type_id,
            "side_id": side_id,
            "title": "Uzman Kişi",
        };

        sides.push(experts);


        if (if_udf === 1)
        {
            html = '<p class="px-4 py-2 bg-primary text-white" style="border-radius:5px; display:inline-block" id="remove-'+index+'">Uzman Kişi  - ' + nameSurname + ' <a href="javascript:;" class="text-white remove_side ml-2" data-index="'+index+'">X</a></p><br/>';


            if (side_type_id === 1)
            {
                $("#sub_sides-claimant-"+side_id).append(html);
            }
            else
            {
                $("#sub_sides-defendant-"+side_id).append(html);
            }
        }
        else
        {
            html += '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
            html += '<input type="checkbox" name="new_side_ids[]" value="'+tcNo+'">Uzman Kişi - ' + nameSurname;
            html += '<span></span>';
            html += '</label>';

            $("#sub_sides-"+side_id).append(html);
        }

        $("#expertModal").modal('hide');

        index++;
    });

    $("body").delegate(".remove_side", "click", function ()
    {
        removeSide($(this).data('index'));
    });
});
