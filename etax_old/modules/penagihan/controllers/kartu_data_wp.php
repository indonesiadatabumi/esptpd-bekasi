<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pribadi class controller
 * @package Simpatda
 * @author Daniel Hutauruk
 */
class Kartu_data_wp extends Master_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('kartu_data_wp_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{

		$data['title'] = 'Penagihan | Cetak Daftar STPD';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Penagihan';
		$data['content_desc'] = '';
		$page = 'penagihan/view_daftar_wp';
		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('view_daftar_wp');
	}

	function get_list_wp()
	{
		$this->kartu_data_wp_model->get_list_wp();
	}

	function get_detail()
	{
		$data['row'] = $this->kartu_data_wp_model->get_detail_wp($this->input->get('wp_id'));
		$this->load->view('kartu_data_detail', $data);
	}

	function deskripsi()
	{
		error_reporting(E_ERROR | E_WARNING | E_PARSE);

		$this->load->library('jpgraph');

		//get_data_spt
		$query = $this->kartu_data_wp_model->get_data_spt($this->input->get('wp_id'), $this->input->get('spt_periode'));

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$datay[] = $row->spt_pajak;
				$arr_tgl = explode('-', $row->spt_periode_jual1);
				$datax[] = getNamaBulan($arr_tgl[1], true);
			}

			$graph = $this->jpgraph->barchart($datax, $datay, 'Data SPT', "Bulan", "Rp.", 850, 400);
			// Display the graph
			$graph->Stroke();
		} else {
		}
	}
}
