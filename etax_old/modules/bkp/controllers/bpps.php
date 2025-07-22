<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Bpps Controller
 * @package Simpatda
 * @author Daniel Hutauruk
 * @version 20121112
 */
class Bpps extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('bpps_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{

		$data['title'] = 'Pembayaran | BPPS';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pembayaran';
		$data['content_desc'] = '';
		$page = 'bkp/form_bpps';
		echo modules::run('layouts/loadview', $data, $page);


		// $this->load->view('form_bpps');
	}

	/**
	 * export to pdf
	 */
	function bpps_pdf()
	{
		//data pemda
		$pemda = $this->common_model->get_query('*', 'data_pemerintah_daerah');
		$data['pemda'] = $pemda->row();
		$data['arr_data'] = $this->bpps_model->get_list();

		//insert history log
		$this->common_model->history_log("bkp", "P", "Cetak BPPS : " . $_GET['fDate'] . " | " . $_GET['tDate'] . " | " . $_GET['koderek']);

		$this->load->view('pdf_cetak_bpps', $data);
	}
}
