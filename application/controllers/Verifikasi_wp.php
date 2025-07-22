<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include library phpmailer
include('assets/phpmailer/Exception.php');
include('assets/phpmailer/PHPMailer.php');
include('assets/phpmailer/SMTP.php');

class Verifikasi_wp extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('fungsi');
        $this->load->model('Mod_verifikasi_wp');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $this->session->userdata('id_user');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $data['menu'] = $this->Mod_verifikasi_wp->_get_table_menu();
            $this->template->load('layoutbackend', 'verifikasi_wp/daftar_wp_baru', $data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(3600);
        $list = $this->Mod_verifikasi_wp->get_datatables();
        $stat_arr = array(
            "0" => "<i class='far fa-times-circle' style='color:yellow;'></i> <span class='text-warning'> Waiting..</span>",
            "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Diterima</span>",
            "2" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'> Pending</span>"
        );
        $data = array();
        $no = 0;
        foreach ($list as $pel) {
            $alamat = $pel->JALAN." Blok ".$pel->BLOK." RT ".$pel->RT." RW ".$pel->RW;
            // if ($pel->STATUS == '1') {
            //     $aksi = "<a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $pel->WP_ID . "><i class=\"fas fa-trash\"> Hapus</i></a>";
            // }else {
            //     $aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"verifikasi\" href=\"javascript:void(0)\" title=\"Verifikasi\" data-href=" . $pel->WP_ID . "><i class=\"fas fa-edit\"> Verifikasi</i></a>
            //         <a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $pel->WP_ID . "><i class=\"fas fa-trash\"> Hapus</i></a>";
            // }
            
            $status_admin = $pel->STATUS;
            $status_kasubid = $pel->STATUS_KASUBID;
            $status_kabid = $pel->STATUS_KABID;
            $id_level = $this->session->userdata('id_level');
            $aksi = '';

            // Kondisi: semua status = 0, dan id_level bukan 27 atau 28
            if (
                $status_admin == 0 &&
                $status_kasubid == 0 &&
                $status_kabid == 0 &&
                $id_level != '27' &&
                $id_level != '28'
            ) {
                $aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"verifikasi\" href=\"javascript:void(0)\" title=\"Verifikasi\" data-href=\"" . $pel->WP_ID . "\"><i class=\"fas fa-edit\"> Verifikasi</i></a>
                        <a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=\"" . $pel->WP_ID . "\"><i class=\"fas fa-trash\"> Hapus</i></a>";
            }

            // Kondisi: status admin = 1, kasubid = 0, dan id_level = 27 (kasubid)
            if ($status_admin == 1 && $status_kasubid == 0 && $id_level == '27') {
                $aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"verifikasi_kasubid\" href=\"javascript:void(0)\" title=\"Verifikasi Kasubid\" data-href=\"" . $pel->WP_ID . "\"><i class=\"fas fa-edit\"> Verifikasi Kasubid</i></a>";
            }

            // Kondisi: status admin = 1, kasubid = 1, kabid = 0, dan id_level = 28 (kabid)
            if ($status_admin == 1 && $status_kasubid == 1 && $status_kabid == 0 && $id_level == '28') {
                $aksi = "<a class=\"btn btn-xs btn-outline-primary\" id=\"verifikasi_kabid\" href=\"javascript:void(0)\" title=\"Verifikasi Kabid\" data-href=\"" . $pel->WP_ID . "\"><i class=\"fas fa-edit\"> Verifikasi Kabid</i></a>";
            }

            // Kondisi: status admin = 1, kasubid = 1, kabid = 1, dan id_level bukan 27 atau 28
            if (
                $status_admin == 1 &&
                $status_kasubid == 1 &&
                $status_kabid == 1 &&
                $id_level != '27' &&
                $id_level != '28'
            ) {
                $aksi = "<a class=\"btn btn-xs btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=\"" . $pel->WP_ID . "\"><i class=\"fas fa-trash\"> Hapus</i></a>";
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pel->WP_ID;
            $row[] = $pel->NAMA;
            $row[] = $alamat;
            $row[] = $pel->KELURAHAN;
            $row[] = $pel->KECAMATAN;
            $row[] = $pel->nama_jenis_pemilik;
            $row[] = $stat_arr[$pel->STATUS];
            $row[] = $stat_arr[$pel->STATUS_KASUBID];
            $row[] = $stat_arr[$pel->STATUS_KABID];
            $row[] = $aksi;
            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function aksi_verifikasi_admin() {
        $nik =  $this->uri->segment(3);
        $data_wp = $this->Mod_verifikasi_wp->getDataDetail($nik);
        $lampiran_nik = $this->Mod_verifikasi_wp->getDataLampiran('1',$nik);
        $lampiran_npwp = $this->Mod_verifikasi_wp->getDataLampiran('2',$nik);
        $lampiran_akta = $this->Mod_verifikasi_wp->getDataLampiran('3',$nik);
        $lampiran_sipa = $this->Mod_verifikasi_wp->getDataLampiran('4',$nik);
        
        $data['data_wp'] = $data_wp;
        $data['lampiran_nik'] = $lampiran_nik;
        $data['lampiran_npwp'] = $lampiran_npwp;
        $data['lampiran_akta'] = $lampiran_akta;
        $data['lampiran_sipa'] = $lampiran_sipa;
        $this->template->load('layoutbackend', 'verifikasi_wp/data_verifikasi_admin', $data);
    }

    public function aksi_verifikasi_kasubid() {
        $nik =  $this->uri->segment(3);
        $data_wp = $this->Mod_verifikasi_wp->getDataDetail($nik);
        $lampiran_nik = $this->Mod_verifikasi_wp->getDataLampiran('1',$nik);
        $lampiran_npwp = $this->Mod_verifikasi_wp->getDataLampiran('2',$nik);
        $lampiran_akta = $this->Mod_verifikasi_wp->getDataLampiran('3',$nik);
        $lampiran_sipa = $this->Mod_verifikasi_wp->getDataLampiran('4',$nik);
        
        $data['data_wp'] = $data_wp;
        $data['lampiran_nik'] = $lampiran_nik;
        $data['lampiran_npwp'] = $lampiran_npwp;
        $data['lampiran_akta'] = $lampiran_akta;
        $data['lampiran_sipa'] = $lampiran_sipa;
        $this->template->load('layoutbackend', 'verifikasi_wp/data_verifikasi_kasubid', $data);
    }

    public function aksi_verifikasi_kabid() {
        $nik =  $this->uri->segment(3);
        $data_wp = $this->Mod_verifikasi_wp->getDataDetail($nik);
        $lampiran_nik = $this->Mod_verifikasi_wp->getDataLampiran('1',$nik);
        $lampiran_npwp = $this->Mod_verifikasi_wp->getDataLampiran('2',$nik);
        $lampiran_akta = $this->Mod_verifikasi_wp->getDataLampiran('3',$nik);
        $lampiran_sipa = $this->Mod_verifikasi_wp->getDataLampiran('4',$nik);
        
        $data['data_wp'] = $data_wp;
        $data['lampiran_nik'] = $lampiran_nik;
        $data['lampiran_npwp'] = $lampiran_npwp;
        $data['lampiran_akta'] = $lampiran_akta;
        $data['lampiran_sipa'] = $lampiran_sipa;
        $this->template->load('layoutbackend', 'verifikasi_wp/data_verifikasi_kabid', $data);
    }

    public function save_verifikasi_admin(){
        $email = $this->input->post('email');
        $wp_id = $this->input->post('wp_id');
        $data = [
            'STATUS' => '1'
        ];
        $update_status_wp = $this->Mod_verifikasi_wp->updateStatusWP($wp_id, $data);
        
        $response = [
            'status' => true,
            'message' => 'Verifikasi telah berhasil'
        ];
        echo json_encode($response);
    }

    public function save_verifikasi_kasubid(){
        $email = $this->input->post('email');
        $wp_id = $this->input->post('wp_id');
        $data = [
            'STATUS_KASUBID' => '1'
        ];
        $update_status_wp = $this->Mod_verifikasi_wp->updateStatusWP($wp_id, $data);

        $response = [
            'status' => true,
            'message' => 'Verifikasi telah berhasil'
        ];
        echo json_encode($response);
    }

    public function save_verifikasi_kabid(){

        $email = $this->input->post('email');
        $wp_id = $this->input->post('wp_id');
        $data = [
            'STATUS_KABID' => '1'
        ];
        $update_status_wp = $this->Mod_verifikasi_wp->updateStatusWP($wp_id, $data);
        
        if (!$update_status_wp) {
            $response = [
                'status' => false,
                'message' => 'Gagal Update Status WP'
            ];
        }else {
            $update_status_user_wp = $this->Mod_verifikasi_wp->updateStatusUserWP($wp_id);
            if (!$update_status_user_wp) {
                $response = [
                    'status' => false,
                    'message' => 'Gagal Update Status User WP'
                ];
            }else {
                $update_status_notif = $this->Mod_verifikasi_wp->updateStatusNotif($wp_id);
                $email_pengirim = 'opd.bapenda@bekasikota.go.id';
                $nama_pengirim = 'Bapenda Kota Bekasi';
                $subjek = 'Verifikasi Pendaftaran WP';
                $pesan = 'Selamat pendaftaran anda telah terverifikasi. Silahkan login dengan klik tautan http://sipdah.bekasikota.go.id/login_devel, menggunakan password 12345 dan segera ganti password anda. Terima Kasih.';

                $mail = new PHPMailer;
                $mail->isSMTP();

                $mail->Host = 'mail.bekasikota.go.id';
                $mail->Username = $email_pengirim;
                // $mail->Password = 'ymwrgkiqwhbofzun';
                $mail->Password = 'Bapenda@2024';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                // $mail->SMTPDebug = 2;

                $mail ->setFrom($email_pengirim, $nama_pengirim);
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = $subjek;
                $mail->Body = $pesan;

                $send = $mail->send();
                if ($send) {
                    $response = [
                        'status' => true,
                        'message' => 'Verifikasi telah berhasil terkirim'
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Gagal Mengirim Email'
                    ];
                }
            }
        }

        echo json_encode($response);
    }

    public function batal_verifikasi(){
        $wp_id = $this->input->post('wp_id');
        $batal_status_wp = $this->Mod_verifikasi_wp->batalStatusWP($wp_id);
        if (!$batal_status_wp) {
            $response = [
                'status' => false,
                'message' => 'Gagal Update Status WP'
            ];
        }else {
            $batal_status_user_wp = $this->Mod_verifikasi_wp->batalStatusUserWP($wp_id);
            if (!$batal_status_user_wp) {
                $response = [
                    'status' => false,
                    'message' => 'Gagal Update Status User WP'
                ];
            }else {
                $response = [
                    'status' => true,
                    'message' => 'Verifikasi telah berhasil dibatalkan'
                ];
            }
        }
        echo json_encode($response);
    }

    public function hapus_verifikasi() {
        $wp_id = $this->input->post('wp_id');
        $hapus_wp = $this->Mod_verifikasi_wp->hapusWP($wp_id);
        if (!$hapus_wp) {
            $response = [
                'status' => false,
                'message' => 'Gagal hapus WP'
            ];
        }else {
            $hapus_user_wp = $this->Mod_verifikasi_wp->hapusUserWP($wp_id);
            $hapus_lampiran_wp = $this->Mod_verifikasi_wp->hapusLampiranWP($wp_id);
            if (!$hapus_user_wp) {
                $response = [
                    'status' => false,
                    'message' => 'Gagal Hapus User WP'
                ];
            }else {
                $response = [
                    'status' => true,
                    'message' => 'Permohonan berhasil dihapus'
                ];
            }
        }
        echo json_encode($response);
    }
}
?>