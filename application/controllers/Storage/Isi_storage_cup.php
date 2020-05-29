<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_storage_cup extends CI_Controller {

	var $cname = "Isi Storage Cup";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Isi_storage_cup_model','Petugas_aplikasi_model','Kantong_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Isi Storage Cup",
			'cname' => $this->cname,
			'pages' => "Isi_storage_cup/index",
			'count_isi_storage_cup' => $this->Isi_storage_cup_model->count_isi_storage_cup(),
			'data' => array(),
		];
		$data['data']['select_petugas_aplikasi'] = $this->Petugas_aplikasi_model->get_data();
		$data['data']['select_kantong'] = $this->Kantong_model->get_data();
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
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_kantong','No Kantong','trim|required');
		$this->form_validation->set_rules('total_cup','Total Cup','trim|required');
		$this->form_validation->set_rules('jumlah_cup_reject','Jumlah Cup Reject','trim|required');
		$this->form_validation->set_rules('jumlah_cup_bersih','Jumlah Cup Bersih','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_data_produksi_cup');
			
			$data = [
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'no_batch' => $this->input->post('no_batch'),
				'no_kantong' => $this->input->post('no_kantong'),
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
		} else {
			$ret = [
				'code' => 2,
				'title' => 'Warning',
				'text' => ''.validation_errors('',''),
				'field' => $this->form_validation->error_array(),
				'icon' => 'warning'
			];
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
					'text' => "Delete success",
					'title' => "Delete",
					'icon' => "success",
				];
			}else{
				$ret = [
					'text' => "Delete failed",
					'title' => "Delete",
					'icon' => "warning",
				];
			}
			
		} else {
			$ret = [
				'text' => "Delete failed",
				'title' => "Delete",
				'icon' => "warning",
			];
		}
		echo json_encode($ret);
	}

}
