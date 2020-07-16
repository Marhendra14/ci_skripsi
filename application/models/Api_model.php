<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	public function LoginCheck($nik,$password)
	{
		$this->db->where('nik', $nik);
        $this->db->where('password', ($password));
        $query = $this->db->get('petugas_aplikasi');
        return $query->row();		
	}

	public function get_kantong($id){
		$this->db->select('*');
		$this->db->from('kantong');
		$this->db->where('id_status =',$id);
		return $this->db->get()->result_array();
	}

	public function get_kantong_status($id){
		$this->db->select('*');
		$this->db->from('kantong');
		$this->db->where('id_kantong =',$id);
		return $this->db->get()->result_array();
	}

	public function editKantong($id,$data){
		$this->db->update('kantong',$data,['id_kantong' => $id]);

		return $this->db->affected_rows();
	}

	public function update_kantong($id, $data)
	{
		$this->db->where('id_kantong', $id);
		if ($this->db->update('kantong', $data)) {
            return true;
        } else {
            return false;
        }
	}

	public function update_kantong_akhir($id, $data)
	{
		$this->db->where('id_kantong', $id);
		if ($this->db->update('kantong', $data)) {
            return true;
        } else {
            return false;
        }
	}

	public function get_data_kantong($id){
		$sql = $this->db->select("*")
						->from("kantong")
						->where("id_status",2)
						->get();
		return $sql;
	}

	public function logout($id)
	{
		$data = array('token' => '');
		$sql = $this->db->where('id',$id)
						->update('users',$data);
		if($sql)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}