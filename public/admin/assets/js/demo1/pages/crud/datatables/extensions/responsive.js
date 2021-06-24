"use strict";
var KTDatatablesExtensionsResponsive = function() {

	var initTable1 = function() {
		var table = $('#datatable');

		// begin first table
		table.DataTable({
			responsive: true,
            paging: false,
            info: false,
            searching: false,
            autoWidth: false,
            order: [],
            columnDefs: [
                { targets: 'no-sort', orderable: false },
                {"className": "dt-center", "targets": "_all"},
                { targets: 'no-sort', "max-width": "2px" },
                { width: '2%', targets: 0 },
                { width: '10%', targets: 'action-column' },
                { width: '20%', targets: 'status-column' }
            ]
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesExtensionsResponsive.init();

    $(".page--loading").fadeOut("slow");
});
