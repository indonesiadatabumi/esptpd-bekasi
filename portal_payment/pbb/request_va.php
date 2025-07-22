<?php
require_once "fungsi.php";

$nop = $_GET['nop'];
$pokok = $_GET['pokok'];
$diskon = $_GET['diskon'];
$denda = $_GET['denda'];
$tahun = $_GET['tahun'];

$data = [
    'nop' => $nop,
    'pokok' => $pokok,
    'diskon' => $diskon,
    'denda' => $denda,
    'tahun' => $tahun
];

$get_va = getVA($data);

if ($get_va->status == 'Create VA Sukses'){
    $response = [
        'status' => 'Create VA Sukses',
        'nop' => $get_va->nop,
        'va_number' => $get_va->va_number
    ];
}else{
    $response = [
        'status' => 'Create VA Gagal',
        'nop' => $get_va->nop,
        'va_number' => ''
    ];
}
echo json_encode($response);
?>