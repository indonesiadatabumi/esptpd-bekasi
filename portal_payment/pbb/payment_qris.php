<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once "koneksi.php";
require_once "fungsi.php";

//mengubah standar encoding
$content    = file_get_contents("php://input");
$content    = utf8_encode($content);
$data       = json_decode($content, TRUE);

$billNumber = $data['billNumber'];
$purposetrx = $data['purposetrx'];
$storelabel = $data['storelabel'];
$customerlabel = $data['customerlabel'];
$terminalUser = $data['terminalUser'];
$amount = $data['amount'];
$core_reference = $data['core_reference'];
$customerPan = $data['customerPan'];
$merchantPan = $data['merchantPan'];
$pjsp = $data['pjsp'];
$invoice_number = $data['invoice_number'];
$transactionDate = $data['transactionDate'];

$kode_billing = substr($billNumber, 4);

// ambil data bphtb
$get_data = getDataPbb($kode_billing);
$ket = $get_data->ket;
if (substr($kode_billing, 14) == date('Y')) {
    $tahun_pajak = $get_data->tahun_pajak;
} else {
    foreach ($get_data->tagihan as $k => $v) {
        $array_tahun_pajak[$k] = $v->tahun;
    }
    $tahun_pajak_awal = min($array_tahun_pajak);
    $tahun_pajak_akhir = max($array_tahun_pajak);
    $tahun_pajak = $tahun_pajak_awal . "-" . $tahun_pajak_akhir;
}
$total_bayar = intval($amount);
$tgl_bayar = $transactionDate;
$masa = date('m');
$data = [
    'nop' => $get_data->nop,
    'merchant' => "6010",
    'datetime' => $tgl_bayar,
    'masa' => $masa,
    'tahun' => $tahun_pajak,
    'pokok' => intval($get_data->pajak),
    'denda' => intval($get_data->denda),
    'total' => $total_bayar,
];
// kirim callback ke sirido
$callback_bphtb = callbackPbb($data);

// update status tabel qris_va_spt
$sql = "UPDATE qris_va_spt SET status='1', tgl_bayar='$transactionDate' WHERE kode_billing='$kode_billing' AND barcode IS NOT NULL";
$result = pg_query($connect, $sql);

// insert table log_payment_qris_va
$sql_log = "INSERT INTO log_payment_qris_va (kode_billing, ket, jumlah_bayar, tgl_bayar, code_response, desc_response, type_payment) VALUES ('$kode_billing', '$ket', $total_bayar, '$transactionDate', '00', 'Success', 'QRIS JATIM')";
$result_log = pg_query($connect, $sql_log);

$response = [
    'responsCode' => '00',
    'responsDesc' => 'Success',
    'billNumber' => $kode_billing,
    'purposetrx' => $purposetrx,
    'storelabel' => $storelabel,
    'customerlabel' => $customerlabel,
    'terminalUser' => $terminalUser,
    'amount' => $amount,
    'core_reference' => $core_reference,
    'customerPan' => $customerPan,
    'merchantPan' => $merchantPan,
    'pjsp' => $pjsp,
    'invoice_number' => $invoice_number,
    'transactionDate' => $transactionDate
];

echo json_encode($response);
