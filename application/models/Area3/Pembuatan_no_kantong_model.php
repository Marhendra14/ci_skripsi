<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_kantong_model extends CI_Model {

	var $table = "kantong";

	public function get_data($no_batch = '',$no_kantong = '')
	{
		$this->db->select('kantong.id_kantong, petugas_aplikasi.nama_karyawan, kantong.*, status.status,kantong.qrcode');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->where('kantong.id_status = 1');
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

	public function get_next_id(){
		$query = $this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'kantong'");
		return $query->result_array();
	}

	public function get_max(){
		$query = $this->db->query("SELECT MAX(no_kantong) as max FROM `kantong` WHERE DATE(tanggal_pembuatan) = DATE(NOW())");
		return $query->result_array();
	}

	public function get_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_kantong',$id);
		$query = $this->db->get();
		return $query->row(0);
	}

	public function get_data_by_id2($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_kantong',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_history($no_batch = null, $no_kantong = null)
	{
		$this->db->select('history_cup.*, kantong.no_batch, kantong.no_kantong, kantong.tanggal_pembuatan, data_produksi_cup.tanggal_pembuatan');
		$this->db->from('history_cup');
		$this->db->join('kantong', 'kantong.id_kantong = history_cup.id_kantong', 'left');
		$this->db->join('data_produksi_cup', 'data_produksi_cup.id_kantong = history_cup.id_kantong', 'left');
		if($no_batch != null){
			$this->db->where('kantong.no_batch',$no_batch);
		}
		if($no_kantong != null){
			$this->db->where('kantong.no_kantong',$no_kantong);
		}
		
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
		$this->db->where('id_kantong', $id);
		$update = $this->db->update($this->table,$data);
		return $update;
	}
	
	public function delete($id)
	{
		$this->db->where('id_kantong',$id);
		$delete = $this->db->delete($this->table);
		return $delete;
	}

	public function count_pembuatan_no_kantong()
	{
		$this->db->where('id_status',1);
		$jumlah = $this->db->get('kantong')->num_rows();	
		return $jumlah;

	}

	public function count_storage_cup()
	{
		$this->db->select_sum('jumlah_cup');
		$this->db->where('id_status=',3);
		$query = $this->db->get('kantong');
		if($query->num_rows()>0)
		{
			return $query->row()->jumlah_cup;
		}
		else
		{
			return 0;
		}
	}

	public function count_storage()
	{
		$this->db->select_sum('jumlah_cup');

		$query = $this->db->get('kantong');
		if($query->num_rows()>0)
		{
			return $query->row()->jumlah_cup;
		}
		else
		{
			return 0;
		}
	}

	public function get_data_belum()
	{
		$this->db->select('petugas_aplikasi.nama_karyawan, kantong.*, status.status');
		$this->db->from($this->table);
		$this->db->join('petugas_aplikasi', 'petugas_aplikasi.id_petugas = kantong.id_petugas', 'left');
		$this->db->join('status', 'status.id_status = kantong.id_status', 'left');
		$this->db->where('kantong.id_status =',1);
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */