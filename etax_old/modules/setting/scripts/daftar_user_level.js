/**
 * Create main data grid
 */
var createDataGrid = function (){
	$("#formulir_table").flexigrid({
		url: GLOBAL_FORMULIR_VARS["get_list"],
		dataType: 'json',
		colModel : [
			{display: 'No.', name : '', width : 30, align: 'center'},
			{display: 'Nama Jabatan', name : 'ref_jab_nama', width : 500, sortable : true, align: 'left'},
			{display: 'Hak Akses', name : 'Hak Akses Menu', width : 500, sortable : true, align: 'left'},
			],
		searchitems : [
			{display: 'Nama Jabatan', name : 'ref_jab_nama'},
			],
		sortname: "ref_jab_id",
		sortorder: "desc",
		usepager: true,
		title: 'DAFTAR USER LEVEL',
		useRp: true,
		rp: 10,
		showTableToggleBtn: true,
		height: 'auto'
	});
};

var aksesmenu = function(ref_jab_id) {
	load_content(GLOBAL_FORMULIR_VARS["aksesmenu"], {'ref_jab_id' : ref_jab_id});
};
 
$(document).ready(function(){
	createDataGrid();
});