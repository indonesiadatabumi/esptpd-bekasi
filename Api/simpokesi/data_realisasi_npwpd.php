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

$npwprd = $data['npwpd'];
$jenis_pajak = $data['jenis_pajak'];
$periode = $data['periode'];

$where = "WHERE npwprd LIKE '$npwprd'";
if ($periode != '') {
    $where .= " AND setorpajret_spt_periode='$periode'";
}

if ($jenis_pajak != '') {
    $where .= " AND setorpajret_jenis_pajakretribusi='$jenis_pajak'";
}
// ambil data realisasi wp
$sql = "SELECT * FROM v_setoran_pajak_retribusi $where ORDER BY setorpajret_id ASC";
$result = pg_query($connect, $sql);
// $row = pg_fetch_array($result);

$data = array();
while ($row = pg_fetch_array($result)) {
    $data[] = [
        'npwpd' => $row['npwprd'],
        'masa_pajak1' => $row['setorpajret_periode_jual1'],
        'masa_pajak2' => $row['setorpajret_periode_jual2'],
        'periode' => $row['setorpajret_spt_periode'],
        'tagihan' => $row['setorpajret_jlh_bayar'],
        'jml_bayar' => $row['setorpajret_jlh_bayar'],
        'tgl_bayar' => $row['setorpajret_tgl_bayar']
    ];
}

// $response = [
//         'statusError' => '00',
//         'statusMessage' => 'Sukses',
//         'data' => $data
//     ];

if (!$data) {
    $response = [
        'statusError' => '04',
        'statusMessage' => 'Data tidak ditemukan'
    ];
}else {
    $response = [
        'statusError' => '00',
        'statusMessage' => 'Sukses',
        'data' => $data
    ];
}

echo json_encode($response);
?>