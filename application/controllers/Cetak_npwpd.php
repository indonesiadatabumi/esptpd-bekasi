<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_npwpd extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('fungsi');
        $this->load->model('Mod_cetak_npwpd');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $this->session->userdata('id_user');
        $data['tes_menu'] = substr($this->session->userdata('username'), 4, -14);
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
             $data['esptpd'] = $this->Mod_cetak_npwpd->_get_esptpd_menu();
            $data['Mod_cetak_npwpd'] = $this->Mod_cetak_npwpd;
            $this->template->load('layoutbackend_devel', 'menu_cetak_npwpd', $data);
        }
    }

    public function print_npwpd($npwprd)
    {
        $wp_wr_nik = $this->session->userdata('username');
        $nama   = $this->Mod_cetak_npwpd->get_namawp($npwprd);
        $wp_wr   = $this->Mod_cetak_npwpd->get_wp_wr($npwprd);
        $pejabat   = $this->Mod_cetak_npwpd->get_kadis();

        $alamat =  $wp_wr->wp_wr_almt . ' ' . $wp_wr->wp_wr_camat;
        $tgl_kartu = $wp_wr->wp_wr_tgl_kartu;
        $tanggal_kartu = $this->fungsi->tanggalindo($tgl_kartu);

        $data['wp_wr_id']   = $wp_wr_nik;
        $data['npwprd']     = $npwprd;
        $data['nama']       = $nama;
        $data['alamat']       = $alamat;
        $data['pejabat']       = $pejabat;
        $data['tanggal_kartu']       = $tanggal_kartu;


        // $this->sendmail();
        $this->load->view('admin_devel/cetak_npwpd', $data);
    }
}
