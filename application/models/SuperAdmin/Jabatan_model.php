<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {

	var $table = 'jabatan';

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('id_jabatan','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_grade($grade)
	{
		$this->db->select('id_jabatan,nama_jabatan');
		$this->db->from($this->table);
		$this->db->where('grade',$grade);
		$query = $this->db->get();
		return $query;
	}

	public function grade()
	{
		$data = $this->db->query('select distinct grade from jabatan');
		return $data->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_jabatan',$id);
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
        $this->db->where('id_jabatan', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id_jabatan',$id);
		$delete = $this->db->delete($this->table);
		return $delete;

	}

	public function count_jabatan()
	{
		$jumlah = 0;
		$this->db->where('id_jabatan !=', 0);
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			if ($value->status == 0) {
				$jumlah++;
			}
		}
		return $jumlah;

	}

	public function count_jabatan_all()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}

}

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */