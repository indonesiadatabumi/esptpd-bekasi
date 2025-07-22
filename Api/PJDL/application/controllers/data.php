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
        $id = $this->get('npwprd');
          if ($id) {
          //    $this->db->like('NOP', $id);
              $this->db->where('npwprd', $id);
             
              $daftar = $this->db->get('v_spt')->result();
              $this->response($daftar,200);
          //echo "OK";
          //$this->response(array('status' => 'OK','DATA DITEMUKAN'));
          } else {
           $this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
          }
     
          
      }*/
      
      function index_post() {
          $id = $this->post('npwprd');
          
          if ($id) {
           //   $this->db->like('npwprd', $id);
        //  $this->db->where('npwprd', $id);

          $this->db->select('npwprd,spt_periode, wp_wr_nama,spt_periode_jual1,status_bayar,spt_kode_billing');
          $this->db->from('v_spt');
         $this->db->where('npwprd', $id);
         $this->db->where("(spt_periode='2020' OR spt_periode='2021')", NULL, FALSE);
          $daftar = $this->db->get()->result_array();
        
             // $daftar = $this->db->get('v_spt')->result();
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