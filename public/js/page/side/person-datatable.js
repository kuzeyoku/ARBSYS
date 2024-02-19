"use strict";
var KTDatatablesSearchOptionsAdvancedSearch = function() {

	$.fn.dataTable.Api.register('column().title()', function() {
		return $(this.header()).text().trim();
	});

	var initTable1 = function() {
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
				url: '/person_filter_by_params',
				type: 'POST',
				data: {
				    '_token': $('meta[name="csrf-token"]').attr('content')
				},
			},
			columns: [
			    {
			        title: 'Tip',
			        data: 'type',
                    sortable: false
                },
                {
			        title: 'Ad',
			        data: 'name',
                    sortable: true
                },
                {
                    title: 'Telefon',
                    data: 'phone',
                    sortable: false
                },
                {
                    title: 'E-Posta',
                    data: 'email',
                    sortable: false
                },
                {
                    title: 'Adres',
                    data: 'address',
                    sortable: false
                },
                {
                    data: 'İşlemler',
                    responsivePriority: -1,
                    sortable: false
                }
			],

			columnDefs: [
                {
                    targets: 0,
                    title: 'Tip',
                    render: function(data, type, full, meta) {
                        if (full.type === "person") {
                            return "Gerçek Kişi";
                        } else if (full.type === "company") {
                            return "Tüzel Kişi      ";
                        } else if (full.type === "lawyer") {
                            return "Avukat";
                        }
                    }
                },
				{
					targets: -1,
					title: 'İşlemler',
					render: function(data, type, full, meta) {
					    var html = "";
					    html += '<a href="javascript:;" data-id="'+full.id+'" data-type="'+full.type+'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-person-button" title="Kişi Düzenle"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:;" data-id="'+full.id+'" data-type="'+full.type+'" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-person-button" title="Kişi Sil"><i class="la la-remove"></i></a>';
                        return html;
					}
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
