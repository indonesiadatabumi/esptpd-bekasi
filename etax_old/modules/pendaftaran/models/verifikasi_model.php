<?php 
/**
 * class Rekam_formulir_model
 * @package Simpatda
 * @author Daniel Hutauruk
 */
class Verifikasi_model extends CI_Model {
	
    public function get_wp()
    {
        $this->db->select('wp_wr_no_form, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_camat,wp_wr_kabupaten,ref_stak_ket');
        $this->db->from('wp_wr');
        $this->db->join('ref_status_aktif', 'ref_status_aktif.ref_stak_id = wp_wr.wp_wr_status_aktif');
        $this->db->order_by('wp_wr_no_form', 'DESC');

        return $this->db->get()->result();
    }

    public function get_wp_detail($no_form)
    {
        $this->db->select('wp_wr_no_form, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_camat,wp_wr_kabupaten,wp_wr_status_aktif,wp_wr_bidang_usaha,wp_wr_lamp');
        $this->db->from('wp_wr');
        $this->db->where('wp_wr_no_form', $no_form);

        return $this->db->get()->row();
    }

    public function get_jenis_pajak($jenis_pajak)
    {
        $this->db->select('ref_bidang_usaha_nama');
        $this->db->from('ref_bidang_usaha');
        $this->db->where('ref_bidang_usaha_id', $jenis_pajak);

        return $this->db->get()->row();
    }

}