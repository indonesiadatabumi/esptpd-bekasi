<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Penerimaan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_penerimaan'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('layoutbackend', 'penerimaan.php');
    }

    public function dashboard()
    {
        $this->load->helper('url');
        $pajret =  $this->uri->segment(3);
        $kd_rekening = 4110 . $pajret;
        if ($this->session->userdata('id_level') == 17){
            $tot_penerimaan_harian = $this->Mod_penerimaan->tot_penerimaan_harian_uptd($kd_rekening, $this->session->userdata('wilayah_uptd'));
        }else{
            $tot_penerimaan_harian = $this->Mod_penerimaan->tot_penerimaan_harian($kd_rekening);
        }

        if ($pajret == 1) {
            $data['add_form'] = "penerimaan_hotel";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 2) {
            $data['add_form'] = "penerimaan_restoran";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 3) {
            $data['add_form'] = "penerimaan_hiburan";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 4) {
            $data['add_form'] = "penerimaan_reklame";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 6) {
            $data['add_form'] = "penerimaan_pln";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 7) {
            $data['add_form'] = "penerimaan_parkir";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } elseif ($pajret == 8) {
            $data['add_form'] = "penerimaan_abt";
            $data['tot_penerimaan_harian'] = $tot_penerimaan_harian;
        } else {
            $add_form =  "";
        }

        $this->template->load('layoutbackend', $data['add_form'], $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $jenis = $this->input->post('jenis');
        if ($this->session->userdata('id_level') == 17){
            $list = $this->Mod_penerimaan->get_datatables_uptd($jenis, $this->session->userdata('wilayah_uptd'));
            $count_all = $this->Mod_penerimaan->count_all_uptd($jenis, $this->session->userdata('wilayah_uptd'));
            $count_filter = $this->Mod_penerimaan->count_filtered_uptd($jenis, $this->session->userdata('wilayah_uptd'));
        }else{
            $list = $this->Mod_penerimaan->get_datatables($jenis);
            $count_all = $this->Mod_penerimaan->count_all($jenis);
            $count_filter = $this->Mod_penerimaan->count_filtered($jenis);
        }
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pel->npwprd;
            $row[] = $pel->kode_billing;
            $row[] = $pel->tahun_pajak;
            $row[] = number_format($pel->tagihan, 0, ',', '.');
            $row[] = number_format($pel->denda, 0, ',', '.');
            $row[] = number_format($pel->sptpd_yg_dibayar, 0, ',', '.');;
            $row[] = $pel->tgl_pembayaran;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count_all,
            "recordsFiltered" => $count_filter,
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
        $this->Mod_penerimaan->insert_barang("barang", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'status_bayar' => '1'
        );
        $this->Mod_penerimaan->update_bayar($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_bayar($id)
    {
        $data = $this->Mod_penerimaan->get_bayar($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_penerimaan->delete_brg($id, 'barang');
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

    public function cetakpenerimaanharian()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(3600);
        $jenis_pajak    = $this->input->get('jenis_pajak');

        $data['penerimaanharian'] = $this->Mod_penerimaan->cetakpenerimaanharian($jenis_pajak);

        $this->load->view('cetak_rekap_penerimaan_harian', $data);
    }
}
