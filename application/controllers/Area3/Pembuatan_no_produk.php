<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_produk extends CI_Controller {

	var $cname = "Area3/Pembuatan_no_produk";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_produk_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Pembuatan Nomor produk",
			'cname' => $this->cname,
			'area3' => "pembuatan_no_produk/index",
			'count_pembuatan_no_produk' => $this->Pembuatan_no_produk_model->count_pembuatan_no_produk(),
			'data' => array(),
		];
		$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data_area3();
		$data['data']['select_status'] = $this->Status_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data($no_batch = '',$no_produk = '')
	{
		$data['data'] = $this->Pembuatan_no_produk_model->get_data($no_batch,$no_produk);
		echo json_encode($data);
	}

	public function get_max_no_produk()
	{
		$data = $this->Pembuatan_no_produk_model->get_max();
		echo json_encode($data);			
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_produk');
		$data = $this->Pembuatan_no_produk_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function get_data_history()
	{
		$no_batch = ($this->input->post('no_batch') != '0' ? $this->input->post('no_batch') : null);
		$no_produk = ($this->input->post('no_produk') != '0' ? $this->input->post('no_produk') : null);
		$data['data'] = $this->Pembuatan_no_produk_model->get_data_history($no_batch,$no_produk);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_produk','No produk','trim|required');
		$this->form_validation->set_rules('id_status','Status produk','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$get_id = $this->Pembuatan_no_produk_model->get_next_id();
			$id = $get_id[0]['auto_increment'];
			$id_petugas = $this->input->post('id_petugas');
			$no_batch = $this->input->post('no_batch');
			$no_produk = $this->input->post('no_produk');
			$jumlah_produk = $this->input->post('jumlah_produk');
			$tanggal_pembuatan = date("Y-m-d H:i:s");
			$id_status = $this->input->post('id_status');
			
			$data = [
				'id_produk' => $id,
				'id_petugas' => $id_petugas,
				'no_batch' => $no_batch,
				'no_produk' => $no_produk,
				'jumlah_produk' => $jumlah_produk,
				'tanggal_pembuatan' => date("Y-m-d H:i:s"),
				'id_status' => $id_status
			];
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
