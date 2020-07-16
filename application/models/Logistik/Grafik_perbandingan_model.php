<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_perbandingan_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
 
	public function graph()
	{
		$data = $this->db->query('SELECT (bulan+1) as bulan, hasil_peramalan from data_yang_akan_diramal');
		return $data->result();
	}

	public function graph2()
	{
		$data = $this->db->query("select sum(jumlah_cup) as jumlah_cup, month(tanggal_sudah_digunakan) as bulan from kantong where id_status=3 group by(bulan)");
		return $data->result();
	}

	public function get_tahun(){
		$this->db->select('DISTINCT(YEAR(tanggal_sudah_digunakan)) as tahun');  
		$this->db->from('kantong');
		$this->db->order_by('tahun', 'desc');
		$query=$this->db->get()->result();  
		return $query;
	}
}
