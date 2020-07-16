<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_produksi_dan_penjualan_produk_model extends CI_Model {

	var $table = "data_produksi_dan_penjualan_produk";

	public function get_data()
	{
		$this->db->select('data_produksi_dan_penjualan_produk.id_data_produksi_dan_penjualan_produk, petugas_aplikasi.nama_karyawan, produk.no_batch, produk.no_produk, data_produksi_dan_penjualan_produk.jumlah_produk, data_produksi_dan_penjualan_produk.tanggal_pembuatan, data_produksi_dan_penjualan_produk.id_vendor, vendor.nama_vendor, vendor.alamat_vendor, vendor.no_telephone_vendor , status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = data_produksi_dan_penjualan_produk.id_petugas', 'left');
		$this->db->join('produk', 'produk.id_produk = data_produksi_dan_penjualan_produk.id_produk', 'left');
		$this->db->join('vendor', 'vendor.id_vendor = data_produksi_dan_penjualan_produk.id_vendor', 'left');
		$this->db->join('status', 'status.id_status = data_produksi_dan_penjualan_produk.id_status', 'left');
		$this->db->order_by('id_data_produksi_dan_penjualan_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_status($no_produk,$no_batch,$id_status,$jumlah_produk)
	{
		$this->db->set('id_status', 3);
		$this->db->set('jumlah_produk', 0);
		$this->db->where('no_batch =',$no_batch);
		$this->db->where('no_produk =',$no_produk);
		return $this->db->update('produk');
	}
	public function get_no_batch($no_batch)
	{
		$this->db->select('no_produk');
		$this->db->from('produk');
		$this->db->where('no_batch',$no_batch);
		$this->db->where('id_status=',1);
		$query = $this->db->get();
		return $query;
	}

	public function distinct_no_batch()
	{
		$data = $this->db->query('select distinct no_batch from produk');
		return $data->result();
	}

	public function get_vendor($id_vendor)
	{
		$this->db->select('alamat_vendor, no_telephone_vendor');
		$this->db->from('vendor');
		$this->db->where('id_vendor',$id_vendor);
		$query = $this->db->get();
		return $query;
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produksi_dan_penjualan_produk',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_data_produksi_dan_penjualan_produk',$id);
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
		$this->db->where('id_data_produksi_dan_penjualan_produk', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_data_produksi_dan_penjualan_produk',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_data_produksi_dan_penjualan_produk()
	{
		$this->db->where('id_status',3);
		$jumlah = $this->db->get('data_produksi_dan_penjualan_produk')->num_rows();	
		return $jumlah;
	}
}
