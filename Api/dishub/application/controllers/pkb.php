<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pkb extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

      function uji_pertama_post() {
   
		$no_rekom = $this->post('no_rekom'); // no uji 1
		$no_mesin=$this->post('no_mesin'); // 2
		$no_rangka = $this->post('no_rangka'); // 3
		$no_kendaraan = $this->post('no_kendaraan');
	    $nama_pemilik = $this->post('nama_pemilik');
        $alamat = $this->post('alamat');
		$jbb = $this->post('jbb');// 4
		$jenis_kendaraan = $this->post('jenis_kendaraan');
		$tgl_janji = $this->post('tgl_janji'); //5
        $total_retribusi = $this->post('total_retribusi');
			

  /*===========================================================NPWRD===============================*/      	
		
  $this->db->select('MAX(npwrd) as last_npwrd ');
  $this->db->from('app_no_npwrd_test');
  $npwrd_ = $this->db->get()->result_array();
	   
	   foreach ($npwrd_ as $npwrd) {
	   $npwrd=$npwrd['last_npwrd'];
	   }

       $npwrd=$npwrd+1; 

       $rnpwrd="R".".$npwrd";



	// ========  input ketetapan ==== ///	


	$curr_year=date('Y');
		  
	$curr_mounth=date('m');
	
	  $this->db->select('max(no_skrd)as last_num ');
	  $this->db->from('app_skrd_pkb');
	  $this->db->where('kd_rekening','4120128');
	  $this->db->where('thn_retribusi', $curr_year);
	  $noskrd_ = $this->db->get()->result_array();
	   
	   foreach ($noskrd_ as $noskrd) {
	   $no_skrdx=$noskrd['last_num'];
	   }



	 $this->db->select('max(id_skrd)as last_id ');
	 $this->db->from('app_skrd_pkb');
	 $idskrd_ = $this->db->get()->result_array();
	  
	  foreach ($idskrd_ as $idskrd) {
	  $id_skrdx=$idskrd['last_id'];
	  }
	   	
	$pkb_nota= array(
	 
	  'npwrd'=>$rnpwrd,// unix sirida
	  'no_nota_perhitungan'=> $no_skrdx+1,
	  'bln_retribusi'=> $curr_mounth,
	  'thn_retribusi'=> $curr_year,
	  'kd_rekening'=> '4120128',
	  'nm_rekening'=> 'Retribusi PKB - Mobil Barang',
	  'dasar_pengenaan'=> 'Perda No. 09 Tahun 2012',
	  'jenis_ketetapan'=> 'SKRD',
	  'keterangan'=>'h2h dishub',
	  'jenis_bangunan'=> '',
	  'tipe_bangunan'=> '',
	  'total_retribusi' =>$total_retribusi,
	  'imb' => '',
	  'fk_skrd' => $id_skrdx+1,
	  'id_nota' => $id_skrdx+1 );

	  $insert_nota=$this->db->insert('app_nota_perhitungan_pkb', $pkb_nota);
/*		if ($insert) {
	  $this->response($data, 200);
	  } else {
	  $this->response(array('status' => 'fail', 502));
	  }
*/
$data = array('npwrd'=>$npwrd);

$this->db->where('id_npwrd','1');
$update = $this->db->update('app_no_npwrd_test', $data);
/*============ BILLING KODE===================================*/

            $prefix	= '4120128';
			$stamp1	= date("m");
			$stamp2	= date("d");
			$len = 5; 
			$base = '123456789'; 
			$max = strlen($base)-1;
			$activatecode='';
			
			mt_srand((double)microtime()*1000000);
			
			while (strlen($activatecode)<$len+1)
			{
				$activatecode .= mt_rand(0,$max);
			}
        //    $activatecode = mt_rand(0,$max);
			$billing_code = $prefix.$stamp1.$activatecode.$stamp2;
		//	return $billing_code;



/*====================END BILL================================*/

  
  $dates=date('Y-m-d');
  $date1 = str_replace('-', '/', $dates);
  $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

$pkb_skrd = array(       
'no_skrd'=> $no_skrdx+1,
'bln_retribusi'=> $curr_mounth,
'thn_retribusi'=> $curr_year,
'tipe_retribusi'=>'1',
'kd_billing'=>$billing_code,
'npwrd'=>$rnpwrd,// unix sirida
'wp_wr_nama'=>$nama_pemilik,
'wp_wr_alamat'=>$alamat,
'wp_wr_lurah'=>'',
'wp_wr_camat'=>'',
'wp_wr_kabupaten'=>'BEKASI',
'kd_rekening'=> '4120128',
'nm_rekening'=> 'Retribusi PKB - Mobil Barang',
'user_input'=> 'h2h dishub',
'tgl_input'=> $tgl_janji,
'tgl_skrd'=>$dates,
'tgl_penetapan'=> $dates,
'status_ketetapan'=>'1',
'status_bayar'=> '0',
'status_lunas'=> '0',
'id_skrd'=> $id_skrdx+1,
'no_polisi'=>$no_kendaraan,
'no_uji'=>$no_rekom
);

$insert_SKRD=$this->db->insert('app_skrd_pkb', $pkb_skrd);


    $pkb_detail= array(
	 
        'no_rekom'=>$no_rekom,// unix sirida
        'no_mesin'=> $no_mesin,
        'no_rangka'=> $no_rangka,
        'no_kendaraan'=> $no_kendaraan,
        'nama_pemilik'=> $nama_pemilik,
        'alamat'=> $alamat,
        'jbb'=> $jbb,
        'jenis_kendaraan'=>$jenis_kendaraan,
		'merek'=>'',
        'tgl_janji'=>$tgl_janji,
        'total_retribusi'=>$total_retribusi,
        'kd_billing'=>$billing_code );
  
        $insert_detailPKB=$this->db->insert('detail_pkb', $pkb_detail);

        $pkb_repon= array(
	        'no_kendaraan'=> $no_kendaraan,
            'total_retribusi' =>$total_retribusi,
            'kd_billing'=>$billing_code );


        if ($insert_detailPKB) {
            $this->response($pkb_repon, 200);
            } else {
            $this->response(array('status' => 'fail', 502));
            }

}


