<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_kantong extends CI_Controller {

	var $cname = "Area3/Pembuatan_no_kantong";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['SuperAdmin/Petugas_aplikasi_model','Area3/Pembuatan_no_kantong_model','Status_model','Logistik/History_cup_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Pembuatan Nomor Kantong",
			'cname' => $this->cname,
			'area3' => "pembuatan_no_kantong/index",
			'count_pembuatan_no_kantong' => $this->Pembuatan_no_kantong_model->count_pembuatan_no_kantong(),
			'data' => array(),
		];
		$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data_area3();
		$data['data']['select_status'] = $this->Status_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Pembuatan_no_kantong_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_kantong');
		$data = $this->Pembuatan_no_kantong_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_kantong','No Kantong','trim|required');
		$this->form_validation->set_rules('id_status','Status Kantong','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_kantong');
			
			$data = [
				'id_petugas' => $this->input->post('id_petugas'),
				'no_batch' => $this->input->post('no_batch'),
				'no_kantong' => $this->input->post('no_kantong'),
				'id_status' => $this->input->post('id_status')
			];			
			$data_history = [				
				'id_kantong' => $this->input->post('no_kantong'),
				'no_batch' => $this->input->post('no_batch'),
				'waktu_pembuatan_no' => date("Y-m-d H:i:s")
			];		
			if ($id == "") {
				$insert = $this->Pembuatan_no_kantong_model->insert($data);
				$insert2 = $this->History_cup_model->insert($data_history);
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

				$update = $this->Pembuatan_no_kantong_model->update($id, $data);
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

	public function delete_kantong()
	{
		$id = $this->input->post('id_kantong');

		if ($id != "") {
			$delete = $this->Pembuatan_no_kantong_model->delete($id);
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
