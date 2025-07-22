<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rekap_pendapatan_daerah class controller
 * @package Simpatda
 * @author Angga Pratama
 */
class Rekap_pendapatan_daerah extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('pembukuan_model');
		$this->load->model('realisasi_model');
		$this->load->model('common_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$arr_pejabat_daerah = array("" => "(silahkan pilih...)");
		$data['pejabat_daerah'] = array_merge($arr_pejabat_daerah, $this->pembukuan_model->get_pejabat_daerah());
		// $this->load->view('form_rekap_pendapatan_daerah', $data);

		$data['title'] = 'Cetak Laporan Pendapatan  Daerah';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pembukuan';
		$data['content_desc'] = 'Cetak Rekap Laporan Pendapatan Daerah';
		$page = 'pembukuan/form_rekap_pendapatan_daerah';

		echo modules::run('layouts/loadview', $data, $page);
	}

	/**
	 * save excel
	 */
	function save_excel()
	{
		$data['realisasi_model'] = $this->realisasi_model;

		var_dump($data);
		//insert history log
		$this->common_model->history_log("pembukuan", "P", "Cetak rekap laporan pendapatan daerah : " . $_GET['tgl_proses']);

		$this->load->view('xls_rekap_pendapatan_daerah', $data);
	}
}
