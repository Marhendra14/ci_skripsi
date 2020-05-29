<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	var $table = 'status';

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('id_status','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_status',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function insert($data)
	{
		$insert = $this->db->insert($this->table,$data);
		return $insert;
	}

	public function update($id, $data)
	{
        $this->db->where('id_status', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id_status',$id);
		//$data = array('status' => 2);
		$delete = $this->db->update($this->table, $data);
		return $delete;

	}
}

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */