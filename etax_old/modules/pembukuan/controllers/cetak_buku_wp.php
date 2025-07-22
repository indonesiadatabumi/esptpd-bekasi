<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pribadi class controller
 * @package Simpatda
 * @author Angga Pratama
 * @version 20121016
 */
class Cetak_buku_wp extends Master_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$data['title'] = 'Cetak Buku Wajib Pajak';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pembukuan';
		$data['content_desc'] = 'Cetak Buku WP';
		$page = 'pembukuan/form_cetak_buku_wp';

		echo modules::run('layouts/loadview', $data, $page);

		// $this->load->view('form_cetak_buku_wp');
	}

	/**
	 * cetak buku wpwr
	 */
	function cetak()
	{
		$this->load->view('pdf_cetak_buku_wp');
	}
}
