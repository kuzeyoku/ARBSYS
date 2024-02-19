"use strict";
var KTDatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
            language: {
                url: 'js/plugins/datatable/Turkish.json'
            },
            columnDefs: [
                {
                    targets: -1,
                    title: 'İşlemler',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '\
                        <a href="/soother_info_confirmation/'+full[0]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Onayla">\
                          <i class="la la-check"></i>\
                        </a>\
                        <a href="/arabulucu/'+full[0]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Düzenle">\
                          <i class="la la-pencil"></i>\
                        </a>\
                        <a href="javascript:;" data-id="'+full[0]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md reject_btn" title="Reddet">\
                          <i class="la la-times"></i>\
                        </a>';
                    },
                }
            ],
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
	KTDatatablesDataSourceHtml.init();
});
