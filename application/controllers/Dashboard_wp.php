<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_wp extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('fungsi');
        // $this->load->library('user_agent');
        // $this->load->helper('myfunction_helper');
        // $this->load->model('Mod_dashboard');
        // backButtonHandle();
    }

    function index()
    {
        // $logged_in = $this->session->userdata('logged_in');
        // var_dump($this->session->userdata('logged_in'));die;
        $this->template->load('layoutbackend_devel', 'dashboard/tes');
    }
}
/* End of file Controllername.php */
