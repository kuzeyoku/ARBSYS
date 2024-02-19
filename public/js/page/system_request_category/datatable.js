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
                        <a href="/gorus-ve-oneri-kategori/'+full[0]+'/duzenle" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Düzenle">\
                          <i class="la la-edit"></i>\
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
