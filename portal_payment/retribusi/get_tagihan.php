<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once "koneksi.php";
require_once "fungsi.php";

$kode_billing = $_GET['kode_billing'];

// ambil data tagihan
$query_cek_tagihan = "SELECT * FROM v_data_payment_retribusi
        WHERE spt_kode_billing='" . $kode_billing . "'";
$result_cek_tagihan = pg_query($connect, $query_cek_tagihan);
$row_cek_tagihan = pg_fetch_object($result_cek_tagihan);

if ($row_cek_tagihan == null) { // apabila data tidak ditemukan
    $response = [
        'status' => 'Gagal',
        'data' => 'Data Tagihan Tidak Ditemukan'
    ];
} else {
    $status_bayar = $row_cek_tagihan->status_bayar;

    if ($status_bayar == '1') { // apabila data tagihan sudah lunas
        $response = [
            'status' => 'Gagal',
            'data' => 'Data Tagihan Telah Lunas'
        ];
    }else{
        $npwprd = $row_cek_tagihan->npwprd;
        $nama = $row_cek_tagihan->wp_wr_nama;
        $alamat = $row_cek_tagihan->wp_wr_almt;
        $kelurahan = $row_cek_tagihan->wp_wr_lurah;
        $kecamatan = $row_cek_tagihan->wp_wr_camat;
        $ket = "Retribusi Pajak Daerah";
        $nama_kegus = $row_cek_tagihan->korek_nama;
        $tahun_pajak = $row_cek_tagihan->spt_periode;
        $masa_pajak1 = $row_cek_tagihan->spt_periode_jual1;
        $masa_pajak2 = $row_cek_tagihan->spt_periode_jual2;
        $kode_billing = $row_cek_tagihan->spt_kode_billing;
        $pokok_pajak = (int) round($row_cek_tagihan->spt_pajak);
        $masa_lapor = date('Y-m-d', strtotime("+1 months", strtotime($row_cek_tagihan->spt_periode_jual1)));
        $jatuh_tempo = date('Y-m-10', strtotime($masa_lapor));

        // if ($row_cek_tagihan->spt_jenis_pemungutan=='3') {//apabila stpd
        //     $get_denda = 0;
        // }else {
        //     $get_denda = denda($jatuh_tempo, date('Y-m-d'), $pokok_pajak);
        // }
        // $get_denda = denda($jatuh_tempo, date('Y-m-d'), $pokok_pajak);
        $get_denda = 0;
        
        $total_bayar = $pokok_pajak + $get_denda;

        $data = [
            'npwprd' => $npwprd,
            'nama' => $nama,
            'alamat' => $alamat,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'ket' => $ket,
            'nama_kegus' => $nama_kegus,
            'tahun_pajak' => $tahun_pajak,
            'masa_pajak1' => date_indo($masa_pajak1),
            'masa_pajak2' => date_indo($masa_pajak2),
            'kode_billing' => $kode_billing,
            'pajak' => number_format($pokok_pajak, 0, ",", "."),
            'denda' => number_format($get_denda, 0, ",", "."),
            'total_bayar' => number_format($total_bayar, 0, ",", ".")
        ];

        $response = [
            'status' => 'Sukses',
            'data_tagihan' => $data
        ];
    } 
}

echo json_encode($response);
