<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tunggakan class controller
 * @package Simpatda
 * @author Daniel Hutauruk
 */
class Tunggakan extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('common_model', 'objek_pajak_model', 'tunggakan_model'));
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$kecamatan = $this->common_model->get_kecamatan();
		//get kecamatan
		$arr_kecamatan = array();
		$arr_kecamatan['0'] = "-- Pilih Kecamatan --";

		foreach ($kecamatan as $row) {
			$arr_kecamatan[$row->camat_id] = $row->camat_kode . ' | ' . $row->camat_nama;
		}
		$data['kecamatan'] = $arr_kecamatan;
		$data['jenis_pajak'] = $this->objek_pajak_model->get_jenis_pajak_by_operator(true);
		$data['pejabat_daerah'] = $this->get_pejabat_daerah();

		$data['title'] = 'Penagihan | Tunggakan';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Penagihan';
		$data['content_desc'] = '';
		$page = 'penagihan/view_tunggakan';
		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('view_tunggakan', $data);
	}

	/**
	 * get list tunggakan
	 */
	function get_list()
	{
		$this->tunggakan_model->get_list();
	}

	/**
	 * cetak tunggakan
	 */
	function cetak()
	{
		$mengetahui = $this->input->get('mengetahui');
		$pemeriksa = $this->input->get('pemeriksa');

		//data mengetahui
		$dt_mengetahui = $this->common_model->get_query('*', 'v_pejabat_daerah', "pejda_id='$mengetahui'");
		$data['mengetahui'] = array();
		if ($dt_mengetahui->num_rows() > 0) {
			$data['mengetahui'] = $dt_mengetahui->row();
		}

		//data pemeriksa
		$dt_pemeriksa = $this->common_model->get_query('*', 'v_pejabat_daerah', "pejda_id='$pemeriksa'");
		$data['pemeriksa'] = array();
		if ($dt_pemeriksa->num_rows() > 0) {
			$data['pemeriksa'] = $dt_pemeriksa->row();
		}

		if ($this->input->get('camat_id'))
			$data['kecamatan'] = $this->common_model->get_record_value('camat_nama', 'kecamatan', "camat_id='" . $this->input->get('camat_id') . "'");

		$data['jenis_pajak'] = $this->common_model->get_record_value('ref_jenparet_ket', 'ref_jenis_pajak_retribusi', "ref_jenparet_id='" . $this->input->get('jenis_pajak') . "'");
		$data['arr_data'] = $this->tunggakan_model->get_daftar_tunggakan();

		//insert history log
		$this->common_model->history_log("penagihan", "P", "Print Daftar Tungggakan");

		$this->load->view('pdf_tunggakan', $data);
	}

	/**
	 * get pejabat daerah
	 */
	function get_pejabat_daerah()
	{
		$pejabat_daerah = $this->common_model->get_pejabat_daerah();
		$arr_pejabat = array();
		$arr_pejabat['0'] = '--';
		if (count($pejabat_daerah) > 0) {
			foreach ($pejabat_daerah as $row) {
				$arr_pejabat[$row->pejda_id] = $row->pejda_nama . ' / ' . $row->ref_japeda_nama;
			}
		}

		return $arr_pejabat;
	}
}
