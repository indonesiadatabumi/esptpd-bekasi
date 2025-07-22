/**
 * createDataGrid
 * @returns
 */
var createDataGrid = function() {
	$("#setoran_table").flexigrid({
		url: GLOBAL_VIEW_SETORAN_VARS["get_list"],
		dataType: 'json',
		colModel : [
		    {display: 'No.', name : '', width : 40, align: 'left'},
			{display: 'Periode', name : 'spt_periode', width : 50, sortable : true, align: 'center'},
			{display: 'No. KOHIR/SPT', name : 'spt_nomor', width : 80, sortable : true, align: 'left'},
			{display: 'Tgl Setoran', name : 'tgl_pembayaran', width : 150, sortable : true, align: 'center'},
			{display: 'Nama Pajak', name : 'ref_jenparet_ket', width : 110, sortable : true, align: 'left'},
			{display: 'Jumlah (Rp)', name : 'sptpd_yg_dibayar', width : 90, sortable : true, align: 'right'},
			{display: 'NPWPD/NPWRD', name : 'npwprd', width : 110, sortable : true, align: 'left'},
			{display: 'Nama WP', name : 'wp_wr_nama', width : 250, sortable : true, align: 'left'},
			],
		searchitems : [
			{display: 'No. KOHIR/SPT', name : 'spt_nomor', isdefault: true},
			{display: 'Periode SPT', name : 'spt_periode'},
			{display: 'NPWPD/NPWRD', name : 'npwprd'},
			{display: 'Nama WP', name : 'wp_wr_nama'}
			],
		sortname: "tgl_pembayaran",
		sortorder: "DESC",
		usepager: true,
		title: 'DAFTAR SETORAN',
		useRp: true,
		rp: 15,
		showTableToggleBtn: true,
		height: 'auto'
	});
};

$(document).ready(function(){
	createDataGrid();
	
	$('#btn_back').click(function() {
		load_content(GLOBAL_VIEW_SETORAN_VARS["back"]);
	});
});