<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_profil extends CI_Model
{

    function updateProfil($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('tbl_users', $data);

        return  $this->db->affected_rows();
    }

    function updateNik($id, $data)
    {
        $this->db->where('wp_wr_id', $id);
        $this->db->update('wp_wr', $data);

        return  $this->db->affected_rows();
    }
}
