<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_produk extends CI_Controller {

	var $cname = "Area3/Pembuatan_no_produk";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Area3/Pembuatan_no_produk_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Produk",
			'cname' => $this->cname,
			'area3' => "pembuatan_no_produk/index",
			'count_pembuatan_no_produk' => $this->Pembuatan_no_produk_model->count_pembuatan_no_produk(),
			'data' => array(),
		];
		$data['data']['select_status'] = $this->Status_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Pembuatan_no_produk_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_produk');
		$data = $this->Pembuatan_no_produk_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_produk','No Produk','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_rules('id_status','Status Produk','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_produk');
			
			$data = [
				'no_batch' => $this->input->post('no_batch'),
				'no_produk' => $this->input->post('no_produk'),
				'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
				'id_status' => $this->input->post('id_status'),
			];			

			if ($id == "") {
				$insert = $this->Pembuatan_no_produk_model->insert($data);
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

				$update = $this->Pembuatan_no_produk_model->update($id, $data);
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
			$delete = $this->Pembuatan_no_produk_model->delete($id);
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
