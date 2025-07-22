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
          $id = $this->post('npwrd');
          
          if ($id) {
           //   $this->db->like('npwprd', $id);
        //  $this->db->where('npwprd', $id);

        $this->db->select('npwrd,no_skrd,bln_retribusi,thn_retribusi,kd_billing, wp_wr_nama,wp_wr_alamat,wp_wr_lurah,wp_wr_camat,wp_wr_kabupaten,kd_rekening,nm_rekening,total_retribusi,tgl_penetapan,status_ketetapan,status_bayar,status_lunas');
        $this->db->from('v_data_pasar');
        $this->db->where('npwrd', $id);
         //$this->db->where("(spt_periode='2020' OR spt_periode='2021')", NULL, FALSE);
        $daftar = $this->db->get()->result_array();
        
              $this->response($daftar,200);
          
          }
          
          else {
          $this->response(array('status' => 'fail', 502));
          }

          /*
         
          $data = array(
           
            'npwrd'=> $this->post('npwrd'),
            'no_nota_perhitungan'=> $this->post('no_registrasi'),
            'bln_retribusi'=> $this->post('nm_wp_wr'),
            'thn_retribusi'=> $this->post('alamat_wp_wr'),
            'kd_rekening'=> $this->post('kelurahan'),
            'nm_rekening'=> $this->post('kecamatan'),
            'dasar_pengenaan'=> $this->post('kota'),
            'jenis_ketetapan'=> $this->post('kd_pos'),
            'keterangan'=> $this->post('no_tlp'),
            'jenis_bangunan'=> '',
            'tipe_bangunan'=> '',
            'total_retribusi' => '4120301',
            'imb' => '',
            'fk_skrd' => $this->post('bln_retribusi'),
            'id_nota' => $this->post('tgl_penetapan')
            );
$insert = $this->db->insert('app_nota_perhitungan', $data);
if ($insert) {
    $this->response($data, 200);
} else {
    $this->response(array('status' => 'fail', 502));
}
  

$data2 = array(
           
    'no_skrd'=> $this->post(''),
    'bln_retribusi'=> $this->post(''),
    'thn_retribusi'=> $this->post(''),
    'tipe_retribusi'=>$this->post(''),
    'kd_billing'=> $this->post(''),
    'npwrd'=>$this->post(''),
    'wp_wr_nama'=>$this->post(''),
    'wp_wr_alamt'=>$this->post(''),
    'wp_wr_lurah'=> $this->post(''),
    'wp_wr_camat'=> $this->post(''),
    'wp_wr_kabupaten'=> $this->post(''),
    'kd_rekening'=> $this->post(''),
    'nm_rekening'=> $this->post(''),
    'user_input'=> $this->post(''),
    'tgl_input'=> $this->post(''),
    'tgl_skrd'=> $this->post(''),
    'tgl_penetapan'=> $this->post(''),
    'status_ketetapan'=> $this->post(''),
    'status_bayar'=> $this->post(''),
    'status_lunas'=> $this->post(''),
    'id_skrd'=> $this->post('')
    );
$insert2 = $this->db->insert('app_skrd', $data2);
if ($insert2) {
$this->response($data2, 200);
} else {
$this->response(array('status' => 'fail', 502));
}
*/
         
      }
/*
function index_put() {
        $npwrd = $this->put('npwrd');
        $id_skrd = $this->put('id_skrd');
        $data = array(
				'npwrd' => $this->post('npwrd'),
					'no_registrasi' => $this->post('no_registrasi'),
                    'nm_wp_wr'  => $this->post('nm_wp_wr'),
                    'alamat_wp_wr'  => $this->post('alamat_wp_wr'),
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
    }*/


}
?>