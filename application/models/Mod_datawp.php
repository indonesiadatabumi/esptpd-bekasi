<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_datawp extends CI_Model
{
    var $table = 'wp_wr';
    var $column_search = array('CAST(wp_wr_id as varchar)', 'CAST(wp_wr_no_urut as varchar)', 'wp_wr_nama', 'wp_wr_almt', 'wp_wr_lurah', 'wp_wr_bidang_usaha');
    var $column_order = array('wp_wr_id', 'wp_wr_no_urut', 'wp_wr_nama', 'wp_wr_almt', 'wp_wr_lurah', 'wp_wr_bidang_usaha');
    var $order = array('wp_wr_id' => 'asc');
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        // $this->db->from('barang');
        $this->db->select('wp_wr_id, wp_wr_no_urut, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_bidang_usaha, wp_wr_camat, ku.ref_kodus_nama');
        $this->db->from('wp_wr wp');
        $this->db->join('ref_kode_usaha ku', 'CAST(ku.ref_kodus_id as varchar)=wp.wp_wr_bidang_usaha');
        $this->db->where('wp.wp_wr_status_aktif', 't');
        // $this->db->order_by("wp_wr_no_urut", "asc");
        // return $this->db->get()->result_array();

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _get_datatables_query_uptd($wilayah_uptd)
    {

        // $this->db->from('barang');
        $this->db->select('wp_wr_id, wp_wr_no_urut, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_bidang_usaha, wp_wr_camat, ku.ref_kodus_nama');
        $this->db->from('wp_wr wp');
        $this->db->join('ref_kode_usaha ku', 'CAST(ku.ref_kodus_id as varchar)=wp.wp_wr_bidang_usaha');
        $this->db->where('wp.wp_wr_kd_camat', $wilayah_uptd);
        $this->db->where('wp.wp_wr_status_aktif', 't');
        // $this->db->order_by("wp_wr_no_urut", "asc");
        // return $this->db->get()->result_array();

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables_uptd($wilayah_uptd)
    {
        $this->_get_datatables_query_uptd($wilayah_uptd);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered_uptd($wilayah_uptd)
    {
        $this->_get_datatables_query_uptd( $wilayah_uptd);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        // $this->db->from('barang');
        $this->db->select('wp_wr_id, wp_wr_no_urut, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_bidang_usaha, wp_wr_camat');
        $this->db->from('wp_wr wp');
        $this->db->join('ref_kode_usaha ku', 'CAST(ku.ref_kodus_id as varchar)=wp.wp_wr_bidang_usaha');
        $this->db->where('wp.wp_wr_status_aktif', 't');

        return $this->db->count_all_results();
    }

    function count_all_uptd($wilayah_uptd)
    {
        // $this->db->from('barang');
        $this->db->select('wp_wr_id, wp_wr_no_urut, wp_wr_nama, wp_wr_almt, wp_wr_lurah, wp_wr_bidang_usaha, wp_wr_camat');
        $this->db->from('wp_wr wp');
        $this->db->join('ref_kode_usaha ku', 'CAST(ku.ref_kodus_id as varchar)=wp.wp_wr_bidang_usaha');
        $this->db->where('wp.wp_wr_kd_camat', $wilayah_uptd);
        $this->db->where('wp.wp_wr_status_aktif', 't');

        return $this->db->count_all_results();
    }

    function insert_barang($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

    function update_barang($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('barang', $data);
    }

    function get_brg($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('barang')->row();
    }

    function delete_brg($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function get_wrnama($noreg)
    {
        $this->db->where('wp_wr_no_urut', $noreg);
        return $this->db->get('wp_wr')->row();
    }

    function get_spt($wpid)
    {
        $this->db->select("a.spt_id, a.spt_nomor, to_char(a.spt_tgl_entry, 'DD-MM-YYYY') as spt_tgl_entri, a.spt_periode, 
                        to_char(a.spt_periode_jual1, 'DD-MM-YYYY') as spt_periode_jual1, 
                        to_char(a.spt_periode_jual2, 'DD-MM-YYYY') as spt_periode_jual2, a.spt_pajak, a.spt_jenis_pajakretribusi, 
                        a.spt_kode_billing, status_bayar, b.spt_dt_id", False);
        $this->db->from('spt a');
        $this->db->join('spt_detail b', 'a.spt_id=b.spt_dt_id_spt');
        $this->db->where('a.spt_idwpwr', $wpid);
        $this->db->order_by('a.spt_id desc');

        $query = $this->db->get();
        return $query->result();
    }
}
