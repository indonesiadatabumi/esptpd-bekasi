// /**
//  * Create main data grid
//  */
//  var createDataGrid = function (){
// 	$("#verifikasi_table").flexigrid({
// 		url: GLOBAL_FORMULIR_VARS["get_list"],
// 		dataType: 'json',
// 		colModel : [
// 			{display: 'ID', name : 'wp_wr_id', width : 200, sortable : true, align: 'left', hide:true},
// 			{display: 'No.', name : '', width : 30, align: 'center', process: cellClick},
// 			{display: '<input type=checkbox name="toggle" value="" onclick="selectRows();" />', name : '', width : 20, align: 'center', process: cellClick},
// 			{display: 'No. Formulir', name : 'form_nomor', width : 70, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Nama', name : 'form_nama', width : 150, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Alamat', name : 'form_alamat', width : 200, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Kecamatan', name : 'camat_nama', width : 110, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Kelurahan', name : 'lurah_nama', width : 110, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Status', name : 'status', width : 110, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Tgl. Kirim', name : 'form_tgl_kirim', width : 80, sortable : true, align: 'left', process: cellClick},
// 			{display: 'Tgl. kembali', name : 'form_tgl_kembali', width : 80, sortable : true, align: 'left', process: cellClick}
// 			],
// 		searchitems : [
// 			{display: 'No. Formulir', name : 'form_nomor', isdefault: true},
// 			{display: 'Nama', name : 'form_nama'},
// 			{display: 'Alamat', name : 'form_alamat'},
// 			{display: 'Kelurahan', name : 'lurah_nama'},
// 			{display: 'Kecamatan', name : 'camat_nama'},
// 			],
// 		sortname: "form_id",
// 		sortorder: "desc",
// 		usepager: true,
// 		title: 'DAFTAR FORMULIR PENDAFTARAN',
// 		useRp: true,
// 		rp: 10,
// 		showTableToggleBtn: true,
// 		height: 'auto'
// 	});
// };

$(document).ready(function(){
	//datatables
	table = $("#verifikasi_table").DataTable({
		"responsive": true,
		"autoWidth": false,
		"language": {
			"sEmptyTable": "Data WP Belum Ada"
		},
		// "processing": true, //Feature control the processing indicator.
		// "serverSide": true, //Feature control DataTables' server-side processing mode. 
		"order": [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": GLOBAL_FORMULIR_VARS["get_list"],
			"type": "POST"
		},
		//Set column definition initialisation properties.
		"columnDefs": [{
			"targets": [0],
			"orderable": false,
		}, ],
	});
});