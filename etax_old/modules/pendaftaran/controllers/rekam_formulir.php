<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * class Rekam_formulir 
 * @author Daniel
 * @package Simpatda
 */
class Rekam_formulir extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('rekam_formulir_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$kecamatan = $this->common_model->get_kecamatan();
		//get kecamatan
		$arr_kecamatan = array();
		$arr_kecamatan[''] = "--";
		foreach ($kecamatan as $row) {
			$arr_kecamatan[$row->camat_id] = $row->camat_kode . ' | ' . $row->camat_nama;
		}
		$data['kecamatan'] = $arr_kecamatan;
		$data['kelurahan'] = array('' => '--');
		$data['kabupaten'] = $this->common_model->get_record_value('dapemda_nm_dati2', 'data_pemerintah_daerah', 'dapemda_id=1');
		$data['status'] = array('0' => 'DIKIRIM', '1' => 'KEMBALI', '2' => 'TIDAK KEMBALI');

		$data['title'] = 'Pendaftaran | Rekam Formulir';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendaftaran';
		$data['content_desc'] = 'Menu Rekam Pendaftaran Wajib Pajak';
		$page = 'pendaftaran/add_rekam_formulir';
		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('add_rekam_formulir', $data);
	}

	/**
	 * view page controller
	 */
	function view()
	{
		$this->load->view('view_rekam_formulir');
	}

	/**
	 * get list data formulir
	 */
	function get_list()
	{
		$list = $this->rekam_formulir_model->get_list();
		$data = array();
		$no = 1;
		foreach($list as $list){
			$aksi = "<button class=\"btn btn-sm btn-info\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $list->form_id . "><i class=\"fas fa-edit\"> Edit</i></button>
				<button class=\"btn btn-sm btn-danger\" id=\"hapus\" href=\"javascript:void(0)\" title=\"Hapus\" data-href=" . $list->form_id . "><i class=\"fas fa-trash\"> Hapus</i></button>";
			
			$row = array();
			$row[] = $no++;
            $row[] = $list->form_nama;
			$row[] = $list->form_alamat;
			$row[] = $list->camat_nama;
			$row[] = $list->lurah_nama;
			$row[] = $list->status;
			$row[] = $list->form_tgl_kirim;
			$row[] = $aksi;
			$data[] = $row;
		}
		$output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	/**
	 * edit rekam formulir
	 */
	function edit($form_id)
	{
		$formulir = $this->rekam_formulir_model->get_detail($form_id);
		$kecamatan = $this->common_model->get_kecamatan();
		//get kecamatan
		$arr_kecamatan = array();
		$arr_kecamatan[''] = "--";
		foreach ($kecamatan as $row) {
			$arr_kecamatan[$row->camat_id] = $row->camat_kode . ' | ' . $row->camat_nama;
		}
		$data['kecamatan'] = $arr_kecamatan;

		$kelurahan = $this->common_model->get_kelurahan($formulir->form_camat);
		$arr_kelurahan = array();
		$arr_kelurahan[''] = "--";
		foreach ($kelurahan as $row) {
			$arr_kelurahan[$row->lurah_id] = $row->lurah_kode . ' | ' . $row->lurah_nama;
		}
		$data['kelurahan'] = $arr_kelurahan;
		$data['kabupaten'] = $this->common_model->get_record_value('dapemda_nm_dati2', 'data_pemerintah_daerah', 'dapemda_id=1');
		$data['status'] = array('0' => 'DIKIRIM', '1' => 'KEMBALI', '2' => 'TIDAK KEMBALI');
		$data['row'] = $formulir;

		// $this->load->view('edit_rekam_formulir', $data);
		$page = 'pendaftaran/edit_rekam_formulir';
		echo modules::run('layouts/loadview', $data, $page);
	}

	/**
	 * next nomor formulir
	 */
	function next_no_formulir()
	{
		echo $this->common_model->get_next_nomor_formulir();
	}

	/**
	 * insert formulir
	 */
	function save()
	{
		$result = $this->rekam_formulir_model->insert();

		if ($result)
			echo json_encode(array('status' => true, 'msg' => "Data berhasil disimpan"));
		else
			echo json_encode(array('status' => false, 'msg' => "Data gagal disimpan"));
	}

	/**
	 * update formulir
	 */
	function update()
	{
		$result = $this->rekam_formulir_model->update();

		if ($result)
			echo json_encode(array('status' => true, 'msg' => "Data berhasil disimpan"));
		else
			echo json_encode(array('status' => false, 'msg' => "Data gagal disimpan"));
	}

	/**
	 * delete formulir controller
	 */
	function delete($form_id)
	{
		// $result = "";
		// $counter = 0;

		// $arr_id = explode("|", $this->input->post('id'));
		// for ($i = 0; $i < count($arr_id) - 1; $i++) {
		// 	if ($this->rekam_formulir_model->delete($arr_id[$i]) == true)
		// 		$counter++;
		// }

		// if ($counter != 0) {
		// 	echo $counter . " data berhasil dihapus";
		// } else {
		// 	echo "Tidak ada data yang berhasil dihapus";
		// }
		$this->rekam_formulir_model->delete($form_id);

		echo json_encode('sukses');
	}
}
