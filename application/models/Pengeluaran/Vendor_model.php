<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

	var $table = 'vendor';

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('id_vendor','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_vendor',$id);
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
        $this->db->where('id_vendor', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id_vendor',$id);
		//$data = array('status' => 2);
		$delete = $this->db->update($this->table, $data);
		return $delete;

	}
}