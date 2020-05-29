<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tracking_kantong extends CI_Controller {

	var $cname = "Logistik/Tracking_kantong";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Logistik/Tracking_kantong_model','Area3/Pembuatan_no_kantong_model','Area3/Isi_storage_cup_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Tracking Kantong",
			'cname' => $this->cname,
			'logistik' => "tracking_kantong/index",
			'count_isi_storage_cup' => $this->Isi_storage_cup_model->count_isi_storage_cup(),
			'data' => array(),
		];
		$data['data'] = $this->Isi_storage_cup_model->get_data_isi_storage_cup();
		$data['data']['select_pembuatan_no_kantong'] = $this->Pembuatan_no_kantong_model->get_pembuatan_no_kantong();
		$this->load->view('pages/logistik/layouts/dashboard',$data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Tracking_kantong_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_tracking_kantong');
		$data = $this->Tracking_kantong_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('bulan','Bulan','trim|required');
		$this->form_validation->set_rules('tahun','Tahun','trim|required');
		$this->form_validation->set_rules('data_produksi_bulan_lalu','Data Produksi Bulan Lalu','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_isi_logistik');
			
			$data = [
				'id_petugas' => $this->input->post('id_petugas'),
				'bulan' => $this->input->post('bulan'),
				'tahun' => $this->input->post('tahun'),
				'data_produksi_bulan_lalu' => $this->input->post('data_produksi_bulan_lalu'),
			];			

			if ($id == "") {
				$insert = $this->Isi_logistik_model->insert($data);
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

				$update = $this->Isi_logistik_model->update($id, $data);
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

	public function delete_isi_logistik()
	{
		$id = $this->input->post('id_isi_logistik');

		if ($id != "") {
			$delete = $this->Isi_logistik_model->delete($id);
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
