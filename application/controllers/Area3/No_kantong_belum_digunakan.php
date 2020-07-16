<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_kantong_belum_digunakan extends CI_Controller {

	var $cname = "Area3/No_kantong_belum_digunakan";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_kantong_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Daftar Nomor Kantong Yang Belum Digunakan",
			'cname' => $this->cname,
			'area3' => "no_kantong_belum_digunakan/index",
			'count_pembuatan_no_kantong' => $this->Pembuatan_no_kantong_model->count_pembuatan_no_kantong(),
			'data' => array(),
		];
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Pembuatan_no_kantong_model->get_data_belum();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_kantong');
		$data = $this->Pembuatan_no_kantong_model->get_data_by_id_belum($id);
		echo json_encode($data);
	}
}
