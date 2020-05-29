<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_storage_cup_model extends CI_Model {

	var $table = "isi_storage_cup";

	public function get_data()
	{
		$this->db->select('isi_storage_cup.*, petugas_aplikasi.nama_karyawan, kantong.no_batch,kantong.no_kantong, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_storage_cup.id_petugas', 'left');
		$this->db->join('kantong', 'kantong.id_kantong = isi_storage_cup.id_kantong', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->order_by('id_data_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produksi_cup',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produksi_cup',$id);
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
		$this->db->where('id_data_produksi_cup', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_data_produksi_cup',$id);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */