<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_dashboard');
        // backButtonHandle();
    }

    function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            if ($this->session->userdata('id_level') == "4") {
                $id_wp = $this->Mod_dashboard->get_id_wp($this->session->userdata('id_user'));
                $count_pending_spt = $this->Mod_dashboard->get_count_pending($id_wp->id_wp_wr);
                $data['count_pending_spt'] = $count_pending_spt->jumlah;
                $data['pending_spt'] = $this->Mod_dashboard->get_pending($id_wp->id_wp_wr);
                $this->template->load('layoutbackend', 'dashboard/dashboard_news', $data);
            } else {
                $data['rekap_perbulan'] = $this->Mod_dashboard->rekap_perbulan();
                // $data['rekap_hotel_full'] = $this->Mod_dashboard->rekap_hotel_full();
                // $data['rekap_resto_full'] = $this->Mod_dashboard->rekap_resto_full();
                // $data['rekap_hiburan_full'] = $this->Mod_dashboard->rekap_hiburan_full();
                // $data['rekap_reklame_full'] = $this->Mod_dashboard->rekap_reklame_full();
                // $data['rekap_pj_full'] = $this->Mod_dashboard->rekap_pj_full();
                // $data['rekap_parkir_full'] = $this->Mod_dashboard->rekap_parkir_full();
                // $data['model'] = $this->Mod_dashboard;
                $data['rekap_total'] = $this->Mod_dashboard->rekap_total();
                $this->template->load('layoutbackend', 'dashboard/dashboard_data', $data);
            }
        }
    }

    function get_penerimaan_data() {
        $jenis_pajak = $_POST['jenis_pajak'];
        
        if ($jenis_pajak == '0') {
            $data['penerimaan_pajak'] = $this->Mod_dashboard->data_banding_all();
        }else {
            $data['penerimaan_pajak'] = $this->Mod_dashboard->data_banding($jenis_pajak);
        }

        echo json_encode($data);
    }
}
/* End of file Controllername.php */
