<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rekap_pembayaran extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_rekappembayaran'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('layoutbackend', 'rekap_pembayaran');
    }

    // public function ajax_list()
    // {
    //     ini_set('memory_limit', '512M');
    //     set_time_limit(3600);
    //     $jenis = $this->input->post('jenis');
    //     $list = $this->Mod_rekappembayaran->get_datatables();
    //     $stat_arr = array(
    //         "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Bayar</span>",
    //         "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Sudah Bayar</span>",
    //         "2" => "<span class='text-secondary'> Nihil</span>"
    //     );
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $pel) {
    //         $cek_bayar = $this->Mod_rekappembayaran->metode_bayar($pel->kode_billing);
    //         if ($cek_bayar != null) {
    //             $metode_bayar = $cek_bayar->jns_billing;
    //         }else{
    //             $metode_bayar = 'Billing';
    //         }
    //         $no++;
    //         $jml_bayar = $pel->tagihan + $pel->denda;
    //         $row = array();
    //         $row[] = $no;
    //         $row[] = $pel->npwprd;
    //         $row[] = $pel->kode_billing;
    //         $row[] = $pel->tahun_pajak;
    //         $row[] = number_format($pel->tagihan);
    //         if(isset($pel->denda)){
    //             $row[] = number_format($pel->denda);
    //         }else{
    //             $row[] = $pel->denda;
    //         }
    //         $row[] = number_format($jml_bayar);
    //         $row[] = $pel->tgl_pembayaran;
    //         $row[] = $stat_arr[$pel->status_bayar];
    //         $row[] = $metode_bayar;
    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->Mod_rekappembayaran->count_all(),
    //         "recordsFiltered" => $this->Mod_rekappembayaran->count_filtered(),
    //         "data" => $data,
    //     );
    //     //output to json format
    //     echo json_encode($output);
    // }
    public function ajax_list()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(3600);
        $jenis_pajak = $this->input->post('jenis_pajak');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $list = $this->Mod_rekappembayaran->get_datatables($jenis_pajak, $start, $end);
        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Bayar</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Sudah Bayar</span>",
            "2" => "<span class='text-secondary'> Nihil</span>"
        );
        $data = array();
        $no = 0;
        foreach ($list as $pel) {
            // $cek_bayar = $this->Mod_rekappembayaran->metode_bayar($pel->kode_billing);
            if (!empty($pel->jns_billing)) {
                $metode_bayar = $pel->jns_billing;
            }else{
                $metode_bayar = 'Billing';
            }
            $no++;
            $jml_bayar = $pel->tagihan + $pel->denda;
            $row = array();
            $row[] = $no;
            $row[] = $pel->npwprd;
            $row[] = $pel->kode_billing;
            $row[] = $pel->tahun_pajak;
            $row[] = number_format($pel->tagihan);
            if(isset($pel->denda)){
                $row[] = number_format($pel->denda);
            }else{
                $row[] = $pel->denda;
            }
            $row[] = number_format($jml_bayar);
            $row[] = $pel->ntp;
            $row[] = $pel->tgl_pembayaran;
            $row[] = $stat_arr[$pel->status_bayar];
            $row[] = $metode_bayar;
            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function cetakpenerimaan()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(3600);
        $startdate  = $this->input->get('StartDate');
        $enddate    = $this->input->get('EndDate');
        $jenis_pajak    = $this->input->get('jenis_pajak');

        $data['penerimaan'] = $this->Mod_rekappembayaran->cetakpenerimaan($startdate, $enddate, $jenis_pajak);
        $data['model'] = $this->Mod_rekappembayaran;

        $this->load->view('cetak_rekap_penerimaan', $data);
    }
}
