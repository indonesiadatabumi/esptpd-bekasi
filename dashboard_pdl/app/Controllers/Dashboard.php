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
            'title' => 'Dashboard | Pajak Daerah Lainnya',
            'menu' => 'dashboard'
        ];
        return view('dashboard', $data);
    }

    public function get_total_transaksi() {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $total_bayar = $this->get->getTotalBayar($tgl_awal, $tgl_akhir);
        $jumlah_bayar = $this->get->getJumlahBayar($tgl_awal, $tgl_akhir);
        $pajak_hotel = $this->get->getTotalBayarTiapPajak('41101', $tgl_awal, $tgl_akhir);
        $pajak_resto = $this->get->getTotalBayarTiapPajak('41102', $tgl_awal, $tgl_akhir);
        $pajak_hiburan = $this->get->getTotalBayarTiapPajak('41103', $tgl_awal, $tgl_akhir);
        $pajak_reklame = $this->get->getTotalBayarTiapPajak('41104', $tgl_awal, $tgl_akhir);
        $pajak_ppj = $this->get->getTotalBayarTiapPajak('41106', $tgl_awal, $tgl_akhir);
        $pajak_parkir = $this->get->getTotalBayarTiapPajak('41107', $tgl_awal, $tgl_akhir);
        $pajak_abt = $this->get->getTotalBayarTiapPajak('41108', $tgl_awal, $tgl_akhir);
        
        $data = [
            'total_bayar' => $total_bayar->total_bayar,
            'jumlah_bayar' => $jumlah_bayar->jumlah_bayar,
            'pajak_hotel' => $pajak_hotel->total_bayar,
            'pajak_resto' => $pajak_resto->total_bayar,
            'pajak_hiburan' => $pajak_hiburan->total_bayar,
            'pajak_reklame' => $pajak_reklame->total_bayar,
            'pajak_ppj' => $pajak_ppj->total_bayar,
            'pajak_parkir' => $pajak_parkir->total_bayar,
            'pajak_abt' => $pajak_abt->total_bayar
        ];

        echo json_encode($data);
    }

    function detail_pajak($kd_rekening, $tgl_awal, $tgl_akhir){
        $detail_bayar = $this->get->getDataBayarTiapPajak($kd_rekening, $tgl_awal, $tgl_akhir);
        $data = [
            'title' => 'Detail Pasar | Retribusi Pasar',
            'menu' => 'dashboard',
            'detail_bayar' => $detail_bayar
        ];
        return view('detail_bayar_pajak', $data);
    }
}