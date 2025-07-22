<?php

namespace App\Controllers;

use App\Models\getModel;

class Report extends BaseController
{
    public function __construct()
    {
        // $this->user = new Modeluser();
        $this->get = new getModel();
    }

    public function index()
    {
        // if (session()->get('logged_in') == FALSE) {
        //     return redirect()->to('/');
        // }
        $data = [
            'title' => 'Report Pembayaran | Pajak Daerah Lainnya',
            'menu' => 'report'
        ];
        return view('report', $data);
    }

    public function hasil_rekap()
    {
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $kd_rekening = $this->request->getVar('kd_rekening');
        $filter = [
            'start' => $start,
            'end' => $end,
            'kd_rekening' => $kd_rekening,
        ];
        $data = $this->get->getHasilRekap($filter);
        echo json_encode($data);
    }
}