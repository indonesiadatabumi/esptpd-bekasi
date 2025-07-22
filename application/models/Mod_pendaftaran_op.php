<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pendaftaran_op extends CI_Model
{

    function get_next_number_wp($jenis = 'p')
    {

        $this->db->select('COALESCE(MAX(wp_wr_no_urut)::INT,0) + 1 as next_nomor_urut');
        $this->db->from('wp_wr');
        $this->db->where('wp_wr_jenis', $jenis);
        $query = $this->db->get();

        $next_nomor_urut = '';
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $next_nomor_urut =  $row->next_nomor_urut;
            if (strlen($next_nomor_urut) < 7) {
                $selisih = 7 - strlen($next_nomor_urut);
                for ($i = 1; $i <= $selisih; $i++) {
                    $next_nomor_urut = "0" . $next_nomor_urut;
                }
            }
        }

        return $next_nomor_urut;
    }

    /**
     * get kecamatan
     */
    function get_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->order_by('camat_kode', 'ASC');

        // if ($this->session->userdata('USER_SPT_CODE') != "10")
        //     $this->db->where('camat_kode', $this->session->userdata('USER_SPT_CODE'));

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * get kelurahan
     */
    function get_kelurahan($id_kecamatan)
    {
        $this->db->select('lurah_id, lurah_kode, lurah_nama');
        $this->db->from('kelurahan');
        $this->db->where(array('lurah_kecamatan' => $id_kecamatan));
        $this->db->order_by('lurah_kode', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_kegiatan_usaha($pajakid)
    {
        $result = array();

        $this->db->from('ref_kegiatan_usaha');
        $this->db->where('pajak_id', $pajakid);
        $this->db->order_by('ref_kegus_id', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_data_wp($nik){
        $this->db->select('a.*, b.nama_jenis_pemilik');
        $this->db->join('ref_jenis_pemilik b', 'a.JNS_PEMILIK=b.id_jenis_pemilik');
        $this->db->from('MASTER_WP a');
        $this->db->where('a.WP_ID', $nik);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_kamar()
    {
        $this->db->from('ref_jenis_kamar');
        // $this->db->where('pajak_id', $pajakid);
        $this->db->order_by('ref_jenmartel_id', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_gol_hotel()
    {
        $this->db->from('ref_gol_hotel');
        // $this->db->where('pajak_id', $pajakid);
        $this->db->order_by('ref_kode', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function get_nm_kelurahan($lurah_id)
    {
        $this->db->select('lurah_nama');
        $this->db->from('kelurahan');
        $this->db->where(array('lurah_id' => $lurah_id));
        $query = $this->db->get();
        $lurah_nama = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $lurah_nama = $row->lurah_nama;
        }

        return $lurah_nama;
    }

    /**
     * check is exist wp_wr
     * @param unknown_type $nomor_urut
     */
    function is_exist_wp_wr($nomor_urut)
    {
        $this->db->from('wp_wr');
        $this->db->where(array('wp_wr_no_urut' => $nomor_urut));
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? true : false;
    }

    /**
     * next value
     * @param unknown_type $seq
     */
    function next_val($seq)
    {

        $this->db->select("nextval('" . $seq . "') as nextval");
        $query = $this->db->get();

        $nextval = '';
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $nextval =  $row->nextval;
        }

        // $nextval = $this->db->GetOne("SELECT nextval('" . $seq . "')");
        return $nextval;
    }

    //insert data 
    function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
        return  $this->db->affected_rows();
    }

    function get_hotel_detil_id()
    {
        $this->db->select('CASE WHEN MAX(wp_wr_hotel_id::INT) + 1 IS NULL then 1
				ELSE MAX(wp_wr_hotel_id::INT) + 1 END as wp_wr_hotel_id ');
        $this->db->from('wp_wr_hotel');
        $query = $this->db->get();

        $max_urut = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $max_urut =  $row->wp_wr_hotel_id;
        }
        return $max_urut;
    }

    function get_restoran_detil_id()
    {
        $this->db->select('CASE WHEN MAX(wp_wr_restoran_id::INT) + 1 IS NULL then 1
				ELSE MAX(wp_wr_restoran_id::INT) + 1 END as wp_wr_restoran_id ');
        $this->db->from('wp_wr_restoran');
        $query = $this->db->get();

        $max_urut = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $max_urut =  $row->wp_wr_restoran_id;
        }
        return $max_urut;
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

    function get_wp_wr_id($npwpd)
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

/* End of file Mod_login.php */
