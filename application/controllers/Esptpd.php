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
        $data['tes_menu'] = substr($this->session->userdata('username'), 4, -14);
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $data['esptpd'] = $this->Mod_esptpd->_get_esptpd_menu();
            $data['menu'] = $this->Mod_esptpd->_get_table_menu();
            $data['Mod_esptpd'] = $this->Mod_esptpd;
            $this->template->load('layoutbackend', 'esptpd/esptpd_menu', $data);
        }
    }

    public function billing()
    {

        error_reporting(~E_NOTICE);

        $kodus =   $this->uri->segment(3);
        $wp_id =   $this->uri->segment(4);

        $jns_pajak = substr($this->session->userdata('username'), 5, 1);
        if ($kodus == '') {

            if ($jns_pajak == 1) {
                $kodus = '1';
            } elseif ($jns_pajak == 5) {
                $kodus = '5';
            } elseif ($jns_pajak == 3) {
                $kodus = '11';
            } elseif ($jns_pajak == 7) {
                $kodus = '14';
            } elseif ($jns_pajak == 2) {
                $kodus = '16';
            }
        } else {
            $kodus = $kodus;
        }

        $kb = $this->session->userdata('kriteriabayar');
        // if ($kb == 2) {
        //     $noreg = $wp_id;
        //     $list = $this->Mod_esptpd->_get_id_npwp($noreg);
        //     foreach ($list as $apl) {
        //         $wp_id = $apl->wp_wr_id;
        //         $npwprd = $apl->npwprd;
        //     }
        // } else {
        //     $wp_id = $this->session->userdata('id_wp_wr');
        //     // $npwprd = $_SESSION['npwpd'];
        // }
        $noreg = $wp_id;
        $list = $this->Mod_esptpd->_get_id_npwp($noreg);
        foreach ($list as $apl) {
            $wp_id = $apl->wp_wr_id;
            $npwprd = $apl->npwprd;
            $wp_wr_nama = $apl->wp_wr_nama;
        }


        // if ($wp_id == '') {

        //     $fusername = substr($this->session->userdata('username'), 1, 2);
        //     if ($fusername == '.2' || $fusername == '.1') {

        //         $list = $this->Mod_esptpd->_get_data_wp(substr($this->session->userdata('username'), 7, 7));
        //         foreach ($list as $apl) {
        //             $wp_id = $apl->wp_wr_id;
        //         }
        //     }
        // }

        if ($kb == 1) {
            $noreg =  $this->session->userdata('no_urut');
        } else {
            $noreg = $noreg;
        }

        $espt = $this->Mod_esptpd->_get_esptpd_menu_group($noreg);
        foreach ($espt as $apl2) {
            $data['bil_npwpd'] = $apl2->npwprd;
            $data['bil_nama'] = $apl2->wp_wr_nama;
        }

        $data['kodus'] = $kodus;
        $data['noreg'] = $wp_id;
        $data['npwprd'] = $npwprd;
        $data['wp_wr_nama'] = $wp_wr_nama;
        $this->template->load('layoutbackend', 'esptpd/billing_data', $data);
    }

    public function billing_new()
    {

        error_reporting(~E_NOTICE);

        $kodus =   $this->uri->segment(3);
        $wp_id =   $this->uri->segment(4);

        $jns_pajak = substr($this->session->userdata('username'), 5, 1);
        if ($kodus == '') {

            if ($jns_pajak == 1) {
                $kodus = '1';
            } elseif ($jns_pajak == 5) {
                $kodus = '5';
            } elseif ($jns_pajak == 3) {
                $kodus = '11';
            } elseif ($jns_pajak == 7) {
                $kodus = '14';
            } elseif ($jns_pajak == 2) {
                $kodus = '16';
            }
        } else {
            $kodus = $kodus;
        }

        $kb = $this->session->userdata('kriteriabayar');
        // if ($kb == 2) {
        //     $noreg = $wp_id;
        //     $list = $this->Mod_esptpd->_get_id_npwp($noreg);
        //     foreach ($list as $apl) {
        //         $wp_id = $apl->wp_wr_id;
        //         $npwprd = $apl->npwprd;
        //     }
        // } else {
        //     $wp_id = $this->session->userdata('id_wp_wr');
        //     // $npwprd = $_SESSION['npwpd'];
        // }
        $noreg = $wp_id;
        $list = $this->Mod_esptpd->_get_id_npwp($noreg);
        foreach ($list as $apl) {
            $wp_id = $apl->wp_wr_id;
            $npwprd = $apl->npwprd;
            $wp_wr_nama = $apl->wp_wr_nama;
        }


        // if ($wp_id == '') {

        //     $fusername = substr($this->session->userdata('username'), 1, 2);
        //     if ($fusername == '.2' || $fusername == '.1') {

        //         $list = $this->Mod_esptpd->_get_data_wp(substr($this->session->userdata('username'), 7, 7));
        //         foreach ($list as $apl) {
        //             $wp_id = $apl->wp_wr_id;
        //         }
        //     }
        // }

        if ($kb == 1) {
            $noreg =  $this->session->userdata('no_urut');
        } else {
            $noreg = $noreg;
        }

        $espt = $this->Mod_esptpd->_get_esptpd_menu_group($noreg);
        foreach ($espt as $apl2) {
            $data['bil_npwpd'] = $apl2->npwprd;
            $data['bil_nama'] = $apl2->wp_wr_nama;
        }

        $data['kodus'] = $kodus;
        $data['noreg'] = $wp_id;
        $data['npwprd'] = $npwprd;
        $data['wp_wr_nama'] = $wp_wr_nama;
        $this->template->load('layoutbackend', 'esptpd/billing_data_new', $data);
    }

    public function print_billing_group()
    {
        // $wp_id = '';
        // $kodus = '';
        // $kodus =   $this->uri->segment(3);
        // $wp_id =   $this->uri->segment(4);

        $this->template->load('layoutbackend', 'esptpd/print_billing_group');
    }

    public function tambah_data_group()
    {
        $this->template->load('layoutbackend', 'esptpd/tambah_data_group');
    }

    public function get_nama_wp()
    {
        // $userid = $this->session->userdata('id_user');
        $kodepajak = $this->input->post('kodepajak');
        $jenispajak = $this->input->post('jenispajak');
        $golongan = $this->input->post('gol');
        $noreg = $this->input->post('noreg');
        $kdcamat = $this->input->post('kdcamat');
        $kdlurah = $this->input->post('kdlurah');

        $npwprd = $kodepajak . "." . $golongan . "." . $jenispajak . "." . $noreg . "." . $kdcamat . "." . $kdlurah;

        $nama = $this->Mod_esptpd->get_nama_wp($npwprd);

        echo json_encode(array("nama" => $nama));
    }

    public function save_data_group()
    {
        $npwpd = $this->input->post('npwpd');
        $userid = $this->input->post('userid');
        $noreg = $this->input->post('noreg');

        $arr_noreg = $this->Mod_esptpd->_get_id_npwp($noreg);
        foreach ($arr_noreg as $list) {
            $wp_wr_id = $list->wp_wr_id;
        }

        $save  = array(
            'groupid' => $userid,
            'npwpd' => $npwpd,
            'id_wpwr'  => $wp_wr_id
        );

        $this->Mod_esptpd->inserSPT("data_group", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function billing_hapus()
    {

        $idbilling = $this->input->post('idbilling');

        $where = array('spt_kode_billing' => $idbilling);
        $spt_id = $this->Mod_esptpd->get_sptID($where, 'spt');

        $where2 = array('spt_id' => $spt_id);
        $this->Mod_esptpd->hapus_billing($where2, 'spt');

        $where3 = array('spt_dt_id_spt' => $spt_id);
        $this->Mod_esptpd->hapus_billing($where3, 'spt_detail');

        $msg = [
            'sukses' => 'Billing berhasil dihapus'
        ];
        echo json_encode($msg);
    }

    public function delete_menu()
    {
        $no_id = $this->input->post('noid');

        $where = array('noid' => $no_id);
        $this->Mod_esptpd->hapus_billing($where, 'data_group');

        $msg = [
            'sukses' => 'Menu berhasil dihapus'
        ];
        echo json_encode($msg);
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

        if ($list3) {
            foreach ($list3 as $pelayanan) {
                $data['stat_register'] = $pelayanan->stat_register;
                $data['keterangan'] = $pelayanan->keterangan;
                $data['act'] = ($pelayanan->spt_id) ? 'edit' : 'add';
            }
        } else {
            $data['stat_register'] = '';
            $data['keterangan'] = '';
            $data['act'] = 'add';
        }

        $data['billing_id'] = $billing_id;

        $this->template->load('layoutbackend', 'esptpd/esptpd_register', $data);
    }

    public function lihat_lampiran()
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

        if ($list3) {
            foreach ($list3 as $pelayanan) {
                $data['stat_register'] = $pelayanan->stat_register;
                $data['keterangan'] = $pelayanan->keterangan;
                $data['act'] = ($pelayanan->spt_id) ? 'edit' : 'add';
            }
        } else {
            $data['stat_register'] = '';
            $data['keterangan'] = '';
            $data['act'] = 'add';
        }

        $data['lampiran'] = $billing_id . ".pdf";

        $data['billing_id'] = $billing_id;

        $this->template->load('layoutbackend', 'esptpd/esptpd_lihat_lampiran', $data);
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

    public function espt_print()
    {
        $spt_id =  $this->uri->segment(3);
        $jenispajak  =  $this->uri->segment(4);

        if ($jenispajak == '1') {
            $espt_prt = "esptpd_hotel_prt";
        } elseif ($jenispajak == '2') {
            $espt_prt = "esptpd_resto_prt";
        } elseif ($jenispajak == '3') {
            $espt_prt = "esptpd_hiburan_prt";
        } elseif ($jenispajak == '5') {
            $espt_prt = "esptpd_ppj_prt";
        } elseif ($jenispajak == '7' || $jenispajak == '14') {
            $espt_prt = "esptpd_parkir_prt";
        }

        $list = $this->Mod_esptpd->getPrint($spt_id);
        $data['list'] = $list;
        foreach ($list as $billing) {
            $data['spt_nomor'] = $billing->spt_nomor;
            $data['spt_tahun_pajak'] = $billing->tahunpajak;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['spt_dt_jumlah'] += $billing->spt_dt_jumlah;
            $data['spt_korek_persen_tarif'] = $billing->korek_persen_tarif;
            $data['spt_korek_nama'] = $billing->korek_nama;
            // $spt_korek_nama = $billing->korek_nama;
            $data['spt_nama'] = $billing->wp_wr_nama;
            $data['billing_id'] = $billing->spt_kode_billing;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['status_bayar'] = $billing->status_bayar;
        }

        $list_npwp = $this->Mod_esptpd->getWPWRD($billing->spt_idwpwr);
        foreach ($list_npwp as $npwprow) {
            $npwpd = $npwprow->npwprd;
        }
        $data_npwpd = explode(".", $npwpd);
        $data['spt_golongan'] = $data_npwpd[1];
        $data['spt_jenispajak'] = $data_npwpd[2];
        $data['spt_noreg'] = $data_npwpd[3];
        $data['spt_camat'] = $data_npwpd[4];
        $data['spt_lurah'] = $data_npwpd[5];

        $masa_pajak = date('Y-m-d', strtotime('+1 month', strtotime($billing->spt_periode_jual1)));
        $explode = explode('-', $billing->spt_periode_jual1);

        if ($explode[0] <= '2023' && $explode[1] <= '12') { // jatuh tempo bayar
            $tgljatuhtempo = date("Y-m-30", strtotime($masa_pajak));
            $sanksi_lapor = 0;
        } else {
            $tgljatuhtempo = date("Y-m-11", strtotime($masa_pajak)); // jatuh tempo bayar

            if (date('d') > '15' && $billing->status_bayar == 0) {
                $sanksi_lapor = 100000;
            } else {
                $pajak_lalu = date('Y-m-d', strtotime('-1 month', strtotime($billing->spt_periode_jual1)));
                $explode_pajak_lalu = explode('-', $pajak_lalu);

                if ($explode_pajak_lalu[0] <= '2023' && $explode_pajak_lalu[1] <= '16') {
                    $sanksi_lapor = 0;
                } else {
                    $cek_lapor_pajak = $this->Mod_esptpd->cek_lapor_pajak($pajak_lalu, $billing->spt_idwpwr);
                    // $tgl_lapor_lalu = date('d', strtotime($cek_lapor_pajak->tgl_lapor));
                    if ($cek_lapor_pajak == null || date('d', strtotime($cek_lapor_pajak->tgl_lapor)) > '15') {
                        $sanksi_lapor = 100000;
                    } else {
                        $sanksi_lapor = 0;
                    }
                }
            }
            // $tgljatuhtempo = date("Y-m-12", strtotime($masa_pajak));
            // $cek_lapor_pajak = $this->Mod_esptpd->cek_lapor_pajak($billing->spt_periode_jual1, $billing->spt_idwpwr);

            // if ($cek_lapor_pajak->tgl_lapor == null || date('d', strtotime($cek_lapor_pajak->tgl_lapor)) > '15') {
            //     $sanksi_lapor = 100000;
            // }else{
            //     $sanksi_lapor = 0;
            // }
        }

        if ($billing->status_bayar == 0) {
            $jml_denda = $this->fungsi->denda($t_entry, date("Y-m-d"), $billing->spt_pajak);
        } else {
            // $tgl_setor = '';
            // $list_denda = $this->Mod_esptpd->getDenda($billing->spt_idwpwr, $billing->spt_periode, $billing->spt_nomor);
            // foreach ($list_denda as $list_denda) {
            //     $tgl_setor = $list_denda->setorpajret_tgl_bayar;
            // }
            // $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $billing->spt_pajak);
            $get_denda = $this->Mod_esptpd->getDendaLunas($billing->spt_kode_billing, $billing->spt_periode);

            if ($get_denda[0]->denda == null) {
                $jml_denda = 0;
            } else {
                $jml_denda = $get_denda[0]->denda;
            }
        }

        $bln = date("n", strtotime($billing->spt_periode_jual1));

        if ($billing->spt_pajak < 10) {
            $pajakdibayar = 0;
            $nihil = "[NIHIL]";
        } else {
            $pajakdibayar = $billing->spt_pajak;
            $nihil = "";
        }

        // if ($billing->status_bayar == 0){
        //     $denda = $jml_denda;
        // }else{
        //     $denda = 0;
        // }

        $data['jml_denda'] = $jml_denda;
        $data['pajakdibayar'] = $pajakdibayar;
        $data['nihil'] = $nihil;
        $data['bln_masapajak'] = $this->fungsi->bulan($bln);

        // var_dump($data);
        // die();
        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_resto_prt', $data);

        $html = $this->load->view('esptpd/' . $espt_prt, $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function espt_print_prt()
    {
        $billing_id =  $this->uri->segment(3);

        $list_bil = $this->Mod_esptpd->getAll($billing_id);
        foreach ($list_bil as $billing2) {
            $data['spt_id'] = $billing2->spt_id;
        }

        $list = $this->Mod_esptpd->getPrint($billing2->spt_id);
        foreach ($list as $billing) {
            $data['spt_nomor'] = $billing->spt_nomor;
            $data['spt_tahun_pajak'] = $billing->tahunpajak;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['spt_dt_jumlah'] = $billing->spt_dt_jumlah;
            $data['spt_korek_persen_tarif'] = $billing->korek_persen_tarif;
            $data['spt_korek_nama'] = $billing->korek_nama;
            $data['spt_nama'] = $billing->wp_wr_nama;
            $data['billing_id'] = $billing->spt_kode_billing;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['status_bayar'] = $billing->status_bayar;
        }

        $list_npwp = $this->Mod_esptpd->getWPWRD($billing->spt_idwpwr);
        foreach ($list_npwp as $npwprow) {
            $npwpd = $npwprow->npwprd;
        }
        $data_npwpd = explode(".", $npwpd);
        $data['spt_golongan'] = $data_npwpd[1];
        $data['spt_jenispajak'] = $data_npwpd[2];
        $jenispajak = $data_npwpd[2];
        $data['spt_noreg'] = $data_npwpd[3];
        $data['spt_camat'] = $data_npwpd[4];
        $data['spt_lurah'] = $data_npwpd[5];

        $tgljatuhtempo = date('Y-m-d', strtotime('+2 month', strtotime($billing->spt_periode_jual1)));
        if ($billing->status_bayar == 0) {
            $jml_denda = $this->fungsi->denda($tgljatuhtempo, date("Y-m-d"), $billing->spt_pajak);
        } else {
            $tgl_setor = '';
            $list_denda = $this->Mod_esptpd->getDenda($billing->spt_idwpwr, $billing->spt_periode, $billing->spt_nomor);
            foreach ($list_denda as $list_denda) {
                $tgl_setor = $billing->setorpajret_tgl_bayar;
            }

            $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $billing->spt_pajak);
        }

        $bln = date("n", strtotime($billing->spt_periode_jual1));

        if ($billing->spt_pajak < 10) {
            $pajakdibayar = 0;
            $nihil = "[NIHIL]";
        } else {
            $pajakdibayar = $billing->spt_pajak;
            $nihil = "";
        }
        $data['jml_denda'] = $jml_denda;
        $data['pajakdibayar'] = $pajakdibayar;
        $data['nihil'] = $nihil;
        $data['bln_masapajak'] = $this->fungsi->bulan($bln);

        if ($jenispajak == '1') {
            $espt_prt = "esptpd_hotel_prt";
        } elseif ($jenispajak == '2') {
            $espt_prt = "esptpd_resto_prt";
        } elseif ($jenispajak == '3') {
            $espt_prt = "esptpd_hiburan_prt";
        } elseif ($jenispajak == '5') {
            $espt_prt = "esptpd_ppj_prt";
        } elseif ($jenispajak == '7' || $jenispajak == '14') {
            $espt_prt = "esptpd_parkir_prt";
        }

        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_resto_prt', $data);

        $html = $this->load->view('esptpd/' . $espt_prt, $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function espt_billing()
    {
        $spt_id =  $this->uri->segment(3);
        $jenispajak  =  $this->uri->segment(4);

        $list = $this->Mod_esptpd->getPrint($spt_id);
        foreach ($list as $billing) {
            $data['spt_nomor'] = $billing->spt_nomor;
            $data['spt_tahun_pajak'] = $billing->tahunpajak;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['spt_dt_jumlah'] = $billing->spt_dt_jumlah;
            $data['spt_korek_persen_tarif'] = $billing->korek_persen_tarif;
            $data['spt_korek_nama'] = $billing->korek_nama;
            $data['spt_nama'] = $billing->wp_wr_nama;
            $data['billing_id'] = $billing->spt_kode_billing;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['status_bayar'] = $billing->status_bayar;
            // $data['spt_golongan'] = $billing->wp_wr_gol;
            // $data['spt_jenispajak'] = $billing->wp_wr_gol;
            // $data['spt_noreg'] = $billing->wp_wr_no_urut;
            // $data['spt_camat'] = $billing->wp_wr_kd_camat;
            // $data['spt_lurah'] = $billing->wp_wr_kd_lurah;
        }

        $list_npwp = $this->Mod_esptpd->getWPWRD($billing->spt_idwpwr);
        foreach ($list_npwp as $npwprow) {
            $npwpd = $npwprow->npwprd;
        }
        $data_npwpd = explode(".", $npwpd);
        $data['npwpd'] = $npwpd;
        $data['spt_golongan'] = $data_npwpd[1];
        $data['spt_jenispajak'] = $data_npwpd[2];
        $data['spt_noreg'] = $data_npwpd[3];
        $data['spt_camat'] = $data_npwpd[4];
        $data['spt_lurah'] = $data_npwpd[5];

        $tgljatuhtempo = date('Y-m-d', strtotime('+2 month', strtotime($billing->spt_periode_jual1)));
        if ($billing->status_bayar == 0) {
            $jml_denda = $this->fungsi->denda($tgljatuhtempo, date("Y-m-d"), $billing->spt_pajak);
        } else {
            // $tgl_setor = '';
            // $list_denda = $this->Mod_esptpd->getDenda($billing->spt_idwpwr, $billing->spt_periode, $billing->spt_nomor);
            // foreach ($list_denda as $list_denda) {
            //     $tgl_setor = $billing->setorpajret_tgl_bayar;
            // }

            // $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $billing->spt_pajak);
            $jml_denda = 0;
        }

        $bln = date("n", strtotime($billing->spt_periode_jual1));

        if ($billing->spt_pajak < 10) {
            $pajakdibayar = 0;
            $nihil = "[NIHIL]";
        } else {
            $pajakdibayar = $billing->spt_pajak;
            $nihil = "";
        }
        $data['jml_denda'] = $jml_denda;
        $data['pajakdibayar'] = $pajakdibayar;
        $data['nihil'] = $nihil;
        $data['bln_masapajak'] = $this->fungsi->bulan($bln);

        if ($jenispajak == '1') {
            $pajak = "Hotel";
        } elseif ($jenispajak == '2') {
            $pajak = "Restoran";
        } elseif ($jenispajak == '3') {
            $pajak = "Hiburan";
        } elseif ($jenispajak == '5') {
            $pajak = "PPJ / Genset";
        } elseif ($jenispajak == '7') {
            $pajak = "Parkir";
        }

        $data['pajak'] = $pajak;


        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_resto_prt', $data);

        $html = $this->load->view('esptpd/esptpd_billing_prt', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function espt_billing_new()
    {
        $spt_id =  $this->uri->segment(3);
        $jenispajak  =  $this->uri->segment(4);

        $list = $this->Mod_esptpd->getPrintNew($spt_id);
        foreach ($list as $billing) {
            $data['spt_nomor'] = $billing->spt_nomor;
            $data['spt_tahun_pajak'] = $billing->tahunpajak;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            // $data['spt_dt_jumlah'] = $billing->spt_dt_jumlah;
            // $data['spt_korek_persen_tarif'] = $billing->korek_persen_tarif;
            // $data['spt_korek_nama'] = $billing->korek_nama;
            $data['spt_nama'] = $billing->wp_wr_nama;
            $data['billing_id'] = $billing->spt_kode_billing;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['status_bayar'] = $billing->status_bayar;
            // $data['spt_golongan'] = $billing->wp_wr_gol;
            // $data['spt_jenispajak'] = $billing->wp_wr_gol;
            // $data['spt_noreg'] = $billing->wp_wr_no_urut;
            // $data['spt_camat'] = $billing->wp_wr_kd_camat;
            // $data['spt_lurah'] = $billing->wp_wr_kd_lurah;
        }

        $list_npwp = $this->Mod_esptpd->getWPWRD($billing->spt_idwpwr);
        foreach ($list_npwp as $npwprow) {
            $npwpd = $npwprow->npwprd;
        }
        $data_npwpd = explode(".", $npwpd);
        $data['npwpd'] = $npwpd;
        $data['spt_golongan'] = $data_npwpd[1];
        $data['spt_jenispajak'] = $data_npwpd[2];
        $data['spt_noreg'] = $data_npwpd[3];
        $data['spt_camat'] = $data_npwpd[4];
        $data['spt_lurah'] = $data_npwpd[5];

        $masa_pajak = date('Y-m-d', strtotime('+1 month', strtotime($billing->spt_periode_jual1)));
        $explode = explode('-', $billing->spt_periode_jual1);

        if ($explode[0] <= '2023' && $explode[1] <= '10') { // jatuh tempo bayar
            $tgljatuhtempo = date("Y-m-30", strtotime($masa_pajak));
            $sanksi_lapor = 0;
        } else {
            $tgljatuhtempo = date("Y-m-11", strtotime($masa_pajak)); // jatuh tempo bayar

            if (date('d') > '15' && $billing->status_bayar == 0) {
                $sanksi_lapor = 100000;
            } else {
                $pajak_lalu = date('Y-m-d', strtotime('-1 month', strtotime($billing->spt_periode_jual1)));
                $explode_pajak_lalu = explode('-', $pajak_lalu);

                if ($explode_pajak_lalu[0] <= '2023' && $explode_pajak_lalu[1] <= '16') {
                    $sanksi_lapor = 0;
                } else {
                    $cek_lapor_pajak = $this->Mod_esptpd->cek_lapor_pajak($pajak_lalu, $billing->spt_idwpwr);
                    // $tgl_lapor_lalu = date('d', strtotime($cek_lapor_pajak->tgl_lapor));
                    if ($cek_lapor_pajak == null || date('d', strtotime($cek_lapor_pajak->tgl_lapor)) > '15') {
                        $sanksi_lapor = 100000;
                    } else {
                        $sanksi_lapor = 0;
                    }
                }
            }
            // $tgljatuhtempo = date("Y-m-12", strtotime($masa_pajak));
            // $cek_lapor_pajak = $this->Mod_esptpd->cek_lapor_pajak($billing->spt_periode_jual1, $billing->spt_idwpwr);

            // if ($cek_lapor_pajak->tgl_lapor == null || date('d', strtotime($cek_lapor_pajak->tgl_lapor)) > '15') {
            //     $sanksi_lapor = 100000;
            // }else{
            //     $sanksi_lapor = 0;
            // }
        }

        if ($billing->status_bayar == 0) {
            $jml_denda = $this->fungsi->denda($tgljatuhtempo, date("Y-m-d"), $billing->spt_pajak);
        } else {
            // $tgl_setor = '';
            // $list_denda = $this->Mod_esptpd->getDenda($billing->spt_idwpwr, $billing->spt_periode, $billing->spt_nomor);

            // foreach ($list_denda as $list_denda) {
            //     $tgl_setor = $list_denda->setorpajret_tgl_bayar;
            // }

            // $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $billing->spt_pajak);
            $get_denda = $this->Mod_esptpd->getDendaLunas($billing->spt_kode_billing, $billing->spt_periode);

            if ($get_denda['denda'] == null) {
                $jml_denda = 0;
            } else {
                $jml_denda = $get_denda['denda'];
            }
        }

        $bln = date("n", strtotime($billing->spt_periode_jual1));

        if ($billing->spt_pajak < 10) {
            $pajakdibayar = 0;
            $nihil = "[NIHIL]";
        } else {
            // $pajakdibayar = (int) $billing->spt_pajak + $jml_denda + $sanksi_lapor;
            $pajakdibayar = (int) $billing->spt_pajak + $jml_denda;
            $nihil = "";
        }
        $data['pokok_pajak'] = $billing->spt_pajak;
        $data['sanksi_lapor'] = $sanksi_lapor;
        $data['jml_denda'] = $jml_denda;
        $data['pajakdibayar'] = $pajakdibayar;
        $data['nihil'] = $nihil;
        $data['bln_masapajak'] = $this->fungsi->bulan($bln);

        if ($jenispajak == '1') {
            $pajak = "Hotel";
        } elseif ($jenispajak == '2') {
            $pajak = "Restoran";
        } elseif ($jenispajak == '3') {
            $pajak = "Hiburan";
        } elseif ($jenispajak == '5') {
            $pajak = "PPJ / Genset";
        } elseif ($jenispajak == '7') {
            $pajak = "Parkir";
        }

        $data['pajak'] = $pajak;


        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_resto_prt', $data);

        $html = $this->load->view('esptpd/esptpd_billing_prt', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function espt_billing_prt()
    {
        $billing_id =  $this->uri->segment(3);

        $list_bil = $this->Mod_esptpd->getAll($billing_id);
        foreach ($list_bil as $billing2) {
            $data['spt_id'] = $billing2->spt_id;
        }
        $list = $this->Mod_esptpd->getPrint($billing2->spt_id);
        foreach ($list as $billing) {
            $data['spt_nomor'] = $billing->spt_nomor;
            $data['spt_tahun_pajak'] = $billing->tahunpajak;
            $data['spt_idwpwr'] = $billing->spt_idwpwr;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['spt_periode'] = $billing->spt_periode;
            $data['spt_periode_jual1'] = $billing->spt_periode_jual1;
            $data['spt_periode_jual2'] = $billing->spt_periode_jual2;
            $data['spt_pajak'] = $billing->spt_pajak;
            $data['spt_dt_jumlah'] = $billing->spt_dt_jumlah;
            $data['spt_korek_persen_tarif'] = $billing->korek_persen_tarif;
            $data['spt_korek_nama'] = $billing->korek_nama;
            $data['spt_nama'] = $billing->wp_wr_nama;
            $data['billing_id'] = $billing->spt_kode_billing;
            $data['spt_tgl_entry'] = $billing->spt_tgl_entry;
            $data['status_bayar'] = $billing->status_bayar;
        }

        $list_npwp = $this->Mod_esptpd->getWPWRD($billing->spt_idwpwr);
        foreach ($list_npwp as $npwprow) {
            $npwpd = $npwprow->npwprd;
        }
        $data_npwpd = explode(".", $npwpd);
        $data['npwpd'] = $npwpd;
        $data['spt_golongan'] = $data_npwpd[1];
        $data['spt_jenispajak'] = $data_npwpd[2];
        $jenispajak = $data_npwpd[2];
        $data['spt_noreg'] = $data_npwpd[3];
        $data['spt_camat'] = $data_npwpd[4];
        $data['spt_lurah'] = $data_npwpd[5];

        $tgljatuhtempo = date('Y-m-d', strtotime('+2 month', strtotime($billing->spt_periode_jual1)));
        if ($billing->status_bayar == 0) {
            $jml_denda = $this->fungsi->denda($tgljatuhtempo, date("Y-m-d"), $billing->spt_pajak);
        } else {
            $tgl_setor = '';
            $list_denda = $this->Mod_esptpd->getDenda($billing->spt_idwpwr, $billing->spt_periode, $billing->spt_nomor);
            foreach ($list_denda as $list_denda) {
                $tgl_setor = $billing->setorpajret_tgl_bayar;
            }

            $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $billing->spt_pajak);
        }

        $bln = date("n", strtotime($billing->spt_periode_jual1));

        if ($billing->spt_pajak < 10) {
            $pajakdibayar = 0;
            $nihil = "[NIHIL]";
        } else {
            $pajakdibayar = $billing->spt_pajak;
            $nihil = "";
        }
        $data['jml_denda'] = $jml_denda;
        $data['pajakdibayar'] = $pajakdibayar;
        $data['nihil'] = $nihil;
        $data['bln_masapajak'] = $this->fungsi->bulan($bln);

        if ($jenispajak == '1') {
            $pajak = "Hotel";
        } elseif ($jenispajak == '2') {
            $pajak = "Restoran";
        } elseif ($jenispajak == '3') {
            $pajak = "Hiburan";
        } elseif ($jenispajak == '5') {
            $pajak = "PPJ / Genset";
        } elseif ($jenispajak == '7') {
            $pajak = "Parkir";
        }

        $data['pajak'] = $pajak;


        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_resto_prt', $data);

        $html = $this->load->view('esptpd/esptpd_billing_prt', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function espt_group_prt()
    {
        // $billing_id =  $this->uri->segment(3);
        $userid = $this->session->userdata('id_user');
        $periode = $this->input->post('periode');
        $jual1 = $this->input->post('spt_periode_jual1');
        $jual2 = $this->input->post('spt_periode_jual2');
        $data['billing_induk'] = $this->Mod_esptpd->get_group_billing($periode, $jual1, $jual2, $this->session->userdata('id_user'));
        $data['billing_anak'] = $this->Mod_esptpd->get_group_billing_det($periode, $jual1, $jual2, $this->session->userdata('id_user'));

        $mpdf = new \Mpdf\Mpdf();
        // $this->template->load('layoutbackend', 'esptpd/esptpd_group_prt', $data);

        $html = $this->load->view('esptpd/esptpd_group_prt', $data, TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);

        $no_reg =  $_POST['wp_wr_no_urut'];

        $list = $this->Mod_esptpd->get_datatables();
        $data = array();
        $no = $_POST['start'];

        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lunas</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Lunas</span>",
            "2" => "<span class='text-secondary'> Nihil</span>"
        );

        foreach ($list as $biling) {
            $no++;
            $tgljatuhtempo = date('Y-m-d', strtotime('+1 month', strtotime($biling->spt_periode_jual1)));
            $b_entryuu = date("m", strtotime($tgljatuhtempo)) - 1;
            if (date("m", strtotime($biling->spt_periode_jual1)) == '01') {
                if (date("d", strtotime($biling->spt_periode_jual1)) == '01') {
                    $t_entry = date("Y-m-d", strtotime('+27 days', strtotime($tgljatuhtempo)));
                } else {
                    $t_entry = date("Y-m-30", strtotime($tgljatuhtempo));
                }
            } else {
                if (date("d", strtotime($biling->spt_periode_jual1)) == '01') {
                    $t_entry = date("Y-m-d", strtotime('+29 days', strtotime($tgljatuhtempo)));
                } else {
                    $t_entry = date("Y-m-30", strtotime($tgljatuhtempo));
                }
            }

            if ($biling->status_bayar == 0) {
                $jml_denda = $this->fungsi->denda($t_entry, date("Y-m-d"), $biling->spt_pajak);
            } else {
                $tgl_setor = '';
                $list_denda = $this->Mod_esptpd->getDenda($biling->spt_idwpwr, $biling->spt_periode, $biling->spt_nomor);
                foreach ($list_denda as $list_denda) {
                    $tgl_setor = $list_denda->setorpajret_tgl_bayar;
                }
                $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $biling->spt_pajak);
                // $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $biling->spt_pajak);
            }
            // // $tgl_entry = explode('-', $data['spt_tgl_entry']);
            // // $tgl_entry = $tgl_entry[2] . "-" . $tgl_entry[1] . "-" . $tgl_entry[0];



            $bln_pajak = date("m", strtotime($biling->spt_periode_jual1));
            $bln_kemarin = date("m", mktime(0, 0, 0, date("m") - 1));

            $thn_pajak = date("Y", strtotime($biling->spt_periode_jual1));
            //$thn_kemarin = date("Y", mktime(0, 0, 0, date("Y")-1 ));

            $t = date('Y');
            $b = date('m');
            $masa_aktiv =  $b = date('m'); //$t."-".$b;

            $masa_entri = substr($biling->spt_periode_jual1, 5, 2);
            $thn_entri = substr($biling->spt_periode_jual1, 0, 4);


            // if ($masa_entri == $bln_kemarin and $thn_entri == $t) {
            //     $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/editesptpd/' . $biling->spt_id . '/' . $biling->spt_jenis_pajakretribusi . '/' . $no_reg) . "><i class=\"fas fa-edit\"></i> Edit</a>
            //             <a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
            //             <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
            //             <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
            // } else {

            //     $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
            //             <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
            //             <!--<a class=\"btn btn-xs btn-outline-info\" id=\"view\" href=\"javascript:void(0)\" title=\"View\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-print\"> Cetak</i></a> 
            //             <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Verifikasi</i></a>
            //             <a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-trash\"> Hapus</i></a>-->
            //             <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
            // }

            if ($masa_entri == $bln_kemarin) {
                $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/editesptpd/' . $biling->spt_id . '/' . $biling->spt_jenis_pajakretribusi . '/' . $no_reg) . "><i class=\"fas fa-edit\"></i> Edit</a>
                        <a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                if ($biling->status_bayar == 0 && $biling->spt_pajak >= 10000000) {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>";
                } elseif ($biling->status_bayar == 0) {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>
                            <a class=\"load_qris\" id=\"qris\" href=\"javascript:void(0)\" title=\"QRIS\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/qris.png' style='height: 50px; width: 50px;'></a>";
                }
            } else {

                $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <!--<a class=\"btn btn-xs btn-outline-info\" id=\"view\" href=\"javascript:void(0)\" title=\"View\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-print\"> Cetak</i></a> 
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Verifikasi</i></a>
                        <a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-trash\"> Hapus</i></a>-->
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";

                if ($biling->status_bayar == 0 && $biling->spt_pajak >= 10000000) {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>";
                } elseif ($biling->status_bayar == 0) {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>
                            <a class=\"load_qris\" id=\"qris\" href=\"javascript:void(0)\" title=\"QRIS\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/qris.png' style='height: 50px; width: 50px;'></a>";
                }
            }


            // if ($this->session->userdata('id_level') == "4") {
            //     $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
            //             <a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>";
            // } else {

            //     $aksi = "<a class=\"btn btn-xs btn-outline-info\" id=\"view\" href=\"javascript:void(0)\" title=\"View\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-print\"> Cetak</i></a> 
            //             <a class=\"btn btn-xs btn-outline-primary\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-edit\"> Verifikasi</i></a>
            //     <a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-trash\"> Hapus</i></a>";
            // }

            $list3 = $this->Mod_esptpd->getdataPelayanan($biling->spt_kode_billing);
            foreach ($list3 as $pelayanan) {
                $stat_register  = $pelayanan->stat_register;
            }

            if ($biling->status_bayar == 0) {
                $denda = $jml_denda;
                $total_bayar = $biling->spt_pajak + $jml_denda;
            } else {
                $denda = 0;
                $total_bayar = $biling->spt_pajak;
            }

            $row = array();
            $row[] = $biling->spt_nomor;
            $row[] = $biling->spt_tgl_entry;
            $row[] = $biling->spt_periode;
            $row[] = $biling->spt_periode_jual1 . ' s/d ' . $biling->spt_periode_jual2;
            $row[] = $t_entry;
            $row[] = number_format($biling->spt_pajak, 0, ',', '.');
            // $row[] = number_format($jml_denda, 0, ',', '.');
            $row[] = number_format($denda, 0, ',', '.');
            $row[] = number_format($total_bayar, 0, ',', '.');
            $row[] = $biling->spt_kode_billing;
            $row[] = $stat_arr[$biling->status_bayar];
            $row[] = $aksi;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_esptpd->count_all(),
            "recordsFiltered" => $this->Mod_esptpd->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_new()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);

        $no_reg =  $_POST['wp_wr_no_urut'];

        $list = $this->Mod_esptpd->get_datatables();
        $data = array();
        $no = $_POST['start'];

        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lunas</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Lunas</span>",
            "2" => "<span class='text-secondary'> Nihil</span>"
        );

        foreach ($list as $biling) {
            $no++;
            $tgljatuhtempo = date('Y-m-d', strtotime('+1 month', strtotime($biling->spt_periode_jual1)));
            $b_entryuu = date("m", strtotime($tgljatuhtempo)) - 1;
            $explode = explode('-', $biling->spt_periode_jual1);
            if ($explode[0] <= '2023' && $explode[1] <= '10' || $biling->spt_periode_jual1 < '2024-01-01') {
                $t_entry = date("Y-m-30", strtotime($tgljatuhtempo));
                $sanksi_lapor = 0;
            } else {
                $t_entry = date("Y-m-11", strtotime($tgljatuhtempo)); //jatuh tempo bayar

                if (date('d') > '15' && $biling->status_bayar == 0) { //jatuh tempo lapor
                    $sanksi_lapor = 100000;
                } else {
                    $pajak_lalu = date('Y-m-d', strtotime('-1 month', strtotime($biling->spt_periode_jual1)));
                    $explode_pajak_lalu = explode('-', $pajak_lalu);

                    if ($explode_pajak_lalu[0] <= '2023' && $explode_pajak_lalu[1] <= '10') { //jatuh tempo bayar
                        $sanksi_lapor = 0;
                    } else {
                        $cek_lapor_pajak = $this->Mod_esptpd->cek_lapor_pajak($pajak_lalu, $biling->spt_idwpwr);
                        if ($cek_lapor_pajak == null || date('d', strtotime($cek_lapor_pajak->tgl_lapor)) > '15') { //jatuh tempo lapor
                            $sanksi_lapor = 0;
                        } else {
                            $sanksi_lapor = 0;
                        }
                    }
                }
            }


            if ($biling->status_bayar == 0) {
                if ($biling->spt_periode_jual1 < '2024-01-01') {
                    $jml_denda = 0;
                } else {
                    $jml_denda = $this->fungsi->denda($t_entry, date("Y-m-d"), $biling->spt_pajak);
                }
            } else {
                $tgl_setor = '';
                $list_denda = $this->Mod_esptpd->getDenda($biling->spt_idwpwr, $biling->spt_periode, $biling->spt_nomor);
                foreach ($list_denda as $list_denda) {
                    $tgl_setor = $list_denda->setorpajret_tgl_bayar;
                }
                $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $biling->spt_pajak);
                // $jml_denda = $this->fungsi->denda($tgljatuhtempo, $tgl_setor, $biling->spt_pajak);
            }
            // // $tgl_entry = explode('-', $data['spt_tgl_entry']);
            // // $tgl_entry = $tgl_entry[2] . "-" . $tgl_entry[1] . "-" . $tgl_entry[0];



            $bln_pajak = date("m", strtotime($biling->spt_periode_jual1));
            $bln_kemarin = date("m", mktime(0, 0, 0, date("m") - 1));

            $thn_pajak = date("Y", strtotime($biling->spt_periode_jual1));
            //$thn_kemarin = date("Y", mktime(0, 0, 0, date("Y")-1 ));

            $t = date('Y');
            $b = date('m');
            $masa_aktiv =  $b = date('m'); //$t."-".$b;

            $masa_entri = substr($biling->spt_periode_jual1, 5, 2);
            $thn_entri = substr($biling->spt_periode_jual1, 0, 4);
            $explode_entry = explode('-', $biling->spt_tgl_entry);

            if ($biling->status_bayar == 0) {
                $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/edit_billing/' . $biling->spt_id . '/' . $biling->spt_jenis_pajakretribusi . '/' . $no_reg) . "><i class=\"fas fa-edit\"></i> Edit</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>";
                if ($biling->spt_pajak >= 10000000) {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>";
                } else {
                    $aksi .= "<a class=\"load_va\" id=\"va\" href=\"javascript:void(0)\" title=\"VA\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/virtualaccount.png' style='height: 50px; width: 50px;'></a>
                            <a class=\"load_qris\" id=\"qris\" href=\"javascript:void(0)\" title=\"QRIS\" data-href=" . $biling->spt_kode_billing . "><img src='" . base_url() . "/assets/foto/logo/qris.png' style='height: 50px; width: 50px;'></a>";
                }
            } else {
                if ($biling->tgl_lapor == null) {
                    if ($explode[0] <= '2023' && $explode[1] <= '16') {
                        if ($explode_entry[0] >= '2024') {
                            $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/lapor_pajak/' . $biling->spt_id . '/' . $biling->spt_jenis_pajakretribusi . '/' . $biling->spt_kode_billing) . "><i class=\"fas fa-edit\"></i> Lapor Pajak</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                        } else {
                            $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                        }
                    } else {
                        $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/lapor_pajak/' . $biling->spt_id . '/' . $biling->spt_jenis_pajakretribusi . '/' . $biling->spt_kode_billing) . "><i class=\"fas fa-edit\"></i> Lapor Pajak</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                    }
                } else {
                    // $aksi = "<a class=\"btn btn-xs btn-outline-primary\" href=" . base_url('esptpd/edit_laporan/' . $biling->spt_kode_billing) ."><i class=\"fas fa-edit\"></i> Edit Laporan</a>
                    //     <a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
                    //     <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                    //     <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                    $aksi = "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" id=\"esptpd\" title=\"esptpd\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Esptpd</a>
                        <a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" id=\"billing\" title=\"billing\" data-href=" . $biling->spt_id . "/" . $biling->spt_jenis_pajakretribusi . "><i class=\"fas fa-print\"></i> Billing</a>
                        <a class=\"btn btn-xs btn-outline-warning\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $biling->spt_kode_billing . "><i class=\"fas fa-link\"> Lampiran</i></a>";
                }
            }

            $list3 = $this->Mod_esptpd->getdataPelayanan($biling->spt_kode_billing);
            foreach ($list3 as $pelayanan) {
                $stat_register  = $pelayanan->stat_register;
            }

            if ($biling->status_bayar == 0) {
                $denda = $jml_denda;
                $total_bayar = $biling->spt_pajak + $jml_denda + $sanksi_lapor;
            } else {
                $denda = 0;
                $total_bayar = $biling->spt_pajak;
            }

            if ($biling->tgl_lapor == null) {
                if ($explode[0] <= '2023' && $explode[1] <= '16') {
                    if ($explode_entry[0] >= '2024') {
                        $status_lapor = "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lapor</span>";
                        $tgl_lapor = '-';
                    } else {
                        $status_lapor = "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'>Sudah Lapor</span>";
                        $tgl_lapor = '-';
                    }
                } else {
                    $status_lapor = "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lapor</span>";
                    $tgl_lapor = '-';
                }
            } else {
                $status_lapor = "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'>Sudah Lapor</span>";
                $tgl_lapor = $biling->tgl_lapor;
            }

            $row = array();
            $row[] = $biling->spt_nomor;
            $row[] = $biling->spt_tgl_entry;
            $row[] = $biling->spt_periode;
            $row[] = $biling->spt_periode_jual1 . ' s/d ' . $biling->spt_periode_jual2;
            $row[] = $t_entry;
            $row[] = number_format($biling->spt_pajak, 0, ',', '.');
            // $row[] = number_format($jml_denda, 0, ',', '.');
            $row[] = number_format($denda, 0, ',', '.');
            $row[] = number_format($sanksi_lapor, 0, ',', '.');
            $row[] = number_format($total_bayar, 0, ',', '.');
            $row[] = $biling->spt_kode_billing;
            $row[] = $stat_arr[$biling->status_bayar];
            $row[] = $status_lapor;
            $row[] = $tgl_lapor;
            $row[] = $aksi;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_esptpd->count_all(),
            "recordsFiltered" => $this->Mod_esptpd->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add()
    {
        error_reporting(~E_NOTICE);
        $kodus_id =  $this->uri->segment(3);
        $no_reg =  $this->uri->segment(4);

        if ($kodus_id == 1) {
            $add_form =  "esptpd_hotel";
            $kd_jns = '1';
            $list_rekening = $this->Mod_esptpd->_get_rekening('4', '1', '1', '01');
            $data['list_rekening'] = $list_rekening;
        } elseif ($kodus_id == 5 || $kodus_id == 12) {
            $add_form =  "esptpd_ppj";
            $kd_jns = '5';
            $data['v_rekening'] = $this->Mod_esptpd->get_v_rekening_ppj('41105');
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
        $apl = '';
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

        $kode_spt = $this->kode_spt($apl->kode_spt, $kd_jns);
        $data['kd_jns_pajak'] = $kd_jns;
        $data['no_register'] = $kode_spt;
        $list_spt = $this->Mod_esptpd->_get_data_SPPT($apl->wp_wr_id);
        $masa_awal = $list_spt->spt_periode_jual1;
        $masa_akhir = $list_spt->spt_periode_jual2;
        // var_dump($masa_awal);die;
        if (date("m", strtotime($masa_awal)) == '12') {
            $bulan_ke = '1';
            $periode_thn = date('Y');
        } elseif ($masa_awal  == NULL) {
            $periode_thn = date("Y");
            $masa_awal = date('Y-m-d');
            $bulan_ke    = date("m", strtotime($masa_awal)) - 1;
            // var_dump(date($periode_thn . "-" . $bulan_ke . "-01"));
        } else {
            $periode_thn = date("Y", strtotime($masa_awal));
            $bulan_ke    = date("m", strtotime($masa_awal)) + 1;
        }

        $hari_ini =  date($periode_thn . "-" . $bulan_ke . "-01"); //date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $data['masa_awal'] = $tgl_pertama;
        $data['masa_akhir'] = $tgl_terakhir;
        $data['periode_thn'] = $periode_thn;

        $this->template->load('layoutbackend', 'esptpd/' . $add_form, $data);
        // $this->template->load('layoutbackend', 'esptpd/generate_billing', $data);
    }

    function daftar_billing()
    {
        error_reporting(~E_NOTICE);
        $kodus_id =  $this->uri->segment(3);
        $no_reg =  $this->uri->segment(4);

        if ($kodus_id == 1) {
            $kd_jns = '1';
            $kd_rekening = '2';
            $nama_pajak = 'Pajak Hotel';
        } elseif ($kodus_id == 5) {
            $kd_jns = '5';
            $kd_rekening = '25';
            $nama_pajak = 'Pajak Reklame';
        } elseif ($kodus_id == 11) {
            $kd_jns = '3';
            $kd_rekening = '16';
            $nama_pajak = 'Pajak Hiburan';
        } elseif ($kodus_id == 14) {
            $kd_jns = '7';
            $kd_rekening = '36';
            $nama_pajak = 'Pajak Parkir';
        } elseif ($kodus_id == 16) {
            $kd_jns = '2';
            $kd_rekening = '8';
            $nama_pajak = 'Pajak Restoran';
        }

        $list = $this->Mod_esptpd->data_wp($no_reg);
        $data['wp_id'] = $list->wp_wr_id;
        $data['npwprd'] = $list->npwprd;
        $data['nama'] = $list->nama;
        $data['alamat'] = $list->alamat;
        $data['kelurahan'] = $list->kelurahan;
        $data['kecamatan'] = $list->kecamatan;
        $data['kota'] = $list->kota;
        $data['kode_rekening'] = $list->kode_rekening;
        $data['kode_spt'] = $list->kode_spt;

        $kode_spt = $this->kode_spt($list->kode_spt, $kd_jns);
        $data['kd_jns_pajak'] = $kd_jns;
        $data['kd_rekening'] = $kd_rekening;
        $data['nama_pajak'] = $nama_pajak;
        $data['no_register'] = $kode_spt;
        $list_spt = $this->Mod_esptpd->_get_data_SPPT($list->wp_wr_id);
        $masa_awal = $list_spt->spt_periode_jual1;
        $masa_akhir = $list_spt->spt_periode_jual2;

        if (date("m", strtotime($masa_awal)) == '16') {
            $bulan_ke = '1';
            $periode_thn = date('Y');
        } elseif ($masa_awal  == NULL) {
            $periode_thn = date("Y");
            $masa_awal = date('Y-m-d');
            $bulan_ke    = date("m", strtotime($masa_awal)) - 1;
            // var_dump(date($periode_thn . "-" . $bulan_ke . "-01"));
        } else {
            $periode_thn = date("Y", strtotime($masa_awal));
            $bulan_ke    = date("m", strtotime($masa_awal)) + 1;
        }

        $hari_ini =  date($periode_thn . "-" . $bulan_ke . "-01"); //date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $data['masa_awal'] = $tgl_pertama;
        $data['masa_akhir'] = $tgl_terakhir;
        $data['periode_thn'] = $periode_thn;

        // $this->template->load('layoutbackend', 'esptpd/' . $add_form, $data);
        $this->template->load('layoutbackend', 'esptpd/generate_billing', $data);
    }

    function editesptpd()
    {
        // error_reporting(~E_NOTICE);
        $spt_id =  $this->uri->segment(3);
        $jns_pajak =  $this->uri->segment(4);
        $no_reg =  $this->uri->segment(5);

        if ($jns_pajak == 1) {
            $add_form =  "esptpd_hotel_ed";
            $list_rekening = $this->Mod_esptpd->_get_rekening('4', '1', '1', '06');
            $data['list_rekening'] = $list_rekening;
        } elseif ($jns_pajak == 5) {
            $add_form =  "esptpd_ppj_ed";
        } elseif ($jns_pajak == 3) {
            $add_form =  "esptpd_hiburan_ed";
        } elseif ($jns_pajak == 7) {
            $add_form =  "esptpd_parkir_ed";
        } elseif ($jns_pajak == 2) {
            $add_form =  "esptpd_resto_ed";
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


        if ($jns_pajak == '3' || $jns_pajak == '7') {
            $list_spt = $this->Mod_esptpd->get_edit_esptpd_det($jns_pajak, $spt_id);
            $data['espt_detil'] = $this->Mod_esptpd->get_esptpd_detil($spt_id);
            if ($jns_pajak == '3') {
                $kode_rek = '41103';
            } elseif ($jns_pajak == '7') {
                $kode_rek = '41107';
            }
            $data['v_rekening'] = $this->Mod_esptpd->get_v_rekening($kode_rek);
        } elseif ($jns_pajak == '5') {
            $list_spt = $this->Mod_esptpd->get_edit_esptpd_det($jns_pajak, $spt_id);
            $kode_rek = '41105';
            $data['spt_dt_korek'] = $list_spt->spt_dt_korek;
            $data['spt_dt_persen_tarif'] = $list_spt->spt_dt_persen_tarif;
            $data['v_rekening'] = $this->Mod_esptpd->get_v_rekening_ppj($kode_rek);
        } else {
            $list_spt = $this->Mod_esptpd->get_edit_esptpd($spt_id);
            $data['spt_dt_korek'] = $list_spt->korek_id;
            $data['spt_dt_persen_tarif'] = $list_spt->korek_persen_tarif;
        }
        $data['kd_jns_pajak'] = $jns_pajak;

        $masa_awal = $list_spt->spt_periode_jual1;
        $masa_akhir = $list_spt->spt_periode_jual2;
        $periode_thn = date("Y", strtotime($masa_awal));

        // $data['no_register'] = $list_spt->spt_nomor;
        $data['no_register'] = substr($list_spt->spt_nomor, -5);

        $data['masa_awal'] = $masa_awal;
        $data['masa_akhir'] = $masa_akhir;
        $data['periode_thn'] = $periode_thn;

        $jenis_pemungutan = $list_spt->spt_jenis_pemungutan;
        $data['spt_tgl_entry'] = $list_spt->spt_tgl_entry;
        $data['spt_tgl_proses'] = $list_spt->spt_tgl_proses;
        $data['periode'] = $list_spt->spt_periode;
        $data['dasar_pengenaan'] = $list_spt->spt_dt_jumlah;
        $data['kode_billing'] = $list_spt->spt_kode_billing;
        $data['spt_pajak'] = $list_spt->spt_pajak;
        $data['spt_dt_id'] = $list_spt->spt_dt_id;
        $data['spt_id'] = $spt_id;

        $this->template->load('layoutbackend', 'esptpd/' . $add_form, $data);
    }

    function edit_billing()
    {
        // error_reporting(~E_NOTICE);
        $spt_id =  $this->uri->segment(3);
        $no_reg =  $this->uri->segment(5);

        $list = $this->Mod_esptpd->data_wp($no_reg);
        $data['wp_id'] = $list->wp_wr_id;
        $data['npwprd'] = $list->npwprd;
        $data['nama'] = $list->nama;
        $data['alamat'] = $list->alamat;
        $data['kelurahan'] = $list->kelurahan;
        $data['kecamatan'] = $list->kecamatan;
        $data['kota'] = $list->kota;
        $data['kode_rekening'] = $list->kode_rekening;
        $data['kode_spt'] = $list->kode_spt;

        $list_spt = $this->Mod_esptpd->data_spt($spt_id);

        $data['spt_periode'] = $list_spt->spt_periode;
        $data['spt_periode_jual1'] = $list_spt->spt_periode_jual1;
        $data['spt_periode_jual2'] = $list_spt->spt_periode_jual2;
        $data['spt_dt_jumlah'] = $list_spt->spt_dt_jumlah;
        $data['spt_dt_persen_tarif'] = $list_spt->spt_dt_persen_tarif;
        $data['spt_pajak'] = $list_spt->spt_pajak;
        $data['spt_id'] = $spt_id;

        $this->template->load('layoutbackend', 'esptpd/edit_billing', $data);
    }

    function lapor_pajak()
    {
        $spt_id =  $this->uri->segment(3);
        $jenis_pajak =  $this->uri->segment(4);
        $kode_billing =  $this->uri->segment(5);

        switch ($jenis_pajak) {
            case '1':
                $form_lapor = 'lapor_pajak_hotel';
                $list_rekening = $this->Mod_esptpd->_get_rekening('4', '1', '1', '01');
                $data['list_rekening'] = $list_rekening;
                break;

            case '2':
                $form_lapor = 'lapor_pajak_resto';
                break;

            case '3':
                $form_lapor = 'lapor_pajak_hiburan';
                break;

            case '6':
                $form_lapor = 'lapor_pajak_ppj';
                $data['v_rekening'] = $this->Mod_esptpd->get_v_rekening_ppj('41105');
                break;

            case '7':
                $form_lapor = 'lapor_pajak_parkir';
                break;
        }
        $data['spt_id'] = $spt_id;
        $data['jenis_pajak'] = $jenis_pajak;
        $data['kode_billing'] = $kode_billing;

        $this->template->load('layoutbackend', 'esptpd/' . $form_lapor, $data);
    }

    function kode_spt($kode_spt, $kd_jns)
    {
        $kode_spt = $this->Mod_esptpd->_get_reg_spt($kode_spt, $kd_jns);
        $next_spt_no_register = $this->fungsi->tambah_nol($kode_spt, 4);

        return $next_spt_no_register;
    }

    function next_spt_no_register()
    {
        $spt_periode  = $this->input->post('periode');
        $kd_jns       = $this->input->post('pajret');
        $kode_spt     = $this->input->post('spt_kode');

        $kode_spt = $this->Mod_esptpd->next_spt_no_register($spt_periode, $kode_spt, $kd_jns);
        $next_spt_no_register = $this->fungsi->tambah_nol($kode_spt, 4);

        echo json_encode(array("nomor" => $next_spt_no_register));
    }

    function get_tarif()
    {
        $korek_id  = $this->input->post('rek_id');
        $tarif = $this->Mod_esptpd->_get_tarif($korek_id);

        echo json_encode(array("nilai" => $tarif));
    }

    function get_korek()
    {
        $korek_id  = $this->input->get('korek');
        $kode_rek = $this->Mod_esptpd->_get_korek($korek_id);
        echo json_encode($kode_rek);
    }

    public function generate_billing()
    {
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

        if ($spt_pajak == 0)
            $sts_bayar = 2;
        else
            $sts_bayar = 0;

        $kode_billing = $spt_nomor . date("dmy") . rand(1111, 9999); //101479080320166688

        $cek = $this->Mod_esptpd->_cekSPT_nomor($spt_nomor, $this->input->post('spt_periode'), $this->input->post('spt_jenis'));
        $cek_masa_pajak = $this->Mod_esptpd->cek_masa_pajak($this->input->post('spt_periode_jual1'), $this->input->post('spt_periode_jual2'), $this->input->post('wp_id'));
        if ($cek > 0) {
            echo json_encode(array(
                "error" => True,
                "msg" => "Nomor SPT Sudah Ada!!. Silahkan refresh SPTPD lalu klik simpan"
            ));
        } elseif ($cek_masa_pajak > 0) {
            if ($this->input->post('spt_jenis') == '2') {
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
                $insert_spt =  $this->Mod_esptpd->inserSPT("spt", $save);
                echo json_encode(array("status" => TRUE));
            } else {
                echo json_encode(array(
                    "error" => True,
                    "msg" => "Masa pajak tersebut sudah dilaporkan"
                ));
            }
        } else {
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
            $insert_spt =  $this->Mod_esptpd->inserSPT("spt", $save);

            echo json_encode(array("status" => TRUE));
        }
    }

    public function insert()
    {
        // $this->_validate();

        $wp_no_registrasi  = substr($this->input->post('npwpd'), 7, 7);
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        } else if ($spt_nilai == '0') {
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

        if ($spt_pajak == 0)
            $sts_bayar = 2;
        else
            $sts_bayar = 0;

        $kode_billing = $spt_nomor . date("dmy") . rand(1111, 9999); //101479080320166688

        $cek = $this->Mod_esptpd->_cekSPT_nomor($spt_nomor, $this->input->post('spt_periode'), $this->input->post('spt_jenis'));
        $cek_masa_pajak = $this->Mod_esptpd->cek_masa_pajak($this->input->post('spt_periode_jual1'), $this->input->post('spt_periode_jual2'), $this->input->post('wp_id'));
        if ($cek  > 0) {
            echo json_encode(array(
                "error" => True,
                "msg" => "Nomor SPT Sudah Ada!!. Silahkan refresh SPTPD lalu klik simpan"
            ));
        } else if ($cek_masa_pajak > 0) {
            if ($this->input->post('spt_jenis') == '2' && $this->input->post('nama_rekening') == '10') {

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

                $insert_spt =  $this->Mod_esptpd->inserSPT("spt", $save);

                if ($insert_spt > 0) {
                    $spt_id = $this->Mod_esptpd->_getSPT_id();

                    if ($this->input->post('spt_jenis') == '2') {
                        $save  = array(
                            'spt_dt_id_spt' => $spt_id,
                            'spt_dt_korek' => $this->input->post('nama_rekening'),
                            'spt_dt_jumlah'  => $spt_nilai,
                            'spt_dt_tarif_dasar'  => 0,
                            'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                            'spt_dt_pajak' => $spt_pajak
                        );
                    } else {
                        $save  = array(
                            'spt_dt_id_spt' => $spt_id,
                            'spt_dt_korek' => $this->input->post('kode_rekening_id'),
                            'spt_dt_jumlah'  => $spt_nilai,
                            'spt_dt_tarif_dasar'  => 0,
                            'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                            'spt_dt_pajak' => $spt_pajak
                        );
                    }
                    $this->Mod_esptpd->inserSPT("spt_detail", $save);

                    echo json_encode(array("status" => TRUE));
                } else
                    echo json_encode(array(
                        "error" => True,
                        "msg" => "Pelaporan gagal disimpan!!"
                    ));
            } else {
                echo json_encode(array(
                    "error" => True,
                    "msg" => "Masa pajak tersebut sudah dilaporkan"
                ));
            }
        } else {
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

            $insert_spt =  $this->Mod_esptpd->inserSPT("spt", $save);

            if ($insert_spt > 0) {
                $spt_id = $this->Mod_esptpd->_getSPT_id();

                if ($this->input->post('spt_jenis') == '2') {
                    $save  = array(
                        'spt_dt_id_spt' => $spt_id,
                        'spt_dt_korek' => $this->input->post('nama_rekening'),
                        'spt_dt_jumlah'  => $spt_nilai,
                        'spt_dt_tarif_dasar'  => 0,
                        'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                        'spt_dt_pajak' => $spt_pajak
                    );
                } else {
                    $save  = array(
                        'spt_dt_id_spt' => $spt_id,
                        'spt_dt_korek' => $this->input->post('kode_rekening_id'),
                        'spt_dt_jumlah'  => $spt_nilai,
                        'spt_dt_tarif_dasar'  => 0,
                        'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                        'spt_dt_pajak' => $spt_pajak
                    );
                }
                $this->Mod_esptpd->inserSPT("spt_detail", $save);

                echo json_encode(array("status" => TRUE));
            } else
                echo json_encode(array(
                    "error" => True,
                    "msg" => "Pelaporan gagal disimpan!!"
                ));
        }
    }

    public function insert_lapor()
    {
        $spt_id = $this->input->post('spt_id');
        $jenis_pajak = $this->input->post('jenis_pajak');
        $kode_billing = $this->input->post('kode_billing');
        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

        $nama = $kode_billing;
        $config['upload_path']   = './assets/foto/lampiran/';
        $config['allowed_types'] = 'pdf'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')) { //jika upload lampiran
            $gambar = $this->upload->data();

            $save = array(
                'image' => $gambar['file_name'],
                'tgl_lapor' => date('Y-m-d')
            );

            $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);

            // if ($jenis_pajak == '2'){
            //     $save  = array(
            //         'spt_dt_id_spt' => $spt_id,
            //         'spt_dt_korek' => $this->input->post('nama_rekening'),
            //         'spt_dt_jumlah'  => $spt_nilai,
            //         'spt_dt_tarif_dasar'  => 0,
            //         'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
            //         'spt_dt_pajak' => $spt_pajak
            //     );
            // }else{
            //     $save  = array(
            //         'spt_dt_id_spt' => $spt_id,
            //         'spt_dt_korek' => $this->input->post('kode_rekening_id'),
            //         'spt_dt_jumlah'  => $spt_nilai,
            //         'spt_dt_tarif_dasar'  => 0,
            //         'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
            //         'spt_dt_pajak' => $spt_pajak
            //     );
            // }
            // $this->Mod_esptpd->inserSPT("spt_detail", $save);

            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("error" => TRUE));
        }
    }

    public function update_lapor()
    {
        $kode_billing = $this->input->post('kode_billing');
        $file_lama = './assets/foto/lampiran/' . $kode_billing . '.pdf'; // Path file PDF yang ingin dihapus

        if (file_exists($file_lama)) {
            if (unlink($file_lama)) {
                $nama = $kode_billing;
                $config['upload_path']   = './assets/foto/lampiran/';
                $config['allowed_types'] = 'pdf'; //mencegah upload backdor
                $config['max_size']      = '1000';
                $config['max_width']     = '2000';
                $config['max_height']    = '1024';
                $config['file_name']     = $nama;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) { //jika upload lampiran
                    // $file_lama = './assets/foto/lampiran/'.$kode_billing.'.pdf'; // Path file PDF yang ingin dihapus
                    // unlink($file_lama); //hapus file lama
                    $gambar = $this->upload->data();

                    echo json_encode(array("status" => TRUE));
                } else {
                    echo json_encode(array("error" => TRUE));
                }
            } else {
                echo json_encode(array("error" => TRUE));
            }
        } else {
            $nama = $kode_billing;
            $config['upload_path']   = './assets/foto/lampiran/';
            $config['allowed_types'] = 'pdf'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) { //jika upload lampiran
                // $file_lama = './assets/foto/lampiran/'.$kode_billing.'.pdf'; // Path file PDF yang ingin dihapus
                // unlink($file_lama); //hapus file lama
                $gambar = $this->upload->data();

                echo json_encode(array("status" => TRUE));
            } else {
                echo json_encode(array("error" => TRUE));
            }
        }
    }

    public function insert_lapor_hp()
    {
        $spt_id = $this->input->post('spt_id');
        $jenis_pajak = $this->input->post('jenis_pajak');
        $kode_billing = $this->input->post('kode_billing');
        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

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

            $save = array(
                'image' => $gambar['file_name'],
                'tgl_lapor' => date('Y-m-d')
            );

            $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);
        } else {
            $save = array(
                'tgl_lapor' => date('Y-m-d')
            );

            $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);
        }

        foreach ($this->input->post('spt_dt_korek') as $key => $value) {

            if (!empty($value)) {
                $arr_korek = explode(",", $this->input->post('spt_dt_korek')[$key]);
                $spt_nilai = str_replace('.', '', $this->input->post('spt_dt_dasar_pengenaan')[$key]);
                // $spt_nilai = substr($spt_nilai, 0, -3);
                $spt_pajak = str_replace('.', '', $this->input->post('spt_dt_pajak')[$key]);
                // $spt_pajak = substr($spt_pajak, 0, -3);
                $spt_persen = $this->input->post('spt_dt_persen_tarif')[$key];
                $save  = array(
                    'spt_dt_id_spt' => $spt_id,
                    'spt_dt_korek' => $arr_korek[0],
                    'spt_dt_jumlah'  => $spt_nilai,
                    'spt_dt_tarif_dasar'  => 0,
                    'spt_dt_persen_tarif' => $spt_persen,
                    'spt_dt_pajak' => $spt_pajak
                );
            }
            $this->Mod_esptpd->inserSPT("spt_detail", $save);
        }

        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();

        $wp_no_registrasi  = substr($this->input->post('npwpd'), 7, 7);
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_id    = $this->input->post('spt_id');
        $spt_dt_id    = $this->input->post('spt_dt_id');
        $nama    = $this->input->post('kode_billing');

        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

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
                'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                'spt_pajak' => $spt_pajak,
                'image' => $gambar['file_name']
            );

            // $this->Mod_esptpd->updateSPT($spt_id, $save);

            // $save  = array(
            //     'spt_dt_korek' => $this->input->post('kode_rekening_id'),
            //     'spt_dt_jumlah'  => $spt_nilai,
            //     'spt_dt_tarif_dasar'  => 0,
            //     'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
            //     'spt_dt_pajak' => $spt_pajak
            // );
            // $this->Mod_esptpd->updateSPTDetil($spt_dt_id, $save);

            // echo json_encode(array("status" => TRUE));
        } else { //Apabila tidak ada gambar yang di upload

            $save  = array(
                'spt_periode' => $this->input->post('spt_periode'),
                'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                'spt_pajak' => $spt_pajak
            );

            // $this->Mod_esptpd->updateSPT($spt_id, $save);

            // $save  = array(
            //     'spt_dt_korek' => $this->input->post('kode_rekening_id'),
            //     'spt_dt_jumlah'  => $spt_nilai,
            //     'spt_dt_tarif_dasar'  => 0,
            //     'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
            //     'spt_dt_pajak' => $spt_pajak
            // );
            // $this->Mod_esptpd->updateSPTDetil($spt_dt_id, $save);
            // echo json_encode(array("status" => TRUE));
        }

        $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);

        if ($update_spt > 0) {
            $save  = array(
                'spt_dt_jumlah'  => $spt_nilai,
                'spt_dt_tarif_dasar'  => 0,
                'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
                'spt_dt_pajak' => $spt_pajak
            );

            $this->Mod_esptpd->updateSPTDetil($spt_dt_id, $save);
            echo json_encode(array("status" => TRUE));
        } else
            echo json_encode(array(
                "error" => True,
                "msg" => "Laporan  gagal diupdate!!"
            ));
    }

    public function update_billing()
    {
        $spt_id    = $this->input->post('spt_id');

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }
        $save  = array(
            'spt_periode' => $this->input->post('spt_periode'),
            'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
            'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
            'spt_pajak' => $spt_pajak,
            'spt_tgl_edit' => date('Y-m-d')
        );
        $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);

        $spt_nilai = $this->input->post('spt_nilai');
        $spt_nilai = str_replace('.', '', $spt_nilai);
        // $spt_nilai = substr($spt_nilai, 0, -3);
        $save_detail = array(
            'spt_dt_jumlah' => $spt_nilai,
            'spt_dt_pajak' => $spt_pajak
        );
        $update_spt_detail = $this->Mod_esptpd->updateSPTDetail($spt_id, $save_detail);
        echo json_encode(array("status" => TRUE));
    }


    //untuk pajak hiburan, parkir dan air
    public function insert_hp()
    {

        // var_dump($_POST);

        // $this->_validate_hp();

        $wp_no_registrasi  = substr($this->input->post('npwpd'), 7, 7);
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

        if ($spt_pajak == 0)
            $sts_bayar = 2;
        else
            $sts_bayar = 0;

        $kode_billing = $spt_nomor . date("dmy") . rand(1111, 9999); //101479080320166688

        $cek = $this->Mod_esptpd->_cekSPT_nomor($spt_nomor, $this->input->post('spt_periode'), $this->input->post('spt_jenis'));
        $cek_masa_pajak = $this->Mod_esptpd->cek_masa_pajak($this->input->post('spt_periode_jual1'), $this->input->post('spt_periode_jual2'), $this->input->post('wp_id'));
        if ($cek  > 0) {
            echo json_encode(array(
                "error" => True,
                "msg" => "Nomor SPT Sudah Ada!!. Silahkan refresh SPTPD lalu klik simpan"
            ));
        } else if ($cek_masa_pajak > 0) {
            echo json_encode(array(
                "error" => True,
                "msg" => "Masa pajak tersebut sudah dilaporkan"
            ));
        } else {
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
            $insert_spt = $this->Mod_esptpd->inserSPT("spt", $save);

            // var_dump($save);
            if ($insert_spt > 0) {
                $spt_id = $this->Mod_esptpd->_getSPT_id();
                foreach ($this->input->post('spt_dt_korek') as $key => $value) {

                    if (!empty($value)) {
                        $arr_korek = explode(",", $this->input->post('spt_dt_korek')[$key]);
                        $spt_nilai = str_replace('.', '', $this->input->post('spt_dt_dasar_pengenaan')[$key]);
                        // $spt_nilai = substr($spt_nilai, 0, -3);
                        $spt_pajak = str_replace('.', '', $this->input->post('spt_dt_pajak')[$key]);
                        // $spt_pajak = substr($spt_pajak, 0, -3);
                        $spt_persen = $this->input->post('spt_dt_persen_tarif')[$key];
                        $save  = array(
                            'spt_dt_id_spt' => $spt_id,
                            'spt_dt_korek' => $arr_korek[0],
                            'spt_dt_jumlah'  => $spt_nilai,
                            'spt_dt_tarif_dasar'  => 0,
                            'spt_dt_persen_tarif' => $spt_persen,
                            'spt_dt_pajak' => $spt_pajak
                        );
                    }
                    $this->Mod_esptpd->inserSPT("spt_detail", $save);
                }
                echo json_encode(array("status" => TRUE));
            } else
                echo json_encode(array(
                    "error" => True,
                    "msg" => "Detail gagal diupdate!!"
                ));
        }
    }

    // untuk pajak hiburan, parkir dan air
    public function update_hp()
    {
        $this->_validate_hp();

        $wp_no_registrasi  = substr($this->input->post('npwpd'), 7, 7);
        $spt_nomor = $this->input->post('kd_spt') . "" . $this->input->post('no_sptpd');
        $spt_nomor = (int) $spt_nomor;

        $spt_id    = $this->input->post('spt_id');
        $nama    = $this->input->post('kode_billing');

        $spt_nilai = $this->input->post('spt_nilai');
        if ($spt_nilai != '') {
            $spt_nilai = str_replace('.', '', $spt_nilai);
            // $spt_nilai = substr($spt_nilai, 0, -3);
        }

        $spt_pajak = $this->input->post('spt_pajak');
        if ($spt_pajak != '') {
            $spt_pajak = str_replace('.', '', $spt_pajak);
            // $spt_pajak = substr($spt_pajak, 0, -3);
        }

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
                'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                'spt_pajak' => $spt_pajak,
                'image' => $gambar['file_name']
            );
        } else { //Apabila tidak ada gambar yang di upload

            $save  = array(
                'spt_periode' => $this->input->post('spt_periode'),
                'spt_periode_jual1' => $this->input->post('spt_periode_jual1'),
                'spt_periode_jual2' => $this->input->post('spt_periode_jual2'),
                'spt_pajak' => $spt_pajak
            );
        }

        $update_spt = $this->Mod_esptpd->updateSPT($spt_id, $save);

        if ($update_spt > 0) {
            // $save  = array(
            //     'spt_dt_jumlah'  => $spt_nilai,
            //     'spt_dt_tarif_dasar'  => 0,
            //     'spt_dt_persen_tarif' => $this->input->post('korek_persen_tarif'),
            //     'spt_dt_pajak' => $spt_pajak
            // );

            // $this->Mod_esptpd->updateSPTDetil($spt_dt_id, $save);
            // echo json_encode(array("status" => TRUE));
            foreach ($this->input->post('spt_dt_korek') as $key => $value) {


                if (!empty($value)) {
                    $arr_korek = explode(",", $this->input->post('spt_dt_korek')[$key]);
                    $spt_nilai = str_replace('.', '', $this->input->post('spt_dt_dasar_pengenaan')[$key]);
                    // $spt_nilai = substr($spt_nilai, 0, -3);
                    $spt_pajak = str_replace('.', '', $this->input->post('spt_dt_pajak')[$key]);
                    // $spt_pajak = substr($spt_pajak, 0, -3);
                    $spt_persen = $this->input->post('spt_dt_persen_tarif')[$key];
                    $save  = array(
                        'spt_dt_jumlah'  => $spt_nilai,
                        'spt_dt_tarif_dasar'  => 0,
                        'spt_dt_persen_tarif' => $spt_persen,
                        'spt_dt_pajak' => $spt_pajak
                    );
                    $save2  = array(
                        'spt_dt_id_spt' => $spt_id,
                        'spt_dt_korek' => $arr_korek[0],
                        'spt_dt_jumlah'  => $spt_nilai,
                        'spt_dt_tarif_dasar'  => 0,
                        'spt_dt_persen_tarif' => $spt_persen,
                        'spt_dt_pajak' => $spt_pajak
                    );
                }
                if (isset($this->input->post('spt_dt_id')[$key])) {
                    $spt_dt_id    = $this->input->post('spt_dt_id')[$key];
                    $this->Mod_esptpd->updateSPTDetil($spt_dt_id, $save);
                } else {
                    $this->Mod_esptpd->inserSPT("spt_detail", $save2);
                }
            }
            echo json_encode(array("status" => TRUE));
        } else
            echo json_encode(array(
                "error" => True,
                "msg" => "Laporan  gagal diupdate!!"
            ));
    }

    public function delete_detail()
    {
        $id_detail = $this->input->post('id_detail');
        $delete_detail = $this->Mod_esptpd->delete_spt_detail($id_detail);
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
        // var_dump($this->input->post());die;

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

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        // if ($this->input->post('spt_nilai') == '' || $this->input->post('spt_nilai') <= 0) {
        //     $data['inputerror'][] = 'spt_nilai';
        //     $data['error_string'][] = 'Dasar Pengenaan Tidak boleh Null!';
        //     $data['status'] = FALSE;
        // }

        if ($this->input->post('spt_pajak') == '') {
            $data['inputerror'][] = 'spt_pajak';
            $data['error_string'][] = 'Dasar Pengenaan harus diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama_rekening') == '') {
            $data['inputerror'][] = 'nama_rekening';
            $data['error_string'][] = 'Pilih Golongan!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('korek_persen_tarif') == '') {
            $data['inputerror'][] = 'korek_persen_tarif';
            $data['error_string'][] = 'Golongan untuk Pengisian Tarif';
            $data['status'] = FALSE;
        }



        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_hp()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('spt_pajak') == '') {
            $data['inputerror'][] = 'spt_pajak';
            $data['error_string'][] = 'Dasar Pengenaan harus diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function saveQRCode()
    {
        $spt_id = $this->input->post('spt_id');
        $qr_id = $this->input->post('qr_id');
        $qr_code = $this->input->post('qr_code');

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $qr_id . '.png'; //buat name dari qr code sesuai dengan nim

        // $spt_nama . ']-[' . $bln_masapajak . '_' . $spt_tahun_pajak

        $params['data'] = $qr_id; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->Mod_esptpd->insertQRCode($spt_id, $qr_id, $qr_code, $image_name); //simpan ke database
        // redirect('mahasiswa'); //redirect ke mahasiswa usai simpan data
    }

    public function register_hapus()
    {
        $kode_billing = $this->input->post('kode_billing');
        $cek_verifikasi = $this->Mod_esptpd->cek_verifikasi($kode_billing); //cek kode billing udah pernah diverifikasi
        if ($cek_verifikasi == null) {
            $response = [
                'status' => 'false',
                'message' => 'Data belum pernah diverifikasi sebelumnya'
            ];
        } else {
            $hapus_verifikasi = $this->Mod_esptpd->hapus_verifikasi($kode_billing); //hapus kode billing udah pernah diverifikasi
            $response = [
                'status' => 'true',
                'message' => 'Verifikasi berhasil dibatalkan'
            ];
        }

        echo json_encode($response);
    }

    function generate_va()
    {
        $kode_billing = $_POST['idbilling'];
        $data = [
            'idbilling' => $kode_billing
        ];
        $get_va = $this->getVA($data);
        if ($get_va->status == 'Create VA Sukses') {
            $response = [
                'status' => 'Create VA Sukses',
                'kode_billing' => $kode_billing,
                'va_number' => $get_va->va_number
            ];
        } else {
            $response = [
                'status' => 'Create VA Gagal',
                'kode_billing' => $kode_billing,
                'va_number' => ''
            ];
        }
        echo json_encode($response);
    }

    function getVA($data)
    {
        $url = 'http://192.168.1.20/api_va/request_billing';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: multipart/form-data",
            "Access-Control-Allow-Methods: POST",
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);
        return json_decode($resp);
    }
}
