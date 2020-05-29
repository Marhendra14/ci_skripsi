<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_aplikasi_model extends CI_Model {

	var $table = "petugas_aplikasi";

	public function get_data()
	{
		$this->db->select('petugas_aplikasi.*, departemen.nama_departemen, jabatan.nama_jabatan');
		$this->db->from($this->table);
		$this->db->join('departemen', 'departemen.id_departemen = petugas_aplikasi.id_departemen', 'left');
		$this->db->join('jabatan', 'jabatan.id_jabatan = petugas_aplikasi.id_jabatan', 'left');
		$this->db->where('is_active !=', 2);
		$this->db->order_by('id_petugas','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_petugas',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_petugas',$id);
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
		$this->db->where('id_petugas', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_petugas',$id);
		$data = array('is_active' => 2);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

	public function count_petugas_aplikasi()
	{
		$jumlah = 0;
		$is_active = 0;
		$this->db->where('is_active =', 0);
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			if ($value->status == 0) {
				$jumlah++;
			}
		}
		return $jumlah;

	}

	public function count_petugas_aplikasi_all()
	{
		$jumlah = 0;
		$this->db->where('is_active =', 1);
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}


}
