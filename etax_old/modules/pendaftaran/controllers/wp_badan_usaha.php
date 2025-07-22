<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Badan_usaha controller
 * @package Simpatda
 * @author Daniel Hutauruk
 * @version 20121016
 */
class Wp_badan_usaha extends Master_Controller {
	/**
	 * constructor
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('wp_badan_usaha_model');
	}
	
	/**
	 * index page controller
	 */
	function index() {
		$this->add();
	}
	
 	/**
	 * view list wajib pajak pribadi
	 */
	function view() {
		$this->load->view('view_wp_badan_usaha');
	}
	
	/**
	 * get list page controller
	 */
	function get_list() {
		$list_wp = $this->wp_badan_usaha_model->get_list();
		$data = array();
		$no = 1;
		foreach($list_wp as $list_wp){
			if ($list_wp->wp_wr_nik != null) {
				$aksi = "<button class=\"btn btn-sm btn-info\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $list_wp->wp_wr_id . "><i class=\"fas fa-edit\"> Edit</i></button>
				<button class=\"btn btn-sm btn-primary\" id=\"tambah_op\" href=\"javascript:void(0)\" title=\"Tambah OP\" data-href=" . $list_wp->wp_wr_nik . "><i class=\"fas fa-plus\"> Tambah OP</i></button>
				<button class=\"btn btn-sm btn-danger\" id=\"hapus\" href=\"javascript:void(0)\" title=\"Hapus\" data-href=" . $list_wp->wp_wr_id . "><i class=\"fas fa-trash\"> Hapus</i></button>";
			} else {
				$aksi = "<button class=\"btn btn-sm btn-info\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $list_wp->wp_wr_id . "><i class=\"fas fa-edit\"> Edit</i></button>
				<button class=\"btn btn-sm btn-danger\" id=\"hapus\" href=\"javascript:void(0)\" title=\"Hapus\" data-href=" . $list_wp->wp_wr_id . "><i class=\"fas fa-trash\"> Hapus</i></button>";
			}
			
			$row = array();
			$row[] = $no++;
            $row[] = $list_wp->wp_wr_nik;
			$row[] = $list_wp->npwprd;
			$row[] = $list_wp->wp_wr_nama_milik;
			$row[] = $list_wp->wp_wr_nama;
			$row[] = $list_wp->wp_wr_almt;
			$row[] = $list_wp->wp_wr_lurah;
			$row[] = $list_wp->wp_wr_camat;
			$row[] = $aksi;
			$data[] = $row;
		}
		$output = array(
            // "draw" => $_POST['draw'],
            // "recordsTotal" => $this->verifikasi_model->count_all(),
            // "recordsFiltered" => $this->verifikasi_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	/**
	 * add wp badan usaha
	 */
	function add() {
		$kecamatan = $this->common_model->get_kecamatan();
		//get kecamatan
		$arr_kecamatan = array();
		$arr_kecamatan[''] = "--";
		foreach ($kecamatan as $row) {
			$arr_kecamatan[$row->camat_id.'|'.$row->camat_nama] = $row->camat_kode.' | '.$row->camat_nama;
		}
		$data['kecamatan'] = $arr_kecamatan;
		$data['kelurahan'] = array('' => '--');
		$data['kabupaten'] = $this->common_model->get_record_value('dapemda_nm_dati2', 'data_pemerintah_daerah', 'dapemda_id=1');
		
		$bidang_usaha = array();
		$arr_bidang_usaha = $this->common_model->get_bidang_usaha();
		if (count($arr_bidang_usaha))
		{
			foreach ($arr_bidang_usaha as $row)
			{
				$bidang_usaha[$row->ref_kodus_id] = $row->ref_kodus_kode.'.'.$row->ref_kodus_nama;
			}
		}		
		$data['bidang_usaha'] = $bidang_usaha;
		
		$arr_gol_hotel = array();
		$golongan_hotel = $this->common_model->get_query("*", "ref_gol_hotel", NULL, "ref_kode ASC");
		if (count($golongan_hotel) > 0)
		{
			$arr_gol_hotel[''] = "-- Silahkan Pilih --";
			foreach ($golongan_hotel->result() as $row)
			{
				$arr_gol_hotel[$row->ref_kode] = $row->ref_kode.' | '.$row->ref_nama;
			}
		}
		$data['golongan_hotel'] = $arr_gol_hotel;
		
		$arr_jenis_restoran = array("0" => "Rumah Makan & Catering", "1" => "Rumah Makan", "2" => "Catering");
		$data['jenis_restoran'] = $arr_jenis_restoran;

		$arr_jenis_hiburan = array("0" => "Rumah Makan & Catering", "1" => "Rumah Makan", "2" => "Catering");
		$data['jenis_hiburan'] = $arr_jenis_hiburan;

		$page = 'pendaftaran/add_wp_badan_usaha';
		echo modules::run('layouts/loadview', $data, $page);
	}
	
	/**
	 * saved data inserted
	 */
	function save() {
		echo json_encode($this->wp_badan_usaha_model->insert_data());
	}

	/**
	 * saved op inserted
	 */
	function save_op() {
		echo json_encode($this->wp_badan_usaha_model->insert_data_op());
	}

	/**
	 * tambah op badan usaha
	 */
	function tambah_op($wp_wr_nik) {
		// $wp_wr_nik = $this->input->post('wp_wr_nik');
		if (!empty($wp_wr_nik)) {
			$query = $this->wp_badan_usaha_model->get_wp_wr_nik($wp_wr_nik);
			$wp_data = $query->row();
			$data['row'] = $wp_data;

			$kecamatan = $this->common_model->get_kecamatan();
			//get kecamatan
			$arr_kecamatan = array();
			$arr_kecamatan[''] = "--";
			foreach ($kecamatan as $row) {
				$arr_kecamatan[$row->camat_id.'|'.$row->camat_nama] = $row->camat_kode.' | '.$row->camat_nama;
			}
			$data['kecamatan'] = $arr_kecamatan;
			$data['kelurahan'] = array('' => '--');
			$data['kabupaten'] = $this->common_model->get_record_value('dapemda_nm_dati2', 'data_pemerintah_daerah', 'dapemda_id=1');
			
			$bidang_usaha = array();
			$arr_bidang_usaha = $this->common_model->get_bidang_usaha();
			if (count($arr_bidang_usaha))
			{
				foreach ($arr_bidang_usaha as $row)
				{
					$bidang_usaha[$row->ref_kodus_id] = $row->ref_kodus_kode.'.'.$row->ref_kodus_nama;
				}
			}		
			$data['bidang_usaha'] = $bidang_usaha;
			
			$arr_gol_hotel = array();
			$golongan_hotel = $this->common_model->get_query("*", "ref_gol_hotel", NULL, "ref_kode ASC");
			if (count($golongan_hotel) > 0)
			{
				$arr_gol_hotel[''] = "-- Silahkan Pilih --";
				foreach ($golongan_hotel->result() as $row)
				{
					$arr_gol_hotel[$row->ref_kode] = $row->ref_kode.' | '.$row->ref_nama;
				}
			}
			$data['golongan_hotel'] = $arr_gol_hotel;
			
			$arr_jenis_restoran = array("0" => "Rumah Makan & Catering", "1" => "Rumah Makan", "2" => "Catering");
			$data['jenis_restoran'] = $arr_jenis_restoran;
			$data['wp_wr_nik'] = $wp_wr_nik;
			
			// $this->load->view('add_op', $data);
			$page = 'pendaftaran/add_op';
			echo modules::run('layouts/loadview', $data, $page);
		} else {
			echo 'NIB / NIK Wajib Pajak tidak ada. Silahkan masukkan terlebih dahulu';	
		}
	}
	
	/**
	 * edit wp badan usaha
	 */
	function edit($wp_wr_id) {
		if (!empty($wp_wr_id)) {
			$query = $this->wp_badan_usaha_model->get_wp_wr($wp_wr_id);
			if ($query->num_rows() > 0) {
				$wp_data = $query->row();
				$data['row'] = $wp_data;
				
				$kecamatan = $this->common_model->get_kecamatan();
				$arr_kecamatan = array();
				$arr_kecamatan[''] = "--";
				foreach ($kecamatan as $row) {
					$arr_kecamatan[$row->camat_id.'|'.$row->camat_nama] = $row->camat_kode.' | '.$row->camat_nama;
				}
				$data['kecamatan'] = $arr_kecamatan;
				
				$kelurahan = $this->common_model->get_kelurahan($wp_data->wp_wr_kd_camat);
				$arr_kelurahan = array();
				$arr_kelurahan[''] = "--";
				foreach ($kelurahan as $row) {
					$arr_kelurahan[$row->lurah_id.'|'.$row->lurah_nama] = $row->lurah_kode.' | '.$row->lurah_nama;
				}
				$data['kelurahan'] = $arr_kelurahan;
				
				$data['kabupaten'] = $this->common_model->get_record_value('dapemda_nm_dati2', 'data_pemerintah_daerah', 'dapemda_id=1');
				
				$bidang_usaha = array();
				$arr_bidang_usaha = $this->common_model->get_bidang_usaha();			
				if (count($arr_bidang_usaha))
				{
					foreach ($arr_bidang_usaha as $row)
					{
						$bidang_usaha[$row->ref_kodus_id] = $row->ref_kodus_kode.'.'.$row->ref_kodus_nama;
					}
				}
				$data['bidang_usaha'] = $bidang_usaha;
				
				$arr_gol_hotel = array();
				$golongan_hotel = $this->common_model->get_query("*", "ref_gol_hotel", NULL, "ref_kode ASC");
				if (count($golongan_hotel) > 0)
				{
					$arr_gol_hotel[''] = "-- Silahkan Pilih --";
					foreach ($golongan_hotel->result() as $row)
					{
						$arr_gol_hotel[$row->ref_kode] = $row->ref_kode.' | '.$row->ref_nama;
					}
				}
				$data['golongan_hotel'] = $arr_gol_hotel;
				
				$arr_jenis_restoran = array("0" => "Rumah Makan & Catering", "1" => "Rumah Makan", "2" => "Catering");
				$data['jenis_restoran'] = $arr_jenis_restoran;
				
				// $this->load->view('edit_wp_badan_usaha', $data);

				$page = 'pendaftaran/edit_wp_badan_usaha';
				echo modules::run('layouts/loadview', $data, $page);
			} else {
				echo 'ID Wajib Pajak tidak ditemukan.';
			}
		} else {
			echo 'ID Wajib Pajak tidak ada. Silahkan masukkan terlebih dahulu';	
		}
	}
	
	/**
	 * update data
	 */
	function update() {
		echo json_encode($this->wp_badan_usaha_model->update_data());
	}
	
	/**
	 * delete page controller
	 */
	function delete($wp_wr_id) {
		// $result = "";
		// $counter = 0;
		
		// $arr_id = explode("|", $this->input->post('id'));
		// for ($i = 0; $i < count($arr_id) - 1; $i++) {
		// 	if($this->wp_badan_usaha_model->delete_data($arr_id[$i]) == true)
		// 		$counter++;
		// }
		
		// if ($counter != 0) {
		// 	echo $counter." data berhasil dihapus";
		// } else {
		// 	echo "Tidak ada data yang berhasil dihapus";
		// }
		$this->wp_badan_usaha_model->delete_data($form_id);

		echo json_encode('sukses');
	}
	
	/**
	 * get detail wp
	 */
	function get_wp_detail() {
		$wp_id = $this->input->post('wp_id');
		$bidus = $this->input->post('bidus');
		if ($wp_id != "") {
			if ($bidus == '1'){
				$result = $this->wp_badan_usaha_model->get_wp_detail_hotel($wp_id);
			}elseif ($bidus == '16'){
				$result = $this->wp_badan_usaha_model->get_wp_detail_resto($wp_id);
			}

			if ($result->num_rows > 0)
				echo json_encode(array('status' => true, 'row' => $result->row_array()));
			else 
				echo json_encode(array('status' => false));
		} else {
			echo json_encode(array('status' => false));
		}
	}
}