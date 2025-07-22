<?php

class Menu_m extends CI_Model
{

    public function _parse_menu($men_level, $under)
    {
        global $i, $j;

        if (!isset($i)) $i = 0;
        if (!isset($j)) $j = 0;
        ++$i;
        $resultname = "result$i";
        $resultcheck = "resultcheck$i";
        $rowcheck = "rowcheck$i";

        $reference = "";
        if ($under) $reference = " and reference='$under' ";
        else $reference = " and (reference is NULL or reference='') ";

        $query = $this->db->query("SELECT * from menu WHERE menu_level='$men_level' $reference and show='1' and COALESCE(is_delete,0)!='1' order by weight asc");
        $query = $query->result();
        return $query;
    }

    public function menu_utama()
    {
        $main_menu = $this->db->select('a.*, b.read_priv, b.edit_priv, b.delete_priv,b.add_priv')
            ->from('menu a')
            ->join('function_access b', 'a.men_id = b.men_id', 'left')
            ->where(['b.usr_type_id' =>  $this->session->userdata('USER_JABATAN'), 'a.show' => '1', 'a.menu_level' => '1'])
            ->order_by('men_id,weight', 'ASC')
            ->get()->result_array();

        return $main_menu;
    }

    public function sub_menu()
    {
        $sub_menu = $this->db->select('a.*, b.read_priv, b.edit_priv, b.delete_priv,b.add_priv')
            ->from('menu a')
            ->join('function_access b', 'a.men_id = b.men_id', 'left')
            ->where(['b.usr_type_id' =>  $this->session->userdata('USER_JABATAN'), 'a.show' => '1', 'a.menu_level' => '2'])
            ->order_by('men_id,weight', 'ASC')
            ->get()->result_array();

        return $sub_menu;
    }

    public function sub_sub_menu()
    {
        $sub_menu = $this->db->select('a.*, b.read_priv, b.edit_priv, b.delete_priv,b.add_priv')
            ->from('menu a')
            ->join('function_access b', 'a.men_id = b.men_id', 'left')
            ->where(['b.usr_type_id' =>  $this->session->userdata('USER_JABATAN'), 'a.show' => '1', 'a.menu_level' => '3'])
            ->order_by('men_id,weight', 'ASC')
            ->get()->result_array();

        return $sub_menu;
    }

    function sum_tax_current($jenis_pajak) {
        $start_current = date('Y-01');
        $current_year = date('Y-m');
        $query = $this->db->query("SELECT SUM(DISTINCT tagihan) AS total_pajak
                                    FROM payment.pembayaran_sptpd p
                                    LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                                    WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '$start_current' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$current_year' AND s.spt_jenis_pajakretribusi = '$jenis_pajak'");
        $query = $query->row();
        return $query;
    }

    function sum_tax_last($jenis_pajak) {
        $start_last = date('Y-01', strtotime('-1 year'));
        $last_year = date('Y-m', strtotime('-1 year'));
        $query = $this->db->query("SELECT SUM(DISTINCT tagihan) AS total_pajak
                                    FROM payment.pembayaran_sptpd p
                                    LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                                    WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '$start_last' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$last_year' AND s.spt_jenis_pajakretribusi = '$jenis_pajak'");
        $query = $query->row();
        return $query;
    }
}
