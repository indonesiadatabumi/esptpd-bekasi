/**
 * Create main data grid
 */
 var createDataGrid = function (){
	$("#akses_table").flexigrid({
		url: GLOBAL_FORMULIR_VARS["akses_menu"],
		dataType: 'json',
		colModel : [
			{display: 'No.', name : '', width : 30, align: 'center'},
			{display: 'Nama Menu', name : 'title', width : 500, sortable : true, align: 'left'},
			{display: 'Hak Akses', name : 'Hak Akses Menu', width : 500, sortable : true, align: 'left'},
			],
		showTableToggleBtn: true,
		height: 'auto'
	});
};
 
$(document).ready(function(){
	createDataGrid();
});