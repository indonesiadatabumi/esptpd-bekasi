<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Data extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }
/*
    function index_get() {
      $id = $this->get('NOP');
        if ($id) {
        //    $this->db->like('NOP', $id);
			$this->db->where('NOP', $id);
            $this->db->where("(TAHUN_PAJAK='2019' OR TAHUN_PAJAK='2020' OR TAHUN_PAJAK='2021')", NULL, FALSE);
 
            $daftar = $this->db->get('SPPT_DPMPTSP')->result();
			$this->response($daftar,200);
		//echo "OK";
		//$this->response(array('status' => 'OK','DATA DITEMUKAN'));
        } else {
         $this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }
   
        
    }*/
	
    function index_post() {
		$id = $this->post('NOP');
		
		if ($id) {
         //   $this->db->like('NOP', $id);
		$this->db->where('NOP', $id);
        $this->db->where("(TAHUN_PAJAK='2019' OR TAHUN_PAJAK='2020' OR TAHUN_PAJAK='2021')", NULL, FALSE);
 
        
            $daftar = $this->db->get('SPPT_DPMPTSP')->result();
			$this->response($daftar,200);
		
        }
		
		else {
        $this->response(array('status' => 'fail', 502));
        }
/*
	    $data = array(
            'client_id' =>'DPMPTSP',
					'data_record' =>$this->post('NOP')
			
					);
                     $webservice = $this->load->database('webservice', TRUE);
					// $this->db->set('date', 'NOW', FALSE);
        $webservice = $this->db->insert('log_data', $data);
    /*    if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }*/
    }
	

}
?>