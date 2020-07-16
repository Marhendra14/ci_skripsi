<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_produksi_produk_model extends CI_Model {

	var $table = "data_produksi_dan_penjualan_produk";

	public function get_data_report($start = null, $end = null)
	{
		$this->db->select('data_produksi_dan_penjualan_produk.id_data_produksi_dan_penjualan_produk, petugas_aplikasi.nama_karyawan, produk.no_batch, produk.no_produk, data_produksi_dan_penjualan_produk.jumlah_produk,
		produk.tanggal_pembuatan, data_produksi_dan_penjualan_produk.tanggal_pembuatan as tanggal_sudah_digunakan, data_produksi_dan_penjualan_produk.id_vendor, vendor.nama_vendor, vendor.alamat_vendor, vendor.no_telephone_vendor , status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = data_produksi_dan_penjualan_produk.id_petugas', 'left');
		$this->db->join('produk', 'produk.id_produk = data_produksi_dan_penjualan_produk.id_produk', 'left');
		$this->db->join('vendor', 'vendor.id_vendor = data_produksi_dan_penjualan_produk.id_vendor', 'left');
		$this->db->join('status', 'status.id_status = data_produksi_dan_penjualan_produk.id_status', 'left');
		$this->db->where('data_produksi_dan_penjualan_produk.id_status=',3);
		$this->db->order_by('id_data_produksi_dan_penjualan_produk','asc');
		if ($start != null && $end != null) {
			$this->db->where('data_produksi_dan_penjualan_produk.tanggal_pembuatan BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($end)).'"');
		}

		$query = $this->db->get();
		return $query->result();
	}

}