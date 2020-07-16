<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_produk_model extends CI_Model {

	var $table = "produk";

	public function get_data($no_batch = '',$no_produk = '')
	{
		$this->db->select('produk.id_produk, petugas_aplikasi.nama_karyawan, produk.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = produk.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = produk.id_status', 'left');
		$this->db->where('produk.id_status = 1');
		if($no_batch != '') {
			$this->db->where('produk.no_batch ='.$no_batch);
		}
		if($no_produk != '') {
			$this->db->where('produk.no_produk ='.$no_produk);
		}
		$this->db->order_by('id_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_next_id()
	{
		$query = $this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'produk' AND table_schema = 'skripsi'");
		return $query->result_array();
	}

	public function get_max(){
		$query = $this->db->query("SELECT MAX(no_produk) as max FROM `produk` WHERE DATE(tanggal_pembuatan) = DATE(NOW())");
		return $query->result_array();
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

	public function get_data_history($no_batch = null, $no_produk = null)
	{
		$this->db->select('history_produk.*, produk.no_batch, produk.no_produk, produk.tanggal_pembuatan, data_produksi_cup.tanggal_pembuatan');
		$this->db->from('history_produk');
		$this->db->join('produk', 'produk.id_produk = history_produk.id_produk', 'left');
		$this->db->join('data_produksi_cup', 'data_produksi_cup.id_produk = history_produk.id_produk', 'left');
		if($no_batch != null){
			$this->db->where('produk.no_batch',$no_batch);
		}
		if($no_produk != null){
			$this->db->where('produk.no_produk',$no_produk);
		}
		
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
		$this->db->where('id_status',1);
		$jumlah = $this->db->get('produk')->num_rows();	
		return $jumlah;

	}

	public function count_storage_produk()
	{
		$this->db->select_sum('jumlah_produk');
		$this->db->where('id_status=',1);
		$query = $this->db->get('produk');
		if($query->num_rows()>0)
		{
			return $query->row()->jumlah_produk;
		}
		else
		{
			return 0;
		}
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
