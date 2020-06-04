	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Data_pengeluaran extends CI_Controller {

		var $cname = "Pengeluaran/Data_pengeluaran";

		public function __construct()
		{
			parent::__construct();
			$this->load->model(['Pengeluaran/Data_pengeluaran_model','Superadmin/Petugas_aplikasi_model','Pengeluaran/Vendor_model']);
		}

		public function index()
		{
			$data = [
				'title' => "Data Pengeluaran",
				'cname' => $this->cname,
				'pengeluaran' => "data_pengeluaran/index",
				'count_data_pengeluaran' => $this->Data_pengeluaran_model->count_data_pengeluaran(),
				'data' => array(),
			];
			$data['data']['select_petugas_aplikasi'] = $this->Petugas_aplikasi_model->get_data_pengeluaran();
			$data['data']['select_vendor'] = $this->Vendor_model->get_data();
			$this->load->view('pages/pengeluaran/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
		}

		public function get_data()
		{
			$data['data'] = $this->Data_pengeluaran_model->get_data();
			echo json_encode($data);
		}

		public function get_data_by_id()
		{
			$id = $this->input->post('id_pengeluaran');
			$data = $this->Data_pengeluaran_model->get_data_by_id($id);
			echo json_encode($data);
		}

		public function insert()
		{
			$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
			$this->form_validation->set_rules('id_vendor','Nama Vendor','trim|required');
			$this->form_validation->set_rules('tanggal_pembuatan','Tanggal Pembuatan','trim|required');
			$this->form_validation->set_rules('jumlah_produk_keluar','Jumlah Produk Keluar','trim|required');
			$this->form_validation->set_message('required',"{field} harus diisi");
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == TRUE) {
				$id = $this->input->post('id_pengeluaran');
				
				$data = [
					'id_petugas' => $this->input->post('id_petugas'),
					'id_vendor' => $this->input->post('id_vendor'),
					'tanggal_pembuatan' => $this->input->post('tanggal_pembuatan'),
					'jumlah_produk_keluar' => $this->input->post('jumlah_produk_keluar'),
				];			

				if ($id == "") {
					$insert = $this->Data_pengeluaran_model->insert($data);
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

					$update = $this->Data_pengeluaran_model->update($id, $data);
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

		public function delete_data_pengeluaran()
		{
			$id = $this->input->post('id_pengeluaran');

			if ($id != "") {
				$delete = $this->Data_pengeluaran_model->delete($id);
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
