<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	var $cname = "Superadmin/Departemen";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Departemen_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Departemen",
			'cname' => $this->cname,
			'superadmin' => "departemen/index",
			'count_departemen_all' => $this->Departemen_model->count_departemen_all(),
			'data' => array(),
		];
		$this->load->view('pages/superadmin/layouts/dashboard',$data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Departemen_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_departemen');
		$data = $this->Departemen_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{

		$this->form_validation->set_rules('nama_departemen','Nama Departemen','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_departemen');
			$data = [
				'nama_departemen' => $this->input->post('nama_departemen')
			];

			if ($id == "") {
				$insert = $this->Departemen_model->insert($data);
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
				$update = $this->Departemen_model->update($id, $data);
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

	public function delete_departemen()
	{
		$id = $this->input->post('id_departemen');

		if ($id != "") {
			$delete = $this->Departemen_model->delete($id);
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

/* End of file Departemen.php */
/* Location: ./application/controllers/admin/Departemen.php */