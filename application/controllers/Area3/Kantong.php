<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kantong extends CI_Controller {

	var $cname = "Kantong";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Kantong_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Kantong",
			'cname' => $this->cname,
			'pages' => "kantong/index",
			'count_kantong' => $this->Kantong_model->count_kantong(),
			'data' => array(),
		];
		$data['data']['select_status'] = $this->Status_model->get_data();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Kantong_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_kantong');
		$data = $this->Kantong_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_kantong','No Kantong','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_kantong');
			
			$data = [
				'no_batch' => $this->input->post('no_batch'),
				'no_kantong' => $this->input->post('no_kantong'),
				'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
				'status' => $this->input->post('status'),
			];			

			if ($id == "") {
				$insert = $this->Kantong_model->insert($data);
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

				$update = $this->Kantong_model->update($id, $data);
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
			$delete = $this->Kantong_model->delete($id);
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
