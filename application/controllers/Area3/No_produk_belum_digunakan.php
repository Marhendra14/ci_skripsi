<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_produk_belum_digunakan extends CI_Controller {

	var $cname = "Area3/No_produk_belum_digunakan";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['SuperAdmin/Petugas_aplikasi_model','Area3/Pembuatan_no_produk_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Daftar Nomor Produk Yang Belum Digunakan",
			'cname' => $this->cname,
			'area3' => "no_produk_belum_digunakan/index",
			'count_pembuatan_no_produk' => $this->Pembuatan_no_produk_model->count_pembuatan_no_produk(),
			'data' => array(),
		];
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data()
	{
		$data['data'] = $this->Pembuatan_no_produk_model->get_data_belum();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_produk');
		$data = $this->Pembuatan_no_produk_model->get_data_by_id_belum($id);
		echo json_encode($data);
	}
}
