<?php 
error_reporting(E_ERROR);

//add library
require_once(APPPATH.'libraries/Worksheet.php');
require_once(APPPATH.'libraries/Workbook.php');

function HeaderingExcel($filename){
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=$filename");
    header("Expires:0");
    header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");
}

 // HTTP headers
HeaderingExcel('daftar_stpd.xls');

// Creating a workbook
$workbook=new Workbook("-");

$ftitle =& $workbook->add_format();
$ftitle->set_size(10);
$ftitle->set_bold();
$ftitle->set_align('center');
$ftitle->set_font("Trebuchet MS");

$fheader =& $workbook->add_format();
$fheader->set_size(8);
$fheader->set_bold();
$fheader->set_border(1);
$fheader->set_align('center');
$fheader->set_font("Trebuchet MS");
$fheader->set_text_wrap();

$fheader_number =& $workbook->add_format();
$fheader_number->set_size(6);
$fheader_number->set_bold();
$fheader_number->set_border(1);
$fheader_number->set_align('center');
$fheader_number->set_font("Trebuchet MS");

$ftotal_currency =& $workbook->add_format();
$ftotal_currency->set_size(8);
$ftotal_currency->set_num_format("#,##0.00");
$ftotal_currency->set_bold();
$ftotal_currency->set_align('right');
$ftotal_currency->set_font("Trebuchet MS");
$ftotal_currency->set_border(1);

$fcurrency =& $workbook->add_format();
$fcurrency->set_num_format("#,##0.00");
$fcurrency->set_align('right');
$fcurrency->set_size(8);
$fcurrency->set_border(1);
$fcurrency->set_font("Trebuchet MS");

$fdate =& $workbook->add_format();
$fdate->set_num_format('dd-mm-yyyy');
$fdate->set_align('center');
$fdate->set_size(8);
$fdate->set_border(1);
$fdate->set_font("Trebuchet MS");

$fdata_bold =& $workbook->add_format();
$fdata_bold->set_bold();
$fdata_bold->set_size(8);
$fdata_bold->set_align('left');
$fdata_bold->set_border(1);
$fdata_bold->set_font("Trebuchet MS");

$fdata =& $workbook->add_format();
$fdata->set_size(8);
$fdata->set_align('left');
$fdata->set_border(1);
$fdata->set_font("Trebuchet MS");
	   
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet("DAFTAR STPD");
$worksheet1->set_landscape();
$worksheet1->set_column(0,0,5);
$worksheet1->set_column(0,1,10);
$worksheet1->set_column(0,2,10);
$worksheet1->set_column(0,3,25);
$worksheet1->set_column(0,4,30);
$worksheet1->set_column(0,5,35);
$worksheet1->set_column(0,6,35);
$worksheet1->set_column(0,7,35);
$worksheet1->set_column(0,8,17);


$worksheet1->write_string(0,0, "PENERBITAN SURAT TAGIHAN PAJAK DAERAH (STPD) " . strtoupper($jenis_pajak), $ftitle); 
$worksheet1->merge_cells(0, 0, 0, 8);

$worksheet1->write_string(1,0, "BERDASARKAN REALISASI " .strtoupper(getNamaBulan($_GET['bulan']))." ".$_GET['tahun'], $ftitle); 
$worksheet1->merge_cells(1, 0, 1, 8);

if ($kecamatan != "") {
	$worksheet1->write_string(2,0, "KECAMATAN ".strtoupper($kecamatan), $ftitle); 
	$worksheet1->merge_cells(2, 0, 2, 9);
}

//start no baris
$no_baris = 3;

$worksheet1->write_string($no_baris,0, "NO",$fheader);
$worksheet1->merge_cells($no_baris, 0, $no_baris + 1, 0);
$worksheet1->write_string($no_baris,1, "STPD",$fheader);
$worksheet1->write_string($no_baris,2, "",$fheader);
$worksheet1->merge_cells($no_baris, 1, $no_baris, 2);
$worksheet1->write_string($no_baris,3, "NAMA WAJIB PAJAK / ALAMAT",$fheader);
$worksheet1->merge_cells($no_baris, 3, $no_baris + 1, 3);
$worksheet1->write_string($no_baris,4, "NPWPD",$fheader);
$worksheet1->merge_cells($no_baris, 4, $no_baris + 1, 4);
$worksheet1->write_string($no_baris,5, "MASA PAJAK", $fheader);
$worksheet1->merge_cells($no_baris, 5, $no_baris + 1, 5);
$worksheet1->write_string($no_baris,6, "REALISASI",$fheader);
$worksheet1->write_string($no_baris,7, "",$fheader);
$worksheet1->merge_cells($no_baris, 6, $no_baris, 7);
$worksheet1->write_string($no_baris,8, "SANKSI ADMINISTRASI",$fheader);
$worksheet1->write_string($no_baris,9, "",$fheader);
$worksheet1->write_string($no_baris,10, "",$fheader);
$worksheet1->merge_cells($no_baris, 8, $no_baris, 10);
$worksheet1->write_string($no_baris,11, "KET.",$fheader);
$worksheet1->merge_cells($no_baris, 11, $no_baris + 1, 11);

