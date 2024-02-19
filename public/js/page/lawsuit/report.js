"use strict";
var KTDatatablesSearchOptionsAdvancedSearch = function() {

	$.fn.dataTable.Api.register('column().title()', function() {
		return $(this.header()).text().trim();
	});

	var initTable1 = function() {
	    var token = $('#kt_table_1').data('token');

		// begin first table
        var table = $('#kt_table_1').DataTable({
			responsive: true,
			// Pagination settings
			dom: "<'row'<'col-sm-12'tr>>\
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
			// read more: https://datatables.net/examples/basic_init/dom.html

			lengthMenu: [5, 10, 25, 50],

			pageLength: 10,

			language: {
				'lengthMenu': 'Display _MENU_',
                url: 'js/plugins/datatable/Turkish.json'
            },

			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: {
				url: '/lawsuit_filter_by_params',
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
                        'Başvurucu',
                        'Karşı Taraf',
                        'Yıl',
                        'Büro Dosya No',
                        'Arabuluculuk Dosya No',
                        'Uyuşmazlık Türü',
                        'Başvuru Tarihi',
                        'Görevin Kabul Tarihi',
                        'Son Süre',
                        'Sonuç',
                        'İşlemler'
                    ],
                    _token: token,
                    from: "report"
				},
			},
			columns: [
                {data: 'Başvurucu'},
                {data: 'Karşı Taraf'},
                {data: 'Yıl'},
                {data: 'Büro Dosya No'},
                {data: 'Arabuluculuk Dosya No'},
                {data: 'Uyuşmazlık Türü'},
                {data: 'Başvuru Tarihi'},
                {data: 'Görevin Kabul Tarihi'},
                {data: 'Son Süre'},
                {data: 'Sonuç'},
                {data: 'İşlemler', responsivePriority: -1}
			],

			columnDefs: [
                {
                    targets: 0,
                    width: "34%",
                    orderable: false
                },
                {
                    targets: 1,
                    width: "34%",
                    orderable: false
                },
                {
                    targets: 2,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 3,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 4,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 5,
                    width: "24%",
                    orderable: false
                },
                {
                    targets: 7,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 8,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 9,
                    width: "1%",
                    orderable: false
                },
                {
                    targets: 10,
                    width: "1%",
                    orderable: false
                },
			    {
					targets: -1,
                    width: "1%",
					title: 'İŞLEMLER',
					orderable: false,
					render: function(data, type, full, meta) {
					    var html = "";
                        html += '<span class="dropdown dropdown-inline">';
                            html += '<a href="#" class="mr-1" data-toggle="dropdown" aria-expanded="true">';
                                html += '<i class="la la-ellipsis-h"></i>';
                            html += '</a>';
                            html += '<div class="dropdown-menu dropdown-menu-right">';
                                if (full["Süreç"] == 5) {
                                    var table_rows = document.querySelectorAll("#kt_table_1 tr");

                                    if (typeof table_rows[(meta["row"]+1)] !== 'undefined') {
                                        table_rows[(meta["row"]+1)].classList.add("lawsuit_closed");
                                    }
                                }

                                if (full["Has Final Protocol"] == true && full["Süreç"] != 5)
                                {
                                    html += '<a class="dropdown-item dosya-sistemden-kapatildi-button" data-id="'+ full["Sistem No"]+'" href="javascript:;"><i class="fas fa-envelope-open-text"></i> Dosya sistemden kapatıldı</a>';
                                }
                                else
                                {
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/davet-mektubu"><i class="fas fa-envelope-open-text"></i> Davet Mektubu Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/arabuluculuk-surecine-iliskin-bilgilendirme-tutanagi"><i class="fas fa-envelope-open-text"></i> Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/arabulucu-belirleme-tutanagi"><i class="fas fa-envelope-open-text"></i> Arabulucu Belirleme Tutanağı Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/toplanti-tutanagi"><i class="fas fa-envelope-open-text"></i> Toplantı Tutanağı Oluştur</a>';
                                    if (full["Agreement"]) {
                                        html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/anlasma-belgesi"><i class="fas fa-envelope-open-text"></i> Anlaşma Belgesi Oluştur</a>';
                                    } else {
                                        html += '<a class="dropdown-item agreement-type-button" href="javascript:void(0);" data-id="'+ full["Sistem No"]+'"><i class="fas fa-envelope-open-text"></i> Anlaşma Belgesi Oluştur</a>';
                                    }
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/ucret-sozlesmesi"><i class="fas fa-envelope-open-text"></i> Ücret Sözleşmesi Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/son-tutanak"><i class="fas fa-envelope-open-text"></i> Son Tutanak Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/yetki-itirazı-ust-yazi"><i class="fas fa-envelope-open-text"></i> Yetki İtirazı Üst Yazı Oluştur</a>';
                                    html += '<a class="dropdown-item" href="/dosya/'+ full["Sistem No"]+'/yetki-belgesi"><i class="fas fa-envelope-open-text"></i> Yetki Belgesi Oluştur</a>';
                                }

                                if (full["Archive"] == false)
                                {
                                    html += '<a class="dropdown-item dosya-arsivle" data-id="'+ full["Sistem No"]+'" href="javascript:;"><i class="fas fa-envelope-open-text"></i> Arşivle</a>';
                                }

                            html += '</div>';
                        html += '</span>';
                        html += '<span class="dropdown dropdown-inline">';
                            html += '<a href="#" class="" data-toggle="dropdown" aria-expanded="true">';
                                html += '<i class="la la-cog"></i>';
                            html += '</a>';
                            html += '<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">';
                        html += '<a class="dropdown-item" href="/dosya/'+full["Sistem No"]+'/evraklarim" title=""><i class="la la-file"></i>Evraklarım</a>';
                        html += '<a class="dropdown-item" href="/dosya/'+full["Sistem No"]+'/taraflar" title=""><i class="la la-user"></i>Taraflar</a>';
                        html += '<a class="dropdown-item" href="/dosya/'+full["Sistem No"]+'/duzenle" title=""><i class="la la-edit"></i>Düzenle</a>';
                            html += '</div>';
                        html += '</span>';

                        return html;
					},
				}
			],
		});

        $("body").delegate(".dosya-arsivle","click", function (e)
        {
            var url = "lawsuit-archive/" + $(this).data('id');

            e.preventDefault();

            $.ajax({
                url:url,
                type:"GET",
                success : function (data)
                {
                    table.ajax.reload();
                    toastr['success']('Dosya Arşive Alındı.');
                }
            });
        });

        $("body").delegate(".dosya-sistemden-kapatildi-button","click", function (e)
        {
            e.preventDefault();

            lawsuit_id = $(this).data('id');

            $("input[name='lawsuit_id']").val(lawsuit_id);
            $("#dosya-sistemden-kapatildi").modal("show");
        });

        $("body").delegate("#dosya-sistemden-kapatildi-evet", "click", function (e)
        {
            e.preventDefault();

            $("#dosya-sistemden-kapatildi-form").ajaxSubmit({
                success: function (data)
                {
                    $("#dosya-sistemden-kapatildi").modal("hide");
                    toastr['success']('Dosya Sistemden Kapatıldı');
                    window.location.reload();
                }
            });
        });

        $("body").delegate(".agreement-type-button","click", function (e)
        {
            e.preventDefault();

            lawsuit_id = $(this).data('id');
            $("input[name='lawsuit_id']").val(lawsuit_id);
            $("#agreement_type_modal").modal("show");
        });

        $("body").delegate(".agreement_type_modal_ok", "click", function (e)
        {
            e.preventDefault();
            if (typeof $('input[name="subject_answer"]:checked').val() === 'undefined') {
                swal.fire("Lütfen seçim yapınız!");
                return false;
            }
            $("input[name='agreement_type_id']").val($('input[name="subject_answer"]:checked').val());
            $("#agreement-type-form").ajaxSubmit({
                success: function (data)
                {
                    $("#agreement_type_modal").modal("hide");
                    window.location.href = "/dosya/"+$("input[name='lawsuit_id']").val()+"/anlasma-belgesi";
                }
            });
        });

        $("body").delegate('input[name="subject_answer"]', "change", function (e) {
            $('.subject_answer_result').val($('input[name="subject_answer"]:checked').data('template'));
        });

		var filter = function() {
			var val = $.fn.dataTable.util.escapeRegex($(this).val());
			table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
		};

		var asdasd = function(value, index) {
			var val = $.fn.dataTable.util.escapeRegex(value);
			table.column(index).search(val ? val : '', false, true);
		};

		$('#kt_search').on('click', function(e) {
			e.preventDefault();
			var params = {};
			$('.kt-input').each(function() {
				var i = $(this).data('col-index');
				if (params[i]) {
					params[i] += '|' + $(this).val();
				}
				else {
					params[i] = $(this).val();
				}
			});
			$.each(params, function(i, val) {
				// apply search params to datatable
				table.column(i).search(val ? val : '', false, false);
			});
			table.table().draw();
		});

		$('#kt_reset').on('click', function(e) {
			e.preventDefault();
			$('.kt-input').each(function() {
				$(this).val('');
				table.column($(this).data('col-index')).search('', false, false);
			});
			table.table().draw();
		});

		$('.kt_datepicker').datepicker({
			templates: {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>',
			},
            format: 'dd.mm.yyyy',
            weekStart: 1,
            language: 'tr',
            orientation: "bottom left",
        });

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		}
	};
}();

jQuery(document).ready(function() {
	KTDatatablesSearchOptionsAdvancedSearch.init();
});
