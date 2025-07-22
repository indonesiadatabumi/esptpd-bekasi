<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once "koneksi.php";
require_once "fungsi.php";

$kode_billing = $_GET['kode_billing'];

// ambil data tagihan
$query_cek_tagihan = "SELECT a.*, b.jenis_spt_id, c.kompensasi FROM payment.v_payment AS a 
        LEFT JOIN public.v_penyetoran_sspd AS b ON a.kode_billing=b.kode_billing
        LEFT JOIN public.spt AS c ON a.kode_billing=c.kode_billing
        WHERE a.kode_billing='" . $kode_billing . "'";
$result_cek_tagihan = pg_query($connect, $query_cek_tagihan);
$row_cek_tagihan = pg_fetch_object($result_cek_tagihan);
$npwprd = $row_cek_tagihan->npwprd;
$nama = $row_cek_tagihan->nama;
$alamat = $row_cek_tagihan->alamat;
$kelurahan = $row_cek_tagihan->kelurahan;
$kecamatan = $row_cek_tagihan->kecamatan;
$ket = $row_cek_tagihan->ket;
$nama_kegus = $row_cek_tagihan->nama_kegus;
$tahun_pajak = $row_cek_tagihan->tahun_pajak;
$masa_pajak1 = $row_cek_tagihan->masa_pajak1;
$masa_pajak2 = $row_cek_tagihan->masa_pajak2;
$kode_billing = $row_cek_tagihan->kode_billing;
$wp_wr_id = $row_cek_tagihan->wp_wr_id;
$pokok_pajak = (int) round($row_cek_tagihan->pajak) - (int) $row_cek_tagihan->kompensasi;
$masa_lapor = date('Y-m-d', strtotime("+1 months", strtotime($row_cek_tagihan->masa_pajak1)));
$status_bayar = $row_cek_tagihan->status_bayar;

if ($row_cek_tagihan == null) { // apabila data tidak ditemukan
    $response = [
        'status' => 'Gagal',
        'data' => 'Data Tagihan Tidak Ditemukan'
    ];
} else if ($status_bayar == '1') { // apabila data tagihan sudah lunas
    $response = [
        'status' => 'Gagal',
        'data' => 'Data Tagihan Telah Lunas'
    ];
} else {

    if ($row_cek_tagihan->nama_kegus == 'Jasa Boga / Katering dan Sejenisnya') { //apabila jenis kegiatan usaha jasa boga
        if (date('m', strtotime($masa_lapor)) == '02') {
            $jatuh_tempo = date('Y-m-28', strtotime($masa_lapor));
        } else {
            $jatuh_tempo = date('Y-m-30', strtotime($masa_lapor));
        }
        $get_denda = 0;
        $sanksi_lapor = 0;
        $total_bayar = $pokok_pajak + $get_denda + $sanksi_lapor;
    } else {

        if (date('m', strtotime($masa_lapor)) == '02') {
            $jatuh_tempo = date('Y-m-28', strtotime($masa_lapor));
        } else {
            $jatuh_tempo = date('Y-m-30', strtotime($masa_lapor));
        }
        $diff_month = get_diff_months($jatuh_tempo, date('Y-m-d'), $row['jenis_spt_id']);
        $get_denda = assess_fine($pokok_pajak, $diff_month);
        $sanksi_lapor = 0;
        $total_bayar = $pokok_pajak + $get_denda + $sanksi_lapor;
    }

    // if ($row_cek_tagihan->nama_kegus == 'Jasa Boga / Katering dan Sejenisnya') { //apabila jenis kegiatan usaha jasa boga
    //     if (date('m', strtotime($masa_lapor)) == '02') {
    //         $jatuh_tempo = date('Y-m-28', strtotime($masa_lapor));
    //     } else {
    //         $jatuh_tempo = date('Y-m-30', strtotime($masa_lapor));
    //     }
    //     $get_denda = 0;
    //     $sanksi_lapor = 0;
    //     $total_bayar = $pokok_pajak + $get_denda + $sanksi_lapor;
    // } else {

    //     if (date('Y', strtotime($row_cek_tagihan->masa_pajak1)) <= '2023' && date('m', strtotime($row_cek_tagihan->masa_pajak1)) <= '12') {
    //         if (date('m', strtotime($masa_lapor)) == '02') {
    //             $jatuh_tempo = date('Y-m-28', strtotime($masa_lapor));
    //         } else {
    //             $jatuh_tempo = date('Y-m-30', strtotime($masa_lapor));
    //         }
    //         $diff_month = get_diff_months($jatuh_tempo, date('Y-m-d'), $row['jenis_spt_id']);
    //         $get_denda = assess_fine($pokok_pajak, $diff_month);
    //         $sanksi_lapor = 0;
    //         $total_bayar = $pokok_pajak + $get_denda + $sanksi_lapor;
    //     } else {
    //         $jatuh_tempo = date('Y-m-10', strtotime($masa_lapor));
    //         $diff_month = get_diff_months($jatuh_tempo, date('Y-m-d'), $row['jenis_spt_id']);
    //         $get_denda = assess_fine_new($pokok_pajak, $diff_month);
    //         $masa_kemarin = date('Y-m-d', strtotime("-1 months", strtotime($masa_pajak1)));
    //         // cek tgl lapor pajak bulan kemarin
    //         $sql = "SELECT tgl_proses FROM payment.v_payment WHERE masa_pajak1 = '$masa_kemarin' AND wp_wr_id = '$wp_wr_id'";
    //         $query = pg_query($link, $sql);
    //         $cek_lapor_pajak = pg_fetch_array($query);

    //         $tgl_lapor_lalu = date('d', strtotime($cek_lapor_pajak['tgl_proses']));

    //         if ($tgl_lapor_lalu == null || $tgl_lapor_lalu > '15') {
    //             $sanksi_lapor = 100000;
    //         } else {
    //             $sanksi_lapor = 0;
    //         }
    //         $total_bayar = $pokok_pajak + $get_denda + $sanksi_lapor;
    //     }
    // }

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
        'sanksi_lapor' => number_format($sanksi_lapor, 0, ",", "."),
        'total_bayar' => number_format($total_bayar, 0, ",", ".")
    ];

    $response = [
        'status' => 'Sukses',
        'data_tagihan' => $data
    ];
}

echo json_encode($response);
