<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_produk_model extends CI_Model {

	var $table = "produk";

	public function get_data()
	{
		$this->db->select('petugas_aplikasi.nama_karyawan, produk.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = produk.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = produk.id_status', 'left');
		$this->db->order_by('id_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_produk',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_produk',$id);
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
		$this->db->where('id_produk', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_produk',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_pembuatan_no_produk()
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
		$this->db->select('petugas_aplikasi.nama_karyawan, produk.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = produk.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = produk.id_status', 'left');
		$this->db->where('produk.id_status =',1);
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */