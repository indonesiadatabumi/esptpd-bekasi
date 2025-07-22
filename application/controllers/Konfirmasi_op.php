<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi_op extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('fungsi');
        // $this->load->library('user_agent');
        // $this->load->helper('myfunction_helper');
        $this->load->model('Mod_konfirmasi_op');
        // backButtonHandle();
    }

    function index()
    {
        // $logged_in = $this->session->userdata('logged_in');
        // var_dump($this->session->userdata('logged_in'));die;
        $this->template->load('layoutbackend_devel', 'form_konfirmasi_op');
    }

    public function cari_data() {
        $npwpd = base64_decode($this->input->post('npwpd'));
        $data_op = $this->Mod_konfirmasi_op->cari_data_op($npwpd);

        if (!$data_op) {
            $response = [
                'responseCode' => '99',
                'responseMessage' => false
            ];
        }else{
            $response = [
                'responseCode' => '00',
                'responseMessage' => true,
                'data' => $data_op
            ];
        }

        echo json_encode($response);
    }

    public function confirm_data() {
        $wp_wr_id = base64_decode($this->input->post('wp_wr_id'));
        $data = array (
            'wp_wr_nik' => $this->session->userdata('username')
        );
        
        $update_nik = $this->Mod_konfirmasi_op->updateNIK($wp_wr_id, $data);

        if (!$update_nik) {
            $response = [
                'responseCode' => '99',
                'responseMessage' => false
            ];
        }else{
            $response = [
                'responseCode' => '00',
                'responseMessage' => true
            ];
        }

        echo json_encode($response);
    }
}
/* End of file Controllername.php */
