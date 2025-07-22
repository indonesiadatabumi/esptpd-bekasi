<?php 
/**
 * class Wp_badan_usaha_model
 * @package Simpatda
 * @author Daniel Hutauruk
 * @version 20121015
 */
class Wp_badan_usaha_model extends CI_Model {
	/**
	 * get list data pribadi model
	 */
	function get_list() {
		$tables = " v_wp_wr ";
		$relations = " a.wp_wr_gol=2 AND a.wp_wr_status_aktif='t' ";
	
		// $sortname = $_POST['sortname'];
		// $sortorder = $_POST['sortorder'];
		// if (!$sortname) $sortname = ' wp_wr_id ';
		// if (!$sortorder) $sortorder = 'desc';
		// $sort = "ORDER BY $sortname $sortorder";
		
		// $page = $_POST['page'];
		// $rp = $_POST['rp'];
		// if (!$page) $page = 1;
		// if (!$rp) $rp = 10;
		// $start = (($page-1) * $rp);
		// $limit = " LIMIT $rp OFFSET $start ";
		
		// $query = $_POST['query'];
		// $qtype = $_POST['qtype'];
	
		
		if (!empty($relations)) 
		$where = " WHERE $relations ";
		// if ($query) $where .= " AND CAST($qtype AS TEXT) ~~* '%$query%' ";
		// }
		// else {if ($query) $where = " WHERE CAST($qtype AS TEXT) ~~* '%$query%' ";}
	
	
		// $sql = "SELECT a.*, b.wp_wr_nik FROM $tables AS a
		// 		LEFT JOIN wp_wr AS b ON a.wp_wr_id=b.wp_wr_id
		// 		$where $sort $limit";
		$sql = "SELECT a.*, b.wp_wr_nik FROM $tables AS a
				LEFT JOIN wp_wr AS b ON a.wp_wr_id=b.wp_wr_id
				$where ORDER BY wp_wr_id DESC";
		// $result = $this->adodb->Execute($sql);
		// $total = $this->adodb->GetOne("SELECT count('wp_wr_id') FROM $tables AS a
		// LEFT JOIN wp_wr AS b ON a.wp_wr_id=b.wp_wr_id $where");
			
		// $list = array();
		// $counter = 1 + $rp * ($page - 1);
		// if ($result) {
		// 	$index = 0;
		// 	while ($row = $result->FetchNextObject(false)) {
		// 		$list[] = array (
		// 						"id"	=> $counter,
		// 						"cell"	=> array (
		// 							$row->wp_wr_id,
		// 							$counter,
		// 							'<input type="checkbox" id="cb'.$counter.'" class="toggle" name="wp_wr_id[]" value="'.$row->wp_wr_id.'" 
		// 									onclick="selectRow('.$index.');isChecked(this.checked,'.$row->wp_wr_nama.');" />',
		// 							$row->no_reg,
		// 							"<a href='#' onclick=\"addOP('".$row->wp_wr_nik."')\">".$row->wp_wr_nik."</a>",
		// 							// $row->wp_wr_no_kartu,
		// 							$row->npwprd,
		// 							addslashes($row->wp_wr_nama),
		// 							addslashes(preg_replace("/[\r|\n]/","",$row->wp_wr_almt)),
		// 							$row->wp_wr_lurah,
		// 							$row->wp_wr_camat,
		// 							$row->wp_wr_kabupaten,
		// 							addslashes($row->wp_wr_nama_milik),
		// 							addslashes(preg_replace("/[\r|\n]/","",$row->wp_wr_almt_milik)),
		// 							$row->wp_wr_lurah_milik,
		// 							$row->wp_wr_camat_milik,
		// 							$row->wp_wr_kabupaten_milik,
		// 							format_tgl($row->wp_wr_tgl_terima_form),
		// 							format_tgl($row->wp_wr_tgl_bts_kirim),
		// 							format_tgl($row->wp_wr_tgl_form_kembali)
		// 						)
		// 					);
		// 		$counter++;
		// 		$index++;
		// 	}
		// }
	
		// $result = array (
		// 				"page"	=> $page,
		// 				"total"	=> $total,
		// 				"rows"	=> $list
		// 			);
			
		// echo json_encode($result);	
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	/*
	 * get wp_wr by wp_wr_id
	 */
	function get_wp_wr($id) {
		$where = array('a.wp_wr_id' => $id,
						'a.wp_wr_status_aktif' => 'TRUE');
		
		$this->db->select('a.*, b.wp_wr_nik');
		$this->db->from('v_wp_wr a');
		$this->db->join('wp_wr b', 'a.wp_wr_id = b.wp_wr_id');
		$this->db->where($where);
		
		return $this->db->get();
	}

	/*
	 * get wp_wr by wp_wr_nik
	 */
	function get_wp_wr_nik($id) {
		$where = array('b.wp_wr_nik' => $id,
						'a.wp_wr_status_aktif' => 'TRUE');
		
		$this->db->select('a.*, b.wp_wr_nik');
		$this->db->from('v_wp_wr a');
		$this->db->join('wp_wr b', 'a.wp_wr_id = b.wp_wr_id');
		$this->db->where($where);
		
		return $this->db->get();
	}
	
	/**
	 * insert data wp_wr_badan_usaha
	 */
	function insert_data() {
		$result = array();
		$nik = $this->input->post('wp_wr_nik');
		$cek_nik = $this->adodb->GetOne("SELECT count('wp_wr_nik') as nik FROM wp_wr WHERE wp_wr_nik = '$nik'");
		if ($cek_nik > 0) {
			$result = array('status' => false, 'msg' => 'Nomor NIK/NIB sudah terdaftar');
		} else {
			list($wp_wr_kd_camat, $wp_wr_camat) =  explode("|", $this->input->post('wp_wr_kd_camat'));
		
			$wp_wr_kd_lurah = '';
			$wp_wr_lurah = '';
			if ($this->input->post('wp_wr_kd_lurah') != '') {
				list($wp_wr_kd_lurah,$wp_wr_lurah) =  explode("|", $this->input->post('wp_wr_kd_lurah'));
			}
			$wp_wr_no_urut = $this->input->post('wp_wr_no_urut');
			
			if ($this->common_model->is_exist_wp_wr($wp_wr_no_urut)) {
				$result = array('status' => false, 'msg' => 'Nomor registrasi sudah terdaftar. Silahkan pilih yang lain.');
			} else {
				$wp_wr_tgl_tb = (!empty($_POST['wp_wr_tgl_tb']) ? $this->input->post('wp_wr_tgl_tb') : NULL);
				$wp_wr_tgl_kk = (!empty($_POST['wp_wr_tgl_kk']) ? $this->input->post('wp_wr_tgl_kk') : NULL);
				$next_val = $this->common_model->next_val('wp_wr_wp_wr_id_seq');
				
				$data = array(
							'wp_wr_id' => $next_val,
							'wp_wr_no_form' => '2'.$wp_wr_no_urut,
							'wp_wr_no_urut' => $wp_wr_no_urut,
							'wp_wr_gol' => $this->input->post('wp_wr_gol'),
							'wp_wr_jenis' => $this->input->post('wp_wr_jenis'),
							'wp_wr_nama' => addslashes(strtoupper($this->input->post('wp_wr_nama'))),
							'wp_wr_almt' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt'))), ENT_QUOTES),
							'wp_wr_lurah' => $wp_wr_lurah,
							'wp_wr_camat' => $wp_wr_camat,
							'wp_wr_kd_lurah' => $wp_wr_kd_lurah,
							'wp_wr_kd_camat' => $wp_wr_kd_camat,
							'wp_wr_kabupaten' => strtoupper($this->input->post('wp_wr_kabupaten')),
							'wp_wr_telp' => $this->input->post('wp_wr_telp'),
							'wp_wr_kodepos' => $this->input->post('wp_wr_kodepos'),
				
							'wp_wr_nama_milik' => addslashes(strtoupper($this->input->post('wp_wr_nama_milik'))),
							'wp_wr_almt_milik' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt_milik'))), ENT_QUOTES),
							'wp_wr_lurah_milik' => strtoupper($this->input->post('wp_wr_lurah_milik')),
							'wp_wr_camat_milik' => strtoupper($this->input->post('wp_wr_camat_milik')),
							'wp_wr_kabupaten_milik' => strtoupper($this->input->post('wp_wr_kabupaten_milik')),
							'wp_wr_kodepos_milik' => strtoupper($this->input->post('wp_wr_kodepos_milik')),
							'wp_wr_telp_milik' => $this->input->post('wp_wr_telp_milik'),
				
							'wp_wr_bidang_usaha' => $this->input->post('bidus'),
							'wp_wr_tgl_kartu' => format_tgl($this->input->post('wp_wr_tgl_kartu')),
							'wp_wr_tgl_terima_form' => format_tgl($this->input->post('wp_wr_tgl_terima_form')),
							'wp_wr_tgl_bts_kirim' => format_tgl($this->input->post('wp_wr_tgl_bts_kirim')),
							'wp_wr_jns_pemungutan' => 2,
							'wp_wr_pejabat' => $this->session->userdata('USER_ID'),
							'wp_wr_nik' => $this->input->post('wp_wr_nik')
						);
						
				$this->db->insert('wp_wr', $data);
				
				if ($this->db->affected_rows() > 0) {
					//insert wp detail
					$this->insert_wp_detail($next_val,
											$this->input->post('bidus'), 
											$this->input->post('gol_hotel'), 
											$this->input->post('txt_jumlah_kamar'), 
											$this->input->post('ddl_jenis_restoran'),
											$this->input->post('txt_jumlah_meja'), 
											$this->input->post('txt_jumlah_kursi'));
											
					if ($this->input->post('bidus') == '16'){
						$wp_wr_restoran_id = $this->wp_wr_restoran_id();
						if($wp_wr_restoran_id == null){
							$wp_wr_restoran_id = 1;
						}
						$data_restoran = array(
							'wp_wr_restoran_id' => $wp_wr_restoran_id,
							'wp_wr_id' => $next_val,
							'jenis_restoran' => $this->input->post('ddl_jenis_restoran'),
							'jumlah_meja' => $this->input->post('txt_jumlah_meja') != "" ? $this->input->post('txt_jumlah_meja') : 0,
							'jumlah_kursi' => $this->input->post('txt_jumlah_kursi') != "" ? $this->input->post('txt_jumlah_kursi') : 0,
							'kapasitas_pengunjung' => $this->input->post('txt_kapasitas_pengunjung') != "" ? $this->input->post('txt_kapasitas_pengunjung') : 0,
							'jumlah_karyawan' => $this->input->post('txt_jumlah_karyawan') != "" ? $this->input->post('txt_jumlah_karyawan') : 0,
						);
						$this->db->insert('wp_wr_restoran', $data_restoran);
					}else if($this->input->post('bidus') == '1'){
						$wp_wr_hotel_id = $this->wp_wr_hotel_id();
						if($wp_wr_hotel_id == null){
							$wp_wr_hotel_id = 1;
						}
						$data_hotel = array(
							'wp_wr_hotel_id' => $wp_wr_hotel_id,
							'wp_wr_id' => $next_val,
							'golongan_hotel' => $this->input->post('gol_hotel'),
							'jumlah_kamar' => $this->input->post('txt_jumlah_kamar') != "" ? $this->input->post('txt_jumlah_kamar') : 0,
							'jumlah_standar' => $this->input->post('txt_jumlah_standar') != "" ? $this->input->post('txt_jumlah_standar') : 0,
							'jumlah_standar_ac' => $this->input->post('txt_jumlah_standar_ac') != "" ? $this->input->post('txt_jumlah_standar_ac') : 0,
							'jumlah_double' => $this->input->post('txt_jumlah_double') != "" ? $this->input->post('txt_jumlah_double') : 0,
							'jumlah_superior' => $this->input->post('txt_jumlah_superior') != "" ? $this->input->post('txt_jumlah_superior') : 0,
							'jumlah_delux' => $this->input->post('txt_jumlah_delux') != "" ? $this->input->post('txt_jumlah_delux') : 0,
							'jumlah_executive_suite' => $this->input->post('txt_jumlah_executive_suite') != "" ? $this->input->post('txt_jumlah_executive_suite') : 0,
							'jumlah_club_room' => $this->input->post('txt_jumlah_club_room') != "" ? $this->input->post('txt_jumlah_club_room') : 0,
							'jumlah_apartment' => $this->input->post('txt_jumlah_apartment') != "" ? $this->input->post('txt_jumlah_apartment') : 0,
							'tarif_standar' => $this->input->post('txt_tarif_standar') != "" ? $this->input->post('txt_tarif_standar') : 0,
							'tarif_standar_ac' => $this->input->post('txt_tarif_standar_ac') != "" ? $this->input->post('txt_tarif_standar_ac') : 0,
							'tarif_double' => $this->input->post('txt_tarif_double') != "" ? $this->input->post('txt_tarif_double') : 0,
							'tarif_superior' => $this->input->post('txt_tarif_superior') != "" ? $this->input->post('txt_tarif_superior') : 0,
							'tarif_delux' => $this->input->post('txt_tarif_delux') != "" ? $this->input->post('txt_tarif_delux') : 0,
							'tarif_executive_suite' => $this->input->post('txt_tarif_executive_suite') != "" ? $this->input->post('txt_tarif_executive_suite') : 0,
							'tarif_club_room' => $this->input->post('txt_tarif_club_room') != "" ? $this->input->post('txt_tarif_club_room') : 0,
							'tarif_apartment' => $this->input->post('txt_tarif_apartment') != "" ? $this->input->post('txt_tarif_apartment') : 0,
						);
						$this->db->insert('wp_wr_hotel', $data_hotel);
					}
					
					$npwprd = $this->common_model->get_record_value('npwprd', 'v_wp_wr', "wp_wr_id='".$next_val."'");
					
					//insert history log ($module, $action, $description)
					$this->common_model->history_log("pendaftaran", "i", "Insert WP Badan Usaha id ".$next_val." | $npwprd"." | ".strtoupper($this->input->post('wp_wr_nama')));
					
					$result = array('status' => true, 'npwpd' => $npwprd, 'wp_wr_id' => $next_val);	
				}
				else 
					$result = array('status' => false, 'msg' => 'Data gagal tersimpan');
			}
		}
		
		return $result;
	}

	/**
	 * insert data op
	 */
	function insert_data_op() {
		$result = array();
		list($wp_wr_kd_camat, $wp_wr_camat) =  explode("|", $this->input->post('wp_wr_kd_camat'));
		
			$wp_wr_kd_lurah = '';
			$wp_wr_lurah = '';
			if ($this->input->post('wp_wr_kd_lurah') != '') {
				list($wp_wr_kd_lurah,$wp_wr_lurah) =  explode("|", $this->input->post('wp_wr_kd_lurah'));
			}
			$wp_wr_no_urut = $this->input->post('wp_wr_no_urut');
			
			if ($this->common_model->is_exist_wp_wr($wp_wr_no_urut)) {
				$result = array('status' => false, 'msg' => 'Nomor registrasi sudah terdaftar. Silahkan pilih yang lain.');
			} else {
				$wp_wr_tgl_tb = (!empty($_POST['wp_wr_tgl_tb']) ? $this->input->post('wp_wr_tgl_tb') : NULL);
				$wp_wr_tgl_kk = (!empty($_POST['wp_wr_tgl_kk']) ? $this->input->post('wp_wr_tgl_kk') : NULL);
				$next_val = $this->common_model->next_val('wp_wr_wp_wr_id_seq');
				
				$data = array(
							'wp_wr_id' => $next_val,
							'wp_wr_no_form' => '2'.$wp_wr_no_urut,
							'wp_wr_no_urut' => $wp_wr_no_urut,
							'wp_wr_gol' => $this->input->post('wp_wr_gol'),
							'wp_wr_jenis' => $this->input->post('wp_wr_jenis'),
							'wp_wr_nama' => addslashes(strtoupper($this->input->post('wp_wr_nama'))),
							'wp_wr_almt' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt'))), ENT_QUOTES),
							'wp_wr_lurah' => $wp_wr_lurah,
							'wp_wr_camat' => $wp_wr_camat,
							'wp_wr_kd_lurah' => $wp_wr_kd_lurah,
							'wp_wr_kd_camat' => $wp_wr_kd_camat,
							'wp_wr_kabupaten' => strtoupper($this->input->post('wp_wr_kabupaten')),
							'wp_wr_telp' => $this->input->post('wp_wr_telp'),
							'wp_wr_kodepos' => $this->input->post('wp_wr_kodepos'),
				
							'wp_wr_nama_milik' => addslashes(strtoupper($this->input->post('wp_wr_nama_milik'))),
							'wp_wr_almt_milik' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt_milik'))), ENT_QUOTES),
							'wp_wr_lurah_milik' => strtoupper($this->input->post('wp_wr_lurah_milik')),
							'wp_wr_camat_milik' => strtoupper($this->input->post('wp_wr_camat_milik')),
							'wp_wr_kabupaten_milik' => strtoupper($this->input->post('wp_wr_kabupaten_milik')),
							'wp_wr_kodepos_milik' => strtoupper($this->input->post('wp_wr_kodepos_milik')),
							'wp_wr_telp_milik' => $this->input->post('wp_wr_telp_milik'),
				
							'wp_wr_bidang_usaha' => $this->input->post('bidus'),
							'wp_wr_tgl_kartu' => format_tgl($this->input->post('wp_wr_tgl_kartu')),
							'wp_wr_tgl_terima_form' => format_tgl($this->input->post('wp_wr_tgl_terima_form')),
							'wp_wr_tgl_bts_kirim' => format_tgl($this->input->post('wp_wr_tgl_bts_kirim')),
							'wp_wr_jns_pemungutan' => 2,
							'wp_wr_pejabat' => $this->session->userdata('USER_ID'),
							'wp_wr_nik' => $this->input->post('wp_wr_nik')
						);
						
				$this->db->insert('wp_wr', $data);
				
				if ($this->db->affected_rows() > 0) {
					//insert wp detail
					$this->insert_wp_detail($next_val,
											$this->input->post('bidus'), 
											$this->input->post('gol_hotel'), 
											$this->input->post('txt_jumlah_kamar'), 
											$this->input->post('ddl_jenis_restoran'),
											$this->input->post('txt_jumlah_meja'), 
											$this->input->post('txt_jumlah_kursi'));
											
					if ($this->input->post('bidus') == '16'){
						$wp_wr_restoran_id = $this->wp_wr_restoran_id();
						if($wp_wr_restoran_id == null){
							$wp_wr_restoran_id = 1;
						}
						$data_restoran = array(
							'wp_wr_restoran_id' => $wp_wr_restoran_id,
							'wp_wr_id' => $next_val,
							'jenis_restoran' => $this->input->post('ddl_jenis_restoran'),
							'jumlah_meja' => $this->input->post('txt_jumlah_meja') != "" ? $this->input->post('txt_jumlah_meja') : 0,
							'jumlah_kursi' => $this->input->post('txt_jumlah_kursi') != "" ? $this->input->post('txt_jumlah_kursi') : 0,
							'kapasitas_pengunjung' => $this->input->post('txt_kapasitas_pengunjung') != "" ? $this->input->post('txt_kapasitas_pengunjung') : 0,
							'jumlah_karyawan' => $this->input->post('txt_jumlah_karyawan') != "" ? $this->input->post('txt_jumlah_karyawan') : 0,
						);
						$this->db->insert('wp_wr_restoran', $data_restoran);
					}else if($this->input->post('bidus') == '1'){
						$wp_wr_hotel_id = $this->wp_wr_hotel_id();
						if($wp_wr_hotel_id == null){
							$wp_wr_hotel_id = 1;
						}
						$data_hotel = array(
							'wp_wr_hotel_id' => $wp_wr_hotel_id,
							'wp_wr_id' => $next_val,
							'golongan_hotel' => $this->input->post('gol_hotel'),
							'jumlah_kamar' => $this->input->post('txt_jumlah_kamar') != "" ? $this->input->post('txt_jumlah_kamar') : 0,
							'jumlah_standar' => $this->input->post('txt_jumlah_standar') != "" ? $this->input->post('txt_jumlah_standar') : 0,
							'jumlah_standar_ac' => $this->input->post('txt_jumlah_standar_ac') != "" ? $this->input->post('txt_jumlah_standar_ac') : 0,
							'jumlah_double' => $this->input->post('txt_jumlah_double') != "" ? $this->input->post('txt_jumlah_double') : 0,
							'jumlah_superior' => $this->input->post('txt_jumlah_superior') != "" ? $this->input->post('txt_jumlah_superior') : 0,
							'jumlah_delux' => $this->input->post('txt_jumlah_delux') != "" ? $this->input->post('txt_jumlah_delux') : 0,
							'jumlah_executive_suite' => $this->input->post('txt_jumlah_executive_suite') != "" ? $this->input->post('txt_jumlah_executive_suite') : 0,
							'jumlah_club_room' => $this->input->post('txt_jumlah_club_room') != "" ? $this->input->post('txt_jumlah_club_room') : 0,
							'jumlah_apartment' => $this->input->post('txt_jumlah_apartment') != "" ? $this->input->post('txt_jumlah_apartment') : 0,
							'tarif_standar' => $this->input->post('txt_tarif_standar') != "" ? $this->input->post('txt_tarif_standar') : 0,
							'tarif_standar_ac' => $this->input->post('txt_tarif_standar_ac') != "" ? $this->input->post('txt_tarif_standar_ac') : 0,
							'tarif_double' => $this->input->post('txt_tarif_double') != "" ? $this->input->post('txt_tarif_double') : 0,
							'tarif_superior' => $this->input->post('txt_tarif_superior') != "" ? $this->input->post('txt_tarif_superior') : 0,
							'tarif_delux' => $this->input->post('txt_tarif_delux') != "" ? $this->input->post('txt_tarif_delux') : 0,
							'tarif_executive_suite' => $this->input->post('txt_tarif_executive_suite') != "" ? $this->input->post('txt_tarif_executive_suite') : 0,
							'tarif_club_room' => $this->input->post('txt_tarif_club_room') != "" ? $this->input->post('txt_tarif_club_room') : 0,
							'tarif_apartment' => $this->input->post('txt_tarif_apartment') != "" ? $this->input->post('txt_tarif_apartment') : 0,
						);
						$this->db->insert('wp_wr_hotel', $data_hotel);
					}
					
					$npwprd = $this->common_model->get_record_value('npwprd', 'v_wp_wr', "wp_wr_id='".$next_val."'");
					
					//insert history log ($module, $action, $description)
					$this->common_model->history_log("pendaftaran", "i", "Insert WP Badan Usaha id ".$next_val." | $npwprd"." | ".strtoupper($this->input->post('wp_wr_nama')));
					
					$result = array('status' => true, 'npwpd' => $npwprd, 'wp_wr_id' => $next_val);	
				}
				else 
					$result = array('status' => false, 'msg' => 'Data gagal tersimpan');
			}
		
		return $result;
	}
	
	/**
	 * update data wp_wr_badan_usaha
	 */
	function update_data() {
		$result = array();
		
		list($wp_wr_kd_camat, $wp_wr_camat) =  explode("|", $this->input->post('wp_wr_kd_camat'));
		
		$wp_wr_kd_lurah = '';
		$wp_wr_lurah = '';
		if ($this->input->post('wp_wr_kd_lurah') != '') {
			list($wp_wr_kd_lurah,$wp_wr_lurah) =  explode("|", $this->input->post('wp_wr_kd_lurah'));
		}
	
			$wp_wr_tgl_tb = (!empty($_POST['wp_wr_tgl_tb']) ? $this->input->post('wp_wr_tgl_tb') : NULL);
			$wp_wr_tgl_kk = (!empty($_POST['wp_wr_tgl_kk']) ? $this->input->post('wp_wr_tgl_kk') : NULL);
			
			$data = array(
						'wp_wr_nama' => addslashes(strtoupper($this->input->post('wp_wr_nama'))),
						'wp_wr_almt' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt'))), ENT_QUOTES),
						'wp_wr_lurah' => $wp_wr_lurah,
						'wp_wr_camat' => $wp_wr_camat,
						'wp_wr_kd_lurah' => $wp_wr_kd_lurah,
						'wp_wr_kd_camat' => $wp_wr_kd_camat,
						'wp_wr_kabupaten' => strtoupper($this->input->post('wp_wr_kabupaten')),
						'wp_wr_telp' => $this->input->post('wp_wr_telp'),
						'wp_wr_kodepos' => $this->input->post('wp_wr_kodepos'),
			
						'wp_wr_nama_milik' => addslashes(strtoupper($this->input->post('wp_wr_nama_milik'))),
						'wp_wr_almt_milik' => htmlspecialchars(strip_tags(strtoupper($this->input->post('wp_wr_almt_milik'))), ENT_QUOTES),
						'wp_wr_lurah_milik' => strtoupper($this->input->post('wp_wr_lurah_milik')),
						'wp_wr_camat_milik' => strtoupper($this->input->post('wp_wr_camat_milik')),
						'wp_wr_kabupaten_milik' => strtoupper($this->input->post('wp_wr_kabupaten_milik')),
						'wp_wr_kodepos_milik' => strtoupper($this->input->post('wp_wr_kodepos_milik')),
						'wp_wr_telp_milik' => $this->input->post('wp_wr_telp_milik'),
			
						'wp_wr_tgl_kartu' => format_tgl($this->input->post('wp_wr_tgl_kartu')),
						'wp_wr_tgl_terima_form' => format_tgl($this->input->post('wp_wr_tgl_terima_form')),
						'wp_wr_tgl_bts_kirim' => format_tgl($this->input->post('wp_wr_tgl_bts_kirim')),
						'wp_wr_bidang_usaha' => $this->input->post('bidus'),
						'wp_wr_jns_pemungutan' => 2,
						'wp_wr_pejabat' => $this->session->userdata('USER_ID'),
						'wp_wr_nik' => $this->input->post('wp_wr_nik')
					);
					
			$this->db->where('wp_wr_id', $this->input->post('wp_wr_id'));
			$this->db->update('wp_wr', $data);
			
			if ($this->db->affected_rows() > 0) {
				//update wp detail
				if ($this->input->post('bidus') == "1") {
					$wp_detail = $this->db->get_where('wp_wr_hotel', array('wp_wr_id' => $this->input->post('wp_wr_id')));
					if ($wp_detail->num_rows() > 0){
						$data_hotel = array(
							'golongan_hotel' => $this->input->post('gol_hotel'),
							'jumlah_kamar' => $this->input->post('txt_jumlah_kamar') != "" ? $this->input->post('txt_jumlah_kamar') : 0,
							'jumlah_standar' => $this->input->post('txt_jumlah_standar') != "" ? $this->input->post('txt_jumlah_standar') : 0,
							'jumlah_standar_ac' => $this->input->post('txt_jumlah_standar_ac') != "" ? $this->input->post('txt_jumlah_standar_ac') : 0,
							'jumlah_double' => $this->input->post('txt_jumlah_double') != "" ? $this->input->post('txt_jumlah_double') : 0,
							'jumlah_superior' => $this->input->post('txt_jumlah_superior') != "" ? $this->input->post('txt_jumlah_superior') : 0,
							'jumlah_delux' => $this->input->post('txt_jumlah_delux') != "" ? $this->input->post('txt_jumlah_delux') : 0,
							'jumlah_executive_suite' => $this->input->post('txt_jumlah_executive_suite') != "" ? $this->input->post('txt_jumlah_executive_suite') : 0,
							'jumlah_club_room' => $this->input->post('txt_jumlah_club_room') != "" ? $this->input->post('txt_jumlah_club_room') : 0,
							'jumlah_apartment' => $this->input->post('txt_jumlah_apartment') != "" ? $this->input->post('txt_jumlah_apartment') : 0,
							'tarif_standar' => $this->input->post('txt_tarif_standar') != "" ? $this->input->post('txt_tarif_standar') : 0,
							'tarif_standar_ac' => $this->input->post('txt_tarif_standar_ac') != "" ? $this->input->post('txt_tarif_standar_ac') : 0,
							'tarif_double' => $this->input->post('txt_tarif_double') != "" ? $this->input->post('txt_tarif_double') : 0,
							'tarif_superior' => $this->input->post('txt_tarif_superior') != "" ? $this->input->post('txt_tarif_superior') : 0,
							'tarif_delux' => $this->input->post('txt_tarif_delux') != "" ? $this->input->post('txt_tarif_delux') : 0,
							'tarif_executive_suite' => $this->input->post('txt_tarif_executive_suite') != "" ? $this->input->post('txt_tarif_executive_suite') : 0,
							'tarif_club_room' => $this->input->post('txt_tarif_club_room') != "" ? $this->input->post('txt_tarif_club_room') : 0,
							'tarif_apartment' => $this->input->post('txt_tarif_apartment') != "" ? $this->input->post('txt_tarif_apartment') : 0,
						);
						$this->db->where('wp_wr_id', $this->input->post('wp_wr_id'));
						$this->db->update('wp_wr_hotel', $data_hotel);
					}else { 
						$wp_wr_hotel_id = $this->wp_wr_hotel_id();
						if($wp_wr_hotel_id == null){
							$wp_wr_hotel_id = 1;
						}
						$data_hotel = array(
							'wp_wr_hotel_id' => $wp_wr_hotel_id,
							'wp_wr_id' => $this->input->post('wp_wr_id'),
							'golongan_hotel' => $this->input->post('gol_hotel'),
							'jumlah_kamar' => $this->input->post('txt_jumlah_kamar') != "" ? $this->input->post('txt_jumlah_kamar') : 0,
							'jumlah_standar' => $this->input->post('txt_jumlah_standar') != "" ? $this->input->post('txt_jumlah_standar') : 0,
							'jumlah_standar_ac' => $this->input->post('txt_jumlah_standar_ac') != "" ? $this->input->post('txt_jumlah_standar_ac') : 0,
							'jumlah_double' => $this->input->post('txt_jumlah_double') != "" ? $this->input->post('txt_jumlah_double') : 0,
							'jumlah_superior' => $this->input->post('txt_jumlah_superior') != "" ? $this->input->post('txt_jumlah_superior') : 0,
							'jumlah_delux' => $this->input->post('txt_jumlah_delux') != "" ? $this->input->post('txt_jumlah_delux') : 0,
							'jumlah_executive_suite' => $this->input->post('txt_jumlah_executive_suite') != "" ? $this->input->post('txt_jumlah_executive_suite') : 0,
							'jumlah_club_room' => $this->input->post('txt_jumlah_club_room') != "" ? $this->input->post('txt_jumlah_club_room') : 0,
							'jumlah_apartment' => $this->input->post('txt_jumlah_apartment') != "" ? $this->input->post('txt_jumlah_apartment') : 0,
							'tarif_standar' => $this->input->post('txt_tarif_standar') != "" ? $this->input->post('txt_tarif_standar') : 0,
							'tarif_standar_ac' => $this->input->post('txt_tarif_standar_ac') != "" ? $this->input->post('txt_tarif_standar_ac') : 0,
							'tarif_double' => $this->input->post('txt_tarif_double') != "" ? $this->input->post('txt_tarif_double') : 0,
							'tarif_superior' => $this->input->post('txt_tarif_superior') != "" ? $this->input->post('txt_tarif_superior') : 0,
							'tarif_delux' => $this->input->post('txt_tarif_delux') != "" ? $this->input->post('txt_tarif_delux') : 0,
							'tarif_executive_suite' => $this->input->post('txt_tarif_executive_suite') != "" ? $this->input->post('txt_tarif_executive_suite') : 0,
							'tarif_club_room' => $this->input->post('txt_tarif_club_room') != "" ? $this->input->post('txt_tarif_club_room') : 0,
							'tarif_apartment' => $this->input->post('txt_tarif_apartment') != "" ? $this->input->post('txt_tarif_apartment') : 0,
						);
						$this->db->insert('wp_wr_hotel', $data_hotel);
					}
				}else if ($this->input->post('bidus') == "16"){
					$wp_detail = $this->db->get_where('wp_wr_restoran', array('wp_wr_id' => $this->input->post('wp_wr_id')));
					if ($wp_detail->num_rows() > 0){
						$data_restoran = array(
							'jenis_restoran' => $this->input->post('ddl_jenis_restoran'),
							'jumlah_meja' => $this->input->post('txt_jumlah_meja') != "" ? $this->input->post('txt_jumlah_meja') : 0,
							'jumlah_kursi' => $this->input->post('txt_jumlah_kursi') != "" ? $this->input->post('txt_jumlah_kursi') : 0,
							'kapasitas_pengunjung' => $this->input->post('txt_kapasitas_pengunjung') != "" ? $this->input->post('txt_kapasitas_pengunjung') : 0,
							'jumlah_karyawan' => $this->input->post('txt_jumlah_karyawan') != "" ? $this->input->post('txt_jumlah_karyawan') : 0,
						);
						$this->db->where('wp_wr_id', $this->input->post('wp_wr_id'));
						$this->db->update('wp_wr_restoran', $data_restoran);
					}else { 
						$wp_wr_restoran_id = $this->wp_wr_restoran_id();
						if($wp_wr_restoran_id == null){
							$wp_wr_restoran_id = 1;
						}
						$data_restoran = array(
							'wp_wr_restoran_id' => $wp_wr_restoran_id,
							'wp_wr_id' => $this->input->post('wp_wr_id'),
							'jenis_restoran' => $this->input->post('ddl_jenis_restoran'),
							'jumlah_meja' => $this->input->post('txt_jumlah_meja') != "" ? $this->input->post('txt_jumlah_meja') : 0,
							'jumlah_kursi' => $this->input->post('txt_jumlah_kursi') != "" ? $this->input->post('txt_jumlah_kursi') : 0,
							'kapasitas_pengunjung' => $this->input->post('txt_kapasitas_pengunjung') != "" ? $this->input->post('txt_kapasitas_pengunjung') : 0,
							'jumlah_karyawan' => $this->input->post('txt_jumlah_karyawan') != "" ? $this->input->post('txt_jumlah_karyawan') : 0
						);
						$this->db->insert('wp_wr_restoran', $data_restoran);
					}
				}
				
				//insert history log ($module, $action, $description)
				$this->common_model->history_log("pendaftaran", "U", "Update WP Badan Usaha id ".$this->input->post('wp_wr_id')." | ".strtoupper($this->input->post('wp_wr_nama')));
				
				$result = array('status' => true, 'msg' => 'Data berhasil disimpan');
			}
			else 
				$result = array('status' => false, 'msg' => 'Data gagal tersimpan');
		
		return $result;
	}
	
	/**
	 * delete data wp_wr
	 * @param unknown_type $id
	 */
	function delete_data($wp_wr_id) {
		$this->db->where('wp_wr_id', $wp_wr_id);
		$this->db->delete(array('wp_wr','wp_wr_detail','wp_wr_hotel', 'wp_wr_restoran'));

		if ($this->db->affected_rows() > 0) {
			//insert history log ($module, $action, $description)
			$this->common_model->history_log("pendaftaran", "D", "Delete WP Badan Usaha id $wp_wr_id");
			
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * get_wp_detail_restoran
	 * @param unknown_type $wp_id
	 */
	function get_wp_detail_resto($wp_id) {
		$query = $this->db->get_where('wp_wr_restoran', array('wp_wr_id' => $wp_id));
		return $query;
	}

	/**
	 * get_wp_detail_hotel
	 * @param unknown_type $wp_id
	 */
	function get_wp_detail_hotel($wp_id) {
		$query = $this->db->get_where('wp_wr_hotel', array('wp_wr_id' => $wp_id));
		return $query;
	}
	
	/**
	 * insert wp detail
	 * @param unknown_type $wp_id
	 * @param unknown_type $bidus
	 * @param unknown_type $gol_hotel
	 * @param unknown_type $jumlah_kamar
	 * @param unknown_type $jumlah_meja
	 * @param unknown_type $jumlah_kursi
	 */
	function insert_wp_detail($wp_id, $bidus, $gol_hotel, $jumlah_kamar, $jenis_restoran, $jumlah_meja, $jumlah_kursi) {
		//insert wp detail if hotel or restoran
		if ($bidus == "1") {
			if ($gol_hotel != "" || trim($jumlah_kamar) != "") {
				$data_detail = array(
							'wp_wr_id' => $wp_id,
							'wp_gol_hotel' => $gol_hotel,
							'wp_jlh_kamar' => trim($jumlah_kamar) != "" ? trim($jumlah_kamar) : 0,
							'wp_dibuat_tanggal' => 'now()',
							'wp_dibuat_oleh' => $this->session->userdata('USER_NAME')
						);
				$this->db->insert('wp_wr_detail', $data_detail);
			}
		} else if ($bidus == "16") {
			if ($jenis_restoran != "" || trim($jumlah_meja) != "" || trim($jumlah_kursi) != "") {
				$data_detail = array(
							'wp_wr_id' => $wp_id,
							'wp_jenis_restoran' => $jenis_restoran,
							'wp_jlh_meja' => trim($jumlah_meja) != "" ? trim($jumlah_meja) : NULL,
							'wp_jlh_kursi' => trim($jumlah_kursi) != "" ? trim($jumlah_kursi) : NULL,
							'wp_dibuat_tanggal' => 'now()',
							'wp_dibuat_oleh' => $this->session->userdata('USER_NAME')
							);
				$this->db->insert('wp_wr_detail', $data_detail);
			}
		}
	}
	
	/**
	 * update wp detail
	 * @param unknown_type $wp_id
	 * @param unknown_type $bidus
	 * @param unknown_type $gol_hotel
	 * @param unknown_type $jumlah_kamar
	 * @param unknown_type $jumlah_meja
	 * @param unknown_type $jumlah_kursi
	 */
	function update_wp_detail($wp_id, $bidus, $gol_hotel, $jumlah_kamar, $jenis_restoran, $jumlah_meja, $jumlah_kursi) {
		//insert wp detail if hotel or restoran
		if ($bidus == "1") {
			if ($gol_hotel != "" || trim($jumlah_kamar) != "") {
				$data_detail = array(
							'wp_gol_hotel' => $gol_hotel,
							'wp_jlh_kamar' => trim($jumlah_kamar) != "" ? trim($jumlah_kamar) : 0,
							'wp_dibuat_tanggal' => 'now()',
							'wp_dibuat_oleh' => $this->session->userdata('USER_NAME')
						);
				$this->db->where('wp_wr_id', $wp_id);
				$this->db->update('wp_wr_detail', $data_detail);
			}
		} else if ($bidus == "16") {
			if ($jenis_restoran != "" || trim($jumlah_meja) != "" || trim($jumlah_kursi) != "") {
				$data_detail = array(
							'wp_jenis_restoran' => $jenis_restoran,
							'wp_jlh_meja' => trim($jumlah_meja) != "" ? trim($jumlah_meja) : NULL,
							'wp_jlh_kursi' => trim($jumlah_kursi) != "" ? trim($jumlah_kursi) : NULL,
							'wp_dibuat_tanggal' => 'now()',
							'wp_dibuat_oleh' => $this->session->userdata('USER_NAME')
							);
				$this->db->where('wp_wr_id', $wp_id);
				$this->db->update('wp_wr_detail', $data_detail);
			}
		}
	}

	/**
	 * get wp_wr_restoran_id
	 * @param unknown_type $seq
	 */
	function wp_wr_restoran_id () {
		$wp_wr_restoran_id = $this->adodb->GetOne("SELECT MAX(wp_wr_restoran_id)+1 AS wp_wr_restoran_id FROM wp_wr_restoran");
	 	return $wp_wr_restoran_id;
 	}

	 /**
	 * get wp_wr_hotel_id
	 * @param unknown_type $seq
	 */
	function wp_wr_hotel_id () {
		$wp_wr_hotel_id = $this->adodb->GetOne("SELECT MAX(wp_wr_hotel_id)+1 AS wp_wr_hotel_id FROM wp_wr_hotel");
	 	return $wp_wr_hotel_id;
 	}
}