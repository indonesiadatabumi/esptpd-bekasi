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
$periode = $data['periode'];

// ambil data realisasi wp
$where = "WHERE wp.npwprd_noformat = '$npwpd'";
if ($periode != '') {
    $where .= " AND p.tahun_pajak='$periode'";
}

if ($jenis_pajak != '') {
    $where .= " AND wp.wp_wr_bidang_usaha='$jenis_pajak'";
}
$sql = "SELECT p.tahun_pajak, SUM(DISTINCT tagihan) AS total_realisasi_pajak, p.nm_rekening
        FROM payment.pembayaran_sptpd p
        LEFT JOIN v_wp_wr wp ON p.npwprd=wp.npwprd
        $where
        GROUP BY p.tahun_pajak,p.nm_rekening
        ORDER BY p.tahun_pajak ASC";
$result = pg_query($connect, $sql);
// $row = pg_fetch_array($result);

$data = array();
while ($row = pg_fetch_array($result)) {
    $tahun_pajak = $row['tahun_pajak'];
    $total = $row['total_realisasi_pajak'];
    $data[] = [
        'jenis_pajak' => $row['nm_rekening'],
        'tahun_pajak' => $tahun_pajak,
        'total_realiasi_pajak' => $total
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