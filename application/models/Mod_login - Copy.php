<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_login extends CI_Model
{
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function Auth($username, $password)
    {
        //menggunakan active record . untuk menghindari sql injection
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $this->db->where("is_active", 'Y');
        return $this->db->get("uptd_user_espt");
    }
    function check_db($username)
    {
        return $this->db->get_where('wp_user_espt', array('npwpd' => $username));
        // return $this->db->get_where('tbl_user', array('username' => $username));
    }

    function check_admin($username)
    {
        return $this->db->get_where('uptd_user_espt', array('username' => $username));
        // return $this->db->get_where('tbl_user', array('username' => $username));
    }
}

/* End of file Mod_login.php */
