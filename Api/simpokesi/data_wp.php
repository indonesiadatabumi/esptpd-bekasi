<?php
// Menyembunyikan error notice
error_reporting(E_ALL & ~E_NOTICE);

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header('Access-Control-Allow-Headers: Content-Type');

require_once 'koneksi.php';

//mengubah standar encoding
$content    = file_get_contents("php://input");
$content    = utf8_encode($content);
$data       = json_decode($content,TRUE);

$npwpd = preg_replace('/[^A-Za-z0-9\-]/', '', $data['npwpd']);
$jenis_pajak = $data['jenis_pajak'];

// ambil data wp
$where = "WHERE npwprd_noformat='$npwpd'";

if ($jenis_pajak != '') {
    $where .= " AND wp_wr_bidang_usaha = '$jenis_pajak'";
}

$sql = "SELECT * FROM v_wp_wr $where";
$result = pg_query($connect, $sql);
$row = pg_fetch_object($result);

if (!$row) {
    $response = [
        'statusError' => '04',
        'statusMessage' => 'Data tidak ditemukan'
    ];
}elseif ($row->wp_wr_status_aktif == 'f') {
    $response = [
        'statusError' => '99',
        'statusMessage' => 'Wp telah tutup/tidak aktif'
    ];
}else {
    $response = [
        'statusError' => '00',
        'statusMessage' => 'Sukses',
        'data' => $row
    ];
}

echo json_encode($response);
?>