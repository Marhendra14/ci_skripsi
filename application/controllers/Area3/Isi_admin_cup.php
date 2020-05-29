<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_admin_produk extends CI_Controller {

	var $cname = "Isi Admin Produk";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Area3/Isi_admin_produk_model','Superadmin/Petugas_aplikasi_model','Produk_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Isi Admin Produk",
			'cname' => $this->cname,
			'pages' => "Isi_admin_produk/index",
			'count_isi_admin_produk' => $this->Isi_admin_produk_model->count_isi_admin_produk(),
			'data' => array(),
		];
		$data['data']['select_petugas_aplikasi'] = $this->Petugas_aplikasi_model->get_data();
		$data['data']['select_produk'] = $this->Produk_model->get_data();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Isi_admin_produk_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_data_produk');
		$data = $this->Isi_admin_produk_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_produk','No Produk','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_data_produksi_cup');
			
			$data = [
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'no_batch' => $this->input->post('no_batch'),
				'no_produk' => $this->input->post('no_produk'),
				'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
			];			

			if ($id == "") {
				$insert = $this->Isi_admin_produk_model->insert($data);
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

				$update = $this->Isi_admin_produk_model->update($id, $data);
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

	public function delete_isi_admin_produk()
	{
		$id = $this->input->post('id_data_produks');

		if ($id != "") {
			$delete = $this->Isi_admin_produk_model->delete($id);
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
