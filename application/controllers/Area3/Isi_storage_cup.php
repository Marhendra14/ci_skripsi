<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_storage_cup extends CI_Controller {

	var $cname = "Area3/Isi_storage_cup";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Area3/Isi_storage_cup_model','Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_kantong_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Isi Storage Cup",
			'cname' => $this->cname,
			'area3' => "Isi_storage_cup/index",
			'count_isi_storage_cup' => $this->Isi_storage_cup_model->count_isi_storage_cup(),
			'data' => array(),
		];
		$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data();
		$data['data']['select_pembuatan_no_kantong'] = $this->Pembuatan_no_kantong_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard',$data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Isi_storage_cup_model->get_data();
		echo json_encode($data);
	}


	public function get_data_by_id()
	{
		$id = $this->input->post('id_data_produksi_cup');
		$data = $this->Isi_storage_cup_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$id = $this->input->post('id_data_produksi_cup');
		$data = [
			'id_petugas' => $this->input->post('id_petugas'),
			'id_kantong' => $this->input->post('id_kantong'),
			'total_cup' => $this->input->post('total_cup'),
			'jumlah_cup_reject' => $this->input->post('jumlah_cup_reject'),
			'jumlah_cup_bersih' => $this->input->post('jumlah_cup_bersih'),
			'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),			
		];

		if ($id == "") {
			$insert = $this->Isi_storage_cup_model->insert($data);
			if($insert){
				$ret = [
					'title' => "Insert",
					'text' => "Insert success",
					'icon' => "success",
				];
			}else{
				$ret = [
					'title' => "Insert",
					'text' => "Insert failed",
					'icon' => "warning",
				];
			}   
		}else {
			$update = $this->Isi_storage_cup_model->update($id, $data);
			if($update){
				$ret = [
					'title' => "Update",
					'text' => "Update success",
					'icon' => "success",
				];
			}else{
				$ret = [
					'title' => "Update",
					'text' => "Update failed",
					'icon' => "warning",
				];
			}
		}
		echo json_encode($ret);
	}

	public function delete_isi_storage_cup()
	{
		$id = $this->input->post('id_data_produksi_cup'); 

		if ($id != "") {
			$delete = $this->Isi_storage_cup_model->delete($id);
			if($delete){
				$ret = [
					'title' => "Delete",
					'text' => "Delete success",
					'icon' => "success",
				];
			}else{
				$ret = [
					'title' => "Delete",
					'text' => "Delete failed",
					'icon' => "warning",
				];
			}
			
		} else {
			$ret = [
				'title' => "Delete",
				'text' => "Delete failed",
				'icon' => "warning",
			];
		}
		echo json_encode($ret);

	}

	public function count_isi_storage_cup()
	{
		$data['data'] = $this->Isi_storage_cup_model->count_isi_storage_cup();
		echo json_encode($data);
	}

}

/* End of file Pengaduan.php */
/* Location: ./application/controllers/Admin/Pengaduan.php */