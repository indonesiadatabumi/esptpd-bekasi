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
	//$kd_propinsi  = $this->post('KD_PROPINSI');
	//	$kd_dati2     = $this->post('KD_DATI2');
	//	$kd_kecamatan = $this->post('KD_KECAMATAN');
		$kd_kelurahan = $this->post('KD_KELURAHAN');
		$kd_blok 	  = $this->post('KD_BLOK');
	//	$no_urut 	  = $this->post('NO_URUT');
	//	$kd_jns_op  = $this->post('KD_JNS_OP');
		
		if ($kd_kelurahan) {

	//	$this->db->where('KD_PROPINSI', $kd_propinsi);
	//	$this->db->where('KD_DATI2', $kd_dati2);
	//	$this->db->where('KD_KECAMATAN', $kd_kecamatan);
		$this->db->where('KD_KELURAHAN', $kd_kelurahan);
		$this->db->where('KD_BLOK', $kd_blok);
	//	$this->db->where('NO_URUT', $no_urut);
	//	$this->db->where('KD_JNS_OP', $kd_jns_op);
        
       // $daftar = $this->db->get('IPBB')->result();
	   $query = $this->db->get_where('IPBB',array('KD_KELURAHAN'=>$kd_kelurahan,'KD_BLOK'=>$kd_blok));
	   $this->response($query,200);
		
        }
		
		else {
        $this->response(array('status' => 'fail', 502));
        }

    }
	

}
?>