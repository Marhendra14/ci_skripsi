<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_aplikasi_model extends CI_Model {

	var $table = "petugas_aplikasi";

	public function get_data()
	{
		$this->db->select('petugas_aplikasi.id_petugas, petugas_aplikasi.nik, petugas_aplikasi.password, petugas_aplikasi.nama_karyawan, departemen.nama_departemen, petugas_aplikasi.grade, jabatan.nama_jabatan');
		$this->db->from($this->table);
		$this->db->join('departemen', 'departemen.id_departemen = petugas_aplikasi.id_departemen', 'left');
		$this->db->join('jabatan', 'jabatan.id_jabatan = petugas_aplikasi.id_jabatan', 'left');
		$this->db->order_by('id_petugas','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_data_logistik()
	{
		$this->db->select('petugas_aplikasi.*');
		$this->db->from($this->table);
		$this->db->where('id_departemen =', 2);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_area3()
	{
		$this->db->select('petugas_aplikasi.*');
		$this->db->from($this->table);
		$this->db->where('id_departemen =', 3);
		$query = $this->db->get();
		return $query->result();
	}


	public function get_data_pengeluaran()
	{
		$this->db->select('petugas_aplikasi.*');
		$this->db->from($this->table);
		$this->db->where('id_departemen =', 4);
		$query = $this->db->get();
		return $query->result();
	}
		

	public function get_data_by_id($id)
	{
		$this->db->select('petugas_aplikasi.id_petugas, petugas_aplikasi.nik, petugas_aplikasi.password, petugas_aplikasi.nama_karyawan, departemen.nama_departemen, jabatan.grade, jabatan.nama_jabatan');
		$this->db->from($this->table);
		$this->db->join('departemen', 'departemen.id_departemen = petugas_aplikasi.id_departemen', 'left');
		$this->db->join('jabatan', 'jabatan.id_jabatan = petugas_aplikasi.id_jabatan', 'left');
		$this->db->where('id_petugas',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('petugas_aplikasi.id_petugas, petugas_aplikasi.nik, petugas_aplikasi.password, petugas_aplikasi.nama_karyawan, departemen.nama_departemen, jabatan.grade, jabatan.nama_jabatan');
		$this->db->from($this->table);
		$this->db->join('departemen', 'departemen.id_departemen = petugas_aplikasi.id_departemen', 'left');
		$this->db->join('jabatan', 'jabatan.id_jabatan = petugas_aplikasi.id_jabatan', 'left');
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
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_petugas_aplikasi_all()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}

	public function count_petugas_aplikasi_all1()
	{	
		$this->db->where('id_departemen',1);
		$jumlah = $this->db->get('petugas_aplikasi')->num_rows();	
		return $jumlah;
	}


}
