<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_login_devel extends CI_Model
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
        // $this->db->where("WP_ID", $username);
        // $this->db->where("STATUS", '1');
        // return $this->db->get("TBL_USER_WP_BARU");
        $this->db->select('a.*, b.NAMA');
        $this->db->join('MASTER_WP b', 'a.WP_ID=b.WP_ID');
        $this->db->where("a.WP_ID", $username);
        $this->db->where("a.STATUS", '1');
        $this->db->from('TBL_USER_WP_BARU a');

        return $this->db->get();

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
