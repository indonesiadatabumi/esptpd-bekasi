<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sts extends REST_Controller {

	private $api_key = 'b4p3nd4OKb4ng3z'; // Gantilah 'your-api-key' dengan kunci API yang valid

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


    function index_post() {
        $api_key = $this->input->get_request_header('Authorization', TRUE);
        
        // Verifikasi kunci API
        if ($api_key === 'Bearer ' . $this->api_key) {
           // $id = $this->post('tanggal');
			$end_date = $this->post('tanggal');
			$start_date='2024-01-01';
            
			// ... (lanjutan kode yang sudah ada)
			
			//if ($id) {
			if ($end_date) {
			//   $this->db->like('npwprd', $id);
			 //  $this->db->where('npwprd', $id);
	 
			 $this->db->select('*');
			 $this->db->from('public.v_stspen_bpkad_lates');
			// $this->db->where('tanggal', $id);
			 $this->db->where("tanggal BETWEEN '$start_date' AND '$end_date'");
			// $this->db->where("tahun='2024'", NULL, FALSE);
			//$this->db->where("(spt_periode='2023' OR spt_periode='2021')", NULL, FALSE);
			 //$this->db->order_by('no_skrd','desc');
			 //$this->db->limit(1);  
			 
			 $daftar = $this->db->get()->result_array();
			 
			 $this->response($daftar,200);
			   
		 }      
		 else {
		 $this->response(array('status' => 'fail', 502));
		 }



        } else {
            $this->response(array('status' => 'fail', 'message' => 'Unauthorized'), 401);
        }
    }

	

function index_put() {
        $npwrd = $this->put('npwrd');
        $no_skrd = $this->put('no_skrd');
		$total_bayar = $this->put('total_bayar');
		$kd_billing = $this->put('kd_billing');
		$status_bayarr=$this->put('status_bayar');

	/*	if ($kd_billing==''){
			$status_bayar='0';
		}else if ($kd_billing=='0'){
			$status_bayar='0';
		}		
		else {$status_bayar='1';}
*/

if ($status_bayarr=='1'){
	$status_bayar='1';
}		
else {$status_bayar='0';}

// ===== respon balikan ==== //

		
$tgl_p =date('Y-m-d');
$data = array(
	'kd_billing' =>$kd_billing,
		'tgl_penetapan' => $tgl_p,
			'status_ketetapan' =>$status_bayar,
			'status_bayar'  => $status_bayar,
			'status_lunas'  =>$status_bayar
			);
			
$this->db->where('npwrd', $npwrd);
$this->db->where('no_skrd', $no_skrd);
$this->db->where('kd_rekening','4120120');
$update = $this->db->update('app_skrd_pasar', $data);
if ($update) {
	$this->response($data, 200);
} else {
	$this->response(array('status' => 'fail', 502));
}

   $this->db->select('max(id_pembayaran)as last_id ');
   $this->db->from('payment_retribusi_pasar');
   $idskrd_ = $this->db->get()->result_array();
	
	foreach ($idskrd_ as $idskrd) {
	$id_pembayaran=$idskrd['last_id'];
	}


   $this->db->select('*');
   $this->db->from('app_skrd_pasar');
   $this->db->where('npwrd', $npwrd);
   $this->db->where('no_skrd', $no_skrd);
   $this->db->where('kd_rekening','4120120');
   $daftari_ = $this->db->get()->result_array();
  // var_dump($daftar_);

foreach ($daftari_ as $daftari) {
$no_skrd=$daftari['no_skrd'];
$bln_retribusi=$daftari['bln_retribusi'];
$thn_retribusi=$daftari['thn_retribusi'];
$tipe_retribusi=$daftari['tipe_retribusi'];
$kd_billing=$daftari['kd_billing'];
$npwrd=$daftari['npwrd'];
$wp_wr_nama=$daftari['wp_wr_nama'];
$wp_wr_alamat=$daftari['wp_wr_alamat'];
$wp_wr_lurah=$daftari['wp_wr_lurah'];
$wp_wr_camat=$daftari['wp_wr_camat'];
$wp_wr_kabupaten=$daftari['wp_wr_kabupaten'];
$kd_rekening=$daftari['kd_rekening'];
$nm_rekening=$daftari['nm_rekening'];
$user_input=$daftari['user_input'];

}

   $this->db->select('*');
   $this->db->from('app_nota_perhitungan_pasar');
   $this->db->where('npwrd', $npwrd);
	$this->db->where('no_nota_perhitungan', $no_skrd);
   $daftar_ = $this->db->get()->result_array();
  // var_dump($daftar_);

foreach ($daftar_ as $daftar) {
$total_retribusi=$daftar['total_retribusi'];
   }

$today = date("Y-m-d H:i:s");

$data2 = array(       
'id_pembayaran'=> $id_pembayaran+1,
'npwrd'=>$npwrd,
'bln_retribusi'=> $bln_retribusi,
'thn_retribusi'=> $thn_retribusi,
'kd_billing'=>$kd_billing,
'kd_rekening'=> $kd_rekening,
'nm_rekening'=> $nm_rekening,
'ntpd'=> $kd_billing,
'pembayaran_ke'=>'1',
'total_retribusi'=> $total_retribusi,
'denda'=>'0' ,
'total_bayar'=>$total_bayar,
'tgl_pembayaran'=>$today,
'nip_rekam_bayar'=>'-',
'status_reversal'=>'0');

$insert2 = $this->db->insert('payment_retribusi_pasar', $data2);
if ($insert2) {
$this->response($data2, 200);
} else {
$this->response(array('status' => 'fail', 502));
}






	// ========  input ketetapan ==== ///	


	$curr_year=date('Y');
		  
	$curr_mounth=date('m');
	

	 $this->db->select('max(no_nota_perhitungan)as last_num ');
	 $this->db->from('app_nota_perhitungan_pasar');
	 $this->db->where('kd_rekening','4120120');
	 $this->db->where('thn_retribusi', $curr_year);
	 $nota_ = $this->db->get()->result_array();
	  
	  foreach ($nota_ as $nota) {
	  $no_nota=$nota['last_num'];
	  }
	  
	  
	 $this->db->select('max(id_nota)as last_id ');
	 $this->db->from('app_nota_perhitungan_pasar');
	 $idnota_ = $this->db->get()->result_array();
	  
	  foreach ($idnota_ as $idnota) {
	  $id_notax=$idnota['last_id'];
	  } 
  
	  $this->db->select('max(no_skrd)as last_num ');
	  $this->db->from('app_skrd_pasar');
	  $this->db->where('kd_rekening','4120120');
	  $this->db->where('thn_retribusi', $curr_year);
	  $noskrd_ = $this->db->get()->result_array();
	   
	   foreach ($noskrd_ as $noskrd) {
	   $no_skrdx=$noskrd['last_num'];
	   }



	 $this->db->select('max(id_skrd)as last_id ');
	 $this->db->from('app_skrd_pasar');
	 $idskrd_ = $this->db->get()->result_array();
	  
	  foreach ($idskrd_ as $idskrd) {
	  $id_skrdx=$idskrd['last_id'];
	  }
  
  
	 $this->db->select('*');
	 $this->db->from('app_nota_perhitungan_pasar');
	 $this->db->where('npwrd', $npwrd);
	 $daftarskrd_ = $this->db->get()->result_array();
	// var_dump($daftar_);

  foreach ($daftarskrd_ as $daftarskrd) {
  $no_nota_perhitungan=$daftarskrd['no_nota_perhitungan'];
  
  $bln_retribusi=$daftarskrd['bln_retribusi'];
  $thn_retribusi=$daftarskrd['thn_retribusi'];
  $kd_rekening=$daftarskrd['kd_rekening'];
  $nm_rekening=$daftarskrd['nm_rekening'];
  $dasar_pengenaan=$daftarskrd['dasar_pengenaan'];
  $jenis_ketetapan=$daftarskrd['jenis_ketetapan'];
  $keterangan=$daftarskrd['keterangan'];
  $total_retribusi=$daftarskrd['total_retribusi'];
  $fk_skrd=$daftarskrd['fk_skrd'];
  $id_nota=$daftarskrd['id_nota'];
	 }
	   
		
	$dataskrd = array(
	 
	  'npwrd'=> $npwrd,
	  'no_nota_perhitungan'=> $no_skrdx+1,
	  'bln_retribusi'=> $curr_mounth,
	  'thn_retribusi'=> $curr_year,
	  'kd_rekening'=> $kd_rekening,
	  'nm_rekening'=> $nm_rekening,
	  'dasar_pengenaan'=> $dasar_pengenaan,
	  'jenis_ketetapan'=> $jenis_ketetapan,
	  'keterangan'=> $keterangan,
	  'jenis_bangunan'=> '',
	  'tipe_bangunan'=> '',
	  'total_retribusi' =>$total_retribusi,
	  'imb' => '',
	  'fk_skrd' => $id_skrdx+1,
	  'id_nota' => $id_notax+1 );

	  $insertskrd=$this->db->insert('app_nota_perhitungan_pasar', $dataskrd);
/*		if ($insert) {
	  $this->response($data, 200);
	  } else {
	  $this->response(array('status' => 'fail', 502));
	  }
*/
	  


	 $this->db->select('*');
	 $this->db->from('app_skrd_pasar');
	 $this->db->where('npwrd', $npwrd);
	 $daftarinota_ = $this->db->get()->result_array();
	// var_dump($daftar_);

  foreach ($daftarinota_ as $daftarinota) {
  $no_skrd=$daftarinota['no_skrd'];
  $bln_retribusi=$daftarinota['bln_retribusi'];
  $thn_retribusi=$daftarinota['thn_retribusi'];
  $tipe_retribusi=$daftarinota['tipe_retribusi'];
  $kd_billing=$daftarinota['kd_billing'];
  $npwrd=$daftarinota['npwrd'];
  $wp_wr_nama=$daftarinota['wp_wr_nama'];
  $wp_wr_alamat=$daftarinota['wp_wr_alamat'];
  $wp_wr_lurah=$daftarinota['wp_wr_lurah'];
  $wp_wr_camat=$daftarinota['wp_wr_camat'];
  $wp_wr_kabupaten=$daftarinota['wp_wr_kabupaten'];
  $kd_rekening=$daftarinota['kd_rekening'];
  $nm_rekening=$daftarinota['nm_rekening'];
  $user_input=$daftarinota['user_input'];
  $tgl_input=$daftarinota['tgl_input'];
  $tgl_skrd=$daftarinota['tgl_skrd'];
  $tgl_penetapan=$daftarinota['tgl_penetapan'];
  $status_ketetapan=$daftarinota['status_ketetapan'];
  $status_bayar=$daftarinota['status_bayar'];
  $status_lunas=$daftarinota['status_lunas'];
  $id_skrd=$daftarinota['id_skrd'];
  }
  
  $dates=date('Y-m-d');
  $date1 = str_replace('-', '/', $dates);
  $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

$data2nota = array(       
'no_skrd'=> $no_skrdx+1,
'bln_retribusi'=> $curr_mounth,
'thn_retribusi'=> $curr_year,
'tipe_retribusi'=>$tipe_retribusi,
'kd_billing'=>'',
'npwrd'=>$npwrd,
'wp_wr_nama'=>$wp_wr_nama,
'wp_wr_alamat'=>$wp_wr_alamat,
'wp_wr_lurah'=> $wp_wr_lurah,
'wp_wr_camat'=> $wp_wr_camat,
'wp_wr_kabupaten'=> $wp_wr_kabupaten,
'kd_rekening'=> $kd_rekening,
'nm_rekening'=> $nm_rekening,
'user_input'=> $user_input,
'tgl_input'=> $tgl_input,
'tgl_skrd'=>$tomorrow,
'tgl_penetapan'=> $tomorrow,
'status_ketetapan'=>'0',
'status_bayar'=> '0',
'status_lunas'=> '0',
'id_skrd'=> $id_skrdx+1
);

$insert2nota=$this->db->insert('app_skrd_pasar', $data2nota);

/*
if ($insert2) {
$this->response($data2, 200);
} else {
$this->response(array('status' => 'fail', 502));
}*/


		
	

	}


}
?>