<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kantong_model extends CI_Model {

	var $table = "kantong";

	public function get_data()
	{
		$this->db->select('kantong.*, status.status');
		$this->db->from($this->table);
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		//$this->db->where('is_active !=', 2);
		$this->db->order_by('id_kantong','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_kantong',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_kantong',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data)
	{
		$insert = $this->db->insert($this->table,$data);
		return $insert;
	}

	public function update($id, $data)
	{
		$this->db->where('id_kantong', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_kantong',$id);
		//$data = array('is_active' => 2);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */