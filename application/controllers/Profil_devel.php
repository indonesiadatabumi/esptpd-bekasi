<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_devel extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_profil_devel');
        // backButtonHandle();
    }

    function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $this->template->load('layoutbackend_devel', 'profil_devel/home');
        }
        
    }

    function editprofil()
    {
        $this->template->load('layoutbackend_devel', 'profil_devel/editprofil');
    }

    function editnik()
    {
        $this->template->load('layoutbackend_devel', 'profil_devel/edit_nik');
    }

    function updateprofil()
    {
        // generate nama file
        $nama = date('Ymd') . rand(0, 999);
        $config['upload_path']   = './assets/foto/user/';
        $config['allowed_types'] = 'jpeg|jpg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            $gambar = $this->upload->data();

            $image_lama = $this->input->post('image_lama');
            if ($image_lama != null){
                unlink('./assets/foto/user/' . $image_lama);
            }

            $id_user = $this->input->post('id');
            $data = [
                'image' => $gambar['file_name']
            ];

            $this->Mod_profil->updateProfil($id_user, $data);
        }
        
        return redirect()->to('/profil');
    }

    function changepassword()
    {
        $this->template->load('layoutbackend_devel', 'profil_devel/changepassword');
    }

    function updatepassword()
    {
        $new_password = $this->input->post('new_password1');
        $wp_id = $this->input->post('wp_id');

        $data = [
            'PASSWORD' => md5($new_password)
        ];

        $this->Mod_profil_devel->updateProfil($wp_id, $data);
        // return redirect()->to('/profil_devel');
        $this->template->load('layoutbackend_devel', 'profil_devel/home', ['notif' => 'Password berhasil diubah.']);
    }

    function update_nik()
    {
        $wp_wr_nik = $this->input->post('wp_wr_nik');
        $wp_wr_nib = $this->input->post('wp_wr_nib');
        $wp_wr_id = $this->input->post('id');

        $data = [
            'wp_wr_nik' => $wp_wr_nik,
            'wp_wr_nib' => $wp_wr_nib
        ];

        $this->Mod_profil->updateNik($wp_wr_id, $data);
        return redirect()->to('/profil');
    }
}
/* End of file Controllername.php */
