<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_produk_model extends CI_Model 
{

	var $table = "history_produk";

	public function get_data($id_produk)
	{
		$this->db->select('history_produk.*, produk.no_produk, produk.no_batch, produk.tanggal_pembuatan, data_produksi_produk.tanggal_pembuatan');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id_produk = history_produk.id_produk', 'left');
		$this->db->join('data_produksi_produk', 'data_produksi_produk.id_produk = history_produk.id_produk', 'left');
		$this->db->where('id_produk', $id_produk);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data)
	{
		$insert = $this->db->insert($this->table,$data);
		return $insert;
	}
}