<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * class Info Wp 
 * @author Adon
 * @package Simpatda
 */
class Info_wp extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('info_wp_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{
        $data['title'] = 'Pendaftaran | Info Rinci WP';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendaftaran';
		$data['content_desc'] = 'Cetak Info Rinci WP';
		$page = 'pendaftaran/view_info_wp';
		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('add_rekam_formulir', $data);
	}

	function get_list()
	{
		$list_wp = $this->info_wp_model->info_wp_all();
		$data = array();

		foreach($list_wp as $list_wp){
			$aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"cetak\" href=\"javascript:void(0)\" title=\"Edit\" target=\"_blank\" data-href=" . $list_wp->wp_wr_nik . "><i class=\"fas fa-print\"> Cetak</i></a>";
			$row = array();
			$row[] = $list_wp->wp_wr_nama_milik;
			$row[] = $list_wp->wp_wr_almt_milik;
			$row[] = $list_wp->wp_wr_lurah_milik;
			$row[] = $list_wp->wp_wr_camat_milik;
			$row[] = $list_wp->wp_wr_kabupaten_milik;
			$row[] = $list_wp->wp_wr_nik;
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

	function cetak($wp_wr_nik)
	{
		$data['wp'] = $this->info_wp_model->info_wp($wp_wr_nik);
		$data['wp_detail'] = $this->info_wp_model->info_wp_detail($wp_wr_nik);
		$this->load->view('cetak_info_wp', $data);
	}
}