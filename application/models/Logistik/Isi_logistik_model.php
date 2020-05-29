<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_logistik_model extends CI_Model {

	var $table = "isi_logistik";

	public function get_data()
	{
		$this->db->select('isi_logistik.*, petugas_aplikasi.nama_karyawan');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_logistik.id_petugas', 'left');
		$this->db->order_by('id_isi_logistik','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_isi_logistik',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_isi_logistik',$id);
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
		$this->db->where('id_isi_logistik', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_isi_logistik',$id);
		//$data = array('is_active' => 2);
		$delete = $this->db->update($this->table,$data);
		return $delete;
	}

	public function count_isi_logistik()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}
}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */