<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_cup_model extends CI_Model 
{

	var $table = "history_cup";

	public function get_data($id_kantong, $no_batch)
	{
		$this->db->select('history_cup.*, kantong.no_kantong, kantong.no_batch, kantong.tanggal_pembuatan, data_produksi_cup.tanggal_pembuatan');
		$this->db->from($this->table);
		$this->db->join('kantong', 'kantong.id_kantong = history_cup.id_kantong', 'left');
		$this->db->join('data_produksi_cup', 'data_produksi_cup.id_kantong = history_cup.id_kantong', 'left');
		$array = array('id_kantong' => $id_kantong, 'no_batch' => $no_batch);
		$this->db->where($array);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data)
	{
		$insert = $this->db->insert($this->table,$data);
		return $insert;
	}
}