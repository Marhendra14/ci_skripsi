<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_produksi_cup_model extends CI_Model {

	var $table = "kantong";

	public function get_data_report($start = null, $end = null)
	{
		$this->db->select('kantong.*, petugas_aplikasi.nama_karyawan, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->where('kantong.id_status=',3);
		$this->db->order_by('id_kantong','asc');
		if ($start != null && $end != null) {
			$this->db->where('tanggal_sudah_digunakan BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($end)).'"');
		}

		$query = $this->db->get();
		return $query->result();
	}

}