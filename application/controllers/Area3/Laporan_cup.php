<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	var $cname = "Produk";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Produk_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Produk",
			'cname' => $this->cname,
			'pages' => "produk/index",
			'count_produk' => $this->Produk_model->count_produk(),
			'data' => array(),
		];
		$data['data']['select_status'] = $this->Status_model->get_data();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Produk_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_produk');
		$data = $this->Produk_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_produk','No Produk','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_produk');
			
			$data = [
				'no_batch' => $this->input->post('no_batch'),
				'no_produk' => $this->input->post('no_produk'),
				'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
				'status' => $this->input->post('status'),
			];			

			if ($id == "") {
				$insert = $this->Produk_model->insert($data);
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

				$update = $this->Produk_model->update($id, $data);
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

	public function delete_produk()
	{
		$id = $this->input->post('id_produk');

		if ($id != "") {
			$delete = $this->Produk_model->delete($id);
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
