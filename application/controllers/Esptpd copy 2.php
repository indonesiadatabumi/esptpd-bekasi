<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Esptpd extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('fungsi');
        $this->load->model('Mod_esptpd');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $this->session->userdata('id_user');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $data['esptpd'] = $this->Mod_esptpd->_get_esptpd_menu();
            $data['menu'] = $this->Mod_esptpd->_get_table_menu();
            $this->template->load('layoutbackend', 'esptpd/esptpd_menu', $data);
        }
    }

    public function billing()
    {
        $this->template->load('layoutbackend', 'esptpd/billing_data');
    }


    public function lampiran()
    {
        $billing_id =  $this->uri->segment(3);

        $list = $this->Mod_esptpd->getAll($billing_id);


        foreach ($list as $billing) {
            $data['spt_id'] = $billing->spt_id;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['status_bayar'] = $billing->status_bayar;
            $data['lampiran'] = $billing->image;
        }

        $data['billing_id'] = $billing_id;
        // var_dump($data);
        $this->load->view('esptpd/esptpd_lampiran', $data);
    }

    public function register()
    {
        $billing_id =  $this->uri->segment(3);

        $list = $this->Mod_esptpd->getAll($billing_id);
        foreach ($list as $billing) {
            $data['spt_id'] = $billing->spt_id;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['status_bayar'] = $billing->status_bayar;
            $data['lampiran'] = $billing->image;
        }

        $list2 = $this->Mod_esptpd->getdataPayment($billing_id);
        foreach ($list2 as $wpwr) {
            $data['npwprd'] = $wpwr->npwprd;
            $data['wp_wr_nama'] = $wpwr->wp_wr_nama;
            $data['wp_wr_almt'] = $wpwr->wp_wr_almt;
        }

        $list3 = $this->Mod_esptpd->getdataPelayanan($billing_id);
        foreach ($list3 as $pelayanan) {
            $data['stat_register'] = $pelayanan->stat_register;
            $data['keterangan'] = $pelayanan->keterangan;
        }

        $data['billing_id'] = $billing_id;
        $data['act'] = ($pelayanan->spt_id) ? 'edit' : 'add';

        $this->template->load('layoutbackend', 'esptpd/esptpd_register', $data);
    }


    public function view()
    {
        $billing_id =  $this->uri->segment(3);

        $list = $this->Mod_esptpd->getAll($billing_id);
        foreach ($list as $billing) {
            $data['spt_id'] = $billing->spt_id;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['status_bayar'] = $billing->status_bayar;
            $data['lampiran'] = $billing->image;
        }

        $list2 = $this->Mod_esptpd->getdataPayment($billing_id);
        foreach ($list2 as $wpwr) {
            $data['npwprd'] = $wpwr->npwprd;
            $data['wp_wr_nama'] = $wpwr->wp_wr_nama;
            $data['wp_wr_almt'] = $wpwr->wp_wr_almt;
        }

        $list3 = $this->Mod_esptpd->getdataPelayanan($billing_id);
        foreach ($list3 as $pelayanan) {
            $data['stat_register'] = $pelayanan->stat_register;
            $data['keterangan'] = $pelayanan->keterangan;
        }

        $data['billing_id'] = $billing_id;

        $this->template->load('layoutbackend', 'esptpd/billing_view', $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);

        $wp_id = '';

        $fusername = substr($this->session->userdata('username'), 1, 2);
        if ($fusername == '2.' || $fusername == '1.') {

            $list = $this->Mod_esptpd->_get_data_wp(substr($this->session->userdata('username'), 7, 7));
            foreach ($list as $apl) {
                $wp_id = $apl->wp_wr_id;
            }
        }

        $list = $this->Mod_esptpd->get_datatables($wp_id);
        $data = array();
        $no = $_POST['start'];

        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lunas</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Lunas</span>",
            "2" => "<span class='text-secondary'> Nihil</span>"
        );

        foreach ($list as $bliing) {
            $no++;
            $tgljatuhtempo = date('Y-m-d', strtotime('+1 month', strtotime($bliing->spt_periode_jual2)));
            if ($this->session->userdata('id_level') == "4") {
                $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vsubmenu(" . $bliing->spt_kode_billing . ")\"><i class=\"fas fa-eye\"></i></a>";
            } else {
                $aksi = "<a class=\"btn btn-xs btn-outline-info\" id=\"view\" href=\"javascript:void(0)\" title=\"View\" data-href=" . $bliing->spt_kode_billing . "><i class=\"fas fa-eye\"></i></a> 
                        <a class=\"btn btn-xs btn-outline-primary\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $bliing->spt_kode_billing . "><i class=\"fas fa-edit\"></i></a>";
            }

            $list3 = $this->Mod_esptpd->getdataPelayanan($bliing->spt_kode_billing);
            foreach ($list3 as $pelayanan) {
                $stat_register  = $pelayanan->stat_register;
            }

            $row = array();
            $row[] = $bliing->spt_nomor;
            $row[] = $bliing->spt_tgl_entry;
            $row[] = $bliing->spt_periode;
            $row[] = $bliing->spt_periode_jual1 . ' s/d ' . $bliing->spt_periode_jual2;
            // $row[] = $tgljatuhtempo;
            $row[] = number_format($bliing->spt_pajak, 0, ',', '.');
            $row[] = $bliing->spt_kode_billing;
            if ($stat_register == '1') {
                $row[] = $stat_arr[$bliing->status_bayar];
            } else {
                $row[] = $stat_arr[$bliing->status_bayar];
            }
            $row[] = $aksi;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_esptpd->count_all($wp_id),
            "recordsFiltered" => $this->Mod_esptpd->count_filtered($wp_id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add()
    {

        $kodus_id =  $this->uri->segment(3);
        $no_reg =  $this->uri->segment(4);

        // $kodus_id = $this->input->get('kodus');
        // $no_reg = $this->input->get('noreg');

        if ($kodus_id == 1) {
            $add_form =  "esptpd_hotel";
            $kd_jns = '1';
        } elseif ($kodus_id == 5 || $kodus_id == 12) {
            $add_form =  "esptpd_ppj";
            $kd_jns = '5';
        } elseif ($kodus_id == 11) {
            $add_form =  "esptpd_hiburan";
            $kd_jns = '3';
        } elseif ($kodus_id == 14) {
            $add_form =  "esptpd_parkir";
            $kd_jns = '7';
        } elseif ($kodus_id == 16) {
            $add_form =  "esptpd_resto";
            $kd_jns = '2';
        } else {
            $add_form =  "";
        }

        $list = $this->Mod_esptpd->_get_data_wp($no_reg);
        foreach ($list as $apl) {
            $data['wp_id'] = $apl->wp_wr_id;
            $data['npwprd'] = $apl->npwprd;
            $data['nama'] = $apl->nama;
            $data['alamat'] = $apl->alamat;
            $data['kelurahan'] = $apl->kelurahan;
            $data['kecamatan'] = $apl->kecamatan;
            $data['kota'] = $apl->kota;
            $data['kode_rekening'] = $apl->kode_rekening;
            $data['kode_spt'] = $apl->kode_spt;
        }
        $data['kd_jns_pajak'] = $kd_jns;
        $kode_spt = $this->kode_spt($apl->kode_spt, $kd_jns);
        $data['no_register'] = $kode_spt;
        $list_spt = $this->Mod_esptpd->_get_data_SPPT($apl->wp_wr_id);
        foreach ($list_spt as $spt_list) {
            $masa_awal = $list_spt->spt_periode_jual1;
            $masa_akhir = $list_spt->spt_periode_jual2;
        }

        if (date("m", strtotime($masa_awal)) == '12') {
            $bulan_ke = '1';
            $periode_thn = date('Y');
        } else {
            $periode_thn = date("Y", strtotime($masa_awal));
            $bulan_ke    = date("m", strtotime($masa_awal)) + 1;
        }

        $hari_ini =  date($periode_thn . "-" . $bulan_ke . "-01"); //date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $data['masa_awal'] = $tgl_pertama;
        $data['masa_akhir'] = $tgl_terakhir;

        $this->template->load('layoutbackend', 'esptpd/' . $add_form, $data);
    }

    function kode_spt($kode_spt, $kd_jns)
    {
        $kode_spt = $this->Mod_esptpd->_get_reg_spt($kode_spt, $kd_jns);
        $next_spt_no_register = $this->fungsi->tambah_nol($kode_spt, 4);

        return $next_spt_no_register;
    }

    function get_tarif($korek_id)
    {
        $tarif = $this->Mod_esptpd->_get_tarif($korek_id);

        return $tarif;
    }


    public function insert()
    {
        $wp_no_registrasi  = substr($this->input->post('npwpd'), 7, 7);
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            $spt_pajak = substr($spt_pajak, 0, -3);
        }

        if ($spt_pajak < 300000)
            $sts_bayar = 2;
        else
            $sts_bayar = 0;

        $kode_billing = $spt_nomor . date("dmy") . rand(1111, 9999); //101479080320166688

        $cek = $this->Mod_esptpd->_cekSPT_nomor($spt_nomor, $this->input->post('spt_periode'), $this->input->post('spt_jenis'));
        if ($cek  > 0) {
            echo json_encode(array("error" => "Nomor SPT Sudah Ada!!. Silahkan refresh lalu klik simpan"));
        } else {
            $nama = $kode_billing;
            $config['upload_path']   = './assets/foto/lampiran/';
            $config['allowed_types'] = 'pdf'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'spt_periode' => $this->input->post('spt_periode'),
                    'spt_kode' => $this->input->post('kd_spt'),
                    'spt_no_register'  => $this->input->post('no_sptpd'),
                    'spt_nomor'  => $spt_nomor,
                    'spt_kode_rek' => $this->input->post('kd_rekening'),
                    'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                    'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                    'spt_status' => $this->input->post('spt_status'),
                    'spt_pajak' => $spt_pajak,
                    'spt_operator' => '0',
                    'spt_jenis_pajakretribusi' => $this->input->post('spt_jenis'),
                    'spt_idwpwr' => $this->input->post('wp_id'),
                    'spt_jenis_pemungutan' => '1',
                    'spt_tgl_proses' => date('Y-m-d'),
                    'spt_tgl_entry' => date('Y-m-d'),
                    'spt_idwp_reklame' => null,
                    'spt_kode_billing' => $kode_billing,
                    'status_bayar' => $sts_bayar,
                    'image' => $gambar['file_name']
                );

                $this->Mod_esptpd->inserSPT("spt", $save);

                $spt_id = $this->Mod_esptpd->_getSPT_id();

                $save  = array(
                    'spt_dt_id_spt' => $spt_id,
                    'spt_dt_korek' => $this->input->post('kode_rekening_id'),
                    'spt_dt_jumlah'  => $spt_nilai,
                    'spt_dt_tarif_dasar'  => 0,
                    'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                    'spt_dt_pajak' => $spt_pajak
                );
                $this->Mod_esptpd->inserSPT("spt_detail", $save);

                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'spt_periode' => $this->input->post('spt_periode'),
                    'spt_kode' => $this->input->post('kd_spt'),
                    'spt_no_register'  => $this->input->post('no_sptpd'),
                    'spt_nomor'  => $spt_nomor,
                    'spt_kode_rek' => $this->input->post('kd_rekening'),
                    'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                    'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                    'spt_status' => $this->input->post('spt_status'),
                    'spt_pajak' => $spt_pajak,
                    'spt_operator' => '0',
                    'spt_jenis_pajakretribusi' => $this->input->post('spt_jenis'),
                    'spt_idwpwr' => $this->input->post('wp_id'),
                    'spt_jenis_pemungutan' => '1',
                    'spt_tgl_proses' => date('Y-m-d'),
                    'spt_tgl_entry' => date('Y-m-d'),
                    'spt_idwp_reklame' => null,
                    'spt_kode_billing' => $kode_billing,
                    'status_bayar' => $sts_bayar
                );

                $this->Mod_esptpd->inserSPT("spt", $save);
                $spt_id = $this->Mod_esptpd->_getSPT_id();

                $save  = array(
                    'spt_dt_id_spt' => $spt_id,
                    'spt_dt_korek' => $this->input->post('kode_rekening_id'),
                    'spt_dt_jumlah'  => $spt_nilai,
                    'spt_dt_tarif_dasar'  => 0,
                    'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                    'spt_dt_pajak' => $spt_pajak
                );
                $this->Mod_esptpd->inserSPT("spt_detail", $save);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function register_insert()
    {
        // var_dump($this->input->post());
        $stat_regis = ($this->input->post('stat_regis') == '') ? 0 : $this->input->post('stat_regis');
        $save  = array(
            'spt_id' => $this->input->post('no_pelayanan'),
            'id_billing' => $this->input->post('id_billing'),
            'masa_awal' => $this->input->post('masa_awal'),
            'masa_akhir' => $this->input->post('masa_akhir'),
            'periode_spt' => $this->input->post('spt_periode'),
            'spt_pajak' =>  str_replace(',', '', $this->input->post('spt_pajak')),
            'keterangan' => $this->input->post('ket_register'),
            'stat_register' =>  $stat_regis,
            'tgl_pelayanan' => date('Y-m-d'),
            'id_perekam' =>    $this->session->userdata('id_user')
        );

        $this->Mod_esptpd->insertPelayanan("tbl_pelayanan", $save);
        echo json_encode(array("status" => TRUE));
    }


    public function register_save()
    {
        // var_dump($this->input->post());

        $stat_regis = ($this->input->post('stat_regis') == '') ? 0 : $this->input->post('stat_regis');
        $act =  $this->input->post('act');
        if ($act == 'edit') {

            $id_billing      = $this->input->post('id_billing');

            $save  = array(
                'keterangan' => $this->input->post('ket_register'),
                'stat_register' =>  $stat_regis,
                'tgl_pelayanan' => date('Y-m-d'),
                'id_perekam' =>    $this->session->userdata('id_user')
            );
            $this->Mod_esptpd->updatePelayanan($id_billing, $save);
            echo json_encode(array("status" => TRUE));
        } else {

            $save  = array(
                'spt_id' => $this->input->post('no_pelayanan'),
                'id_billing' => $this->input->post('id_billing'),
                'masa_awal' => $this->input->post('masa_awal'),
                'masa_akhir' => $this->input->post('masa_akhir'),
                'periode_spt' => $this->input->post('spt_periode'),
                'spt_pajak' =>  str_replace(',', '', $this->input->post('spt_pajak')),
                'keterangan' => $this->input->post('ket_register'),
                'stat_register' =>  $stat_regis,
                'tgl_pelayanan' => date('Y-m-d'),
                'id_perekam' =>    $this->session->userdata('id_user')
            );

            $this->Mod_esptpd->insertPelayanan("tbl_pelayanan", $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    // private function _validate()
    // {
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = TRUE;

    //     if ($this->input->post('is_active') == '') {
    //         $data['inputerror'][] = 'is_active';
    //         $data['error_string'][] = 'Please select Is Active';
    //         $data['status'] = FALSE;
    //     }

    //     if ($this->input->post('level') == '') {
    //         $data['inputerror'][] = 'level';
    //         $data['error_string'][] = 'Please select is level';
    //         $data['status'] = FALSE;
    //     }

    //     if ($data['status'] === FALSE) {
    //         echo json_encode($data);
    //         exit();
    //     }
    // }
}
