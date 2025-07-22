<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_profil_devel extends CI_Model
{

    function updateProfil($wp_id, $data)
    {
        $this->db->where('WP_ID', $wp_id);
        $this->db->update('TBL_USER_WP_BARU', $data);

        return  $this->db->affected_rows();
    }

    function updateNik($id, $data)
    {
        $this->db->where('wp_wr_id', $id);
        $this->db->update('wp_wr', $data);

        return  $this->db->affected_rows();
    }
}
