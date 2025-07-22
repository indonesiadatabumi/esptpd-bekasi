<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Badan_usaha controller
 * @package Simpatda
 * @author Daniel Hutauruk
 * @version 20121016
 */
class Cetak_kartu_npwpd extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('cetak_kartu_npwpd_model');
		$this->load->model('common_model');
	}

	/**
	 * index page controller
	 */
	function index()
	{

		$data['title'] = 'main | Pendaftaran';
		$data['title_icon'] = 'pe-7s-photo-gallery';
		$data['content'] = 'Cetak Kartu NPWPD';
		$data['content_desc'] = '';
		$page = 'pendaftaran/view_cetak_kartu_npwpd';

		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('view_cetak_kartu_npwpd', $data, $page);
	}

	/**
	 * get list page controller
	 */
	function get_list()
	{
		$list_npwpd = $this->cetak_kartu_npwpd_model->get_list();
		$data = array();
		$no = 1;
		foreach($list_npwpd as $list_npwpd){
			$aksi = "<a class=\"btn btn-sm btn-outline-primary\" id=\"btn_print\" href=\"javascript:void(0)\" title=\"Print\" data-href=" . $list_npwpd->wp_wr_id . "><i class=\"fas fa-print\"> Print</i></a>";
			$row = array();
			$row[] = $no++;
            $row[] = $list_npwpd->wp_wr_nik;
			$row[] = $list_npwpd->npwprd;
			$row[] = $list_npwpd->wp_wr_nama_milik;
			$row[] = $list_npwpd->wp_wr_nama;
			$row[] = $list_npwpd->wp_wr_almt;
			$row[] = $list_npwpd->wp_wr_lurah;
			$row[] = $list_npwpd->wp_wr_camat;
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
	 * cetak npwpd
	 */
	function cetak_npwpd()
	{
		$query = $this->common_model->get_query('*', 'data_pemerintah_daerah');
		$data['pemda'] = $query->row();
		$data['pejabat'] = $this->cetak_kartu_npwpd_model->get_kadis();
		$wp = $this->cetak_kartu_npwpd_model->get_wp();
		$data['wp'] = $wp;

		//insert history log ($module, $action, $description)
		$this->common_model->history_log("pendaftaran", "P", "Print Kartu WP " . $wp->wp_wr_id . " | " . $wp->npwprd . " | " . $wp->wp_wr_nama);

		$this->load->view('pdf_cetak_kartu_npwpd', $data);
	}
}
