$("#f_date_c, #f_date_a").datepicker({
	dateFormat: "dd-mm-yy",
	showOn: "both",
	constrainInput: true,
	buttonImage: GLOBAL_MAIN_VARS["BASE_URL"]+"assets/images/calendar.gif",
	buttonImageOnly: true,
	duration: "fast",
	maxDate: "D"
});
$('#f_date_c, #f_date_a').datepicker('setDate', 'c');