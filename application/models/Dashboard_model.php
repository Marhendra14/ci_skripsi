<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	var $table = "petugas_aplikasi,departemen,jabatan,isi_logistik,produk,kantong,data_produksi_dan_penjualan_produk,vendor";

	// public function get_bar_pengaduan($id_kategori,$waktu_lapor)
	// {
	// 	// $query = $this->db->query('SELECT * FROM pengaduan WHERE id_kategori ='.$id_kategori.' and YEAR(waktu_lapor) = '.$waktu_lapor.'')->result(); 

	// 	$this->db->where('pengaduan.status !=', 5);
	// 	$this->db->where('id_kategori',$id_kategori);
	// 	$this->db->where('year(waktu_lapor)',$waktu_lapor);
		
	// 	$query = $this->db->get("pengaduan")->result();
	// 	return $query;
	// }

	// public function getKategori(){
	// 	$this->db->order_by('id_kategori','ASC');
	// 	$query = $this->db->get('kategori_laporan');
	// 	return $query->result();
	// }

	// public function get_table_pengaduan($id_kategori, $tahun)
	// {
	// 	$this->db->select('id_kategori,
	// 		SUM(CASE WHEN status ="1" THEN 1 ELSE 0 END) jumlah_direspon
	// 		, SUM(CASE WHEN status ="0" THEN 1 ELSE 0 END) jumlah_blm_direspon');
	// 	$this->db->from('pengaduan');
	// 	$this->db->where('pengaduan.status !=', 5);
	// 	if($id_kategori != null){
	// 		$this->db->where('id_kategori',$id_kategori);
	// 	}
	// 	if($tahun != null){
	// 		$this->db->where('year(waktu_lapor)',$tahun);
	// 	}
	// 	$this->db->group_by('id_kategori');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */