<?php
require_once "fungsi.php";

$kode_billing = $_GET['kode_billing'];
$data = [
    'idbilling' => $kode_billing
];

$get_va = getVA($data);
// die;
if ($get_va->status == 'Create VA Sukses'){
    $response = [
        'status' => 'Create VA Sukses',
        'kode_billing' => $kode_billing,
        'va_number' => $get_va->va_number
    ];
}else{
    $response = [
        'status' => 'Create VA Gagal',
        'kode_billing' => $kode_billing,
        'va_number' => ''
    ];
}
echo json_encode($response);
?>