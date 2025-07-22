<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Data extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
    /*    $id = $this->get('NM_WP');
        if ($id) {
			$this->db->where('NM_WP', $id);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar,200);
		//echo "OK";
		//$this->response(array('status' => 'OK','DATA DITEMUKAN'));
        } else {
         $this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }*/
 /*       $idnm = $this->get('NM_WP');
		$alamat = $this->get('JALAN_WP');
		$nik = $this->get('NIK');
		if ($idnm) {
		
		$this->db->like('NM_WP', $idnm);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar,200);
		
        } elseif ($alamat) {
		
		    $this->db->like('JALAN_WP',$alamat);
			//$this->db->or_like('JALAN_WP',$alamat);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar, 200);
        }
		elseif ($nik) {
		
			$this->db->where('NIK',$nik);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar, 200);
        }
		
		else {
        $this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }*/

        
    }
	
    function index_post() {
		$idnm = $this->post('NM_WP');
		$alamat = $this->post('JALAN_WP');
		$nik = $this->post('NIK');
		if ($idnm) {
		
		$this->db->like('NM_WP', $idnm);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar,200);
		
        } elseif ($alamat) {
		
		    $this->db->like('JALAN_WP',$alamat);
			//$this->db->or_like('JALAN_WP',$alamat);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar, 200);
        }
		elseif ($nik) {
		
			$this->db->where('NIK',$nik);
            $daftar = $this->db->get('DATAKPK')->result();
			$this->response($daftar, 200);
        }
		
		else {
        $this->response(array('status' => 'fail', 502));
        }

	    $data = array(
					'NAMA' =>$this->post('NM_WP'),
					'ALAMAT' =>$this->post('JALAN_WP'),
					'NIK' =>$this->post('NIK')
			
					);
                    // $webservice = $this->load->database('webservice', TRUE);
					 $this->db->set('WAKTU', 'SYSDATE', FALSE);
        $insert = $this->db->insert('LOGDATA', $data);
    /*    if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }*/
    }
	/*
	function rincianbangunan_post() {

$array = array('field1' => 'value', 'field2' => value,..., 'fieldn' => 'value');
$this->db->like($array);
$this->db->get('nama_tabel');
	
		//  rincian bangunan
		
		$id_bangunan= $_POST['id_bangunan'];
		
		$bangunan=$_POST['bangunan'];
		$luas_bangunan=$_POST['luas_bangunan'];
		$data_ = array();
		
		$index = 0; // Set index array awal dengan 0
		foreach($id_bangunan as $datawp){ // perulangan berdasarkan id sampai data terakhir
			array_push($data_, array(
				'id_bangunan'=>$datawp,
				'bangunan'=>$bangunan[$index],  // Ambil dan set data bangunan sesuai index array dari $index
				'luas_bangunan'=>$luas_bangunan[$index],  // Ambil dan set data luas sesuai index array dari $index
			));
			
			$index++;
		}
		
		//$sql = $this->ImbModel->save_imb_rinci($data); 		
														// end
		$insert=$this->db->insert_batch('rincian_bangunan_imb2017', $data_);
		
		 if ($insert) {
            $this->response(array('Ok'=>$data_, 200));
        } else {
            $this->response(array('status' => 'fail', 502));
        }
		

    }
	*/
/*	
    function index_put() {
        $id = $this->put('id');
        $data = array(
				'npwrd'           => $this->post('npwrd'),
					'no_registrasi'           => $this->post('no_registrasi'),
                  'nm_wp_wr'           => $this->post('nm_wp_wr'),
                    'alamat_wp_wr'          => $this->post('alamat_wp_wr'),
                    'kelurahan'    => $this->post('kelurahan'),
					'kecamatan'    => $this->post('kecamatan'),
					'kota'    => $this->post('kota'),
					'no_tlp'    => $this->post('no_tlp'));
        $this->db->where('npwrd', $id);
        $update = $this->db->update('app_reg_wr_imb', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('npwrd');
        $this->db->where('npwrd', $id);
        $delete = $this->db->delete('app_reg_wr_imb');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	*/

}
?>