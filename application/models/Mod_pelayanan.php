<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pelayanan extends CI_Model
{

    var $table = 'spt';
    var $column_order = array('spt_nomor', 'spt_tgl_entry', 'spt_periode_jual1', 'spt_id');
    var $column_search = array('spt_kode_billing', 'wp_wr_nama');
    var $order = array('spt_id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function getQRCode()
    {
        $hasil = $this->db->get('tbl_qrcode');
        return $hasil;
    }

    function insertQRCode($spt_id, $qr_id, $image_name, $date)
    {
        $data = array(
            'spt_id'       => $spt_id,
            'qr_id'      => $qr_id,
            'qr_code'     => $image_name,
            'created_date'   => $date
        );
        $this->db->insert('tbl_qrcode', $data);
    }


    function _get_table_menu()
    {

        $this->db->select('g.noid, g.npwpd, wp.wp_wr_nama nama, wp.wp_wr_no_urut, wp.wp_wr_bidang_usaha');
        $this->db->join('v_wp_wr wp', 'g.npwpd=wp.npwprd');
        $this->db->where("g.groupid", $this->session->userdata('id_user'));
        $this->db->from('data_group g');
        $query = $this->db->get();

        return $query->result();
    }

    function _get_id_npwp($noreg)
    {


        $this->db->select('wp_wr_id, npwprd');
        $this->db->where(" wp_wr_no_urut", $noreg);
        $this->db->from('v_wp_wr');
        $this->db->order_by('wp_wr_no_urut desc');


        $query = $this->db->get();
        return $query->result();
    }

    function _get_esptpd_menu_group($noreg)
    {


        // $this->db->select('wp.wp_wr_id, wp.npwprd, wp.wp_wr_nama, wp.wp_wr_almt, wp.wp_wr_lurah, wp.wp_wr_camat, wp.wp_wr_kabupaten, j.kode_rekening, j.kode_spt');
        // $this->db->join('v_wp_wr wp', 'CAST(wp.wp_wr_bidang_usaha as smallint)=CAST(j.ref_kodus_id as smallint)');
        // $this->db->where(" wp_wr_no_urut", $noreg);
        // $this->db->from('ref_jabatan j');

        $this->db->select('a.wp_wr_id, a.wp_wr_tgl_kartu, a.npwprd, a.wp_wr_nama, b.ref_kodus_id, b.ref_kodus_nama');
        $this->db->join('ref_kode_usaha b', 'a.ref_kodus_kode=b.ref_kodus_kode');
        $this->db->where("a.wp_wr_no_urut", $noreg);
        $this->db->from('v_wp_wr a');

        $query = $this->db->get();
        return $query->result();
    }

    function _get_data_wp($no_reg)
    {

        $this->db->select('wp.wp_wr_id, wp.npwprd, wp.wp_wr_nama nama, wp.wp_wr_almt alamat, wp.wp_wr_lurah kelurahan, wp.wp_wr_camat kecamatan, wp.wp_wr_kabupaten kota, j.kode_rekening, j.kode_spt');
        $this->db->join('ref_jabatan j', 'CAST(wp.wp_wr_bidang_usaha as smallint)=CAST(j.ref_kodus_id as smallint)');
        // $this->db->where("wp.wp_wr_no_urut", substr($this->session->userdata('username'), 7, 7));
        $this->db->where("wp.wp_wr_no_urut", $no_reg);
        $this->db->from('v_wp_wr wp');
        $query = $this->db->get();

        return $query->result();
    }

    function _get_data_SPPT($wp_id)
    {
        $this->db->select('*');
        $this->db->where("spt_idwpwr", $wp_id);
        $this->db->from('spt');
        $this->db->order_by('spt_periode_jual1 desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
        }

        return $row;
    }

    function _cekSPT_nomor($spt_nomor, $spt_periode, $spt_jenis)
    {

        $this->db->select('*');
        $this->db->where("spt_periode", $spt_periode);
        $this->db->where("spt_jenis_pajakretribusi", $spt_jenis);
        $this->db->where("spt_nomor", $spt_nomor);
        $this->db->from('spt');
        $query = $this->db->get();

        $res = '';

        if ($query->num_rows() > 0) {
            $res = '2';
        }
        return $res;
    }


    function _cekRegis($billing_id)
    {

        $this->db->select('*');
        $this->db->where("id_billing", $billing_id);
        $this->db->from('tbl_pelayanan');
        $query = $this->db->get();

        $res = '';

        if ($query->num_rows() > 0) {
            $res = '2';
        }
        return $res;
    }

    function _get_rekening($tipe, $kelompok, $jenis, $objek)
    {
        $this->db->where('korek_tipe', $tipe);
        $this->db->where('korek_kelompok', $kelompok);
        $this->db->where('korek_jenis', $jenis);
        $this->db->where('korek_objek', $objek);
        $this->db->where('korek_rincian !=', '00');
        $this->db->from('kode_rekening');
        $query = $this->db->get();

        return $query->result();
    }

    function _get_tarif($korek_id)
    {
        $this->db->select('korek_persen_tarif');
        $this->db->where("korek_id", $korek_id);
        $this->db->from('kode_rekening');
        $query = $this->db->get();

        $persen_tarif = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $persen_tarif =  $row->korek_persen_tarif;
        }

        return $persen_tarif;
    }

    function _get_reg_spt($kd_spt, $kd_jns)
    {
        $this->db->select('CASE WHEN MAX(spt_no_register::INT) + 1 IS NULL then 1
				ELSE MAX(spt_no_register::INT) + 1 END as max_spt_no_register ');
        $this->db->where("spt_periode", date("Y"));
        $this->db->where("spt_jenis_pajakretribusi", $kd_jns);
        $this->db->where("spt_kode", $kd_spt);
        $this->db->from('spt');
        $query = $this->db->get();

        $max_urut = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $max_urut =  $row->max_spt_no_register;
        }
        return $max_urut;
    }

    function _get_korek($kode_rek)
    {
        $this->db->select('*');
        $this->db->where("koderek", $kode_rek);
        $this->db->from('v_kode_rekening_pajak_detail');
        $query = $this->db->get();
        $total = $query->num_rows();

        $result_array = FALSE;
        $result = array();

        // if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $list[] = array(
                "key" => $row->korek_id . "," . $row->korek_persen_tarif . "," . (1 * $row->korek_tarif_dsr),
                "value" => "(" . $row->koderek_titik  . ") " . $row->korek_nama
            );
        }

        $result = array(
            'total' => $total,
            'list' => $list
        );

        return $result;
    }

    function next_spt_no_register($spt_periode, $kd_spt, $kd_jns)
    {
        $this->db->select('CASE WHEN MAX(spt_no_register::INT) + 1 IS NULL then 1
				ELSE MAX(spt_no_register::INT) + 1 END as max_spt_no_register ');
        $this->db->where("spt_periode", $spt_periode);
        $this->db->where("spt_jenis_pajakretribusi", $kd_jns);
        $this->db->where("spt_kode", $kd_spt);
        $this->db->from('spt');
        $query = $this->db->get();

        $max_urut = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $max_urut =  $row->max_spt_no_register;
        }
        return $max_urut;
    }

    function _getSPT_id()
    {
        $this->db->select('spt_id');
        $this->db->order_by('spt_id desc');
        $this->db->limit(1);
        $this->db->from('spt');
        $query = $this->db->get();

        $spt_id = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $spt_id =  $row->spt_id;
        }
        return $spt_id;
    }

    function inserSPT($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function insertPelayanan($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function get_nama_wp($npwprd)
    {
        $this->db->select('wp_wr_nama');
        // $this->db->where("npwprd", $npwprd);
        $this->db->where("wp_wr_id", $npwprd);
        $this->db->from('v_wp_wr');

        $query = $this->db->get();

        $nama = '';

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $nama =  $row->wp_wr_nama;
        }
        return $nama;
    }

    private function _get_datatables_query()
    {

        $this->db->select('spt_id, spt_nomor, spt_tgl_entry, spt_periode, spt_periode_jual1, spt_periode_jual2, spt_pajak, spt_jenis_pajakretribusi,  
				spt_kode_billing, status_bayar,spt_idwpwr, tgl_lapor, wp_wr_nama');
        $this->db->join('wp_wr', 'wp_wr.wp_wr_id=spt.spt_idwpwr');
        $this->db->where("spt_periode_jual1 >=", '2016-11-01');
        // $this->db->where("spt_jenis_pajakretribusi =", '2');
        $this->db->order_by('spt_tgl_entry desc');
        $this->db->from('spt');

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

        $this->db->select('spt_id, spt_nomor, spt_tgl_entry, spt_periode, spt_periode_jual1, spt_periode_jual2, spt_pajak, spt_jenis_pajakretribusi,  
				spt_kode_billing, status_bayar,spt_idwpwr, tgl_lapor, wp_wr_nama');
        $this->db->join('wp_wr', 'wp_wr.wp_wr_id=spt.spt_idwpwr');
        $this->db->where("wp_wr.wp_wr_kd_camat", $wilayah_uptd);
        $this->db->where("spt_periode_jual1 >=", '2016-11-01');
        // $this->db->where("spt_jenis_pajakretribusi =", '2');
        $this->db->order_by('spt_tgl_entry desc');
        $this->db->from('spt');

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
        $this->_get_datatables_query_uptd($wilayah_uptd);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('spt');

        return $this->db->count_all_results();
    }

    public function count_all_uptd($wilayah_uptd)
    {
        $this->db->from('spt');
        $this->db->join('wp_wr', 'wp_wr.wp_wr_id=spt.spt_idwpwr');
        $this->db->where("wp_wr.wp_wr_kd_camat", $wilayah_uptd);

        return $this->db->count_all_results();
    }

    function view_user($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('wp_user');
    }

    function getAll($billing_id)
    {
        $this->db->select('spt_id, spt_nomor, spt_idwpwr, spt_tgl_entry, spt_periode, spt_periode_jual1, spt_periode_jual2, spt_pajak, spt_jenis_pajakretribusi,  
				spt_kode_billing, status_bayar, image ');
        $this->db->where("spt_kode_billing", $billing_id);
        // $this->db->where("spt_periode_jual1 >=", '2016-11-01');
        // $this->db->order_by('spt_id desc');
        $query = $this->db->get('spt');
        return $query->result();
    }

    function getPrint($spt_id)
    {
        $this->db->select('s.spt_nomor, EXTRACT(YEAR FROM s.spt_periode_jual1) as tahunpajak, s.spt_periode_jual1, s.spt_periode_jual2, s.spt_periode, s.spt_pajak, sd.spt_dt_jumlah, 
                        k.korek_persen_tarif, k.korek_nama, wp.wp_wr_nama, s.spt_kode_billing, spt_tgl_entry, s.status_bayar, s.spt_idwpwr, wp.wp_wr_gol, wp.wp_wr_no_urut,
                        wp.wp_wr_kd_camat, wp.wp_wr_kd_lurah');
        $this->db->join('spt_detail sd', 's.spt_id=sd.spt_dt_id_spt');
        $this->db->join('kode_rekening k', 'sd.spt_dt_korek=k.korek_id');
        $this->db->join('wp_wr wp', 'wp.wp_wr_id=s.spt_idwpwr');
        $this->db->where("s.spt_id", $spt_id);
        $this->db->from('spt s');
        $query = $this->db->get();
        return $query->result();
    }

    function getDenda($id_wpwr, $spt_periode, $spt_nomor)
    {
        $this->db->select('setorpajret_tgl_bayar');
        $this->db->where("setorpajret_id_wp", $id_wpwr);
        $this->db->where("setorpajret_spt_periode", $spt_periode);
        $this->db->where("setorpajret_no_spt", $spt_nomor);
        $this->db->from('v_setoran_pajak_retribusi');
        $query = $this->db->get();
        return $query->result();
    }

    function getDendaLunas($kode_billing, $spt_periode)
    {
        $this->db->select('denda');
        $this->db->where("kode_billing", $kode_billing);
        $this->db->where("tahun_pajak", $spt_periode);
        $this->db->from('payment.pembayaran_sptpd');
        $query = $this->db->get();
        return $query->result();
    }

    function getWPWRD($spt_idwpwr)
    {
        $this->db->select('*');
        $this->db->where("wp_wr_id", $spt_idwpwr);
        $query = $this->db->get('v_wp_wr');
        return $query->result();
    }

    function getdataPayment($billing_id)
    {
        $this->db->select('*');
        $this->db->where("spt_kode_billing", $billing_id);
        $query = $this->db->get('v_data_payment');
        return $query->result();
    }

    function getdataPelayanan($billing_id)
    {
        $this->db->select('*');
        $this->db->where("id_billing", $billing_id);
        $query = $this->db->get('tbl_pelayanan');
        return $query->result();
    }

    function cekUsername($username)
    {
        $this->db->where("npwpd", $username);
        return $this->db->get("wp_user");
    }

    function insertUser($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getUser($id)
    {
        $this->db->where("user_id", $id);
        return $this->db->get("wp_user a")->row();
    }

    function updatePelayanan($id, $data)
    {
        $this->db->where('id_billing', $id);
        $this->db->update('tbl_pelayanan', $data);
    }

    function updateSPT($id, $data)
    {
        $this->db->where('spt_id', $id);
        $this->db->update('spt', $data);
    }

    function updateSPTDetil($id, $data)
    {
        $this->db->where('spt_dt_id', $id);
        $this->db->update('spt_detail', $data);
    }



    function deleteUsers($id, $table)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($table);
    }

    function userlevel()
    {
        return $this->db->order_by('id_level ASC')
            ->get('tbl_userlevel')
            ->result();
    }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('wp_user');
        $this->db->where('user_id', $id);
        return $this->db->get();
    }

    function reset_pass($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('wp_user', $data);
    }

    function get_sptID($where, $table)
    {
        $this->db->select('spt_id');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();

        $spt_id = '';
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $spt_id =  $row->spt_id;
        }
        return $spt_id;
    }

    function hapus_billing($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function get_group_billing($periode, $jual1, $jual2, $groupid)
    {

        $this->db->select('s.spt_idwpwr, s.spt_periode_jual1, s.spt_periode_jual2, s.spt_pajak, s.spt_kode_billing, wp.npwpd ');
        $this->db->join('wp_user wp ', 's.spt_idwpwr=wp.id_wp_wr');
        $this->db->where("s.spt_periode", $periode);
        $this->db->where("s.spt_periode_jual1", $jual1);
        $this->db->where("s.spt_periode_jual2", $jual2);
        $this->db->where("wp.user_id", $groupid);
        $this->db->from('spt s');
        $query = $this->db->get();
        return $query->result();
    }

    function get_group_billing_det($periode, $jual1, $jual2, $groupid)
    {

        $this->db->select('s.spt_idwpwr, s.spt_periode_jual1, s.spt_periode_jual2, s.spt_pajak, s.spt_kode_billing, g.npwpd ');
        $this->db->join('data_group g ', 's.spt_idwpwr=g.id_wpwr');
        $this->db->where("s.spt_periode", $periode);
        $this->db->where("s.spt_periode_jual1", $jual1);
        $this->db->where("s.spt_periode_jual2", $jual2);
        $this->db->where("g.groupid", $groupid);
        $this->db->from('spt s');
        $query = $this->db->get();
        return $query->result();
    }

    function get_edit_esptpd($spt_id)
    {

        $this->db->select('s.spt_nomor,  s.spt_tgl_proses, s.spt_tgl_entry , s.spt_kode_billing, s.spt_jenis_pemungutan, s.spt_periode_jual1, s.spt_periode_jual2, s.spt_periode, sd.spt_dt_jumlah, sd.spt_dt_pajak, k.korek_nama, k.korek_persen_tarif, k.korek_id, sd.spt_dt_id ');
        $this->db->join('spt_detail sd', 'sd.spt_dt_id_spt=s.spt_id');
        $this->db->join('kode_rekening k', 'sd.spt_dt_korek=k.korek_id');
        $this->db->where("s.spt_id", $spt_id);
        $this->db->from('spt s');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
        }

        return $row;
    }

    function cek_lapor_pajak($pajak_lalu, $spt_idwpwr){
        $sql = "SELECT tgl_lapor FROM spt WHERE spt_periode_jual1 = '$pajak_lalu' AND spt_idwpwr = '$spt_idwpwr'";
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }
}
