<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_pembayaran extends CI_Model
{
    var $table = 'payment.pembayaran_sptpd';
    var $column_search = array('kode_billing');
    var $column_order = array('kode_billing');
    var $order = array('tgl_pembayaran' => 'desc');
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    private function _get_datatables_query()
    {
        $this->db->distinct();
        $this->db->select('s.status_bayar, p.*');
        $this->db->from('spt s');
        $this->db->join('payment.pembayaran_sptpd p', 's.spt_kode_billing=p.kode_billing');
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

    // function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if ($_POST['length'] != -1)
    //         $this->db->limit($_POST['length'], $_POST['start']);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    function get_datatables($jenis_pajak, $start, $end)
    {
        $this->db->distinct();
        $this->db->select('s.status_bayar, p.tagihan, p.denda, p.kode_billing, p.npwprd, p.tahun_pajak, p.tgl_pembayaran, p.sptpd_yg_dibayar, p.ntp, q.jns_billing, q.va_number');
        $this->db->from('spt s');
        $this->db->join('payment.pembayaran_sptpd p', 's.spt_kode_billing=p.kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak', 'left');
        $this->db->join('qris_va_spt q', "p.kode_billing=q.kode_billing", 'left');
        $this->db->where('DATE(tgl_pembayaran) >=', $start);
        $this->db->where('DATE(tgl_pembayaran) <=', $end);
        if($jenis_pajak != ''){
            $this->db->where('s.spt_jenis_pajakretribusi', $jenis_pajak);
        }
        $this->db->where('status_reversal ISNULL');
        $this->db->order_by('tgl_pembayaran', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->select('s.status_bayar, p.*');
        $this->db->from('spt s');
        $this->db->join('payment.pembayaran_sptpd p', 's.spt_kode_billing=p.kode_billing');

        return $this->db->count_all_results();
    }

    function insert_bayar($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

    function update_bayar($id, $data)
    {
        $this->db->where('spt_id', $id);
        $this->db->update('spt', $data);
    }


    function update_statpayment($id, $data)
    {
        $this->db->where('spt_kode_billing', $id);
        $this->db->update('spt', $data);
    }

    function update_detpayment($id, $data)
    {
        $this->db->where('kode_billing', $id);
        $this->db->update('payment.pembayaran_sptpd', $data);
    }

    function get_bayar($id)
    {
        $this->db->where('spt_id', $id);
        return $this->db->get('spt')->row();
    }

    function delete_bayar($id, $table)
    {
        $this->db->where('spt_id', $id);
        $this->db->delete($table);
    }

    function metode_bayar($kode_billing)
    {
        $this->db->select('jns_billing, va_number');
        $this->db->from('qris_va_spt');
        $this->db->where('kode_billing', $kode_billing);
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->row();
    }
}
