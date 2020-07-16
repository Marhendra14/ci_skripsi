<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_produk_model extends CI_Model 
{
	var $table = "data_produksi_dan_penjualan_produk";

	public function get_data($no_batch = '',$no_produk = '')
	{
		$this->db->select('data_produksi_dan_penjualan_produk.*, petugas_aplikasi.nama_karyawan, status.status, vendor.nama_vendor, vendor.alamat_vendor, vendor.no_telephone_vendor');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = data_produksi_dan_penjualan_produk.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = data_produksi_dan_penjualan_produk.id_status', 'left');
		$this->db->join('vendor', 'vendor.id_vendor = data_produksi_dan_penjualan_produk.id_vendor', 'left');
		$this->db->where('data_produksi_dan_penjualan_produk.id_status = 3');
		if($no_batch != '') {
			$this->db->where('data_produksi_dan_penjualan_produk.no_batch ='.$no_batch);
		}
		$this->db->order_by('id_data_produksi_dan_penjualan_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function distinct_no_batch()
	{
		$data = $this->db->query('select distinct no_batch from data_produksi_dan_penjualan_produk where id_status=3');
		return $data->result();
	}
}