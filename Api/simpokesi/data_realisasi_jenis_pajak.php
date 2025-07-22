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

$jenis_pajak = $data['jenis_pajak'];
$periode = $data['periode'];

$where = "WHERE setorpajret_jenis_pajakretribusi ='$jenis_pajak'";
if ($periode != '') {
    $where .= " AND setorpajret_spt_periode='$periode'";
}
// ambil data realisasi wp
$sql = "SELECT setorpajret_spt_periode,SUM(setorpajret_jlh_bayar) as total_bayar FROM v_setoran_pajak_retribusi $where GROUP BY setorpajret_spt_periode ORDER BY setorpajret_spt_periode DESC LIMIT 5";
$result = pg_query($connect, $sql);
// $row = pg_fetch_array($result);

$data = array();
while ($row = pg_fetch_array($result)) {
    $data[] = [
        'periode' => $row['setorpajret_spt_periode'],
        'total_realisasi' => $row['total_bayar']
        
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