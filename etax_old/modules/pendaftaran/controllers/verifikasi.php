<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * class Rekam_formulir 
 * @author Daniel
 * @package Simpatda
 */
class Verifikasi extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('verifikasi_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{
        $data['title'] = 'Pendaftaran | Verifikasi WP';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendaftaran';
		$data['content_desc'] = 'Menu Verifikasi WP';
		$page = 'pendaftaran/view_verifikasi_wp';
		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('add_rekam_formulir', $data);
	}

	function get_list()
	{
		$list_wp = $this->verifikasi_model->get_wp();
		$data = array();
		$stat_arr = array(
            "Tidak Aktif" => "<span class='text-danger'>Tidak Aktif</span>",
            "Aktif" => "</i><span class='text-success'> Aktif</span>",
        );
		foreach($list_wp as $list_wp){
			$aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"edit\" href=\"javascript:void(0)\" title=\"Edit\" data-href=" . $list_wp->wp_wr_no_form . "><i class=\"fas fa-edit\"> Verifikasi</i></a>";
			$row = array();
            $row[] = $list_wp->wp_wr_no_form;
			$row[] = $list_wp->wp_wr_nama;
			$row[] = $list_wp->wp_wr_almt;
			$row[] = $list_wp->wp_wr_lurah;
			$row[] = $list_wp->wp_wr_camat;
			$row[] = $list_wp->wp_wr_kabupaten;
			$row[] = $stat_arr[$list_wp->ref_stak_ket];
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

	function register($no_form)
	{
		$data['wp_detail'] = $this->verifikasi_model->get_wp_detail($no_form);
		if ($data['wp_detail']->wp_wr_bidang_usaha == '1') {
			$jenis_pajak = '5';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '16') {
			$jenis_pajak = '6';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '11') {
			$jenis_pajak = '4';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '5') {
			$jenis_pajak = '1';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '12') {
			$jenis_pajak = '9';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '17') {
			$jenis_pajak = '8';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '14') {
			$jenis_pajak = '10';
		} else if ($data['wp_detail']->wp_wr_bidang_usaha == '18') {
			$jenis_pajak = '3';
		}
		$data['jenis_pajak'] = $this->verifikasi_model->get_jenis_pajak($jenis_pajak);
		$data['title'] = 'Pendaftaran | Verifikasi WP';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendaftaran';
		$data['content_desc'] = 'Menu Verifikasi WP';
		$page = 'pendaftaran/view_verifikasi_wp_detail';
		echo modules::run('layouts/loadview', $data, $page);
	}
}