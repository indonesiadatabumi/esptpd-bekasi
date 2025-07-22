<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Dashboard extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function spt_get() {
        $spt_periode = $this->get('spt_periode');
        $spt_jenis_pajakretribusi = $this->get('spt_jenis_pajakretribusi');
        $status_bayar = $this->get('status_bayar');
        $spt_periode_jual1 = $this->get('tgl_awal');
        $spt_periode_jual2 = $this->get('tgl_akhir');
       
        if ($spt_periode) {
          
            $this->db->where('spt_periode', $spt_periode);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('spt')->result();
            $this->response($row,200);
        
        }else if ($spt_jenis_pajakretribusi) {
          
            $this->db->where('spt_jenis_pajakretribusi', $spt_jenis_pajakretribusi);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('spt')->result();
            $this->response($row,200);
        
        }
        else if ($status_bayar) {
          
            $this->db->where('status_bayar', $status_bayar);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('spt')->result();
            $this->response($row,200);
        
        }
        else if ($spt_periode_jual1) {
          
           
            $this->db->where("(spt_periode_jual1 between '$spt_periode_jual1' and '$spt_periode_jual2')", NULL, FALSE);
                         
            $row = $this->db->get('spt')->result();
            $this->response($row,200);
        
        }
           
        else {

            //$this->db->where('status_bayar','0');
              //$this->db->where("(spt_periode='2023')", NULL, FALSE);
                           
              $row = $this->db->get('spt')->result();
              $this->response($row,200);
            //$this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }

          
      }





      function wp_wr_get() {
       
        $wp_wr_id = $this->get('wp_wr_id');
        $wp_wr_nama = $this->get('wp_wr_nama');
        $wp_wr_lurah = $this->get('wp_wr_lurah');
        $wp_wr_camat = $this->get('wp_wr_camat');
        $wp_wr_jenis = $this->get('wp_wr_jenis');
       
        if ($wp_wr_id) {
          
            $this->db->where('wp_wr_id', $wp_wr_id);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('wp_wr')->result();
            $this->response($row,200);
        
        }else if ($wp_wr_nama) {
          
            $this->db->where('wp_wr_nama', $wp_wr_nama);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('wp_wr')->result();
            $this->response($row,200);
        
        }
        else if ($wp_wr_lurah) {
          
            $this->db->where('wp_wr_lurah', $wp_wr_lurah);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('wp_wr')->result();
            $this->response($row,200);
        
        }
        else if ($wp_wr_camat) {
          
           
            $this->db->where('wp_wr_camat',$wp_wr_camat);
                         
            $row = $this->db->get('wp_wr')->result();
            $this->response($row,200);
        
        }
           
        else {
                                     
              $row = $this->db->get('wp_wr')->result();
              $this->response($row,200);
            //$this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }
    }

    function setoran_pajak_retribusi_get() {
       
        $setor_pajret_id_spt = $this->get('setor_pajret_id_spt');
        $setorpajret_jenis_pajakretribusi = $this->get('setorpajret_jenis_pajakretribusi');
        $setorpajret_tgl_bayar = $this->get('setorpajret_tgl_bayar');
        $setorpajret_tgl_bayar2 = $this->get('setorpajret_tgl_bayar2');
        $setorpajret_jenis_ketetapan=$this->get('setorpajret_jenis_ketetapan');
       
        if ($setor_pajret_id_spt) {
          
            $this->db->where('setor_pajret_id_spt', $setor_pajret_id_spt);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('setoran_pajak_retribusi')->result();
            $this->response($row,200);
        
        }else if ($setorpajret_jenis_pajakretribusi) {
          
            $this->db->where('setorpajret_jenis_pajakretribusi', $setorpajret_jenis_pajakretribusi);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('setoran_pajak_retribusi')->result();
            $this->response($row,200);
        
        }
        else if ($setorpajret_tgl_bayar) {
          
           
            $this->db->where("(setorpajret_tgl_bayar between '$setorpajret_tgl_bayar' and '$setorpajret_tgl_bayar2')", NULL, FALSE);
                         
            $row = $this->db->get('setoran_pajak_retribusi')->result();
            $this->response($row,200);
        
        }
        else if ($setorpajret_jenis_ketetapan) {
          
           
            $this->db->where('setorpajret_jenis_ketetapan',$setorpajret_jenis_ketetapan);
                         
            $row = $this->db->get('setoran_pajak_retribusi')->result();
            $this->response($row,200);
        
        }
           
        else {
                                     
              $row = $this->db->get('setoran_pajak_retribusi')->result();
              $this->response($row,200);
            //$this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }
   
        
    }

    function wp_wr_reklame_get() {
       
        $wp_rek_id = $this->get('wp_rek_id');
        $wp_rek_nama = $this->get('wp_rek_nama');
        $wp_rek_kode = $this->get('wp_rek_kode');
        
        $wp_rek_alamat=$this->get('wp_rek_alamat');
       
        if ($wp_rek_id) {
          
            $this->db->where('wp_rek_id', $wp_rek_id);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('wp_wr_reklame')->result();
            $this->response($row,200);
        
        }else if ($wp_rek_nama) {
          
            $this->db->where('wp_rek_nama', $wp_rek_nama);
          //  $this->db->where("(spt_periode='2020' OR spt_periode='2022' OR spt_periode='2023')", NULL, FALSE);
                         
            $row = $this->db->get('wp_wr_reklame')->result();
            $this->response($row,200);
        
        }
        else if ($wp_rek_kode) {
          
           
            $this->db->where('wp_rek_kode',$wp_rek_kode);
                         
            $row = $this->db->get('wp_wr_reklame')->result();
            $this->response($row,200);
        
        }
        else if ($wp_rek_alamat) {
          
           
            $this->db->where('wp_rek_alamat',$wp_rek_alamat);
                         
            $row = $this->db->get('wp_wr_reklame')->result();
            $this->response($row,200);
        
        }
           
        else {
                                     
              $row = $this->db->get('wp_wr_reklame')->result();
              $this->response($row,200);
            //$this->response(array('status' => 'fail','DATA TIDAK DITEMUKAN'));
        }
   
        
    }

    
     
     
      
}
?>