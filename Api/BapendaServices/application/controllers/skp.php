<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Skp extends REST_Controller {

	private $api_key = 'b4p3nd4OKb4ng3z'; // Gantilah 'your-api-key' dengan kunci API yang valid

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


    function index_post() {
        $api_key = $this->input->get_request_header('Authorization', TRUE);
        
        // Verifikasi kunci API
        if ($api_key === 'Bearer ' . $this->api_key) {
            $id = $this->post('tgl_ketetapan');
            
			// ... (lanjutan kode yang sudah ada)
			
			if ($id) {
				//   $this->db->like('npwprd', $id);
			 //  $this->db->where('npwprd', $id);
	 
			 $this->db->select('*');
			 $this->db->from('public.v_skp_bpkad');
			 $this->db->where('tgl_ketetapan', $id);
			 $this->db->where("tahun='2023' or tahun='2024' ", NULL, FALSE);
			//$this->db->where("(spt_periode='2023' OR spt_periode='2021')", NULL, FALSE);
			 //$this->db->order_by('no_skrd','desc');
			 //$this->db->limit(1);  
			 
			 $daftar = $this->db->get()->result_array();
			 
			 $this->response($daftar,200);
			   
		 }      
		 else {
		 $this->response(array('status' => 'fail', 502));
		 }



        } else {
            $this->response(array('status' => 'fail', 'message' => 'Unauthorized'), 401);
        }
    }

	



}
?>