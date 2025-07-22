<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author		Daniel
 * @copyright 2012
 */
class Navigation extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();

		//load the model	
		$this->load->model('menu_m');
	}

	/**
	 * index page controller
	 */
	function index()
	{
		$page = 'navigation/main';
		echo modules::run('layouts/loadview', $data, $page);
		
	}

	function pendaftaran()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pelayanan';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}
	function pendataan()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendataan';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}
	function penetapan()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Penetapan';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}
	function pembayaran()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pembayaran';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}
	function pembukuan()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pembukuan';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}

	function penagihan()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Penagihan';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}

	function dokumentasi()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-news-paper';
		$data['content'] = 'Pendaftaran-Dokumentasi';
		$page = 'navigation/submenu';
		echo modules::run('layouts/loadview', $data, $page);
	}

	function setting()
	{
		$data['title'] = 'Navigation';
		$data['title_icon'] = 'pe-7s-tools';
		$data['content'] = 'Setting';
		$page = 'navigation/menu';
		echo modules::run('layouts/loadview', $data, $page);
	}
}
