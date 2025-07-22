<?php

namespace App\Models;

use CodeIgniter\Model;

class getModel extends Model
{
    public function getUsername($username)
    {
        $sql = "SELECT * FROM app_user WHERE username = '$username'";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getTotalBayar($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT SUM(sptpd_yg_dibayar) as total_bayar FROM payment.pembayaran_sptpd WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND substr(kd_rekening, 1,3) ='411' AND status_reversal IS NULL";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getJumlahBayar($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT COUNT(sptpd_yg_dibayar) as jumlah_bayar FROM payment.pembayaran_sptpd WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND substr(kd_rekening, 1,3) ='411' AND status_reversal IS NULL";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getTotalBayarTiapPajak($kd_rekening, $tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT SUM(sptpd_yg_dibayar) as total_bayar FROM payment.pembayaran_sptpd WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kd_rekening='$kd_rekening' AND status_reversal IS NULL";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getHasilRekap($filter)
    {
        $start = $filter['start'];
        $end = $filter['end'];
        $kd_rekening = $filter['kd_rekening'];
        
        if ($kd_rekening == '0') {
            $where = "WHERE a.status_reversal IS NULL AND substr(kd_rekening, 1,3) ='411'";
        }else{
            $where = "WHERE a.status_reversal IS NULL AND kd_rekening ='$kd_rekening'";
        }
        
        if ($start != '') {
            $where .= " AND DATE(tgl_pembayaran) >= '$start'";
        }
        
        if ($end != '') {
            $where .= " AND DATE(tgl_pembayaran) <= '$end'";
        }
        $sql = "SELECT a.*, b.wp_wr_nama, b.wp_wr_almt FROM payment.pembayaran_sptpd AS a LEFT JOIN v_wp_wr AS b ON a.npwprd=b.npwprd $where ORDER BY a.tgl_pembayaran";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getDataBayarTiapPajak($kd_rekening, $tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT a.*, b.wp_wr_nama, b.wp_wr_almt FROM payment.pembayaran_sptpd AS a LEFT JOIN v_wp_wr AS b ON a.npwprd=b.npwprd WHERE a.kd_rekening = '$kd_rekening' AND DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY a.tgl_pembayaran";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }
}
