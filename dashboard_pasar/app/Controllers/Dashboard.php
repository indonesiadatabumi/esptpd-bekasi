<?php

namespace App\Controllers;

use App\Models\getModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
    }

    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Dashboard | Retribusi Pasar',
            'menu' => 'dashboard'
        ];
        return view('dashboard', $data);
    }

    public function get_total_transaksi() {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $total_bayar = $this->get->getTotalBayar($tgl_awal, $tgl_akhir);
        $jumlah_bayar = $this->get->getJumlahBayar($tgl_awal, $tgl_akhir);
        $harapan_jaya = $this->get->getTotalBayarTiapPasar('2', $tgl_awal, $tgl_akhir);
        $bintara_kota = $this->get->getTotalBayarTiapPasar('3', $tgl_awal, $tgl_akhir);
        $wisma_asri = $this->get->getTotalBayarTiapPasar('4', $tgl_awal, $tgl_akhir);
        $wisma_jaya = $this->get->getTotalBayarTiapPasar('5', $tgl_awal, $tgl_akhir);
        
        $data = [
            'total_bayar' => $total_bayar->total_bayar,
            'jumlah_bayar' => $jumlah_bayar->jumlah_bayar,
            'harapan_jaya' => $harapan_jaya->total_bayar,
            'bintara_kota' => $bintara_kota->total_bayar,
            'wisma_asri' => $wisma_asri->total_bayar,
            'wisma_jaya' => $wisma_jaya->total_bayar
        ];

        echo json_encode($data);
    }

    function detail_pasar($id_user, $tgl_awal, $tgl_akhir){
        $detail_bayar = $this->get->getDataBayarTiapPasar($id_user, $tgl_awal, $tgl_akhir);
        $data = [
            'title' => 'Detail Pasar | Retribusi Pasar',
            'menu' => 'dashboard',
            'detail_bayar' => $detail_bayar
        ];
        return view('detail_bayar_pasar', $data);
    }
}