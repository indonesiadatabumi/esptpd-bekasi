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
            'title' => 'Report Pembayaran | Retribusi Pasar',
            'menu' => 'report'
        ];
        return view('report', $data);
    }

    public function hasil_rekap()
    {
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $id_user = $this->request->getVar('id_user');
        $filter = [
            'start' => $start,
            'end' => $end,
            'id_user' => $id_user,
        ];
        $data = $this->get->getHasilRekap($filter);
        echo json_encode($data);
    }
}