$no_baris++;
$worksheet1->write_string($no_baris,0, "",$fheader);
$worksheet1->write_string($no_baris,1, "NOMOR",$fheader);
$worksheet1->write_string($no_baris,2, "TANGGAL",$fheader);
$worksheet1->write_string($no_baris,3, "",$fheader);
$worksheet1->write_string($no_baris,4, "",$fheader);
$worksheet1->write_string($no_baris,5, "", $fheader);
$worksheet1->write_string($no_baris,6, "TANGGAL", $fheader);
$worksheet1->write_string($no_baris,7, "Rp", $fheader); 
$worksheet1->write_string($no_baris,8, "BULAN PENGENAAN", $fheader);
$worksheet1->write_string($no_baris,9, "BUNGA", $fheader);
$worksheet1->write_string($no_baris,10, "JUMLAH (Rp)", $fheader);
$worksheet1->write_string($no_baris,11, "", $fheader);


//add new line
$no_baris++;

$counter = 1;
$realisasi = 0;
$pajak = 0;

// number of seconds in a day
$seconds_in_a_day = 86400;
// Unix timestamp to Excel date difference in seconds
$ut_to_ed_diff = $seconds_in_a_day * 25569;


if (count($query) > 0) {
	foreach($query as $key => $val) {
		$arr_masa_pajak = explode("-", $val['stpd_periode_jual1']);
		$worksheet1->write_number($no_baris,0, $counter, $fdata);
		$worksheet1->write_number($no_baris,1, $val['stpd_nomor'], $fdata);
		$worksheet1->write($no_baris,2, format_tgl($val['stpd_tgl_proses']), $fdata);
		$worksheet1->write($no_baris,3, $val['wp_wr_nama'],$fdata);
		$worksheet1->write($no_baris,4, $val['npwprd'],$fdata);
		$worksheet1->write($no_baris,5, getNamaBulan($arr_masa_pajak[1])." ".$arr_masa_pajak[0],$fdata);
		$worksheet1->write($no_baris,6, format_tgl($val['stpd_tgl_setoran']), $fdata);
		$worksheet1->write_number($no_baris,7, $val['stpd_jumlah_setoran'],$fcurrency);
		$worksheet1->write($no_baris,8, $val['stpd_bulan_pengenaan'],$fdata);
		$worksheet1->write($no_baris,9, $val['stpd_bunga']." %",$fdata);
		$worksheet1->write_number($no_baris,10, $val['stpd_pajak'],$fcurrency);
		$worksheet1->write($no_baris,11, "",$fdata);
		
		$no_baris++; $counter++;
		$realisasi += $val['stpd_jumlah_setoran'];
		$pajak += $val['stpd_pajak'];
	}
}


$worksheet1->write_string($no_baris,0, "JUMLAH",$fheader_number);
$worksheet1->write_string($no_baris,1, "",$fheader);
$worksheet1->write_string($no_baris,2, "",$fheader);
$worksheet1->write_string($no_baris,3, "",$fheader);
$worksheet1->write_string($no_baris,4, "",$fheader);
$worksheet1->write_string($no_baris,5, "", $fheader);
$worksheet1->write_string($no_baris,6, "", $fheader);
$worksheet1->merge_cells($no_baris, 0, $no_baris, 6);
$worksheet1->write_number($no_baris,7, $realisasi, $ftotal_currency);
$worksheet1->write_string($no_baris,8, "", $fheader);
$worksheet1->write_string($no_baris,9, "", $fheader);
$worksheet1->write_number($no_baris,10, $pajak, $ftotal_currency); 
$worksheet1->write_string($no_baris,11, "", $fheader);

//close workbook
$workbook->close();

?>