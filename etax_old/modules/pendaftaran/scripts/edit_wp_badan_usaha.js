 /**
  * create event toolbar
  */
 var createEventToolbar = function (){	 	
 	$("#btn_add").click(function (){
 		// load content
 		load_content(GLOBAL_WP_BU_VARS["add_wp_bu"]);
 	});
 	
 	$("#btn_update").click(function (){
 		updateData();
 	});
 	
 	$("#btn_view").click(function (){
 		load_content(GLOBAL_WP_BU_VARS["view_wp_bu"]);
 	});
};

/**
 * submit form
 * @returns
 */
var updateData = function() {
	var showUpdateResponse = function (data) {
        if(data.status == true) {
        //    showNotification(data.msg);
			Swal.fire({
				position: "center",
				icon: "success",
				title: "Perubahan Data Berhasil",
				showConfirmButton: false,
				timer: 1500
			});
        } else {
        	alert(data.msg);
        }
	};
	
	var save_options = { 
		url : GLOBAL_WP_BU_VARS["update_wp_bu"],
		dataType : "json",
		beforeSubmit: jqform_validate,	// pre-submit callback 
		success: showUpdateResponse	// post-submit callback 
	};
	
	$("#frm_edit_wp_bu").ajaxSubmit(save_options);
};

var tabContent = function() {
	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTabjQ = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTabjQ).fadeIn(); //Fade in the active content
		return false;
	});
};
 
 var completePage = function() {
	$("#f_date_kk, #f_date_ktp").datepicker({
		dateFormat: "dd-mm-yy",
		showOn: "both",
		constrainInput: true,
		buttonImage: GLOBAL_MAIN_VARS["BASE_URL"]+"assets/images/calendar.gif",
		buttonImageOnly: true,
		duration: "fast", 
		changeMonth: true,
		changeYear: true,
		maxDate: "D",
		yearRange: '-90'
	});
	
	$("#f_date_a, #f_date_b, #f_date_c").datepicker({
   	   	dateFormat: "dd-mm-yy",
   	 	showOn: "both",
		buttonImage: GLOBAL_MAIN_VARS["BASE_URL"]+"assets/images/calendar.gif",
		buttonImageOnly: true,
		constrainInput: true,
		duration: "fast",
		beforeShow: function() {
			$('#f_date_b, #f_date_c').datepicker("option", 'minDate', $('#f_date_a').val());
		},
		onSelect: function( selectedDate ) {
			if (this.id == "f_date_a") {
				var date_b = $(this).datepicker('getDate');
				date_b.setDate(date_b.getDate()+7);
				$('#f_date_b').datepicker('setDate', date_b);
				$('#f_date_b, #f_date_c').datepicker("option", 'minDate', selectedDate);
			}
		}
   	});
	
	// $("#wp_wr_no_urut").mask("9999999");
	$("#wp_wr_telp").numeric("-");
   	// $("#wp_wr_kodepos").mask("99999");
   	$("#wp_wr_telp_milik").numeric("-");
   	// $("#wp_wr_kodepos_milik").mask("99999");
};

var selectBidangUsaha = function() {
	var createForm = function() {
		bidus = $("input[name=bidus]:checked").val();
		if (bidus == "1" || bidus == "16") {
			$("#detail_usaha").slideUp("fast").slideDown("slow");
			$("#detail_usaha").html($("#bidus_" + bidus).html());		
		} else {
			$("#detail_usaha").fadeOut("slow");
		}
	};
	
	$("input[name=bidus]").on("click", function() {
		createForm();	
	});
	
	createForm();
	$.post(GLOBAL_WP_BU_VARS["get_wp_detail"], { "wp_id": $("input[name=wp_wr_id]").val(),  "bidus": $("input[name=bidus]:checked").val()},
			 function(data){
				bidus = $("input[name=bidus]:checked").val();
			 	if (data.status == true) {
			 		row = data.row;
					if (bidus == "1") {
						$("select[name=gol_hotel]").val(row.golongan_hotel);
						$("input[name=txt_jumlah_kamar]").val(row.jumlah_kamar);
						$("input[name=txt_jumlah_standar]").val(row.jumlah_standar);
						$("input[name=txt_tarif_standar]").val(row.tarif_standar);
						$("input[name=txt_jumlah_standar_ac]").val(row.jumlah_standar_ac);
						$("input[name=txt_tarif_standar_ac]").val(row.tarif_standar_ac);
						$("input[name=txt_jumlah_double]").val(row.jumlah_double);
						$("input[name=txt_tarif_double]").val(row.tarif_double);
						$("input[name=txt_jumlah_superior]").val(row.jumlah_superior);
						$("input[name=txt_tarif_superior]").val(row.tarif_superior);
						$("input[name=txt_jumlah_delux]").val(row.jumlah_delux);
						$("input[name=txt_tarif_delux]").val(row.tarif_delux);
						$("input[name=txt_jumlah_executive_suite]").val(row.jumlah_executive_suite);
						$("input[name=txt_tarif_executive_suite]").val(row.tarif_executive_suite);
						$("input[name=txt_jumlah_club_room]").val(row.jumlah_club_room);
						$("input[name=txt_tarif_club_room]").val(row.tarif_club_room);
						$("input[name=txt_jumlah_apartment]").val(row.jumlah_apartment);
						$("input[name=txt_tarif_apartment]").val(row.tarif_apartment);
					} else if (bidus == "16") {
						$("select[name=ddl_jenis_restoran]").val(row.jenis_restoran);
						$("input[name=txt_jumlah_meja]").val(row.jumlah_meja);
						$("input[name=txt_jumlah_kursi]").val(row.jumlah_kursi);
						$("input[name=txt_kapasitas_pengunjung]").val(row.kapasitas_pengunjung);
						$("input[name=txt_jumlah_karyawan]").val(row.jumlah_karyawan);
					}
				}
			 }, "json");
};

$(document).ready(function(){
	tabContent();
	createEventToolbar();
	completePage();
	selectBidangUsaha();
});