<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_kantong_model extends CI_Model {

	var $table = "kantong";

	public function get_data()
	{
		$this->db->select('petugas_aplikasi.nama_karyawan, kantong.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
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
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_pembuatan_no_kantong()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}

	public function get_data_belum()
	{
		$this->db->select('petugas_aplikasi.nama_karyawan, kantong.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->where('kantong.id_status =',1);
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */