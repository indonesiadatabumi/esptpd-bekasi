<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Imb extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $daftar = $this->db->get('app_reg_wr_imb')->result();
        } else {
            $this->db->where('id', $id);
            $daftar = $this->db->get('app_reg_wr_imb')->result();
        }
        $this->response($daftar, 200);
    }
	
	function imb2017_get() {
        $id = $this->get('id');
        if ($id == '') {
            $daftar = $this->db->get('app_reg_wr_imb2017')->result();
        } else {
            $this->db->where('id', $id);
            $daftar = $this->db->get('app_reg_wr_imb2017')->result();
        }
        $this->response($daftar, 200);
    }
	
	function bangunan2017_get() {
        $id = $this->get('id_bangunan');
        if ($id == '') {
            $daftar = $this->db->get('rincian_bangunan_imb2017')->result();
        } else {
            $this->db->where('id_bangunan', $id);
            $daftar = $this->db->get('rincian_bangunan_imb2017')->result();
        }
        $this->response($daftar, 200);
    }
	
		function prasarana2017_get() {
        $id = $this->get('id_prasarana');
        if ($id == '') {
            $daftar = $this->db->get('rincian_prasarana_imb2017')->result();
        } else {
            $this->db->where('id_prasarana', $id);
            $daftar = $this->db->get('rincian_prasarana_imb2017')->result();
        }
        $this->response($daftar, 200);
    }

    function index_post() {
	    $data = array(
					'id'           =>$this->post('id'),
					'npwrd'           => $this->post('npwrd'),
                    'no_registrasi'          => $this->post('no_registrasi'),
					'nm_wp_wr'           => $this->post('nm_wp_wr'),
                    'alamat_wp_wr'          => $this->post('alamat_wp_wr'),
                    'kelurahan'    => $this->post('kelurahan'),
					'kecamatan'    => $this->post('kecamatan'),
					'kota'    => $this->post('kota'),
					'kd_pos'    => $this->post('kd_pos'),
					'no_tlp'    => $this->post('no_tlp'),
					'tipe_wr'    => '1',
					'tipe_retribusi'    => '1',
					'kd_rekening'    => '4120301',
					'nm_rekening' => 'Retribusi Izin Mendirikan Bangunan',
					'bln_retribusi' => $this->post('bln_retribusi'),
					'thn_retribusi' => $this->post('thn_retribusi'),
					'bangunan' => $this->post('bangunan'),
					'luas'=> $this->post('luas'),
					'nilai_satuan' => $this->post('nilai_satuan'),
					'biaya_bangunan' => $this->post('biaya_bangunan'),
					'kj' => $this->post('kj'),
					'gb' => $this->post('gb'),
					'lb' => $this->post('lb'),
					'tb' => $this->post('tb'),
					'nilai_bangunan' => $this->post('nilai_bangunan'),
					'tgl_pendaftaran' => $date=date('Y-m-d'),
					'tgl_penetapan' => $this->post('tgl_penetapan'),
					'kd_billing' => $this->post('kd_billing'),
					'total_retribusi' => $this->post('total_retribusi'),
					'status_ketetapan' => '0',
					'status_bayar' => $this->post('status_bayar')

					);
        $insert = $this->db->insert('app_reg_wr_imb', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	function imb2017_post() {
	    $data = array(
					'id'           =>$this->post('id'),
					'npwrd'           => $this->post('npwrd'),
                    'no_registrasi'          => $this->post('no_registrasi'),
					'nm_wp_wr'           => $this->post('nm_wp_wr'),
                    'alamat_wp_wr'          => $this->post('alamat_wp_wr'),
                    'kelurahan'    => $this->post('kelurahan'),
					'kecamatan'    => $this->post('kecamatan'),
					'kota'    => $this->post('kota'),
					'kd_pos'    => $this->post('kd_pos'),
					'no_tlp'    => $this->post('no_tlp'),
					'tipe_wr'    => '1',
					'tipe_retribusi'    => '1',
					'kd_rekening'    => '4120301',
					'nm_rekening' => 'Retribusi Izin Mendirikan Bangunan',
					'bln_retribusi' => $this->post('bln_retribusi'),
					'thn_retribusi' => $this->post('thn_retribusi'),
//  'bangunan' => $this->post('bangunan'),
//  'luas'=> $this->post('luas'), 
  'luas_seluruh_bangunan'=> $this->post('luas_seluruh_bangunan'),
  'indeks_prasarana'=> $this->post('indeks_prasarana'),
  'bobot_kompleksitas'=> $this->post('bobot_kompleksitas'),
  'indeks_kompleksitas'=> $this->post('indeks_kompleksitas'),
  'nilai_kompleksitas'=> $this->post('nilai_kompleksitas'),
  'bobot_permanensi'=> $this->post('bobot_permanensi'),
  'indeks_permanensi'=> $this->post('indeks_permanensi'),
  'nilai_permanensi'=> $this->post('nilai_permanensi'),
  'bobot_resiko_kebakaran'=> $this->post('bobot_resiko_kebakaran'),
  'indeks_resiko_kebakaran'=> $this->post('indeks_resiko_kebakaran'),
  'nilai_resiko_kebakaran'=> $this->post('nilai_resiko_kebakaran'),
  'bobot_zonasi_gempa'=> $this->post('bobot_zonasi_gempa'),
  'indeks_zonasi_gempa'=> $this->post('indeks_zonasi_gempa'),
  'nilai_zonasi_gempa'=> $this->post('nilai_zonasi_gempa'),
  'bobot_ketinggian_bangunan'=> $this->post('bobot_kepemilikan_bangunan'),
  'indeks_ketinggian_bangunan'=> $this->post('indeks_ketinggian_bangunan'),
  'nilai_ketinggian_bangunan'=> $this->post('nilai_ketinggian_bangunan'),
  'bobot_kepemilikan_bangunan'=> $this->post('bobot_kepemilikan_bangunan'),
  'indeks_kepemilikan_bangunan'=> $this->post('indeks_kepemilikan_bangunan'),
  'nilai_kepemilikan_bangunan'=> $this->post('nilai_kepemilikan_bangunan'),
  'total_parameter'=> $this->post('total_parameter'),
  'penggunaan_gedung'=> $this->post('penggunaan_gedung'),
  'waktu_penggunaan'=> $this->post('waktu_penggunaan'),
  'bangunan_bawah_permukaan'=> $this->post('bangunan_bawah_permukaan'),
  'harga_satuan_retribusi'=> $this->post('harga_satuan_retribusi'),
  'total_retribusi_bangunan'=> $this->post('total_retribusi_bangunan'),
//  'prasarana_bangunan'=> $this->post('prasarana_bangunan'),
//  'luas_prasarana'=> $this->post('luas_prasarana'),
//  'satuan_prasarana'=> $this->post('satuan_prasarana'),
//  'indeks_penggunaan'=> $this->post('indeks_penggunaan'),
//  'harga_satuan_retribusi_prasarana'=> $this->post('harga_satuan_retribusi_prasarana'),
  'jumlah_nilai_retribusi'=> $this->post('jumlah_satuan_retribusi'),
  'total_retribusi_prasarana'=> $this->post('total_retribusi_prasarana'),
  'total_penata_usahaan'=> $this->post('total_penata_usahaan'),
  'total_nilai_retribusi'=> $this->post('total_nilai_retribusi'),
					'tgl_pendaftaran' => $date=date('Y-m-d'),
					'tgl_penetapan' => $this->post('tgl_penetapan'),
					'kd_billing' => $this->post('kd_billing'),
					'total_retribusi' => $this->post('total_retribusi'),
					'status_ketetapan' => '0',
					'status_bayar' => $this->post('status_bayar')

					);
        $insert = $this->db->insert('app_reg_wr_imb2017', $data);
        if ($insert) {
            //$this->response($data, 200);
			$this->response(array('Ok'=>$data, 200));
        } else {
            $this->response(array('status' => 'fail', 502));
        }
	/*
		//  rincian bangunan
		
		$id_bangunan= $_POST['id_bangunan'];
		
		$bangunan=$_POST['bangunan'];
		$luas_bangunan=$_POST['luas_bangunan'];
		$data_ = array();
		
		$index = 0; // Set index array awal dengan 0
		foreach($id_bangunan as $datawp){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($data_, array(
				'id_bangunan'=>$datawp,
				'bangunan'=>$bangunan[$index],  // Ambil dan set data telepon sesuai index array dari $index
				'luas_bangunan'=>$luas_bangunan[$index],  // Ambil dan set data alamat sesuai index array dari $index
			));
			
			$index++;
		}
		
		//$sql = $this->ImbModel->save_imb_rinci($data); 		
														// end
		$this->db->insert_batch('rincian_bangunan_imb2017', $data_);
		
		//  rincian prasarana
		$id_prasarana= $_POST['id_prasarana'];
		$prasarana=$_POST['prasarana'];
		$luas_prasarana=$_POST['luas_prasarana'];
		$satuan_prasarana=$_POST['satuan'];
		$indeks_prasarana=$_POST['indeks'];
		$harga_satuan_prasarana=$_POST['harga_satuan'];
		$dat_ps = array();
		
		$index_ = 0; // Set index array awal dengan 0
		foreach($id_prasarana as $dps){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($dat_ps, array(
				'id_prasarana'=>$dps,
				'prasarana'=>$prasarana[$index_],  // Ambil dan set data telepon sesuai index array dari $index
				'luas_prasarana'=>$luas_prasarana[$index_],  // Ambil dan set data alamat sesuai index array dari $index
				'satuan'=>$satuan_prasarana[$index_],
				'indeks'=>$indeks_prasarana[$index_],
				'harga_satuan'=>$harga_satuan_prasarana[$index_],
			));
			
			$index_++;
		}
		
	//	$sql_prasarana = $this->ImbModel->save_imb_rinci_prasarana($dat_ps); // Panggil fungsi save yang ada di model imb (ImbModel.php)
		$this->db->insert_batch('rincian_prasarana_imb2017', $dat_ps);
	*/
    }
	
	function rincianbangunan_post() {
	    
	
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
	
	function rincianprasarana_post() {
	    
		
		//  rincian prasarana
		$id_prasarana= $_POST['id_prasarana'];
		$prasarana=$_POST['prasarana'];
		$luas_prasarana=$_POST['luas_prasarana'];
		$satuan=$_POST['satuan'];
		$indeks=$_POST['indeks'];
		$harga_satuan=$_POST['harga_satuan'];
		$dat_ps = array();
		
		$index_ = 0; // Set index array awal dengan 0
		foreach($id_prasarana as $dps){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($dat_ps, array(
				'id_prasarana'=>$dps,
				'prasarana'=>$prasarana[$index_],  // Ambil dan set data telepon sesuai index array dari $index
				'luas_prasarana'=>$luas_prasarana[$index_],  // Ambil dan set data alamat sesuai index array dari $index
				'satuan'=>$satuan[$index_],
				'indeks'=>$indeks[$index_],
				'harga_satuan'=>$harga_satuan[$index_],
			));
			
			$index_++;
		}
		
	//	$sql_prasarana = $this->ImbModel->save_imb_rinci_prasarana($dat_ps); // Panggil fungsi save yang ada di model imb (ImbModel.php)
		$insert=$this->db->insert_batch('rincian_prasarana_imb2017', $dat_ps);
		if ($insert) {
            
			 $this->response(array('Ok'=>$dat_ps, 200));
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

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
	
    function imb2017_put() {
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
        $this->db->where('id', $id);
        $update = $this->db->update('app_reg_wr_imb2017', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function imb2017_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('app_reg_wr_imb2017');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>