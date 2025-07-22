<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * The My Controller class
 */
class Master_Controller extends MX_Controller
{
	var $data = array();

	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();

		$segment = $this->uri->segment(0);
		if ($this->session->userdata('USER_ID') == null && $segment != "login")
			redirect('login');
	}

	function loadview($data = NULL, $page = NULL)
	{
		$this->load->view('_layouts/head', $data);
		$this->load->view('_layouts/navbar', $data);
		if ($page != NULL) {
			$this->load->view($page, $data);
		} else {
			$this->load->view('navigation', $data);
		}
		$this->load->view('_layouts/footer', $data);
	}
}
