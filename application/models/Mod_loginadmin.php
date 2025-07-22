<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_loginadmin extends CI_Model
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
        return $this->db->get("tbl_users");
    }
    function check_db($username)
    {
        $this->db->where("username", $username);
        $this->db->where("is_active", 'Y');
        return $this->db->get("tbl_users");

        // return $this->db->get_where('wp_user', array('npwpd' => $username));
    }

    function check_admin($username)
    {
        $this->db->where("username", $username);
        $this->db->where("is_active", 'Y');
        return $this->db->get("tbl_users");

        // return $this->db->get_where('uptd_user', array('username' => $username));
    }
}

/* End of file Mod_login.php */
