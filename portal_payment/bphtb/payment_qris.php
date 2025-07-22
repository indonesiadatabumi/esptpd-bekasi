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

$kode_billing = $data['billNumber'];
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

// ambil data bphtb
$get_data = getDataBphtb($kode_billing);
$ket = $get_data->ket;
$tahun_pajak = $get_data->tahun_pajak;
$total_bayar = intval($amount);
$tgl_bayar = $transactionDate;
$data = [
    'kode_billing' => $kode_billing,
    'tahun_pajak' => $tahun_pajak,
    'total_bayar' => $total_bayar,
    'tgl_bayar' => $tgl_bayar
];
// kirim callback ke sirido
$callback_bphtb = callbackBphtb($data);

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
