"use strict";
var KTDatatablesSearchOptionsAdvancedSearch = function() {

	$.fn.dataTable.Api.register('column().title()', function() {
		return $(this.header()).text().trim();
	});

	var initTable1 = function() {
	    var lawsuit_id = $('#kt_table_1').data('lawsuitid');

        applicant = 0;
        opponent = 0;

	    table = true;
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
				url: '/side_filter_by_params',
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
                        'Taraf No',
                        'Ad Soyad',
                        'Taraf',
                        'Tip',
                        'İşlemler'
                    ],
                    lawsuit_id:lawsuit_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
				},
			},
			columns: [
			    {data: 'Taraf No'},
                {data: 'Ad Soyad'},
                {data: 'Taraf'},
                {data: 'Tip'},
                {data: 'İşlemler', responsivePriority: -1}
			],

			columnDefs: [
				{
					targets: -1,
					title: 'İşlemler',
					orderable: false,
					render: function(data, type, full, meta) {
					    if (full["Taraf"] === "Başvuran" && ( full["Tip"] === "Şahıs" || full["Tip"] === "Şirket" )) {
                            applicant += 1;
                        } else if (full["Taraf"] === "Karşı Taraf" && ( full["Tip"] === "Şahıs" || full["Tip"] === "Şirket" )) {
                            opponent += 1;
                        }
					    var html = "";

                        html += '<a href="javascript:;" data-id="'+full["Taraf No"]+'" data-type="'+full["Tip"]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-side-button" title="Evraklarım"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:;" data-id="'+full["Taraf No"]+'" data-side="'+full["Taraf"]+'" data-type="'+full["Tip"]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-side-button" title="Sil"><i class="la la-remove"></i></a>';
                        return html;
					},
				}
			],
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
