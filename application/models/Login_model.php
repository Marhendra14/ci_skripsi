<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	var $table = "petugas_aplikasi";
	
	public function getAdmin($nik,$password,$id_departemen)
	{
		$this->db->where('nik', $nik);
		$this->db->where('password', $password);
		$this->db->where('id_departemen', $id_departemen);
		$result = $this->db->get('petugas_aplikasi')->result();
		return $result;
		
	}

	public function get_data()
	{
		$query = $this->db->get('departemen');
		return $query->result();
	}
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */