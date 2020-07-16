<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen_model extends CI_Model {

	var $table = "departemen";

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
		$this->db->where('id_departemen',$id);
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
        $this->db->where('id_departemen', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_departemen',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_departemen()
	{
		$jumlah = 0;
		$this->db->where('id_departemen !=', 0);
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			if ($value->status == 0) {
				$jumlah++;
			}
		}
		return $jumlah;

	}

	public function count_departemen_all()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}
}

/* End of file Golongan_model.php */
/* Location: ./application/models/Golongan_model.php */