<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_verifikasi_wp extends CI_Model
{
    function _get_table_menu()
    {

        $this->db->select('g.noid, g.npwpd, wp.wp_wr_nama nama, wp.wp_wr_no_urut, wp.wp_wr_bidang_usaha');
        $this->db->join('v_wp_wr wp', 'g.npwpd=wp.npwprd');
        $this->db->where("g.groupid", $this->session->userdata('id_user'));
        $this->db->from('data_group g');
        $query = $this->db->get();

        return $query->result();
    }

    function get_datatables()
    {
        $this->db->distinct();
        $this->db->select('a.*, b.nama_jenis_pemilik');
        $this->db->from('MASTER_WP a');
        $this->db->join('ref_jenis_pemilik b', 'a.JNS_PEMILIK=b.id_jenis_pemilik', 'left');
        $this->db->order_by('a.TGL_REKAM', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    function getDataDetail($nik)
    {
        $this->db->select('a.*, b.nama_jenis_pemilik, c.ref_kodus_nama');
        $this->db->from('MASTER_WP a');
        $this->db->join('ref_jenis_pemilik b', 'a.JNS_PEMILIK = b.id_jenis_pemilik');
        $this->db->join('ref_kode_usaha c', 'a.BIDANG_USAHA = CAST(c.ref_kodus_id AS TEXT)', 'left');
        $this->db->where("a.WP_ID", $nik);

        $query = $this->db->get();
        return $query->row();
    }

    function getDataLampiran($jns_lamp, $nik)
    {
        $this->db->select('jns_lamp, name');
        $this->db->from('tbl_lampiran_wp_baru');
        $this->db->where("wp_id", $nik);
         $this->db->where("jns_lamp", $jns_lamp);
        
        $query = $this->db->get();
        return $query->row();
    }

    function updateStatusWP($wp_id,$data) {
        // $data = array(
        //     'STATUS' => '1',
        //     'STATUS_KASUBID' => '1',
        //     'STATUS_KABID' => '1'
        // );
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->update('MASTER_WP', $data);
    }

    function updateStatusUserWP($wp_id) {
        $default = '12345';
        $password = md5($default);
        $data = array(
            'PASSWORD' => $password,
            'STATUS' => '1'
        );
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->update('TBL_USER_WP_BARU', $data);
    }

    function updateStatusNotif($wp_id) {
        $data = array(
            'status' => '1'
        );
        // Menambahkan beberapa kondisi
        $this->db->where('ticket_id', $wp_id);
        return $this->db->update('notification', $data);
    }

    function batalStatusWP($wp_id) {
        $data = array(
            'STATUS' => '0'
        );
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->update('MASTER_WP', $data);
    }

    function batalStatusUserWP($wp_id) {
        $data = array(
            'PASSWORD' => Null,
            'STATUS' => '0'
        );
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->update('TBL_USER_WP_BARU', $data);
    }

    function hapusWP($wp_id) {
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->delete('MASTER_WP');
    }

    function hapusUserWP($wp_id) {
        // Menambahkan beberapa kondisi
        $this->db->where('WP_ID', $wp_id);
        return $this->db->delete('TBL_USER_WP_BARU');
    }

    function hapusLampiranWP($wp_id) {
        // Menambahkan beberapa kondisi
        $this->db->where('wp_id', $wp_id);
        return $this->db->delete('tbl_lampiran_wp_baru');
    }
}
?>