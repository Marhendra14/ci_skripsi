<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_produksi_dan_penjualan_produk extends CI_Controller {

	var $cname = "Area3/Data_produksi_dan_penjualan_produk";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['SuperAdmin/Petugas_aplikasi_model','Area3/Pembuatan_no_produk_model','Area3/Vendor_model','Logistik/History_produk_model','Area3/Data_produksi_dan_penjualan_produk_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Data Produksi dan Penjualan Produk",
			'cname' => $this->cname,
			'area3' => "data_produksi_dan_penjualan_produk/index",
			'count_data_produksi_dan_penjualan_produk' => $this->Data_produksi_dan_penjualan_produk_model->count_data_produksi_dan_penjualan_produk(),
			'data' => array(),
		];
		$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data_area3();
		$data['data']['select_vendor'] = $this->Vendor_model->get_data();
		$data['data']['select_produk'] = $this->Pembuatan_no_produk_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Data_produksi_dan_penjualan_produk_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_data_produksi_dan_penjualan_produk');
		$data = $this->Data_produksi_dan_penjualan_produk->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('id_produk','No Batch','trim|required');
		$this->form_validation->set_rules('no_produk','No Produk','trim|required');
		$this->form_validation->set_rules('jumlah_produk','jumlah_produk','trim|required');
		$this->form_validation->set_rules('id_vendor','Nama vendor','trim|required');
		$this->form_validation->set_rules('alamat_vendor','Alamat vendor','trim|required');
		$this->form_validation->set_rules('no_telephone_vendor','No Telephone vendor','trim|required');
		$this->form_validation->set_rules('id_status','Status Kantong','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_data_produksi_dan_penjualan_produk');
			
			$data = [
				'id_petugas' => $this->input->post('id_petugas'),				
				'no_batch' => $this->input->post('no_batch'),
				'no_kantong' => $this->input->post('no_kantong'),
				'jumlah_produk' => $this->input->post('jumlah_produk'),
				'no_batch' => $this->input->post('no_batch'),
				'id_vendor' => $this->input->post('id_vendor'),
				'alamat_vendor' => $this->input->post('alamat_vendor'),
				'no_telephone_vendor' => $this->input->post('no_telephone_vendor'),
				'id_status' => $this->input->post('id_status')
			];			
			$data_history = [	
				'waktu_pembuatan_no' => date("Y-m-d H:i:s"),							
				'id_vendor' => $this->input->post('id_vendor'),
				'alamat_vendor' => $this->input->post('alamat_vendor'),
				'no_telephone_vendor' => $this->input->post('no_telephone_vendor'),
				'jumlah_produk' => $this->input->post('jumlah_produk')
			];		
			if ($id == "") {
				$insert = $this->Data_produksi_dan_penjualan_produk_model->insert($data);
				$insert2 = $this->History_produk_model->insert($data_history);
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

				$update = $this->Data_produksi_dan_penjualan_produk_model->update($id, $data);
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

	public function delete_data_produksi_dan_penjualan_produk()
	{
		$id = $this->input->post('id_data_produksi_dan_penjualan_produk');

		if ($id != "") {
			$delete = $this->Data_produksi_dan_penjualan_produk_model->delete($id);
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
