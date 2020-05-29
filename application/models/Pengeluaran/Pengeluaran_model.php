<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model {

	var $table = "pengeluaran";

	public function get_data()
	{
		$this->db->select('pengeluaran.*, petugas_aplikasi.nama_karyawan, produk.no_batch, produk.nomor_produk, vendor.nama_vendor, vendor.alamat_vendor, vendor.	no_telephone_vendor');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = pengeluaran.id_petugas', 'left');
		$this->db->join('produk', 'produk.id_produk = pengeluaran.id_produk', 'left');
		$this->db->join('vendor', 'vendor.id_vendor = pengeluaran.id_vendor', 'left');
		$this->db->order_by('id_pengeluaran','desc');
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
		//$data = array('is_active' => 2);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */