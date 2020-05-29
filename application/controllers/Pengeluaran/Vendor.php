<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	var $cname = "Vendor";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Vendor_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Vendor",
			'cname' => $this->cname,
			'pages' => "vendor/index",
			'count_vendor' => $this->Vendor_model->count_vendor(),
			'data' => array(),
		];
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Vendor_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_vendor');
		$data = $this->Vendor_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_vendor','Nama Vendor','trim|required');
		$this->form_validation->set_rules('alamat_vendor','Alamat Vendor','trim|required');
		$this->form_validation->set_rules('no_telephone_vendor','No Telephone Vendor','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_vendor');
			
			$data = [
				'nama_vendor' => $this->input->post('nama_vendor'),
				'alamat_vendor' => $this->input->post('alamat_vendor'),
				'no_telephone_vendor' => $this->input->post('no_telephone_vendor'),
			];			

			if ($id == "") {
				$insert = $this->Vendor_model->insert($data);
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

				$update = $this->Vendor_model->update($id, $data);
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

	public function delete_vendor()
	{
		$id = $this->input->post('id_vendor');

		if ($id != "") {
			$delete = $this->Vendor_model->delete($id);
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
