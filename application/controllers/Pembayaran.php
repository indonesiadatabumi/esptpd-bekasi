<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pembayaran extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_pembayaran'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('layoutbackend', 'pembayaran.php');
    }

    // public function ajax_list()
    // {
    //     ini_set('memory_limit', '512M');
    //     set_time_limit(3600);
    //     $jenis = $this->input->post('jenis');
    //     $list = $this->Mod_pembayaran->get_datatables();
    //     $stat_arr = array(
    //         "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Bayar</span>",
    //         "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Sudah Bayar</span>",
    //         "2" => "<span class='text-secondary'> Nihil</span>"
    //     );
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $pel) {
    //         $cek_bayar = $this->Mod_pembayaran->metode_bayar($pel->kode_billing);
    //         if ($cek_bayar != null) {
    //             $metode_bayar = $cek_bayar->jns_billing;
    //         }else{
    //             $metode_bayar = 'Billing';
    //         }
    //         $no++;
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
    //         $row[] = number_format($pel->sptpd_yg_dibayar);
    //         $row[] = $pel->tgl_pembayaran;
    //         $row[] = $stat_arr[$pel->status_bayar];
    //         $row[] = $metode_bayar;
    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->Mod_pembayaran->count_all(),
    //         "recordsFiltered" => $this->Mod_pembayaran->count_filtered(),
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
        $list = $this->Mod_pembayaran->get_datatables($jenis_pajak, $start, $end);
        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Bayar</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Sudah Bayar</span>",
            "2" => "<span class='text-secondary'> Nihil</span>"
        );
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            // $cek_bayar = $this->Mod_pembayaran->metode_bayar($pel->kode_billing);
            if (!empty($pel->jns_billing)) {
                $metode_bayar = $pel->jns_billing;
                $va_number = $pel->va_number;
            }else{
                $metode_bayar = 'Billing';
                 $va_number = '';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pel->npwprd;
            $row[] = $pel->kode_billing;
            $row[] = $va_number;
            $row[] = $pel->tahun_pajak;
            $row[] = number_format($pel->tagihan);
            if(isset($pel->denda)){
                $row[] = number_format($pel->denda);
            }else{
                $row[] = $pel->denda;
            }
            $row[] = number_format($pel->sptpd_yg_dibayar);
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

    public function insert()
    {
        $this->_validate();
        $kode = date('ymsi');
        $save  = array(
            'kdbarang'      => $kode,
            'nama'            => $this->input->post('nama'),
            'harga'          => $this->input->post('harga'),
            'satuan'           => $this->input->post('satuan')
        );
        $this->Mod_pembayaran->insert_barang("barang", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'status_bayar' => '1'
        );
        $this->Mod_pembayaran->update_bayar($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function pembatalan()
    {
        $id      = $this->input->post('id');

        $save  = array(
            'status_bayar' => '0'
        );
        $this->Mod_pembayaran->update_statpayment($id, $save);

        $save2  = array(
            'status_reversal' => '1',
            'tgl_reversal' => 'NOW()'

        );
        $this->Mod_pembayaran->update_detpayment($id, $save2);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_bayar($id)
    {
        $data = $this->Mod_pembayaran->get_bayar($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_pembayaran->delete_brg($id, 'barang');
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Barang Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('harga') == '') {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('satuan') == '') {
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'Satuan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
