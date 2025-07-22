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
        $sql = "SELECT SUM(total_bayar) as total_bayar FROM payment_retribusi_pasar WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_user IS NOT NULL";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getJumlahBayar($tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT COUNT(total_bayar) as jumlah_bayar FROM payment_retribusi_pasar WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_user IS NOT NULL";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getTotalBayarTiapPasar($id, $tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT SUM(total_bayar) as total_bayar FROM payment_retribusi_pasar WHERE DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_user='$id'";
        $builder = db_connect()->query($sql);
        $query = $builder->getRow();
        return $query;
    }

    public function getHasilRekap($filter)
    {
        $start = $filter['start'];
        $end = $filter['end'];
        $id_user = $filter['id_user'];

        $where = "WHERE a.id_user IS NOT NULL";
        if ($id_user != '0'){
            $where = "WHERE a.id_user = '$id_user'";
        }

        if ($start != '') {
            $where .= " AND DATE(tgl_pembayaran) >= '$start'";
        }
        
        if ($end != '') {
            $where .= " AND DATE(tgl_pembayaran) <= '$end'";
        }
        $sql = "SELECT a.npwrd, a.kd_billing, b.nm_wp_wr, a.tgl_pembayaran, a.total_bayar, c.fullname FROM payment_retribusi_pasar AS a LEFT JOIN app_reg_wr AS b ON a.npwrd=b.npwrd LEFT JOIN user_pasar AS c ON a.id_user::int=c.id_user $where ORDER BY a.tgl_pembayaran";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getDataBayarTiapPasar($id_user, $tgl_awal, $tgl_akhir)
    {
        $sql = "SELECT a.npwrd, b.nm_wp_wr, a.tgl_pembayaran, a.total_bayar, c.fullname, d.invoice_id 
                FROM payment_retribusi_pasar AS a 
                LEFT JOIN app_reg_wr AS b ON a.npwrd=b.npwrd 
                LEFT JOIN user_pasar AS c ON a.id_user::int=c.id_user
                LEFT JOIN app_qris_retribusi AS d ON a.kd_billing=d.kode_billing 
                WHERE a.id_user = '$id_user' AND DATE(tgl_pembayaran) BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY a.tgl_pembayaran";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }
}
