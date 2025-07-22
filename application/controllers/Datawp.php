<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Datawp extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_datawp'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('layoutbackend', 'datawp');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        if ($this->session->userdata('id_level') == 17){
            $list = $this->Mod_datawp->get_datatables_uptd($this->session->userdata('wilayah_uptd'));
            $count_all = $this->Mod_datawp->count_all_uptd($this->session->userdata('wilayah_uptd'));
            $count_filter = $this->Mod_datawp->count_filtered_uptd($this->session->userdata('wilayah_uptd'));
        }else{
            $list = $this->Mod_datawp->get_datatables();
            $count_all = $this->Mod_datawp->count_all();
            $count_filter = $this->Mod_datawp->count_filtered();
        }
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[] = $pel->wp_wr_no_urut;
            $row[] = $pel->wp_wr_nama;
            $row[] = $pel->wp_wr_almt . ',' . $pel->wp_wr_lurah;
            $row[] = $pel->ref_kodus_nama;
            $row[] = $pel->wp_wr_camat;
            $row[] = $pel->wp_wr_id;
            $row[] = $pel->wp_wr_bidang_usaha;
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

    public function lihat()
    {
        $activ = "wp";
        $wpid = $_GET['wr_id'];
        $noreg = $_GET['no_urut'];
        $pajret = $_GET['pajret'];

        $data_wp = $this->Mod_datawp->get_wrnama($noreg);
        $data['wp_wr_nama'] = $data_wp->wp_wr_nama;

        $data['data_spt'] = $this->Mod_datawp->get_spt($wpid);
        // var_dump($data_spt);


        $this->template->load('layoutbackend', 'infowp', $data);
    }
}
