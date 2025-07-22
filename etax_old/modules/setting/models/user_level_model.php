<?php 
/**
 * class User_level_model
 * @package Simpatda
 * @author Daniel Hutauruk
 */
class User_level_model extends CI_Model {
	/**
	 * get list data rekam_formulir
	 */
	function get_list() {
		$tables = " ref_jabatan ";
	
		$sortname = 'ref_jab_id';
		$sortorder = 'desc';
		$sort = "ORDER BY $sortname $sortorder";
		
		$page = $_POST['page'];
		$rp = $_POST['rp'];
		if (!$page) $page = 1;
		if (!$rp) $rp = 10;
		$start = (($page-1) * $rp);
		$limit = " LIMIT $rp OFFSET $start ";
		
		$query = $_POST['query'];
		$qtype = $_POST['qtype'];
	
	
		$sql = "SELECT * FROM $tables $sort $limit";
		$result = $this->adodb->Execute($sql);
		$total = $this->adodb->GetOne("SELECT count('ref_jab_id') FROM $tables $where");
			
		$list = array();
		$counter = 1 + $rp * ($page - 1);
		
		if ($result) {
			$index = 0;
			while ($row = $result->FetchNextObject(false)) {
				$list[] = array (
								"id"	=> $counter,
								"cell"	=> array (
									$counter,
									$row->ref_jab_nama,
									"<a href='#' class='btn btn-xs btn-info text-white' onclick=\"aksesmenu('".$row->ref_jab_id."')\">Hak Akses Menu</a>"
								)
							);
				$counter++;
				$index++;
			}
		}
	
		$result = array (
						"page"	=> $page,
						"total"	=> $total,
						"rows"	=> $list
					);
			
		echo json_encode($result);	
	}

	function cekAkses($ref_jab_id)
	{
		$tables = " function_access ";
		$join = "INNER JOIN menu ON function_access.men_id=menu.men_id";
		$where = "WHERE usr_type_id = '$ref_jab_id'";
		$sql = "SELECT * FROM $tables $join $where";
		$result = $this->adodb->Execute($sql);
		return $result;
	}

	function daftarMenu()
	{
		$tables = " menu ";
		$sql = "SELECT * FROM $tables";
		$result = $this->adodb->Execute($sql);
		return $result;
	}

	function addAkses($data)
	{
		$this->db->insert('function_access', $data);
	}

	function hapusAkses($men_id, $usr_type_id)
	{
		$this->db->delete('function_access', array('men_id' => $men_id, 'usr_type_id' => $usr_type_id));
	}
}