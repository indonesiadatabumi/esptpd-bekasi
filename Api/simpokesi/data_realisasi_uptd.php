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

$npwpd = $data['npwpd'];
$kd_uptd = $data['kd_uptd'];
$jenis_pajak = $data['jenis_pajak'];
$periode = $data['periode'];

// ambil data realisasi wp
$where = "WHERE wp_wr_kd_camat = '$kd_uptd' AND setorpajret_jenis_pajakretribusi='$jenis_pajak'";
if ($periode != '') {
    $where .= " AND setorpajret_spt_periode='$periode'";
}

if ($npwpd != '') {
    $where .= " AND npwprd='$npwpd'";
}

if ($npwpd == '' && $kd_uptd == '' && $jenis_pajak == '' && $periode == '') {
    $sql = "SELECT SUM(setorpajret_jlh_bayar) as total_bayar FROM v_setoran_pajak_retribusi";
}else {
    $sql = "SELECT SUM(setorpajret_jlh_bayar) as total_bayar, setorpajret_spt_periode FROM v_setoran_pajak_retribusi $where GROUP BY setorpajret_spt_periode ORDER BY setorpajret_spt_periode DESC LIMIT 5";
}

$result = pg_query($connect, $sql);
// $row = pg_fetch_array($result);

$data = array();
while ($row = pg_fetch_array($result)) {
    // $data[] = [
    //     'npwpd' => $row['npwprd'],
    //     'masa_pajak1' => $row['setorpajret_periode_jual1'],
    //     'masa_pajak2' => $row['setorpajret_periode_jual2'],
    //     'periode' => $row['setorpajret_spt_periode'],
    //     'tagihan' => $row['setorpajret_jlh_bayar'],
    //     'jml_bayar' => $row['setorpajret_jlh_bayar'],
    //     'tgl_bayar' => $row['setorpajret_tgl_bayar']
    // ];
    $data[] = [
        'total_realisasi' => $row['total_bayar'],
        'periode' => $row['setorpajret_spt_periode']
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