function uji_berkala_post() {
	$no_uji = $this->post('no_uji'); // no uji 1
	$no_mesin=$this->post('no_mesin'); // 2	
	$no_rangka = $this->post('no_rangka'); // 3
	$no_kendaraan = $this->post('no_kendaraan');
	$nama_pemilik = $this->post('nama_pemilik');
	$alamat = $this->post('alamat');
	$kecamatan=$this->post('kecamatan'); // 2
	$kota=$this->post('kota'); // 2
	$jbb = $this->post('jbb');// 4
	$jenis_kendaraan = $this->post('jenis_kendaraan');
	$merek = $this->post('merek');
	$tgl_uji = $this->post('tgl_uji'); //5
	$total_retribusi = $this->post('total_retribusi');
		

/*===========================================================NPWRD===============================*/      	
	
$this->db->select('MAX(npwrd) as last_npwrd ');
$this->db->from('app_no_npwrd_test');
$npwrd_ = $this->db->get()->result_array();
   
   foreach ($npwrd_ as $npwrd) {
   $npwrd=$npwrd['last_npwrd'];
   }

   $npwrd=$npwrd+1; 

   $rnpwrd="R".".$npwrd";



// ========  input ketetapan ==== ///	


$curr_year=date('Y');
	  
$curr_mounth=date('m');

  $this->db->select('max(no_skrd)as last_num ');
  $this->db->from('app_skrd_pkb');
  $this->db->where('kd_rekening','4120128');
  $this->db->where('thn_retribusi', $curr_year);
  $noskrd_ = $this->db->get()->result_array();
   
   foreach ($noskrd_ as $noskrd) {
   $no_skrdx=$noskrd['last_num'];
   }



 $this->db->select('max(id_skrd)as last_id ');
 $this->db->from('app_skrd_pkb');
 $idskrd_ = $this->db->get()->result_array();
  
  foreach ($idskrd_ as $idskrd) {
  $id_skrdx=$idskrd['last_id'];
  }
	   
$pkb_nota= array(
 
  'npwrd'=>$rnpwrd,// unix sirida
  'no_nota_perhitungan'=> $no_skrdx+1,
  'bln_retribusi'=> $curr_mounth,
  'thn_retribusi'=> $curr_year,
  'kd_rekening'=> '4120128',
  'nm_rekening'=> 'Retribusi PKB - Mobil Barang',
  'dasar_pengenaan'=> 'Perda No. 09 Tahun 2012',
  'jenis_ketetapan'=> 'SKRD',
  'keterangan'=>'h2h dishub',
  'jenis_bangunan'=> '',
  'tipe_bangunan'=> '',
  'total_retribusi'=>$total_retribusi,
  'imb' => '',
  'fk_skrd' => $id_skrdx+1,
  'id_nota' => $id_skrdx+1 );

  $insert_nota=$this->db->insert('app_nota_perhitungan_pkb', $pkb_nota);
/*		if ($insert) {
  $this->response($data, 200);
  } else {
  $this->response(array('status' => 'fail', 502));
  }
*/
$data = array('npwrd'=>$npwrd);

$this->db->where('id_npwrd','1');
$update = $this->db->update('app_no_npwrd_test', $data);
/*============ BILLING KODE===================================*/

		$prefix	= '4120128';
		$stamp1	= date("m");
		$stamp2	= date("d");
		$len = 5; 
		$base = '123456789'; 
		$max = strlen($base)-1;
		$activatecode='';
		
		mt_srand((double)microtime()*1000000);
		
		while (strlen($activatecode)<$len+1)
		{
			$activatecode .= mt_rand(0,$max);
		}
	//    $activatecode = mt_rand(0,$max);
		$billing_code = $prefix.$stamp1.$activatecode.$stamp2;
	//	return $billing_code;



/*====================END BILL================================*/


$dates=date('Y-m-d');
$date1 = str_replace('-', '/', $dates);
$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

$pkb_skrd = array(       
'no_skrd'=> $no_skrdx+1,
'bln_retribusi'=> $curr_mounth,
'thn_retribusi'=> $curr_year,
'tipe_retribusi'=>'1',
'kd_billing'=>$billing_code,
'npwrd'=>$rnpwrd,// unix sirida
'wp_wr_nama'=>$nama_pemilik,
'wp_wr_alamat'=>$alamat,
'wp_wr_lurah'=>'',
'wp_wr_camat'=>$kecamatan,
'wp_wr_kabupaten'=>$kota,
'kd_rekening'=> '4120128',
'nm_rekening'=> 'Retribusi PKB - Mobil Barang',
'user_input'=> 'h2h dishub',
'tgl_input'=> $tgl_uji,
'tgl_skrd'=>$dates,
'tgl_penetapan'=> $dates,
'status_ketetapan'=>'1',
'status_bayar'=> '0',
'status_lunas'=> '0',
'id_skrd'=> $id_skrdx+1,
'no_polisi'=>$no_kendaraan,
'no_uji'=>$no_uji
);

$insert_SKRD=$this->db->insert('app_skrd_pkb', $pkb_skrd);


$pkb_detail= array(
 
	'no_rekom'=>$no_uji,// unix sirida
	'no_mesin'=> $no_mesin,
	'no_rangka'=> $no_rangka,
	'no_kendaraan'=> $no_kendaraan,
	'nama_pemilik'=> $nama_pemilik,
	'alamat'=> $alamat,
	'jbb'=> $jbb,
	'jenis_kendaraan'=>$jenis_kendaraan,
	'merek'=>$merek,
	'tgl_janji'=>$tgl_uji,
	'total_retribusi' =>$total_retribusi,
	'kd_billing'=>$billing_code );

	$insert_detailPKB=$this->db->insert('detail_pkb', $pkb_detail);

	$pkb_repon= array(
		'no_kendaraan'=> $no_kendaraan,
		'total_retribusi' =>$total_retribusi,
		'kd_billing'=>$billing_code );


	if ($insert_detailPKB) {
		$this->response($pkb_repon, 200);
		} else {
		$this->response(array('status' => 'fail', 502));
		}
		

	  }



function index_put() {
   
			

	}


}
?>