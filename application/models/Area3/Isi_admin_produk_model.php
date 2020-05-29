<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_admin_produk_model extends CI_Model {

	var $table = "isi_admin_produk";

	public function get_data()
	{
		$this->db->select('isi_admin_produk.*, petugas_aplikasi.nama_karyawan, produk.no_batch, produk.nomor_produk,status.status');
		$this->db->from($this->table);
			$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_admin_produk.id_petugas', 'left');
		$this->db->join('produk', 'produk.id_produk = isi_admin_produk.id_produk', 'left');
		$this->db->join('status', 'status.id_status = produk.id_status', 'left');
		$this->db->order_by('id_data_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produk',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produk',$id);
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
		$this->db->where('id_data_produk', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_data_produk',$id);
		//$data = array('is_active' => 2);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */