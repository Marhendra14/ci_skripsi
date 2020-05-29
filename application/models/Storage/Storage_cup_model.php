<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storage_cup_model extends CI_Model {

	var $table = 'storage_cup';

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('jumlah_cup',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function update($id, $data)
	{
        $this->db->where('jumlah_cup', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
}

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */