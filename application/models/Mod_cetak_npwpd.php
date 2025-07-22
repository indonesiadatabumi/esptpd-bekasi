<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_cetak_npwpd extends CI_Model
{

    var $table = 'spt';
    var $column_order = array('spt_nomor', 'spt_tgl_entry', 'spt_periode_jual1', 'spt_id');
    var $column_search = array('spt_nomor', 'spt_kode_billing',  'status_bayar');
    var $order = array('spt_id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function _get_esptpd_menu()
    {

        $this->db->select('a.wp_wr_nik, b.npwprd, b.wp_wr_nama, b.wp_wr_no_urut, b.wp_wr_bidang_usaha ');
        $this->db->join('v_wp_wr b', 'a.wp_wr_id=b.wp_wr_id');
        $this->db->where("a.wp_wr_nik", $this->session->userdata('username'));
        $this->db->from('wp_wr a');

        $query = $this->db->get();
        return $query->result();
    }

    function get_npwpd($wp_wr_nik)
    {

        $this->db->select('b.npwprd');
        $this->db->join('v_wp_wr b', 'a.wp_wr_id=b.wp_wr_id');
        $this->db->where("a.wp_wr_nik", $wp_wr_nik);
        $this->db->from('wp_wr a');
        $query = $this->db->get();

        $nama = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $nama =  $row->npwprd;
        }
        return $nama;
    }

    function get_namawp($npwpd)
    {

        $this->db->select('wp_wr_nama');
        $this->db->where("npwprd", $npwpd);
        $this->db->from('v_wp_wr');
        $query = $this->db->get();

        $nama = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $nama =  $row->wp_wr_nama;
        }
        return $nama;
    }

    function get_wp_wr($npwpd)
    {

        $this->db->select('wp_wr_almt, wp_wr_camat, wp_wr_tgl_kartu');
        $this->db->where("npwprd", $npwpd);
        $this->db->from('v_wp_wr');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
        }
        return $row;
    }

    function get_kadis()
    {
        $where = array(
            'pejda_jabatan' => '46',
            'pejda_aktif' => 'TRUE'
        );

        $query = $this->db->get_where('v_pejabat_daerah', $where);
        return $query->row();
    }
}
