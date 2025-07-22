<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_konfirmasi_op extends CI_Model
{

    function cari_data_op($npwpd)
    {
        $this->db->select('a.*, b.ref_kodus_nama');
        $this->db->join('ref_kode_usaha b', 'a.ref_kodus_kode=b.ref_kodus_kode');
        $this->db->where("a.npwprd", $npwpd);
        $this->db->from('v_wp_wr a');
        $query = $this->db->get();

        return $query->row();
    }

    function updateNIK($wp_wr_id, $data)
    {
        $this->db->where('wp_wr_id', $wp_wr_id);
        return $this->db->update('wp_wr', $data);
    }
}

/* End of file Mod_login.php */
