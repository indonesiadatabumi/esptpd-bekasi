<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Main class controller
 * @author Daniel Hutauruk
 */
class Main extends Master_Controller
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
	}

	/**
	 * Index Page for this controller.
	 */
	function index()
	{
		// $this->load->view('main', $this->data);

		$data['title'] = 'main | Navigation';
		$data['title_icon'] = 'pe-7s-photo-gallery';
		$data['content'] = 'Navigation';
		$data['content_desc'] = 'Navigation Menu merupakan shortcut untuk masuk ke menu Pengelolaan Pajak Daerah.';
		// $data['menu'] = $this->menu_m->_parse_menu(1, '');


		// var_dump($data['sub_menu']);
		$page = '';


		echo modules::run('layouts/loadview', $data, $page);
	}

	/**
	 * home controller
	 */
	function home()
	{
		$this->load->view('home');
	}

	/**
	 * change password controller
	 */
	function change_password()
	{
		$this->load->view("change_password");
	}

	/**
	 * function to save change password
	 */
	function save_password()
	{
		$this->load->model('operator_model');
		$return = $this->operator_model->update_password();

		if ($return) {
			echo json_encode(array('status' => true, 'msg' => 'Password berhasil disimpan'));
		} else {
			echo json_encode(array('status' => false, 'msg' => 'Password gagal disimpan'));
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/mainphp */