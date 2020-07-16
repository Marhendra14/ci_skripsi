<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	var $cname = "Superadmin/Jabatan";

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Jabatan_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Jabatan",
			'cname'=> $this->cname,
			'superadmin' => "jabatan/index",
			'count_jabatan_all' => $this->Jabatan_model->count_jabatan_all(),
			'data' => array(),
		];
		$this->load->view('pages/superadmin/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_grade($grade)
	{
		$data = $this->Jabatan_model->get_grade($grade)->result();
		echo json_encode($data);
	}

	public function get_data()
	{
		$data['data'] = $this->Jabatan_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_jabatan');
		$data = $this->Jabatan_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function edit_jabatan($id)
	{
		$data = $this->Jabatan_model->get_data_by_id($id);
		echo json_encode($data);
	}	

	public function insert()
	{
		$this->form_validation->set_rules('grade','Grade','trim|required');
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');
		
		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_jabatan');

			$data = [
				'grade' => $this->input->post('grade'),
				'nama_jabatan' => $this->input->post('nama_jabatan')
			];

			if ($id == "") {
				$insert = $this->Jabatan_model->insert($data);
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
				$update = $this->Jabatan_model->update($id, $data);
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

	public function update()
	{
		$id = $this->input->post('id_jabatan');
		$data = [
			'grade' => $this->input->post('grade'),
			'nama_jabatan' => $this->input->post('nama_jabatan')
		];

		$update = $this->Jabatan_model->update($id, $data);
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
		echo json_encode($ret);
	}

	public function delete_jabatan()
	{
		$id = $this->input->post('id_jabatan');

		if ($id != "") {
			$delete = $this->Jabatan_model->delete($id);
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