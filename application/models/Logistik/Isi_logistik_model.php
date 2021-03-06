<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_logistik_model extends CI_Model {

	var $table = "isi_logistik";

	public function get_data()
	{
		$this->db->select('isi_logistik.*, petugas_aplikasi.nama_karyawan');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_logistik.id_petugas', 'left');
		$this->db->order_by('id_isi_logistik','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function cek_data_ramal(){
		$this->db->select('*');
		$this->db->from('data_yang_akan_diramal');
		$query = $this->db->get();
		return $query;
	}

	public function get_data_by_id($id)
	{
		$this->db->select('isi_logistik.*, petugas_aplikasi.nama_karyawan');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_logistik.id_petugas', 'left');
		$this->db->where('id_isi_logistik',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_bulan_tahun($bulan, $tahun){
		$data = $this->db->query("select sum(jumlah_cup) as jumlah_cup from kantong where id_status=3 AND MONTH(tanggal_sudah_digunakan)=".$bulan." AND YEAR(tanggal_sudah_digunakan)=".$tahun);
		return $data->result();
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('isi_logistik.*, petugas_aplikasi.nama_karyawan');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_logistik.id_petugas', 'left');
		$this->db->where('id_isi_logistik',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_isi_logistik($id)
	{
		$this->db->select('data_yang_akan_diramal.*');
		$this->db->from('data_yang_akan_diramal');
		$this->db->where('data_ke',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function insert($data)
	{
		$insert = $this->db->insert($this->table,$data);
		return $insert;
	}

	public function update($id, $data)
	{
		$this->db->select('isi_logistik.*, petugas_aplikasi.nama_karyawan');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = isi_logistik.id_petugas', 'left');
		$this->db->where('id_isi_logistik',$id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_isi_logistik',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_isi_logistik()
	{
		$jumlah = 0;
		$query = $this->db->get($this->table)->result();
		foreach ($query as $key => $value) {	
			$jumlah++;
		}	
		return $jumlah;

	}

	public function get_last_id()
	{
		return $this->db->insert_id();
	}

	public function sum_data()
	{
		$this->db->select('SUM(data_yang_akan_diramal.data_ke) as data_ke, 
			SUM(data_yang_akan_diramal.data_produksi_bulan_lalu) as data_produksi_bulan_lalu, 
			SUM(data_yang_akan_diramal.perkalian_data) as perkalian_data, 
			SUM(data_yang_akan_diramal.data_ke_kuadrat) as data_ke_kuadrat');
		$this->db->from('data_yang_akan_diramal');
		$query = $this->db->get();
		return $query->result();
	}

	public function count_data()
	{
		return $this->db->count_all_results('data_yang_akan_diramal');
	}

	public function update_data_yang_akan_diramal($id, $resultb, $resulta, $hasil_peramalan, $mape)
	{
		$this->db->set('nilai_b', $resultb);
		$this->db->set('nilai_a', $resulta);
		$this->db->set('hasil_peramalan', $hasil_peramalan);
		$this->db->set('mape', $mape);
		$this->db->where('data_ke', $id);
		return $this->db->update('data_yang_akan_diramal');
	}

	public function get_tahun()
	{
		$data = $this->db->query('select distinct tahun from isi_logistik');
		return $data->result();
	}
}
