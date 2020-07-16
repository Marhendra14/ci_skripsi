<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	var $cname = "Status";

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Status",
			'cname'=> $this->cname,
			'pages' => "status/index",
			'data' => array(),
		];
		$this->load->view('layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Status_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_status');
		$data = $this->Status_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');
		
		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_status');

			$data = [
				'status' => $this->input->post('status')
			];

			if ($id == "") {
				$insert = $this->Status_model->insert($data);
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
				$update = $this->Status_model->update($id, $data);
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

	public function delete_jabatan()
	{
		$id = $this->input->post('id_status');

		if ($id != "") {
			$delete = $this->Status_model->delete($id);
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