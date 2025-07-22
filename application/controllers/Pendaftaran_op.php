<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_op extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        // $this->load->library('user_agent');
        // $this->load->helper('myfunction_helper');
        $this->load->model('Mod_pendaftaran_op');
        // backButtonHandle();
    }

    function index()
    {
        $data['data_wp'] =  $this->Mod_pendaftaran_op->get_data_wp($this->session->userdata('username') );

        $data['no_register'] =  $this->get_next_number_wprd();

        $data['list_kecamatan'] = $this->get_kecamatan();

        $data['jenis_kamar'] = $this->Mod_pendaftaran_op->get_kamar();

        $data['golongan_hotel'] = $this->Mod_pendaftaran_op->get_gol_hotel();

        $this->template->load('layoutbackend_devel', 'form_pendaftaran_op', $data);
    }

    function get_next_number_wprd()
    {
        $result = $this->Mod_pendaftaran_op->get_next_number_wp();
        return $result;
        // echo json_encode($result);
    }

    function get_next_number_wp()
    {
        $result = $this->Mod_pendaftaran_op->get_next_number_wp();
        // return $result;
        echo json_encode($result);
    }

    function get_kecamatan()
    {
        $result = $this->Mod_pendaftaran_op->get_kecamatan();
        // echo json_encode($result);
        return $result;
    }

    function get_kelurahan()
    {
        $kecamatan = $this->input->post('kdkec');

        $arr_kecamatan =  explode("|", $kecamatan);
        if (count($arr_kecamatan) > 0)
            $id_kecamatan = $arr_kecamatan[0];
        else
            $id_kecamatan = $kecamatan;


        if (empty($id_kecamatan)) return false;

        $rs_kelurahan = $this->Mod_pendaftaran_op->get_kelurahan($id_kecamatan);

        foreach ($rs_kelurahan as $row) {
            echo '<option value=' . $row->lurah_id . '|' . $row->lurah_nama . '> ' . $row->lurah_kode . ' | ' . $row->lurah_nama . '</option>';
        }
    }

    function get_kegus()
    {
        $pajakid = '';
        $pajakid = $this->input->post('pajakid');

        // var_dump($pajakid);
        if ($pajakid) {
            $result = $this->Mod_pendaftaran_op->get_kegiatan_usaha($pajakid);
            foreach ($result as $row) {
                echo '<option value="' . $row->ref_kegus_id . '"> ' . $row->nama_kegus . '</option>';
            }
        } else {
            echo '<option value=""> - Silakan Pilih Jenis Usaha - </option>';
        }
        // echo json_encode($result);
    }

    function insert_data()
    {
        error_reporting(E_ALL & ~E_NOTICE);

        $this->validate();
        
        $result = array();

        $wp_wr_kd_camat = '';
        $wp_wr_camat = '';
        if ($this->input->post('input-kecamatan') != '') {
            list($wp_wr_kd_camat, $wp_wr_camat) =  explode("|", $this->input->post('input-kecamatan'));
        }
        $wp_wr_kd_lurah = '';
        $wp_wr_lurah = '';
        if ($this->input->post('input-kelurahan') != '') {
            list($wp_wr_kd_lurah, $wp_wr_lurah) =  explode("|", $this->input->post('input-kelurahan'));
        }
        $wp_wr_no_urut = $this->input->post('no_register');


        $wp_wr_lurah_nama = $this->Mod_pendaftaran_op->get_nm_kelurahan($wp_wr_kd_lurah);
        

        if ($this->Mod_pendaftaran_op->is_exist_wp_wr($wp_wr_no_urut)) {
            echo json_encode(array(
                "error" => True,
                "msg" => "Nomor registrasi sudah terdaftar!!. Silahkan Tekan refresh   lalu klik simpan"
            ));
        } else {
            $wp_wr_tgl_tb = (!empty($_POST['wp_wr_tgl_tb']) ? $this->input->post('wp_wr_tgl_tb') : NULL);
            $wp_wr_tgl_kk = (!empty($_POST['wp_wr_tgl_kk']) ? $this->input->post('wp_wr_tgl_kk') : NULL);
            $next_val = $this->Mod_pendaftaran_op->next_val('wp_wr_wp_wr_id_seq');
            $jns_wajib_pajak = $this->input->post('input-jns_wajib_pajak');
            $jns_pajak = $this->input->post('input-jns_pajak');

            if ($jns_pajak == '1') {
                $bidus = '1';
            } else if ($jns_pajak == '2') {
                $bidus = '16';
            } else if ($jns_pajak == '3') {
                $bidus = '11';
            } else if ($jns_pajak == '4') {
                $bidus = '5';
            } else if ($jns_pajak == '2') {
                $bidus = '16';
            } else if ($jns_pajak == '5') {
                $bidus = '12';
            } else if ($jns_pajak == '6') {
                $bidus = '17';
            } else if ($jns_pajak == '7') {
                $bidus = '14';
            } else if ($jns_pajak == '8') {
                $bidus = '18';
            }

            $data = array(
                'wp_wr_id' => $next_val,
                'wp_wr_no_form' => $jns_wajib_pajak . $wp_wr_no_urut,
                'wp_wr_no_urut' => $wp_wr_no_urut,
                'wp_wr_gol' => $jns_wajib_pajak,
                'wp_wr_jenis' => 'p',
                'wp_wr_nama' => addslashes(strtoupper($this->input->post('input-nama'))),
                'wp_wr_almt' => htmlspecialchars(strip_tags(strtoupper($this->input->post('input-alamat'))), ENT_QUOTES),
                'wp_wr_lurah' => $wp_wr_lurah_nama,
                'wp_wr_camat' => $wp_wr_camat,
                'wp_wr_kd_lurah' => $wp_wr_kd_lurah,
                'wp_wr_kd_camat' => $wp_wr_kd_camat,
                'wp_wr_kabupaten' => strtoupper($this->input->post('input-kota')),
                'wp_wr_telp' => $this->input->post('input-no_telepon'),
                'wp_wr_kodepos' => $this->input->post('input-kode_pos'),

                'wp_wr_nama_milik' => addslashes(strtoupper($this->input->post('input-nama_pemilik'))),
                'wp_wr_almt_milik' => htmlspecialchars(strip_tags(strtoupper($this->input->post('input-alamat_pemilik'))), ENT_QUOTES),
                'wp_wr_lurah_milik' => strtoupper($this->input->post('input-kelurahan_pemilik')),
                'wp_wr_camat_milik' => strtoupper($this->input->post('input-kecamatan_pemilik')),
                'wp_wr_kabupaten_milik' => strtoupper($this->input->post('input-kota_pemilik')),
                'wp_wr_telp_milik' => $this->input->post('input-no_hp'),
                'wp_wr_nik' => $this->input->post('input-nik_pemilik'),
                'wp_wr_email' => $this->input->post('input-email_pemilik'),

                'wp_wr_bidang_usaha' => $bidus,
                'wp_wr_tgl_kartu' => $this->input->post('input-tgl_daftar'),
                'wp_wr_tgl_terima_form' => $this->input->post('input-tgl_form_kembali'),
                'wp_wr_tgl_bts_kirim' => $this->input->post('input-tgl_bts_kirim'),
                'wp_wr_jns_pemungutan' => $jns_wajib_pajak,
                'wp_wr_pejabat' => '1',
                'wp_wr_kegus_id' => $this->input->post('input-kegus')
            );

            // var_dump($data);
            // die();
            // echo json_encode(array("status" => TRUE, "wp_wr_id" => $next_val));

            // 🔐 MULAI TRANSAKSI
            $this->db->trans_start();

            $insert_pendaftaran = $this->Mod_pendaftaran_op->insert("wp_wr", $data);

            $arr_gol_kamar = $this->input->post('golongan_kamar');
            $arr_jml_kamar = $this->input->post('jumlah_kamar');
            $arr_tarif_kamar = $this->input->post('tarif_kamar');
            $total_jml_kamar = $this->input->post('totaljumlahkamar');
            $gol_hotel = $this->input->post('input-golongan_hotel');

            $jenis_restoran = $this->input->post('input-jns_restoran');
            $jml_meja = $this->input->post('jml_meja');
            $jml_kursi = $this->input->post('jml_kursi');
            $kapasitas_pengunjung = $this->input->post('kapasitas_pengunjung');
            $jml_karyawan = $this->input->post('jml_karyawan');

            $jumlah_standar = ($arr_jml_kamar[0] != '') ? $arr_jml_kamar[0] : '0';
            $tarif_standar = ($arr_tarif_kamar[0] != '') ? $arr_tarif_kamar[0] : '0';
            $jumlah_standar_ac = ($arr_jml_kamar[1] != '') ? $arr_jml_kamar[1] : '0';
            $tarif_standar_ac = ($arr_tarif_kamar[1] != '') ? $arr_tarif_kamar[1] : '0';
            $jumlah_double = ($arr_jml_kamar[2] != '') ? $arr_jml_kamar[2] : '0';
            $tarif_double = ($arr_tarif_kamar[2] != '') ? $arr_tarif_kamar[2] : '0';
            $jumlah_superior = ($arr_jml_kamar[3] != '') ? $arr_jml_kamar[3] : '0';
            $tarif_superior = ($arr_tarif_kamar[3] != '') ? $arr_tarif_kamar[3] : '0';
            $jumlah_delux = ($arr_jml_kamar[4] != '') ? $arr_jml_kamar[4] : '0';
            $tarif_delux = ($arr_tarif_kamar[4] != '') ? $arr_tarif_kamar[4] : '0';
            $jumlah_executive_suite = ($arr_jml_kamar[5] != '') ? $arr_jml_kamar[5] : '0';
            $tarif_executive_suite = ($arr_tarif_kamar[5] != '') ? $arr_tarif_kamar[5] : '0';
            $jumlah_club_room = ($arr_jml_kamar[6] != '') ? $arr_jml_kamar[6] : '0';
            $tarif_club_room = ($arr_tarif_kamar[6] != '') ? $arr_tarif_kamar[6] : '0';
            $jumlah_apartment = ($arr_jml_kamar[7] != '') ? $arr_jml_kamar[7] : '0';
            $tarif_apartment = ($arr_tarif_kamar[7] != '') ? $arr_tarif_kamar[7] : '0';

            if ($insert_pendaftaran > 0) {
                if ($jns_pajak == '1') {
                    $wp_wr_hotel_id = $this->Mod_pendaftaran_op->get_hotel_detil_id();

                    $arr_save = array(
                        'wp_wr_hotel_id' => $wp_wr_hotel_id,
                        'wp_wr_id' => $next_val,
                        'wp_wr_detil_id' => $next_val,
                        'golongan_hotel' => $gol_hotel,
                        'jumlah_kamar' => $total_jml_kamar,
                        'jumlah_standar' => $jumlah_standar,
                        'tarif_standar' => $tarif_standar,
                        'jumlah_standar_ac' => $jumlah_standar_ac,
                        'tarif_standar_ac' => $tarif_standar_ac,
                        'jumlah_double' => $jumlah_double,
                        'tarif_double' => $tarif_double,
                        'jumlah_superior' => $jumlah_superior,
                        'tarif_superior' => $tarif_superior,
                        'jumlah_delux' => $jumlah_delux,
                        'tarif_delux' => $tarif_delux,
                        'jumlah_executive_suite' => $jumlah_executive_suite,
                        'tarif_executive_suite' => $tarif_executive_suite,
                        'jumlah_club_room' => $jumlah_club_room,
                        'tarif_club_room' => $tarif_club_room,
                        'jumlah_apartment' => $jumlah_apartment,
                        'tarif_apartment' => $tarif_apartment
                    );

                    $table = 'wp_wr_hotel';
                    $insert_detil = $this->Mod_pendaftaran_op->insert($table, $arr_save);
                } else if ($jns_pajak == '2') {
                    $wp_wr_hotel_id = $this->Mod_pendaftaran_op->get_restoran_detil_id();

                    $arr_save = array(
                        'wp_wr_restoran_id' => $wp_wr_hotel_id,
                        'wp_wr_id' => $next_val,
                        'wp_wr_detil_id' => $next_val,
                        'jenis_restoran' => $jenis_restoran,
                        'jumlah_meja' => $jml_meja,
                        'jumlah_kursi' => $jml_kursi,
                        'kapasitas_pengunjung' => $kapasitas_pengunjung,
                        'jumlah_karyawan' => $jml_karyawan
                    );
                    $table = 'wp_wr_restoran';
                    $insert_detil = $this->Mod_pendaftaran_op->insert($table, $arr_save);
                } else if ($jns_pajak == '3') {
                    $arr_save = array(
                        'wp_wr_id' => $next_val,
                        'jenis_hiburan' => $this->input->post('jenis_hiburan'),
                        'sifat_pertunjukan' => $this->input->post('sifat_pertunjukan'),
                        'jam' => $this->input->post('jam')
                    );
                    $table = 'wp_wr_hiburan';
                    $insert_detil = $this->Mod_pendaftaran_op->insert($table, $arr_save);
                } elseif ($jns_pajak == '7') {
                    $arr_save = array(
                        'wp_wr_id' => $next_val,
                        'kap_mobil' => $this->input->post('kap_mobil'),
                        'kap_motor' => $this->input->post('kap_motor'),
                        'tarif_pertama' => $this->input->post('tarif_pertama'),
                        'tarif_selanjutnya' => $this->input->post('tarif_selanjutnya')
                    );
                    $table = 'wp_wr_parkir';
                    $insert_detil = $this->Mod_pendaftaran_op->insert($table, $arr_save);
                }
                // $npwprd = $this->Mod_pendaftaranwp->get_record_value('npwprd', 'v_wp_wr', "wp_wr_id='" . $next_val . "'");
                //insert history log ($module, $action, $description)
                // $this->Mod_pendaftaranwp->history_log("pendaftaran", "i", "Insert WP Badan Usaha id " . $next_val . " | $npwprd" . " | " . strtoupper($this->input->post('input-nama')));
                // echo json_encode(array("status" => TRUE));
                
            } 

            // 🔐 AKHIR TRANSAKSI
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["error" => true, "msg" => "Gagal menyimpan data. Silakan coba lagi."]);
            } else {
                echo json_encode(["status" => true, "wp_wr_id" => $next_val]);
            }
        }
    }


    private function validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('input-jns_pajak') == '') {
            $data['inputerror'][] = 'input-jns_pajak';
            $data['error_string'][] = 'Silakan Pilih Jenis Pajak!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('input-kegus') == '') {
            $data['inputerror'][] = 'input-kegus';
            $data['error_string'][] = 'Silakan Pilih Kegiatan Usaha!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('input-nama') == '') {
            $data['inputerror'][] = 'input-nama';
            $data['error_string'][] = 'Nama Tidak Boleh Null!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('input-alamat') == '') {
            $data['inputerror'][] = 'input-alamat';
            $data['error_string'][] = 'Alamat Tidak boleh Null!';
            $data['status'] = FALSE;
        }
        if ($this->input->post('input-kecamatan') == '') {
            $data['inputerror'][] = 'input-kecamatan';
            $data['error_string'][] = 'Pilih Kecamatan!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('input-kelurahan') == '') {
            $data['inputerror'][] = 'input-kelurahan';
            $data['error_string'][] = 'Pilih kelurahan!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('input-no_telepon') == '') {
            $data['inputerror'][] = 'input-no_telepon';
            $data['error_string'][] = 'No Telpon tidak boleh null';
            $data['status'] = FALSE;
        }



        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function cetak_npwpd()
    {

        $wp_wr_nik =  ($this->uri->segment(3)) ? $this->uri->segment(3) : $this->session->userdata('id_wp_wr');

        $npwprd = $this->Mod_pendaftaran_op->get_npwpd($wp_wr_nik);
        $nama   = $this->Mod_pendaftaran_op->get_namawp($npwprd);
        $wp_wr   = $this->Mod_pendaftaran_op->get_wp_wr($npwprd);
        $pejabat   = $this->Mod_pendaftaran_op->get_kadis();

        $alamat =  $wp_wr->wp_wr_almt . ' ' . $wp_wr->wp_wr_camat;
        $tgl_kartu = $wp_wr->wp_wr_tgl_kartu;
        $tanggal_kartu = $this->fungsi->tanggalindo($tgl_kartu);

        $data['wp_wr_id']   = $wp_wr_nik;
        $data['npwprd']     = $npwprd;
        $data['nama']       = $nama;
        $data['alamat']       = $alamat;
        $data['pejabat']       = $pejabat;
        $data['tanggal_kartu']       = $tanggal_kartu;


        // $this->sendmail();
        $this->load->view('admin_devel/cetak_npwpd', $data);
    }
}
/* End of file Controllername.php */
