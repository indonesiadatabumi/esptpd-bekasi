<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Penerimaan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('tahun_pajak');
        if ($id == '') {
            $daftar = $this->db->get('v_pembayaran_sptpd')->result();
        } else {
            $this->db->where('tahun_pajak', $id);
            $daftar = $this->db->get('v_pembayaran_sptpd')->result();
        }
        $this->response($daftar, 200);
    }
	
	function retribusi_get() {
	//	kd_billing
        $id = $this->get('thn_retribusi');
        if ($id == '') {
            $daftar = $this->db->get('v_app_pembayaran_retribusi')->result();
        } else {
            $this->db->where('thn_retribusi', $id);
            $daftar = $this->db->get('v_app_pembayaran_retribusi')->result();
        }
        $this->response($daftar, 200);
    }
	
    
	
    
	
   
}
?>