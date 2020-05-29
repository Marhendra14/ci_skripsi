<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengeluaran_model extends CI_Model {

	var $table = "pengeluaran";

	public function get_data()
	{
		$this->db->select('pengeluaran.*, petugas_aplikasi.nama_karyawan, vendor.nama_vendor');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = pengeluaran.id_petugas', 'left');
		$this->db->join('vendor', 'vendor.id_vendor = pengeluaran.id_vendor', 'left');
		$this->db->order_by('id_pengeluaran','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_pengeluaran',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_pengeluaran',$id);
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
		$this->db->where('id_pengeluaran', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_pengeluaran',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_data_pengeluaran()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}


}
