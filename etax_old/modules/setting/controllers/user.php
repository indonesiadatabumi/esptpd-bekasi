<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * class Rekam_formulir 
 * @author Daniel
 * @package Simpatda
 */
class User extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_level_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$data['title'] = 'Setting | User';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Daftar User Level';
		$data['content_desc'] = 'Menu daftar user';
		$page = 'setting/daftar_user_level';
		echo modules::run('layouts/loadview', $data, $page);

	}

	/**
	 * get list user level
	 */
	function get_list()
	{
		$this->user_level_model->get_list();
	}

	function aksesmenu()
	{
		$ref_jab_id = $this->input->post('ref_jab_id');
		$akses_menu = $this->user_level_model->cekAkses($ref_jab_id);
		$data['akses_menu'] = $akses_menu;
		$data['jab_id'] = $ref_jab_id;
		$this->load->view('setting/akses_menu', $data);
	}

	function addaksesmenu($jab_id)
	{
		$menu = $this->user_level_model->daftarMenu();
		$data['menu'] = $menu;
		$data['jab_id'] = $jab_id;
		$data['title'] = 'Setting | Add Akses';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Tambah Hak Akses';
		$data['content_desc'] = 'Menu menambahkan hak akses';
		$page = 'setting/add_akses_menu';
		echo modules::run('layouts/loadview', $data, $page);
	}

	function simpanaksesmenu()
	{
		$read_priv = $this->input->post('read_priv');
		if ($read_priv == 'on') {
			$read_priv = '1';
		}else{
			$read_priv = '0';
		}
		$edit_priv = $this->input->post('edit_priv');
		if ($edit_priv == 'on') {
			$edit_priv = '1';
		}else{
			$edit_priv = '0';
		}
		$delete_priv = $this->input->post('delete_priv');
		if ($delete_priv == 'on') {
			$delete_priv = '1';
		}else{
			$delete_priv = '0';
		}
		$add_priv = $this->input->post('add_priv');
		if ($add_priv == 'on') {
			$add_priv = '1';
		}else{
			$add_priv = '0';
		}
		$men_id = $this->input->post('men_id');
		$usr_type_id = $this->input->post('usr_type_id');
		$is_delete = '1';
		$created_at = date('Y-m-d');
		$data = [
			'read_priv' => $read_priv,
			'edit_priv' => $edit_priv,
			'delete_priv' => $delete_priv,
			'add_priv' => $add_priv,
			'men_id' => $men_id,
			'usr_type_id' => $usr_type_id,
			'is_delete' => $is_delete,
			'created_at' => $created_at
		];

		$this->user_level_model->addAkses($data);

		redirect('setting/user', 'refresh');
	}

	function hapusaksesmenu()
	{
		$men_id = $this->input->post('men_id');
		$usr_type_id = $this->input->post('usr_type_id');
		$this->user_level_model->hapusAkses($men_id, $usr_type_id);
		$msg = [
			'sukses' => 'Hak akses berhasil dihapus'
		];
		echo json_encode($msg);
	}
}
