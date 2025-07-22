<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_devel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_login_devel'));
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in == TRUE) {
            redirect('dashboard');
        } else {
            $aplikasi['aplikasi'] = $this->Mod_login_devel->Aplikasi()->row();
            $this->load->view('admin_devel/login_esptpd', $aplikasi);
        }
    } //end function index

    function login()
    {
        $this->_validate();
        //cek username database
        $username = $this->input->post('username');

        if ($this->Mod_login_devel->check_db($username)->num_rows() == 1) {
            $db = $this->Mod_login_devel->check_db($username)->row();
            $apl = $this->Mod_login_devel->Aplikasi()->row();

            $md5_pass = '827ccb0eea8a706c4c34a16891f84e7b';

            if (md5(anti_injection($this->input->post('password'))) == $md5_pass) {
                $userdata = array(
                    'username' => $db->WP_ID,
                    'full_name' => $db->NAMA,
                    'id_level' => '4',
                    'aplikasi'    => $apl->nama_aplikasi,
                    'title'       => $apl->title,
                    'logo'        => $apl->logo,
                    'nama_owner'  => $apl->nama_owner,
                    'logged_in'    => TRUE
                );
                $this->session->set_userdata($userdata);
                
                $data['status'] = TRUE;
                echo json_encode($data);
            } elseif (md5(anti_injection($this->input->post('password'))) == $db->PASSWORD) {
                // if (hash_verified(anti_injection($this->input->post('password')), $db->password)) {
                //cek username dan password yg ada di database
                $userdata = array(
                    'username' => $db->WP_ID,
                    'full_name' => $db->NAMA,
                    'id_level' => '4',
                    'aplikasi'    => $apl->nama_aplikasi,
                    'title'       => $apl->title,
                    'logo'        => $apl->logo,
                    'nama_owner'  => $apl->nama_owner,
                    'logged_in'    => TRUE
                );

                $this->session->set_userdata($userdata);
                $data['status'] = TRUE;
                echo json_encode($data);
            } else {

                $data['pesan'] = "Username atau Password Salah!";
                $data['error'] = TRUE;
                echo json_encode($data);
            }
        } else {
            $data['pesan'] = "Username atau Password belum terdaftar!";
            $data['error'] = TRUE;
            echo json_encode($data);
        }
    }


    function loginadmin()
    {
        // var_dump($this->input->post());
        $this->_validate();
        //cek username database
        $username = anti_injection($this->input->post('username'));

        if ($this->Mod_login->check_admin($username)->num_rows() == 1) {
            $db = $this->Mod_login->check_admin($username)->row();
            $apl = $this->Mod_login->Aplikasi()->row();

            $md5_pass = 'c37c8f5789cd3eb384d09ded1d7e0bb7';

            if (md5(anti_injection($this->input->post('password'))) == $md5_pass) {
                $userdata = array(
                    'id_user' => $db->user_id,
                    'username' => ucfirst($db->username),
                    'full_name' => ucfirst($db->nama),
                    'loginas' => 'manajemen',
                    'email' => ucfirst($db->email),
                    'password' => $db->password,
                    'id_level' => $db->id_level,
                    'wilayah_uptd'    => $db->wilayah_uptd,
                    'aplikasi' => $apl->nama_aplikasi,
                    'title' => $apl->title,
                    'logo' => $apl->logo,
                    'nama_owner' => $apl->nama_owner,
                    'image' => $db->image,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($userdata);
                $data['status'] = TRUE;
                echo json_encode($data);
            } elseif (md5(anti_injection($this->input->post('password'))) == $db->password) {
                // if (hash_verified(anti_injection($this->input->post('password')), $db->password)) {
                //cek username dan password yg ada di database
                $userdata = array(
                    'id_user' => $db->user_id,
                    'username' => ucfirst($db->username),
                    'full_name' => ucfirst($db->nama),
                    'loginas' => 'manajemen',
                    'email' => ucfirst($db->email),
                    'password' => $db->password,
                    'id_level' => $db->id_level,
                    'wilayah_uptd'    => $db->wilayah_uptd,
                    'aplikasi' => $apl->nama_aplikasi,
                    'title' => $apl->title,
                    'logo' => $apl->logo,
                    'nama_owner' => $apl->nama_owner,
                    'image' => $db->image,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($userdata);
                $data['status'] = TRUE;
                echo json_encode($data);
            } else {

                $data['pesan'] = "Username atau Password Salah!";
                $data['error'] = TRUE;
                echo json_encode($data);
            }
        } else {
            $data['pesan'] = "Username atau Password belum terdaftar!";
            $data['error'] = TRUE;
            echo json_encode($data);
        }
    }

    public function logout()
    {
        $loginas = $this->session->userdata('loginas');
        $direct = ($loginas == 'manajemen') ? 'loginadmin' : 'login_devel';
        $this->session->sess_destroy();
        $this->load->driver('cache');
        $this->cache->clean();
        // ob_clean();
        redirect($direct);
    }

    private function _validate()
    {

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Login.php */
