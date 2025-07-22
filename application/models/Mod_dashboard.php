<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_id_wp($id_user){
        $this->db->select('id_wp_wr');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $id_user);
        $query = $this->db->get();

        return $query->row();
    }

    function get_count_pending($id_wp_wr){
        $sql = "SELECT COUNT(a.spt_id) as jumlah FROM tbl_pelayanan AS a LEFT JOIN spt AS b ON a.id_billing=b.spt_kode_billing WHERE b.spt_idwpwr = '$id_wp_wr'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }
    function get_pending($id_wp_wr){
        $sql = "SELECT * FROM tbl_pelayanan AS a LEFT JOIN spt AS b ON a.id_billing=b.spt_kode_billing WHERE b.spt_idwpwr = '$id_wp_wr'";
        $query = $this->db->query($sql);
        $row = $query->result();

        return $row;
    }

    // function rekap_perbulan(){
    //     $curr_month = date('Y-m');
    //     $sql = "SELECT TO_CHAR(tgl_pembayaran, 'YYYY-MM') AS month
    //             FROM payment.pembayaran_sptpd
    //             WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2024-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month'
    //             GROUP BY MONTH";
    //     $query = $this->db->query($sql);
    //     $row = $query->result();

    //     return $row;
    // }
    function rekap_perbulan(){
        $sql = "SELECT 
                        CASE EXTRACT(MONTH FROM p.tgl_pembayaran)
                        WHEN 1 THEN 'JAN'
                        WHEN 2 THEN 'FEB'
                        WHEN 3 THEN 'MAR'
                        WHEN 4 THEN 'APRIL'
                        WHEN 5 THEN 'MEI'
                        WHEN 6 THEN 'JUNI'
                        WHEN 7 THEN 'JULI'
                        WHEN 8 THEN 'AGUSTUS'
                        WHEN 9 THEN 'SEPT'
                        WHEN 10 THEN 'OKT'
                        WHEN 11 THEN 'NOV'
                        WHEN 12 THEN 'Des'
                    END AS month,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '1' THEN tagihan END), 0) AS PBJT_Hotel,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '2' THEN tagihan END), 0) AS PBJT_Restoran,
                        COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '3' THEN tagihan END), 0) AS PBJT_Hiburan,
                        COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '4' THEN tagihan END), 0) AS PBJT_Reklame,
                        COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '6' THEN tagihan END), 0) AS PBJT_PJ,
                        COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '7' THEN tagihan END), 0) AS PBJT_Parkir
                FROM 
                    payment.pembayaran_sptpd p
                    LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                        WHERE EXTRACT(YEAR FROM p.tgl_pembayaran) ='2025' 
                    GROUP BY EXTRACT(MONTH FROM p.tgl_pembayaran)
                    ORDER BY EXTRACT(MONTH FROM p.tgl_pembayaran)";
        $query = $this->db->query($sql);
        $row = $query->result();

        return $row;
    }

    function rekap_hotel($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '1'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_resto($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '2'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_hiburan($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '3'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_reklame($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '4'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_pj($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '6'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_parkir($month){
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') = '$month' AND s.spt_jenis_pajakretribusi = '7'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_hotel_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '1'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_resto_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '2'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_hiburan_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '3'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_reklame_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '4'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_pj_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '6'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_parkir_full(){
        $curr_month = date('Y-m');
        $sql = "SELECT SUM(DISTINCT tagihan) AS bayar
                FROM payment.pembayaran_sptpd p
				LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                WHERE TO_CHAR(tgl_pembayaran, 'YYYY-MM') >= '2025-01' AND TO_CHAR(tgl_pembayaran, 'YYYY-MM') <= '$curr_month' AND s.spt_jenis_pajakretribusi = '7'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function rekap_total() {
        $sql = "SELECT 
                COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '1' THEN tagihan END), 0) AS PBJT_Hotel,
                COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '2' THEN tagihan END), 0) AS PBJT_Restoran,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '3' THEN tagihan END), 0) AS PBJT_Hiburan,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '4' THEN tagihan END), 0) AS PBJT_Reklame,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '6' THEN tagihan END), 0) AS PBJT_PJ,
                    COALESCE(SUM(DISTINCT CASE WHEN spt_jenis_pajakretribusi = '7' THEN tagihan END), 0) AS PBJT_Parkir
            FROM 
                payment.pembayaran_sptpd p
                LEFT JOIN spt s ON p.kode_billing=s.spt_kode_billing and CAST(s.spt_periode AS VARCHAR)=p.tahun_pajak
                    WHERE EXTRACT(YEAR FROM p.tgl_pembayaran) ='2025' 
                GROUP BY EXTRACT(YEAR FROM p.tgl_pembayaran)
                ORDER BY EXTRACT(YEAR FROM p.tgl_pembayaran);";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    function data_banding_all(){
        $sql = "SELECT 
                    CASE EXTRACT(MONTH FROM p.tgl_pembayaran)
                        WHEN 1 THEN 'JAN'
                        WHEN 2 THEN 'FEB'
                        WHEN 3 THEN 'MAR'
                        WHEN 4 THEN 'APRIL'
                        WHEN 5 THEN 'MEI'
                        WHEN 6 THEN 'JUNI'
                        WHEN 7 THEN 'JULI'
                        WHEN 8 THEN 'AGUSTUS'
                        WHEN 9 THEN 'SEPT'
                        WHEN 10 THEN 'OKT'
                        WHEN 11 THEN 'NOV'
                        WHEN 12 THEN 'DES'
                    END AS bulan,
                    SUM(CASE WHEN EXTRACT(YEAR FROM p.tgl_pembayaran) = 2025 THEN tagihan ELSE 0 END) AS penerimaan_2025,
                    SUM(CASE WHEN EXTRACT(YEAR FROM p.tgl_pembayaran) = 2024 THEN tagihan ELSE 0 END) AS penerimaan_2024
                FROM 
                    payment.pembayaran_sptpd p
                    LEFT JOIN spt s ON p.kode_billing = s.spt_kode_billing 
                                    AND CAST(s.spt_periode AS VARCHAR) = p.tahun_pajak
                WHERE 
                    EXTRACT(YEAR FROM p.tgl_pembayaran) IN (2024, 2025)
                GROUP BY 
                    EXTRACT(MONTH FROM p.tgl_pembayaran)
                ORDER BY 
                    EXTRACT(MONTH FROM p.tgl_pembayaran);";
        $query = $this->db->query($sql);
        $row = $query->result();

        return $row;
    }

    function data_banding($jenis_pajak){
        $sql = "SELECT 
                    CASE EXTRACT(MONTH FROM p.tgl_pembayaran)
                        WHEN 1 THEN 'JAN'
                        WHEN 2 THEN 'FEB'
                        WHEN 3 THEN 'MAR'
                        WHEN 4 THEN 'APRIL'
                        WHEN 5 THEN 'MEI'
                        WHEN 6 THEN 'JUNI'
                        WHEN 7 THEN 'JULI'
                        WHEN 8 THEN 'AGUSTUS'
                        WHEN 9 THEN 'SEPT'
                        WHEN 10 THEN 'OKT'
                        WHEN 11 THEN 'NOV'
                        WHEN 12 THEN 'DES'
                    END AS bulan,
                    SUM(DISTINCT CASE WHEN EXTRACT(YEAR FROM p.tgl_pembayaran) = 2025 THEN tagihan ELSE 0 END) AS penerimaan_2025,
                    SUM(DISTINCT CASE WHEN EXTRACT(YEAR FROM p.tgl_pembayaran) = 2024 THEN tagihan ELSE 0 END) AS penerimaan_2024
                FROM 
                    payment.pembayaran_sptpd p
                    LEFT JOIN spt s ON p.kode_billing = s.spt_kode_billing 
                                    AND CAST(s.spt_periode AS VARCHAR) = p.tahun_pajak
                WHERE 
                    EXTRACT(YEAR FROM p.tgl_pembayaran) IN (2024, 2025)
                AND spt_jenis_pajakretribusi = $jenis_pajak
                GROUP BY 
                    EXTRACT(MONTH FROM p.tgl_pembayaran)
                ORDER BY 
                    EXTRACT(MONTH FROM p.tgl_pembayaran);";
        $query = $this->db->query($sql);
        $row = $query->result();

        return $row;
    }
}
