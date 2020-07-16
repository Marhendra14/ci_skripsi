<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_cup_model extends CI_Model 
{
	var $table = "kantong";

	public function get_data($no_batch = '',$no_kantong = '')
	{
		$this->db->select('kantong.*, petugas_aplikasi.nama_karyawan, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->where('kantong.id_status = 3');
		if($no_batch != '') {
			$this->db->where('kantong.no_batch ='.$no_batch);
		}
		if($no_kantong != '') {
			$this->db->where('kantong.no_kantong ='.$no_kantong);
		}
		$this->db->order_by('id_kantong','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function distinct_no_batch()
	{
		$data = $this->db->query('select distinct no_batch from kantong where id_status=3');
		return $data->result();
	}
}