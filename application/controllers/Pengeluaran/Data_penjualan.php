<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	var $cname = "Pengeluaran";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Pengeluaran_model','Petugas_aplikasi_model','Vendor_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Pengeluaran",
			'cname' => $this->cname,
			'pages' => "pengeluaran/index",
			'count_pengeluaran' => $this->Pengeluaran_model->count_pengeluaran(),
			'data' => array(),
		];
		$data['data']['select_petugas_aplikasi'] = $this->Petugas_aplikasi_model->get_data();
		$data['data']['select_produk'] = $this->Produk_model->get_data();
		$data['data']['select_vendor'] = $this->Vendor_model->get_data();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Pengeluaran_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_pengeluaran');
		$data = $this->Pengeluaran_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('nomor_produk','No Produk','trim|required');
		$this->form_validation->set_rules('nama_vendor','Nama Vendor','trim|required');
		$this->form_validation->set_rules('alamat_vendor','Alamat Vendor','trim|required');
		$this->form_validation->set_rules('no_telephone_vendor','No Telephone Vendor','trim|required');
		$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
		$this->form_validation->set_rules('jumlah_produk_keluar','Jumlah Produk Keluar','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_pengeluaran');
			
			$data = [
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'no_batch' => $this->input->post('no_batch'),
				'nomor_produk' => $this->input->post('nomor_produk'),
				'nama_vendor' => $this->input->post('nama_vendor'),
				'alamat_vendor' => $this->input->post('alamat_vendor'),
				'no_telephone_vendor' => $this->input->post('no_telephone_vendor'),
				'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
				'jumlah_produk_keluar' => $this->input->post('jumlah_produk_keluar'),
			];			

			if ($id == "") {
				$insert = $this->Pengeluaran_model->insert($data);
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

				$update = $this->Pengeluaran_model->update($id, $data);
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

	public function delete_pengeluaran()
	{
		$id = $this->input->post('id_pengeluaran');

		if ($id != "") {
			$delete = $this->Pengeluaran_model->delete($id);
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
