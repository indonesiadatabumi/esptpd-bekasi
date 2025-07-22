<?php 
/**
 * class Info_wp_model
 * @package Simpatda
 * @author Saichul Huda
 */
class Info_wp_model extends CI_Model {
	
    public function info_wp_all()
    {
        $sql = "SELECT DISTINCT wp_wr_id, wp_wr_nama_milik, wp_wr_almt_milik, wp_wr_lurah_milik, wp_wr_camat_milik, wp_wr_kabupaten_milik, wp_wr_nik
					FROM wp_wr ORDER BY wp_wr_id DESC";
		$query = $this->db->query($sql);

        return $query->result();
    }

    public function info_wp($wp_wr_nik)
    {
        $sql = "SELECT DISTINCT wp_wr_nama_milik, wp_wr_almt_milik, wp_wr_lurah_milik, wp_wr_camat_milik, wp_wr_kabupaten_milik, wp_wr_telp_milik, wp_wr_nik
					FROM wp_wr
                    WHERE wp_wr_nik='$wp_wr_nik'";
		$query = $this->db->query($sql);

        return $query->row();
    }

    public function info_wp_detail($wp_wr_nik)
    {
        $sql = "SELECT  wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_camat, wp_wr_kabupaten, wp_wr_telp, ref_kodus_nama
					FROM wp_wr AS a
                    LEFT JOIN ref_kode_usaha AS b ON a.wp_wr_bidang_usaha=b.ref_kodus_id::varchar
                    WHERE wp_wr_nik='$wp_wr_nik'";
		$query = $this->db->query($sql);

        return $query->result();
    }

}